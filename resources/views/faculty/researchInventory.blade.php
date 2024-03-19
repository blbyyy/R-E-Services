@extends('layouts.navigation')
@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Research Inventory</h1>
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

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add Research</h5>
                  <form class="row g-3" method="POST" action="{{ route('faculty.addResearch') }}">
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
                              <option value="EAAD">Electrical and Allied Department</option>
                              <option value="CAAD">Civil and Allied Department</option>
                              <option value="MAAD">Mechanical and Allied Department</option>
                              <option value="BSAD">Basic Science Arts Department</option>
                          </select>
                          <label for="department">Department</label>
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
    
                    <div id="additionalFacultyAdviser">
                      <div class="col-md-12">
                        <div class="form-floating">
                            <input name="faculty_adviser1" class="form-control" id="faculty_adviser1" placeholder="Faculty Adviser 1">
                            <label for="faculty_adviser1">Faculty Adviser 1</label>
                        </div>
                      </div>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                      <button type="button" class="btn btn-outline-dark" id="addFacultyAdviser"><i class="bi bi-plus-lg"></i> Add Faculty Adviser</button>
                    </div>

                    <div id="additionalResearcher">
                      <div class="col-md-12">
                        <div class="form-floating">
                            <input name="researcher1" class="form-control" id="researcher1" placeholder="Researcher">
                            <label for="researcher1">Researcher 1</label>
                        </div>
                      </div>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                      <button type="button" class="btn btn-outline-dark" id="addResearcher"><i class="bi bi-plus-lg"></i> Add Researcher</button>
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
                    
                    <div class="col-12" style="padding-top: 20px">
                      <div class="d-flex justify-content-end">
                          <button type="submit" class="btn btn-outline-dark">Add</button>
                          <button type="reset" class="btn btn-outline-dark ms-2">Reset</button>
                      </div>
                    </div>
                  </form>
            </div>
        </div>
    </div>

</main>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    //add faculty adviser
    document.addEventListener('DOMContentLoaded', function () {
        // Initial count of visible input fields
        let adviserCount = 1;

        // Add button click event
        document.getElementById('addFacultyAdviser').addEventListener('click', function () {
            // Increment the count
            adviserCount++;

            // Create a new input field
            const newFacultyAdviserField = document.createElement('div');
            newFacultyAdviserField.innerHTML = `
                <br>
                <div class="col-md-12">
                    <div class="form-floating">
                        <input name="faculty_adviser${adviserCount}" class="form-control" id="faculty_adviser${adviserCount}" placeholder="Faculty Adviser">
                        <label for="faculty_adviser${adviserCount}">Faculty Adviser ${adviserCount}</label>
                    </div>
                </div>
            `;

            // Append the new input field to the container
            document.getElementById('additionalFacultyAdviser').appendChild(newFacultyAdviserField);
        });
    });

    //add researcher adviser
    document.addEventListener('DOMContentLoaded', function () {
        // Initial count of visible input fields
        let researcherCount = 1;

        // Add button click event
        document.getElementById('addResearcher').addEventListener('click', function () {
            // Increment the count
            researcherCount++;

            // Create a new input field
            const newResearcherFields = document.createElement('div');
            newResearcherFields.innerHTML = `
                <br>
                <div class="col-md-12">
                    <div class="form-floating">
                        <input name="researcher${researcherCount}" class="form-control" id="researcher${researcherCount}" placeholder="Researcher">
                        <label for="researcher${researcherCount}">Researcher ${researcherCount}</label>
                    </div>
                </div>
            `;

            // Append the new input field to the container
            document.getElementById('additionalResearcher').appendChild(newResearcherFields);
        });
    });
</script>