<table id="internationalPaymentPayed" class="table table-bordered table-striped">

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
      <!--<th>Action </th>-->
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
                <!--<td>
                    <div class='dropdown'>
                        <button class='btn btn-primary btn-sm btn-flat dropdown-toggle' type='button' data-toggle='dropdown'>Menu<span class='caret'></span></button>
                        <ul class='dropdown-menu dropdown-menu-right p-3'>
                             <li><a href="javascript:void(0);"> Pay</a></li>
                        </ul>
                    </div>
                </td>-->
            </tr>

        @endforeach
    </tbody>

  </table>

  <div class="row d-flex justify-content-end">
    <nav aria-label="Page navigation" id="paginationDiv">
        <ul class="pagination">

            @if ($offset == 0 || $offset < 0)
                <li class="page-item disabled">
                    <a class="page-link" href="javascript:void(0);" tabindex="-1">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0);"
                        onclick="loadMoreInternationalPayed({{ $offset - $limit }},{{ $pageNumber - 1 }})"
                        aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
            @endif
            @if ($pageNumber > 3)
                <li class="page-item"><a class="page-link" href="javascript:void(0);"
                        onclick="loadMoreInternationalPayed({{ $offset - $limit * 3 }},{{ $pageNumber - 3 }})">{{ $pageNumber - 3 }}</a>
                </li>
            @endif
            @if ($pageNumber > 2)
                <li class="page-item"><a class="page-link" href="javascript:void(0);"
                        onclick="loadMoreInternationalPayed({{ $offset - $limit * 2 }},{{ $pageNumber - 2 }})">{{ $pageNumber - 2 }}</a>
                </li>
            @endif
            @if ($pageNumber > 1)
                <li class="page-item"><a class="page-link" href="javascript:void(0);"
                        onclick="loadMoreInternationalPayed({{ $offset - $limit }},{{ $pageNumber - 1 }})">{{ $pageNumber - 1 }}</a>
                </li>
            @endif

            <li class="page-item active"> <a class="page-link">{{ $pageNumber }}
                    <span class="sr-only">(current)</span></a></li>

            @if ($offset + $limit < $totalIPaymentPayed)
                <li class="page-item"><a class="page-link" href="javascript:void(0);"
                        onclick="loadMoreInternationalPayed({{ $offset + $limit }},{{ $pageNumber + 1 }})">{{ $pageNumber + 1 }}</a>
                </li>
            @endif
            @if ($offset + 2 * $limit < $totalIPaymentPayed)
                <li class="page-item"><a class="page-link" href="javascript:void(0);"
                        onclick="loadMoreInternationalPayed({{ $offset + $limit * 2 }},{{ $pageNumber + 2 }})">{{ $pageNumber + 2 }}</a>
                </li>
            @endif
            @if ($offset + 3 * $limit < $totalIPaymentPayed)
                <li class="page-item"><a class="page-link" href="javascript:void(0);"
                        onclick="loadMoreInternationalPayed({{ $offset + $limit * 3 }},{{ $pageNumber + 3 }})">{{ $pageNumber + 3 }}</a>
                </li>
            @endif

            @if ($offset + $limit == $totalIPaymentPayed || $offset + $limit > $totalIPaymentPayed)
                <li class="page-item disabled">
                    <a class="page-link" href="javascript:void(0);" tabindex="-1">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0);"
                        onclick="loadMoreInternationalPayed({{ $offset + $limit }},{{ $pageNumber + 1 }})"
                        aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            @endif

        </ul>
    </nav>
</div>

