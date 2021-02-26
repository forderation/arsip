@extends('admin.layout')

@section('adminlte_css')
<link rel="stylesheet" href="{{asset('lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<section class="content">
    <div class="row">

        <div class="col-md-12">
            @include('message')
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" style="height: 200px; width:auto;" src="{{$pegawai->foto_profil==''? asset('logo.png'):asset($pegawai->foto_profil) }}" alt="User profile picture">
                        <h3 class="profile-username text-center">{{$pegawai->nama_pegawai}}</h3>
                        <p class="text-muted text-center">{{$pegawai->nomor_pegawai}}</p>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Detail pegawai {{$pegawai->nama_pegawai}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{route('admin.update-pegawai')}}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <input type="hidden" name="id" value="{{$pegawai->id}}" />
                                <label for="exampleInputEmail1">Alamat Email: </label>
                                <input type="email" class="form-control" name="email" placeholder="Masukkan Email" value="{{$pegawai->email}}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor Induk Pegawai: </label>
                                <input type="number" min="0" class="form-control" name="nomor_pegawai" value="{{$pegawai->nomor_pegawai}}" placeholder="Masukkan NIP" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Pegawai: </label>
                                <input type="text" min="0" value="{{$pegawai->nama_pegawai}}" class="form-control" name="nama_pegawai" placeholder="Masukkan Nama Lengkap" required>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin: </label>
                                <select name="jenis_kelamin" class="form-control" required>
                                    @if($pegawai->jenis_kelamin=="laki-laki")
                                    <option value="laki-laki" selected>Laki-laki</option>
                                    <option value="wanita">Wanita</option>
                                    @else
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="wanita" selected>Wanita</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">Rubah data</button>
                            <button class="btn btn-warning pull-left" type="button" onclick="hapusPegawai('{{$pegawai->id}}','{{$pegawai->nama_pegawai}}')">Reset password</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Riwayat pinjaman surat ukur</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor surat ukur</th>
                                <th>Nomor hak</th>
                                <th>Nama Pemilik</th>
                                <th>Tanggal pinjam</th>
                                <th>Tanggal kembali</th>
                                <th>Status dipinjam</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ?>
                            @foreach ($pinjamans as $pinjaman)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$pinjaman->surat_ukur->nomor_surat_ukur}}</td>
                                <td>{{$pinjaman->surat_ukur->nomor_hak}}</td>
                                <td>{{$pinjaman->surat_ukur->nama_pemilik}}</td>
                                <td>{{$pinjaman->tanggal_pinjam}}</td>
                                <td>{{$pinjaman->tanggal_kembali}}</td>
                                <td>{{$pinjaman->status_dipinjam}}</td>
                                <?php $no++ ?>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- modal reset --}}
<div class="modal fade" id="modal-reset">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Reset password pegawai</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('admin.reset-password-pegawai')}}">
                        @csrf
                        <div class="box-body">
                            <input type="hidden" id="id_pegawai" name="id" value="" />
                            <div class="form-group">
                                <label for="exampleInputEmail1">Apakah anda yakin ingin mereset password: </label>
                                <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" value="" disabled>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary pull-right">Reset</button>
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

    function hapusPegawai(id, nama) {
        $('#id_pegawai').val(id);
        $('#nama_pegawai').val(nama);
        $('#modal-reset').modal('show');
    }
</script>
@endsection