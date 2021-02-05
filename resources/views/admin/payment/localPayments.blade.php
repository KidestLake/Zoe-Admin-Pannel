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
                            <a class="nav-link active" id="notPayedPayment-tab" data-toggle="pill" href="#notPayedPayment" role="tab" aria-controls="notPayedPayment" aria-selected="true"> <span class="fa fa-list"> </span> Local Payment(Not Payed)</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="payedPayment-tab" data-toggle="pill" href="#payedPayment" role="tab" aria-controls="payedPayment" aria-selected="true"> <span class="fa fa-list"> </span> Local Payment(Payed)</a>
                        </li>


                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content">

                        <div class="tab-content">

                            <div class="tab-pane active" id="notPayedPayment">
                                <p class="float-right">
                                    <input type="text" id="searchNotPayed" placeholder="Search artist name">
                                    <button class="btn btn-default" id="clearSearchNotPayed" onclick="clearSearchNotPayedEntry()">
                                        Clear
                                    </button>
                                </p>

                                <div id="not_payed_table_data">

                                </div>

                            </div>

                            <div class="tab-pane" id="payedPayment">

                                <p class="float-right">
                                    <input type="text" id="searchPayed" placeholder="Search artist name">
                                    <button class="btn btn-default" id="clearSearchPayed" onclick="clearSearchPayedEntry()">
                                        Clear
                                    </button>
                                </p>

                                <div id="payed_table_data">

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
        var loading ='<br><div id="loading" class="row d-flex justify-content-center"><div class="row"><img src="'+"{{ url('/images/loading.gif') }}"+'"/></div></div>';
        $(function () {
            $('#paymentList').addClass('menu-open');
            $('#paymentNav').addClass('active');
            $('#localPaymentNav').addClass('active');

            var activeTabVal = document.getElementById('activeTabInput').value;
            if (activeTabVal == 11) {
                $('#notPayedPayment-tab').addClass('active');
                $('#notPayedPayment').addClass('active');
            }else if(activeTabVal == 22){
                $('#payedPayment-tab').addClass('active');
                $('#payedPayment').addClass('active');
            }

            $('#not_payed_table_data').html(loading);
            $('#payed_table_data').html(loading);

            $.ajax({
                url: "{{ url('payments/localPaymentsNotPayed/0') }}",
                type: 'get',
                success: function(data) {
                    $('#not_payed_table_data').html(data);
                    $('#localPaymentNotPayed').DataTable({
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
                url: "{{ url('payments/localPaymentsPayed/0') }}",
                type: 'get',
                success: function(data) {
                    $('#payed_table_data').html(data);
                    $('#localPaymentPayed').DataTable({
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
            $("#messages").fadeOut(10000);
        });


        function loadMorelocalNotPayed(offsetVal, pageNumberVal) {
            $('#not_payed_table_data').html(loading);
            $.ajax({
                url: "{{ url('payments/localPaymentsNotPayed/') }}" + '/' + offsetVal + '/' + pageNumberVal,
                type: 'get',
                success: function(data) {
                    $('#not_payed_table_data').html(data);
                    $('#localPaymentNotPayed').DataTable({
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

        function loadMorelocalPayed(offsetVal, pageNumberVal) {
            $('#payed_table_data').html(loading);
            $.ajax({
                url: "{{ url('payments/localPaymentsPayed/') }}" + '/' + offsetVal + '/' + pageNumberVal,
                type: 'get',
                success: function(data) {
                    $('#payed_table_data').html(data);
                    $('#localPaymentPayed').DataTable({
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


        var searchFieldNotPayed = document.getElementById('searchNotPayed');
        searchFieldNotPayed.addEventListener("keydown", function(e) {
            var searchInput = searchFieldNotPayed.value;
            if (e.keyCode === 13) { //checks whether the pressed key is "Enter"
                searchForINotPayed(searchInput);
            }
        });

        function searchForINotPayed(searchInput) {
            if (searchInput != "") {

                $('#not_payed_table_data').html(loading);

                $.ajax({
                    url: "{{ url('payments/searchLNotPayed') }}" + '/' + searchInput,
                    type: 'get',
                    success: function(data) {
                        $('#not_payed_table_data').html(data);
                        $('#searchedNotPayedPayment').DataTable({
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

        function clearSearchNotPayedEntry() {

            var searchInput = document.getElementById('searchNotPayed').value;
            if (searchInput != "") {
                document.getElementById('searchNotPayed').value = "";
                $('#not_payed_table_data').html(loading);
                $.ajax({
                url: "{{ url('payments/localPaymentsNotPayed/0') }}",
                type: 'get',
                success: function(data) {
                    $('#not_payed_table_data').html(data);
                    $('#localPaymentNotPayed').DataTable({
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


        var searchFieldPayed = document.getElementById('searchPayed');
        searchFieldPayed.addEventListener("keydown", function(e) {
            var searchInput = searchFieldPayed.value;
            if (e.keyCode === 13) { //checks whether the pressed key is "Enter"
                searchForIPayed(searchInput);
            }
        });

        function searchForIPayed(searchInput) {
            if (searchInput != "") {

                $('#payed_table_data').html(loading);

                $.ajax({
                    url: "{{ url('payments/searchLPayed') }}" + '/' + searchInput,
                    type: 'get',
                    success: function(data) {
                        $('#payed_table_data').html(data);
                        $('#searchedPayedPayment').DataTable({
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

        function clearSearchPayedEntry() {

            var searchInput = document.getElementById('searchPayed').value;
            if (searchInput != "") {
                document.getElementById('searchPayed').value = "";
                $('#payed_table_data').html(loading);
                $.ajax({
                url: "{{ url('payments/localPaymentsPayed/0') }}",
                type: 'get',
                success: function(data) {
                    $('#payed_table_data').html(data);
                    $('#localPaymentPayed').DataTable({
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

    </script>
@endsection
