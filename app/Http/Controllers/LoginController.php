<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller {
    public function postRegister(Request $request) {
        $request->validate(User::getRule(), User::getRuleTrans());
        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'phone' => $request->phone,
            'role' => User::ROLE_USER,
            'status' => User::STATUS_ACTIVE,
        ];
        $u = new User($user);
        $u->save();
        $this->postLogin($request);
        return redirect('/index'); 
    }

    public function postLogin(Request $request) {
        $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ], [
            'required' => ':attribute không được để trống',
            'min' => ':attribute phải có ít nhất :min ký tự',
        ]);
        $user = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($user)) {
            $user = User::where('email', $request->email)->first();
            Auth::login($user);
            return redirect('/index');
        }
        return redirect()->back()->with('login_status', 'Tên tài khoản hoặc mật khẩu không đúng');
    }

    public function logout() {
        Auth::logout();
        return view('userPage.home');
    }
}
