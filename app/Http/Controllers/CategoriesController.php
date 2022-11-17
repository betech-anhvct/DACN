<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\categorys;
use Illuminate\Http\Request;

class CategoriesController extends BaseController {
    public $model = Categories::class;
    public function getCategory() {
        $categories = $this->index();
        return view('adminPage.category', compact('categories'));
    }

    public function updateCategory(Request $request, $id) {
        $category = $this->update($request, $id, false);
        $isSuccess = true;
        $categories = Categories::where('status', 1)->get();
        return view('adminPage.categoryEdit', compact('category', 'categories', 'isSuccess'));
    }

    public function showCategory($id) {
        $category = $this->show($id);
        $categories = Categories::where('status', 1)->get();
        return view('adminPage.categoryEdit', compact('category', 'categories'));
    }

    public function createCategory() {
        $category = $this->show(0);
        $categories = Categories::where('status', 1)->get();
        return view('adminPage.categoryEdit', compact('category', 'categories'));
    }

    public function storeCategory(Request $request) {
        $this->store($request);
        $categories = $this->index();
        return redirect('/admin/category');
    }
}
