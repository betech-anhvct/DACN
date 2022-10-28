<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class productsDetailController extends Controller
{
    public function getProduct()
    {
        $products = (Products::all());
        $topProducts = Products::all();
        return view('userPage.shopProductsDetail', compact('products', 'topProducts'));
    }
}

