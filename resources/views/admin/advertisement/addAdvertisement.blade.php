@extends('layouts.admin.contents')

@section('headSection')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ url('plugins/daterangepicker/daterangepicker.css') }}">

@endsection

@section('buttonDivSection')
    <!--<section class="row pt-2">
            <div class="col-md-12">
                <a href="#" type="button" class="btn btn-primary float-right" data-toggle="modal"
                    data-target="#changeDefaultAdBannerModal">
                    Change Default Ad Banner</a>
            </div>
        </section>-->
@endsection

@section('contentSection')


    <section class="content m-2">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">

                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">

                                <li class="nav-item">
                                    <a class="nav-link active" id="add-advertisement-tab" data-toggle="pill"
                                        href="#add-advertisement" role="tab" aria-controls="add-advertisement"
                                        aria-selected="true"> <span class="fa fa-plus-circle"> </span> Add Advertisement</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="/Advertisement/activeAdvertisements/0" role="tab"
                                        aria-controls="custom-tabs-four-profile" aria-selected="false"> <span
                                            class="fa fa-list"> </span> Active Advertisements</a>

                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="/Advertisement/deactivatedAdvertisements/0" role="tab"
                                        aria-controls="custom-tabs-four-profile" aria-selected="false"><span
                                            class="fa fa-list"> </span> Deactivated Advertisements</a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <!--  d-flex justify-content-center-->
                                <div class="tab-pane active " id="add-advertisement">

                                    <section class="content-header">
                                        <h1>
                                            <small>Add Advertisement</small><br>
                                        </h1>
                                    </section>

                                    <form role="form" method="post" class="form-horizontal form-group"
                                        action="{{ url('Advertisement/createAdvertisement') }}"
                                        enctype="multipart/form-data" id="addAdvertisementForm">
                                        {{ csrf_field() }}
                                        <div class="card-body justify-content-center">

                                            <div class="form-group row">
                                                <label for="ownerName" class="col-sm-2 col-form-label">Owner
                                                    Name</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="owner_name"
                                                        name="owner_name" placeholder="Owner full name" autofocus>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="phone" name="phone"
                                                        placeholder="0911.....">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="link" class="col-sm-2 col-form-label">Link</label>
                                                <div class="col-sm-8">
                                                    <input type="url" class="form-control" id="url" name="url"
                                                        placeholder="Enter link to advertisement element if any">
                                                </div>
                                            </div>

                                            <!-- Date -->
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Start Date:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="start_date" name="start_date"
                                                        class="form-control" placeholder="2021-01-28" />
                                                </div>
                                            </div>

                                            <!-- Date -->
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">End Date:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="end_date" name="end_date" class="form-control"
                                                        placeholder="2021-01-28" />
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

                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>


        </div>
        </div>
    </section>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.0.0/js/fileinput.min.js"
        integrity="sha512-z/EXjm2wtdHB91wQ8xQfNwpGFxkV+Umn0mwXZ3YjF5/Zy1LDzG8m4pnwuk/OEaP+nNOAW0My2Y18DP5+GHCNGQ=="
        crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#advertisementList').addClass('menu-open');
            $('#advertisementNav').addClass('active');
            $('#addAdvertisementNav').addClass('active');
        });

        $(function() {

            //Date range picker
            $('#start_date').datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: +1,
            });

            //Date range picker
            $('#end_date').datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: +2,
            });
        });

        $('#addAdvertisementForm').validate({
            rules: {
                owner_name: {
                    required: true,
                    maxlength: 20,

                },
                phone: {
                    required: true,
                    minlength: 9,
                    maxlength: 10,
                    digits: true,
                },
                banner_image_one: {
                    required: true,
                    extension: "jpg,jpeg,png",

                },
                banner_image_two: {
                    required: true,
                    extension: "jpg,jpeg,png",

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
                    maxLength: "Your Phone must be at maximum 15 characters long",

                },
                banner_image: {
                    required: "Please provide an image for the advertisement",

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
