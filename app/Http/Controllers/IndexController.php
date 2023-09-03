<?php

namespace App\Http\Controllers;

use App\Models\Reporter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function masterLogin()
    {
        return view('index.login');
    }
    public function masterRegister()
    {
        return view('index.register');
    }
    public function doLogin(Request $request)
    {
        // login sebagai reporter
        $reporter = Reporter::where('email', $request->username)->first();
        if ($reporter) {
            Session::put('reporter_id', $reporter->id);
            return redirect()->route('reporter.dashboard');
        }
        // login sebagai admin
        $credential = [
            "username" => $request->username,
            "password" => $request->password
        ];
        if (!Auth::attempt($credential)) {
            return back()->withInput()->with("errorMessage", "username atau password salah!");
        }
        return redirect()->route('admin.dashboard');
    }
    public function doRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
            'identity_type' => 'required',
            'identity_number' => 'required',
            'pob' => 'required',
            'dob' => 'required',
            'address' => 'required',
        ]);
        $reporterExist = Reporter::where('email', $request->email)->first();
        if ($reporterExist) {
            return back()->withInput()->with("errorMessage", "user dengan email ini sudah terdaftar!");
        }
        $reporter = Reporter::create($request->all());
        return back()->with('successMessage', 'User berhasil register, silahkan login!');
    }
    public function logout()
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }
        Session::forget('reporter_id');
        return redirect()->route("login");
    }
}
