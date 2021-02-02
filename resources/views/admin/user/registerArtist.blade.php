@extends('layouts.admin.contents')

@section('headSection')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{url('plugins/daterangepicker/daterangepicker.css')}}">

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
                            <a class="nav-link active" id="register-artist-tab" data-toggle="pill" href="#register-artist" role="tab" aria-controls="register-artist" aria-selected="true"> <span class="fa fa-plus-circle"> </span> Register Artist</a>
                          </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/User/activeArtists/0" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false"> <span class="fa fa-list"> </span> Active Artists</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/User/deactivatedArtists/0" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false"> <span class="fa fa-list"> </span> Blocked Artists</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/PendingArtist/allPendingArtists" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false"> <span class="fa fa-list"> </span> Pending Artists</a>
                        </li>

                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content">

                        <div class="tab-pane active" id="register-artist">


                            <section class="content-header">
                                <h1>
                                    <small>Register Artists</small>
                                </h1>
                            </section>

                            <form role="form" method="post" class="form-horizontal form-group" action="{{ url('User/addArtist') }}" enctype="multipart/form-data" id="addArtistForm">
                                {{ csrf_field() }}
                                <div class="card-body">

                                    <div class="row">
                                     <h4>Basic Information</h4>
                                    </div><br>

                                <div class="form-group row">
                                  <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" autofocus>
                                  </div>
                                </div>

                                <div class="form-group row">
                                    <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email Address</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email Address">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="location" class="col-sm-2 col-form-label">Location</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location Address">
                                    </div>
                                </div>

                                <div class="row">
                                    <h5> Bank Account Information</h5>
                                </div><br>


                                <div class="form-group row">
                                    <label for="bankName" class="col-sm-2 col-form-label">Bank Name</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Enter Bank Name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="accountName" class="col-sm-2 col-form-label">Account Name</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Enter Account Name">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="bankAccount" class="col-sm-2 col-form-label">Bank Account</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Enter Account Number">
                                    </div>
                                </div>


                                </div>
                              <!-- /.card-body -->

                              <div class="d-flex justify-content-center">
                                <input type="submit" class="btn btn-primary mr-3" value="Submit" />
                                <button type="reset" class="btn btn-warning text-white">Clear</button>
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

        $(function () {

            $('#userList').addClass('menu-open');
            $('#userNav').addClass('active');
            $('#artistNav').addClass('active');
            $("#messages").fadeOut(10000);
        });

        $('#addArtistForm').validate({
            rules: {
                first_name: {
                    required: true,
                    maxlength: 15,

                },
                last_name: {
                    required: true,
                    maxlength: 15,

                },
                phone: {
                    required: true,
                    minlength: 9,
                    maxlength: 10,
                    digits:true,
                },
                bank_name: {
                    required: true,
                    minlength: 2,
                    maxlength: 20,

                },
                account_name: {
                    required: true,
                    minlength: 2,
                    maxlength: 30,

                },
                account_number: {
                    required: true,
                    minlength: 1,
                    maxlength: 20,
                    digits:true,
                },
                email: {
                    email: true
                }
            },
            messages: {
                first_name: {
                    required: "Please enter first name",

                },
                last_name: {
                    required: "Please enter last name",

                },
                phone: {
                    required: "Please enter phone number",
                    minlength: "Your Phone must be at least 9 characters long",
                    maxLength: "Your Phone must be at maximum 15 characters long"
                },

                bank_name: {
                    required: "Please enter bank name",

                },
                account_number: {
                    required: "Please enter account number",

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
