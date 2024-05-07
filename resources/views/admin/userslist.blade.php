@extends('layouts.navigation')
@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<main id="main" class="main">

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

    <div class="col-md-12" style="padding-bottom: 20px;">
        <button type="button" class="btn btn-dark" onclick="toggleAddUserForm()"><i class="bx bxs-user-plus"></i> Add User</button>
    </div>

    <div id="addUserForm" class="col-md-12" style="display: none;">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Create User Profile</h5>

                <form class="row g-3" method="POST" action="{{ route('admin.create.user.profile') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="col-12 text-center">
                      <label for="userRole" class="form-label">User Role:</label>
                      <select id="userRole" class="form-select" name="userRole">
                          <option selected>Choose....</option>
                          <option value="Student">Student</option>
                          <option value="Faculty">Faculty</option>
                          <option value="Research Coordinator">Research Coordinator</option>
                      </select>
                    </div>

                    <div id="studentFormContainer" style="display: none;">
                      <div class="row g-2">
                        <div class="col-4">
                            <label for="studentFname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="studentFname" name="studentFname">
                        </div>
                        <div class="col-4">
                            <label for="studentLname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="studentLname" name="studentLname">
                        </div>
                        <div class="col-4">
                            <label for="studentMname" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="studentMname" name="studentMname">
                        </div>
                        <div class="col-4">
                            <label for="studentId" class="form-label">ID Number</label>
                            <input type="text" class="form-control" id="studentId" name="studentId">
                        </div>
                        <div class="col-4">
                            <label for="studentCollege" class="form-label">College</label>
                            <input type="text" class="form-control" id="studentCollege" name="studentCollege">
                        </div>
                        <div class="col-4">
                            <label for="studentCourse" class="form-label">Course</label>
                            <input type="text" class="form-control" id="studentCourse" name="studentCourse">
                        </div>
                        <div class="col-12">
                          <label for="studentAddress">Address</label>
                          <textarea class="form-control" id="studentAddress" name="studentAddress" style="height: 100px;"></textarea>
                        </div>
                        <div class="col-4">
                          <label for="studentGender" class="form-label">Sex</label>
                          <select id="studentGender" class="form-select" name="studentGender">
                              <option selected>Choose....</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                          </select>
                        </div>
                        <div class="col-4">
                            <label for="studentPhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="studentPhone" name="studentPhone">
                        </div>
                        <div class="col-4">
                            <label for="studentBirthdate" class="form-label">BirthDate</label>
                            <input type="date" class="form-control" id="studentBirthdate" name="studentBirthdate">
                        </div>
                        <div class="col-6">
                            <label for="studentEmail" class="form-label">Email</label>
                            <input type="text" class="form-control" id="studentEmail" name="studentEmail">
                        </div>
                        <div class="col-6">
                            <label for="studentPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="studentPassword" name="studentPassword">
                        </div>
                      </div>
                    </div>

                    <div id="facultyFormContainer" style="display: none;">
                      <div class="row g-2">
                        <div class="col-4">
                            <label for="facultyFname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="facultyFname" name="facultyFname">
                        </div>
                        <div class="col-4">
                            <label for="facultyLname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="studentLname" name="studentLname">
                        </div>
                        <div class="col-4">
                            <label for="facultyMname" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="facultyMname" name="facultyMname">
                        </div>
                        <div class="col-6">
                            <label for="facultyId" class="form-label">ID Number</label>
                            <input type="text" class="form-control" id="facultyId" name="facultyId">
                        </div>
                        <div class="col-6">
                          <label for="facultyDepartment" class="form-label">Department</label>
                          <select id="facultyDepartment" class="form-select" name="facultyDepartment">
                              <option selected>Select Department.....</option>
                                @foreach($department as $departments)
                                  <option value="{{$departments->id}}">{{$departments->department_name}} ({{$departments->department_code}})</option>
                                @endforeach
                          </select>
                        </div>
                        <div class="col-6">
                            <label for="facultyDesignation" class="form-label">Designation</label>
                            <input type="text" class="form-control" id="facultyDesignation" name="facultyDesignation">
                        </div>
                        <div class="col-6">
                            <label for="facultyPosition" class="form-label">Position</label>
                            <input type="text" class="form-control" id="facultyPosition" name="facultyPosition">
                        </div>
                        <div class="col-12">
                            <label for="facultyAddress">Address</label>
                            <textarea class="form-control" id="facultyAddress" name="facultyAddress" style="height: 100px;"></textarea>
                        </div>
                        <div class="col-4">
                          <label for="facultyGender" class="form-label">Sex</label>
                          <select id="facultyGender" class="form-select" name="facultyGender">
                              <option selected>Choose....</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                          </select>
                        </div>
                        <div class="col-4">
                            <label for="facultyPhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="facultyPhone" name="facultyPhone">
                        </div>
                        <div class="col-4">
                            <label for="facultyBirthdate" class="form-label">BirthDate</label>
                            <input type="date" class="form-control" id="facultyBirthdate" name="facultyBirthdate">
                        </div>
                        <div class="col-6">
                            <label for="facultyEmail" class="form-label">Email</label>
                            <input type="text" class="form-control" id="facultyEmail" name="facultyEmail">
                        </div>
                        <div class="col-6">
                            <label for="facultyPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="facultyPassword" name="facultyPassword">
                        </div>
                      </div>
                    </div>

                    <div class="col-12" style="padding-top: 20px">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-outline-dark">Create</button>
                            <button type="reset" class="btn btn-outline-dark ms-2" onclick="toggleAddUserForm()">Close</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
          <h5 class="card-title">List of Users</h5>

        <form class="row g-3" method="POST" action="{{ route('admin.userlist.specific-role') }}">
          @csrf
          <div class="row">
              <label for="userRole" class="form-label"><b>Filter By Specific Role:</b></label>
              <div class="col-md-9" style="padding-bottom: 0px">
                  <select name="userRole" id="userRole" class="form-select" required>
                      <option selected>--- SELECT ROLE ---</option>
                      <option value="All">All Users</option>
                      <option value="Student">Student</option>
                      <option value="Faculty">Faculty</option>
                      <option value="Staff">Staff</option>
                  </select>
              </div>
              <div class="col-md-3">
                  <button type="submit" class="btn btn-outline-dark">Change</button>
                  <a href="{{url('admin/userlist')}}" class="btn btn-outline-dark">Refresh</a>
              </div>
          </div>
        </form>

        @if($users->isEmpty())
          <table class="table table-hover">
              <thead>
                  <tr>
                    <th scope="col">Actions</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                  </tr>
              </thead>
          </table>
          <div class="alert alert-danger d-flex justify-content-center" role="alert">
              <div class="text-center">
                  <span class="badge border-danger border-1 text-danger" style="font-size: large; display: flex; align-items: center;">
                      <i class="bi bi-person-x" style="font-size: 50px; margin-right: 10px;"></i>
                      No Users Detected
                  </span>
              </div>
          </div>
        @else
          <table class="table table-hover">
            <thead>
              <tr class="text-center">
                <th scope="col">Actions</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr class="text-center">
                  <td style="width: 152px">
                      <button data-id="{{$user->user_id}}" type="button" class="btn btn-info userlistShowBtn" data-bs-toggle="modal" data-bs-target="#showUserInfo"><i class="bi bi-eye"></i></button>
                      <button data-id="{{$user->user_id}}" type="button" class="btn btn-primary editUserBtn" data-bs-toggle="modal" data-bs-target="#editUserInfo"><i class="bi bi-pencil-square"></i></button>
                      <button data-id="{{$user->user_id}}" type="button" class="btn btn-danger deleteUserBtn"><i class="bi bi-trash"></i></button>
                  </td>
                  <td>{{$user->fname .' '. $user->mname .' '. $user->lname}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->role}}</td>
                </tr>                
              @endforeach
            </tbody>
          </table>
        @endif

        <div class="modal fade" id="showUserInfo" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header" >
                <h5 class="modal-title" >Student User Information:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                  <div class="row">
                    <div class="col-4 text-center">
                    <div id="userProfile" style="padding-top: 10px; padding-bottom: 20px;"></div>
                    </div>
                      
                    <div class="col-8">
                        <h6><b style="color: maroon">Account Owner:  </b><span id="userName"></span></h6>
                        <h6><b style="color: maroon">ID Number:  </b><span id="userID"></span></h6>
                        <h6><b style="color: maroon">Email:  </b><span id="userEmail"></span></h6>
                        <h6 id="cllg"><b style="color: maroon">College: </b><span id="userCollege"></span></h6>
                        <h6 id="crs"><b style="color: maroon">Course  </b><span id="userCourse"></span></h6>
                        <h6 id="pstn"><b style="color: maroon">Position:   </b><span id="userPosition"></span></h6>
                        <h6 id="dsgntn"><b style="color: maroon">Designation: </b><span id="userDesignation"></span></h6>
                        <h6 id="dprtmnt"><b style="color: maroon">Department  </b><span id="userDepartment"></span></h6>
                        <h6><b style="color: maroon">Sex:  </b><span id="userGender"></span></h6>
                        <h6><b style="color: maroon">Phone:  </b><span id="userPhone"></span></h6>
                        <h6><b style="color: maroon">Address:   </b><span id="userAddress"></span></h6>
                        <h6><b style="color: maroon">BirthDate: </b><span id="userBirthdate"></span></h6>
                    </div>
                  </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="editUserInfo" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header" >
                <h5 class="modal-title" >Edit User Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"></h5>
      
                    <form id="userInfoForm" class="row g-3" enctype="multipart/form-data" >
                      @csrf
                      <input type="text" class="form-control" id="userEditId" name="userEditId" hidden >
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
                          <input type="text" name="tup_id" class="form-control" id="tup_id" placeholder="TUP ID">
                          <label for="tup_id">TUP ID</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-floating">
                          <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                          <label for="email">Email</label>
                        </div>
                      </div>

                      <div class="col-md-6" id="collegeForm">
                        <div class="form-floating">
                          <input type="text" name="college" class="form-control" id="college" placeholder="College">
                          <label for="college">College</label>
                        </div>
                      </div>
                      <div class="col-md-6" id="courseForm">
                        <div class="form-floating">
                          <input type="text" name="course" class="form-control" id="course" placeholder="Course">
                          <label for="course">Course</label>
                        </div>
                      </div>

                      <div class="col-md-6" id="positionForm">
                        <div class="form-floating">
                          <input type="text" name="position" class="form-control" id="position" placeholder="Position">
                          <label for="position">Position</label>
                        </div>
                      </div>
                      <div class="col-md-6" id="designationForm">
                        <div class="form-floating">
                          <input type="text" name="designation" class="form-control" id="designation" placeholder="Designation">
                          <label for="designation">Designation</label>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="form-floating">
                          <textarea name="address" class="form-control" placeholder="Address" id="address" style="height: 100px;"></textarea>
                          <label for="address">Address</label>
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
                          <button type="submit" class="btn btn-outline-dark userUpdateBtn">Save Changes</button>
                          <button type="reset" class="btn btn-outline-dark  ms-2">Reset</button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
      document.getElementById('userRole').addEventListener('change', function () {
            var studentFormContainer = document.getElementById('studentFormContainer');
            var facultyFormContainer = document.getElementById('facultyFormContainer');

            if (this.value === 'Student') {
              studentFormContainer.style.display = 'block';
              facultyFormContainer.style.display = 'none';
            } else if (this.value === 'Faculty' || this.value === 'Research Coordinator') {
              facultyFormContainer.style.display = 'block';
              studentFormContainer.style.display = 'none';
            } 
        });
  });


  function showAddUserForm() {
      document.getElementById('addUserForm').style.display = 'block';
  }

  function toggleAddUserForm() {
              var addUserForm = document.getElementById('addUserForm');
              if (addUserForm.style.display === 'none' || addUserForm.style.display === '') {
                addUserForm.style.display = 'block';
              } else {
                addUserForm.style.display = 'none';
              }
  }
</script>