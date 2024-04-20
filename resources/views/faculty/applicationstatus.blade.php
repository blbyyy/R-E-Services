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
    <h1>Applications Status</h1>
</div>
<div class="row">
  @if(count($facultystats) > 0)
    @foreach($facultystats as $stats)
      <div class="card mb-3">
        <div class="row g-0">
          <div class="col-md-10 d-flex justify-content-center align-items-center">
              <div class="card-body">
                  <h5 class="card-title">{{$stats->research_title}} 
                    <span>({{$stats->submission_frequency}})</span>
                  </h5>
                  
                  @if ($stats->status === 'Passed')
                    <span class="badge rounded-pill bg-success">{{$stats->status}}</span>
                  @elseif ($stats->status === 'Returned')
                    <span class="badge rounded-pill bg-danger">{{$stats->status}}</span>
                  @else 
                    <span class="badge rounded-pill bg-warning">{{$stats->status}}</span>
                  @endif
                    
              </div>
          </div>
          <div class="col-md-2 d-flex justify-content-center align-items-center">
              <div>
                  <button type="button" class="btn btn-outline-dark facultyViewDetails" data-bs-toggle="modal" data-bs-target="#facultyViewInfo" data-id="{{ $stats->id }}">
                    <i class="bi bi-info-circle"> View Details</i>
                  </button>
              </div>
          </div>
        </div>
      </div>
    @endforeach
  @else
    <div class="col-md-12">
      <div class="card">
          <div class="card-body">
              <h5 class="card-title"></h5>
              <div class="icon">
                <i class="ri-file-forbid-line"></i>
              </div>
              <div class="body">
                  <h2>Nothing has been uploaded here.</h2>
              </div>
          </div>
      </div>
    </div>
  @endif

    <div class="modal fade" id="facultyViewInfo" tabindex="-1">
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
                            <div class="col-lg-3 col-md-4 label">Research Specialist</div>
                            <div id="research_specialist" class="col-lg-9 col-md-8"></div>
                          </div>

                          <div class="row">
                            <div class="col-lg-3 col-md-4 label">Research Staff</div>
                            <div id="research_staff" class="col-lg-9 col-md-8"></div>
                          </div>
        
                          <div class="row">
                            <div class="col-lg-3 col-md-4 label">Status</div>
                              <div id="status" class="col-lg-9 col-md-8">
                                {{-- <h4 id="status" ></h4> --}}
                              </div>
                          </div>
        
                          <div class="row">
                            <div class="col-lg-3 col-md-4 label">Simmilarity Percentage Results</div>
                            <div id="simmilarity_percentage_results" class="col-lg-9 col-md-8"></div>
                          </div>

                          <div class="row">
                            <div class="col-lg-3 col-md-4 label">Remarks</div>
                            <div id="remarks" class="col-lg-9 col-md-8"></div>
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

</main>