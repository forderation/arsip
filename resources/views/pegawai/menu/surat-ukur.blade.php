@extends('pegawai.layout')

@section('css')
<link rel="stylesheet" href="{{asset('lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('header')
<div class="col-md-8">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Surat Berkas</h3>
    </div>
  </div>
  <!-- /.box -->
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
  @endsection