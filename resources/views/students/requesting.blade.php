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
    <h1>Certification</h1>
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
        @elseif($files->file_status == 'Returned')
          <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$files->research_title}}</h5>
                    <div class="icon">
                        <i class="bi bi-file-earmark-pdf"></i>
                    </div>
                
                    <center>
                      <button type="button" class="btn btn-outline-dark fetch_id" data-bs-toggle="modal" data-bs-target="#studentreapplycertification" data-id="{{$files->id}}">
                          Re-Apply</i>
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
                        <button type="button" class="btn btn-outline-dark studentapplycert" data-bs-toggle="modal" data-bs-target="#studentapplycertification" data-id="{{$files->id}}">
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

  <div class="modal fade" id="studentapplycertification" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Apply for Certification</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form id="studentcertificationform" class="row g-3" enctype="multipart/form-data">
            @csrf

          <input type="hidden" class="form-control" id="research_id" name="research_id">
    
            <div class="col-md-6">
              <div class="form-floating">
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
              <div class="form-floating">
                <select name="requestor_type" class="form-select" id="requestor_type" aria-label="State">
                  <option value=""></option>
                  <option value="Graduate Student">Graduate Student</option>
                  <option value="Undergraduate Student">Undergraduate Student</option>
                  <option value="Faculty">Faculty</option>
                </select>
                <label for="requestor_type">Requestor Type</label>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-floating">
                <select name="adviser_id" class="form-select" id="adviser_id" aria-label="State">
                  <option value="">Select Adviser.....</option>
                  @foreach($advisers as $adviser)
                    <option value="{{$adviser->id}}">{{$adviser->lname}}, {{$adviser->fname}} {{$adviser->mname}} ({{$adviser->department_name}})</option>
                  @endforeach
                </select>
                <label for="adviser_id">Adviser Name</label>
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

            <div class="d-grid gap-2 mt-3">
              <button type="button" class="btn btn-outline-dark" id="addResearcher"><i class="bi bi-plus-lg"></i> Add Researcher</button>
            </div>
    
            <div class="col-12" style="padding-top: 20px">
              <div class="form-check">
                <input name="agreement" class="form-check-input" type="checkbox" id="agreement" value="I Agree" required>
                <label class="form-check-label" for="agreement">
                  I accept WEBSITE and Terms of Service Privacy Policy
                </label>
              </div>
            </div>
    
            <div class="col-" style="padding-top: 20px">
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-outline-dark studentcertification">Apply Certification</button>
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

  <div class="modal fade" id="studentreapplycertification" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Apply for Certification</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form id="studentreapplycertificationform" class="row g-3" enctype="multipart/form-data">
            @csrf

              <input type="hidden" class="form-control" id="re_apply_research_id" name="re_apply_research_id">

              <div class="col-12">
                  <label for="research_file" class="form-label">Enter the revised research file in this field:</label>
                  <input type="file" class="form-control" id="research_file" name="research_file">
                  <span style="font-size: small">(Note: The uploaded PDF file should not exceed 10mb in size.)</span>
              </div>
    
            <div class="col-" style="padding-top: 20px">
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-outline-dark studentreapplycert">Apply Certification</button>
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
