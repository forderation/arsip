<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataPegawai;

class KelolaPegawaiController extends Controller
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
        $pegawais = DataPegawai::all();
        return view('admin.menu.kelola-pegawai',compact('pegawais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pegawai' => 'required',
            'nomor_pegawai' => 'required|unique:pegawai',
            'email' => 'required|unique:pegawai',
            'jenis_kelamin' => 'required'
        ],
        [
            'nama_pegawai.required' => 'Nama pegawai harus dimasukkan',
            'nomor_pegawai.required' => 'Nomor pegawai harus dimasukkan',
            'email.required' => 'Email pegawai harus dimasukkan'
        ]);
        $new = new DataPegawai();
        $new->nama_pegawai = $request->nama_pegawai;
        $new->nomor_pegawai = $request->nomor_pegawai;
        $new->email = $request->email;
        $new->jenis_kelamin = $request->jenis_kelamin;
        $new->validitas = "valid";
        $new->save();
        $password = substr(md5($new->nama_pegawai),0,7);
        $new->password = bcrypt($password);
        $new->save();
        return back()->with('sukses', 'Sukses menambah data pegawai password default: '.$new->password);
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
        $pegawai = DataPegawai::where('id','=',$id)->first();
        $pinjamans = $pegawai->pinjaman_surat()->get();
        return view('admin.menu.detail-pegawai',compact('pegawai','pinjamans'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reset_password(Request $request)
    {
        $new = DataPegawai::where('id','=',$request->id)->first();
        $password = substr(md5($new->nama_pegawai),0,7);
        $new->password = bcrypt($password);
        $new->save();
        return back()->with('sukses', 'Sukses reset password anda: '.$password);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $update = DataPegawai::where('id','=',$request->id)->first();
        $update->nomor_pegawai = null;
        $update->email = null;
        $update->save();
        $request->validate([
            'nama_pegawai' => 'required',
            'nomor_pegawai' => 'required|unique:pegawai',
            'email' => 'required|unique:pegawai',
            'jenis_kelamin' => 'required'
        ],
        [
            'nama_pegawai.required' => 'Nama pegawai harus dimasukkan',
            'nomor_pegawai.required' => 'Nomor pegawai harus dimasukkan',
            'email.require' => 'Email pegawai harus dimasukkan'
        ]);
        $new = DataPegawai::where('id','=',$request->id)->first();
        $new->nama_pegawai = $request->nama_pegawai;
        $new->nomor_pegawai = $request->nomor_pegawai;
        $new->email = $request->email;
        $new->jenis_kelamin = $request->jenis_kelamin;
        $new->save();
        return back()->with('sukses', 'Sukses update data pegawai !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $destroy = DataPegawai::findOrFail($request->id);
        $destroy->delete();
        return redirect()->back()->with('sukses', 'Sukses menghapus data pegawai !');
    }
}
