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
@section('messageSection')

    @parent


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
                            <a class="nav-link" href="/User/registerArtist" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false"> <span class="fa fa-plus-circle"> </span> Register Artist</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/User/activeArtists/0" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">  <span class="fa fa-list"> </span> Active Artists</a>
                        </li>

                        <li class="nav-item">
                          <a class="nav-link active" id="deactivated-artist-tab" data-toggle="pill" href="#deactivated-artist" role="tab" aria-controls="deactivated-artist" aria-selected="true">  <span class="fa fa-list"> </span> Blocked Artists</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/PendingArtist/allPendingArtists" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false"> <span class="fa fa-list"> </span> Pending Artists</a>
                        </li>

                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content">

                        <div class="tab-pane active" id="deactivated-artist">

                            <table id="deactivatedArtists" class="table table-bordered table-striped">

                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email </th>
                                    <th>Location</th>
                                    <th>Created By</th>
                                    <th>Last Logged In </th>
                                    <th>Created At </th>
                                    <th>Action </th>
                                </tr>
                                </thead>
                                <tbody>

                                        @foreach ($deactivatedArtists as $key => $value)
                                        <tr id="tr{{$value['id']}}">
                                            <td>{{$offset+$key+1}}</td>
                                            <td>{{$value['profile']['first_name'].' '.$value['profile']['last_name']}}</td>
                                            <td>{{$value['phone']}}</td>
                                            <td>{{ $value['email']}}</td>
                                            <td>{{$value['profile']['location']}}</td>
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
                                            <td>
                                                <div class='dropdown'>
                                                    <button class='btn btn-secondary btn-sm btn-flat dropdown-toggle' type='button' data-toggle='dropdown'>Menu<span class='caret'></span></button>
                                                    <ul class='dropdown-menu dropdown-menu-right p-3'>

                                                        <li><a href='#' class="text-secondary view-details"
                                                            data-artistName="{{ $value['profile']['first_name'] . ' ' . $value['profile']['last_name'] }}"
                                                            data-accountNumber="{{$value['profile']['first_name']}}"
                                                            data-bankName="{{$value['profile']['first_name']}}"
                                                            data-images="{{$value['profile_image']}}"> <span class="fas fa-info-circle mr-2"></span> View Details</a></li>

                                                        <li><a href='#'  class="text-secondary" data-toggle="modal" data-target="#activateArtistModal{{$value['id']}}"> <span class="fas fa-check mr-2"></span> Activate</a></li>
                                                        <li><a href='#'  class="text-secondary" data-toggle="modal" data-target="#deleteArtistModal{{$value['id']}}"> <span class="fas fa-trash-alt mr-2"></span> Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" tabindex="-1" role="dialog" id="deleteArtistModal{{$value['id']}}">

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
                                                    <button onclick="deleteArtist({{$value['id']}})" class="btn btn-danger">Delete</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                                                </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                        </div>

                                        <div class="modal fade" tabindex="-1" role="dialog" id="activateArtistModal{{$value['id']}}">

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
                                                    <button onclick="activateArtist({{$value['id']}})" class="btn btn-primary">Activate</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

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
                                                <a class="page-link" href="{{ url('User/deactivatedArtists/'.($offset-$limit).'/'.($pageNumber-1)) }}" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($pageNumber > 3)
                                            <li class="page-item"><a class="page-link" href="{{ url('User/deactivatedArtists/'.($offset-($limit*3)).'/'.($pageNumber-3)) }}">{{$pageNumber-3}}</a></li>
                                        @endif
                                        @if ($pageNumber > 2)
                                            <li class="page-item"><a class="page-link" href="{{ url('User/deactivatedArtists/'.($offset-($limit*2)).'/'.($pageNumber-2)) }}">{{$pageNumber-2}}</a></li>
                                        @endif
                                        @if ($pageNumber > 1)
                                            <li class="page-item"><a class="page-link" href="{{ url('User/deactivatedArtists/'.($offset-($limit)).'/'.($pageNumber-1)) }}">{{$pageNumber-1}}</a></li>
                                        @endif

                                        <li class="page-item active"> <a class="page-link" >{{$pageNumber}} <span class="sr-only">(current)</span></a></li>

                                        @if (($offset + $limit) < $totalDeactivatedArtists)
                                            <li class="page-item"><a class="page-link" href="{{ url('User/deactivatedArtists/'.($offset+($limit)).'/'.($pageNumber+1)) }}">{{$pageNumber+1}}</a></li>
                                        @endif
                                        @if (($offset + (2*$limit)) < $totalDeactivatedArtists)
                                            <li class="page-item"><a class="page-link" href="{{ url('User/deactivatedArtists/'.($offset+($limit*2)).'/'.($pageNumber+2)) }}">{{$pageNumber+2}}</a></li>
                                        @endif
                                        @if (($offset + (3*$limit)) < $totalDeactivatedArtists)
                                            <li class="page-item"><a class="page-link" href="{{ url('User/deactivatedArtists/'.($offset+($limit*3)).'/'.($pageNumber+3)) }}">{{$pageNumber+3}}</a></li>
                                        @endif

                                        @if ((($offset+$limit) == $totalDeactivatedArtists) || (($offset+$limit) > $totalDeactivatedArtists))
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1">
                                                    <span aria-hidden="true">&raquo;</span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ url('User/deactivatedArtists/'.($offset+$limit).'/'.($pageNumber+1)) }}" aria-label="Next">
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
            $('#artistNav').addClass('active');

            $("#deactivatedArtists").DataTable({
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


        $(document).on('click', '.view-details', function (e) {
            e.preventDefault();
            var artistName = $(this).attr('data-artistName');
            var bankName = $(this).attr('data-bankName');
            var accountNumber = $(this).attr('data-accountNumber');
            var profileImg = $(this).attr('data-images');
            var artistNameTag = '<h6 class="card-subtitle m-2 ml-4"><strong> Owner Name -> </strong>'+artistName+'</h6>';
            var bankNameTag = '<h6 class="card-subtitle p-2 pl-4"> <strong> Bank -> </strong>'+bankName+'</h6>';
            var accountNumberTag = '<h6 class="card-subtitle p-2 pl-4"> <strong> Account -> </strong>'+accountNumber + '</h6>';
            //imageDiv = "<img src='"+'{{url("/uploads/profiles/")}}/'+ imageSrc + "' class='img-responsive' height='500px' width='400px' />";
           if(profileImg != null){
            imageDiv = "<img src='"+'{{url("/uploads/profiles/")}}/'+ profileImg + "' class='img-responsive float-left rounded-circle' height='150px' width='150px' />";
           }else{
            imageDiv = "<img src='"+'{{url("/uploads/profiles/")}}/'+ 'avatar.png' + "' class='img-responsive float-left rounded-circle' height='150px' width='150px' />";
           }
            $('#profileDetail').html('');
            $('#artistPic').html(imageDiv);
            $('#profileDetail').append(artistNameTag);
            $('#profileDetail').append(bankNameTag);
            $('#profileDetail').append(accountNumberTag);
            $('#viewDetails').modal('show');
        });



        function activateArtist(id)
        {
            $id=id;
            $.ajax({
                url: "{{url('User/activateUser')}}"+'/'+id,
                type: 'get',
                success:function(response) {
                    if(response){
                        $('#activateArtistModal'+id).modal('hide');
                        document.getElementById('deleteSuccessMessage').style.display='inline';
                        $('#tr'+id).fadeOut(3000);
                        $('#deleteSuccessMessage').fadeOut(3000);
                    }else{
                        document.getElementById('deleteFailMessage').style.display='inline';
                        $('#deleteFailMessage').fadeOut(3000);
                    }
                    //location.reload(true);
                }
            });

        }

        function deleteArtist(id)
        {
            $id=id;
            $.ajax({
                url: "{{url('User/deleteUser')}}"+'/'+id,
                type: 'get',
                dataType: 'json',
                success:function(response) {
                    if(response){
                        $('#deleteArtistModal'+id).modal('hide');
                        document.getElementById('deleteSuccessMessage').style.display='inline';
                        $('#tr'+id).fadeOut(3000);
                        $('#deleteSuccessMessage').fadeOut(3000);
                    }else{
                        document.getElementById('deleteFailMessage').style.display='inline';
                        $('#deleteFailMessage').fadeOut(3000);
                    }
                    //location.reload(true);
                }
            });

        }



    </script>
@endsection
