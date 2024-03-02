@extends('layouts.navigation')
<main id="main" class="main">
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
              <tr>
                <th scope="col">Actions</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr>
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
                <div class="card mb-3">
                  <div class="row g-0">
                    <div id="userProfile" class="col-md-4">
                      
                    </div>
                    <div class="col-md-8">
                      <div class="card-body" id="userForm">
                        <h5 id="userName" class="card-title"></h5>
                        <h6 id="userID"></h6>
                        <h6 id="userEmail"></h6>
                        <h6 id="userCollege"></h6>
                        <h6 id="userCourse"></h6>
                        <h6 id="userPosition"></h6>
                        <h6 id="userDesignation"></h6>
                        <h6 id="userDepartment"></h6>
                        <h6 id="userGender"></h6>
                        <h6 id="userPhone"></h6>
                        <h6 id="userAddress"></h6>
                        <h6 id="userBirthdate"></h6>
                      </div>
                    </div>
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