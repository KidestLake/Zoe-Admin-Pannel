@extends('layouts.admin.contents')

@section('headSection')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ url('plugins/daterangepicker/daterangepicker.css') }}">
    <link href="{{url('plugins/summernote/summernote.min.css')}}" rel="stylesheet">

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
                                    <a class="nav-link" href="/News/addNews" role="tab"
                                        aria-controls="custom-tabs-four-profile" aria-selected="false"> <span
                                            class="fa fa-plus-circle"> </span> Publish News</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="/News" role="tab" aria-controls="custom-tabs-four-profile"
                                        aria-selected="false"> <span class="fa fa-list"> </span> Published News</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active" id="update-news-tab" data-toggle="pill" href="#update-news"
                                        role="tab" aria-controls="update-news" aria-selected="true"> <span
                                            class="fa fa-retweet"> </span> Update News</a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="tab-pane active" id="update-news">


                                    <section class="content-header">
                                        <h1>
                                            <small>Update News</small><br>
                                        </h1>
                                    </section>

                                    <form role="form" method="post" class="form-horizontal form-group"
                                                action="{{ url('News/update/' . $news['id']) }}"
                                                enctype="multipart/form-data" id="editNewsForm">
                                                {{ csrf_field() }}
                                                <div class="card-body">

                                                    <div class="form-group row">
                                                        <label for="ownerName" class="col-sm-2 col-form-label">Title</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="title" name="title"
                                                                value="{{ $news['title'] }}" autofocus>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="description"
                                                            class="col-sm-2 control-label">Description</label>
                                                        <div class="col-sm-8">
                                                            <textarea class="form-control textarea" id="description"
                                                                name="description">
                                                            {{ $news['description'] }}
                                                            </textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="bannerImage" class="col-sm-2 control-label">Cover
                                                            Image</label>
                                                        <div class="col-sm-8">
                                                            <input type="file" class="form-control" id="cover_image"
                                                                name="cover_image" accept="image/*">
                                                            <a href='#' class='text-blue view-image'
                                                                data-images="{{ $news['cover_image'] }}">View cover
                                                                Image</a>
                                                        </div>
                                                    </div>

                                                    <!-- /.card-body -->

                                                    <div class="card-footer d-flex justify-content-center">
                                                        <button type="submit" class="btn btn-primary mr-3">Submit</button>
                                                        <button type="reset"
                                                            class="btn btn-warning text-white">Clear</button>
                                                    </div>
                                            </form>

                                </div>

                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
    </section>

    <div class="modal fade" id="viewBanner" tabindex="-1" role="dialog" aria-labelledby="viewBannerLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Cover Image</h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body row d-flex justify-content-center">
                    <div id="bannerDiv"></div>
                </div>
            </div>
        </div>

    </div>

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


@endsection

@section('scriptSection')

    <script src="{{ url('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ url('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ url('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ url('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ url('plugins/summernote/summernote.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#newsList').addClass('menu-open');
            $('#newsNav').addClass('active');
            $('#addNewsNav').addClass('active');

            $('#description').summernote();

        });

        $(document).on('click', '.view-image', function(e) {
            e.preventDefault();
            var imageSrc = $(this).attr('data-images');
            imageDiv = "<img src='"+'{{url("/uploads/news/")}}/'+ imageSrc + "' class='img-responsive' height='350px' width='350px' />";
            $('#bannerDiv').html(imageDiv);
            $('#viewBanner').modal('show');
        });


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

    </script>
@endsection
