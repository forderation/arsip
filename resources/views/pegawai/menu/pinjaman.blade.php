@extends('pegawai.layout')

@section('css')
<link rel="stylesheet" href="{{asset('lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('header')
<h3>Detail Riwayat Pinjaman</h3>
@endsection

@section('content')
<div class="row">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Riwayat pinjaman surat</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body" style="overflow-y: scroll;">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor surat</th>
                                <th>Nama Pemilik</th>
                                <th>Tanggal pinjam</th>
                                <th>Tanggal kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1?>
                            @foreach ($pinjamans as $pinjaman)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$pinjaman->surat_ukur->nomor_surat}}</td>
                                <td>{{$pinjaman->surat_ukur->nama_pemilik}}</td>
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
                                <td>
                                    @if($pinjaman->tanggal_kembali!=null)
                                        @if($pinjaman->tanggal_kembali<$pinjaman->batas_akhir_kembali)
                                            <span class="label bg-green" style="font-size: 12px;">{{$pinjaman->status_dipinjam}}</span>
                                        @else
                                            <span class="label bg-red" style="font-size: 12px;">pengembalian lewat batas</span>
                                        @endif
                                    @else
                                        @if($pinjaman->status_dipinjam=="menunggu persetujuan")
                                            <span class="label bg-yellow" style="font-size: 12px;">{{$pinjaman->status_dipinjam}}</span>
                                        @else
                                            @if($pinjaman->status_dipinjam=="masih dipinjam")
                                                <span class="label bg-yellow" style="font-size: 12px;">{{$pinjaman->status_dipinjam}}</span>
                                            @else
                                                <span class="label bg-red" style="font-size: 12px;">{{$pinjaman->status_dipinjam}}</span>
                                            @endif
                                        @endif
                                    @endif
                                </td>
                                <?php $no++?>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('lte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $(function () {
            $('#example1').DataTable()
        })
    });

</script>
@endsection
