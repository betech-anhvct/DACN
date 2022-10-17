<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController {
    public function getUser() {
        $users = User::all();
        return response()->json($users);
    }
}
