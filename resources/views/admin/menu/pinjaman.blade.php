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
                    <h3 class="box-title">Menu Kelola Pinjaman</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="">
                    <div class="btn-group">
                        <button type="button" data-toggle="modal" data-target="#modal-atur-standar" class="btn btn-block btn-primary"><i class="fa fa-fw fa-cog"></i> Atur standar pinjaman</button>
                    </div>
                    <div class="btn-group" style="margin-left:20px;">
                        <h4>Batas maksimal durasi pinjaman saat ini <span class="label label-primary">{{$batas_durasi}}</span> hari</h4>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Daftar berkas pinjaman surat ukur</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Surat</th>
                                <th>Peminjam</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Kembali</th>
                                <th>Batas akhir</th>
                                <th>Status Pinjaman</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ?>
                            @foreach ($pinjamans as $pinjaman)
                            <tr>
                                <td>{{$no}}</td>
                                <td><a href="surat-ukur/{{$pinjaman->surat_ukur->id}}">{{$pinjaman->surat_ukur->nomor_surat}}</a></td>
                                <td><a href="kelola-pegawai/{{$pinjaman->peminjam->id}}">{{$pinjaman->peminjam->nama_pegawai}}</a></td>
                                <td>{{$pinjaman->tanggal_pinjam}}</td>
                                <td>
                                    @if($pinjaman->status_dipinjam=="menunggu persetujuan" || $pinjaman->status_dipinjam=="masih dipinjam")
                                        <span class="label bg-yellow" style="font-size: 12px;">{{$pinjaman->status_dipinjam}}</span>
                                    @elseif($pinjaman->status_dipinjam=="pengajuan dibatalkan")
                                        <span class="label bg-red" style="font-size: 12px;">{{$pinjaman->status_dipinjam}}</span>
                                    @else
                                        <span class="label bg-green" style="font-size: 12px;">{{$pinjaman->tanggal_kembali}}</span>                                        
                                    @endif
                                </td>
                                <td>{{$pinjaman->batas_akhir_kembali}}</td>
                                <td>
                                    @if($pinjaman->status_dipinjam=="masih dipinjam")
                                    <form role="form" method="post" action="{{route('admin.update-pinjaman-selesai')}}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$pinjaman->id}}"/>
                                        <input type="hidden" name="id_surat" value="{{$pinjaman->surat_ukur->id}}"/>
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-check"></i> atur selesai</button>
                                        </div>
                                    </form>
                                    @else
                                        @if($pinjaman->tanggal_kembali!=null)
                                            @if($pinjaman->tanggal_kembali<$pinjaman->batas_akhir_kembali)
                                                <span class="label bg-green" style="font-size: 12px;">{{$pinjaman->status_dipinjam}}</span>
                                            @else
                                                <span class="label bg-red" style="font-size: 12px;">pengembalian lewat batas</span>
                                            @endif
                                        @else
                                            @if($pinjaman->status_dipinjam=="menunggu persetujuan")
                                                <form role="form" method="post" action="{{route('admin.update-status-pinjaman')}}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$pinjaman->id}}"/>
                                                    <input type="hidden" name="id_surat" value="{{$pinjaman->surat_ukur->id}}"/>
                                                    <div class="input-group margin" style="margin:0px">
                                                        <div class="input-group-btn">
                                                            <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-cog"></i> atur</button>
                                                        </div>
                                                        <!-- /btn-group -->
                                                        <select name="pinjaman" class="form-control" required>
                                                            <option value="masih dipinjam">setujui pinjaman</option>
                                                            <option value="pengajuan dibatalkan">tolak pinjaman</option>
                                                        </select>
                                                    </div>
                                                </form>
                                            @else
                                                <span class="label bg-red" style="font-size: 12px;">{{$pinjaman->status_dipinjam}}</span>
                                            @endif
                                        @endif
                                    @endif
                                </td>
                                <?php $no++ ?>
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
<div class="modal fade" id="modal-atur-standar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Atur batas akhir kembali</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{route('admin.update-batas-pinjaman')}}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Batas durasi maksimal pinjaman (hari): </label>
                                <input type="number" min="0" class="form-control" name="batas_akhir" value="{{$batas_durasi}}" placeholder="Masukkan batas durasi (hari)" required>
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
@endsection

@section('adminlte_js')
<script src="{{asset('lte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $(function() {
            $('#example1').DataTable()
        })
    });
</script>
@endsection