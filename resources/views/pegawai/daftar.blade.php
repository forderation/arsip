@extends('login.login')
@section('form')
@include('message')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<p class="login-box-msg">Silahkan isi data terlebih dahulu untuk mendaftar</p>
<form action="{{route('pegawai.daftar-submit')}}" method="post">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Nomor Induk Pegawai: </label>
        <input type="number" min="0" class="form-control" name="nomor_pegawai" placeholder="Masukkan NIP" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Nama Pegawai: </label>
        <input type="text" min="0" class="form-control" name="nama_pegawai" placeholder="Masukkan Nama Lengkap"
            required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Alamat Email: </label>
        <input type="email" class="form-control" name="email" placeholder="Masukkan Email" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Password: </label>
        <input type="password" class="form-control" name="password" placeholder="Masukkan Kata Sandi" required>
    </div>    
    <div class="form-group">
        <label>Jenis Kelamin: </label>
        <select name="jenis_kelamin" class="form-control" required>
            <option value="laki-laki">Laki-laki</option>
            <option value="wanita">Wanita</option>
        </select>
    </div>
    <div class="row">
        <div class="col-xs-8">
            <div class="checkbox icheck">
                <label>
                    <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false"
                        style="position: relative;"><input required type="checkbox"
                            style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins
                            class="iCheck-helper"
                            style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                    </div> I agree to the <a href="#">terms</a>
                </label>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-6">
                    <a href="{{route('pegawai.login')}}" class="btn btn-warning btn-block btn-flat"><i
                            class="fa fa-fw fa-toggle-left"></i>Login</a>
                </div>
                <div class="col-xs-6">
                    <button type="submit" class="btn btn-primary btn-block btn-flat"><i
                            class="fa fa-fw fa-paper-plane"></i>Daftar</button>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
</form>
@endsection
