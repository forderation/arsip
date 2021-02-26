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
    @yield('adminlte_css')
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

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">

            <!-- Logo -->
            <a href="#" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>M</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Daftar Menu</b></span>
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu {{request()->is('adm1n/profil') ? 'active' : ''}}">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="https://i.pinimg.com/originals/f4/78/98/f478985436994fe759d9c265fc591608.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{\Auth::user()->get_nama()}}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="https://i.pinimg.com/originals/f4/78/98/f478985436994fe759d9c265fc591608.jpg" class="img-circle" alt="User Image">
                                    <p>
                                        <small>Nomor Pegawai:
                                            <br> {{\Auth::user()->nomor_pegawai}}</small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{route('admin.show-profil')}}" class="btn btn-primary btn-flat"><i class="fa fa-fw fa-user"></i> Profil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{route('admin.logout')}}" class="btn btn-warning btn-flat"><i class="fa fa-fw fa-eject"></i> Keluar</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{asset('logo.png')}}" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>{{\Auth::user()->get_nama()}}</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="{{request()->is('adm1n/index/*') || request()->is('adm1n/index') ? 'active open' : ''}}">
                        <a href="{{route('admin.dashboard')}}">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li
                        class="{{request()->is('adm1n/kelola-pegawai/*') || request()->is('adm1n/kelola-pegawai') ? 'active open' : ''}}">
                        <a href="{{route('admin.kelola-pegawai')}}">
                            <i class="fa fa-users"></i> <span>Kelola Pegawai</span>
                        </a>
                    </li>
                    <li
                        class="{{request()->is('adm1n/surat-ukur/*') || request()->is('adm1n/surat-ukur') ? 'active open' : ''}}">
                        <a href="{{route('admin.surat-ukur')}}">
                            <i class="fa fa-fw fa-file-text-o"></i> <span>Kelola Surat Ukur</span>
                        </a>
                    </li>
                    <li
                        class="{{request()->is('adm1n/wilayah/*') || request()->is('adm1n/wilayah') ? 'active open' : ''}}">
                        <a href="{{route('admin.wilayah')}}">
                            <i class="fa fa-fw fa-pie-chart"></i> <span>Kelola Wilayah</span>
                        </a>
                    </li>
                    <li
                        class="{{request()->is('adm1n/pinjaman/*') || request()->is('adm1n/pinjaman') ? 'active open' : ''}}">
                        <a href="{{route('admin.pinjaman')}}">
                            <i class="fa fa-fw fa-server"></i> <span>Kelola Pinjaman</span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Sistem Pengarsipan Berkas
                    <small>Version 1.0</small>
                </h1>
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
            @yield('content')
            <!-- /.content -->
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
    @yield('adminlte_js')
</body>

</html>
