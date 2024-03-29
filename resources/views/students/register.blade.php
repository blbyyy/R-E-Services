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
          <h5 class="card-title">Create a New Student Profile</h5>
          <p><span class="badge bg-warning text-dark">Note:</span> (All students must be enrolled in Technological University of
            Philippines - Taguig Campus. please enter the Student ID Number and use TUP Email only.)</p>

        <form class="row g-3" method="POST" action="{{ route('StudentRegistered') }}">
            @csrf

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
                <label for="tup_id">TUP ID (TUPT-XX-XXXX)</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <select name="course" class="form-select" id="course" aria-label="State">
                        <option selected>Choose.....</option>
                        <option value="BSIT">BS in Information Technology</option>
                        <option value="BSEE">BS in Electrical Engineering</option>
                        <option value="BSECE">BS in Electronics Engineering</option>
                        <option value="BSME">BS in Mechanical Engineering</option>
                        <option value="BSCE">BS in Civil Engineering</option>
                        <option value="BSESSDP">BS in Environmental Science</option>
                        <option value="BETAT">BET Major In Automotive Technology</option>
                        <option value="BETCHT">BET Major In Chemical Technology</option>
                        <option value="BETET">BET Major In Electrical Technology</option>
                        <option value="BETEMT">BET Major In Electromechanical Technology</option>
                        <option value="BETELXT">BET Major In Electronics Technology</option>
                        <option value="BETICT">BET Major In Instrumentation and Control Technology</option>
                        <option value="BETMECT">BET Major In Mechatronics Technology</option>
                        <option value="BETDMT">BET Major In Dies & Moulds Technology</option>
                        <option value="BETHVAC">BET Major In Heating, Ventilation, and Airconditioning/Refrigeration Technology</option>
                        <option value="BETNDTT">BET Major In Non-Destructive Testing Technology</option>
                    </select>
                    <label for="course">Course</label>
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
                  <option value="" disabled selected>Select Sex</option>
                  <option value="Male" >Male</option>
                  <option value="Female" >Female</option>
                </select>
                <label for="gender">Sex</label>
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

            <div class="google-login-button">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.1" x="0px" y="0px" class="google-icon" viewBox="0 0 48 48" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                  <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12
          c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24
          c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
                  <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657
          C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
                  <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36
          c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
                  <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571
          c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
                </svg>
                <a href="{{ url('login/google') }}">
                    <span>Sign up with Google</span>
                </a>
            </div>

            <div class="col-12" style="padding-top: 20px">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-outline-dark">Create Account</button>
                    <button type="reset" class="btn btn-outline-dark ms-2">Reset</button>
                </div>
            </div>

        </form>

        </div>
      </div>
</main>