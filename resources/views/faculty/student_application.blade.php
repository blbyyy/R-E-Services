@extends('layouts.navigation')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Student Applications</h1>
  </div>

    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Applications from your students</h5>

          <!-- Table with hoverable rows -->
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Actions</th>
                <th scope="col">Student Name</th>
                <th scope="col">Submission Frequency</th>
                <th scope="col">Research Title</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            @foreach ($application as $applications)
            <tbody>
              <tr>
                <td> 
                  <button data-id="{{$applications->id}}" type="button" class="btn btn-info showStudentApplication" data-bs-toggle="modal" data-bs-target="#showStudentApplicationInfo"><i class="bi bi-eye"></i></button>
                </td>
                <td>{{$applications->requestor_name}}</td>
                <td>{{$applications->submission_frequency}}</td>
                <td>{{$applications->research_title}}</td>
                <td>
                  @if ($applications->status === 'Returned')
                    <span class="badge border-danger border-1 text-danger">{{$applications->status}}</span>
                  @elseif ($applications->status === 'Passed')
                    <span class="badge border-success border-1 text-success">{{$applications->status}}</span>
                  @elseif ($applications->status === 'Pending')
                    <span class="badge border-warning border-1 text-warning"> {{$applications->status}}</span>
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
                                  <div class="col-lg-3 col-md-4 label">Adviser Name</div>
                                  <div id="adviser_name" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Adviser Email</div>
                                  <div id="adviser_email" class="col-lg-9 col-md-8"></div>
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

        </div>
      </div>
</main>