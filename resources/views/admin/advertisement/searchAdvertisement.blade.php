@if ($searchActive == true)
    <table id="searchedActiveAdvertisements" class="table table-bordered table-striped">
@else
    <table id="searchedDeactivatedAdvertisements" class="table table-bordered table-striped">
@endif

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

                @foreach ($searchedAdvertisements as $key => $value)
                    <tr id="tr{{ $value['id'] }}">
                        <td> {{ $key + 1 }} </td>
                        <td> {{ $value['owner_name'] }}</td>
                        <td> {{ $value['phone'] }} </td>
                        <td><a href="JavaScript:void(0);" class='text-blue view-image' data-images="{{ $value['banner_image'] }}">View
                                Banner</a>
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
                            <td><a href='{{ $value['url'] }}' class='text-blue' target="_blank">Open</a></td>
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

                            @if ($searchActive == true)
                                <div class='dropdown'>
                                    <button class='btn btn-secondary btn-sm btn-flat dropdown-toggle' type='button'
                                        data-toggle='dropdown'>Menu<span class='caret'></span></button>
                                    <ul class='dropdown-menu dropdown-menu-right p-3'>
                                        <li><a href='javascript:void(0);' class="text-secondary"
                                            onclick="updateAdvertisementPage({{ $value['id'] }})">
                                            <span class="fas fa-edit mr-2"></span> Edit</a>
                                        </li>
                                        <li><a href="JavaScript:void(0);" class="text-secondary" data-toggle="modal"
                                                data-target="#deactivateAdvertisementModal"
                                                onclick="deactivateModalOpen({{ $value['id'] }})">
                                                <span class="fas fa-times mr-2"></span>
                                                Deactivate</a></li>
                                        <li><a href="JavaScript:void(0);" class="text-secondary" data-toggle="modal"
                                                data-target="#deleteAdvertisementModal"
                                                onclick="deleteModalOpen({{ $value['id'] }})">
                                                <span class="fas fa-trash-alt mr-2"></span>
                                                Delete</a></li>
                                    </ul>
                                </div>
                            @else

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

                                        <li><a href="JavaScript:void(0);" class="text-secondary" data-toggle="modal"
                                                data-target="#deleteAdvertisementModal"
                                                nclick="deleteModalOpen({{ $value['id'] }})">
                                                <span class="fas fa-trash-alt mr-2"></span>
                                                Delete</a></li>
                                    </ul>
                                </div>
                            @endif

                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
