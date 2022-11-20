<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Images;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends BaseController {
    public $model = Products::class;
    public function getProduct() {
        $products = (Products::with('rImages')->where('status', '=', '1'))->get();
        $topProducts = Products::all()->take(5);
        $latedProducts = Products::all()->take(3);
        $categories = Categories::where('status', '=', '1')->get();
        return view('userPage.shopProducts', compact('products', 'topProducts', 'categories', 'latedProducts'));
    }

    public function shopProductDetail($id) {
        $products = (Products::with(['rImages', 'rCategories'])->where(['status', '=', '1', 'id' => $id]))->get();
        return view('userPage.shopProductsDetail', ['products' => $products]);
    }

    public function getProductDetail($id) {
        $product = Products::where('id', $id)->with('rCategories')->first();
        $topProducts = Products::where([
            ['status', '=', '1'],
            'id_category' => $product->id_category,
            ['id', '!=', $product->id]
        ])->take(4)->get();
        return view('userPage.shopProductsDetail', compact('product', 'topProducts'));
    }

    public function findByCategory($category) {
        $products = (Products::with('rImages')->where('status', '=', '1'))->get();
        $topProducts = Products::all()->take(5);
        $latedProducts = Products::all()->take(3);
        $products = Products::with('rImages')->where('status', '=', '1')->where('id_category', $category)->get();
        $categories = Categories::where('status', '=', '1')->get();
        return view('userPage.shopProducts', compact('products', 'topProducts', 'categories', 'latedProducts'));
    }

    public function searchProduct(Request $request) {
        if ($request->search) {
            $products = Products::where('id', 'LIKE', '%' . $request->search . '%')->orWhere('name', 'LIKE', '%' . $request->search . '%')->get();
            $topProducts = Products::all()->take(5);
            $latedProducts = Products::all()->take(3);
            $categories = Categories::where('status', '=', '1')->get();
            return view('userPage.shopProducts', compact('products', 'topProducts', 'categories', 'latedProducts'));
        }

        $products = (Products::with('rImages')->where('status', '=', '1'))->get();
        $topProducts = Products::all()->take(5);
        $latedProducts = Products::all()->take(3);
        $categories = Categories::where('status', '=', '1')->get();
        return view('userPage.shopProducts', compact('products', 'topProducts', 'categories', 'latedProducts'));
    }

    // Admin page
    public function getProductAdmin() {
        $products = Products::with('rCategories')->where('status', '=', '1')->get();
        return view('adminPage.product', compact('products'));
    }

    public function updateProduct(Request $request, $id) {
        $product = $this->update($request, $id);

        // List old img not delete
        $listImg = [];
        if ($request->oldFileUpload) {
            foreach ($request->oldFileUpload as $img) {
                $listImg[] = $img;
            }
        }

        // Remove old img
        Images::where('id_product', $id)->whereNotIn('id', $listImg)->delete();

        // Upload New Img
        $files = $request->fileUpload;
        if ($files) {
            foreach ($files as $f) {
                if ($f) {
                    $name = Images::imageUploadPost($f);
                    $imgReq = new Request();
                    $imgReq->merge([
                        'name' => $name,
                        'id_product' => $id,
                        'status' => '1',
                    ]);
                    $imgController = new ImagesController();
                    $imgController->store($imgReq);
                }
            }
        }
        $isSuccess = true;
        $categories = Categories::where('status', 1)->get();
        return view('adminPage.productEdit', compact('product', 'isSuccess', 'categories'));
    }

    public function showProduct($id) {
        $categories = Categories::where('status', 1)->get();
        $product = $this->show($id);
        return view('adminPage.productEdit', compact('product', 'categories'));
    }

    public function createProduct() {
        $product = $this->show(0);
        $categories = Categories::where('status', 1)->get();
        return view('adminPage.productEdit', compact('product', 'categories'));
    }

    public function storeProduct(Request $request) {
        $this->store($request);
        $products = $this->index();
        return redirect('/admin/product');
    }
}
