<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('header')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('/assets/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('/assets/dist/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/assets/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">     

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">               
        <li class="nav-item">{{Auth::guard('dosen')->user()->nama}}</li>                       
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper mb-2">    
    <div class="content-header">      
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
            <div class="col-12">
              @yield('isi')
            </div>            
          </div> 
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>  

  <!-- Main Footer -->
  <footer class="main-footer">       
    <!-- Default to the left -->
    <strong>Copyright &copy; Jurusan Teknik Elektro</strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('/assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/assets/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('/assets/dist/js/demo.js')}}"></script>
@stack('scripts')
</body>
</html>
