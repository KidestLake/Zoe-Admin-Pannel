@extends('layouts.admin.contents')

@section('headSection')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ url('plugins/daterangepicker/daterangepicker.css') }}">
    <link href="{{ url('plugins/summernote/summernote.min.css') }}" rel="stylesheet">
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

                    <input type="hidden" id="activeTabInput" name="activeTabInput" value="{{$activeTab}}"/>

                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">

                                <li class="nav-item">
                                    <a class="nav-link" id="add-news-tab" data-toggle="pill" href="#add-news"
                                        role="tab" aria-controls="add-news" aria-selected="true" onclick="removeTabs()"> <span
                                            class="fa fa-plus-circle"> </span> Publish News</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="news-tab" data-toggle="pill" href="#news"
                                        role="tab" aria-controls="news" aria-selected="true" onclick="removeTabs()"> <span
                                            class="fa fa-plus-list"> </span> Published News</a>
                                </li>
                                <li class="nav-item" style="display: none" id="elementUpdateDiv">
                                    <a class="nav-link" id="update-news-tab" data-toggle="pill" href="#update-news"
                                        role="tab" aria-controls="update-news" aria-selected="true"> <span
                                            class="fa fa-retweet"> </span> Update News</a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="tab-pane" id="add-news">

                                    <input type="hidden" id="currentNewsId" />

                                    <section class="content-header">
                                        <h1>
                                            <small>Publish News</small><br>
                                        </h1>
                                    </section>

                                    <form role="form" method="post" class="form-horizontal form-group"
                                        action="{{ url('news/createNews') }}" enctype="multipart/form-data"
                                        id="addNewsForm">
                                        {{ csrf_field() }}
                                        <div class="card-body justify-content-center">

                                            <div class="form-group row">
                                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="title" name="title"
                                                        placeholder="Enter Title" autofocus>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control row textarea" id="description"
                                                        name="description" placeholder="Description here..." rows="5">

                                                    </textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="coverImage" class="col-sm-2 col-form-label">Cover
                                                    Image</label>
                                                <div class="col-sm-10">
                                                    <input type="file" class="form-control" id="cover_image"
                                                        name="cover_image" accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="row d-flex justify-content-center">
                                            <input type="submit" class="btn btn-primary mr-3" value="Submit" />
                                            <button type="reset" class="btn btn-warning text-white">Clear</button>
                                        </div>
                                    </form>

                                </div>

                                <div class="tab-pane" id="news">

                                    <!--<p class="float-right">
                                        <input type="text" id="searchText" placeholder="Search title,owner">
                                        <button class="btn btn-default" id="clearSearch"
                                            onclick="clearSearchEntry()">
                                            Clear
                                        </button>
                                    </p>-->

                                    <div id="news_table_data">

                                    </div>

                                </div>

                                <div class="tab-pane" id="update-news">

                                    <div id="update_div">

                                    </div>

                                </div>

                            </div>
                        </div>
                        <!-- /.card -->
                    </div>

                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="coverImageValidator" tabindex="-1" role="dialog" aria-labelledby="bannerImageValidator"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body">
                    <div id="coverImageValidatorBody">

                    </div>
                </div>

                <div class="modal-footer float-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
                </div>

            </div>
        </div>

    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="deleteNewsModal">

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
                <button onclick="deleteNews()" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

            </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

    <div class="modal fade" id="viewBanner" tabindex="-1" role="dialog" aria-labelledby="viewBannerLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
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


    <div class="modal fade" id="viewDescription" tabindex="-1" role="dialog" aria-labelledby="viewBannerLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Description</h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    <div id="descriptionDiv"></div>
                </div>
            </div>
        </div>

    </div>



@endsection

@section('scriptSection')

    <script src="{{ url('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ url('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ url('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ url('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ url('plugins/summernote/summernote.min.js') }}"></script>
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
    var loading ='<br><div id="loading" class="row d-flex justify-content-center"><div class="row"><img src="'+"{{ url('/images/loading.gif') }}"+'"/></div></div>';
        $(document).ready(function() {
            $('#newsList').addClass('menu-open');
            $('#newsNav').addClass('active');
            $('#addNewsNav').addClass('active');

            var activeTabVal = document.getElementById('activeTabInput').value;
            if (activeTabVal == 11) {
                $('#add-news-tab').addClass('active');
                $('#add-news').addClass('active');
            }else if(activeTabVal == 22){
                $('#news-tab').addClass('active');
                $('#news').addClass('active');
            }

            $('#description').summernote();
            $("#messages").fadeOut(10000);
        });

        $('#addNewsForm').validate({
            rules: {
                title: {
                    required: true,
                    minlength: 2,
                    maxlength: 50,

                },
                description: {
                    required: true,
                    minlength: 2,
                    maxlength: 250,
                },
                cover_image: {
                    required: true,
                    extension: "jpg,jpeg,png",
                    //filesize: 200000   //max size 200

                }
            },
            messages: {
                title: {
                    required: "Please enter title here",

                },
                description: {
                    required: "Please enter description",
                    minlength: "Your description must be at least 2 characters long",

                },
                cover_image: {
                    required: "Please provide an image",

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

        var _URL = window.URL;

        $("#cover_image").change(function(e) {
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                width = 720;
                height = 1600;
                img.onload = function() {
                    if (this.width != width && this.height != height) {
                        //alert("Image dimension not accepted.The image you selected has "+"Width:" + this.width + "   Height: " + this.height);
                        document.getElementById('cover_image').value = '';
                        msg = "<p>" + "Image dimension not accepted.The image you selected has " + "Width:" +
                            this.width + " Height: " + this.height + "</p>";
                        $('#coverImageValidatorBody').html(msg);
                        $('#coverImageValidator').modal('show');
                    }
                };
                img.src = _URL.createObjectURL(file);
            }
        });

        $('#news_table_data').html(loading);
        $.ajax({
                url: "{{ url('news/getNews/0') }}",
                type: 'get',
                success: function(data) {
                    $('#news_table_data').html(data);
                    $('#newsTable').DataTable({
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

        function deleteNewsModalOpen(selectedId) {
            document.getElementById('currentNewsId').value = selectedId;
            $('#deleteNewsModal').modal('show');

        }

        function loadMoreNews(offsetVal, pageNumberVal) {
            $('#news_table_data').html(loading);
            $.ajax({
                url: "{{ url('news/getNews') }}"+ '/' + offsetVal + '/' + pageNumberVal,
                type: 'get',
                success: function(data) {
                    $('#news_table_data').html(data);
                    $('#newsTable').DataTable({
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


        function deleteNews()
        {
            id=document.getElementById('currentNewsId').value;
            $.ajax({
                url: "{{url('news/delete/')}}"+'/'+id,
                type: 'get',
                dataType: 'json',
                success:function(response) {
                    if(response){
                        $('#deleteNewsModal').modal('hide');
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

        $('#editNewsForm').validate({
            rules: {
                title: {
                    required: true,
                    minlength: 2,
                    maxlength: 50,

                },
                description: {
                    required: true,
                    minlength: 2,
                    maxlength: 250,
                },

            },
            messages: {
                title: {
                    required: "Please enter title here",

                },
                description: {
                    required: "Please enter description",
                    minlength: "Your description must be at least 2 characters long",

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

        $("#edit_cover_image").change(function(e) {
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                width = 720;
                height = 1600;
                img.onload = function() {
                    if (this.width != width && this.height != height) {
                        //alert("Image dimension not accepted.The image you selected has "+"Width:" + this.width + "   Height: " + this.height);
                        document.getElementById('edit_cover_image').value = '';
                        msg = "<p>" + "Image dimension not accepted.The image you selected has " + "Width:" +
                            this.width + " Height: " + this.height + "</p>";
                        $('#coverImageValidatorBody').html(msg);
                        $('#coverImageValidator').modal('show');
                    }
                };
                img.src = _URL.createObjectURL(file);
            }
        });


        function updateNewsPage(id){

            var elementOne = document.getElementById('update-news-tab');
            var elementTwo = document.getElementById('update-news');

            var elementThree = document.getElementById('news-tab');
            var elemenFour = document.getElementById('news');
            elementThree.classList.remove("active");
            elemenFour.classList.remove("active");
            $('#update_div').html(loading);
            $.ajax({
                url: "{{ url('news/updateNews/') }}" + '/' + id,
                type: 'get',
                success: function(data) {

                    $('#update_div').html(data);

                    document.getElementById('elementUpdateDiv').style.display = "inline";
                    elementOne.classList.add("active");
                    elementTwo.classList.add("active");
                    $('#editDescription').summernote();
                    //location.reload(true);
                }
            })
        }

        function removeTabs() {
            document.getElementById('elementUpdateDiv').style.display = "none";
        }

    </script>
@endsection
