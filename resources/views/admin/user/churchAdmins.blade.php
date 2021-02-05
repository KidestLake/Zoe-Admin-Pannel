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
                    <strong>Church Admin blocked successfully!!</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="deactivateFailMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-error alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Failed to block church admin. Try Again!</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="deleteSuccessMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Church admin deleted successfully!!</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="deleteFailMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-error alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Failed to delete church admin. Try Again!</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="activateSuccessMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Church Admin activated successfully!!</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="activateFailMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-error alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Failed to activate Church Admin. Try Again!</strong>
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

                    <input type="hidden" id="activeTabInput" name="activeTabInput" value="{{ $activeTab }}" />
                    <input type="hidden" id="currentChurchAdminId" />

                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">

                                <li class="nav-item">
                                    <a class="nav-link" id="register-churchAdmin-tab" data-toggle="pill"
                                        href="#register-churchAdmin" role="tab" aria-controls="register-churchAdmin"
                                        aria-selected="true"> <span class="fa fa-plus-circle"> </span> Register Church
                                        Admin</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="active-churchAdmins-tab" data-toggle="pill"
                                        href="#active-churchAdmins" role="tab" aria-controls="active-churchAdmins"
                                        aria-selected="true"> <span class="fa fa-list"> </span> Active Church Admins</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="deactivated-churchAdmins-tab" data-toggle="pill"
                                        href="#deactivated-churchAdmins" role="tab" aria-controls="deactivated-churchAdmins"
                                        aria-selected="true"> <span class="fa fa-list"> </span> Blocked Church Admins</a>
                                </li>



                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="tab-pane" id="register-churchAdmin">

                                    <section class="content-header">
                                        <h1>
                                            <small>Register Church Admin</small>
                                        </h1>
                                    </section>

                                    <form role="form" method="post" class="form-horizontal form-group"
                                        action="{{ url('users/addChurchAdmin') }}" enctype="multipart/form-data"
                                        id="addChurchAdminForm">
                                        {{ csrf_field() }}
                                        <div class="card-body">

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
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="d-flex justify-content-center">
                                            <input type="submit" class="btn btn-primary mr-3" value="Submit" />
                                            <button type="reset" class="btn btn-warning text-white">Clear</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="active-churchAdmins">
                                    <p class="float-right">
                                        <input type="text" id="activeSearchText" placeholder="Search owner name,phone">
                                        <button class="btn btn-default" id="clearActiveSearch"
                                            onclick="clearActiveSearchEntry()">
                                            Clear
                                        </button>
                                    </p>
                                    <div id="active_table_data">

                                    </div>
                                </div>


                                <div class="tab-pane" id="deactivated-churchAdmins">

                                    <p class="float-right">
                                        <input type="text" id="deactivatedSearchText" placeholder="Search owner name,phone">
                                        <button class="btn btn-default" id="clearActiveSearch"
                                            onclick="clearDeactivatedSearchEntry()">
                                            Clear
                                        </button>
                                    </p>
                                    <div id="deactivated_table_data">

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

    <div class="modal fade" tabindex="-1" role="dialog" id="deactivateChurchAdminModal">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Block Church Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to block the church admin?</p>
                </div>
                <div class="modal-footer float-right">
                    <button class="btn btn-danger" onclick="deactivateChurchAdmin()">Block</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="deleteChurchAdminModal">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Church Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the church admin?</p>
                </div>
                <div class="modal-footer float-right">
                    <button onclick="deleteChurchAdmin()" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="activateChurchAdminModal">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Activate Church Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to activate the church admin?</p>
                </div>
                <div class="modal-footer float-right">
                    <button onclick="activateChurchAdmin()" class="btn btn-primary">Activate</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

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
        var loading ='<br><div id="loading" class="row d-flex justify-content-center"><div class="row"><img src="'+"{{ url('/images/loading.gif') }}"+'"/></div></div>';
        $(function() {

            $('#userList').addClass('menu-open');
            $('#userNav').addClass('active');
            $('#churchAdminNav').addClass('active');

            var activeTabVal = document.getElementById('activeTabInput').value;
            if (activeTabVal == 11) {
                $('#register-churchAdmin-tab').addClass('active');
                $('#register-churchAdmin').addClass('active');
            } else if (activeTabVal == 22) {
                $('#active-artist-tab').addClass('active');
                $('#active-artist').addClass('active');
            } else if (activeTabVal == 33) {
                $('#deactivated-artist-tab').addClass('active');
                $('#deactivated-artist').addClass('active');
            } else if (activeTabVal == 44) {
                $('#pending-artist-tab').addClass('active');
                $('#pending-artist').addClass('active');
            }

            $('#active_table_data').html(loading);
            $('#deactivated_table_data').html(loading);

            $("#messages").fadeOut(10000);

            $.ajax({
                url: "{{ url('/users/activeChurchAdministrators/0') }}",
                type: 'get',
                success: function(data) {
                    $('#active_table_data').html(data);
                    $('#activeChurchAdmins').DataTable({
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
                url: "{{ url('/users/deactivatedChurchAdministrators/0') }}",
                type: 'get',
                success: function(data) {
                    $('#deactivated_table_data').html(data);
                    $('#deactivatedChurchAdmins').DataTable({
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

        });


        $('#addChurchAdminForm').validate({
            rules: {
                first_name: {
                    required: true,
                    minlength: 1,
                    maxlength: 15,

                },
                last_name: {
                    required: true,
                    minlength: 1,
                    maxlength: 15,

                },
                phone: {
                    required: true,
                    minlength: 9,
                    maxlength: 10,
                    digits: true
                },

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

        function deactivateModalOpen(selectedId) {
            document.getElementById('currentChurchAdminId').value = selectedId;
            $('#deactivateChurchAdminModal').modal('show');

        }

        function deleteModalOpen(selectedId) {
            document.getElementById('currentChurchAdminId').value = selectedId;
            $('#deleteChurchAdminModal').modal('show');

        }

        function activateModalOpen(selectedId) {
            document.getElementById('currentChurchAdminId').value = selectedId;
            $('#activateChurchAdminModal').modal('show');

        }

        function deactivateChurchAdmin(id) {
            id = document.getElementById('currentChurchAdminId').value;
            $.ajax({
                url: "{{ url('users/deactivateUser/') }}" + '/' + id,
                type: 'get',
                success: function(response) {
                    if (response) {
                        $('#deactivateChurchAdminModal').modal('hide');
                        document.getElementById('deactivateSuccessMessage').style.display = 'inline';
                        $('#tr' + id).fadeOut(3000);
                        $('#deactivateSuccessMessage').fadeOut(3000);
                        $('#deactivated_table_data').html(loading);
                        $.ajax({
                            url: "{{ url('/users/deactivatedChurchAdministrators/0') }}",
                            type: 'get',
                            success: function(data) {
                                $('#deactivated_table_data').html(data);
                                $('#deactivatedChurchAdmins').DataTable({
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
                        document.getElementById('deactivateFailMessage').style.display = 'inline';
                        $('#deactivateFailMessage').fadeOut(3000);
                    }
                    //location.reload(true);
                }
            });

        }

        function deleteChurchAdmin(id) {
            id = document.getElementById('currentChurchAdminId').value;
            $.ajax({
                url: "{{ url('users/deleteUser') }}" + '/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response) {
                        $('#deleteChurchAdminModal').modal('hide');
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

        function activateChurchAdmin() {
            id = document.getElementById('currentChurchAdminId').value;
            $.ajax({
                url: "{{ url('users/activateUser') }}" + '/' + id,
                type: 'get',
                success: function(response) {
                    if (response) {
                        $('#activateChurchAdminModal').modal('hide');
                        document.getElementById('activateSuccessMessage').style.display = 'inline';
                        $('#tr' + id).fadeOut(3000);
                        $('#activateSuccessMessage').fadeOut(3000);
                        $('#active_table_data').html(loading);
                        $.ajax({
                            url: "{{ url('/users/activeChurchAdministrators/0') }}",
                            type: 'get',
                            success: function(data) {
                                $('#active_table_data').html(data);
                                $('#activeChurchAdmins').DataTable({
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
                        document.getElementById('activateFailMessage').style.display = 'inline';
                        $('#activateFailMessage').fadeOut(3000);
                    }
                    //location.reload(true);
                }
            });

        }


        function loadMoreActiveChurchAdmins(offsetVal, pageNumberVal) {
            $('#active_table_data').html(loading);

            $.ajax({
                url: "{{ url('/users/activeChurchAdministrators/') }}"+ '/' + offsetVal + '/' + pageNumberVal,
                type: 'get',
                success: function(data) {
                    $('#active_table_data').html(data);
                    $('#activeChurchAdmins').DataTable({
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

        function loadMoreDeactivatedChurchAdmins(offsetVal, pageNumberVal) {
            $('#deactivated_table_data').html(loading);
            $.ajax({
                url: "{{ url('users/deactivatedChurchAdministrators/') }}" + '/' + offsetVal + '/' + pageNumberVal,
                type: 'get',
                success: function(data) {
                    $('#deactivated_table_data').html(data);
                    $('#deactivatedChurchAdmins').DataTable({
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


        var activeSearchField = document.getElementById('activeSearchText');
        activeSearchField.addEventListener("keydown", function(e) {
            var activeSearchInput = activeSearchField.value;
            if (e.keyCode === 13) { //checks whether the pressed key is "Enter"
                searchForActiveChurchAdmin(activeSearchInput);
            }
        });

        var deactivatedSearchField = document.getElementById('deactivatedSearchText');
        deactivatedSearchField.addEventListener("keydown", function(e) {
            var deactivatedSearchInput = deactivatedSearchField.value;
            if (e.keyCode === 13) { //checks whether the pressed key is "Enter"
                searchForDeactivatedChurchAdmin(deactivatedSearchInput);
            }
        });



        function searchForActiveChurchAdmin(searchInput) {
            if (searchInput != "") {

                $('#active_table_data').html(loading);

                $.ajax({
                    url: "{{ url('users/searchActiveChurchAdmin') }}" + '/' + searchInput,
                    type: 'get',
                    success: function(data) {
                        $('#active_table_data').html(data);
                        $('#searchedActiveChurchAdmin').DataTable({
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

        function searchForDeactivatedChurchAdmin(searchInput) {
            if (searchInput != "") {
                $('#deactivated_table_data').html(loading);
                $.ajax({
                    url: "{{ url('users/searchDeactivatedChurchAdmin') }}" + '/' + searchInput,
                    type: 'get',
                    success: function(data) {
                        $('#deactivated_table_data').html(data);
                        $('#searchedDeactivatedChurchAdmin').DataTable({
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
                url: "{{ url('/users/activeChurchAdministrators/0') }}",
                type: 'get',
                success: function(data) {
                    $('#active_table_data').html(data);
                    $('#activeChurchAdmins').DataTable({
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
                url: "{{ url('/users/deactivatedChurchAdministrators/0') }}",
                type: 'get',
                success: function(data) {
                    $('#deactivated_table_data').html(data);
                    $('#deactivatedChurchAdmins').DataTable({
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
