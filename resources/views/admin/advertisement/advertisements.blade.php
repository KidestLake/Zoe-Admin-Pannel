@extends('layouts.admin.contents')
<?php
$activeOffset = 0;
$activePageNumber = 1;
$limit = 2;
$totalAd = 20;
?>
@section('headSection')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ url('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/fileinput.min.css') }}">

@endsection

@section('messageSection')

    @parent

    <section id="deactivateSuccessMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Advertisement deactivated successfully!!</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="deactivateFailMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-error alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Failed to deactivate advertisement. Try Again!</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="deleteSuccessMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Advertisement deleted successfully!!</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="deleteFailMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-error alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Failed to delete advertisement. Try Again!</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="activateSuccessMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Advertisement activated successfully!!</strong>
                </div>
            </div>
        </div>
    </section>

    <section id="activateFailMessage" style="display:none;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-error alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Failed to activate advertisement. Try Again!</strong>
                </div>
            </div>
        </div>
    </section>


@endsection
@section('contentSection')


    <section class="content m-2">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">

                    <input type="hidden" id="activeTabInput" name="activeTabInput" value="{{$activeTab}}"/>

                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">

                                <li class="nav-item">
                                    <a class="nav-link" id="add-advertisement-tab" data-toggle="pill"
                                        href="#add-advertisement" role="tab" aria-controls="add-advertisement"
                                        aria-selected="true" onclick="removeTabs()"> <span class="fa fa-plus-circle"> </span> Add Advertisement</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="active-advertisement-tab" data-toggle="pill"
                                        href="#active-advertisement" role="tab" aria-controls="active-advertisement"
                                        aria-selected="true"  onclick="removeTabs()"> <span class="fa fa-list"> </span> Active Advertisement</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="deactivated-advertisement-tab" data-toggle="pill"
                                        href="#deactivated-advertisement" role="tab"
                                        aria-controls="deactivated-advertisement" aria-selected="true"  onclick="removeTabs()"> <span
                                            class="fa fa-list"> </span> Deactivated Advertisement</a>
                                </li>

                                <li class="nav-item" style="display: none" id="elementUpdateDiv">
                                    <a class="nav-link" id="update-advertisement-tab" data-toggle="pill"
                                        href="#update-advertisement" role="tab"
                                        aria-controls="update-advertisement" aria-selected="true"> <span
                                            class="fa fa-list"> </span> Update Advertisement</a>
                                </li>

                                <li class="nav-item" style="display: none" id="elementActivateDiv">
                                    <a class="nav-link" id="activate-advertisement-tab" data-toggle="pill"
                                        href="#activate-advertisement" role="tab"
                                        aria-controls="activate-advertisement" aria-selected="true"> <span
                                            class="fa fa-list"> </span> Activate Advertisement</a>
                                </li>


                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <!--  d-flex justify-content-center-->
                                <div class="tab-pane" id="add-advertisement">
                                    <input type="hidden" id="currentAdvertisementId" />
                                    <section class="content-header">
                                        <h1>
                                            <small>Add Advertisement</small><br>
                                        </h1>
                                    </section>

                                    <form role="form" method="post" class="form-horizontal form-group"
                                        action="{{ url('advertisements/createAdvertisement') }}"
                                        enctype="multipart/form-data" id="addAdvertisementForm">
                                        {{ csrf_field() }}
                                        <div class="card-body justify-content-center">

                                            <div class="form-group row">
                                                <label for="ownerName" class="col-sm-2 col-form-label">Owner
                                                    Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="owner_name"
                                                        name="owner_name" placeholder="Owner full name" autofocus>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="phone" name="phone"
                                                        placeholder="0911.....">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="link" class="col-sm-2 col-form-label">Link</label>
                                                <div class="col-sm-10">
                                                    <input type="url" class="form-control" id="url" name="url"
                                                        placeholder="Enter link to advertisement element if any">
                                                </div>
                                            </div>

                                            <!-- Date -->
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Start Date:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="start_date" name="start_date"
                                                        class="form-control" placeholder="2021-01-28" />
                                                </div>
                                            </div>

                                            <!-- Date -->
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">End Date:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="end_date" name="end_date" class="form-control"
                                                        placeholder="2021-01-28" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="bannerImage" class="col-sm-2 col-form-label">Smaller
                                                    Banner</label>
                                                <div class="col-sm-10">
                                                    <input type="file" class="form-control" id="banner_image_one"
                                                        name="banner_image_one" accept="image/*">
                                                </div>
                                                <div class="offset-sm-2">
                                                    <i>(20*20,max Size 20kb) </i>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="bannerImage" class="col-sm-2 col-form-label">Larger
                                                    Banner</label>
                                                <div class="col-sm-10">
                                                    <input type="file" class="form-control" id="banner_image_two"
                                                        name="banner_image_two" accept="image/*">
                                                </div>

                                                <div class="offset-sm-2">
                                                    <i>(50*50,max Size 20kb) </i>
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

                                <div class="tab-pane" id="active-advertisement">
                                    <p class="float-right">
                                        <input type="text" id="activeSearchText" placeholder="Search owner name,phone">
                                        <button class="btn btn-default" id="clearActiveSearch"
                                            onclick="clearActiveSearchEntry()">
                                            Clear
                                        </button>
                                    </p>
                                    <div id="active_table_data">

                                    </div>
                                </div>


                                <div class="tab-pane" id="deactivated-advertisement">

                                    <p class="float-right">
                                        <input type="text" id="deactivatedSearchText" placeholder="Search owner name,phone">
                                        <button class="btn btn-default" id="clearActiveSearch"
                                            onclick="clearDeactivatedSearchEntry()">
                                            Clear
                                        </button>
                                    </p>
                                    <div id="deactivated_table_data">

                                    </div>
                                </div>

                                <div class="tab-pane" id="update-advertisement">

                                    <div id="update_div">

                                    </div>
                                </div>

                                <div class="tab-pane" id="activate-advertisement">

                                    <div id="activate_div">

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>

    <div class="modal fade" id="bannerImageValidator" tabindex="-1" role="dialog" aria-labelledby="bannerImageValidator"
        aria-hidden="true">
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

    <div class="modal fade" tabindex="-1" role="dialog" id="deactivateAdvertisementModal">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Deactivate Advertisement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to deactivate the
                        advertisement?
                    </p>
                </div>
                <div class="modal-footer float-right">
                    <button class="btn btn-danger" onclick="deactivateAdvertisement()">Deactivate</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="deleteAdvertisementModal">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Advertisement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the advertisement?
                    </p>
                </div>
                <div class="modal-footer float-right">
                    <button onclick="deleteAdvertisement()" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>


    <div class="modal fade" id="viewBanner" tabindex="-1" role="dialog" aria-labelledby="viewBannerLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Banner</h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    <div id="bannerDiv"></div>
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
    <script src="{{ url('js/fileinput.min.js') }}"></script>

    <!-- DataTables -->
    <script src="{{ url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ url('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ url('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script type="text/javascript">
        var loading ='<br><div id="loading" class="row d-flex justify-content-center"><div class="row"><img src="'+"{{ url('/images/loading.gif') }}"+'"/></div></div>';
        $(document).ready(function() {

            $('#advertisementList').addClass('menu-open');
            $('#advertisementNav').addClass('active');
            $('#addAdvertisementNav').addClass('active');

            var activeTabVal = document.getElementById('activeTabInput').value;
            if (activeTabVal == 11) {
                $('#add-advertisement-tab').addClass('active');
                $('#add-advertisement').addClass('active');
            }else if(activeTabVal == 22){
                $('#active-advertisement-tab').addClass('active');
                $('#active-advertisement').addClass('active');
            }else if(activeTabVal == 33){
                $('#deactivated-advertisement-tab').addClass('active');
                $('#deactivated-advertisement').addClass('active');
            }


        $('#active_table_data').html(loading);
        $('#deactivated_table_data').html(loading);

            $("#messages").fadeOut(10000);

            $('#start_date').datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: +1,
            });

            //Date range picker
            $('#end_date').datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: +2,
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

            $.ajax({
                url: "{{ url('/advertisements/activeAdvertisements/0') }}",
                type: 'get',
                success: function(data) {
                    $('#active_table_data').html(data);
                    $('#activeAdvertisements').DataTable({
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

            $.ajax({
                url: "{{ url('/advertisements/deactivatedAdvertisements/0') }}",
                type: 'get',
                success: function(data) {
                    $('#deactivated_table_data').html(data);
                    $('#deactivatedAdvertisements').DataTable({
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

        });


        $(document).on('click', '.view-image', function(e) {
            e.preventDefault();
            var imageSrc = $(this).attr('data-images');
            var imageArray = imageSrc.split(',');
            var title = $(this).attr('data-title');
            var imageDivTwo = "";
            imageDivOne = "<img src='" + '{{url("/uploads/ads/") }}/' + imageArray[0] +
                "' class='img-responsive m-4' height='300px' width='300px' />";
            if (imageArray.length > 1) {
                imageDivTwo = "<img src='" + '{{url("/uploads/ads/") }}/' + imageArray[1] +
                    "' class='img-responsive' height='300px' width='400px' />";
            }
            $('#bannerDiv').html("");
            $('#bannerDiv').html(imageDivOne + imageDivTwo);
            $('#viewBanner').modal('show');


            //$('#viewBanner').ekkoLightbox();
        });

        function deactivateModalOpen(selectedId) {
            document.getElementById('currentAdvertisementId').value = selectedId;
            $('#deactivateAdvertisementModal').modal('show');

        }

        function deleteModalOpen(selectedId) {
            document.getElementById('currentAdvertisementId').value = selectedId;
            $('#deleteAdvertisementModal').modal('show');

        }

        function loadMoreActiveAdvertisements(offsetVal, pageNumberVal) {
            $('#active_table_data').html(loading);
            $.ajax({
                url: "{{ url('advertisements/activeAdvertisements') }}" + '/' + offsetVal + '/' + pageNumberVal,
                type: 'get',
                success: function(data) {
                    $('#active_table_data').html(data);
                    $('#activeAdvertisements').DataTable({
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
        }

        function loadMoreDeactivatedAdvertisements(offsetVal, pageNumberVal) {
            $('#deactivated_table_data').html(loading);
            $.ajax({
                url: "{{ url('advertisements/deactivatedAdvertisements') }}" + '/' + offsetVal + '/' + pageNumberVal,
                type: 'get',
                success: function(data) {
                    $('#deactivated_table_data').html(data);
                    $('#deactivatedAdvertisements').DataTable({
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
        }

        var activeSearchField = document.getElementById('activeSearchText');
        activeSearchField.addEventListener("keydown", function(e) {
            var activeSearchInput = activeSearchField.value;
            if (e.keyCode === 13) { //checks whether the pressed key is "Enter"
                searchForActiveAd(activeSearchInput);
            }
        });

        var deactivatedSearchField = document.getElementById('deactivatedSearchText');
        deactivatedSearchField.addEventListener("keydown", function(e) {
            var deactivatedSearchInput = deactivatedSearchField.value;
            if (e.keyCode === 13) { //checks whether the pressed key is "Enter"
                searchForDeactivatedAd(deactivatedSearchInput);
            }
        });


        function searchForActiveAd(searchInput) {
            if (searchInput != "") {

                $('#active_table_data').html(loading);

                $.ajax({
                    url: "{{ url('advertisements/searchActiveAdvertisement') }}" + '/' + searchInput,
                    type: 'get',
                    success: function(data) {
                        $('#active_table_data').html(data);
                        $('#searchedActiveAdvertisements').DataTable({
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


            }
        }

        function searchForDeactivatedAd(searchInput) {
            if (searchInput != "") {

                $('#deactivated_table_data').html(loading);

                $.ajax({
                    url: "{{ url('advertisements/searchDeactivatedAdvertisement') }}" + '/' + searchInput,
                    type: 'get',
                    success: function(data) {
                        $('#deactivated_table_data').html(data);
                        $('#searchedDeactivatedAdvertisements').DataTable({
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


            }
        }


        function clearActiveSearchEntry() {

            var searchInput = document.getElementById('activeSearchText').value;
            if (searchInput != "") {
                document.getElementById('activeSearchText').value = "";
                $('#active_table_data').html(loading);
                $.ajax({
                url: "{{ url('/advertisements/activeAdvertisements/0') }}",
                type: 'get',
                success: function(data) {
                    $('#active_table_data').html(data);
                    $('#activeAdvertisements').DataTable({

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

            }

        }

        function clearDeactivatedSearchEntry() {

            var searchInput = document.getElementById('deactivatedSearchText').value;
            if (searchInput != "") {
                document.getElementById('deactivatedSearchText').value = "";
                $('#deactivated_table_data').html(loading);
                $.ajax({
                url: "{{ url('/advertisements/deactivatedAdvertisements/0') }}",
                type: 'get',
                success: function(data) {
                    $('#deactivated_table_data').html(data);
                    $('#deactivatedAdvertisements').DataTable({

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
            }

        }

        function deactivateAdvertisement() {

            id = document.getElementById('currentAdvertisementId').value;
            $.ajax({
                url: "{{ url('advertisements/deactivateAdvertisement/') }}" + '/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response) {
                        $('#deactivateAdvertisementModal').modal('hide');
                        document.getElementById('deactivateSuccessMessage').style.display = 'inline';
                        $('#tr'+id).fadeOut(3000);
                        $('#deactivateSuccessMessage').fadeOut(3000);
                        $.ajax({
                            url: "{{ url('/advertisements/deactivatedAdvertisements/0') }}",
                            type: 'get',
                            success: function(data) {
                                $('#deactivated_table_data').html(data);
                                $('#deactivatedAdvertisements').DataTable({

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

                    } else {
                        document.getElementById('deactivateFailMessage').style.display = 'inline';
                        $('#deactivateFailMessage').fadeOut(3000);
                    }
                    //location.reload(true);
                }
            });

        }

        function deleteAdvertisement() {
            id = document.getElementById('currentAdvertisementId').value;
            $.ajax({
                url: "{{ url('advertisements/destroy') }}" + '/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response) {
                        $('#deleteAdvertisementModal').modal('hide');
                        document.getElementById('deleteSuccessMessage').style.display = 'inline';
                        $('#tr' + id).fadeOut(3000);
                        $('#deleteSuccessMessage').fadeOut(3000);
                    } else {
                        document.getElementById('deleteFailMessage').style.display = 'inline';
                        $('#deleteFailMessage').fadeOut(3000);
                    }
                    //location.reload(true);
                }
            });

        }

        $("#edit_banner_image_one").change(function (e) {
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                width = 720;
                height = 1600;
                img.onload = function () {
                    if(this.width != width &&  this.height !=height){
                        //alert("Image dimension not accepted.The image you selected has "+"Width:" + this.width + "   Height: " + this.height);
                        document.getElementById('edit_banner_image_one').value = '';
                        msg = "<p>"+"Image dimension not accepted.The image you selected has "+"Width:" + this.width+ " Height: "+ this.height +"</p>";
                        $('#bannerImageValidatorBody').html(msg);
                        $('#bannerImageValidator').modal('show');
                    }
                };
                img.src = _URL.createObjectURL(file);
            }
        });

        $("#edit_banner_image_two").change(function (e) {
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                width = 720;
                height = 1600;
                img.onload = function () {
                    if(this.width != width &&  this.height !=height){
                        //alert("Image dimension not accepted.The image you selected has "+"Width:" + this.width + "  Height: " + this.height);
                        document.getElementById('edit_banner_image_two').value = '';
                        msg = "<p>"+"Image dimension not accepted.The image you selected has "+"Width:" + this.width+ " Height: "+ this.height +"</p>";
                        $('#bannerImageValidatorBody').html(msg);
                        $('#bannerImageValidator').modal('show');
                    }
                };
                img.src = _URL.createObjectURL(file);
            }
        });

        function updateAdvertisementPage(id){
            document.getElementById('elementActivateDiv').style.display = "none";

            var elementOne = document.getElementById('active-advertisement-tab');
            var elementwo = document.getElementById('active-advertisement');
            elementOne.classList.remove("active");
            elementwo.classList.remove("active");

            var elementThree = document.getElementById('update-advertisement-tab');
            var elementFour = document.getElementById('update-advertisement');

            $('#update_div').html(loading);

            $.ajax({
                url: "{{ url('advertisements/updateAdvertisement') }}" + '/' + id,
                type: 'get',
                success: function(data) {

                    $('#update_div').html(data);

                    document.getElementById('elementUpdateDiv').style.display = "inline";
                    elementThree.classList.add("active");
                    elementFour.classList.add("active");
                    //location.reload(true);
                }
            })
        }

        var _URL = window.URL;

$("#activate_banner_image_one").change(function (e) {
    var file, img;
    if ((file = this.files[0])) {
        img = new Image();
        width = 720;
        height = 1600;
        img.onload = function () {
            if(this.width != width &&  this.height !=height){
                //alert("Image dimension not accepted.The image you selected has "+"Width:" + this.width + "   Height: " + this.height);
                document.getElementById('activate_banner_image_one').value = '';
                msg = "<p>"+"Image dimension not accepted.The image you selected has "+"Width:" + this.width+ " Height: "+ this.height +"</p>";
                $('#bannerImageValidatorBody').html(msg);
                $('#bannerImageValidator').modal('show');
            }
        };
        img.src = _URL.createObjectURL(file);
    }
});

$("#activate_banner_image_two").change(function (e) {
    var file, img;
    if ((file = this.files[0])) {
        img = new Image();
        width = 720;
        height = 1600;
        img.onload = function () {
            if(this.width != width &&  this.height !=height){
                //alert("Image dimension not accepted.The image you selected has "+"Width:" + this.width + "  Height: " + this.height);
                document.getElementById('activate_banner_image_two').value = '';
                msg = "<p>"+"Image dimension not accepted.The image you selected has "+"Width:" + this.width+ " Height: "+ this.height +"</p>";
                $('#bannerImageValidatorBody').html(msg);
                $('#bannerImageValidator').modal('show');
            }
        };
        img.src = _URL.createObjectURL(file);
    }
});

        function activateAdvertisementPage(id){

            document.getElementById('elementUpdateDiv').style.display = "none";

            var elementOne = document.getElementById('deactivated-advertisement-tab');
            var elementwo = document.getElementById('deactivated-advertisement');
            elementOne.classList.remove("active");
            elementwo.classList.remove("active");

            var elementThree = document.getElementById('activate-advertisement-tab');
            var elementFour = document.getElementById('activate-advertisement');

            $('#activate_div').html(loading);


            $.ajax({
                url: "{{ url('advertisements/activateAdvertisement') }}" + '/' + id,
                type: 'get',
                success: function(data) {

                    $('#activate_div').html(data);

                    document.getElementById('elementActivateDiv').style.display = "inline";
                    elementThree.classList.add("active");
                    elementFour.classList.add("active");
                    //location.reload(true);
                    $('#active_table_data').html(loading);
                    $.ajax({
                        url: "{{ url('/advertisements/activeAdvertisements/0') }}",
                        type: 'get',
                        success: function(data) {
                            $('#active_table_data').html(data);
                            $('#activeAdvertisements').DataTable({
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

                }
            })
        }



        function removeTabs() {
            document.getElementById('elementUpdateDiv').style.display = "none";
            document.getElementById('elementActivateDiv').style.display = "none";
        }

    </script>
@endsection
