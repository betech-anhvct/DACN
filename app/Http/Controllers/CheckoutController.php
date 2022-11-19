<?php

namespace App\Http\Controllers;

use App\Models\ProductsDetail;
use App\Models\User;
use App\Models\Vouchers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function postOrder(Request $request)
    {
        if (Auth::check()) {
            $total = 0;
            $id_voucher = 1;
            $id_user = Auth::user()->id_user;
            $cart_list = json_decode(User::find($id_user)->cart);
            foreach ($cart_list as $cart_item) {
                if ($cart_item->remaining < $cart_item->pivot->quantity) {
                    return redirect()->back()->with('error_remaining', 'Out of stock');
                }
                $total += $cart_item->pivot->quantity * $cart_item->price;
            }
            if ($request->voucher != '') {
                $total = $total - $this->checkDiscount($request->voucher, $total);
                if ($total != 0) {
                    $voucher = Vouchers::where('voucher_code', $request->voucher)->first();
                    $id_voucher = $voucher->id_voucher;
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
            $id_order = Order::insertGetId($order);
            foreach ($cart_list as $cart_item) {
                $product_detail = ProductsDetail::where('id_product_detail', $cart_item->id_product_detail)->first();
                $order_detail = [
                    'id_order' => $id_order,
                    'id_product_detail' => $cart_item->id_product_detail,
                    'price_sale' => $product_detail->price,
                    'quantity' => $cart_item->pivot->quantity,
                ];
                OrderDetail::insert($order_detail);
                $product_detail->remaining -= $cart_item->pivot->quantity;
                $product_detail->save();
            }
            Cart::where('id_user', $id_user)->delete();
            session()->remove('cart');
            return redirect()->route('danh-sach-slide-user-page-index');
        } else {
            return redirect('login');
        }
    }
}
