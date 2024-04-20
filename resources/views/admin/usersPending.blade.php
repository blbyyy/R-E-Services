@extends('layouts.navigation')
@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Verification of Faculty Member Accounts</h1>
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

    <div class="card">
        <div class="card-body">
          <h5 class="card-title">List of Faculty Member Accounts Requiring Verification</h5>

        @if(count($users) > 0)
            <table class="table table-hover">
                <thead>
                <tr class="text-center">
                    <th scope="col">Actions</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Department</th>
                    <th scope="col">Position</th>
                    <th scope="col">Designation</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr class="text-center">
                        <td>
                            <button data-id="{{$user->userID}}" type="button" class="btn btn-success verifyUserAccount" data-bs-toggle="modal" data-bs-target="#showUserDetails"><i class="bx bx-check-double"></i></button>
                        </td>
                        <td>{{$user->fname .' '. $user->mname .' '. $user->lname}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->department_code}}<span>({{$user->department_name}})</span></td>
                        <td>{{$user->position}}</td>
                        <td>{{$user->designation}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Actions</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Department</th>
                        <th scope="col">Position</th>
                        <th scope="col">Designation</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                    </tr>
                </tbody>
            </table>
            <div class="alert alert-danger" role="alert">
                <div class="text-center">
                    <span class="badge border-danger border-1 text-danger" style="font-size: large">No Pending Accounts</span>
                </div>
            </div>
        @endif

        <div class="modal fade" id="showUserDetails" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header" >
                <h5 class="modal-title" >Faculty Member User Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <div class="row"> 
                    <div class="col-4 text-center">
                      <div id="userProfile" style="padding-top: 10px; padding-bottom: 20px;"></div>
                    </div>

                    <div class="col-8">
                        <h6><b style="color: maroon">Account Owner:  </b><span id="userName"></span></h6>
                        <h6><b style="color: maroon">Number:  </b><span id="userID"></span></h6>
                        <h6><b style="color: maroon">Email:  </b><span id="userEmail"></span></h6>
                        <h6><b style="color: maroon">Position:   </b><span id="userPosition"></span></h6>
                        <h6><b style="color: maroon">Designation: </b><span id="userDesignation"></span></h6>
                        <h6><b style="color: maroon">Department  </b><span id="userDepartment"></span></h6>
                        <h6><b style="color: maroon">Sex:  </b><span id="userGender"></span></h6>
                        <h6><b style="color: maroon">Phone:  </b><span id="userPhone"></span></h6>
                        <h6><b style="color: maroon">Address:   </b><span id="userAddress"></span></h6>
                        <h6><b style="color: maroon">BirthDate: </b><span id="userBirthdate"></span></h6>
                    </div>
                </div>

                <hr>

                <form method="POST" action="{{ route('admin.users.pending.verified') }}">
                    @csrf

                    <input name="usersID" type="hidden" class="form-control" id="usersID">

                    <div class="row">
                        <div class="col-12 text-center">
                            <label for="verify" class="form-label">Did you verify this account?</label>
                            <select name="verify" id="verify" class="form-select" required>
                                <option selected>Choose.....</option>
                                <option value="Faculty">Yes</option>
                                <option value="Faculty Not Verified">No</option>
                            </select>
                        </div>
                        <div class="col-12" style="padding-top: 20px">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-dark">Submit</button>
                            </div>
                        </div>
                    </div>
                    
                </form>

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