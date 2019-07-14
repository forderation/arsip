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
                    <h3 class="box-title">Menu Kelola Berkas Surat Ukur</h3>
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
                        <a href="{{route('admin.tambah-surat-ukur')}}"  class="btn btn-block btn-primary"><i class="fa fa-fw fa-plus-square-o"></i> Tambah Data Surat Ukur</a>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Daftar Berkas Surat Ukur</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Rak</th>
                                <th>Nomor Surat Ukur</th>
                                <th>Nomor Hak</th>
                                <th>Nama Pemilik</th>
                                <th>Kelurahan</th>
                                <th>Kecamatan</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1?>
                            @foreach ($surats as $surat)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$surat->nomor_rak}}</td>
                                <td>{{$surat->nomor_surat_ukur}}</td>
                                <td>{{$surat->nomor_hak}}</td>
                                <td>{{$surat->nama_pemilik}}</td>
                                <td>{{$surat->kelurahan->nama_kelurahan}}</td>
                                <td>{{$surat->kecamatan->nama_kecamatan}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="/adm1n/surat-ukur/{{$surat->id}}" class="btn btn-block btn-primary"><i
                                                class="fa fa-fw fa-list-ul"></i>Detail</a>
                                    </div>
                                    <div class="btn-group">
                                        <button
                                            onclick="hapusSurat('{{$surat->id}}','{{$surat->nomor_surat_ukur}}','{{$surat->nama_pemilik}}')"
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
{{-- modal hapus --}}
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Hapus Surat</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('admin.hapus-surat')}}">
                        @csrf
                        <div class="box-body">
                            <input type="hidden" id="id_surat" name="id" value="" />
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor Surat: </label>
                                <input type="text" class="form-control" id="sku" name="nomor_surat_ukur" value=""
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Pemilik: </label>
                                <input type="text" class="form-control" name="nama_pemilik" id="nama_pemilik"
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

    function hapusSurat(id, sku, nama) {
        $('#id_surat').val(id);
        $('#sku').val(sku);
        $('#nama_pemilik').val(nama);
        $('#modal-delete').modal('show');
    }

</script>
@endsection
