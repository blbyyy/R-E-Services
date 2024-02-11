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
    <h1>Student Applications</h1>
  </div>

    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Applications from your students</h5>

          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Actions</th>
                <th scope="col">Student Name</th>
                <th scope="col">Research Title</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            @foreach ($application as $applications)
            <tbody>
              <tr>
                <td> 
                  <button data-id="{{$applications->id}}" type="button" class="btn btn-info showStudentApplication" data-bs-toggle="modal" data-bs-target="#showStudentApplicationInfo"><i class="bi bi-info-lg"></i></button>
                  @if ($applications->status === 'Pending Technical Adviser Approval')
                    <button data-id="{{$applications->id}}" type="button" class="btn btn-success taApproval" data-bs-toggle="modal" data-bs-target="#technicalAdviserApproval"><i class="bi bi-check2-circle"></i></button>
                  @elseif ($applications->status === 'Pending Subject Adviser Approval')
                    <button data-id="{{$applications->id}}" type="button" class="btn btn-success saApproval" data-bs-toggle="modal" data-bs-target="#subjectAdviserApproval"><i class="bi bi-check2-circle"></i></button>
                  @endif
                  </td>
                <td>{{$applications->requestor_name}}</td>
                <td>{{$applications->research_title}}</td>
                <td>
                  @if ($applications->status === 'Returned')
                    <h5><span class="badge bg-warning" style="color: black">{{$applications->status}}</span></h5>
                  @elseif ($applications->status === 'Passed')
                    <h5><span class="badge bg-warning" style="color: black">{{$applications->status}}</span></h5>
                  @elseif ($applications->status === 'Pending')
                    <h5><span class="badge bg-warning" style="color: black">{{$applications->status}}</span></h5>
                  @elseif ($applications->status === 'Pending Technical Adviser Approval')
                    <h5><span class="badge bg-warning" style="color: black">{{$applications->status}}</span></h5>
                  @elseif ($applications->status === 'Pending Subject Adviser Approval')
                    <h5><span class="badge bg-warning" style="color: black">{{$applications->status}}</span></h5>
                  @endif
                </td>
              </tr>
            </tbody>
            @endforeach
          </table>

          <div class="modal fade" id="showStudentApplicationInfo" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header" >
                  <h5 class="modal-title" ></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <section class="section profile">
                    <div class="row">
                      <div class="col-xl-4">
                      </div>
              
                      <div class="col-xl-12">
              
                        <div class="card">
                          <div class="card-body pt-3">
                            <div class="tab-content pt-2">
              
                              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Research Title</h5>
                                <p id="research_title" class="large fst-italic"></p>
      
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label ">Submission Frequency</div>
                                  <div id="submission_frequency" class="col-lg-9 col-md-8"></div>
                                </div>
      
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Initial Simmilarity Percentage</div>
                                  <div id="initial_simmilarity_percentage" class="col-lg-9 col-md-8"></div>
                                </div>
                                
                                <h5 class="card-title">Research Details</h5>
              
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label ">Thesis Type</div>
                                  <div id="thesis_type" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Technical Adviser</div>
                                  <div id="technicalAdviser" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Technical Adviser Email</div>
                                  <div id="technicalAdviserEmail" class="col-lg-9 col-md-8"></div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Subject Adviser</div>
                                  <div id="subjectAdviser" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Subject Adviser Email</div>
                                  <div id="subjectAdviserEmail" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Research Specialist</div>
                                  <div id="research_specialist" class="col-lg-9 col-md-8">tba</div>
                                </div>
      
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Research Staff</div>
                                  <div id="research_staff" class="col-lg-9 col-md-8">tba</div>
                                </div>
              
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Status</div>
                                    <div id="status" class="col-lg-9 col-md-8">
                                    </div>
                                </div>
              
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Simmilarity Percentage Results</div>
                                  <div id="simmilarity_percentage_results" class="col-lg-9 col-md-8"></div>
                                </div>
      
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Certificate</div>
                                  <div id="certificate" class="col-lg-9 col-md-8"></div>
                                </div>
      
                                <h5 class="card-title">Researchers Details</h5>
      
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label ">Requestor Name</div>
                                  <div id="requestor_name" class="col-lg-9 col-md-8"></div>
                                </div>
      
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Requestor Type</div>
                                  <div id="requestor_type" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Student ID</div>
                                  <div id="student_id" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">TUP Email</div>
                                  <div id="tup_mail" class="col-lg-9 col-md-8"></div>
                                </div>
      
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label ">Gender</div>
                                  <div id="sex" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Course</div>
                                  <div id="course" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">College</div>
                                  <div id="college" class="col-lg-9 col-md-8"></div>
                                </div>
      
                                <div class="row" id="r1">
                                  <div class="col-lg-3 col-md-4 label ">Researcher 1</div>
                                  <div id="researchers_name1" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row" id="r2">
                                  <div class="col-lg-3 col-md-4 label">Researcher 2</div>
                                  <div id="researchers_name2" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row" id="r3">
                                  <div class="col-lg-3 col-md-4 label">Researcher 3</div>
                                  <div id="researchers_name3" class="col-lg-9 col-md-8"></div>
                                </div>
                                
                                <div class="row" id="r4">
                                  <div class="col-lg-3 col-md-4 label ">Researcher 4</div>
                                  <div id="researchers_name4" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row" id="r5">
                                  <div class="col-lg-3 col-md-4 label">Researcher 5</div>
                                  <div id="researchers_name5" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row" id="r6">
                                  <div class="col-lg-3 col-md-4 label">Researcher 6</div>
                                  <div id="researchers_name6" class="col-lg-9 col-md-8"></div>
                                </div>
      
                                <div class="row" id="r7">
                                  <div class="col-lg-3 col-md-4 label ">Researcher 7</div>
                                  <div id="researchers_name7" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row" id="r8">
                                  <div class="col-lg-3 col-md-4 label">Researcher 8</div>
                                  <div id="researchers_name8" class="col-lg-9 col-md-8"></div>
                                </div>
              
              
                              </div>
                            </div>
                          </div>
                        </div>
              
                      </div>
                    </div>
                  </section>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="technicalAdviserApproval" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Technical Adviser Approval</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
        
                  <div class="row g-4">
                    <div class="col-md-4">
                        <div class="icon" style="padding-bottom: 20px; padding-top: 30px;">
                          <i class="bi bi-file-earmark-pdf"></i>
                        </div>
                    
                        <center>
                          <div id="studentApplicationFile1" style="padding-bottom: 20px"></div>
                        </center>
                    </div>
                
                    <div class="col-md-7">
                      <form class="row g-3" style="padding-top: 20px;" id="technicalAdviserApprovalForm" enctype="multipart/form-data">
                      @csrf
        
                          <input name="fileId1" type="hidden" class="form-control" id="fileId1">
                          <input name="requestId1" type="hidden" class="form-control" id="requestId1">
            
                          <div class="col-md-12">
                              <div class="form-floating">
                                  <select name="technicalAdviserStatus" class="form-select" id="technicalAdviserStatus" aria-label="State">
                                      <option selected>Choose....</option>
                                      <option value="Pending Subject Adviser Approval">Approve</option>
                                      <option value="Rejected By Technical Adviser">Reject</option>
                                  </select>
                                  <label for="technicalAdviserStatus">Status</label>
                              </div>
                          </div>
                          
                          <div class="col-12" id="technicalAdviserRemarksContainer" style="display: none;">
                              <div class="form-floating">
                                  <textarea class="form-control" id="technicalAdviserRemarks" name="technicalAdviserRemarks" style="height: 150px;"></textarea>
                                  <label for="technicalAdviserRemarks">Remarks</label>
                              </div>
                          </div>
                          
                          <div class="col-12" style="padding-top: 20px">
                              <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-dark" id="technicalAdviserAprrovalBtn">Send</button>
                              </div>
                          </div>
        
                      </form>
                    </div>    
        
                  </div>
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="subjectAdviserApproval" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Subject Adviser Approval</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
        
                  <div class="row g-4">
                    <div class="col-md-4">
                        <div class="icon" style="padding-bottom: 20px; padding-top: 30px;">
                          <i class="bi bi-file-earmark-pdf"></i>
                        </div>
                    
                        <center>
                          <div id="studentApplicationFile2" style="padding-bottom: 20px"></div>
                        </center>
                    </div>
                
                    <div class="col-md-7">
                      <form class="row g-3" style="padding-top: 20px;" id="subjectAdviserApprovalForm" enctype="multipart/form-data">
                      @csrf
        
                          <input name="fileId2" type="hidden" class="form-control" id="fileId2">
                          <input name="requestId2" type="hidden" class="form-control" id="requestId2">
            
                          <div class="col-md-12">
                              <div class="form-floating">
                                  <select name="subjectAdviserStatus" class="form-select" id="subjectAdviserStatus" aria-label="State">
                                      <option selected>Choose....</option>
                                      <option value="Pending">Approve</option>
                                      <option value="Rejected By Subject Adviser">Reject</option>
                                  </select>
                                  <label for="subjectAdviserStatus">Status</label>
                              </div>
                          </div>
                          
                          <div class="col-12" id="subjectAdviserRemarksContainer" style="display: none;">
                              <div class="form-floating">
                                  <textarea class="form-control" id="subjectAdviserRemarks" name="subjectAdviserRemarks" style="height: 150px;"></textarea>
                                  <label for="subjectAdviserRemarks">Remarks</label>
                              </div>
                          </div>
                          
                          <div class="col-12" style="padding-top: 20px">
                              <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-dark" id="subjectAdviserAprrovalBtn">Send</button>
                              </div>
                          </div>
        
                      </form>
                    </div>    
        
                  </div>
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    document.getElementById('technicalAdviserStatus').addEventListener('change', function () {
          var technicalAdviserRemarksContainer = document.getElementById('technicalAdviserRemarksContainer');

          if (this.value === 'Rejected By Technical Adviser') {
            technicalAdviserRemarksContainer.style.display = 'block';
          } else {
            technicalAdviserRemarksContainer.style.display = 'none';
          }
      });

      $('#technicalAdviserApproval').on('hidden.bs.modal', function () {
              $('#technicalAdviserApprovalForm')[0].reset();
              $('#remarksContainer').hide();
          });


    document.getElementById('subjectAdviserStatus').addEventListener('change', function () {
          var subjectAdviserRemarksContainer = document.getElementById('subjectAdviserRemarksContainer');

          if (this.value === 'Rejected By Subject Adviser') {
            subjectAdviserRemarksContainer.style.display = 'block';
          } else {
            subjectAdviserRemarksContainer.style.display = 'none';
          }
      });

      $('#subjectAdviserApproval').on('hidden.bs.modal', function () {
              $('#subjectAdviserApprovalForm')[0].reset();
              $('#subjectAdviserRemarksContainer').hide();
          });
  });
</script>