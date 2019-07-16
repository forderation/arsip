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
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Menu Kelola Wilayah</h3>
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
                        <button type="button" data-toggle="modal" data-target="#modal-tambah-kecamatan"
                            class="btn btn-block btn-info" style="color:black;"><i class="fa fa-fw fa-th-large"></i> Tambah
                            Kecamatan</button>
                    </div>
                    <div class="btn-group pull-right">
                        <button type="button" data-toggle="modal" data-target="#modal-tambah-kelurahan"
                            class="btn btn-block btn-success"><i class="fa fa-fw fa-indent"></i> Tambah
                            Kelurahan</button>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-6">
            <div class="box box-info box-solid">
                <div class="box-header">
                    <h3 class="box-title" style="color:black;">Daftar Kecamatan</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kecamatan</th>
                                <th>Total Kelurahan</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1?>
                            @foreach ($kecamatans as $kecamatan)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$kecamatan->nama_kecamatan}}</td>
                                <td>{{$kecamatan->kelurahan->count()}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button
                                            onclick="hapusKecamatan('{{$kecamatan->id}}','{{$kecamatan->nama_kecamatan}}')"
                                            type="button" class="btn btn-block btn-danger"><i
                                                class="fa fa-fw fa-trash-o"></i></button>
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
        <div class="col-md-6">
            <div class="box box-success box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Kelurahan</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kecamatan</th>
                                <th>Nama Kelurahan</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1?>
                            @foreach ($kelurahans as $kelurahan)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$kelurahan->kecamatan->nama_kecamatan}}</td>
                                <td>{{$kelurahan->nama_kelurahan}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button
                                            onclick="hapusKelurahan('{{$kelurahan->id}}','{{$kelurahan->nama_kelurahan}}')"
                                            type="button" class="btn btn-block btn-danger"><i
                                                class="fa fa-fw fa-trash-o"></i></button>
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
    </div>
    <!-- /.row -->
</section>

{{-- modal tambah --}}
<div class="modal fade" id="modal-tambah-kecamatan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tambah Kecamatan</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{route('admin.tambah-kecamatan')}}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Kecamatan: </label>
                                <input type="text" class="form-control" name="nama_kecamatan"
                                    placeholder="Masukkan nama kecamatan" required>
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

{{-- modal tambah --}}
<div class="modal fade" id="modal-tambah-kelurahan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tambah Kelurahan</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{route('admin.tambah-kelurahan')}}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Kelurahan: </label>
                                <input type="text" class="form-control" name="nama_kelurahan"
                                    placeholder="Masukkan nama kecamatan" required>
                            </div>
                            <div class="form-group">
                                <label>Kecamatan: </label>
                                <select id="kecamatan" name="id_kecamatan" class="form-control" required>
                                    <option value="">--Pilih Kecamatan--</option>
                                    @foreach ($kecamatans as $kecamatan)
                                    <option value="{{$kecamatan->id}}"> {{$kecamatan->nama_kecamatan}}</option>
                                    @endforeach
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
<div class="modal fade" id="modal-delete-kecamatan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Hapus Kecamatan</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('admin.hapus-kecamatan')}}">
                        @csrf
                        <div class="box-body">
                            <input type="hidden" id="id_kecamatan" name="id" value="" />
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Kecamatan: </label>
                                <input type="text" class="form-control" id="rm_kecamatan" value="" disabled>
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

{{-- modal hapus --}}
<div class="modal fade" id="modal-delete-kelurahan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Hapus Kelurahan</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('admin.hapus-kelurahan')}}">
                        @csrf
                        <div class="box-body">
                            <input type="hidden" id="id_kelurahan" name="id" value="" />
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Kelurahan: </label>
                                <input type="text" class="form-control" id="rm_kelurahan" value="" disabled>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success pull-right">Hapus</button>
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
            $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
            $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
        })
    });

    function hapusKecamatan(id, kecamatan) {
        $('#id_kecamatan').val(id);
        $('#rm_kecamatan').val(kecamatan);
        $('#modal-delete-kecamatan').modal('show');
    }

    function hapusKelurahan(id, kelurahan) {
        $('#id_kelurahan').val(id);
        $('#rm_kelurahan').val(kelurahan);
        $('#modal-delete-kelurahan').modal('show');
    }

</script>
@endsection
