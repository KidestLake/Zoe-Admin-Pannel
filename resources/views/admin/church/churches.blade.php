@extends('layouts.admin.contents')

@section('headSection')

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">


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
    <section class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <!-- left column -->
                <div class="col-md-12">


                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">

                                <li class="nav-item">
                                    <a class="nav-link" href="/Church/addChurch" role="tab"
                                        aria-controls="custom-tabs-four-profile" aria-selected="false"> <span
                                            class="fa fa-plus-circle"> </span> Add Church</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active" id="churches-tab" data-toggle="pill" href="#churches"
                                        role="tab" aria-controls="churches" aria-selected="true"> <span class="fa fa-list">
                                        </span> Churches</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="tab-pane active" id="active-church">

                                    <table id="churches" class="table table-bordered table-striped">

                                            <thead>
                                                <tr>
                                                    <th></th>
                                                   <th>No</th>
                                                    <th>Administrator</th>
                                                    <th>Name</th>
                                                    <th>Phone </th>
                                                    <th>Email</th>
                                                    <th>Website</th>
                                                    <th>Country </th>
                                                    <th>Created At </th>
                                                    <th>Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($churches as $key => $value)

                                                    <tr id="{{$value}}">

                                                        <td class=" btn details-control sorting_disabled" rowspan="1" colspan="1" style="width: 0px;" aria-label=""></td>
                                                        <td>{{ $offset+$key + 1 }}</td>
                                                        <td>{{ $value['user_id'] }}</td>
                                                        <td>{{ $value['name'] }}</td>
                                                        <td>{{ $value['phone'] }}</td>
                                                        <td>{{ $value['email'] }}</td>
                                                        <td>{{ $value['website'] }}</td>
                                                        <td>{{ $value['address']['country'] }}</td>

                                                        <td>
                                                            <?php
                                                            $toCreatedAt = new DateTime($value['created_at']);
                                                            $createdDate = $toCreatedAt->format('M j, Y');
                                                            echo $createdDate;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <a href='#' class="text-secondary" data-toggle="modal"
                                                                            data-target="#deleteChurchModal{{ $value['id'] }}">
                                                                            <span class="fas fa-trash-alt mr-1"></span>
                                                                            Delete</a>

                                                        </td>
                                                    </tr>



                                                    <div class="modal fade" tabindex="-1" role="dialog"
                                                        id="deleteChurchModal{{ $value['id'] }}">

                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Delete Church</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure you want to delete the church?</p>
                                                                </div>
                                                                <div class="modal-footer float-right">
                                                                    <button onclick="deleteChurch({{ $value['id'] }})"
                                                                        class="btn btn-danger">Delete</button>
                                                                    <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">Cancel</button>

                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                    </div>

                                                @endforeach
                                                </tbody>

                                    </table>

                                    <div class="row d-flex justify-content-end">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination">

                                                @if ($offset == 0 || $offset < 0)
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1">
                                                            <span aria-hidden="true">&laquo;</span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                  </li>
                                                @else
                                                    <li class="page-item">
                                                        <a class="page-link" href="{{ url('Church/getChurches/'.($offset-$limit).'/'.($pageNumber-1)) }}" aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span>
                                                        <span class="sr-only">Previous</span>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if ($pageNumber > 3)
                                                    <li class="page-item"><a class="page-link" href="{{ url('Church/getChurches/'.($offset-($limit*3)).'/'.($pageNumber-3)) }}">{{$pageNumber-3}}</a></li>
                                                @endif
                                                @if ($pageNumber > 2)
                                                    <li class="page-item"><a class="page-link" href="{{ url('Church/getChurches/'.($offset-($limit*2)).'/'.($pageNumber-2)) }}">{{$pageNumber-2}}</a></li>
                                                @endif
                                                @if ($pageNumber > 1)
                                                    <li class="page-item"><a class="page-link" href="{{ url('Church/getChurches/'.($offset-($limit)).'/'.($pageNumber-1)) }}">{{$pageNumber-1}}</a></li>
                                                @endif

                                                <li class="page-item active"> <a class="page-link" >{{$pageNumber}} <span class="sr-only">(current)</span></a></li>

                                                @if (($offset + $limit) < $totalChurches)
                                                    <li class="page-item"><a class="page-link" href="{{ url('Church/getChurches/'.($offset+($limit)).'/'.($pageNumber+1)) }}">{{$pageNumber+1}}</a></li>
                                                @endif
                                                @if (($offset + (2*$limit)) < $totalChurches)
                                                    <li class="page-item"><a class="page-link" href="{{ url('Church/getChurches/'.($offset+($limit*2)).'/'.($pageNumber+2)) }}">{{$pageNumber+2}}</a></li>
                                                @endif
                                                @if (($offset + (3*$limit)) < $totalChurches)
                                                    <li class="page-item"><a class="page-link" href="{{ url('Church/getChurches/'.($offset+($limit*3)).'/'.($pageNumber+3)) }}">{{$pageNumber+3}}</a></li>
                                                @endif

                                                @if ((($offset+$limit) == $totalChurches) || (($offset+$limit) > $totalChurches))
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1">
                                                            <span aria-hidden="true">&raquo;</span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li class="page-item">
                                                        <a class="page-link" href="{{ url('Church/getChurches/'.($offset+$limit).'/'.($pageNumber+1)) }}" aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                        <span class="sr-only">Next</span>
                                                        </a>
                                                  </li>
                                                @endif

                                            </ul>
                                          </nav>
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


@endsection

@section('scriptSection')

    <!-- DataTables -->
    <script src="{{ url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{url('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{url('plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{url('plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{url('plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{url('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{url('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{url('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

    <script type="text/javascript">
        $(function() {
            $('#churchNav').addClass('active');

            $("#churches").DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print','colvis'
                ]
            });

            $("#messages").fadeOut(10000);

        });

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

        function deleteChurch(id) {
            $id = id;
            $.ajax({
                url: "{{ url('Church/destroy') }}" + '/' + id,
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

        /* Formatting function for row details - modify as you need */
    function format ( d ) {
        // `d` is the original data object for the row
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            '<tr>'+
                '<th>Country</th>'+
                '<th>Sub-City</th>'+
                '<th>Woreda</th>'+
                '<th>Specific Location</th>'+
            '</tr>'+
            '<tr>'+
                '<td>'+d.address.city+','+ d.address.country+'</td>'+
                '<td>'+d.address.subcity+'</td>'+
                '<td>'+d.address.woreda+'</td>'+
                '<td>'+d.address.specific_location+'</td>'+
            '</tr>'+
        '</table>';
    }

        // Add event listener for opening and closing details
       $('#churches tbody').on('click', 'td.details-control', function(){
            table = document.getElementById('churches');
            var tr = $(this).closest('tr');
            var dataValues = $(this).closest('tr').attr('id'); // table row ID
            var objVal = JSON.parse(dataValues);

            var row = $('#churches').DataTable().row(tr);

            if(row.child.isShown()){
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(objVal)).show();
                row.child().show();
                tr.addClass('shown');
            }
    })

    </script>
@endsection
