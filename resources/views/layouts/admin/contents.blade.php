<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title> {{ $title }} </title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ url('/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ url('/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="{{url('css/style.css')}}">

    @hasSection('headSection')
        @yield('headSection')
    @endif

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        @include('layouts.admin.navigation')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @hasSection('buttonDivSection')
                @yield('buttonDivSection')
            @endif

            <!-- Message content -->
            @section('messageSection')
                <section class="pt-2">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-10" id="messages">

                            @if (Session::get('success'))

                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ Session::get('success') }}</strong>
                                </div>

                            @elseif(Session::get('error'))

                                <div class="alert alert-error alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ Session::get('error') }}</strong>
                                </div>

                            @endif

                        </div>
                    </div>
                </section>
            @show

            <!-- Main content -->
            @yield('contentSection')

        </div>
    </div>
    <!-- ./wrapper -->

    @include('layouts.admin.footer')

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('dist/js/adminlte.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    @hasSection('scriptSection')
        @yield('scriptSection')
    @endif

</body>

</html>
