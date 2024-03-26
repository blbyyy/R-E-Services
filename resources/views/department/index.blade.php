@extends('layouts.navigation')
@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Departments</h1>
    </div>

    @if(session('success'))
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session('success') }}',
        });
    </script>
    @elseif(session('error'))
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: '{{ session('error') }}',
          });
      </script>
    @endif

    <div class="col-12" style="padding-bottom: 20px">
        <button type="button" class="btn btn-dark" onclick="toggleAddDepartmentForm()"><i class="bi bi-plus"></i> Add Department</button>
    </div>

    
    <div id="addDepartmentForm" class="col-md-12" style="display: none;">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add Department</h5>
    
                <form class="row g-3" method="POST" action="{{ route('admin.add.department') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                        <label for="department_name" class="form-label">Department Name</label>
                        <input type="text" class="form-control" id="department_name" name="department_name">
                    </div>
                    <div class="col-12">
                        <label for="department_code" class="form-label">Department Code</label>
                        <input type="text" class="form-control" id="department_code" name="department_code">
                    </div>
    
                    <div class="col-12" style="padding-top: 20px">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-outline-dark">Create Department</button>
                            <button type="reset" class="btn btn-outline-dark ms-2" onclick="toggleAddDepartmentForm()">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Departments List</h5>
            <table id="departmentlist" class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Actions</th>
                    <th scope="col">Department Name</th>
                    <th scope="col">Department Code</th>
                </tr>
                </thead>
                @foreach ($departmentlists as $departmentlist)
                <tbody>
                <tr>
                    <td>
                        <button data-id="{{$departmentlist->id}}" type="button" class="btn btn-primary departmenteditBtn" data-bs-toggle="modal" data-bs-target="#editdepartmentinfo"><i class="bi bi-pencil-square"></i></button>
                        <button data-id="{{$departmentlist->id}}" type="button" class="btn btn-danger departmentdeleteBtn"><i class="bi bi-trash"></i></button>
                    </td>
                    <td>{{$departmentlist->department_name}}</td>
                    <td>{{$departmentlist->department_code}}</td>
                </tr>
                </tbody>
                @endforeach
            </table>

            <div class="modal fade" id="editdepartmentinfo" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header" >
                      <h5 class="modal-title" >Edit Department Information</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title"></h5>
            
                          <form id="departmentinfoform" class="row g-3" enctype="multipart/form-data" >
                            @csrf
                                <input type="text" class="form-control" id="department_edit_id" name="department_edit_id" hidden >
                           
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" name="dept_name" class="form-control" id="dept_name" placeholder="Department Name">
                                        <label for="dept_name">Department Name</label>
                                    </div>
                                </div>
        
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" name="dept_code" class="form-control" id="dept_code" placeholder="Department Code">
                                        <label for="dept_code">Department Code</label>
                                    </div>
                                </div>
                            
                                <div class="col-12" style="padding-top: 20px">
                                    <div class="d-flex justify-content-end">
                                        <button data-id="{{$departmentlist->id}}" type="submit" class="btn btn-outline-dark departmentupdateBtn">Save Changes</button>
                                        <button type="reset" class="btn btn-outline-dark ms-2">Reset</button>
                                    </div>
                                </div>
                          </form>
            
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
            </div>

        </div>
    </div>

      
    
</main>
<script>
    function showAddDepartmentForm() {
        document.getElementById('addDepartmentForm').style.display = 'block';
    }

    function toggleAddDepartmentForm() {
                var addDepartmentForm = document.getElementById('addDepartmentForm');
                if (addDepartmentForm.style.display === 'none' || addDepartmentForm.style.display === '') {
                    addDepartmentForm.style.display = 'block';
                } else {
                    addDepartmentForm.style.display = 'none';
                }
            }
</script>