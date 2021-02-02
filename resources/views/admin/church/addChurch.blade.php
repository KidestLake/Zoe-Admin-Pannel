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
                                    <a class="nav-link active" id="add-church-tab" data-toggle="pill" href="#add-church"
                                        role="tab" aria-controls="add-church" aria-selected="true"> <span
                                            class="fa fa-plus-circle"> </span> Add Church</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="/Church/getChurches/0" role="tab"
                                        aria-controls="custom-tabs-four-profile" aria-selected="false"> <span
                                            class="fa fa-list"> </span>
                                        Churches</a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">

                                <div class="tab-pane active" id="add-church">

                                    <section class="content-header">
                                        <h1>
                                            <small>Add Church</small><br>
                                        </h1>
                                    </section>

                                    <form role="form" method="post" class="form-horizontal form-group"
                                                action="{{ url('Church/create') }}" enctype="multipart/form-data"
                                                id="addChurchForm">
                                                {{ csrf_field() }}
                                                <div class="card-body">

                                                    <div class="row">
                                                        <h5> Basic Information </h5>
                                                    </div><br>

                                                    <div class="form-group row">
                                                        <label for="churchAdmin" class="col-sm-2 col-form-label"> Church
                                                            Administrator </label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="user_id"
                                                                name="user_id"
                                                                placeholder="Enter church administrator name">
                                                        </div>
                                                    </div>


                                                    <div class="form-group row">
                                                        <label for="churchName" class="col-sm-2 col-form-label">
                                                            Name</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="name" name="name"
                                                                placeholder="Enter Church Name" autofocus>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="phone" class="col-sm-2 col-form-label">Phone
                                                            Number</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="phone" name="phone"
                                                                placeholder="Enter Phone Number">
                                                        </div>
                                                    </div>


                                                    <div class="form-group row">
                                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="email" name="email"
                                                                placeholder="Enter Email">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="link" class="col-sm-2 col-form-label">Website</label>
                                                        <div class="col-sm-8">
                                                            <input type="url" class="form-control" id="website"
                                                                name="website" placeholder="Enter website link if any">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <h5> Address Information </h5>
                                                    </div><br>

                                                    <div class="row">
                                                        <div class="form-group col-md-5">
                                                            <label for="country">Country</label>
                                                            <input type="text" class="form-control" id="country"
                                                                name="country" placeholder="Enter Country">
                                                        </div>
                                                        <div class="form-group col-md-5">
                                                            <label for="city">City</label>
                                                            <input type="text" class="form-control" id="city" name="city"
                                                                placeholder="Enter City">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-md-5">
                                                            <label for="subCity">Sub-City</label>
                                                            <input type="text" class="form-control" id="subcity"
                                                                name="subcity" placeholder="Enter Sub-City">
                                                        </div>
                                                        <div class="form-group col-md-5">
                                                            <label for="woreda">Woreda</label>
                                                            <input type="text" class="form-control" id="woreda"
                                                                name="woreda" placeholder="Enter Woreda">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="location" class="col-sm-2 col-form-label">Specific
                                                            Location</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="location"
                                                                name="location" placeholder="Enter Specific location">
                                                        </div>
                                                    </div>


                                                    <!-- /.card-body -->

                                                    <div class="d-flex justify-content-center">
                                                        <input type="submit" class="btn btn-primary mr-3" value="Submit" />
                                                        <button type="reset"
                                                            class="btn btn-warning text-white">Clear</button>
                                                    </div>
                                                </div>
                                            </form>


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
    <script src="{{ url('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ url('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ url('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ url('plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#churchNav').addClass('active');
        });


        $('#addChurchForm').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 25,

                },
                phone: {
                    required: true,
                    minlength: 9,
                    maxlength: 10,
                    digits:true
                },
                email: {
                    email: true
                },
                country: {
                    required: true,

                },
                city: {
                    required: true,

                },
                subcity: {
                    required: true,

                },
                woreda: {
                    required: true,

                }
            },
            messages: {
                owner_name: {
                    required: "Please enter church name",

                },
                phone: {
                    required: "Please enter phone number",
                    minlength: "Your Phone must be at least 9 characters long",
                    maxLength: "Your Phone must be at maximum 15 characters long"
                },
                country: {
                    required: "Please enter country where the church is located",

                },
                city: {
                    required: "Please enter city where the church is located",

                },
                subcity: {
                    required: "Please enter sub-city where the church is located",

                },
                woreda: {
                    required: "Please enter woreda where the church is located",

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

    </script>
@endsection
