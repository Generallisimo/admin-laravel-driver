@extends('admin.layouts')
@section('title', 'driver')
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
        <p class="h3">Drivers</p>    
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
    <div class="row" style="margin-left:0; margin-right:0;">
        <div class="col">
        <div class="card-body">
            <div class="row">
            <!-- добавление нового пользователя -->
            <a href="{{ route('addNewUser')}}" class="btn btn-primary mb-3"><svg class="btn-for-driver" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg></a>
            <!-- синхранизируем контакты -->
            <form class="ml-3" method="POST" action="{{ route('sync-drivers') }}">
                @csrf
                <button type="submit" class="btn btn-primary">Синхронизировать водителей</button>
            </form>
            <!-- <div class="input-group input-group-sm"> -->
            <form class="ml-5" method="GET" action="{{ route('searchUsers') }}">
              <div class="input-group-append">
                <input class="float-right datepicker" type="text" name="name" placeholder="Имя">
                <input class="float-right datepicker"type="text" name="phone" placeholder="Телефон">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- </div> -->
            </div>
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
            <!-- выводим пользователей -->
            <thead>
                <tr><th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Drivers</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Phone</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Password</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Data</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">More</th>
            </thead>
            @foreach($users as $user)
            <tbody>
                <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">{{$user->name}}</td>
                    <td >{{ $user->phone }}</td>
                    <td >{{ $user->password_no }}</td>
                    <td >{{ $user->data }}</td>
                    <td>
                        <!-- дополнительная карточка товара -->
                        <a href="{{ route('showDriver', ['id' => $user->id]) }}" class="btn btn-primary "><svg class="btn-for-driver" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg></a>
                            <!-- удаление пользователя -->
                        <a href="{{ route('deleteUser', ['id' => $user->id]) }}" class="btn btn-danger ml-2"><svg  class="btn-for-driver" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></a>
                    </td>
                </tr>
            </tbody>
            @endforeach
            <tfoot>
            
            </tfoot>
            </table>
        </div></div>
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <!-- <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div> -->
                </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                          {{ $users->render('admin/admin_paginate') }}
                        </div>
                    </div>
                </div>
            </div>
            </div>
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