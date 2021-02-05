@if ($searchActive == true)
    <table id="searchedActiveClients" class="table table-bordered table-striped">
@else
    <table id="searchedDeactivatedClients" class="table table-bordered table-striped">
@endif


    <thead>
    <tr>
      <th>No</th>
      <th>Name</th>
      <th>Phone</th>
      <th>Created By</th>
      <th>Last Logged In </th>
      <th>Created At </th>
      <th>Action </th>
    </tr>
    </thead>
    <tbody>
        @foreach ($searchedClients as $key => $value)
            <tr id="tr{{$value['id']}}">
                <td>{{$key+1}}</td>
                <td>{{$value['profile']['first_name'].' '.$value['profile']['last_name']}}</td>
                <td>{{$value['phone']}}</td>
                <td>{{$value['created_by']}}</td>
                <td>
                    <?php
                    $toLastLoggedIn= new DateTime($value['last_logged_in']);
                    $lastLoggedInDate = $toLastLoggedIn->format("M j, Y");
                    echo $lastLoggedInDate;?>
                </td>

                <td>
                    <?php
                    $toCreatedAt= new DateTime($value['created_at']);
                    $createdDate = $toCreatedAt->format("M j, Y");
                    echo $createdDate;?>
                </td>
                <td>

                    @if ($searchActive == true)
                        <div class='dropdown'>
                            <button class='btn btn-secondary btn-sm btn-flat dropdown-toggle' type='button' data-toggle='dropdown'>Menu<span class='caret'></span></button>
                            <ul class='dropdown-menu dropdown-menu-right p-3'>
                                <li><a href="javascript:void(0);" class="text-secondary" data-toggle="modal"
                                    data-target="#deactivateClientModal" onclick="deactivateClientModalOpen({{ $value['id'] }})">
                                    <span class="fas fa-times mr-2"></span> Block</a></li>
                                <li><a href="javascript:void(0);" class="text-secondary" data-toggle="modal"
                                    data-target="#deleteClientModal" onclick="deleteClientModalOpen({{ $value['id'] }})">
                                    <span class="fas fa-trash-alt mr-2"></span> Delete</a></li>
                            </ul>
                        </div>
                    @else
                        <div class='dropdown'>
                            <button class='btn btn-secondary btn-sm btn-flat dropdown-toggle' type='button' data-toggle='dropdown'>Menu<span class='caret'></span></button>
                            <ul class='dropdown-menu dropdown-menu-right p-3'>
                                <li><a href="javascript:void(0);"  class="text-secondary" data-toggle="modal"
                                    data-target="#activateClientModal" onclick="activateClientModalOpen({{ $value['id'] }})">
                                    <span class="fas fa-check mr-2"></span> Activate</a></li>
                                <li><a href="javascript:void(0);"  class="text-secondary" data-toggle="modal"
                                    data-target="#deleteClientModal" onclick="deleteClientModalOpen({{ $value['id'] }})">
                                    <span class="fas fa-trash-alt mr-2"></span> Delete</a></li>
                            </ul>
                        </div>
                    @endif


                </td>
            </tr>

        @endforeach
    </tbody>
  </table>


