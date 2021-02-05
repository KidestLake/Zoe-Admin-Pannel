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

        td.details-control {
            background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_open.png') no-repeat center center;
            cursor: pointer;
        }

        tr.shown td.details-control {
            background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_close.png') no-repeat center center;
        }

    </style>

@endsection

@section('messageSection')
    @parent

    <section id="deleteSuccessMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>church deleted successfully!!</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="deleteFailMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-error alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Failed to delete church. Try Again!</strong>
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
                                    <a class="nav-link active" id="add-church-tab" data-toggle="pill" href="#add-church"
                                        role="tab" aria-controls="add-church" aria-selected="true"> <span
                                            class="fa fa-plus-circle"> </span> Add Church</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="active-church-tab" data-toggle="pill" href="#active-church"
                                        role="tab" aria-controls="active-church" aria-selected="true"> <span
                                            class="fa fa-list">
                                        </span> Churches</a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">

                                <div class="tab-pane active" id="add-church">
                                    <input type="hidden" id="currentChurchId" />
                                    <section class="content-header">
                                        <h1>
                                            <small>Add Church</small><br>
                                        </h1>
                                    </section>

                                    <form role="form" method="post" class="form-horizontal form-group"
                                        action="{{ url('churches/create') }}" enctype="multipart/form-data"
                                        id="addChurchForm">
                                        {{ csrf_field() }}
                                        <div class="card-body">

                                            <div class="row">
                                                <h5> Basic Information </h5>
                                            </div><br>

                                            <div class="form-group row">
                                                <label for="churchAdmin" class="col-sm-2 col-form-label"> Church
                                                    Administrator </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="user_id" name="user_id"
                                                        placeholder="Enter church administrator name">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="churchName" class="col-sm-2 col-form-label">
                                                    Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        placeholder="Enter Church Name" autofocus>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="phone" class="col-sm-2 col-form-label">Phone
                                                    Number</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="phone" name="phone"
                                                        placeholder="Enter Phone Number">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="email" name="email"
                                                        placeholder="Enter Email">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="link" class="col-sm-2 col-form-label">Website</label>
                                                <div class="col-sm-10">
                                                    <input type="url" class="form-control" id="website" name="website"
                                                        placeholder="Enter website link if any">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <h5> Address Information </h5>
                                            </div><br>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="country">Country</label>
                                                    <input type="text" class="form-control" id="country" name="country"
                                                        placeholder="Enter Country">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="city">City</label>
                                                    <input type="text" class="form-control" id="city" name="city"
                                                        placeholder="Enter City">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="subCity">Sub-City</label>
                                                    <input type="text" class="form-control" id="subcity" name="subcity"
                                                        placeholder="Enter Sub-City">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="woreda">Woreda</label>
                                                    <input type="text" class="form-control" id="woreda" name="woreda"
                                                        placeholder="Enter Woreda">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="location" class="col-sm-2 col-form-label">Specific
                                                    Location</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="location" name="location"
                                                        placeholder="Enter Specific location">
                                                </div>
                                            </div>


                                            <!-- /.card-body -->

                                            <div class="d-flex justify-content-center">
                                                <input type="submit" class="btn btn-primary mr-3" value="Submit" />
                                                <button type="reset" class="btn btn-warning text-white">Clear</button>
                                            </div>
                                        </div>
                                    </form>


                                </div>
                                <div class="tab-pane" id="active-church">

                                    <p class="float-right">
                                        <input type="text" id="searchText" placeholder="Search owner name,church name">
                                        <button class="btn btn-default" id="clearSearch" onclick="clearSearchEntry()">
                                            Clear
                                        </button>
                                    </p>

                                    <div id="church_table_data">

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

    <div class="modal fade" tabindex="-1" role="dialog" id="deleteChurchModal">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Church</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the church?</p>
                </div>
                <div class="modal-footer float-right">
                    <button onclick="deleteChurch()" class="btn btn-danger">Delete</button>
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
        var table;
        var loading = '<br><div id="loading" class="row d-flex justify-content-center"><div class="row"><img src="' +
            "{{ url('/images/loading.gif') }}" + '"/></div></div>';
        $(document).ready(function() {

            $('#churchNav').addClass('active');
            $('#church_table_data').html(loading);
            $.ajax({
                url: "{{ url('churches/getChurches/0') }}",
                type: 'get',
                success: function(data) {
                    $('#church_table_data').html(data);
                    table = $('#churches').DataTable({
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


            // Add event listener for opening and closing details
            /*$('#churches tbody').on('click', 'td.details-control', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                console.log("btn clicked");

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                }
            });*/


        });


        $('#addChurchForm').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 25,

                },
                phone: {
                    required: true,
                    minlength: 9,
                    maxlength: 10,
                    digits: true
                },
                email: {
                    email: true
                },
                country: {
                    required: true,

                },
                city: {
                    required: true,

                },
                subcity: {
                    required: true,

                },
                woreda: {
                    required: true,

                }
            },
            messages: {
                owner_name: {
                    required: "Please enter church name",

                },
                phone: {
                    required: "Please enter phone number",
                    minlength: "Your Phone must be at least 9 characters long",
                    maxLength: "Your Phone must be at maximum 15 characters long"
                },
                country: {
                    required: "Please enter country where the church is located",

                },
                city: {
                    required: "Please enter city where the church is located",

                },
                subcity: {
                    required: "Please enter sub-city where the church is located",

                },
                woreda: {
                    required: "Please enter woreda where the church is located",

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

        function deleteChurchModalOpen(selectedId) {
            document.getElementById('currentChurchId').value = selectedId;
            $('#deleteChurchModal').modal('show');

        }



        $(document).on('click', '.view-details', function(e) {
            e.preventDefault();
            var country = $(this).attr('data-country');
            var city = $(this).attr('data-city');
            var subcity = $(this).attr('data-subcity');
            var woreda = $(this).attr('data-woreda');
            var specificLocation = $(this).attr('data-specificLocation');
            var countryTag = '<h6 class="card-subtitle m-2 ml-4"><strong> Country -> </strong>' + city + ',' +
                country + '</h6>';
            var subcityTag = '<h6 class="card-subtitle p-2 pl-4"> <strong> Sub-City -> </strong>' + subcity +
                '</h6>';
            var woredaTag = '<h6 class="card-subtitle p-2 pl-4"> <strong> Woreda -> </strong>' + woreda + '</h6>';
            var specificLocationTag =
                '<h6 class="card-subtitle p-2 pl-4"> <strong> Specific Location -> </strong>' + specificLocation +
                '</h6>';
            imageDiv = "<img src='" + '{{ url(' / images / ') }}/' + 'church-icon.jpg' +
                "' class='img-responsive float-left rounded-circle' height='150px' width='150px' />";
            $('#churchDetail').html('');
            $('#churchPic').html(imageDiv);
            $('#churchDetail').append(countryTag);
            $('#churchDetail').append(subcityTag);
            $('#churchDetail').append(woredaTag);
            $('#churchDetail').append(specificLocationTag);
            $('#viewDetails').modal('show');
        });

        function deleteChurch() {
            $id = document.getElementById('currentChurchId').value;
            $.ajax({
                url: "{{ url('churches/destroy') }}" + '/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response) {
                        $('#deleteAdvertisementModal' + id).modal('hide');
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

        function loadMoreChurches(offsetVal, pageNumberVal) {
            $('#church_table_data').html(loading);
            $.ajax({
                url: "{{ url('churches/getChurches/') }}" + '/' + offsetVal + '/' + pageNumberVal,
                type: 'get',
                success: function(data) {
                    $('#church_table_data').html(data);
                    table = $('#churches').DataTable({
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

        var searchField = document.getElementById('searchText');
        searchField.addEventListener("keydown", function(e) {
            var searchInput = searchField.value;
            if (e.keyCode === 13) { //checks whether the pressed key is "Enter"
                searchForChurch(searchInput);
            }
        });

        function searchForChurch(searchInput) {
            if (searchInput != "") {

                $('#church_table_data').html(loading);

                $.ajax({
                    url: "{{ url('churches/searchChurch') }}" + '/' + searchInput,
                    type: 'get',
                    success: function(data) {
                        $('#church_table_data').html(data);
                        table = $('#searchedChurches').DataTable({
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

        function clearSearchEntry() {

            var searchInput = document.getElementById('searchText').value;
            if (searchInput != "") {
                document.getElementById('searchText').value = "";
                $('#church_table_data').html(loading);
                $.ajax({
                    url: "{{ url('/churches/getChurches/0') }}",
                    type: 'get',
                    success: function(data) {
                        $('#church_table_data').html(data);
                        table = $('#churches').DataTable({

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




        /*function addChildTable(rowInstance) {
            //const row = this.table.row(rowInstance);
             var tr = $(this).parents('tr');
            var row = table.row( tr );
            //const data = this.table.row(rowInstance).data();
            //console.log(row);
            console.log(rowInstance);
            const childTable = this.getTable();
            console.log(childTable);
            row.child(childTable).show();
            row().child.show();
            //row.child().show();
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
            } else {
                const childTable = this.getTable();
                row.child(childTable).show();
            }
        }*/

        /*function getTable() {
             return `<table  datatable class="table table-striped">
                               <thead>
                                 <tr>
                                   <th>ID</th>
                                   <th>Name</th>
                                 </tr>
                               </thead>
                               <tbody>
                                 <tr>
                                   <td>1</td>
                                   <td>SSS</td>
                                 </tr>
                               </tbody>
                             </table>`;
         }*/

         function showDetails() {
                //table = document.getElementById("churches");
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                //console.log("btn clicked");
                //console.log(row);
                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                }
            };

               /* Formatting function for row details - modify as you need */
        function format(d) {
            // `d` is the original data object for the row
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                '<tr>' +
                '<td>Full name:</td>' +
                '<td>' + "d.name" + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Extension number:</td>' +
                '<td>' + "d.extn" + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Extra info:</td>' +
                '<td>And any further details here (images etc)...</td>' +
                '</tr>' +
                '</table>';
        }


    </script>
@endsection
