@extends('layouts.navigation')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>My Profile</h1>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                @if($staff->avatar === 'avatar.jpg')
                  <img class="rounded-circle" src="https://tse4.mm.bing.net/th?id=OIP.sRdQAfzOzF_ZjC3dnAZVSQHaGw&pid=Api&P=0&h=180" alt=""/>
                @else
                  <img class="rounded-circle" src="{{ asset('storage/'.$staff->avatar) }}" alt="" />    
                @endif
            
              <h2>{{$staff->fname .' '. $staff->lname .' '. $staff->mname}}</h2>
              <h3>{{$staff->role}}</h3>
              
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
                    <div class="col-lg-9 col-md-8">{{$staff->fname}}</div>
                  </div>
                  
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Last Name</div>
                    <div class="col-lg-9 col-md-8">{{$staff->lname}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Middle Name</div>
                    <div class="col-lg-9 col-md-8">{{$staff->mname}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Staff ID</div>
                    <div class="col-lg-9 col-md-8">{{$staff->tup_id}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Position</div>
                    <div class="col-lg-9 col-md-8">{{$staff->position}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Designation</div>
                    <div class="col-lg-9 col-md-8">{{$staff->designation}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{$staff->email}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8">{{$staff->gender}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">{{$staff->phone}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">{{$staff->address}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">BirthDate</div>
                    <div class="col-lg-9 col-md-8">{{$staff->birthdate}}</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  {{ Form::model($staff,['route' => ['staff.update-profile',$staff->id],'method'=> 'PUT','enctype'=>'multipart/form-data']) }}
                  
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
                        {{ Form::email('email',null,array('class'=>'form-control','id'=>'email'))}}
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
                            <option value="sfaf" selected disabled hidden>{{ $staff->gender }}</option>
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
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                    {!! Form::close() !!} 

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
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