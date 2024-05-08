@extends('layouts.navigation')
@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<main id="main" class="main">

    <div class="pagetitle">
      <h1>My Profile</h1>
    </div><!-- End Page Title -->

    @if(session('success'))
      <script>
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: '{{ session('success') }}',
          });
      </script>
    @endif

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              @if($faculty->avatar === 'avatar.jpg')
                <div>
                  <img id="img" class="rounded-circle" src="https://tse4.mm.bing.net/th?id=OIP.sRdQAfzOzF_ZjC3dnAZVSQHaGw&pid=Api&P=0&h=180" />
                </div>
                  <div class="text-center" style="padding-bottom: 10px; padding-top: 10px">
                    <button id="toggleForm" type="submit" class="btn btn-outline-dark">Change Avatar</button>
                  </div>
                  <form style="display: none;" id="avatarForm" class="row g-3" method="POST" action="{{ route('faculty_update_avatar') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-sm-8">
                      <input class="form-control" type="file" id="avatar" name="avatar">
                    </div>
                    <div class="col-sm-4">
                      <button type="submit" class="btn btn-outline-dark">Change</button>
                    </div>
                  </form>
              @else
                <div>
                  <img id="img" class="rounded-circle" src="{{ asset('/storage/avatars/'.$faculty->avatar) }}" />
                </div>
                <div class="text-center" style="padding-bottom: 10px; padding-top: 10px">
                  <button id="toggleForm" type="submit" class="btn btn-outline-dark">Change Avatar</button>
                </div>
                <form style="display: none;" id="avatarForm" class="row g-3" method="POST" action="{{ route('faculty_update_avatar') }}" enctype="multipart/form-data">
                  @csrf
                    <div class="col-sm-8">
                      <input class="form-control" type="file" id="avatar" name="avatar">
                    </div>
                    <div class="col-sm-4">
                      <button type="submit" class="btn btn-outline-dark">Change</button>
                    </div>
                </form>
              @endif

              <div class="text-center">
                <h2>{{$faculty->fname .' '. $faculty->lname .' '. $faculty->mname}}</h2>
                <h3>{{$faculty->role}}</h3>
              </div>
              
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
    
                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">First Name</div>
                    <div class="col-lg-9 col-md-8">{{$faculty->fname}}</div>
                  </div>
                  
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Last Name</div>
                    <div class="col-lg-9 col-md-8">{{$faculty->lname}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Middle Name</div>
                    <div class="col-lg-9 col-md-8">{{$faculty->mname}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">TUP ID</div>
                    <div class="col-lg-9 col-md-8">{{$faculty->tup_id}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Department</div>
                    <div class="col-lg-9 col-md-8">{{$faculty->department_name}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Position</div>
                    <div class="col-lg-9 col-md-8">{{$faculty->position}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Designation</div>
                    <div class="col-lg-9 col-md-8">{{$faculty->designation}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{$faculty->email}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8">{{$faculty->gender}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">{{$faculty->phone}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">{{$faculty->address}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">BirthDate</div>
                    <div class="col-lg-9 col-md-8">{{$faculty->birthdate}}</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  {{ Form::model($faculty,['route' => ['faculty.update-profile',$faculty->id],'method'=> 'PUT','enctype'=>'multipart/form-data']) }}

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                      <div class="col-md-8 col-lg-9">
                        {{ Form::text('fname',null,array('class'=>'form-control','id'=>'fname')) }}
                            @if($errors->has('fname'))
                              <small>{{ $errors->first('fname') }}</small>
                            @endif  
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                      <div class="col-md-8 col-lg-9">
                        {{ Form::text('lname',null,array('class'=>'form-control','id'=>'lname')) }}
                            @if($errors->has('lname'))
                              <small>{{ $errors->first('lname') }}</small>
                            @endif  
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Middle Name</label>
                      <div class="col-md-8 col-lg-9">
                        {{ Form::text('mname',null,array('class'=>'form-control','id'=>'mname')) }}
                            @if($errors->has('mname'))
                              <small>{{ $errors->first('mname') }}</small>
                            @endif  
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">TUP ID</label>
                      <div class="col-md-8 col-lg-9">
                        {{ Form::text('tup_id',null,array('class'=>'form-control','id'=>'tup_id')) }}
                                @if($errors->has('tup_id'))
                                    <small>{{ $errors->first('tup_id') }}</small>
                                @endif
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Department</label>
                      <div class="col-md-8 col-lg-9">
                        {{ Form::text('department_id',null,array('class'=>'form-control','id'=>'department_id')) }}
                            @if($errors->has('department_id'))
                              <small>{{ $errors->first('department_id') }}</small>
                            @endif  
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Position</label>
                      <div class="col-md-8 col-lg-9">
                        {{ Form::text('position',null,array('class'=>'form-control','id'=>'position')) }}
                            @if($errors->has('position'))
                              <small>{{ $errors->first('position') }}</small>
                            @endif  
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Designation</label>
                      <div class="col-md-8 col-lg-9">
                        {{ Form::text('designation',null,array('class'=>'form-control','id'=>'designation')) }}
                            @if($errors->has('designation'))
                              <small>{{ $errors->first('designation') }}</small>
                            @endif  
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                          {{ Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'disabled' => 'disabled']) }}
                          @if($errors->has('email'))
                              <small>{{ $errors->first('email') }}</small>
                          @endif
                      </div>
                    </div>


                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                      <div class="col-md-8 col-lg-9">
                        <select class="form-control validate @error('gender') is-invalid @enderror" name="gender" id="gender" required autocomplete="gender">
                            @error('gender')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <option value="sfaf" selected disabled hidden>{{ $faculty->gender }}</option>
                            <option value="Male"> Male </option>
                            <option value="Female"> Female </option>      
                    </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        {{ Form::number('phone',null,array('class'=>'form-control','id'=>'phone')) }}
                                @if($errors->has('phone'))
                                    <small>{{ $errors->first('phone') }}</small>
                                @endif
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        {{ Form::text('address',null,array('class'=>'form-control','id'=>'address')) }}
                                @if($errors->has('address'))
                                    <small>{{ $errors->first('address') }}</small>
                                @endif
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Birthdate</label>
                      <div class="col-md-8 col-lg-9">
                        {{ Form::date('birthdate',null,array('class'=>'form-control','id'=>'birthdate')) }}
                        @if($errors->has('birthdate'))
                        <small>{{ $errors->first('birthdate') }}</small>
                        @endif
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-outline-dark">Save Changes</button>
                    </div>
                    {!! Form::close() !!} 

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">
                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="{{ route('faculty_change_password') }}" method="post">
                    @csrf

                    <div class="row mb-3">
                      <label for="password" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                          <input name="password" type="password" class="form-control" id="password" required onchange="validatePassword()">
                          <span id="passwordMatchMessages"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newpassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                          <input name="newpassword" type="password" class="form-control" id="newpassword" required>
                      </div>
                    </div>
                  
                    <div class="row mb-3">
                        <label for="renewpassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="renewpassword" type="password" class="form-control" id="renewpassword" required>
                            <span id="passwordMatchMessage"></span>
                        </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-outline-dark">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->
                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
  </main>
<script>
  function validatePassword() {
      var enteredPassword = document.getElementById('password').value;
      var messageSpan = $("#passwordMatchMessages");

      // Send the hashed password to the server for validation
      $.ajax({
          url: '/faculty/profile/validate-password',
          method: 'POST',
          data: { password: enteredPassword }, // Use 'password' as the key to match your Laravel controller
          success: function(response) {
              if (response.match) {
                  messageSpan.text("Current password match.");
                  messageSpan.css('color', 'green');
              } else {
                  messageSpan.text("Current password is wrong");
                  messageSpan.css('color', 'red');
              }
          },
          error: function(xhr, status, error) {
              console.error(error);
              // Handle error if needed
          }
      });
  }

  $(document).ready(function () {
            // When the "Change Avatar" button is clicked
            $("#toggleForm").click(function () {
                // Toggle the visibility of the form
                $("#avatarForm").toggle();
            });
        
      
        let img = document.getElementById('img');
        let input = document.getElementById('avatar');
      
        input.onchange = (e) => {
          if (input.files[0])
          img.src = URL.createObjectURL(input.files[0])
        }
      
        $('#newpassword, #renewpassword').on('input', function () {
                        var newPassword = $("#newpassword").val();
                        var renewPassword = $("#renewpassword").val();
                        var messageSpan = $("#passwordMatchMessage");
      
                        if (newPassword === renewPassword) {
                            messageSpan.text("Password match.");
                            messageSpan.css('color', 'green');
                        } else {
                            messageSpan.text("Password did not match.");
                            messageSpan.css('color', 'red');
                        }
          });
  });
</script>