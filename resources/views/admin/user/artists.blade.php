@extends('layouts.admin.contents')

@section('headSection')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ url('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">


    <style>
        .dataTables_filter {
            float: right;
        }

        .dataTables_paginate {
            float: right;
        }

    </style>

@endsection

@section('messageSection')

    @parent

    <section>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                @if (Session::get('successRegistering'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ Session::get('successRegistering') }}</strong>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section id="deactivateSuccessMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Artist blocked successfully!!</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="deactivateFailMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-error alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Failed to block artist. Try Again!</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="deleteSuccessMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Artist deleted successfully!!</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="deleteFailMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-error alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Failed to delete Artist. Try Again!</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="activateSuccessMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Artist activated successfully!!</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="activateFailMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-error alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Failed to activate artist. Try Again!</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="activateSuccessMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Artist approved successfully!!</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="activateFailMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-error alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Failed to approved artist. Try Again!</strong>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('contentSection')
    <!-- Main content -->
    <section class="content m-2">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <!-- left column -->
                <div class="col-md-12">

                    <input type="hidden" id="activeTabInput" name="activeTabInput" value="{{$activeTab}}"/>

                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">

                                <li class="nav-item">
                                    <a class="nav-link" id="register-artist-tab" data-toggle="pill"
                                        href="#register-artist" role="tab" aria-controls="register-artist"
                                        aria-selected="true"> <span class="fa fa-plus-circle"> </span> Register Artist</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="active-artist-tab" data-toggle="pill" href="#active-artist"
                                        role="tab" aria-controls="active-artist" aria-selected="true"> <span
                                            class="fa fa-list"> </span> Active Artists</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="deactivated-artist-tab" data-toggle="pill"
                                        href="#deactivated-artist" role="tab" aria-controls="deactivated-artist"
                                        aria-selected="true"> <span class="fa fa-list"> </span> Blocked Artists</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="pending-artist-tab" data-toggle="pill" href="#pending-artist"
                                        role="tab" aria-controls="pending-artist" aria-selected="true"> <span
                                            class="fa fa-list"> </span> Pending Artists</a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="tab-pane" id="register-artist">
                                    <input type="hidden" id="currentArtistId" />

                                    <form role="form" method="post" class="form-horizontal form-group"
                                        action="{{ url('users/addArtist') }}" enctype="multipart/form-data"
                                        id="addArtistForm">
                                        {{ csrf_field() }}
                                        <div class="card-body">

                                            <div class="row">
                                                <h5>Basic Information</h5>
                                            </div><br>

                                            <div class="form-group row">
                                                <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="first_name"
                                                        name="first_name" placeholder="Enter First Name" autofocus>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                                        placeholder="Enter Last Name">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="phone" name="phone"
                                                        placeholder="Enter Phone Number">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email" class="col-sm-2 col-form-label">Email Address</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="email" name="email"
                                                        placeholder="Enter Email Address">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="location" class="col-sm-2 col-form-label">Location</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="location" name="location"
                                                        placeholder="Enter Location Address">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <h5> Bank Account Information</h5>
                                            </div><br>


                                            <div class="form-group row">
                                                <label for="bankName" class="col-sm-2 col-form-label">Bank Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="bank_name" name="bank_name"
                                                        placeholder="Enter Bank Name">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="accountName" class="col-sm-2 col-form-label">Account
                                                    Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="account_name"
                                                        name="account_name" placeholder="Enter Account Name">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="bankAccount" class="col-sm-2 col-form-label">Bank
                                                    Account</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="account_number"
                                                        name="account_number" placeholder="Enter Account Number">
                                                </div>
                                            </div>


                                        </div>
                                        <!-- /.card-body -->

                                        <div class="d-flex justify-content-center">
                                            <input type="submit" class="btn btn-primary mr-3" value="Submit" />
                                            <button type="reset" class="btn btn-warning text-white">Clear</button>
                                        </div>
                                    </form>

                                </div>

                                <div class="tab-pane" id="active-artist">
                                    <p class="float-right">
                                        <input type="text" id="activeSearchText" placeholder="Search name,phone">
                                        <button class="btn btn-default" id="clearActiveSearch"
                                            onclick="clearActiveSearchEntry()">
                                            Clear
                                        </button>
                                    </p>
                                    <div id="active_table_data">

                                    </div>
                                </div>


                                <div class="tab-pane" id="deactivated-artist">

                                    <p class="float-right">
                                        <input type="text" id="deactivatedSearchText" placeholder="Search name,phone">
                                        <button class="btn btn-default" id="clearDeactivatedSearch"
                                            onclick="clearDeactivatedSearchEntry()">
                                            Clear
                                        </button>
                                    </p>
                                    <div id="deactivated_table_data">

                                    </div>
                                </div>

                                <div class="tab-pane" id="pending-artist">


                                    <div id="pending_table_data">

                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.card -->
                    </div>


                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="deactivateArtistModal">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Block Artist</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to block the artist?</p>
                    </div>
                    <div class="modal-footer float-right">
                        <button class="btn btn-danger" onclick="deactivateArtist()">Block</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>


        <div class="modal fade" tabindex="-1" role="dialog" id="deleteArtistModal">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Artist</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete the artist?</p>
                    </div>
                    <div class="modal-footer float-right">
                        <button onclick="deleteArtist()" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="viewDetails">

            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Artist Bank Account Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body d-flex justify-content-center">

                        <div class="card col-md-10">
                            <div class="card-body">
                                <div id="artistPic">

                                </div>
                                <div id="profileDetail">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="activateArtistModal">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Activate Artist</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to activate the artist?</p>
                    </div>
                    <div class="modal-footer float-right">
                        <button onclick="activateArtist()" class="btn btn-primary">Activate</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>



        <div class="modal fade" tabindex="-1" role="dialog" id="disApproveArtistModal">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Block Artist</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to block the artist?</p>
                    </div>
                    <div class="modal-footer float-right">
                        <button class="btn btn-danger" onclick="disApproveArtist()">Block</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

        <div class="modal fade" id="viewIdImage" tabindex="-1" role="dialog" aria-labelledby="viewIdImageLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="title">View Id Image</h5>
                        <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <div id="idImageDiv" class=" d-flex justify-content-center"></div>
                    </div>
                </div>
            </div>

        </div>

        <div class="modal fade" id="viewProfileImage" tabindex="-1" role="dialog" aria-labelledby="viewProfileImageLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="title">View Profile Image</h5>
                        <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <div id="profileImageDiv" class=" d-flex justify-content-center"></div>
                    </div>
                </div>
            </div>

        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="approveArtistModal">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Approve Artist</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to approve the artist?</p>
                    </div>
                    <div class="modal-footer float-right">
                        <button class="btn btn-primary" onclick="approveArtist()">Approve</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>

    </section>
@endsection

@section('scriptSection')
    <script src="{{ url('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ url('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ url('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ url('plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <!-- DataTables -->
    <script src="{{ url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ url('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ url('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script type="text/javascript">
        var searchTable;
        var loading ='<br><div id="loading" class="row d-flex justify-content-center"><div class="row"><img src="'+"{{ url('/images/loading.gif') }}"+'"/></div></div>';
        $(function() {

            $('#userList').addClass('menu-open');
            $('#userNav').addClass('active');
            $('#artistNav').addClass('active');
            $("#messages").fadeOut(10000);

            var activeTabVal = document.getElementById('activeTabInput').value;
            if (activeTabVal == 11) {
                $('#register-artist-tab').addClass('active');
                $('#register-artist').addClass('active');
            }else if(activeTabVal == 22){
                $('#active-artist-tab').addClass('active');
                $('#active-artist').addClass('active');
            }else if(activeTabVal == 33){
                $('#deactivated-artist-tab').addClass('active');
                $('#deactivated-artist').addClass('active');
            }else if(activeTabVal == 44){
                $('#pending-artist-tab').addClass('active');
                $('#pending-artist').addClass('active');
            }

            $('#active_table_data').html(loading);
            $('#deactivated_table_data').html(loading);
            $('#pending_table_data').html(loading);

            $.ajax({
                url: "{{ url('users/activeArtists/0') }}",
                type: 'get',
                success: function(data) {
                    $('#active_table_data').html(data);
                    $('#activeArtists').DataTable({
                        "paging": false,
                        "lengthChange": false,
                        "searching": false,
                        "ordering": true,
                        "info": false,
                        "autoWidth": false,
                        "responsive": true,
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                        ]
                    });


                }
            });

            $.ajax({
                url: "{{ url('users/deactivatedArtists/0') }}",
                type: 'get',
                success: function(data) {
                    $('#deactivated_table_data').html(data);
                    $('#deactivatedArtists').DataTable({
                        "paging": false,
                        "lengthChange": false,
                        "searching": false,
                        "ordering": true,
                        "info": false,
                        "autoWidth": false,
                        "responsive": true,
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                        ]
                    });

                }
            });

            $.ajax({
                url: "{{ url('pendingArtists/allPendingArtists') }}",
                type: 'get',
                success: function(data) {
                    $('#pending_table_data').html(data);
                    $('#pendingArtists').DataTable({
                        "paging": false,
                        "lengthChange": false,
                        "searching": true,
                        "ordering": true,
                        "info": false,
                        "autoWidth": false,
                        "responsive": true,
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                        ]
                    });


                }
            });
        });

        $('#addArtistForm').validate({
            rules: {
                first_name: {
                    required: true,
                    maxlength: 15,

                },
                last_name: {
                    required: true,
                    maxlength: 15,

                },
                phone: {
                    required: true,
                    minlength: 9,
                    maxlength: 10,
                    digits: true,
                },
                bank_name: {
                    required: true,
                    minlength: 2,
                    maxlength: 20,

                },
                account_name: {
                    required: true,
                    minlength: 2,
                    maxlength: 30,

                },
                account_number: {
                    required: true,
                    minlength: 1,
                    maxlength: 20,
                    digits: true,
                },
                email: {
                    email: true
                }
            },
            messages: {
                first_name: {
                    required: "Please enter first name",

                },
                last_name: {
                    required: "Please enter last name",

                },
                phone: {
                    required: "Please enter phone number",
                    minlength: "Your Phone must be at least 9 characters long",
                    maxLength: "Your Phone must be at maximum 15 characters long"
                },

                bank_name: {
                    required: "Please enter bank name",

                },
                account_number: {
                    required: "Please enter account number",

                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                error.addClass('offset-sm-2');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }

        });


        function loadMoreActiveArtists(offsetVal, pageNumberVal) {
            $('#active_table_data').html(loading);
            $.ajax({
                url: "{{ url('users/activeArtists/') }}" + '/' + offsetVal + '/' + pageNumberVal,
                type: 'get',
                success: function(data) {
                    $('#active_table_data').html(data);
                    $('#activeArtists').DataTable({
                        "paging": false,
                        "lengthChange": false,
                        "searching": false,
                        "ordering": true,
                        "info": false,
                        "autoWidth": false,
                        "responsive": true,
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                        ]
                    });
                }
            });
        }

        function loadMoreDeactivatedArtists(offsetVal, pageNumberVal) {
            $('#deactivated_table_data').html(loading);
            $.ajax({
                url: "{{ url('users/deactivatedArtists/') }}" + '/' + offsetVal + '/' + pageNumberVal,
                type: 'get',
                success: function(data) {
                    $('#deactivated_table_data').html(data);
                    $('#deactivatedArtists').DataTable({
                        "paging": false,
                        "lengthChange": false,
                        "searching": false,
                        "ordering": true,
                        "info": false,
                        "autoWidth": false,
                        "responsive": true,
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                        ]
                    });
                }
            });
        }

        $(document).on('click', '.view-details', function(e) {
            e.preventDefault();
            var artistName = $(this).attr('data-artistName');
            var bankName = $(this).attr('data-bankName');
            var accountNumber = $(this).attr('data-accountNumber');
            var profileImg = $(this).attr('data-images');
            var artistNameTag = '<h6 class="card-subtitle m-2 ml-4"><strong> Owner Name -> </strong>' + artistName +
                '</h6>';
            var bankNameTag = '<h6 class="card-subtitle p-2 pl-4"> <strong> Bank -> </strong>' + bankName + '</h6>';
            var accountNumberTag = '<h6 class="card-subtitle p-2 pl-4"> <strong> Account -> </strong>' +
                accountNumber + '</h6>';
            //imageDiv = "<img src='"+'{{ url('/uploads/profiles/') }}/'+ imageSrc + "' class='img-responsive' height='500px' width='400px' />";
            if (profileImg != null) {
                imageDiv = "<img src='" + '{{ url('/uploads/profiles/') }}/' + profileImg +
                    "' class='img-responsive float-left rounded-circle' height='150px' width='150px' />";
            } else {
                imageDiv = "<img src='" + '{{ url('/uploads/profiles/') }}/' + 'avatar.png' +
                    "' class='img-responsive float-left rounded-circle' height='150px' width='150px' />";
            }
            $('#profileDetail').html('');
            $('#artistPic').html(imageDiv);
            $('#profileDetail').append(artistNameTag);
            $('#profileDetail').append(bankNameTag);
            $('#profileDetail').append(accountNumberTag);
            $('#viewDetails').modal('show');
        });

        $(document).on('click', '.view-id', function(e) {
            e.preventDefault();

            var idImg = $(this).attr('data-idImage');
            if (idImg != null) {
                imageDiv = "<img src='" + '{{ url('/uploads/ids/') }}/' + idImg +
                    "' class='img-responsive' height='300px' width='300px' />";
            } else {
                imageDiv = "<img src='" + '{{ url('/images/') }}/' + 'avatar.png' +
                    "' class='img-responsive' height='300px' width='300px' />";
            }

            $('#idImageDiv').html(imageDiv);
            $('#viewIdImage').modal('show');
            //$('#viewIdImage').ekkoLightbox();

        });

        $(document).on('click', '.view-profilePic', function(e) {
            e.preventDefault();

            var profileImg = $(this).attr('data-profileImage');
            if (profileImg != null) {
                imageDiv = "<img src='" + '{{ url('/uploads/profiles/') }}/' + profileImg +
                    "' class='img-responsive' height='300px' width='300px' />";
            } else {
                imageDiv = "<img src='" + '{{ url('/images/') }}/' + 'avatar.png' +
                    "' class='img-responsive' height='300px' width='300px' />";
            }

            $('#profileImageDiv').html(imageDiv);
            $('#viewProfileImage').modal('show');
        });

        function deactivateArtistModalOpen(selectedId) {
            document.getElementById('currentArtistId').value = selectedId;
            $('#deactivateArtistModal').modal('show');

        }

        function deleteArtistModalOpen(selectedId) {
            document.getElementById('currentArtistId').value = selectedId;
            $('#deleteArtistModal').modal('show');

        }

        function activateArtistModalOpen(selectedId) {
            document.getElementById('currentArtistId').value = selectedId;
            $('#activateArtistModal').modal('show');

        }

        function approveArtistModalOpen(selectedId) {
            document.getElementById('currentArtistId').value = selectedId;
            $('#approveArtistModal').modal('show');

        }

        function disApproveArtistModalOpen(selectedId) {
            document.getElementById('currentArtistId').value = selectedId;
            $('#disApproveArtistModal').modal('show');

        }

        function approveArtist() {
            id = document.getElementById('currentArtistId').value;
            $('#approveArtistModal').modal('hide');
            $.ajax({
                url: "{{ url('pendingArtists/approveArtist/') }}" + '/' + id,
                type: 'get',
                success: function(response) {
                    if (response) {
                        //$('#approveArtistModal').modal('hide');
                        document.getElementById('activateSuccessMessage').style.display = 'inline';
                        $('#tr' + id).fadeOut(3000);
                        $('#activateSuccessMessage').fadeOut(3000);
                    } else {
                        document.getElementById('activateFailMessage').style.display = 'inline';
                        $('#activateFailMessage').fadeOut(3000);
                    }
                    //location.reload(true);
                }
            });

        }

        function disApproveArtist() {
            id = document.getElementById('currentArtistId').value;
            $.ajax({
                url: "{{ url('pendingArtists/disApproveArtist/') }}" + '/' + id,
                type: 'get',
                success: function(response) {
                    if (response) {
                        $('#disApproveArtistModal').modal('hide');
                        document.getElementById('deactivateSuccessMessage').style.display = 'inline';
                        $('#tr' + id).fadeOut(3000);
                        $('#deactivateSuccessMessage').fadeOut(3000);
                    } else {
                        document.getElementById('deactivateFailMessage').style.display = 'inline';
                        $('#deactivateFailMessage').fadeOut(3000);
                    }
                    //location.reload(true);
                }
            });

        }

        function deactivateArtist() {
            id = document.getElementById('currentArtistId').value;
            $.ajax({
                url: "{{ url('users/deactivateUser/') }}" + '/' + id,
                type: 'get',
                success: function(response) {
                    if (response) {
                        $('#deactivateArtistModal').modal('hide');
                        document.getElementById('deactivateSuccessMessage').style.display = 'inline';
                        $('#tr' + id).fadeOut(3000);
                        $('#deactivateSuccessMessage').fadeOut(3000);
                        $('#deactivated_table_data').html(loading);
                        $.ajax({
                            url: "{{ url('users/deactivatedArtists/0') }}",
                            type: 'get',
                            success: function(data) {
                                $('#deactivated_table_data').html(data);
                                $('#deactivatedArtists').DataTable({
                                    "paging": false,
                                    "lengthChange": false,
                                    "searching": false,
                                    "ordering": true,
                                    "info": false,
                                    "autoWidth": false,
                                    "responsive": true,
                                    dom: 'Bfrtip',
                                    buttons: [
                                        'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                                    ]
                                });

                            }
                        })

                    } else {
                        document.getElementById('deactivateFailMessage').style.display = 'inline';
                        $('#deactivateFailMessage').fadeOut(3000);
                    }
                    //location.reload(true);
                }
            });

        }




        function activateArtist() {
            id = document.getElementById('currentArtistId').value;
            $.ajax({
                url: "{{ url('users/activateUser') }}" + '/' + id,
                type: 'get',
                success: function(response) {
                    if (response) {
                        $('#activateArtistModal').modal('hide');
                        document.getElementById('deleteSuccessMessage').style.display = 'inline';
                        $('#tr' + id).fadeOut(3000);
                        $('#deleteSuccessMessage').fadeOut(3000);
                        $('#active_table_data').html(loading);
                        $.ajax({
                            url: "{{ url('users/activeArtists/0') }}",
                            type: 'get',
                            success: function(data) {
                                $('#active_table_data').html(data);
                                $('#activeArtists').DataTable({
                                    "paging": false,
                                    "lengthChange": false,
                                    "searching": false,
                                    "ordering": true,
                                    "info": false,
                                    "autoWidth": false,
                                    "responsive": true,
                                    dom: 'Bfrtip',
                                    buttons: [
                                        'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                                    ]
                                });


                            }
                        });

                    } else {
                        document.getElementById('deleteFailMessage').style.display = 'inline';
                        $('#deleteFailMessage').fadeOut(3000);
                    }
                    //location.reload(true);
                }
            });

        }

        function deleteArtist() {
            id = document.getElementById('currentArtistId').value;
            $.ajax({
                url: "{{ url('users/deleteUser') }}" + '/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response) {
                        $('#deleteArtistModal').modal('hide');
                        document.getElementById('deleteSuccessMessage').style.display = 'inline';
                        $('#tr' + id).fadeOut(3000);
                        $('#deleteSuccessMessage').fadeOut(3000);
                    } else {
                        document.getElementById('deleteFailMessage').style.display = 'inline';
                        $('#deleteFailMessage').fadeOut(3000);
                    }
                    //location.reload(true);
                }
            });

        }


        var activeSearchField = document.getElementById('activeSearchText');
        activeSearchField.addEventListener("keydown", function(e) {
            var activeSearchInput = activeSearchField.value;
            if (e.keyCode === 13) { //checks whether the pressed key is "Enter"
                searchForActiveArtist(activeSearchInput);
            }
        });

        var deactivatedSearchField = document.getElementById('deactivatedSearchText');
        deactivatedSearchField.addEventListener("keydown", function(e) {
            var deactivatedSearchInput = deactivatedSearchField.value;
            if (e.keyCode === 13) { //checks whether the pressed key is "Enter"
                searchForDeactivatedArtist(deactivatedSearchInput);
            }
        });



        function searchForActiveArtist(searchInput) {
            if (searchInput != "") {

                $('#active_table_data').html(loading);

                $.ajax({
                    url: "{{ url('users/searchActiveArtist') }}" + '/' + searchInput,
                    type: 'get',
                    success: function(data) {
                        $('#active_table_data').html(data);
                        $('#searchedActiveArtists').DataTable({
                            "paging": false,
                            "lengthChange": false,
                            "searching": false,
                            "ordering": true,
                            "info": false,
                            "autoWidth": false,
                            "responsive": true,
                            dom: 'Bfrtip',
                            buttons: [
                                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                            ]
                        });
                    }
                });


            }
        }

        function searchForDeactivatedArtist(searchInput) {
            if (searchInput != "") {
                $('#deactivated_table_data').html(loading);
                $.ajax({
                    url: "{{ url('users/searchDeactivatedArtist') }}" + '/' + searchInput,
                    type: 'get',
                    success: function(data) {
                        $('#deactivated_table_data').html(data);
                        $('#searchedDeactivatedArtists').DataTable({
                            "paging": false,
                            "lengthChange": false,
                            "searching": false,
                            "ordering": true,
                            "info": false,
                            "autoWidth": false,
                            "responsive": true,
                            dom: 'Bfrtip',
                            buttons: [
                                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                            ]
                        });
                    }
                })
            }
        }

        function clearActiveSearchEntry() {

            var searchInput = document.getElementById('activeSearchText').value;
            if (searchInput != "") {
                document.getElementById('activeSearchText').value = "";
                $('#active_table_data').html(loading);
                $.ajax({
                url: "{{ url('users/activeArtists/0') }}",
                type: 'get',
                success: function(data) {
                    $('#active_table_data').html(data);
                    $('#activeArtists').DataTable({
                        "paging": false,
                        "lengthChange": false,
                        "searching": false,
                        "ordering": true,
                        "info": false,
                        "autoWidth": false,
                        "responsive": true,
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                        ]
                    });


                }
            });

            }

        }

        function clearDeactivatedSearchEntry() {

            var searchInput = document.getElementById('deactivatedSearchText').value;
            if (searchInput != "") {
                document.getElementById('deactivatedSearchText').value = "";
                $('#deactivated_table_data').html(loading);
                $.ajax({
                url: "{{ url('users/deactivatedArtists/0') }}",
                type: 'get',
                success: function(data) {
                    $('#deactivated_table_data').html(data);
                    $('#deactivatedArtists').DataTable({
                        "paging": false,
                        "lengthChange": false,
                        "searching": false,
                        "ordering": true,
                        "info": false,
                        "autoWidth": false,
                        "responsive": true,
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
                        ]
                    });

                }
            });

            }

        }

    </script>
@endsection
