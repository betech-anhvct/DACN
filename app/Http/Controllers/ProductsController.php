<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends BaseController {
    public $model = Products::class;
    public function getProduct() {
        $products = (Products::where('status', '!=', '0'))->get();
        $topProducts = Products::all()->take(5);
        return view('userPage.shopProducts', compact('products', 'topProducts'));
    }

    public function shopProductDetail($id) {
        $products = (Products::find($id));
        return view('userPage.shopProductsDetail', ['products' => $products]);
    }

    public function getProductDetail($id) {
        $product = Products::where('id', $id)->with('rCategories')->first();
        $topProducts = Products::where([
            ['status', '!=', '0'],
            'id_category' => $product->id_category,
            ['id', '!=', $product->id]
        ])->take(4)->get();
        return view('userPage.shopProductsDetail', compact('product', 'topProducts'));
    }



    // Admin page
    public function getProductAdmin() {
        $products = Products::where('status', '<>', '0')->with('rCategories')->get();
        return view('adminPage.product', compact('products'));
    }

    public function updateProduct(Request $request, $id) {
        $product = $this->update($request, $id, false);
        $isSuccess = true;
        return view('adminPage.productEdit', compact('product', 'isSuccess'));
    }

    public function showProduct($id) {
        $product = $this->show($id);
        return view('adminPage.productEdit', compact('product'));
    }

    public function createProduct() {
        $product = $this->show(0);
        return view('adminPage.productEdit', compact('product'));
    }

    public function storeProduct(Request $request) {
        $this->store($request);
        $products = $this->index();
        return redirect('/admin/product');
    }
}
