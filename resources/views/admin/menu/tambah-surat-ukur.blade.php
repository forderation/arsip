@extends('admin.layout')

@section('adminlte_css')
<link rel="stylesheet" href="{{asset('lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @include('message')
            @if ($errors->has('nomor_surat_ukur'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ $errors->first('nomor_surat_ukur') }}
            </div>
            @endif
            @if ($errors->has('nomor_hak'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ $errors->first('nomor_hak') }}
            </div>
            @endif
            @if ($errors->has('nomor_rak'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ $errors->first('nomor_rak') }}
            </div>
            @endif
            @if ($errors->has('nama_pemilik'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ $errors->first('nama_pemilik') }}
            </div>
            @endif
            @if ($errors->has('id_kecamatan'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ $errors->first('id_kecamatan') }}
            </div>
            @endif
            @if ($errors->has('id_kelurahan'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ $errors->first('id_kelurahan') }}
            </div>
            @endif
            @if ($errors->has('gambar_scan'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ $errors->first('gambar_scan') }}
            </div>
            @endif
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah berkas surat ukur</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" enctype="multipart/form-data" action="{{route('admin.tambah-surat-ukur')}}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor surat ukur: </label>
                            <input type="text" class="form-control" name="nomor_surat_ukur" placeholder="Masukkan nomor surat ukur" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor hak: </label>
                            <input type="text" class="form-control" name="nomor_hak" placeholder="Masukkan nomor hak" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor rak: </label>
                            <input type="text" class="form-control" name="nomor_rak" placeholder="Masukkan nomor rak" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama pemilik: </label>
                            <input type="text" class="form-control" name="nama_pemilik" placeholder="Masukkan nama pemilik" required>
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
                        <div class="form-group">
                            <label>Kelurahan: </label>
                            <select name="id_kelurahan" id="kelurahan" class="form-control" required>
                                <option>--Pilih Kelurahan--</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Hasil scan berkas</label>
                            <input type="file" id="imgInp" name="gambar_scan">
                            <p class="help-block">format: (.jpeg, .png, .bmp) maksimal 2Mb</p>
                        </div>
                        <div class="form-group">
                            <label>Preview gambar: </label>
                            <img class="img-responsive" style="width:40%" src="#" id="blah" alt="Photo">
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Submit data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('adminlte_js')
<script>
    $(document).ready(function() {
        $('#kecamatan').change(function() {
            var kecamatanID = $(this).val();
            if (kecamatanID) {
                $.ajax({
                    type: "GET",
                    url: "{{url('adm1n/surat-ukur/daftar-kelurahan')}}?id_kecamatan=" + kecamatanID,
                    success: function(res) {
                        if (res) {
                            $("#kelurahan").empty();
                            $("#kelurahan").append('<option>Select</option>');
                            $.each(res, function(key, value) {
                                $("#kelurahan").append('<option value="' + key + '">' + value + '</option>');
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

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function() {
        readURL(this);
    });
</script>
@endsection