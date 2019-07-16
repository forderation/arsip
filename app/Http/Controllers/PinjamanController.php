<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pinjaman;
use App\Informasi;
use App\SuratUkur;
use Carbon\Carbon;
class PinjamanController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        //
        $pinjamans = Pinjaman::all();
        $batas_durasi = Informasi::where('id',1)->first()->batas_akhir_kembali;
        return view('admin.menu.pinjaman',compact('pinjamans','batas_durasi'));
    }

    public function update_batas_akhir(Request $request){
        $batas_durasi = Informasi::where('id',1)->first();
        $batas_durasi->batas_akhir_kembali = $request->batas_akhir;
        $batas_durasi->save();
        return back()->with('sukses', 'Sukses merubah batas durasi :'.$batas_durasi->batas_akhir_kembali.' hari');
    }

    public function update_status_pinjaman(Request $request){
        $id = $request->id;
        $status = $request->pinjaman;
        $id_surat = $request->id_surat;
        $surat = SuratUkur::where('id',$id_surat)->first();
        if($status=="masih dipinjam"){
            $data_pinjam = Pinjaman::where('id_surat_ukur',$id_surat)->where('status_dipinjam','menunggu persetujuan')->get();
            foreach($data_pinjam as $data){
                $data->status_dipinjam = "pengajuan dibatalkan";
                $data->save();
            }
            $data_pinjam = Pinjaman::where('id',$id)->first();
            $data_pinjam->status_dipinjam = $status;
            $data_pinjam->save();
            $surat->ketersediaan = "tidak tersedia";
            $surat->save();
        }
        return back()->with('sukses', 'Sukses merubah status surat nomor:'.
        $surat->nomor_surat_ukur.' menjadi: '.$status);
    }

    public function pinjaman_selesai(Request $request){
        $id = $request->id;
        $id_surat = $request->id_surat;
        $surat = SuratUkur::where('id',$id_surat)->first();
        $surat->ketersediaan = "tersedia";
        $surat->save();
        $data_pinjam = Pinjaman::where('id',$id)->first();
        $data_pinjam->status_dipinjam = "pinjaman selesai";
        $data_pinjam->tanggal_kembali = Carbon::now();
        $data_pinjam->save();
        return back()->with('sukses', 'Sukses merubah status surat nomor:'.
        $surat->nomor_surat_ukur.' menjadi: '.$data_pinjam->status_dipinjam);
    }
}
