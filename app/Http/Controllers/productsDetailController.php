<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class productsDetailController extends Controller
{
    public function current_Products()
    {
        $products = Products::all();
        return view('userPage.shopProductsDetail', ['products' => $products]);
    }
    public function view_Products()
    {
        $products = Products::with('ProductDetail')->findOrFail($id);
        return view::make('products.current_Products.ProductDetail',compact($products));
    }
}
