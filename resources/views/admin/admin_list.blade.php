@extends('layout.admin')
@section('title', 'Employers')

@section('additional_content')
    <a href="#" class="btn btn-info" data-toggle="modal" data-target=".add-employer-info-modal" ><i class="fa fa-plus-circle"></i> Add Employer</a>
@endsection

@section('content')

	<table class="table">
      <thead class="thead-light">
        <tr>
            <th scope="col">Picture</th>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Designation</th>
            <th scope="col">Joining Date</th>
            <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

            @foreach($admins as $admin)
                <tr style="text-align:center;">
                    <td>
                        @if($admin->photo)
                            <img class="user_picture" src={{route("getEmployerImage", [$admin->photo])}} width="40px" height="40px">
                        @else
                            <img class="user_picture" src={{asset("images/user.png")}} width="40px" height="40px">
                        @endif
                    </td>
                    <td class="employer_id">{{$admin->employee_id}}</td>
                    <td class="employer_name">{{$admin->name}}</td>
                    <td class="employer_designation">{{$admin->designation}}</td>
                    <td class="employer_doj">{{$admin->doj}}</td>
                    <td>
                        <form action="{{route('remove_employer')}}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="delete" />
                            <input type="hidden" name="employee_id" value="{{$admin->id}}" />

                            <a href="#" class="btn-edit-info btn btn-primary btn-sm" data-toggle="modal" data-target=".edit-employer-info-modal" style="margin-top: 2px;">Edit</a>
                            <input type="button" class="btn-reset-pass btn btn-warning btn-sm" data-toggle="modal" data-target=".reset-password-modal" style="margin-top: 2px;" value="Reset Password"/>

                            @if(Auth::guard("admin")->user()->id != $admin->id)
                                <input type="submit" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger btn-sm" style="margin-top: 2px;" value="Delete"/>
                            @endif
                        </form>

                    </td>
                </tr>
            @endforeach

      </tbody>
    </table>


<!-- Edit Modal -->
<div class="modal fade reset-password-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="post" action="{{route('reset_pass')}}">
            @csrf

            <input type="hidden" id="employee_id2" name="employee_id">
            <div class="modal-header">
                <h4 class="modal-title rest_employer_name">Reset Employer Password</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

          <div class="modal-body">

            <div class="form-group">
                <label for="name">Password</label><br>
                <input type="text" class="form-control" required autofocus  name="password" placeholder="Enter Password">
            </div>

          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Reset</button>
          </div>
      </form>
      </div>
    </div>
  </div>



<!-- Edit Modal -->
<div class="modal fade edit-employer-info-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="post" action="{{route('edit_employer')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="employee_id" name="employee_id">

            <div class="modal-header">
                <h4 class="modal-title">Edit Employer Information</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

          <div class="modal-body">

            <div class="form-group">
                <label for="name">Name</label><br>
                <input type="text" class="form-control" id="employer_name" required autofocus  name="name" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="name">Designation</label><br>
                <input type="text" class="form-control" id="employer_designation" required autofocus  name="designation" placeholder="Enter Designation">
            </div>
            <div class="form-group">
                <label for="name">Date of Joining</label><br>
                <input type="date" class="form-control" id="employer_doj" required autofocus  name="doj" placeholder="Enter Joining Date">
            </div>
            <div class="form-group">
                <label for="picture">Picture (If you want to change current picture)</label><br>
                <input type="file" name="picture">
            </div>

          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Save</button>
          </div>
      </form>
      </div>
    </div>
  </div>

<!-- Add Modal -->
<div class="modal fade add-employer-info-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="post" action="{{route('add_employer')}}" enctype="multipart/form-data">
            @csrf

            <div class="modal-header">
                <h4 class="modal-title">Add Employer</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

          <div class="modal-body">

            <div class="form-group">
                <label for="id">ID</label><br>
                <input type="text" class="form-control" id="employer_id" required autofocus  name="employee_id" placeholder="Enter ID">
            </div>
            <div class="form-group">
                <label for="name">Name</label><br>
                <input type="text" class="form-control" id="employer_name" required autofocus  name="name" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="name">Designation</label><br>
                <input type="text" class="form-control" id="employer_designation" required autofocus  name="designation" placeholder="Enter Designation">
            </div>
            <div class="form-group">
                <label for="name">Date of Joining</label><br>
                <input type="date" class="form-control" id="employer_doj" required autofocus  name="doj" placeholder="Enter Joining Date">
            </div>
            <div class="form-group">
                <label for="name">Password</label><br>
                <input type="text" class="form-control" required autofocus  name="password" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <label for="picture">Picture</label><br>
                <input type="file" name="picture">
            </div>

          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Add</button>
          </div>
      </form>
      </div>
    </div>
  </div>

@endsection

@section('extra_script')
  <script src="{{asset('js/content/admin/employer_list.js')}}"></script>
@endsection
