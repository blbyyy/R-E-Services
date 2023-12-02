@extends('layouts.navigation')
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Staff User List</h5>
          
          <a href="{{url('/add/staff')}}">
            <button type="button" class="btn btn-primary">
              <i class="bi bi-person-plus"></i>
               Add User Staff
            </button>
            </a>
            <hr>
        
          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">Actions</th>
                <th scope="col">Staff ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
              </tr>
            </thead>
            @foreach ($stafflist as $stafflists)
            <tbody>
              <tr>
                <td>
                    <button data-id="{{$stafflists->id}}" type="button" class="btn btn-info staffshowBtn" data-bs-toggle="modal" data-bs-target="#showstaffinfo"><i class="bi bi-eye"></i></button>
                    <button data-id="{{$stafflists->id}}" type="button" class="btn btn-primary staffeditBtn" data-bs-toggle="modal" data-bs-target="#editstaffinfo"><i class="bi bi-pencil-square"></i></button>
                    <button data-id="{{$stafflists->id}}" type="button" class="btn btn-danger staffdeleteBtn"><i class="bi bi-trash"></i></button>
                </td>
                <td>{{$stafflists->tup_id}}</td>
                <td>{{$stafflists->lname . ', ' . $stafflists->fname .' '. $stafflists->mname}}</td>
                <td>{{$stafflists->email}}</td>
              </tr>
            </tbody>
            @endforeach
          </table>

          <div class="modal fade" id="showstaffinfo" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header" >
                  <h5 class="modal-title" >Staff User Information:</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="card mb-3">
                    <div class="row g-0">
                      <div id="staff_profile" class="col-md-4">
                        
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 id="staff_name" class="card-title"></h5>
                          <h6 id="staff_id"></h6>
                          <h6 id="staff_email"></h6>
                          <h6 id="staff_position"></h6>
                          <h6 id="staff_designation"></h6>
                          <h6 id="staff_gender"></h6>
                          <h6 id="staff_phone"></h6>
                          <h6 id="staff_address"></h6>
                          <h6 id="staff_birthdate"></h6>
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

          <div class="modal fade" id="editstaffinfo" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header" >
                  <h5 class="modal-title" >Edit Staff User Information</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"></h5>
        
                      <form id="staffinfoform" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <input type="text" class="form-control" id="staff_edit_id" name="staff_edit_id" hidden>
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
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email">
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
                       
                        <div >
                          <button data-id="{{$stafflists->id}}" type="submit" class="btn btn-primary staffupdateBtn">Save Changes</button>
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