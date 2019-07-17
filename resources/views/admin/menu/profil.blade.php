@extends('admin.layout')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
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
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi profil admin</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form role="form" method="POST" action="{{route('admin.update-profil')}}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <input type="hidden" name="id" value="{{$admin->id}}" />
                                <label for="exampleInputEmail1">Alamat Email: </label>
                                <input type="email" class="form-control" name="email" placeholder="Masukkan Email"
                                    value="{{$admin->email}}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor Induk Pegawai: </label>
                                <input type="number" class="form-control" value="{{$admin->nomor_pegawai}}" name="nomor_pegawai" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Admin: </label>
                                <input type="text" value="{{$admin->nama_admin}}" class="form-control" name="nama_admin"
                                    placeholder="Masukkan Nama Lengkap" required>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin: </label>
                                <select name="jenis_kelamin" class="form-control" required>
                                    @if($admin->jenis_kelamin=="laki-laki")
                                    <option value="laki-laki" selected>Laki-laki</option>
                                    <option value="wanita">Wanita</option>
                                    @else
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="wanita" selected>Wanita</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Update Password Baru: </label>
                                <input type="password" class="form-control" value="" id="password" name="password"
                                    placeholder="Masukkan jika ingin merubah kata sandi">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Konfirmasi Password Lama: </label>
                                <div class="input-group input-group-sm">
                                    <input type="password" class="form-control" id="password_lama" name="password_lama"
                                        required placeholder="Masukkan kata sandi jika ingin memperbarui data" value="">
                                    <span class="input-group-btn">
                                        <button type="button" onclick="showPass()" class="btn btn-warning btn-flat"><i
                                                id="eye" class="fa fa-fw fa-eye"></i> <span id="label_password">show
                                                password</span></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="button" data-toggle="modal" data-target="#modal-atur-update" class="btn btn-primary pull-right"><i
                                    class="fa fa-fw fa-save"></i>Perbarui data</button>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.col -->
    </div>
</section>

<div class="modal fade" id="modal-atur-update">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Konfirmasi</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <label for="exampleInputEmail1">Apakah anda yakin ingin merubah data ? </label>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                        <button type="button" onclick="confSubmit()" class="btn btn-primary pull-right">Ya perbarui data</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('adminlte_js')
<script>
    function showPass() {
        if ($("#password_lama").attr("type") == "password") {
            $("#eye").attr("class", "fa fa-fw fa-eye-slash");
            $("#password_lama").attr("type", "text");
            $('#password').attr("type", "text");
            $("#label_password").text("hide password");
        } else {
            $("#label_password").text("show password");
            $("#eye").attr("class", "fa fa-fw fa-eye");
            $("#password_lama").attr("type", "password");
            $('#password').attr("type", "password");
        }
    }

    function confSubmit() {
        $('form').submit();
    }

</script>
@endsection
