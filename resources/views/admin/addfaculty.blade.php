@extends('layouts.navigation')
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Add User Faculty</h5>

          <form class="row g-3" method="POST" action="{{ route('addfaculty') }}">
            @csrf
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
                <input type="text" name="department" class="form-control" id="department" placeholder="Department">
                <label for="department">Department</label>
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
                  <option selected>Select Gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
                <label for="gender">Gender</label>
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
                  <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                  <label for="password">Password</label>
                </div>
            </div>
           
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Add</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
          </form><!-- End floating Labels Form -->

        </div>
      </div>
</main>