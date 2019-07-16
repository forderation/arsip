<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataPegawai;
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
            'nama_pegawai' => 'required',
            'nomor_pegawai' => 'required|unique:pegawai',
            'email' => 'required|unique:pegawai',
            'password' => 'required',
            'jenis_kelamin' => 'required'
        ],
        [
            'nama_pegawai.required' => 'Nama harus dimasukkan',
            'nomor_pegawai.required' => 'Nomor pegawai harus dimasukkan',
            'email.required' => 'Email harus dimasukkan',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus dimasukkan',
        ]);
        $new = new DataPegawai();
        $new->nama_pegawai = $request->nama_pegawai;
        $new->nomor_pegawai = $request->nomor_pegawai;
        $new->email = $request->email;
        $new->jenis_kelamin = $request->jenis_kelamin;
        $new->validitas = "tidak valid";
        $new->password = bcrypt($request->password);
        $new->save();
        return back()->with('sukses', 'Sukses mendaftarkan akun silahkan tunggu diverifikasi oleh admin');
    }

    public function login(Request $request)
    {

        if (Auth::guard('pegawai')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            if(DataPegawai::where('email',$request->email)->first()->validitas == "tidak valid"){
                Auth::guard('pegawai')->logout();
                return back()->withErrors(['email' => 'Akun anda terdaftar namun belum diverifikasi oleh admin.']);
            }
            return redirect()->route('pegawai.surat-ukur');
        }
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout()
    {
        Auth::guard('pegawai')->logout();
        return redirect()->route('pegawai.login');
    }
}
