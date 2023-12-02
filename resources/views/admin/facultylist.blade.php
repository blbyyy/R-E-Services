@extends('layouts.navigation')
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Faculty Member User List</h5>
          
          <a href="{{url('/add/faculty')}}">
            <button type="button" class="btn btn-primary">
              <i class="bi bi-person-plus"></i>
               Add User Faculty
            </button>
            </a>
            <hr>
        
          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">Actions</th>
                <th scope="col">TUP ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Department</th>
              </tr>
            </thead>
            @foreach ($facultylist as $facultylists)
            <tbody>
              <tr>
                <td>
                    <button data-id="{{$facultylists->id}}" type="button" class="btn btn-info facultyshowBtn" data-bs-toggle="modal" data-bs-target="#showfacultyinfo"><i class="bi bi-eye"></i></button>
                    <button data-id="{{$facultylists->id}}" type="button" class="btn btn-primary facultyeditBtn" data-bs-toggle="modal" data-bs-target="#editfacultyinfo"><i class="bi bi-pencil-square"></i></button>
                    <button data-id="{{$facultylists->id}}" type="button" class="btn btn-danger facultydeleteBtn"><i class="bi bi-trash"></i></button>
                </td>
                <td>{{$facultylists->tup_id}}</td>
                <td>{{$facultylists->lname . ', ' . $facultylists->fname .' '. $facultylists->mname}}</td>
                <td>{{$facultylists->email}}</td>
                <td>{{$facultylists->department}}</td>
              </tr>
            </tbody>
            @endforeach
          </table>
         
          <div class="modal fade" id="showfacultyinfo" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header" >
                  <h5 class="modal-title" >Faculty User Information:</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="card mb-3">
                    <div class="row g-0">
                      <div id="faculty_profile" class="col-md-4">
                        
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 id="faculty_name" class="card-title"></h5>
                          <h6 id="faculty_id"></h6>
                          <h6 id="faculty_email"></h6>
                          <h6 id="faculty_department"></h6>
                          <h6 id="faculty_position"></h6>
                          <h6 id="faculty_designation"></h6>
                          <h6 id="faculty_gender"></h6>
                          <h6 id="faculty_phone"></h6>
                          <h6 id="faculty_address"></h6>
                          <h6 id="faculty_birthdate"></h6>
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

          <div class="modal fade" id="editfacultyinfo" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header" >
                  <h5 class="modal-title" >Edit Faculty User Information</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"></h5>
        
                      <form id="facultyinfoform" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <input type="text" class="form-control" id="faculty_edit_id" name="faculty_edit_id" hidden>
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

                        <div class="col-md-4">
                          <div class="form-floating">
                            <input type="text" name="fid" class="form-control" id="fid" placeholder="TUP ID">
                            <label for="fid">TUP ID</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-floating">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                            <label for="email">Email</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-floating">
                            <input type="text" name="department" class="form-control" id="department" placeholder="Department">
                            <label for="department">Department</label>
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
                       
                        <div >
                          <button data-id="{{$facultylists->id}}" type="submit" class="btn btn-primary facultyupdateBtn">Save Changes</button>
                          <button type="reset" class="btn btn-secondary">Reset</button>
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