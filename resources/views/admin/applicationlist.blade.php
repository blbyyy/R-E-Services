@extends('layouts.navigation')
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">List of Applications</h5>

        <form class="row g-3" method="POST" action="{{ route('admin.applicationlist.specific-status') }}">
          @csrf
          <div class="row">
              <label for="applicationStatus" class="form-label"><b>Filter By Applications Status:</b></label>
              <div class="col-md-9" style="padding-bottom: 0px">
                  <select name="applicationStatus" id="applicationStatus" class="form-select" required>
                      <option selected>--- SELECT STATUS ---</option>
                      <option value="All">All</option>
                      <option value="Passed">Passed</option>
                      <option value="Pending">Pending</option>
                      <option value="Returned">Returned</option>
                  </select>
              </div>
              <div class="col-md-3">
                  <button type="submit" class="btn btn-outline-dark">Change</button>
                  <a href="{{url('/admin/applicationlist')}}" class="btn btn-outline-dark">Refresh</a>
              </div>
          </div>
        </form>

        @if($applications->isEmpty())
          <table class="table table-hover">
              <thead>
                  <tr>
                    <th scope="col">Actions</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                  </tr>
              </thead>
          </table>
          <div class="alert alert-danger d-flex justify-content-center" role="alert">
              <div class="text-center">
                  <span class="badge border-danger border-1 text-danger" style="font-size: large; display: flex; align-items: center;">
                      <i class="bi bi-file-earmark-x" style="font-size: 50px; margin-right: 10px;"></i>
                      No Applications Populated
                  </span>
              </div>
          </div>
        @else
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Actions</th>
                <th scope="col">Application Title</th>
                <th scope="col">Thesis Type</th>
                <th scope="col">Submission Frequency</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($applications as $application)
                <tr>
                  <td style="width: 110px">
                      <button data-id="{{$application->id}}" type="button" class="btn btn-info applicationlistShowBtn" data-bs-toggle="modal" data-bs-target="#studentShowInfo"><i class="bi bi-eye"></i></button>
                      <button data-id="{{$application->id}}" type="button" class="btn btn-danger deleteApplicationBtn"><i class="bi bi-trash"></i></button>
                  </td>
                  <td>{{$application->research_title}}</td>
                  <td>{{$application->thesis_type}}</td>
                  <td>{{$application->submission_frequency}}</td>
                  <td>
                    @if ($application->status === 'Passed')
                      <span class="badge rounded-pill bg-success">{{$application->status}}</span>
                    @elseif ($application->status === 'Returned')
                      <span class="badge rounded-pill bg-danger">{{$application->status}}</span>
                    @else
                      <span class="badge rounded-pill bg-warning">{{$application->status}}</span>
                    @endif
                  </td>
                </tr>                
              @endforeach
            </tbody>
          </table>
        @endif

        <div class="modal fade" id="studentShowInfo" tabindex="-1">
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
                                  <div class="col-lg-3 col-md-4 label">Status</div>
                                  <div id="status" class="col-lg-9 col-md-8"></div>
                              </div>
    
                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">Initial Simmilarity Percentage</div>
                                <div id="initial_simmilarity_percentage" class="col-lg-9 col-md-8"></div>
                              </div>
              
                              <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Simmilarity Percentage Results</div>
                                  <div id="simmilarity_percentage_results" class="col-lg-9 col-md-8"></div>
                              </div>

                              <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Certification Control Number</div>
                                  <div id="control_id" class="col-lg-9 col-md-8"></div>
                              </div>
                              
                              <h5 class="card-title">Research Details</h5>
            
                              <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Thesis Type</div>
                                <div id="thesis_type" class="col-lg-9 col-md-8"></div>
                              </div>
            
                              <div class="row" id="t1">
                                <div class="col-lg-3 col-md-4 label">Technical Adviser</div>
                                <div id="technicalAdviser" class="col-lg-9 col-md-8"></div>
                              </div>
            
                              <div class="row" id="t2">
                                <div class="col-lg-3 col-md-4 label">Technical Adviser Email</div>
                                <div id="taEmail" class="col-lg-9 col-md-8"></div>
                              </div>
                              
                              <div class="row" id="s1">
                                <div class="col-lg-3 col-md-4 label">Subject Adviser</div>
                                <div id="subjectAdviser" class="col-lg-9 col-md-8"></div>
                              </div>
            
                              <div class="row" id="s2">
                                <div class="col-lg-3 col-md-4 label">Subject Adviser Email</div>
                                <div id="saEmail" class="col-lg-9 col-md-8"></div>
                              </div>
            
                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">Research Specialist</div>
                                <div id="research_specialist" class="col-lg-9 col-md-8"></div>
                              </div>
    
                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">Research Staff</div>
                                <div id="research_staff" class="col-lg-9 col-md-8"></div>
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
                                <div class="col-lg-3 col-md-4 label">Requestor ID</div>
                                <div id="requestor_id" class="col-lg-9 col-md-8"></div>
                              </div>
            
                              <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div id="email" class="col-lg-9 col-md-8"></div>
                              </div>
    
                              <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Gender</div>
                                <div id="sex" class="col-lg-9 col-md-8"></div>
                              </div>
            
                              <div class="row" id="c1">
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