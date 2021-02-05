@extends('layouts.admin.contents')

@section('headSection')

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

    <section id="deactivateSuccessMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Client blocked successfully!!</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="deactivateFailMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-error alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Failed to block client. Try Again!</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="deleteSuccessMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Client deleted successfully!!</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="deleteFailMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-error alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Failed to delete Client. Try Again!</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="activateSuccessMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Client activated successfully!!</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="activateFailMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-error alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Failed to activate client. Try Again!</strong>
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


                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">


                                <li class="nav-item">
                                    <a class="nav-link active" id="active-client-tab" data-toggle="pill"
                                        href="#active-client" role="tab" aria-controls="active-client" aria-selected="true">
                                        <span class="fa fa-list"> </span> Active Clients</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="deactivated-client-tab" data-toggle="pill"
                                        href="#deactivated-client" role="tab" aria-controls="deactivated-client"
                                        aria-selected="true"> <span class="fa fa-list"> </span> Blocked Clients</a>
                                </li>


                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="tab-pane active" id="active-client">
                                    <input type="hidden" id="currentClientId" />
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

                                <div class="tab-pane" id="deactivated-client">
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

                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" tabindex="-1" role="dialog" id="deactivateClientModal">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Block Client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to block the client?</p>
                </div>
                <div class="modal-footer float-right">
                    <button class="btn btn-danger" onclick="deactivateClient()">Block</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="deleteClientModal">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the client?</p>
                </div>
                <div class="modal-footer float-right">
                    <button onclick="deleteClient()" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="activateClientModal">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Activate Client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to activate the client?</p>
                </div>
                <div class="modal-footer float-right">
                    <button onclick="activateClient()" class="btn btn-primary">Activate</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

@endsection

@section('scriptSection')

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
            $('#clientNav').addClass('active');

            $('#active_table_data').html(loading);
            $('#deactivated_table_data').html(loading);

            $.ajax({
                url: "{{ url('users/activeClients/0') }}",
                type: 'get',
                success: function(data) {
                    $('#active_table_data').html(data);
                    $('#activeClients').DataTable({
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
                url: "{{ url('users/deactivatedClients/0') }}",
                type: 'get',
                success: function(data) {
                    $('#deactivated_table_data').html(data);
                    $('#deactivatedClients').DataTable({
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

            $("#messages").fadeOut(10000);
        });

        function deactivateClientModalOpen(selectedId) {
            document.getElementById('currentClientId').value = selectedId;
            $('#deactivateClientModal').modal('show');

        }

        function activateClientModalOpen(selectedId) {
            document.getElementById('currentClientId').value = selectedId;
            $('#activateClientModal').modal('show');

        }

        function deleteClientModalOpen(selectedId) {
            document.getElementById('currentClientId').value = selectedId;
            $('#deleteClientModa').modal('show');

        }



        function deactivateClient() {
            id = document.getElementById('currentClientId').value;
            $.ajax({
                url: "{{ url('users/deactivateUser/') }}" + '/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response) {
                        $('#deactivateClientModal').modal('hide');
                        document.getElementById('deactivateSuccessMessage').style.display = 'inline';
                        $('#tr' + id).fadeOut(3000);
                        $('#deactivateSuccessMessage').fadeOut(3000);
                        $('#deactivated_table_data').html(loading);
                        $.ajax({
                            url: "{{ url('users/deactivatedClients/0') }}",
                            type: 'get',
                            success: function(data) {
                                $('#deactivated_table_data').html(data);
                                $('#deactivatedClients').DataTable({
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

        function deleteClient() {
            id = document.getElementById('currentClientId').value;
            $.ajax({
                url: "{{ url('users/deleteUser') }}" + '/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response) {
                        $('#deleteClientModal').modal('hide');
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

        function activateClient() {
            id = document.getElementById('currentClientId').value;
            $.ajax({
                url: "{{ url('users/activateUser') }}" + '/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response) {
                        $('#activateClientModal').modal('hide');
                        document.getElementById('activateSuccessMessage').style.display = 'inline';
                        $('#tr' + id).fadeOut(3000);
                        $('#activateSuccessMessage').fadeOut(3000);
                        $('#active_table_data').html(loading);
                        $.ajax({
                            url: "{{ url('users/activeClients/0') }}",
                            type: 'get',
                            success: function(data) {
                                $('#active_table_data').html(data);
                                $('#activeClients').DataTable({
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

        function loadMoreActiveClients(offsetVal, pageNumberVal) {
            $('#active_table_data').html(loading);
            $.ajax({
                url: "{{ url('users/activeClients/') }}" + '/' + offsetVal + '/' + pageNumberVal,
                type: 'get',
                success: function(data) {
                    $('#active_table_data').html(data);
                    $('#activeClients').DataTable({
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

        function loadMoreDeactivatedClients(offsetVal, pageNumberVal) {
            $('#deactivated_table_data').html(loading);
            $.ajax({
                url: "{{ url('users/deactivatedClients/') }}" + '/' + offsetVal + '/' + pageNumberVal,
                type: 'get',
                success: function(data) {
                    $('#deactivated_table_data').html(data);
                    $('#deactivatedClients').DataTable({
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
                searchForActiveClient(activeSearchInput);
            }
        });

        var deactivatedSearchField = document.getElementById('deactivatedSearchText');
        deactivatedSearchField.addEventListener("keydown", function(e) {
            var deactivatedSearchInput = deactivatedSearchField.value;
            if (e.keyCode === 13) { //checks whether the pressed key is "Enter"
                searchForDeactivatedClient(deactivatedSearchInput);
            }
        });


        function searchForActiveClient(searchInput) {
            if (searchInput != "") {

                $('#active_table_data').html(loading);

                $.ajax({
                    url: "{{ url('users/searchActiveClient') }}" + '/' + searchInput,
                    type: 'get',
                    success: function(data) {
                        $('#active_table_data').html(data);
                        $('#searchedActiveClients').DataTable({
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

        function searchForDeactivatedClient(searchInput) {
            if (searchInput != "") {

                $('#deactivated_table_data').html(loading);

                $.ajax({
                    url: "{{ url('users/searchDeactivatedClient') }}" + '/' + searchInput,
                    type: 'get',
                    success: function(data) {
                        $('#deactivated_table_data').html(data);
                        $('#searchedDeactivatedClients').DataTable({
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


        function clearActiveSearchEntry() {

            var searchInput = document.getElementById('activeSearchText').value;
            if (searchInput != "") {
                document.getElementById('activeSearchText').value = "";
                $('#active_table_data').html(loading);
                $.ajax({
                url: "{{ url('users/activeClients/0') }}",
                type: 'get',
                success: function(data) {
                    $('#active_table_data').html(data);
                    $('#activeClients').DataTable({
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
                url: "{{ url('users/deactivatedClients/0') }}",
                type: 'get',
                success: function(data) {
                    $('#deactivated_table_data').html(data);
                    $('#deactivatedClients').DataTable({
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
