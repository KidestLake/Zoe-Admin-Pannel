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


                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">

                        <li class="nav-item">
                            <a class="nav-link active" id="notPayedPayment-tab" data-toggle="pill" href="#notPayedPayment" role="tab" aria-controls="notPayedPayment" aria-selected="true"> <span class="fa fa-list"> </span> International Payment(Not Payed)</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/Payment/internationalPaymentsPayed/0" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false"> <span class="fa fa-list"> </span> International Payment (payed)</a>
                        </li>


                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content">

                        <div class="tab-pane active" id="notPayedPayment">

                            <table id="internationalPaymentNotPayed" class="table table-bordered table-striped">

                                <thead>
                                <tr>
                                  <th>No</th>
                                  <th>song Title</th>
                                  <th>Artist</th>
                                  <th>Price</th>
                                  <th>Net Price </th>
                                  <th>Service Fee</th>
                                  <th>Purchased Date </th>
                                  <th>Created At </th>
                                  <th>Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($internationalPayments as $key => $value)
                                        <tr id="tr{{$value['id']}}">
                                            <td>{{$offset+$key+1}}</td>
                                            <td>{{$value['song_title']}}</td>
                                            <td>{{$value['first_name']}}</td>
                                            <td>{{$value['price']}}</td>
                                            <td>{{$value['net_price']}}</td>
                                            <td>{{$value['service_fee']}}</td>
                                            <td>{{$value['purchased_date']}}</td>
                                            <td>
                                                <?php
                                                $toCreatedAt= new DateTime($value['created_at']);
                                                $createdDate = $toCreatedAt->format("M j, Y");
                                                echo $createdDate;?>
                                            </td>
                                            <td>
                                                <div class='dropdown'>
                                                    <button class='btn btn-secondary btn-sm btn-flat dropdown-toggle' type='button' data-toggle='dropdown'>Menu<span class='caret'></span></button>
                                                    <ul class='dropdown-menu dropdown-menu-right p-3'>
                                                         <li><a href='#' class="text-secondary"> <span class="nav-icon fas fa-money-bill-alt mr-2"></span> Pay</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                              </table>

                              <div class="row d-flex justify-content-end">
                                <nav aria-label="Page navigation">
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
                                                <a class="page-link" href="{{ url('Payment/internationalPaymentsNotPayed/'.($offset-$limit).'/'.($pageNumber-1)) }}" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($pageNumber > 3)
                                            <li class="page-item"><a class="page-link" href="{{ url('Payment/internationalPaymentsNotPayed/'.($offset-($limit*3)).'/'.($pageNumber-3)) }}">{{$pageNumber-3}}</a></li>
                                        @endif
                                        @if ($pageNumber > 2)
                                            <li class="page-item"><a class="page-link" href="{{ url('Payment/internationalPaymentsNotPayed/'.($offset-($limit*2)).'/'.($pageNumber-2)) }}">{{$pageNumber-2}}</a></li>
                                        @endif
                                        @if ($pageNumber > 1)
                                            <li class="page-item"><a class="page-link" href="{{ url('Payment/internationalPaymentsNotPayed/'.($offset-($limit)).'/'.($pageNumber-1)) }}">{{$pageNumber-1}}</a></li>
                                        @endif

                                        <li class="page-item active"> <a class="page-link" >{{$pageNumber}} <span class="sr-only">(current)</span></a></li>

                                        @if (($offset + $limit) < $totalIPaymentNotPayed)
                                            <li class="page-item"><a class="page-link" href="{{ url('Payment/internationalPaymentsNotPayed/'.($offset+($limit)).'/'.($pageNumber+1)) }}">{{$pageNumber+1}}</a></li>
                                        @endif
                                        @if (($offset + (2*$limit)) < $totalIPaymentNotPayed)
                                            <li class="page-item"><a class="page-link" href="{{ url('Payment/internationalPaymentsNotPayed/'.($offset+($limit*2)).'/'.($pageNumber+2)) }}">{{$pageNumber+2}}</a></li>
                                        @endif
                                        @if (($offset + (3*$limit)) < $totalIPaymentNotPayed)
                                            <li class="page-item"><a class="page-link" href="{{ url('Payment/internationalPaymentsNotPayed/'.($offset+($limit*3)).'/'.($pageNumber+3)) }}">{{$pageNumber+3}}</a></li>
                                        @endif

                                        @if ((($offset+$limit) == $totalIPaymentNotPayed) || (($offset+$limit) > $totalIPaymentNotPayed))
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1">
                                                    <span aria-hidden="true">&raquo;</span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ url('Payment/internationalPaymentsNotPayed/'.($offset+$limit).'/'.($pageNumber+1)) }}" aria-label="Next">
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

        $(function () {
            $('#paymentList').addClass('menu-open');
            $('#paymentNav').addClass('active');
            $('#internationalPaymentNav').addClass('active');


            $("#internationalPaymentNotPayed").DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print','colvis'
                ]
            });

            $("#messages").fadeOut(10000);
        });

    </script>
@endsection
