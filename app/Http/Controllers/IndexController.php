<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function masterLogin()
    {
        return view('index.login');
    }
    public function doLogin(Request $request)
    {
        $credential = [
            "username" => $request->username,
            "password" => $request->password
        ];
        if (!Auth::attempt($credential)) {
            return back()->withInput()->with("errorMessage", "username atau password salah!");
        }
        return redirect()->route('admin.dashboard');
    }
    public function logout()
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }
        return redirect()->route("login");
    }
}
