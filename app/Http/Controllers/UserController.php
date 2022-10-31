<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;

class UserController extends BaseController {
    public $model = 'App\Models\User';
    public function getUser() {
        $users = $this->index();
        return view('adminPage.users', compact('users'));
    }

    public function updateUser(Request $request, $id) {
        $user = $this->update($request, $id, false);
        $isSuccess = true;
        return view('adminPage.userEdit', compact('user', 'isSuccess'));
    }

    public function showUser($id) {
        $user = $this->show($id);
        return view('adminPage.userEdit', compact('user'));
    }

    public function createUser() {
        $user = $this->show(0);
        return view('adminPage.userEdit', compact('user'));
    }

    public function storeUser(Request $request) {
        $this->store($request);
        $users = $this->index();
        return redirect('/admin/users');
    }

    public function deleteUser($id) {
        $this->destroy($id);
        return response()->json(['msg' => 'Xóa thành công']);
    }
}
