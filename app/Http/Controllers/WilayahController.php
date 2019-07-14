<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kecamatan;
use App\Kelurahan;
class WilayahController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        //
        $kecamatans = Kecamatan::all();
        $kelurahans = Kelurahan::all();
        return view('admin.menu.wilayah', compact('kecamatans','kelurahans'));
    }

    public function tambah_kecamatan(Request $request){
        $request->validate([
            'nama_kecamatan' => 'required',
        ],
        [
            'nama_kecamatan.required' => 'Nama kecamatan harus dimasukkan',
        ]);
        $new = new Kecamatan();
        $new->nama_kecamatan = $request->nama_kecamatan;
        $new->save();
        return back()->with('sukses', 'Sukses menambah data kecamatan '.$new->nama_kecamatan);
    }

    public function tambah_kelurahan(Request $request){
        $request->validate([
            'nama_kelurahan' => 'required',
        ],
        [
            'nama_kelurahan.required' => 'Nama kelurahan harus dimasukkan',
        ]);
        $new = new Kelurahan();
        $new->nama_kelurahan = $request->nama_kelurahan;
        $new->id_kecamatan = $request->id_kecamatan;
        $new->save();
        return back()->with('sukses', 'Sukses menambah data kelurahan '.$new->nama_kelurahan);
    }

    public function delete_kecamatan(Request $request){
        $destroy = Kecamatan::findOrFail($request->id);
        $nama = $destroy->nama_kecamatan;
        $destroy->delete();
        return back()->with('warning', 'Sukses menghapus data kecamatan '.$nama);
    }

    public function delete_kelurahan(Request $request){
        $destroy = Kelurahan::findOrFail($request->id);
        $nama = $destroy->nama_kelurahan;
        $destroy->delete();
        return back()->with('warning', 'Sukses menghapus data kelurahan '.$nama);
    }
}
