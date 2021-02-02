<head>
    @extends('layouts.admin.contents')

    @section('headSection')

        <!-- DataTables -->
    <link rel="stylesheet" href="{{url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">


        <style>
            .dataTables_filter {
                float: right;
            }
            .dataTables_paginate {
                float: right;
            }
        </style>

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
                            <a class="nav-link" href="/User/activeAdmins/0" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false"> <span class="fa fa-list"> </span> Active Admins</a>
                        </li>

                        <li class="nav-item">
                          <a class="nav-link active" id="deactivated-admin-tab" data-toggle="pill" href="#deactivated-admin" role="tab" aria-controls="deactivated-admin" aria-selected="true">  <span class="fa fa-list"> </span> Blocked Admins</a>
                        </li>

                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content">

                        <div class="tab-pane active" id="deactivated-admin">

                            <table id="deactivatedAdmins" class="table table-bordered table-striped">

                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Created By</th>
                                    <th>Last Logged In </th>
                                    <th>Created At </th>

                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($deactivatedAdmins as $key => $value)
                                        <tr id="tr{{$value['id']}}">
                                            <td>{{$offset+$key+1}}</td>
                                            <td>{{$value['profile']['first_name'].' '.$value['profile']['last_name']}}</td>
                                            <td>{{$value['phone']}}</td>
                                            <td>{{$value['created_by']}}</td>
                                            <td>
                                                <?php
                                                $toLastLoggedIn= new DateTime($value['last_logged_in']);
                                                $lastLoggedInDate = $toLastLoggedIn->format("M j, Y");
                                                echo $lastLoggedInDate;?>
                                            </td>
                                            <td>
                                                <?php
                                                $toCreatedAt= new DateTime($value['created_at']);
                                                $createdDate = $toCreatedAt->format("M j, Y");
                                                echo $createdDate;?>
                                            </td>
                                        </tr>


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
                                                <a class="page-link" href="{{ url('User/deactivatedAdmins/'.($offset-$limit).'/'.($pageNumber-1)) }}" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($pageNumber > 3)
                                            <li class="page-item"><a class="page-link" href="{{ url('User/deactivatedAdmins/'.($offset-($limit*3)).'/'.($pageNumber-3)) }}">{{$pageNumber-3}}</a></li>
                                        @endif
                                        @if ($pageNumber > 2)
                                            <li class="page-item"><a class="page-link" href="{{ url('User/deactivatedAdmins/'.($offset-($limit*2)).'/'.($pageNumber-2)) }}">{{$pageNumber-2}}</a></li>
                                        @endif
                                        @if ($pageNumber > 1)
                                            <li class="page-item"><a class="page-link" href="{{ url('User/deactivatedAdmins/'.($offset-($limit)).'/'.($pageNumber-1)) }}">{{$pageNumber-1}}</a></li>
                                        @endif

                                        <li class="page-item active"> <a class="page-link" >{{$pageNumber}} <span class="sr-only">(current)</span></a></li>

                                        @if (($offset + $limit) < $totalDeactivatedAdmins)
                                            <li class="page-item"><a class="page-link" href="{{ url('User/deactivatedAdmins/'.($offset+($limit)).'/'.($pageNumber+1)) }}">{{$pageNumber+1}}</a></li>
                                        @endif
                                        @if (($offset + (2*$limit)) < $totalDeactivatedAdmins)
                                            <li class="page-item"><a class="page-link" href="{{ url('User/deactivatedAdmins/'.($offset+($limit*2)).'/'.($pageNumber+2)) }}">{{$pageNumber+2}}</a></li>
                                        @endif
                                        @if (($offset + (3*$limit)) < $totalDeactivatedAdmins)
                                            <li class="page-item"><a class="page-link" href="{{ url('User/deactivatedAdmins/'.($offset+($limit*3)).'/'.($pageNumber+3)) }}">{{$pageNumber+3}}</a></li>
                                        @endif

                                        @if ((($offset+$limit) == $totalDeactivatedAdmins) || (($offset+$limit) > $totalDeactivatedAdmins))
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1">
                                                    <span aria-hidden="true">&raquo;</span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ url('User/deactivatedAdmins/'.($offset+$limit).'/'.($pageNumber+1)) }}" aria-label="Next">
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
    <script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{url('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{url('plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{url('plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{url('plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{url('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{url('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{url('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

    <script type="text/javascript">

        $(function () {

            $('#userList').addClass('menu-open');
            $('#userNav').addClass('active');
            $('#adminNav').addClass('active');

            $("#deactivatedAdmins").DataTable({
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


    </script>
@endsection
