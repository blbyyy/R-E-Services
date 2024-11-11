@extends('layouts.navigation')
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Student User List</h5>
          
          <a href="{{url('/add/student')}}">
          <button type="button" class="btn btn-primary">
            <i class="bi bi-person-plus"></i>
             Add Student
          </button>
          </a>
          <hr>
          
          <table id="studentlist" class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">Actions</th>
                <th scope="col">Student ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
              </tr>
            </thead>
              @if ($studentlist->isNotEmpty())
                @foreach ($studentlist as $studentlists)
                    <tbody>
                        <tr>
                          <td>
                            <button data-id="{{$studentlists->id}}" type="button" class="btn btn-info studentshowBtn" data-bs-toggle="modal" data-bs-target="#showstudentinfo"><i class="bi bi-eye"></i></button>
                            <button data-id="{{$studentlists->id}}" type="button" class="btn btn-primary studenteditBtn" data-bs-toggle="modal" data-bs-target="#editstudentinfo"><i class="bi bi-pencil-square"></i></button>
                            <button data-id="{{$studentlists->id}}" type="button" class="btn btn-danger studentdeleteBtn"><i class="bi bi-trash"></i></button>
                          </td>
                          <td>{{$studentlists->tup_id}}</td>
                          <td>{{$studentlists->fname . ' ' . $studentlists->lname .' '. $studentlists->mname}}</td>
                          <td>{{$studentlists->email}}</td>
                        </tr>
                    </tbody>
                @endforeach
              @else
                <tbody>
                    <tr>
                      <td colspan="4" class="text-center">No students found</td>
                    </tr>
                </tbody>
              @endif
          </table>
         
          <div class="modal fade" id="showstudentinfo" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header" >
                  <h5 class="modal-title" >Student User Information:</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="card mb-3">
                    <div class="row g-0">
                      <div id="student_profile" class="col-md-4">
                        
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 id="student_name" class="card-title"></h5>
                          <h6 id="student_id"></h6>
                          <h6 id="student_email"></h6>
                          <h6 id="student_college"></h6>
                          <h6 id="student_course"></h6>
                          <h6 id="student_gender"></h6>
                          <h6 id="student_phone"></h6>
                          <h6 id="student_address"></h6>
                          <h6 id="student_birthdate"></h6>
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

          <div class="modal fade" id="editstudentinfo" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header" >
                  <h5 class="modal-title" >Edit Student User Information</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"></h5>
        
                      <form id="studentinfoform" class="row g-3" enctype="multipart/form-data" >
                        @csrf
                        <input type="text" class="form-control" id="student_edit_id" name="student_edit_id" hidden >
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
                            <input type="text" name="sid" class="form-control" id="sid" placeholder="Student ID">
                            <label for="sid">Student ID</label>
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
                            <input type="text" name="college" class="form-control" id="college" placeholder="College">
                            <label for="college">College</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" name="course" class="form-control" id="course" placeholder="Course">
                            <label for="course">Course</label>
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
                            @if ($studentlist->isNotEmpty())
                              <button data-id="{{$studentlists->id}}" type="submit" class="btn btn-outline-dark studentupdateBtn">Save Changes</button>
                              <button type="reset" class="btn btn-outline-dark  ms-2">Reset</button>
                            @endif
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