@extends('admin.layout')

@section('adminlte_css')
<link rel="stylesheet" href="{{asset('lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @include('message')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Detail surat ukur nomor: {{$surat->nomor_surat_ukur}}</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form role="form" method="POST" enctype="multipart/form-data"
                        action="update/{{$surat->id}}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor surat ukur: </label>
                                <input type="text" class="form-control" name="nomor_surat_ukur"
                                    value="{{$surat->nomor_surat_ukur}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor hak: </label>
                                <input type="text" class="form-control" name="nomor_hak" value="{{$surat->nomor_hak}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor rak: </label>
                                <input type="text" class="form-control" name="nomor_rak" value="{{$surat->nomor_rak}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama pemilik: </label>
                                <input type="text" class="form-control" name="nama_pemilik"
                                    value="{{$surat->nama_pemilik}}">
                            </div>
                            <div class="form-group">
                                <label>Kecamatan: </label>
                                <select id="kecamatan" name="id_kecamatan" class="form-control" required>
                                    <option value="">--Pilih Kecamatan--</option>
                                    @foreach ($kecamatans as $kecamatan)
                                    @if($kecamatan->id == $surat->kecamatan->id)
                                    <option selected value="{{$kecamatan->id}}"> {{$kecamatan->nama_kecamatan}}</option>
                                    @else
                                    <option value="{{$kecamatan->id}}"> {{$kecamatan->nama_kecamatan}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kelurahan: </label>
                                <select name="id_kelurahan" id="kelurahan" class="form-control" required>
                                    <option>--Pilih Kelurahan--</option>value="
                                    <option selected value="{{$surat->kelurahan->id}}">
                                        {{$surat->kelurahan->nama_kelurahan}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Hasil scan: </label>
                                <img class="img-responsive" style="width: 40%;" src="{{asset($surat->path_gambar)}}"
                                    alt="Photo">
                                <br>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modal-info"><i class="fa fa-fw fa-search-plus"></i>
                                    Klik disini untuk perbesar
                                </button>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Update scan berkas</label>
                                <input type="file" id="imgInp" name="gambar_scan">
                                <p class="help-block">format: (.jpeg, .png, .bmp) maksimal 2Mb</p>
                            </div>
                            <div class="form-group">
                                <label>Preview gambar: </label>
                                <img class="img-responsive" style="width:40%" src="#" id="blah" alt="Photo">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">Perbarui data</button>
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
