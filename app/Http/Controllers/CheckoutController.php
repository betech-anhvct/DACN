<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Products;
use App\Models\Vouchers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller {
    public function checkVoucher(Request $request) {
        $voucher = Vouchers::where('code', $request->voucher_code)->first();
        $discount = 0;
        $message = 'Mã đã hết hạn hoặc không tồn tại';
        if ($voucher != '' && $voucher->quantity > 0) {
            if ($voucher->begin_date <= now() && ($voucher->end_date ?? now()) >= now()) {
                switch ($voucher->condition) {
                    case Vouchers::CONDITION_ALL:
                        if (($request->totalPrice) >= $voucher->product_list) {
                            $message = "Áp dụng thành công";
                            $discount = $voucher->discount;
                        } else {
                            $message = "Chưa đủ điều kiện áp dụng mã";
                        }
                        break;
                    case Vouchers::CONDITION_PRODUCT:
                        $message = "Chưa đủ điều kiện áp dụng mã";
                        $listProduct = explode(',', $voucher->product_list);
                        $cart = session()->get('cart');
                        foreach ($listProduct as $id) {
                            if (isset($cart[$id])) {
                                $message = "Áp dụng thành công";
                                $discount = $voucher->discount;
                                break;
                            }
                        }
                        break;
                    default:
                        break;
                }
            }
        }
        return response()->json(
            [
                'message' => $message,
                'discount' => $discount,
            ]
        );
    }

    public function postCheckout() {
        $cart = session()->get('cart');
        if (!$cart) {
            return redirect('index');
        }
        foreach ($cart as $id => $cart_item) {
            $product = Products::find($id);
            if ($cart_item['quantity'] > $product->stock) {
                $cart[$product->id]['quantity'] = $product->stock;
                session()->put('cart', $cart);
                return redirect('cart')->with('error', 'Sản phẩm ' . $product->name . ' không đủ tồn kho');
            }
        }
        return view('userPage.checkout');
    }

    public function postOrder(Request $request) {
        if (Auth::check()) {
            $totalTemp = 0;
            $total = 0;
            $id_voucher = 0;
            $id_user = Auth::user()->id;
            $cart = session()->get('cart');
            foreach ($cart as $id => $cart_item) {
                $product = Products::find($id);
                if ($cart_item['quantity'] > $product->stock) {
                    $cart[$product->id]['quantity'] = $product->stock;
                    session()->put('cart', $cart);
                    return redirect('cart')->with('error', 'Sản phẩm ' . $product->name . ' không đủ tồn kho');
                }
                $totalTemp += $cart_item['quantity'] * $cart_item['price'];
            }
            $total = $totalTemp;
            if ($request->voucher != '') {
                $total = $totalTemp - $this->checkDiscount($request->voucher, $totalTemp);
                if ($total != $totalTemp) {
                    $voucher = Vouchers::where('code', $request->voucher)->first();
                    $id_voucher = $voucher->id;
                    $voucher->quantity -= 1;
                    $voucher->save();
                }
            }
            $order = [
                'id_user' => $id_user,
                'id_voucher' => $id_voucher,
                'user_name' => $request->user_name,
                'address' => $request->address,
                'phone' => $request->phone,
                'price_total' => $total,
                'status' => '1',
            ];
            $id_order = Orders::insertGetId($order);
            foreach ($cart as $id => $cart_item) {
                $product = Products::where('id', $id)->first();
                $order_detail = [
                    'id_order' => $id_order,
                    'id_product' => $product->id,
                    'price' => $product->price,
                    'quantity' => $cart_item['quantity'],
                ];
                OrderDetail::insert($order_detail);
                $product->stock -= $cart_item['quantity'];
                $product->save();
            }
            session()->remove('cart');
            return redirect('index');
        } else {
            return redirect('login');
        }
    }

    public function checkDiscount($voucher_code, $totalPrice) {
        $voucher = Vouchers::where('code', $voucher_code)->first();
        $discount = 0;
        if ($voucher != '' && $voucher->quantity > 0) {
            if ($voucher->begin_date <= now() && ($voucher->end_date ?? now()) >= now()) {
                switch ($voucher->condition) {
                    case Vouchers::CONDITION_ALL:
                        if (($totalPrice) >= $voucher->product_list) {
                            $discount = $voucher->discount;
                        } else {
                        }
                        break;
                    case Vouchers::CONDITION_PRODUCT:
                        $listProduct = explode(',', $voucher->product_list);
                        $cart = session()->get('cart');
                        foreach ($listProduct as $id) {
                            if (isset($cart[$id])) {
                                $discount = $voucher->discount;
                                break;
                            }
                        }
                        break;
                    default:
                        break;
                }
            }
        }
        return $discount;
    }
}
