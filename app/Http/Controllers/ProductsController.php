<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function getProduct()
    {
        $products = (Products::all());
        $topProducts = Products::all()->take(5);
        return view('userPage.shopProducts', compact('products', 'topProducts'));
    }
}
