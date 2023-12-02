@extends('layouts.navigation')
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Add Research</h5>

          <form class="row g-3" method="POST" action="{{ route('addresearch') }}">
            @csrf

            <div class="col-12">
                <div class="form-floating">
                  <textarea name="research_title" class="form-control" placeholder="Research Title" id="research_title" style="height: 100px;"></textarea>
                  <label for="Address">Research Title</label>
                </div>
            </div>

            <div class="col-12">
                <div class="form-floating">
                  <textarea name="abstract" class="form-control" placeholder="Research Abstract" id="abstract" style="height: 300px;"></textarea>
                  <label for="abstract">Research Abstract</label>
                </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating mb-3">
                  <select name="department" class="form-select" id="department" aria-label="State">
                      <option selected>Choose.....</option>
                      <option value="EAAD">EAAD</option>
                      <option value="CAAD">CAAD</option>
                      <option value="MAAD">MAAD</option>
                      <option value="BSAD">BSAD</option>
                  </select>
                  <label for="department">Department</label>
              </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                  <input type="text" name="course" class="form-control" id="course" placeholder="Course">
                  <label for="course">Course</label>
                </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" name="faculty_adviser1" class="form-control" id="faculty_adviser" placeholder="Faculty Adviser 1">
                <label for="faculty_adviser1">Faculty Adviser 1</label>
              </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                  <input type="text" name="faculty_adviser2" class="form-control" id="faculty_adviser2" placeholder="Faculty Adviser 2">
                  <label for="faculty_adviser2">Faculty Adviser 2</label>
                </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" name="faculty_adviser1" class="form-control" id="faculty_adviser" placeholder="Faculty Adviser 1">
                <label for="faculty_adviser1">Faculty Adviser 1</label>
              </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                  <input type="text" name="faculty_adviser2" class="form-control" id="faculty_adviser2" placeholder="Faculty Adviser 2">
                  <label for="faculty_adviser2">Faculty Adviser 2</label>
                </div>
            </div>

            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" name="researcher1" class="form-control" id="researcher1" placeholder="Researcher 1">
                <label for="researcher1">Researcher 1</label>
              </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                  <input type="text" name="researcher2" class="form-control" id="researcher2" placeholder="Researcher 2">
                  <label for="researcher">Researcher 2</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                  <input type="text" name="researcher3" class="form-control" id="researcher3" placeholder="Researcher 3">
                  <label for="researcher3">Researcher 3</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                  <input type="text" name="researcher4" class="form-control" id="researcher4" placeholder="Researcher 4">
                  <label for="researcher4">Researcher 4</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                  <input type="text" name="researcher5" class="form-control" id="researcher5" placeholder="Researcher 5">
                  <label for="researcher5">Researcher 5</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                  <input type="text" name="researcher6" class="form-control" id="researcher6" placeholder="Researcher 6">
                  <label for="researcher6">Researcher 6</label>
                </div>
            </div>

              <div class="col-md-6">
                <div class="form-floating">
                  <input type="text" name="time_frame" class="form-control" id="time_frame" placeholder="Time Frame">
                  <label for="time_frame">Time Frame</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating">
                  <input type="date" name="date_completion" class="form-control" id="date_completion" placeholder="Date Completion">
                  <label for="date_completion">Date Completion</label>
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