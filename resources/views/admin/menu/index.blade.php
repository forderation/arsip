@extends('admin.layout')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            @include('message')
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Informasi dashboard admin</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>{{$total_pegawai}}</h3>
                                <p>Total akun pegawai valid</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <a href="{{route('admin.kelola-pegawai')}}" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>{{$pinjaman}}</h3>
                                <p>Total pinjaman</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-fw fa-server"></i>
                            </div>
                            <a href="{{route('admin.pinjaman')}}" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>{{$surat_ukur}}</h3>
                                <p>Total berkas surat ukur</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-fw fa-file-text-o"></i>
                            </div>
                            <a href="{{route('admin.surat-ukur')}}" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-fuchsia">
                            <div class="inner">
                                <h3>{{$kelurahan}}</h3>
                                <p>Total wilayah kelurahan</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-fw fa-pie-chart"></i>
                            </div>
                            <a href="{{route('admin.wilayah')}}" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Menunggu untuk divalidasi</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
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
                                    <button
                                        onclick="validasiPegawai('{{$pegawai->id}}','{{$pegawai->nomor_pegawai}}','{{$pegawai->nama_pegawai}}')"
                                        type="button" class="btn btn-success"><i
                                            class="fa fa-fw fa-check"></i>validasi</button>
                                </td>
                                <?php $no++?>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.col -->
    </div>
</section>


<div class="modal fade" id="modal-validasi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Validasi Pegawai</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('admin.validasi-pegawai')}}">
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
                                <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" value=""
                                    disabled>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary pull-right">Validasi</button>
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

    function validasiPegawai(id, nip, nama) {
        $('#id_pegawai').val(id);
        $('#nip').val(nip);
        $('#nama_pegawai').val(nama);
        $('#modal-validasi').modal('show');
    }

</script>
@endsection
