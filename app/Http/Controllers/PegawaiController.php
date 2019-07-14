<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SuratUkur;
use Carbon\Carbon;
use App\Informasi;
use App\Pinjaman;
use Auth;
class PegawaiController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:pegawai');
    }

    public function index()
    {
        return view('pegawai.menu.dashboard');
    }

    public function surat_ukur(){
        $surats =  SuratUkur::paginate(10);
        $total = SuratUkur::all()->count();
        $tersedia = SuratUkur::where('ketersediaan','tersedia')->count();
        $tidak_tersedia = SuratUkur::where('ketersediaan','tidak tersedia')->count();
        return view('pegawai.menu.surat-ukur',
        ['surats'=>$surats,'tersedia'=>$tersedia,'tidak_tersedia'=>$tidak_tersedia,'total'=>$total]);
    }

    public function detail_surat_ukur($id){
        $surat = SuratUkur::where('id',$id)->first();
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
}