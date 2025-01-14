<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\SuratUkur;
use Illuminate\Http\Request;
use App\Kecamatan;
use App\Kelurahan;

class SuratUkurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        //
        $surats = SuratUkur::all();
        return view('admin.menu.surat-ukur', compact('surats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $kecamatans = Kecamatan::OrderBy('nama_kecamatan','ASC')->get();
        return view('admin.menu.tambah-surat-ukur',compact('kecamatans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validator($request->all())->validate();
        $new = new SuratUkur();
        $new->nomor_surat_ukur =$request->input('nomor_surat_ukur');
        $new->nomor_hak = $request->input('nomor_hak');
        $new->nomor_rak = $request->input('nomor_rak');
        $new->nama_pemilik = $request->input('nama_pemilik');
        $new->id_kecamatan = $request->input('id_kecamatan');
        $new->id_kelurahan = $request->input('id_kelurahan');
        $new->save();
        $gambar = $request->file('gambar_scan');
        $name_gambar = "sku-".$new->id.".".$gambar->getClientOriginalExtension();
        $path_gambar = "files/gambar/".$name_gambar;
        $gambar->move((public_path()."/files/gambar/"),$name_gambar);
        $new->path_gambar = $path_gambar;
        $new->save();
        return back()->with('sukses', 'Sukses menambah data berkas surat !');
    }
    
    public function validator(array $data){
        return Validator::make($data, [
            'nomor_surat_ukur' => 'required',
            'nomor_hak' => 'required',
            'nomor_rak' => 'required',
            'nama_pemilik' => 'required',
            'id_kecamatan' => 'required',
            'id_kelurahan' => 'required',
            'gambar_scan' => 'required|mimes:jpeg,jpg,bmp,png|max:2048',
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $kecamatans = Kecamatan::OrderBy('nama_kecamatan','ASC')->get();
        $surat = SuratUkur::where('id',$id)->first();
        return view('admin.menu.detail-surat-ukur',compact('surat','kecamatans'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_surat_ukur' => 'required',
            'nomor_hak' => 'required',
            'nomor_rak' => 'required',
            'nama_pemilik' => 'required',
            'id_kecamatan' => 'required',
            'id_kelurahan' => 'required'
        ]);
        $new = SuratUkur::where('id',$id)->first();
        $new->nomor_surat_ukur =$request->input('nomor_surat_ukur');
        $new->nomor_hak = $request->input('nomor_hak');
        $new->nomor_rak = $request->input('nomor_rak');
        $new->nama_pemilik = $request->input('nama_pemilik');
        $new->id_kecamatan = $request->input('id_kecamatan');
        $new->id_kelurahan = $request->input('id_kelurahan');
        $new->save();
        if($request->file('gambar_scan')){
            $request->validate(['gambar_scan'=>'required|mimes:jpeg,jpg,bmp,png|max:2048']);
            try{
                if($new->path_gambar != NULL){
                    unlink(public_path()."/".$new->path_gambar);
                }
            }catch(Exception $e){
                return back()->with('warning', $e);
            }
            $gambar = $request->file('gambar_scan');
            $name_gambar = "sku-".$new->id.".".$gambar->getClientOriginalExtension();
            $path_gambar = "files/gambar/".$name_gambar;
            $gambar->move((public_path()."/files/gambar/"),$name_gambar);
            $new->path_gambar = $path_gambar;
            $new->save();
        }
        return back()->with('sukses', 'Sukses mengupdate data berkas surat !');
    }

    public function hapus(Request $request)
    {
        //
        $destroy = SuratUkur::findOrFail($request->id);
        try{
          if($destroy->path_gambar != NULL){
              unlink(public_path()."/".$destroy->path_gambar);
          }
        }catch(Exception $e){
  
        }
        $destroy->delete();
        return back()->with('warning', 'Sukses menghapus data berkas surat !');
    }
}
