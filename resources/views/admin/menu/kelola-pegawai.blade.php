@extends('admin.layout')

@section('adminlte_css')
<link rel="stylesheet" href="{{asset('lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @include('message')
            @if ($errors->has('nama_pegawai'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ $errors->first('nama_pegawai') }}
            </div>
            @endif
            @if ($errors->has('nomor_pegawai'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ $errors->first('nomor_pegawai') }}
            </div>
            @endif
            @if ($errors->has('email'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ $errors->first('email') }}
            </div>
            @endif
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Menu Kelola Pegawai</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="">
                    <div class="btn-group">
                        <button type="button" data-toggle="modal" data-target="#modal-default"
                            class="btn btn-block btn-primary"><i class="fa fa-user-plus"></i> Tambah Pegawai</button>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Daftar Pegawai</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Induk Pegawai</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Jenis Kelamin</th>
                                <th>Validitas</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1?>
                            @foreach ($pegawais as $pegawai)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$pegawai->nomor_pegawai}}</td>
                                <td>{{$pegawai->nama_pegawai}}</td>
                                <td>{{$pegawai->email}}</td>
                                <td>{{$pegawai->jenis_kelamin}}</td>
                                <td>
                                    @if($pegawai->validitas=="valid")
                                        <span class="label bg-green" style="font-size: 12px;">valid</span>
                                    @else
                                        <span class="label bg-yellow" style="font-size: 12px;">tidak valid</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="/adm1n/kelola-pegawai/{{$pegawai->id}}" class="btn btn-block btn-primary"><i
                                                class="fa fa-fw fa-list-ul"></i>Detail</a>
                                    </div>
                                    <div class="btn-group">
                                        <button
                                            onclick="hapusPegawai('{{$pegawai->id}}','{{$pegawai->nomor_pegawai}}','{{$pegawai->nama_pegawai}}')"
                                            type="button" class="btn btn-block btn-danger"><i
                                                class="fa fa-fw fa-trash-o"></i>Hapus</button>
                                    </div>
                                </td>
                                <?php $no++?>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

{{-- modal tambah --}}
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tambah Pegawai</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{route('admin.tambah-pegawai')}}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat Email: </label>
                                <input type="email" class="form-control" name="email" placeholder="Masukkan Email"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor Induk Pegawai: </label>
                                <input type="number" min="0" class="form-control" name="nomor_pegawai"
                                    placeholder="Masukkan NIP" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Pegawai: </label>
                                <input type="text" min="0" class="form-control" name="nama_pegawai"
                                    placeholder="Masukkan Nama Lengkap" required>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin: </label>
                                <select name="jenis_kelamin" class="form-control" required>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="wanita">Wanita</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal hapus --}}
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Hapus Pegawai</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('admin.hapus-pegawai')}}">
                        @csrf
                        <div class="box-body">
                            <input type="hidden" id="id_pegawai" name="id" value="" />
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor Induk Pegawai: </label>
                                <input type="number" min="0" class="form-control" id="nip" name="nomor_pegawai" value=""
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Pegawai: </label>
                                <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai"
                                    value="" disabled>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary pull-right">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('adminlte_js')
<script src="{{asset('lte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $(function () {
            $('#example1').DataTable()
        })
    });

    function hapusPegawai(id, nip, nama) {
        $('#id_pegawai').val(id);
        $('#nip').val(nip);
        $('#nama_pegawai').val(nama);
        $('#modal-delete').modal('show');
    }

</script>
@endsection
