<table id="pendingArtists" class="table table-bordered table-striped">

    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email </th>
            <th>Location</th>
            <th>Id Image </th>
            <th>Profile Image </th>
            <th>Created At </th>
            <th>Action </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pendingArtists as $key => $value)
            <tr id="tr{{ $value['id'] }}">
                <td>{{$key + 1 }}</td>
                <td>{{ $value['first_name'] . ' ' . $value['last_name'] }}
                </td>
                <td>{{ $value['phone'] }}</td>
                <td>{{ $value['email'] }}</td>
                <td>{{ $value['location'] }}</td>
                <td>
                    <a href="javascript:void(0);" class='text-blue view-id' data-idImage="{{$value['id_image']}}">View Id</a>
                </td>

                <td>
                    <a href="javascript:void(0);" class='text-blue view-profilePic' data-profileImage="{{$value['profile_image']}}">View Profile Image</a>
                </td>

                <td>
                    <?php
                    $toCreatedAt = new DateTime($value['created_at']);
                    $createdDate = $toCreatedAt->format('M j, Y');
                    echo $createdDate;
                    ?>
                </td>
                <td>

                    <a href="javascript:void(0);" class="text-secondary " data-toggle="modal"
                                    data-target="#approveArtistModal"  onclick="approveArtistModalOpen({{$value['id'] }})">
                                    <span class="fas fa-check"></span>
                                    Approve </a>
                    <hr>
                    <a href="javascript:void(0);" class="text-secondary" data-toggle="modal"
                                    data-target="#disApproveArtistModal" onclick="disApproveArtistModalOpen({{$value['id'] }})">
                                    <span class="fas fa-times"></span>
                                    Block</a>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>
