@extends('admin.layout')

@section('adminlte_css')
<link rel="stylesheet" href="{{asset('lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Detail surat ukur nomor: {{$surat->nomor_surat_ukur}}</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form role="form" method="POST" enctype="multipart/form-data" action="{{route('admin.tambah-surat-ukur')}}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor surat ukur: </label>
                                <input type="text" class="form-control" name="nomor_surat_ukur" value="{{$surat->nomor_surat_ukur}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor hak: </label>
                                <input type="text" class="form-control" name="nomor_hak" value="{{$surat->nomor_hak}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor rak: </label>
                                <input type="text" class="form-control" name="nomor_rak" value="{{$surat->nomor_rak}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama pemilik: </label>
                                <input type="text" class="form-control" name="nama_pemilik" value="{{$surat->nama_pemilik}}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Kecamatan: </label>
                                <input type="text" class="form-control" name="nama_pemilik" value="{{$surat->kecamatan->nama_kecamatan}}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Kelurahan: </label>
                                <input type="text" class="form-control" name="nama_pemilik" value="{{$surat->kelurahan->nama_kelurahan}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Hasil scan: </label>
                                <img class="img-responsive" style="width: 40%;" src="{{asset($surat->path_gambar)}}" id="blah" alt="Photo">
                                <br>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-info"><i class="fa fa-fw fa-search-plus"></i>
                                    Klik disini untuk perbesar
                                </button>
                            </div>
                        </div>
                </div>
                <!-- /.box-body -->
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</section>


<div class="modal fade" id="modal-info">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Detail gambar</h3>
                    </div>
                    <div class="box-body">
                        <img class="img-responsive" src="{{asset($surat->path_gambar)}}" id="blah" alt="Photo">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('adminlte_js')
<script src="{{asset('lte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
@endsection