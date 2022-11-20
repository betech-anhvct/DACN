<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ProductsDetail;
use App\Models\User;
use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function getCart()
    {
        if (!session()->exists('cart')) {
            session(['cart']);
        }
        if (!Auth::check()) return redirect('/login');
        $cart_list_item = [];
        $cart_list_item = session()->get('cart');
        return view('userpage.cart', compact('cart_list_item'));
    }
    // private function getCartList($cart)
    // {
    //     $cart_list_item = [];
    //     if ($cart == '') {
    //     } else {
    //         foreach ($cart as $id_detail => $quantity) {
    //             $cart_list_item[] = ProductsDetail::where(
    //                 [
    //                     'id_product_detail' => $id_detail,
    //                 ]
    //             )->join('product', 'product.id_product', 'product_detail.id_product')->first();
    //         }
    //     }
    //     return $cart_list_item;
    // }

    public function getCardQuantity()
    {
        $cart = session()->get('cart');
        $total = 0;
        foreach ($cart as $cartItem) {
            $total += $cartItem['quantity'];
        }
        return $total;
    }

    public function add2Cart(Request $request)
    {
        // Đăng nhập
        if (!Auth::check()) return redirect('/login');
        $productID = $request->productID;
        $product = Products::find($request->productID);
        $cart = session()->get('cart');
        if (isset($cart[$productID])) {
            $cart[$productID]['quantity'] = $cart[$productID]['quantity'] + 1;
        } else {
            $cart[$productID] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ];
        }
        session()->put('cart', $cart);
    }

    function changeQuantity(Request $req)
    {
        if ($req->id && $req->quantity) {
            $cart = session()->get('cart');
            $cart[$req->id]['quantity'] = $req->quantity;
            session()->put('cart', $cart);
            $cart_list_item = session()->get('cart');
            $newCartComponent = view('userpage.cart', compact('cart_list_item'))->render();
            return response()->json(['newcartComponent' => $newCartComponent], 200);
        }
    }

    function delCartItem(Request $req)
    {
        if ($req->itemID) {
            $cart_list_item = session()->get('cart');
            unset($cart_list_item[$req->id]);
            session()->put('cart', $cart_list_item);
            $newCartComponent = view('userpage.cart', compact('cart_list_item'))->render();
            return response()->json(['newcartComponent' => $newCartComponent], 200);
        };
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
    public function getCheckoutListUserPage(Request $req)
    {
        // $data = DB::table('order_details')
        //     ->join('product_details', 'order_details.id_product_detail', '=', 'product_details.id_product_detail',)
        //     ->join('products', 'product_details.id_product', '=', 'products.id_product')
        //     ->where('id_order', '=', $id_order)
        //     ->select('order_details.*', 'products.product_name','product_details.size', 'product_details.color', 'product_details.material')
        //     ->get();
        if (Auth::check()) {
            $list_checkout_cart = Cart::where('id_user', Auth::user()->id_user)->get();
            // $id_user = Auth::user()->id_user;
            //->join('cart', 'users.id_user', '=', 'cart.id_user')

            $data = DB::table('cart')
                ->join('product_detail', 'cart.id_product_detail', '=', 'product_detail.id_product_detail')
                ->join('product', 'product_detail.id_product', '=', 'product.id_product')
                ->where('id_user', '=', Auth::user()->id_user)
                ->select('product.product_name', 'cart.quantity', 'product_detail.remaining', 'product_detail.price', 'product_detail.size', 'product_detail.color')
                ->get();
            foreach ($data as $dt) {
                if ($dt->quantity > $dt->remaining) {
                    return redirect()->back()->with(['err' => 'Product "' . $dt->id . '" id "' . $dt->name . '" size "' . $dt->price . '" remaining not enough']);
                }
            }
            return view('userpage.user_checkout', compact('data'));
        } else {
            return redirect('login');
        }
    }
}