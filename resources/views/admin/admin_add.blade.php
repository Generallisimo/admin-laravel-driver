@extends('admin.layouts')
@section('title', 'adddriver')
@section('content')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <p class="h3">Add new driver</p>    
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-dark">
                {{ __('Log Out') }}
            </button>
        </form>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info ml-3">
          <a href="{{ url('/admin') }}" class="d-block">{{ $name }}</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
            
            <a href="{{ url('/admin/drivers') }}" class="nav-link">
              <i class=" fas fa-user"></i> 
              <p class="ml-2">Drivers</p>
            </a>
            
          </li>
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
            <!-- <h1 class="m-0">Dashboard</h1> -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->


  <div class="container">
    <div class="card card-dark mx-auto">
      <!-- <div class="col-md-8 mx-auto"> -->
        <div class="card-header">
          <h3 class="card-title">Card driver</h3>
        </div>
        <form action="{{ route('addUser') }}" method="post">
        @csrf
          <div class="card-body">
            <div class="form-group">
              <label>Name</label>
              <input type="name" name="name" class="form-control" placeholder="Name">
            </div>
            <div class="form-group">
              <label >Phone</label>
              <!-- <input type="text" name="phone" class="form-control" pattern="\+7\(\d{3}\)-\d{3}-\d{2}-\d{2}" placeholder="Phone"> -->
              <input class="form-control" type="text" name="phone"  maxlength="18" required>
            </div>
          </div>
          <div class="card-footer">
              <button type="submit" class="btn btn-dark">Add User</button>
          </div>
        </div>
      </form>
    </div>
  </div>

    
</div>
<!-- /.content-wrapper -->
<footer class="main-footer"></footer>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
  @endsection