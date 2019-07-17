@extends('pegawai.layout')

@section('css')
<link rel="stylesheet" href="{{asset('lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('header')
<h2>Detail Surat Ukur</h2>
@endsection

@section('content')
<div class="row">
    <div class="row">
        <div class="col-md-12">
            @include('message')
            @if($surat->ketersediaan=="tersedia")
            <div class="box box-primary box-solid">
                @else
                <div class="box box-warning box-solid">
                    @endif
                    <div class="box-header with-border">
                        <h3 class="box-title">Detail surat ukur nomor: {{$surat->nomor_surat_ukur}}</h3>
                        <div class="box-tools pull-right">
                            <a href="/surat-ukur" class="btn btn-box-tool"><i class="fa fa-fw fa-eject"></i>
                            </a>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-6">
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Hasil scan: </label>
                                <button style="margin: 10px;" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-info"><i class="fa fa-fw fa-search-plus"></i>
                                    Klik disini untuk perbesar
                                </button>
                                <img class="img-responsive" style="width: 60%;" src="{{asset($surat->path_gambar)}}" id="blah" alt="Photo">
                            </div>
                        </div>
                        <div class="col-md-12">
                            @if($surat->ketersediaan=="tersedia")
                            <a href="#" class="pull-right btn-lg btn btn-success" data-toggle="modal" data-target="#modal-pinjam-surat"><i class="fa fa-fw fa-save"></i> Pinjam surat ukur</a>
                            @else
                            <a href="#" class="pull-right btn-lg btn btn-success" disabled><i class="fa fa-fw fa-save"></i> Surat tidak tersedia</a>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>


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

<div class="modal fade" id="modal-pinjam-surat">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pinjam surat</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{route('pegawai.pinjam-surat')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$surat->id}}"/>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor surat ukur: </label>
                                <input type="text" class="form-control" value="{{$surat->nomor_surat_ukur}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama pemilik: </label>
                                <input type="text" class="form-control" value="{{$surat->nama_pemilik}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Batas terakhir kembalikan: </label>
                                <input type="text" class="form-control" value="{{$batas_durasi}}" disabled>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-fw fa-save"></i> Pinjam</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection