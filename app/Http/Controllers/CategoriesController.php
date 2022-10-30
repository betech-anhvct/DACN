<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\categorys;
use Illuminate\Http\Request;

class CategoriesController extends BaseController {
    public $model = Categories::class;
    public function getCategory() {
        $categories = $this->index();
        return view('adminPage.categories', compact('categories'));
    }

    public function updateCategory(Request $request, $id) {
        $user = $this->update($request, $id, false);
        $isSuccess = true;
        return view('adminPage.userEdit', compact('user', 'isSuccess'));
    }

    public function showCategory($id) {
        $user = $this->show($id);
        return view('adminPage.userEdit', compact('user'));
    }

    public function deleteCategory($id)
    {
        $this->destroy($id);
        return response()->json(['msg' => 'Xóa thành công']);
    }
}