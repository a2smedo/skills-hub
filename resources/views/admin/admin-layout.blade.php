<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>AdminLTE 3</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href=" {{ asset('admin/css/fontawesome.all.css') }}  ">
  <!-- Theme style -->
  <link rel="stylesheet" href=" {{ asset('admin/css/adminlte.css') }} ">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  @yield('Css')

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="{{ asset('admin/img/logo.png') }} " alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src=" {{ asset('admin/img/user-profile.jpg') }} " class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
              <a href="{{ url('/') }} " class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Go To Website
                </p>
              </a>
            </li>


            <li class="nav-item">
              <a href="{{ url('/dashboard') }} " class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>


            <li class="nav-item">
              <a href="{{ url('/dashboard/categories') }} " class="nav-link">
                <i class="nav-icon fas fa-list-ol"></i>
                <p>
                  Categories
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ url('/dashboard/skills') }} " class="nav-link">
                <i class="nav-icon fas fa-brain"></i>
                <p>
                  Skills
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ url('/dashboard/exams') }} " class="nav-link">
                <i class="nav-icon fas fa-clipboard"></i>
                <p>
                  Exams
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ url('/dashboard/students') }} " class="nav-link">
                <i class="nav-icon fas fa-user-graduate"></i>
                <p>
                  Students
                </p>
              </a>
            </li>

            @if (Auth::user()->role->name == 'superAdmin')

              <li class="nav-item">
                <a href="{{ url('/dashboard/admins') }} " class="nav-link">
                  <i class="nav-icon fas fa-user-cog"></i>
                  <p>
                    Admins
                  </p>
                </a>
              </li>
            @endif


            <li class="nav-item">
              <a href="{{ url('/dashboard/messages') }} " class="nav-link">
                <i class="nav-icon fas fa-envelope-open"></i>
                <p>
                  Messages
                </p>
              </a>
            </li>

            {{-- <li class="nav-item has-treeview menu-open">
              <a href="" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Categories
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href=" {{ url('/dashboard') }}  " class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Category</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Edit Category</p>
                  </a>
                </li>
              </ul>
            </li> --}}

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark"> @yield('head') </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"> @yield('head')</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            @yield('content')
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src=" {{ asset('admin/js/jquery.js') }} "></script>
  <!-- Bootstrap 4 -->
  <script src="  {{ asset('admin/js/bootstrap.bundle.js') }} "></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('admin/js/adminlte.js') }}"></script>

  {{--
  <!-- jQuery -->
  <script src=" {{ asset('admin/js/jquery.min.js') }} "></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('admin/js/adminlte.min.js') }}"></script> --}}



  @yield('Script')
</body>

</html>
