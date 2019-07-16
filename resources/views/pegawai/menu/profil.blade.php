@extends('pegawai.layout')

@section('css')
<link rel="stylesheet" href="{{asset('lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('header')
<h3>Informasi akun</h3>
@endsection

@section('content')
<div class="row">
    <div class="row">
        <div class="col-md-12">
            @include('message')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Kelola profil</h3>
                </div>
                <!-- /.box-header -->
                <form role="form"  method="POST" action="{{route('pegawai.update-profil')}}">
                    @csrf
                    <div class="box-body">
                    <div class="form-group">
                            <input type="hidden" name="id" value="{{$pegawai->id}}"/>
                                <label for="exampleInputEmail1">Alamat Email: </label>
                                <input type="email" class="form-control" name="email" placeholder="Masukkan Email" value="{{$pegawai->email}}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor Induk Pegawai: </label>
                                <input type="number" class="form-control" value="{{$pegawai->nomor_pegawai}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Pegawai: </label>
                                <input type="text" value="{{$pegawai->nama_pegawai}}" class="form-control" name="nama_pegawai"
                                    placeholder="Masukkan Nama Lengkap" required>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin: </label>
                                <select name="jenis_kelamin" class="form-control" required>
                                    @if($pegawai->jenis_kelamin=="laki-laki")
                                        <option value="laki-laki" selected>Laki-laki</option>
                                        <option value="wanita">Wanita</option>
                                    @else
                                        <option value="laki-laki">Laki-laki</option>
                                        <option value="wanita" selected>Wanita</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password: </label>
                                <input type="password" class="form-control" name="password" placeholder="Masukkan jika ingin merubah kata sandi">
                            </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-fw fa-save"></i>Perbarui data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
