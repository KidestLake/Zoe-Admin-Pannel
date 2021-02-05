@if ($searchPayed == true)
    <table id="searchedPayedPayment" class="table table-responsive table-bordered table-striped">
@else
    <table id="searchedNotPayedPayment" class="table table-bordered table-striped">
@endif



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
            @if ($searchPayed == false)
                <th>Action </th>
            @endif

        </tr>
    </thead>
    <tbody>
        @foreach ($searchedPayments as $key => $value)
            <tr id="tr{{ $value['id'] }}">
                <td>{{ $key + 1 }}</td>
                <td>{{ $value['song_title'] }}</td>
                <td>{{ $value['first_name'] }}</td>
                <td>{{ $value['price'] }}</td>
                <td>{{ $value['net_price'] }}</td>
                <td>{{ $value['service_fee'] }}</td>
                <td>{{ $value['purchased_date'] }}</td>
                <td>
                    <?php
                    $toCreatedAt = new DateTime($value['created_at']);
                    $createdDate = $toCreatedAt->format('M j, Y');
                    echo $createdDate;
                    ?>
                </td>

                @if ($searchPayed == false)
                    <td>
                        <div class='dropdown'>
                            <button class='btn btn-secondary btn-sm btn-flat dropdown-toggle' type='button'
                                data-toggle='dropdown'>Menu<span class='caret'></span></button>
                            <ul class='dropdown-menu dropdown-menu-right p-3'>
                                <li><a href="javascript:void(0);" class="text-secondary"> <span
                                            class="nav-icon fas fa-money-bill-alt mr-2"></span> Pay</a></li>
                            </ul>
                        </div>
                    </td>
                @endif

            </tr>

        @endforeach
    </tbody>
</table>


