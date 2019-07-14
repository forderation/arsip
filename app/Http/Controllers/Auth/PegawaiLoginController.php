<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pegawai;
use Auth;
class PegawaiLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:pegawai', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('login.pegawai');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_pegawai' => 'required|string',
            'nomor_pegawai' => 'required|numeric|unique:pegawai',
            'email'         => 'required|string|email|unique:pegawai',
            'password'      => 'required|string|min:6|confirmed'
        ]);
        Pegawai::create($request->all());
        return redirect()->route('pegawai.registerform')->with('sukses', 'Sukses registrasi akun, silahkan menunggu untuk dikonfirmasi admin');
    }

    public function login(Request $request)
    {

        if (Auth::guard('pegawai')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect()->route('pegawai.dashboard');
        }
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout()
    {
        Auth::guard('pegawai')->logout();
        return redirect()->route('pegawai.login');
    }
}