<table id="searchedChurches" class="table table-responsive table-bordered table-striped">

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
        @foreach ($searchedChurches as $key => $value)

            <tr id="{{$value['id']}}">

                <td class=" btn details-control sorting_disabled" rowspan="1" colspan="1" style="width: 0px;" aria-label=""></td>
                <td>{{ $key + 1 }}</td>
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
                    <a href="javascript:void(0);" class="text-secondary" data-toggle="modal"
                                    data-target="#deleteChurchModal"
                                    onclick="deleteChurchModalOpen({{ $value['id'] }})">
                                    <span class="fas fa-trash-alt mr-1"></span>
                                    Delete</a>

                </td>
            </tr>


        @endforeach
        </tbody>

</table>

