<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ProductsDetail;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function getCart()
    {
        if (!session()->exists('cart')) {
            session(['cart']);
        }
        if (Auth::check()) { //Nếu đăng nhập
            $cart = session()->get('cart');
            $cart_list_item = [];
            if ($cart) {
                $cart_list_item = $cart;
            }
        }
        return view('userpage.cart', compact('cart_list_item'));
    }
    private function getCartList($cart)
    {
        $cart_list_item = [];
        if ($cart == '') {
        } else {
            foreach ($cart as $id_detail => $quantity) {
                $cart_list_item[] = ProductsDetail::where(
                    [
                        'id_product_detail' => $id_detail,
                    ]
                )->join('product', 'product.id_product', 'product_detail.id_product')->first();
            }
        }
        return $cart_list_item;
    }


    public function add2Cart(Request $request)
    {
        $msg = 'Out of stock';
        if (!session()->exists('cart')) {
            session(['cart']);
        }
        $cart = session()->get('cart');
        if (Auth::check()) { //Nếu đăng nhập
            $id_user = Auth::user()->id_user;
            $id_detail = $this->get_id_detail($request->id, $request->price, $request->quantity);
            if ($id_detail) {
                $cart_list = json_decode(User::find($id_user)->cart);
                if ($cart_list != null) {
                    foreach ($cart_list as $cart_item) {
                        $cart[$cart_item->id_product_detail] = $cart_item->pivot->quantity;
                    }
                }
                $cart = $this->checkCart($cart, $id_detail, $request->quantity);
                Cart::updateOrInsert(
                    [
                        'id_user' => Auth::user()->id_user,
                        'id_product_detail' => $id_detail,
                    ],
                    [
                        'quantity' => $cart[$id_detail]
                    ]
                );
                session()->put('cart', $cart);
                $msg = 'Add to cart success';
            }
        } else { //Nếu k đăng nhập
            $id_detail = $this->get_id_detail($request->id, $request->name, $request->quantity);

            $cart = session()->get('cart');
            //var_dump($cart);

            $cart = $this->checkCart($cart, $id_detail, $request->quantity);

            session()->put('cart', $cart);
            //session()->remove('cart');
            //var_dump($cart);
        }
        $data = count($cart);
        return response()->json([
            'data' => $data,
            'msg' => $msg,
        ]);
    }

    private function get_id_detail($id, $name, $quantity)
    {
        $product_detail = ProductsDetail::where([
            'id' => $id,
            'name' => $name,
            'quantity' => $quantity,
        ])->first();
        if ($product_detail->remaining < $quantity)
            return null;
        return $product_detail->id_product_detail;
    }

    private function checkCart($cart, $key, $qty)
    {
        if ($cart == '') {
            $cart[$key] = $qty;
        } else if (array_key_exists($key, $cart)) {
            $cart[$key] = $cart[$key] + $qty;
        } else {
            $cart[$key] = $qty;
        }
        return $cart;
    }

}
