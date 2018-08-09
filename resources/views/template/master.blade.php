<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('judulhalaman')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{!!asset('bower_components/bootstrap/dist/css/bootstrap.min.css') !!}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{!!asset('bower_components/font-awesome/css/font-awesome.min.css') !!}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{!!asset('bower_components/Ionicons/css/ionicons.min.css') !!}">
  @yield('csstambahan')
  <!-- Theme style -->
  <link rel="stylesheet" href="{!!asset('dist/css/AdminLTE.min.css') !!}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="{!! asset('dist/css/skins/skin-blue.min.css') !!}">

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
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SIP</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SIP</b> DAOP 4</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Menu Bagian Atas -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{!!asset('dist/img/user2-160x160.jpg')!!}" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{!!asset('dist/img/user2-160x160.jpg')!!}" class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->name }}
                  @if(Auth::user()->level==1)
                  <small>Admin</small>
                  @elseif(Auth::user()->level==2)
                  <small>User-Penumpang</small>
                  @elseif(Auth::user()->level==3)
                  <small>User-Barang</small>
                  @elseif(Auth::user()->level==4)
                  <small>User-PDDM</small>
                  @elseif(Auth::user()->level==5)
                  <small>User-Lawang-Sewu</small>
                  @elseif(Auth::user()->level==6)
                  <small> User-Ambarawa</small>
                  @elseif(Auth::user()->level==7)
                  <small>User-UUK</small>
                  @elseif(Auth::user()->level==8)
                  <small>User-PA</small>
				  @elseif(Auth::user()->level==9)
                  <small>User-Pusdal</small>
				  @elseif(Auth::user()->level==10)
                  <small>User-KA-Daop4</small>
                  @endif

                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="" class="btn btn-default btn-flat">Profil</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();" class="btn btn-block btn-danger">Keluar</a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
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

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{!!asset('dist/img/user2-160x160.jpg')!!}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <!-- Status -->
          @if(Auth::user()->level==1)
          <a href=""><i class="fa fa-circle text-success"></i> Admin</a>
          @elseif(Auth::user()->level==2)
          <a href=""><i class="fa fa-circle text-success"></i> User-Penumpang</a>
          @elseif(Auth::user()->level==3)
          <a href=""><i class="fa fa-circle text-success"></i> User-Barang</a>
          @elseif(Auth::user()->level==4)
          <a href=""><i class="fa fa-circle text-success"></i> User-PDDM</a>
          @elseif(Auth::user()->level==5)
          <a href=""><i class="fa fa-circle text-success"></i> User-Lawang-Sewu</a>
          @elseif(Auth::user()->level==6)
          <a href=""><i class="fa fa-circle text-success"></i> User-Ambarawa</a>
          @elseif(Auth::user()->level==7)
          <a href=""><i class="fa fa-circle text-success"></i> User-UUK</a>
          @elseif(Auth::user()->level==8)
          <a href=""><i class="fa fa-circle text-success"></i> User-PA</a>
		  @elseif(Auth::user()->level==9)
          <a href=""><i class="fa fa-circle text-success"></i> User-Pusdal</a>
		  @elseif(Auth::user()->level==10)
          <a href=""><i class="fa fa-circle text-success"></i> User-KA-Daop4</a>
          @endif
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu</li>
        <!-- Optionally, you can add icons to the links -->
        @if(Auth::user()->level==2)
        <li><a href="/penumpang/tambah"><i class="fa fa-plus"></i> Pendapatan Penumpang</a></li>
        @elseif(Auth::user()->level==1)
        <li><a href="/penumpang/tambah"><i class="fa fa-plus"></i> Pendapatan Penumpang</a></li>
        @endif
        @if(Auth::user()->level==3)
        <li><a href="/barang/tambah"><i class="fa fa-plus"></i> Pendapatan Barang</a></li>
        @elseif(Auth::user()->level==1)
        <li><a href="/barang/tambah"><i class="fa fa-plus"></i> Pendapatan Barang</a></li>
        @endif
        @if(Auth::user()->level==4)
        <li><a href="/pa/tambah"><i class="fa fa-plus"></i> Pendapatan PDDM</a></li>
        @elseif(Auth::user()->level==5)
        <li><a href="/lawang/tambah"><i class="fa fa-plus"></i> Pendapatan Lawang Sewu</a></li>
        @elseif(Auth::user()->level==6)
        <li><a href="/ambarawa/tambah"><i class="fa fa-plus"></i> Pendapatan Ambarawa</a></li>
        @elseif(Auth::user()->level==7)
        <li><a href="/uuk/tambah"><i class="fa fa-plus"></i> Pendapatan UUK</a></li>
        @elseif(Auth::user()->level==1)
        <li class="treeview">
          <a href=""><i class="fa fa-plus"></i> <span>Non Angkutan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/pa/tambah"><i class="fa fa-plus"></i> Pendapatan PDDM</a></li>
            <li><a href="/uuk/tambah"><i class="fa fa-plus"></i> Pendapatan UUK</a></li>
            <li><a href="/ambarawa/tambah"><i class="fa fa-plus"></i> Pendapatan Ambarawa</a></li>
            <li><a href="/lawang/tambah"><i class="fa fa-plus"></i> Pendapatan Lawang Sewu</a></li>
          </ul>
        </li>
        @endif
        <li class="treeview">
          <a href=""><i class="fa fa-file-text"></i> <span>Lihat Data</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/penumpang/komulatif"><i class="fa fa-file-text"></i>Penumpang</a></li>
            <li><a href="/barang/lihat"><i class="fa fa-file-text"></i>Barang</a></li>
            <li><a href="/nonangkutan/lihat/komulatif"><i class="fa fa-file-text"></i>Non Angkutan</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href=""><i class="fa fa-bar-chart"></i> <span>Chart</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/chart/single"><i class="fa fa-area-chart"></i>Single</a></li>
            <li><a href="/chart/komulatif"><i class="fa fa-line-chart"></i>Komulatif</a></li>
          </ul>
        </li>
        @if(Auth::user()->level==1||Auth::user()->level==9||Auth::user()->level==10)
		<li class="treeview">
          <a href=""><i class="fa fa-book"></i> <span>Laporan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/laporan/harian"><i class="fa fa-book"></i>Harian</a></li>
            <li><a href="/laporan/kadaop"><i class="fa fa-book"></i>KA DAOP 4</a></li>
          </ul>
        </li>
		@endif
      </ul>
      @if(Auth::user()->level==1)
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu Admin</li>
        <!-- Optionally, you can add icons to the links -->
          <li class="treeview">
          <a href=""><i class="fa fa-wrench"></i> <span>Manajemen</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/user"><i class="fa fa-user"></i>User</a></li>
            <li><a href="/stasiun"><i class="fa fa-train"></i>Stasiun</a></li>
              <li><a href="/nonangkutan/lihat/harian"><i class="fa fa-edit"></i>Data Non Angkutan</a></li>
            <li><a href="/target"><i class="fa fa-plus"></i>Tambah Target</a></li>
            <li><a href="/target/lihat"><i class="fa fa-book"></i>Lihat Target</a></li>
          </ul>
        </li>
      @endif
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('judulpage')
      </h1>
      <ol class="breadcrumb">
        @yield('tambahan_judul')
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <!-- Koding disini -->
      @yield('konten')
    </section>
    <!-- /.Econtent -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2018 <a href="">PT KAI</a>.</strong> All rights reserved.
  </footer>
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{!! asset('bower_components/jquery/dist/jquery.min.js') !!}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{!! asset('bower_components/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
@yield('scripttambahan')
<!-- AdminLTE App -->
<script src="{!! asset('dist/js/adminlte.min.js') !!}"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>
