@extends('layouts.admin.contents')

@section('headSection')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ url('plugins/daterangepicker/daterangepicker.css') }}">

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
                                    <a class="nav-link" href="/Advertisement/addAdvertisement" role="tab"
                                        aria-controls="custom-tabs-four-profile" aria-selected="false"> <span
                                            class="fa fa-plus-circle"> </span> Add Advertisement</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="/Advertisement/activeAdvertisements/0" role="tab"
                                        aria-controls="custom-tabs-four-profile" aria-selected="false"> <span
                                            class="fa fa-list"> </span> Active Advertisements</a>

                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="/Advertisement/deactivatedAdvertisements/0" role="tab"
                                        aria-controls="custom-tabs-four-profile" aria-selected="false"> <span
                                            class="fa fa-list"> </span> Deactivated Advertisements</a>
                                </li>


                                <li class="nav-item">
                                    <a class="nav-link active" id="update-advertisement-tab" data-toggle="pill"
                                        href="#update-advertisement" role="tab" aria-controls="update-advertisement"
                                        aria-selected="true"> <span class="fas fa-retweet"> </span> Update Advertisement</a>
                                </li>


                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">

                                <div class="tab-pane active" id="update-advertisement" role="tabpanel">

                                        <section class="content-header">
                                            <h1>
                                                <small>Update Advertisement</small><br>
                                            </h1>
                                        </section>
                                        <!-- form start -->
                                        <form role="form" method="post" class="form-horizontal form-group"
                                            action="{{ url('Advertisement/update/' . $advertisement['id']) }}"
                                            enctype="multipart/form-data" id="editAdvertisementForm">
                                            {{ csrf_field() }}
                                            <div class="card-body">

                                                <div class="form-group row">
                                                    <label for="ownerName" class="col-sm-2 col-form-label">Owner
                                                        Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="owner_name"
                                                            name="owner_name" value="{{ $advertisement['owner_name'] }}" autofocus>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="phone" name="phone"
                                                            value="{{ $advertisement['phone'] }}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="link" class="col-sm-2 col-form-label">Link</label>
                                                    <div class="col-sm-10">
                                                        <input type="url" class="form-control" id="url" name="url"
                                                            value="{{ $advertisement['url'] }}">
                                                    </div>
                                                </div>

                                                <!-- Date -->
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Start Date:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="start_date" name="start_date"
                                                            class="form-control"
                                                            value="{{ $advertisement['start_date'] }}" />
                                                    </div>
                                                </div>

                                                <!-- Date -->
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">End Date:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="end_date" name="end_date"
                                                            class="form-control" value="{{ $advertisement['end_date'] }}" />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="bannerImage" class="col-sm-2 col-form-label">Smaller
                                                        Banner<i> (20*20,max Size 20kb) </i></label>
                                                    <div class="col-sm-8">
                                                        <input type="file" class="form-control" id="banner_image_one"
                                                            name="banner_image_one" accept="image/*">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="bannerImage" class="col-sm-2 col-form-label">Larger
                                                        Banner<i> (50*50,max Size 20kb) </i></label>
                                                    <div class="col-sm-8">
                                                        <input type="file" class="form-control" id="banner_image_two"
                                                            name="banner_image_two" accept="image/*">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                   <div class="offset-sm-2">
                                                        <a href='#' class='text-blue view-image'
                                                        data-images="{{ $advertisement['banner_image'] }}">View Banner
                                                        Image</a>
                                                   </div>
                                                </div>

                                                <!-- /.card-body -->

                                                <div class="row d-flex justify-content-center">
                                                    <input type="submit" class="btn btn-primary mr-3" value="Submit" />
                                                    <button type="reset" class="btn btn-warning text-white">Clear</button>
                                                </div>
                                        </form>

                                    <!-- /.card -->

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

    <div class="modal fade" id="bannerImageValidator" tabindex="-1" role="dialog"
        aria-labelledby="bannerImageValidator" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body">
                    <div id="bannerImageValidatorBody">

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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#advertisementList').addClass('menu-open');
            $('#advertisementNav').addClass('active');
            $('#addAdvertisementNav').addClass('active');
        });

        $(document).on('click', '.view-image', function (e) {
            e.preventDefault();
            var imageSrc = $(this).attr('data-images');
            var imageArray = imageSrc.split(',');
            var title = $(this).attr('data-title');
            var imageDivTwo = "";
            imageDivOne = "<img src='"+'{{url("/uploads/ads/")}}/'+ imageArray[0] + "' class='img-responsive m-4' height='300px' width='300px' />";
            if(imageArray.length > 1){
                imageDivTwo = "<img src='"+'{{url("/uploads/ads/")}}/'+ imageArray[1] + "' class='img-responsive' height='300px' width='400px' />";
            }
            $('#bannerDiv').html("");
            $('#bannerDiv').html(imageDivOne+imageDivTwo);
            $('#viewBanner').modal('show');


            //$('#viewBanner').ekkoLightbox();
        })

        $(function() {

            //Date range picker
            $('#start_date').datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: +1,
            });

            //Date range picker
            $('#end_date').datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: +1,
            });
        });

        $('#editAdvertisementForm').validate({
            rules: {
                owner_name: {
                    required: true,

                },
                phone: {
                    required: true,
                    minlength: 9,
                    maxlength: 15
                },
                start_date: {
                    required: true,

                },
                end_date: {
                    required: true,

                }
            },
            messages: {
                owner_name: {
                    required: "Please enter owner name",

                },
                phone: {
                    required: "Please enter phone number",
                    minlength: "Your Phone must be at least 9 characters long",
                    maxLength: "Your Phone must be at maximum 15 characters long"
                },
                start_date: {
                    required: "Please enter start date for the advertisement",

                },
                end_date: {
                    required: "Please enter end date for the advertisement",

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

        $("#banner_image_one").change(function (e) {
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                width = 720;
                height = 1600;
                img.onload = function () {
                    if(this.width != width &&  this.height !=height){
                        //alert("Image dimension not accepted.The image you selected has "+"Width:" + this.width + "   Height: " + this.height);
                        document.getElementById('banner_image_one').value = '';
                        msg = "<p>"+"Image dimension not accepted.The image you selected has "+"Width:" + this.width+ " Height: "+ this.height +"</p>";
                        $('#bannerImageValidatorBody').html(msg);
                        $('#bannerImageValidator').modal('show');
                    }
                };
                img.src = _URL.createObjectURL(file);
            }
        });

        $("#banner_image_two").change(function (e) {
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                width = 720;
                height = 1600;
                img.onload = function () {
                    if(this.width != width &&  this.height !=height){
                        //alert("Image dimension not accepted.The image you selected has "+"Width:" + this.width + "  Height: " + this.height);
                        document.getElementById('banner_image_two').value = '';
                        msg = "<p>"+"Image dimension not accepted.The image you selected has "+"Width:" + this.width+ " Height: "+ this.height +"</p>";
                        $('#bannerImageValidatorBody').html(msg);
                        $('#bannerImageValidator').modal('show');
                    }
                };
                img.src = _URL.createObjectURL(file);
            }
        });

    </script>
@endsection
