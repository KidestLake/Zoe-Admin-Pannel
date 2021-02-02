<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Dashboard</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{url('/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{url('/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        @include('layouts.admin.header')
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{url('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{url('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{url('dist/js/adminlte.js')}}"></script>
    <!-- OPTIONAL SCRIPTS -->
    <script src="{{url('dist/js/demo.js')}}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{url('plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
    <script src="{{url('plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{url('plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
    <script src="{{url('plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{url('plugins/chart.js/Chart.min.js')}}"></script>

    <!-- PAGE SCRIPTS -->
    <script src="{{url('dist/js/pages/dashboard2.js')}}"></script>
</body>
