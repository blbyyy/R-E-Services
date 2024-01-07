@extends('layouts.navigation')
<style>
  .icon{
      font-size: 8em;
      display: flex;
      justify-content: center;
      align-items: center;
      padding-top: 30px;
      padding-bottom: 50px;
      color: maroon;
  }
  .body{
      display: flex;
      justify-content: center;
      align-items: center;
      padding-bottom: 50px;
  }
</style>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Apply for Certification</h1>
  </div>

  <div class="row g-4">
    @if(count($myfiles) > 0)
      @foreach($myfiles as $files)
      @if($files->file_status == 'Pending')
          <div class="col-md-4">
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">{{$files->research_title}}</h5>
                      <div class="icon">
                          <i class="bi bi-file-earmark-pdf"></i>
                      </div>
                  
                      <center>
                          <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="This file is currently undergoing certification.">
                            Apply Certification
                          </button>
                      </center>
                  </div>
              </div>
          </div>
        @elseif($files->file_status == 'Passed')
          <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$files->research_title}}</h5>
                    <div class="icon">
                        <i class="bi bi-file-earmark-pdf"></i>
                    </div>
                
                    <center>
                        <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="This file is already passed the certification.">
                          Apply Certification
                        </button>
                    </center>
                </div>
            </div>
          </div>
        @else
          <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$files->research_title}}</h5>
                    <div class="icon">
                        <i class="bi bi-file-earmark-pdf"></i>
                    </div>
                
                    <center>
                        <button type="button" class="btn btn-outline-dark staffapplycert" data-bs-toggle="modal" data-bs-target="#staffapplycertification" data-id="{{$files->id}}">
                            Apply Certification</i>
                        </button>
                    </center>
                </div>
            </div>
          </div>
        @endif
      @endforeach
      @else
        <div class="col-md-12">
          <div class="card">
              <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="icon">
                      <i class="bi bi-folder2-open"></i>
                  </div>
                  <div class="body">
                      <h2>Nothing has been uploaded here.</h2>
                  </div>
              </div>
          </div>
        </div>
    @endif
  </div>  

  <div class="modal fade" id="staffapplycertification" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Apply for Certification</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form id="staffcertificationform" class="row g-3" enctype="multipart/form-data">
            @csrf

          <input type="hidden" class="form-control" id="research_id" name="research_id">
    
          <label>Is there an initial run of a similarity test (turnitin) by your research adviser?</label>
            <div class="col-sm-12">
                <div class="form-check">
                    <input name="advisors_turnitin_precheck" class="form-check-input" type="radio" name="advisors_turnitin_precheck" id="advisors_turnitin_precheck_yes" value="Yes" onclick="toggleForms('yes')">
                    <label class="form-check-label" for="advisors_turnitin_precheck_yes">
                        Yes
                    </label>
                </div>
                <div class="form-check">
                    <input name="advisors_turnitin_precheck" class="form-check-input" type="radio" name="advisors_turnitin_precheck" id="advisors_turnitin_precheck_no" value="No" onclick="toggleForms('no')">
                    <label class="form-check-label" for="advisors_turnitin_precheck_no">
                        No
                    </label>
                </div>
            </div>

              <div id="formContainer" style="display: none;">
                <div class="col-md-12">
                  <div class="form-floating mb-3">
                      <select name="submission_frequency" class="form-select" id="submission_frequency" aria-label="State">
                          <option value="First Submission">First Submission</option>
                          <option value="Second Submission">Second Submission</option>
                          <option value="Third Submission">Third Submission</option>
                          <option value="Fourth Submission">Fourth Submission</option>
                          <option value="Fifth Submission">Fifth Submission</option>
                      </select>
                      <label for="submission_frequency">Frequency of Submission</label>
                  </div>
                </div>

                <div class="col-md-12">
                    <div class="form-floating">
                        <input name="initial_simmilarity_percentage" type="number" class="form-control" id="initial_simmilarity_percentage" placeholder="Enter the initial percentage of similarity for your paper">
                        <label for="initial_simmilarity_percentage">Enter the initial percentage of similarity for your paper</label>
                    </div>
                </div>
            </div>
    
            <div class="col-md-6">
              <div class="form-floating mb-3">
                <select name="thesis_type" class="form-select" id="thesis_type" aria-label="State">
                  <option value=""></option>
                  <option value="Undergaduate Thesis">Undergraduate Thesis</option>
                  <option value="Masters Thesis">Capstone</option>
                  <option value="Special Project">Special Project</option>
                  <option value="Master's Thesis">Master's Thesis</option>
                  <option value="Doctoral Disertation">Doctoral Disertation</option>
                </select>
                <label for="thesis_type">Type of Thesis</label>
              </div>
            </div>
    
            <div class="col-md-6">
              <div class="form-floating mb-3">
                <select name="requestor_type" class="form-select" id="requestor_type" aria-label="State">
                  <option value=""></option>
                  <option value="Graduate Student">Graduate Student</option>
                  <option value="Undergraduate Student">Undergraduate Student</option>
                  <option value="Faculty">Faculty</option>
                </select>
                <label for="requestor_type">Requestor Type</label>
              </div>
            </div>
    
            {{-- <hr class="thick-hr"> --}}

            <div class="col-md-12">
                <div class="form-floating">
                  <input name="purpose" type="text" class="form-control" id="purpose" placeholder="Purpose">
                  <label for="purpose">Purpose</label>
                </div>
            </div>
    
            <div class="col-md-6">
              <div class="form-floating">
                <input name="research_specialist" type="text" class="form-control" id="research_specialist" placeholder="Researcher Specialist">
                <label for="research_specialist">Researcher Specialist</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input name="research_staff" type="text" class="form-control" id="research_staff" placeholder="Research Staff">
                <label for="research_staff">Research Staff</label>
              </div>
            </div>
    
            <div class="col-md-6">
              <div class="form-floating">
                <input name="adviser_name" type="text" class="form-control" id="adviser_name" placeholder="Name of Adviser">
                <label for="adviser_name">Name of Adviser</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input name="adviser_email" type="text" class="form-control" id="adviser_email" placeholder="Adviser Email">
                <label for="adviser_email">Adviser Email</label>
              </div>
            </div>
    
            <div class="col-md-6">
              <div class="form-floating">
                <input name="college" type="text" class="form-control" id="college" placeholder="College">
                <label for="college">College</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input name="course" type="text" class="form-control" id="course" placeholder="Course">
                <label for="course">Course</label>
              </div>
            </div>

            <div id="additionalFieldsContainer">
              <div class="col-md-12">
                <div class="form-floating">
                    <input name="researchers_name1" class="form-control" id="researchers_name1" placeholder="Your Email">
                    <label for="researchers_name1">Researcher Name 1</label>
                </div>
              </div>
            </div>

            <div class="col-12">
              <button type="button" class="btn btn-outline-dark" id="addResearcher">Add Researcher</button>
            </div>
    
            <div class="col-12">
              <div class="form-check">
                <input name="agreement" class="form-check-input" type="checkbox" id="agreement" value="I Agree" required>
                <label class="form-check-label" for="agreement">
                  I accept WEBSITE and Terms of Service Privacy Policy
                </label>
              </div>
            </div>
    
            <div class="col-12" style="padding-top: 20px">
              <div class="d-flex justify-content-end">
              <button type="submit" class="btn btn-outline-dark staffapplycertification">Apply Certification</button>
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

</main>
<script>
  function toggleForms(option) {
      var formContainer = document.getElementById('formContainer');
      if (option === 'yes') {
          formContainer.style.display = 'block';
      } else {
          formContainer.style.display = 'none';
      }
  }

  function toggleForms(option) {
        var formContainer = document.getElementById('formContainer');
        var submissionFrequency = document.getElementById('submission_frequency');
        var initialsimilarityPercentage = document.getElementById('initial_simmilarity_percentage');

        if (option === 'no') {

            submissionFrequency.value = 'First Submission';
            initialsimilarityPercentage.value = '0';
        }

        formContainer.style.display = option === 'yes' ? 'block' : 'none';
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Initial count of visible input fields
        let visibleFieldsCount = 1;

        // Add button click event
        document.getElementById('addResearcher').addEventListener('click', function () {
            // Increment the count
            visibleFieldsCount++;

            // Create a new input field
            const newInputField = document.createElement('div');
            newInputField.innerHTML = `
                <br>
                <div class="col-md-12">
                    <div class="form-floating">
                        <input name="researchers_name${visibleFieldsCount}" class="form-control" id="researchers_name${visibleFieldsCount}" placeholder="Your Email">
                        <label for="researchers_name${visibleFieldsCount}">Researcher Name ${visibleFieldsCount}</label>
                    </div>
                </div>
            `;

            // Append the new input field to the container
            document.getElementById('additionalFieldsContainer').appendChild(newInputField);
        });
    });
</script>
