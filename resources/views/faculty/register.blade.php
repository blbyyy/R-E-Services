@extends('layouts.navigation')
<style>
    .thick-hr {
        height: 5px; 
        background-color: #000; 
        border: none; 
    }
</style>
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Create a New Faculty Member Profile</h5>
          <p>Note: All students must be enrolled in Technological University of
            Philippines - Taguig Campus. please enter the student ID number.</p>

          <!-- Floating Labels Form -->
          <form class="row g-3" method="POST" action="{{ route('FacultyRegistered') }}">
            @csrf

            <input type="hidden" class="form-control id" id="role" name="role" value="Faculty">

            <div class="col-md-4">
              <div class="form-floating">
                <input type="text" class="form-control" id="lname" @error('lname') is-invalid @enderror name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus placeholder="Last Name">
                    @error('lname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                <label for="lname">Last Name</label>
              </div>
            </div>

            <div class="col-md-4">
                <div class="form-floating">
                <input type="text" class="form-control" id="fname" @error('fname') is-invalid @enderror name="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus placeholder="First Name">
                    @error('fname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                <label for="fname">First Name</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-floating">
                <input type="text" class="form-control" id="mname" @error('mname') is-invalid @enderror name="mname" value="{{ old('mname') }}" required autocomplete="mname" autofocus placeholder="Middle Name">
                    @error('mname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                <label for="mname">Middle Name</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                <input type="text" class="form-control" id="tup_id" @error('tup_id') is-invalid @enderror name="tup_id" value="{{ old('tup_id') }}" required autocomplete="tup_id" autofocus placeholder="TUP ID">
                    @error('tup_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                <label for="tup_id">TUP ID</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                <input type="text" class="form-control" id="department" @error('department') is-invalid @enderror name="department" value="{{ old('department') }}" required autocomplete="department" autofocus placeholder="Department">
                    @error('department')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                <label for="department">Department</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                <input type="text" class="form-control" id="position" @error('position') is-invalid @enderror name="position" value="{{ old('position') }}" required autocomplete="position" autofocus placeholder="Position">
                    @error('position')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                <label for="position">Position</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                <input type="text" class="form-control" id="designation" @error('designation') is-invalid @enderror name="designation" value="{{ old('designation') }}" required autocomplete="designation" autofocus placeholder="Designation">
                    @error('designation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                <label for="designation">Designation</label>
                </div>
            </div>

            <div class="col-12">
                <div class="form-floating">
                <textarea class="form-control" placeholder="Address" id="address" @error('address') is-invalid @enderror name="address" value="{{ old('address') }}" required autocomplete="address" autofocus style="height: 100px;"></textarea>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <label for="address">Address</label>
                </div>
            </div>

            <div class="col-md-4">
              <div class="col-md-12">
                <div class="form-floating">
                <input type="text" class="form-control" id="phone" @error('phone') is-invalid @enderror name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus placeholder="Phone">
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <label for="phone">Phone</label>
                </div>
              </div>
            </div>

            <div class="col-md-4">
                <div class="col-md-12">
                  <div class="form-floating">
                  <input type="date" class="form-control" id="birthdate" @error('birthdate') is-invalid @enderror name="birthdate" value="{{ old('birthdate') }}" required autocomplete="birthdate" autofocus placeholder="Birhtdate">
                      @error('birthdate')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  <label for="birthdate">Birthdate</label>
                  </div>
                </div>
            </div>

            <div class="col-md-4">
              <div class="form-floating mb-3">
                <select class="form-select" id="gender" name="gender" aria-label="State">
                  <option value="" disabled selected>Select Gender</option>
                  <option value="Male" >Male</option>
                  <option value="Female" >Female</option>
                </select>
                <label for="gender">Gender</label>
              </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                <input type="email" class="form-control" id="email" @error('email') is-invalid @enderror name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <label for="email">Email</label>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-floating">
                <input type="password" class="form-control" id="password" @error('password') is-invalid @enderror name="password" value="{{ old('password') }}" required autocomplete="password" autofocus placeholder="Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <label for="password">Password</label>
                </div>
            </div>

            <div class="col-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="gridCheck">
                  <label class="form-check-label" for="gridCheck">
                    I accept WEBSITE and Terms of Service Privacy Policy
                  </label>
                </div>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Create Account</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>

            

          </form><!-- End floating Labels Form -->

        </div>
      </div>
</main>