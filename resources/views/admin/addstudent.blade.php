@extends('layouts.navigation')
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Add Student</h5>

          <form class="row g-3" method="POST" action="{{ route('addstudent') }}">
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

            <div class="col-md-4">
              <div class="form-floating">
                <input type="text" name="student_id" class="form-control" id="student_id" placeholder="Student ID">
                <label for="student_id">Student ID</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-floating">
                <input type="text" name="college" class="form-control" id="college" placeholder="College">
                <label for="college">College</label>
              </div>
            </div>
            <div class="col-md-4">
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