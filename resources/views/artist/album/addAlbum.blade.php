<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?php echo $title; ?></title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{url('/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{url('/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        @include('layouts.admin.header')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Add Album</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Album</li>
                    <li class="breadcrumb-item active">Add Album</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
            </section>

            <section>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-10" id="messages">
                        <?php if(Session::get('success')):?>
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{Session::get('success') }}</strong>
                        </div>
                        <?php elseif(Session::get('failed')):?>
                        <div class="alert alert-error alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{Session::get('failed') }}</strong>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </section>

            <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row d-flex justify-content-center">
            <!-- left column -->
            <div class="col-md-12">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                      <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link active" id="add-advertisement-tab" data-toggle="pill" href="#add-advertisement" role="tab" aria-controls="add-advertisement" aria-selected="true">Add Advertisement</a>
                          </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/Advertisement/activeAdvertisements" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Active Advertisements</a>
                        </li>

                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content" id="custom-tabs-four-tabContent">

                        <div class="tab-pane fade show active d-flex justify-content-center" id="add-advertisement" role="tabpanel" aria-labelledby="add-advertisement-tab">

                            <div class="col-md-10 ">
                                <div class="card card-primary">
                                  <form role="form" method="post" class="form-horizontal form-group" action="{{ url('Advertisement/createAdvertisement') }}" enctype="multipart/form-data" id="addAdvertisementForm">
                                      {{ csrf_field() }}
                                      <div class="card-body">

                                        <div class="form-group row">
                                            <label for="ownerName" class="col-sm-2 col-form-label">Owner Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="owner_name" name="owner_name" placeholder="Owner full name">
                                            </div>
                                        </div>

                                      <div class="form-group row">
                                        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="phone number">
                                        </div>
                                        </div>

                                      <div class="form-group row">
                                          <label for="link" class="col-sm-2 col-form-label">Link</label>
                                          <div class="col-sm-10">
                                            <input type="link" class="form-control" id="url" name="url" placeholder="Enter link to advertisement element if any">
                                          </div>
                                       </div>

                                      <!-- Date -->
                                      <div class="form-group row">
                                          <label class="col-sm-2 col-form-label">Start Date:</label>
                                          <div class="col-sm-10">
                                             <input type="text" id="start_date" name="start_date" class="form-control"/>
                                          </div>
                                      </div>

                                       <!-- Date -->
                                       <div class="form-group row">
                                          <label class="col-sm-2 col-form-label">End Date:</label>
                                          <div class="col-sm-10">
                                            <input type="text" id="end_date" name="end_date" class="form-control"/>
                                          </div>
                                        </div>

                                      <div class="form-group row">
                                          <label for="bannerImage" class="col-sm-2 col-form-label">Banner Image</label>
                                          <div class="col-sm-10">
                                            <input type="file" class="form-control-file" id="banner_image" name="banner_image">
                                          </div>
                                        </div>
                                      </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer d-flex justify-content-center">
                                      <button type="submit" class="btn btn-primary mr-3">Submit</button>
                                      <button type="reset" class="btn btn-warning text-white">Clear</button>
                                    </div>
                                  </form>

                                </div>
                              </div>

                        </div>

                      </div>
                    </div>
                    <!-- /.card -->
                  </div>
            </div>


          </div>
        </div>
    </section>
        </div>
    </div>
    <!-- ./wrapper -->

    @include('layouts.admin.footer')

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
    <!-- bs-custom-file-input -->
    <script src="{{url('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <!-- InputMask -->
    <script src="{{url('plugins/moment/moment.min.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{url('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- bootstrap color picker -->
    <script src="{{url('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{url('plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
    <script src="{{url('js/jquery.validate.min.js')}}"></script>
    <script src="{{url('js/additional-methods.min.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#advertisementList').addClass('menu-open');
            $('#advertisementNav').addClass('active');
            $('#addAdvertisementNav').addClass('active');
        });

        $(function(){

            //Date range picker
            $('#start_date').datepicker({
                dateFormat: 'yy-mm-dd',
            });

            //Date range picker
            $('#end_date').datepicker({
                dateFormat: 'yy-mm-dd',
            });
        });

        $('#addAdvertisementForm').validate({
            rules:{
                'owner_name': {
                    required:true,

                },
                'phone': {
                    required:true,

                },
                'banner_image': {
                    required:true,

                },
                'start_date': {
                    required:true,

                },
                'end_date': {
                    required:true,

                },
            },
        });
    </script>
</body>
