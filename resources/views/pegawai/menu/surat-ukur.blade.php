@extends('pegawai.layout')

@section('css')
<link rel="stylesheet" href="{{asset('lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('header')
<div class="col-md-10">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Pencarian berkas surat</h3>
            <br>
            <br>
            <div class="col-md-12">
            </div>
            <form role="form" method="GET" enctype="multipart/form-data" action="{{route('pegawai.cari-surat')}}">
                @csrf
                <div class="col-md-3">
                    <label>Kecamatan: </label>
                    <select id="kecamatan" name="id_kecamatan" class="form-control" required>
                        <option value="">--Pilih Kecamatan--</option>
                        @foreach ($kecamatans as $kecamatan)
                        <option value="{{$kecamatan->id}}"> {{$kecamatan->nama_kecamatan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Kelurahan: </label>
                    <select name="id_kelurahan" id="kelurahan" class="form-control" required>
                        <option>--Pilih Kelurahan--</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Nomor surat: </label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Masukkan nomor surat ukur" name="surat">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-fw fa-search"></i>
                                cari</button>
                        </span>
                    </div>
                </div>
            </form>
            <div class="col-md-12">
                <br>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-gray"><i class="fa fa-files-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total berkas</span>
                    <span class="info-box-number">{{$total}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fa fa-fw fa-file-text"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tersedia</span>
                    <span class="info-box-number">{{$tersedia}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-fw fa-ban"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tidak tersedia</span>
                    <span class="info-box-number">{{$tidak_tersedia}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
    <div class="col-md-12">
        @foreach($surats as $sur)
        <div class="col-md-3">
            <!-- small box -->
            @if($sur->ketersediaan=="tersedia")
            <div class="small-box bg-blue">
                @else
                <div class="small-box bg-yellow">
                    @endif
                    <div class="inner">
                        <h4>{{$sur->nomor_surat_ukur}}</h4>
                        Pemilik: {{$sur->nama_pemilik}}
                        <br>
                        Kecamatan: {{$sur->kecamatan->nama_kecamatan}}
                        <br>
                        Kelurahan: {{$sur->kelurahan->nama_kelurahan}}
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="/surat-ukur/{{$sur->id}}" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Navigasi</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        {{$surats->links()}}
                        <br>
                        Halaman : {{ $surats->currentPage() }} <br />
                        Jumlah Data : {{ $surats->total() }} <br />
                        Data Per Halaman : {{ $surats->perPage() }} <br />
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @endsection

    @section('js')
    <script>
        $(document).ready(function () {
            $('#kecamatan').change(function () {
                var kecamatanID = $(this).val();
                if (kecamatanID) {
                    $.ajax({
                        type: "GET",
                        url: "{{url('adm1n/surat-ukur/daftar-kelurahan')}}?id_kecamatan=" +
                            kecamatanID,
                        success: function (res) {
                            if (res) {
                                $("#kelurahan").empty();
                                $("#kelurahan").append('<option>Select</option>');
                                $.each(res, function (key, value) {
                                    $("#kelurahan").append('<option value="' + key +
                                        '">' + value + '</option>');
                                });

                            } else {
                                $("#kelurahan").empty();
                            }
                        }
                    });
                } else {
                    $("#kelurahan").empty();
                }
            });
        });

    </script>
    @endsection
