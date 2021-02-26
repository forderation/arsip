<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Pengarsipan Berkas | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('lte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('lte/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('lte/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('lte/bower_components/jvectormap/jquery-jvectormap.css')}}">
    @yield('css')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('lte/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('lte/dist/css/skins/_all-skins.min.css')}}">
    <link rel="icon" href="{{asset('logo.png')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="/" class="navbar-brand"><img style="width:30px; margin-right:5px; display:inline;" class="img-responsive img-circle" src="{{asset('logo.png')}}" alt="User profile picture"> Sistem <b>Arsip</b> Berkas</a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li
                                class="{{request()->is('surat-ukur/*') || request()->is('surat-ukur') ? 'active' : ''}}">
                                <a href="{{route('pegawai.surat-ukur')}}">
                                    <i class="fa fa-fw fa-file-text"></i><span> Surat Ukur</span>
                                </a>
                            </li>
                            <li
                                class="{{request()->is('pinjaman/*') || request()->is('pinjaman') ? 'active' : ''}}">
                                <a href="{{route('pegawai.show_pinjaman')}}">
                                    <i class="fa fa-fw fa-history"></i><span> Riwayat Pinjaman</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu {{request()->is('profil') ? 'active' : ''}}">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="{{\Auth::user()->foto_profil==''? asset('logo.png'):asset(\Auth::user()->foto_profil) }}" class="user-image" alt="User Image">
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs">{{\Auth::user()->nama_pegawai}}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <img src="{{\Auth::user()->foto_profil==''? asset('logo.png'):asset(\Auth::user()->foto_profil) }}" alt="User Image">
                                        <p style="font-size: 14px">
                                            Nomor Induk Pegawai:
                                        </p>
                                        <p style="font-size: 14px">
                                        {{\Auth::user()->nomor_pegawai}}
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="{{route('pegawai.show-profil')}}" class="btn btn-primary btn-flat"><i class="fa fa-fw fa-user"></i> Profil</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{route('pegawai.logout')}}" class="btn btn-warning btn-flat"><i class="fa fa-fw fa-eject"></i> Keluar</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-custom-menu -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </header>
        <!-- Full Width Column -->
        <div class="content-wrapper">
            <div class="container">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    @yield('header')
                    <ol class="breadcrumb">
                        <i class="fa fa-dashboard"> </i>
                        <?php $segments = ''; ?>
                        @foreach(Request::segments() as $segment)

                        <?php $segments .= '/'.$segment; ?>
                        @if($loop->last)
                        <li class="active">
                            {{ucwords(str_replace("_", " ", $segment))}}
                        </li>
                        @else
                        <li>
                            @if(is_numeric($segment))
                            @yield('id_name')
                            @else
                            <a href=" {{ $segments }}">{{ucwords(str_replace("_", " ", $segment))}}</a>
                            @endif
                        </li>
                        @endif
                        @endforeach
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section>
                <!-- /.content -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="container">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0
                </div>
                <strong>Copyright &copy; 2019 Developed by <a href="https://mail.google.com/mail/u/0/?view=cm&fs=1&tf=1&to=kharisma.muzaki@gmail.com">Kharisma Muzaki G.</a>. Template by <a href="https://adminlte.io">Admin LTE</a>.</strong> All
                rights
                reserved.
            </div>
            <!-- /.container -->
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="{{asset('lte/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('lte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('lte/bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('lte/dist/js/adminlte.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('lte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
    <!-- jvectormap  -->
    <script src="{{asset('lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{asset('lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.j')}}s"></script>
    <!-- SlimScroll -->
    <script src="{{asset('lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('lte/bower_components/chart.js/Chart.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('lte/dist/js/pages/dashboard2.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('lte/dist/js/demo.js')}}"></script>
    @yield('js')
</body>

</html>
