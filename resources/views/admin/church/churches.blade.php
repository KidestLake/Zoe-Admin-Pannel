<table id="churches" class="table table-bordered table-striped">

    <thead>
        <tr>
            <th></th>
           <th>No</th>
            <th>Administrator</th>
            <th>Name</th>
            <th>Phone </th>
            <th>Email</th>
            <th>Website</th>
            <th>Country </th>
            <th>Created At </th>
            <th>Action </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($churches as $key => $value)

            <tr id="tr{{$value['id']}}">

                <td class="btn details-control" onclick="showDetails()"></td>
                <td>{{ $offset+$key + 1 }}</td>
                <td>{{ $value['user_id'] }}</td>
                <td>{{ $value['name'] }}</td>
                <td>{{ $value['phone'] }}</td>
                <td>{{ $value['email'] }}</td>
                <td>{{ $value['website'] }}</td>
                <td>{{ $value['address']['country'] }}</td>

                <td>
                    <?php
                    $toCreatedAt = new DateTime($value['created_at']);
                    $createdDate = $toCreatedAt->format('M j, Y');
                    echo $createdDate;
                    ?>
                </td>
                <td>
                    <a href='#' class="text-secondary" data-toggle="modal"
                                    data-target="#deleteChurchModal"
                                    onclick="deleteChurchModalOpen({{ $value['id'] }})">
                                    <span class="fas fa-trash-alt mr-1"></span>
                                    Delete</a>

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
                    <a class="page-link" href="javascript:void(0);" tabindex="-1">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0);"
                        onclick="loadMoreChurches({{ $offset - $limit }},{{ $pageNumber - 1 }})"
                        aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
            @endif
            @if ($pageNumber > 3)
                <li class="page-item"><a class="page-link" href="javascript:void(0);"
                        onclick="loadMoreChurches({{ $offset - $limit * 3 }},{{ $pageNumber - 3 }})">{{ $pageNumber - 3 }}</a>
                </li>
            @endif
            @if ($pageNumber > 2)
                <li class="page-item"><a class="page-link" href="javascript:void(0);"
                        onclick="loadMoreChurches({{ $offset - $limit * 2 }},{{ $pageNumber - 2 }})">{{ $pageNumber - 2 }}</a>
                </li>
            @endif
            @if ($pageNumber > 1)
                <li class="page-item"><a class="page-link" href="javascript:void(0);"
                        onclick="loadMoreChurches({{ $offset - $limit }},{{ $pageNumber - 1 }})">{{ $pageNumber - 1 }}</a>
                </li>
            @endif

            <li class="page-item active"> <a class="page-link">{{ $pageNumber }}
                    <span class="sr-only">(current)</span></a></li>

            @if ($offset + $limit < $totalChurches)
                <li class="page-item"><a class="page-link" href="javascript:void(0);"
                        onclick="loadMoreChurches({{ $offset + $limit }},{{ $pageNumber + 1 }})">{{ $pageNumber + 1 }}</a>
                </li>
            @endif
            @if ($offset + 2 * $limit < $totalChurches)
                <li class="page-item"><a class="page-link" href="javascript:void(0);"
                        onclick="loadMoreChurches({{ $offset + $limit * 2 }},{{ $pageNumber + 2 }})">{{ $pageNumber + 2 }}</a>
                </li>
            @endif
            @if ($offset + 3 * $limit < $totalChurches)
                <li class="page-item"><a class="page-link" href="javascript:void(0);"
                        onclick="loadMoreChurches({{ $offset + $limit * 3 }},{{ $pageNumber + 3 }})">{{ $pageNumber + 3 }}</a>
                </li>
            @endif

            @if ($offset + $limit == $totalChurches || $offset + $limit > $totalChurches)
                <li class="page-item disabled">
                    <a class="page-link" href="javascript:void(0);" tabindex="-1">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0);"
                        onclick="loadMoreChurches({{ $offset + $limit }},{{ $pageNumber + 1 }})"
                        aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            @endif

        </ul>
    </nav>
</div>
