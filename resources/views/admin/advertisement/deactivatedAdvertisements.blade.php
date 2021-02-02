@extends('layouts.admin.contents')

@section('headSection')

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">


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
                                    <a class="nav-link active" id="deactivated-advertisement-tab" data-toggle="pill"
                                        href="#deactivated-advertisement" role="tab"
                                        aria-controls="deactivated-advertisement" aria-selected="true"> <span
                                            class="fa fa-list"> </span> Deactivated Advertisements</a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">

                                <div class="tab-pane active" id="deactivated-advertisement">
                                    <input type="hidden" id="currentAdvertisementId" />
                                    <p class="float-right">
                                        <input type="text" id="mySearchText" placeholder="Search owner name,phone"
                                            onchange="checkIfEmpty()">
                                        <button class="btn btn-default" id="clearSearch" onclick="clearSearchEntry()">
                                            Clear
                                        </button>
                                    </p>
                                    <table id="deactivatedAdvertisements" class="table table-bordered table-striped">

                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Owner Name</th>
                                                <th>Phone</th>
                                                <th>Banner </th>
                                                <th>Start Date</th>
                                                <th>End Date </th>
                                                <th>Link </th>
                                                <th>Created At </th>
                                                <th>Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($deactivatedAdvertisements as $key => $value)
                                                <tr id="tr{{ $value['id'] }}">
                                                    <td>{{ $offset + $key + 1 }}</td>
                                                    <td>{{ $value['owner_name'] }}</td>
                                                    <td>{{ $value['phone'] }}</td>
                                                    <td><a href='#' class='text-blue view-image'
                                                            data-images="{{ $value['banner_image'] }}">View Banner</a>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $toFormatStartDate = new DateTime($value['start_date']);
                                                        $startDate = $toFormatStartDate->format('M j, Y');
                                                        echo $startDate;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $toFormatEndDate = new DateTime($value['end_date']);
                                                        $endDate = $toFormatEndDate->format('M j, Y');
                                                        echo $endDate;
                                                        ?>
                                                    </td>
                                                    @if ($value['url'])
                                                        <td><a href='{{ $value['url'] }}' class='text-blue'
                                                                target="_blank">Open</a></td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                    <td>
                                                        <?php
                                                        $toCreatedAt = new DateTime($value['created_at']);
                                                        $createdDate = $toCreatedAt->format('M j, Y');
                                                        echo $createdDate;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <div class='dropdown'>
                                                            <button
                                                                class='btn btn-secondary btn-sm btn-flat dropdown-toggle'
                                                                type='button' data-toggle='dropdown'>Menu<span
                                                                    class='caret'></span></button>
                                                            <ul class='dropdown-menu dropdown-menu-right p-3'>

                                                                <li><a class="text-secondary"
                                                                        href="{{ url('Advertisement/activateAdvertisement/' . $value['id']) }}">
                                                                        <span class="fas fa-check mr-2"></span> Activate</a>
                                                                </li>

                                                                <li><a href='#' class="text-secondary" data-toggle="modal"
                                                                        data-target="#deleteAdvertisementModal"
                                                                        nclick="deleteModalOpen({{ $value['id'] }})">
                                                                        <span class="fas fa-trash-alt mr-2"></span>
                                                                        Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>

                                            @endforeach
                                        </tbody>

                                    </table>

                                    <div class="row d-flex justify-content-end">
                                        <nav aria-label="Page navigation" id="paginationDiv">
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
                                                        <a class="page-link"
                                                            href="{{ url('Advertisement/deactivatedAdvertisements/' . ($offset - $limit) . '/' . ($pageNumber - 1)) }}"
                                                            aria-label="Previous">
                                                            <span aria-hidden="true">&laquo;</span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if ($pageNumber > 3)
                                                    <li class="page-item"><a class="page-link"
                                                            href="{{ url('Advertisement/deactivatedAdvertisements/' . ($offset - $limit * 3) . '/' . ($pageNumber - 3)) }}">{{ $pageNumber - 3 }}</a>
                                                    </li>
                                                @endif
                                                @if ($pageNumber > 2)
                                                    <li class="page-item"><a class="page-link"
                                                            href="{{ url('Advertisement/deactivatedAdvertisements/' . ($offset - $limit * 2) . '/' . ($pageNumber - 2)) }}">{{ $pageNumber - 2 }}</a>
                                                    </li>
                                                @endif
                                                @if ($pageNumber > 1)
                                                    <li class="page-item"><a class="page-link"
                                                            href="{{ url('Advertisement/deactivatedAdvertisements/' . ($offset - $limit) . '/' . ($pageNumber - 1)) }}">{{ $pageNumber - 1 }}</a>
                                                    </li>
                                                @endif

                                                <li class="page-item active"> <a class="page-link">{{ $pageNumber }} <span
                                                            class="sr-only">(current)</span></a></li>

                                                @if ($offset + $limit < $totalAd)
                                                    <li class="page-item"><a class="page-link"
                                                            href="{{ url('Advertisement/deactivatedAdvertisements/' . ($offset + $limit) . '/' . ($pageNumber + 1)) }}">{{ $pageNumber + 1 }}</a>
                                                    </li>
                                                @endif
                                                @if ($offset + 2 * $limit < $totalAd)
                                                    <li class="page-item"><a class="page-link"
                                                            href="{{ url('Advertisement/deactivatedAdvertisements/' . ($offset + $limit * 2) . '/' . ($pageNumber + 2)) }}">{{ $pageNumber + 2 }}</a>
                                                    </li>
                                                @endif
                                                @if ($offset + 3 * $limit < $totalAd)
                                                    <li class="page-item"><a class="page-link"
                                                            href="{{ url('Advertisement/deactivatedAdvertisements/' . ($offset + $limit * 3) . '/' . ($pageNumber + 3)) }}">{{ $pageNumber + 3 }}</a>
                                                    </li>
                                                @endif

                                                @if ($offset + $limit == $totalAd || $offset + $limit > $totalAd)
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1">
                                                            <span aria-hidden="true">&raquo;</span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li class="page-item">
                                                        <a class="page-link"
                                                            href="{{ url('Advertisement/deactivatedAdvertisements/' . ($offset + $limit) . '/' . ($pageNumber + 1)) }}"
                                                            aria-label="Next">
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

    <div class="modal fade" id="viewBanner" data-backdrop="static" tabindex="-2" role="dialog"
        aria-labelledby="viewBannerLabel" aria-hidden="true">
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
        var table;
        $(function() {

            $('#advertisementList').addClass('menu-open');
            $('#advertisementNav').addClass('active');
            $('#deactivatedAdvertisementNav').addClass('active');

            table = $("#deactivatedAdvertisements").DataTable({
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

            $("#messages").fadeOut(10000);

            //Date range picker
            $('#start_date').datepicker({
                dateFormat: 'yy-mm-dd',
            });

            //Date range picker
            $('#end_date').datepicker({
                dateFormat: 'yy-mm-dd',
            });
        });

        $(document).on('click', '.view-image', function(e) {
            e.preventDefault();
            var imageSrc = $(this).attr('data-images');
            var imageArray = imageSrc.split(',');
            var title = $(this).attr('data-title');
            var imageDivTwo = "";
            imageDivOne = "<img src='" + '{{ url(' / uploads / ads / ') }}/' + imageArray[0] +
                "' class='img-responsive m-4' height='300px' width='300px' />";
            if (imageArray.length > 1) {
                imageDivTwo = "<img src='" + '{{ url(' / uploads / ads / ') }}/' + imageArray[1] +
                    "' class='img-responsive' height='300px' width='400px' />";
            }
            $('#bannerDiv').html("");
            $('#bannerDiv').html(imageDivOne + imageDivTwo);
            $('#viewBanner').modal('show');
        });


        function deleteModalOpen(selectedId) {
            document.getElementById('currentAdvertisementId').value = selectedId;
            $('#deleteAdvertisementModal').modal('show');

        }


        function deleteAdvertisement() {
            id = document.getElementById('currentAdvertisementId').value;
            $.ajax({
                url: "{{ url('Advertisement/destroy') }}" + '/' + id,
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

        var searchField = document.getElementById('mySearchText');
        searchField.addEventListener("keydown", function(e) {
            var searchInput = searchField.value;
            if (e.keyCode === 13) { //checks whether the pressed key is "Enter"
                searchForAd(searchInput);
            }
        });

        function checkIfEmpty() {
            var searchInput = searchField.value;
            if (searchInput == '') {
                location.reload();
            }
        }

        function searchForAd(searchInput) {
            if (searchInput != "") {

                table.destroy();
                document.getElementById('paginationDiv').style.display = "none";


                table = $('#deactivatedAdvertisements').DataTable({
                    'ajax': "{{ url('Advertisement/searchDeactivatedAdvertisement') }}" + '/' + searchInput,
                    'order': [],
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

            } else {
                location.reload();
            }
        }

        function clearSearchEntry() {

            document.getElementById('mySearchText').value = "";
            location.reload();

        }

    </script>
@endsection
