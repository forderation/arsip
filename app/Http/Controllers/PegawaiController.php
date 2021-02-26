<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BerkasSurat;
use Carbon\Carbon;
use App\Informasi;
use App\Pinjaman;
use App\DataPegawai;
use App\Kecamatan;
use Auth;
class PegawaiController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:pegawai');
    }

    public function update_foto(Request $request){
        $request->validate(['foto_profil' => 'required|mimes:jpeg,jpg,bmp,png|max:1024']);
        $pegawai = DataPegawai::where('id',$request->id)->first();
        $gambar = $request->file('foto_profil');
        $name_gambar = "foto-".$request->id.".".$gambar->getClientOriginalExtension();
        $path_gambar = "files/fp/".$name_gambar;
        $gambar->move((public_path()."/files/fp/"),$name_gambar);
        $pegawai->foto_profil = $path_gambar;
        $pegawai->save();
        return back()->with('sukses', 'Sukses memperbarui foto profil !');
        
    }

    public function surat_ukur(){
        $kecamatans = Kecamatan::OrderBy('nama_kecamatan','ASC')->get();
        $surats =  BerkasSurat::paginate(12);
        $total = BerkasSurat::all()->count();
        $tersedia = BerkasSurat::where('ketersediaan','tersedia')->count();
        $tidak_tersedia = BerkasSurat::where('ketersediaan','tidak tersedia')->count();
        return view('pegawai.menu.surat-ukur',compact('surats','total','tersedia','tidak_tersedia','kecamatans'));
    }

    public function detail_surat_ukur($id){
        $surat = BerkasSurat::where('id',$id)->first();
        $batas_durasi = Informasi::where('id',1)->first()->batas_akhir_kembali;
        $batas_durasi = Carbon::now()->addDay($batas_durasi);
        return view('pegawai.menu.detail-surat-ukur',compact('surat','batas_durasi'));
    }

    public function pinjam_surat(Request $request){
        $batas_durasi = Informasi::where('id',1)->first()->batas_akhir_kembali;
        $batas_durasi = Carbon::now()->addDay($batas_durasi);
        $pinjaman = new Pinjaman();
        $pinjaman->id_surat_ukur = $request->id;
        $pinjaman->id_peminjam = Auth::user()->id;
        $pinjaman->tanggal_pinjam = Carbon::now();
        $pinjaman->batas_akhir_kembali = $batas_durasi;
        $pinjaman->save();
        return back()->with('sukses', 'Sukses mengajukan pinjaman silahkan tunggu persetujuan dari admin');
    }

    public function show_pinjaman(){
        $pinjamans = Pinjaman::where('id_peminjam','=',Auth::user()->id)->get();
        return view('pegawai.menu.pinjaman',compact('pinjamans'));
    }

    public function search_berkas(Request $request){
        $kecamatans = Kecamatan::OrderBy('nama_kecamatan','ASC')->get();
        if($request->id_kelurahan!=0){
            $surats =  BerkasSurat::where('id_kecamatan',$request->id_kecamatan)
            ->where('id_kelurahan',$request->id_kelurahan)->where('nomor_surat_ukur','like','%'.$request->surat.'%')->paginate(12);
        }else{
            $surats =  BerkasSurat::where('id_kecamatan',$request->id_kecamatan)
                ->where('nomor_surat_ukur','like','%'.$request->surat.'%')->paginate(12);
        }
        $total = $surats->count();
        $tersedia = $surats->where('ketersediaan','tersedia')->count();
        $tidak_tersedia = $surats->where('ketersediaan','tidak tersedia')->count();
        return view('pegawai.menu.surat-ukur',compact('surats','total','tersedia','tidak_tersedia','kecamatans'));
    }

    public function show_profil(){
        $pegawai = DataPegawai::where('id','=',Auth::user()->id)->first();
        return view('pegawai.menu.profil',compact('pegawai'));
    }

    public function update_profil(Request $request){
        $update = DataPegawai::where('id','=',Auth::user()->id)->first();
        $update->email = null;
        $update->save();
        $request->validate([
            'email' => 'required|unique:pegawai'
        ],
        [
            'email.unique' => 'Email sudah ada yang memakai'
        ]);
        $update->nama_pegawai = $request->nama_pegawai;
        if($request->password){
            $update->password = bcrypt($request->password);
        }
        $update->email = $request->email;
        $update->jenis_kelamin = $request->jenis_kelamin;
        $update->save();
        return back()->with('sukses', 'Sukses update data akun !');
    }
}
