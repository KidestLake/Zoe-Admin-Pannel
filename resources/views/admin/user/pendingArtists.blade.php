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

    </style>

@endsection
@section('messageSection')

    @parent

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
                                    <a class="nav-link" href="/User/registerArtist" role="tab"
                                        aria-controls="custom-tabs-four-profile" aria-selected="false"> <span
                                            class="fa fa-plus-circle"> </span> Register Artist</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="/User/activeArtists/0" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false"> <span class="fa fa-list"> </span> Active Artists</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="/User/deactivatedArtists/0" role="tab"
                                        aria-controls="custom-tabs-four-profile" aria-selected="false"> <span
                                            class="fa fa-list"> </span> Blocked Artists</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active" id="pending-artist-tab" data-toggle="pill" href="#pending-artist" role="tab" aria-controls="register-artist" aria-selected="true"> <span class="fa fa-list"> </span> Pending Artist
                                    </a>
                                    <!--<span class="badge badge-danger navbar-badge">{{$totalPendingArtists}}</span>-->
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="tab-pane active" id="pending-artist">

                                    <table id="pendingArtists" class="table table-bordered table-striped">

                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Email </th>
                                                    <th>Location</th>
                                                    <th>Id Image </th>
                                                    <th>Profile Image </th>
                                                    <th>Created At </th>
                                                    <th>Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pendingArtists as $key => $value)
                                                    <tr id="tr{{ $value['id'] }}">
                                                        <td>{{$key + 1 }}</td>
                                                        <td>{{ $value['first_name'] . ' ' . $value['last_name'] }}
                                                        </td>
                                                        <td>{{ $value['phone'] }}</td>
                                                        <td>{{ $value['email'] }}</td>
                                                        <td>{{ $value['location'] }}</td>
                                                        <td>
                                                            <a href='#' class='text-blue view-id' data-idImage="{{$value['id_image']}}">View Id</a>
                                                        </td>

                                                        <td>
                                                            <a href='#' class='text-blue view-profilePic' data-profileImage="{{$value['profile_image']}}">View Profile Image</a>
                                                        </td>

                                                        <td>
                                                            <?php
                                                            $toCreatedAt = new DateTime($value['created_at']);
                                                            $createdDate = $toCreatedAt->format('M j, Y');
                                                            echo $createdDate;
                                                            ?>
                                                        </td>
                                                        <td>

                                                            <a href='#' class="text-secondary" data-toggle="modal"
                                                                            data-target="#approveArtistModal{{ $value['id'] }}">
                                                                            <span class="fas fa-check"></span>
                                                                            Approve </a>
                                                            <hr>
                                                            <a href='#' class="text-secondary" data-toggle="modal"
                                                                            data-target="#disApproveArtistModal{{ $value['id'] }}">
                                                                            <span class="fas fa-times"></span>
                                                                            Block</a>
                                                        </td>
                                                    </tr>

                                                    <div class="modal fade" tabindex="-1" role="dialog"
                                                        id="approveArtistModal{{ $value['id'] }}">

                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Approve Artist</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure you want to approve the artist?</p>
                                                                </div>
                                                                <div class="modal-footer float-right">
                                                                    <button class="btn btn-primary"
                                                                        onclick="approveArtist({{ $value['id'] }})">Approve</button>
                                                                    <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">Cancel</button>

                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                    </div>

                                                    <div class="modal fade" tabindex="-1" role="dialog"
                                                        id="disApproveArtistModal{{ $value['id'] }}">

                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Block Artist</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure you want to block the artist?</p>
                                                                </div>
                                                                <div class="modal-footer float-right">
                                                                    <button class="btn btn-danger"
                                                                        onclick="disApproveArtist({{ $value['id'] }})">Block</button>
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

                                </div>

                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="viewIdImage" tabindex="-1" role="dialog" aria-labelledby="viewIdImageLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">View Id Image</h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <div id="idImageDiv" class=" d-flex justify-content-center"></div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="viewProfileImage" tabindex="-1" role="dialog" aria-labelledby="viewProfileImageLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">View Profile Image</h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <div id="profileImageDiv" class=" d-flex justify-content-center"></div>
                </div>
            </div>
        </div>

    </div>

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
            $('#userList').addClass('menu-open');
            $('#userNav').addClass('active');
            $('#artistNav').addClass('active');

            $("#pendingArtists").DataTable({
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


        $(document).on('click', '.view-id', function (e) {
            e.preventDefault();

            var idImg = $(this).attr('data-idImage');
            if(idImg != null){
                imageDiv = "<img src='"+'{{url("/uploads/ids/")}}/'+ idImg + "' class='img-responsive' height='300px' width='300px' />";
            }else{
                imageDiv = "<img src='"+'{{url("/images/")}}/'+ 'avatar.png' + "' class='img-responsive' height='300px' width='300px' />";
            }

            $('#idImageDiv').html(imageDiv);
            $('#viewIdImage').modal('show');
            $('#viewIdImage').ekkoLightbox();

        });

        $(document).on('click', '.view-profilePic', function (e) {
            e.preventDefault();

            var profileImg = $(this).attr('data-profileImage');
            if(profileImg != null){
                imageDiv = "<img src='"+'{{url("/uploads/profiles/")}}/'+ profileImg + "' class='img-responsive' height='300px' width='300px' />";
            }else{
                imageDiv = "<img src='"+'{{url("/images/")}}/'+ 'avatar.png' + "' class='img-responsive' height='300px' width='300px' />";
            }

            $('#profileImageDiv').html(imageDiv);
            $('#viewProfileImage').modal('show');
        });

        function approveArtist(id) {
            $id = id;
            $.ajax({
                url: "{{ url('PendingArtist/approveArtist/') }}" + '/' + id,
                type: 'get',
                success: function(response) {
                    if (response) {
                        $('#approveArtistModal' + id).modal('hide');
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

        function disApproveArtist(id) {
            $id = id;
            $.ajax({
                url: "{{ url('PendingArtist/disApproveArtist/') }}" + '/' + id,
                type: 'get',
                success: function(response) {
                    if (response) {
                        $('#disApproveArtistModal' + id).modal('hide');
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



    </script>
@endsection





