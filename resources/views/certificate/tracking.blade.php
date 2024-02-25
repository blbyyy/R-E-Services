@extends('layouts.navigation')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Certificate Tracking</h1>
    </div>

    <div class="col-12">
        <button type="button" class="btn btn-dark" onclick="toggleFindForm()"><i class="bi bi-sliders"></i> Advance Filter</button>
        <a href="{{url('certificate/tracking')}}">
            <button type="button" class="btn btn-dark"><i class="bi bi-arrow-clockwise"></i> Refresh</button>
        </a>
        </div>
    <br>

    <div id="FindForm" class="col-md-12" style="display: none;">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Track Specific Certificate</h5>
    
                <form class="row g-3" method="POST" action="{{ route('certificateFetchData') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                        <label for="controlId" class="form-label">Enter the unique control number in this field.</label>
                        <input type="text" class="form-control" id="controlId" name="controlId">
                    </div>
    
                    <div class="col-12" style="padding-top: 20px">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-outline-dark">Search</button>
                            <button type="reset" class="btn btn-outline-dark ms-2" onclick="toggleFileUploadForm()">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
          <h5 class="card-title">List of Certificates</h5>
            @if($certificates->isEmpty())
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Actions</th>
                            <th scope="col">Control Number</th>
                            <th scope="col">Requestor Name</th>
                            <th scope="col">Research Title</th>
                            <th scope="col">Processing End Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        </tr>
                    </tbody>
                </table>
                <div class="alert alert-danger" role="alert">
                    <div class="text-center">
                        <span class="badge border-danger border-1 text-danger" style="font-size: large">Certificate Not Found</span>
                    </div>
                </div>
            @else
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Actions</th>
                            <th scope="col">QrCode</th>
                            <th scope="col">Control Number</th>
                            <th scope="col">Requestor Name</th>
                            <th scope="col">Research Title</th>
                            <th scope="col">Processing End Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($certificates as $certificate)
                        <tr>
                            <td>
                                <button data-id="{{$certificate->certid}}" type="button" class="btn btn-primary showCertificate" data-bs-toggle="modal" data-bs-target="#certificateInfo"><i class="bi bi-eye"></i></button>
                            </td>
                            <td>{!! QrCode::size(50)->generate($certificate->control_id) !!}</td>
                            <td>{{$certificate->control_id}}</td>
                            <td>{{$certificate->requestor_name}}</td>
                            <td>{{$certificate->research_title}}</td>
                            <td>{{$certificate->date_processing_end}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif


          <div class="modal fade" id="certificateInfo" tabindex="-1">
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

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Certificate</div>
                                    <div id="certificate" class="col-lg-9 col-md-8"></div>
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
<script>
    function showFindForm() {
        document.getElementById('FindForm').style.display = 'block';
    }

    function toggleFindForm() {
                var findForm = document.getElementById('FindForm');
                if (findForm.style.display === 'none' || findForm.style.display === '') {
                    findForm.style.display = 'block';
                } else {
                    findForm.style.display = 'none';
                }
            }
</script>