@extends('layouts.admin.contents')

@section('headSection')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ url('plugins/daterangepicker/daterangepicker.css') }}">
    <link href="{{ url('plugins/summernote/summernote.min.css') }}" rel="stylesheet">

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
                                    <a class="nav-link active" id="add-news-tab" data-toggle="pill" href="#add-news"
                                        role="tab" aria-controls="add-news" aria-selected="true"> <span
                                            class="fa fa-plus-circle"> </span> Publish News</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="/News/getNews/0" role="tab"
                                        aria-controls="custom-tabs-four-profile" aria-selected="false"> <span
                                            class="fa fa-list"> </span> Published News</a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="tab-pane active" id="add-news">

                                    <section class="content-header">
                                        <h1>
                                            <small>Publish News</small><br>
                                        </h1>
                                    </section>

                                    <form role="form" method="post" class="form-horizontal form-group"
                                        action="{{ url('News/createNews') }}" enctype="multipart/form-data"
                                        id="addNewsForm">
                                        {{ csrf_field() }}
                                        <div class="card-body justify-content-center">

                                            <div class="form-group row">
                                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="title" name="title"
                                                        placeholder="Enter Title" autofocus>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                                <div class="col-sm-8">
                                                    <textarea class="form-control row textarea" id="description"
                                                        name="description" placeholder="Description here..." rows="5">

                                                    </textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="coverImage" class="col-sm-2 col-form-label">Cover
                                                    Image</label>
                                                <div class="col-sm-8">
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

    </script>
@endsection
