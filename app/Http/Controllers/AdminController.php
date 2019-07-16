<?php

namespace App\Http\Controllers;
use App\DataPegawai;
use App\Pinjaman;
use App\SuratUkur;
use App\Kelurahan;
use App\Admin;
use Auth;
use Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $pegawais = DataPegawai::where('validitas','tidak valid')->get();
        $total_pegawai = DataPegawai::where('validitas','valid')->count();
        $pinjaman = Pinjaman::all()->count();
        $surat_ukur = SuratUkur::all()->count();
        $kelurahan = Kelurahan::all()->count();
        return view('admin.menu.index',compact('pegawais','total_pegawai','pinjaman','surat_ukur','kelurahan'));
    }

    public function validasi_pegawai(Request $request){
        $pegawai = DataPegawai::where('id',$request->id)->first();
        $pegawai->validitas = "valid";
        $pegawai->save();
        return back()->with('sukses','Sukses validasi akun pegawai :'.$pegawai->nama_pegawai);
    }

    public function show_profil(){
        $admin = Admin::where('id','=',Auth::user()->id)->first();
        return view('admin.menu.profil',compact('admin'));
    }

    public function update_profil(Request $request){
        $admin = Admin::where('id','=',Auth::user()->id)->first();
        if(Hash::check($request->password_lama, $admin->password)){
            $admin->nomor_pegawai = $request->nomor_pegawai;
            $admin->email = $request->email;
            $admin->nama_admin = $request->nama_admin;
            if($request->password){
                $admin->password = bcrypt($request->password);
            }
            $admin->jenis_kelamin = $request->jenis_kelamin;
            $admin->save();
            return back()->with('sukses', 'Sukses update data akun !');
        }
        return back()->with('warning','Gagal update. konfirmasi password salah');
    }
}
