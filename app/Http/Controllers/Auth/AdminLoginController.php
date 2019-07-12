<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use Auth;
class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('login.admin');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_pegawai' => 'required|string',
            'nomor_pegawai' => 'required|numeric|unique:admin',
            'email'         => 'required|string|email|unique:admin',
            'password'      => 'required|string|min:6|confirmed'
        ]);
        Admin::create($request->all());
        return redirect()->route('admin.registerform')->with('success', 'Successfully register!');
    }

    public function login(Request $request)
    {

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect()->route('admin.dashboard');
        }
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
