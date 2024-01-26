@extends('layouts.navigation')
@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Administration</h1>
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

    <div class="col-12" style="padding-bottom: 10px;">
        <button type="button" class="btn btn-dark" onclick="toggleAdministrationForm()"><i class="bi bi-person-plus"></i> Add Aministrator</button>
    </div>
    
    <div id="addAdministratorForm" class="col-md-12" style="display: none;">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add Administrator</h5>
    
                <form class="row g-3" method="POST" action="{{ route('addAdministration') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="col-md-4">
                        <div class="form-floating">
                          <input type="text" name="admin_fname" class="form-control" id="admin_fname" placeholder="First Name">
                          <label for="admin_fname">First Name</label>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating">
                          <input type="text" name="admin_lname" class="form-control" id="admin_lname" placeholder="Last Name">
                          <label for="admin_lname">Last Name</label>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating">
                          <input type="text" name="admin_mname" class="form-control" id="admin_mname" placeholder="Middle Name">
                          <label for="admin_mname">Middle Name</label>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-floating">
                          <input type="text" name="admin_id" class="form-control" id="admin_id" placeholder="Staff ID">
                          <label for="admin_id">Staff ID</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-floating mb-3">
                          <select name="admin_role" class="form-select" id="admin_role" aria-label="State">
                            <option selected>.....</option>
                            <option value="Moderator">Moderator</option>
                            <option value="Admin">Admin</option>
                            <option value="Super Admin">Super Admin</option>
                          </select>
                          <label for="admin_role">Role</label>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-floating">
                          <input type="text" name="admin_position" class="form-control" id="admin_position" placeholder="Position">
                          <label for="admin_position">Position</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-floating">
                          <input type="text" name="admin_designation" class="form-control" id="admin_designation" placeholder="Designation">
                          <label for="admin_designation">Designation</label>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="form-floating">
                          <textarea name="admin_address" class="form-control" placeholder="Address" id="admin_address" style="height: 100px;"></textarea>
                          <label for="admin_address">Address</label>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-floating">
                          <input type="text" name="admin_phone" class="form-control" id="admin_phone" placeholder="Phone">
                          <label for="admin_phone">Phone</label>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating">
                          <input type="date" name="admin_birthdate" class="form-control" id="admin_birthdate" placeholder="Birthdate">
                          <label for="admin_birthdate">Birthdate</label>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-floating mb-3">
                          <select name="admin_gender" class="form-select" id="admin_gender" aria-label="State">
                            <option selected>.....</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                          <label for="admin_gender">Gender</label>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-floating">
                          <input type="email" name="admin_email" class="form-control" id="admin_email" placeholder="Email">
                          <label for="admin_email">Email</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-floating">
                          <input type="password" name="admin_password" class="form-control" id="admin_password" placeholder="Password">
                          <label for="admin_password">Password</label>
                        </div>
                      </div>
    
                    <div class="col-12" style="padding-top: 20px">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-outline-dark">Add</button>
                            <button type="reset" class="btn btn-outline-dark ms-2" onclick="toggleFileUploadForm()">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Staff List</h5>

          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Actions</th>
                <th scope="col">Staff ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Position</th>
                <th scope="col">Role</th>
              </tr>
            </thead>
            @foreach ($adminlist as $adminlists)
                <tbody>
                <tr>
                    <td>
                        <button data-id="{{$adminlists->id}}" type="button" class="btn btn-Info editAdministrationBtn" data-bs-toggle="modal" data-bs-target="#editAdministrationInfo"><i class="bi bi-pencil-square"></i></button>
                        <button data-id="{{$adminlists->id}}" type="button" class="btn btn-primary roleChangeBtn" data-bs-toggle="modal" data-bs-target="#roleChange"><i class="bi bi-person-check-fill"></i></button>
                        <button data-id="{{$adminlists->id}}" type="button" class="btn btn-danger deleteAdministrationBtn"><i class="bi bi-trash"></i></button>
                    </td>
                    <td>{{$adminlists->tup_id}}</td>
                    <td>{{$adminlists->lname . ', ' . $adminlists->fname .' '. $adminlists->mname}}</td>
                    <td>{{$adminlists->email}}</td>
                    <td>{{$adminlists->position}}</td>
                    <td>
                        @if ($adminlists->role === 'Super Admin')
                        <span class="badge border-danger border-1 text-success">{{$adminlists->role}}</span>
                      @elseif ($adminlists->role === 'Admin')
                        <span class="badge border-success border-1 text-primary">{{$adminlists->role}}</span>
                      @elseif ($adminlists->role === 'Moderator')
                        <span class="badge border-warning border-1 text-secondary"> {{$adminlists->role}}</span>
                      @endif
                    </td>
                </tr>
                </tbody>
            @endforeach
          </table>

          <div class="modal fade" id="editAdministrationInfo" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header" >
                  <h5 class="modal-title" >Edit Administration Information</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"></h5>
        
                      <form id="editAdministrationForm" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <input type="text" class="form-control" id="administrationId" name="administrationId" hidden>
                        <div class="col-md-4">
                          <div class="form-floating">
                            <input type="text" name="fname" class="form-control" id="fname" placeholder="First Name">
                            <label for="fname">First Name</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-floating">
                            <input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name">
                            <label for="lname">Last Name</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-floating">
                            <input type="text" name="mname" class="form-control" id="mname" placeholder="Middle Name">
                            <label for="mname">Middle Name</label>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" name="staffid" class="form-control" id="staffid" placeholder="Staff ID">
                            <label for="staffid">TUP ID</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-floating">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email" disabled>
                            <label for="email">Email</label>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" name="position" class="form-control" id="position" placeholder="Position">
                            <label for="position">Position</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" name="designation" class="form-control" id="designation" placeholder="Designation">
                            <label for="designation">Designation</label>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="form-floating">
                            <textarea name="address" class="form-control" placeholder="Address" id="address" style="height: 100px;"></textarea>
                            <label for="Address">Address</label>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-floating">
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone">
                            <label for="phone">Phone</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-floating">
                            <input type="date" name="birthdate" class="form-control" id="birthdate" placeholder="Birthdate">
                            <label for="birthdate">Birthdate</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-floating mb-3">
                            <select name="gender" class="form-select" id="gender" aria-label="State">
                              <option selected>.....</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            </select>
                            <label for="gender">Gender</label>
                          </div>
                        </div>

                        <div class="col-12" style="padding-top: 20px">
                            <div class="d-flex justify-content-end">
                                <button data-id="{{$adminlists->id}}" type="submit" class="btn btn-outline-dark administrationUpdateBtn">Save Changes</button>
                                <button type="reset" class="btn btn-outline-dark ms-2">Reset</button>
                            </div>
                        </div>
                      </form><!-- End floating Labels Form -->
        
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="roleChange" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header" >
                  <h5 class="modal-title" >Administration Change Role</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"></h5>
        
                      <form id="changeRoleForm" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <input type="text" class="form-control" id="roleId" name="roleId" hidden>
                        
                        <div class="row mb-3">
                            <label for="role" class="col-sm-2 col-form-label">Current Role:</label>
                            <div class="col-sm-10">
                              <input type="text" id="role" name="role" class="form-control" disabled>
                            </div>
                        </div>

                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">Select a particular role:</legend>
                            <div class="col-sm-10">
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="role" value="Moderator">
                                <label class="form-check-label" for="role">
                                    <span class="badge border-warning border-1 text-secondary" style="font-size: medium">Moderator</span>
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="role" value="Admin">
                                <label class="form-check-label" for="role">
                                    <span class="badge border-warning border-1 text-primary" style="font-size: medium">Admin</span>
                                </label>
                              </div>
                              <div class="form-check disabled">
                                <input class="form-check-input" type="radio" name="role" id="role" value="Super Admin">
                                <label class="form-check-label" for="role">
                                    <span class="badge border-warning border-1 text-success" style="font-size: medium">Super Admin</span>
                                </label>
                              </div>
                            </div>
                          </fieldset>
                       
                          <div class="col-12" style="padding-top: 20px">
                            <div class="d-flex justify-content-end">
                                <button data-id="{{$adminlists->id}}" type="submit" class="btn btn-outline-dark roleUpdateBtn">Save Changes</button>
                            </div>
                        </div>
                      </form><!-- End floating Labels Form -->
        
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
    function showAdministrationForm() {
        document.getElementById('addAdministratorForm').style.display = 'block';
    }

    function toggleAdministrationForm() {
                var administrationForm = document.getElementById('addAdministratorForm');
                if (administrationForm.style.display === 'none' || administrationForm.style.display === '') {
                    administrationForm.style.display = 'block';
                } else {
                    administrationForm.style.display = 'none';
                }
            }
</script>