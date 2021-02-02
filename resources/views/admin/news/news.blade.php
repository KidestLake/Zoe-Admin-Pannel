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

            <section id="deleteSuccessMessage" style="display:none;">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-10">
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>News deleted successfully!!</strong>
                        </div>
                    </div>
                </div>
            </section>

            <section id="deleteFailMessage" style="display:none;">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-10">
                        <div class="alert alert-error alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Failed to delete news. Try Again!</strong>
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
                            <a class="nav-link" href="/News/addNews" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false"> <span class="fa fa-plus-circle"> </span> Publish News</a>
                        </li>

                        <li class="nav-item">
                          <a class="nav-link active" id="news-tab" data-toggle="pill" href="#news" role="tab" aria-controls="news" aria-selected="true"> <span class="fa fa-list"> </span> Published News</a>
                        </li>

                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content">

                        <div class="tab-pane active" id="news">

                            <table id="newsTable" class="table table-bordered table-striped">

                                <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Title</th>
                                  <!--<th>Description</th>-->
                                  <th>Publisher Name </th>
                                  <th>Published church</th>
                                  <th>Cover Image</th>
                                  <th>Created At </th>
                                  <th>Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($news as $key => $value)
                                        <tr id="tr{{$value['id']}}">
                                            <td>{{$offset+$key+1}}</td>
                                            <td>{{$value['title']}}</td>
                                            <!--<td>

                                                <?php
                                                /*$description = strip_tags( $value['description']);
                                                   if (strlen($description) > 40) {
                                                       $desc = substr($description, 0, 40) . "...";
                                                   } else {
                                                       $desc = $description;
                                                   }
                                                   echo $desc;*/
                                                ?>

                                            </td>-->
                                            <td>{{$value['publisher_name']}}</td>
                                            <td>{{$value['church_name']}}</td>
                                            <td><a href='#' class='text-blue view-image' data-images="{{$value['cover_image']}}">View Cover</a></td>
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
                                                         <li><a class="text-secondary" href="{{ url('News/updateNews/'.$value['id']) }}"><span class="fas fa-edit mr-2"></span> Edit</a></li>
                                                         <li><a class="text-secondary" href='#' class='view-description' data-description="{{$value['description']}} "><span class="fas fa-info-circle mr-2"></span> Description</a></li>
                                                         <li><a class="text-secondary" href='#' class='' data-toggle="modal" data-target="#deleteNewsModal{{$value['id']}}"><span class="fas fa-trash-alt mr-2"></span> Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>


                                        <div class="modal fade" tabindex="-1" role="dialog" id="deleteNewsModal{{$value['id']}}">

                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Delete News</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete the news?</p>
                                                </div>
                                                <div class="modal-footer float-right">
                                                    <button onclick="deleteNews({{$value['id']}})" class="btn btn-danger">Delete</button>
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
                                                <a class="page-link" href="{{ url('News/getNews/'.($offset-$limit).'/'.($pageNumber-1)) }}" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($pageNumber > 3)
                                            <li class="page-item"><a class="page-link" href="{{ url('News/getNews/'.($offset-($limit*3)).'/'.($pageNumber-3)) }}">{{$pageNumber-3}}</a></li>
                                        @endif
                                        @if ($pageNumber > 2)
                                            <li class="page-item"><a class="page-link" href="{{ url('News/getNews/'.($offset-($limit*2)).'/'.($pageNumber-2)) }}">{{$pageNumber-2}}</a></li>
                                        @endif
                                        @if ($pageNumber > 1)
                                            <li class="page-item"><a class="page-link" href="{{ url('News/getNews/'.($offset-($limit)).'/'.($pageNumber-1)) }}">{{$pageNumber-1}}</a></li>
                                        @endif

                                        <li class="page-item active"> <a class="page-link" >{{$pageNumber}} <span class="sr-only">(current)</span></a></li>

                                        @if (($offset + $limit) < $totalNews)
                                            <li class="page-item"><a class="page-link" href="{{ url('News/getNews/'.($offset+($limit)).'/'.($pageNumber+1)) }}">{{$pageNumber+1}}</a></li>
                                        @endif
                                        @if (($offset + (2*$limit)) < $totalNews)
                                            <li class="page-item"><a class="page-link" href="{{ url('News/getNews/'.($offset+($limit*2)).'/'.($pageNumber+2)) }}">{{$pageNumber+2}}</a></li>
                                        @endif
                                        @if (($offset + (3*$limit)) < $totalNews)
                                            <li class="page-item"><a class="page-link" href="{{ url('News/getNews/'.($offset+($limit*3)).'/'.($pageNumber+3)) }}">{{$pageNumber+3}}</a></li>
                                        @endif

                                        @if ((($offset+$limit) == $totalNews) || (($offset+$limit) > $totalNews))
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1">
                                                    <span aria-hidden="true">&raquo;</span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ url('News/getNews/'.($offset+$limit).'/'.($pageNumber+1)) }}" aria-label="Next">
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


    <div class="modal fade" id="viewBanner" tabindex="-1" role="dialog" aria-labelledby="viewBannerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Cover Image</h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    <div id="bannerDiv"></div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="viewBanner" tabindex="-1" role="dialog" aria-labelledby="viewBannerLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Banner</h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    <div id="bannerDiv"></div>
                </div>
            </div>
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
            $('#newsList').addClass('menu-open');
            $('#newsNav').addClass('active');
            $('#newsListNav').addClass('active');

            $("#newsTable").DataTable({
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

        $(document).on('click', '.view-image', function (e) {
            e.preventDefault();
            var imageSrc = $(this).attr('data-images');
            var title = $(this).attr('data-title');
            imageDiv = "<img src='"+'{{url("/uploads/news/")}}/'+ imageSrc + "' class='img-responsive' height='350px' width='350px' />";
            $('#bannerDiv').html(imageDiv);
            $('#viewBanner').modal('show');
        });

        $(document).on('click', '.view-description', function (e) {
            e.preventDefault();
            var desc = $(this).attr('data-description');
            var descDiv = "<p>"+desc +"</a>";
            $('#descriptionDiv').html(descDiv);
            $('#viewDescription').modal('show');
        });


        function deleteNews(id)
        {
            $id=id;
            $.ajax({
                url: "{{url('News/delete/')}}"+'/'+id,
                type: 'get',
                dataType: 'json',
                success:function(response) {
                    if(response){
                        $('#deleteNewsModal'+id).modal('hide');
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
