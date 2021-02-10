@extends('layout.admin')
@section('title', 'Employees')

@section('additional_content')
    <form action="{{route('remove_all_employee')}}" method="post">
        @csrf
        <input type="hidden" name="_method" value="delete" />
        <input type="submit" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger" style="margin-top: 2px;" value="Delete All Employee">
        <a href="#" class="btn btn-info" data-toggle="modal" data-target=".add-employee-info-modal" ><i class="fa fa-plus-circle"></i> Add Employee</a>
    </form>
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

            @foreach($employees as $employee)
                <tr style="text-align:center;">
                    <td>
                        @if($employee->photo)
                            <img class="user_picture" src={{route("getEmployeeImage", [$employee->photo])}} width="40px" height="40px">
                        @else
                            <img class="user_picture" src={{asset("images/user.png")}} width="40px" height="40px">
                        @endif
                    </td>
                    <td class="employee_id">{{$employee->employee_id}}</td>
                    <td class="employee_name">{{$employee->name}}</td>
                    <td class="employee_designation">{{$employee->designation}}</td>
                    <td class="employee_doj">{{$employee->doj}}</td>
                    <td>
                        <form action="{{route('remove_employee')}}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="delete" />
                            <input type="hidden" name="employee_id" value="{{$employee->id}}" />

                            <a href="#" class="btn-edit-info btn btn-primary btn-sm" data-toggle="modal" data-target=".edit-employee-info-modal" style="margin-top: 2px;">Edit</a>
                            <input type="submit" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger btn-sm" style="margin-top: 2px;" value="Delete"/>

                        </form>
                    </td>
                </tr>
            @endforeach

      </tbody>
    </table>

<!-- Edit Modal -->
<div class="modal fade edit-employee-info-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="post" action="{{route('edit_employee')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="employee_id" name="employee_id">

            <div class="modal-header">
                <h4 class="modal-title">Edit Employee Information</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

          <div class="modal-body">

            <div class="form-group">
                <label for="name">Name</label><br>
                <input type="text" class="form-control" id="employee_name" required autofocus  name="name" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="name">Designation</label><br>
                <input type="text" class="form-control" id="employee_designation" required autofocus  name="designation" placeholder="Enter Designation">
            </div>
            <div class="form-group">
                <label for="name">Date of Joining</label><br>
                <input type="date" class="form-control" id="employee_doj" required autofocus  name="doj" placeholder="Enter Joining Date">
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



  <!-- Add Employee -->

  <div class="modal fade add-employee-info-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add Employee</h4>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" action="{{route('set_excel_employee_list')}}" enctype="multipart/form-data">
            @csrf
            <div class="modal-header d-flex">
                <input class="mr-auto p-2" type="file" name="employees" required autofocus>
                <button type="submit" class="btn btn-info"><i class="fa fa-upload"></i> Upload Excel File</button>
            </div>
        </form>

        <form method="post" action="{{route('add_employee')}}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Employee ID</label><br>
                    <input type="text" class="form-control" required autofocus  name="employee_id" placeholder="Enter Employee ID">
                </div>
                <div class="form-group">
                    <label for="name">Name</label><br>
                    <input type="text" class="form-control" required autofocus  name="name" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label for="name">Designation</label><br>
                    <input type="text" class="form-control" required autofocus  name="designation" placeholder="Enter Designation">
                </div>
                <div class="form-group">
                    <label for="name">Date of Joining</label><br>
                    <input type="date" class="form-control" required autofocus  name="doj" placeholder="Enter Joining Date">
                </div>
                <div class="form-group">
                    <label for="picture">Picture</label><br>
                    <input type="file" name="picture">
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>



@endsection

@section('extra_script')
  <script src="{{asset('js/content/admin/employee_list.js')}}"></script>
@endsection
