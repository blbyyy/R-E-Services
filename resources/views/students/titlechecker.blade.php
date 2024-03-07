@extends('layouts.navigation')
@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Title Checker</h1>
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

    <form class="row g-3" action="{{ route('student.titleChecker') }}" method="GET">
        <div class="col-9">
            <input type="text" class="form-control" name="query">
        </div>
        <div class="col-1">
            <button type="submit" class="btn btn-dark" style="height: 40px; width: 70px;"><i class="bi bi-search"></i></button>
        </div>
        <div class="col-2">
            <a href="{{url('/student/title-checker')}}">
                <button type="button" class="btn btn-dark"><i class="bi bi-arrow-clockwise"></i> Refresh</button>
            </a>
        </div>
    </form>

    <div class="card">
        <div class="card-body">

            <h5 class="card-title">List of Researches</h5>

            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Actions</th>
                        <th scope="col">Research Title</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($researchlist as $research)
                    <tr class="text-center">
                        <td style="width: 150px">
                            <button data-id="{{ $research['id'] }}" type="button" class="btn btn-info studentRequestAccessBtn" data-bs-toggle="modal" data-bs-target="#studentRequestAccess"><i class="bi bi-eye"></i></button>
                          </td>
                        <td>{{ $research['research_title'] }}</td>
                    </tr>                    
                    @endforeach
                </tbody>
            </table>

            <div class="row justify-content-end">
                <div class="col-auto">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <!-- Previous Page Link -->
                            @if ($researchlist->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a href="{{ $researchlist->previousPageUrl() }}" class="page-link" rel="prev">Previous</a>
                                </li>
                            @endif
                    
                            <!-- Pagination Elements -->
                            @foreach ($researchlist as $page => $url)
                                @if ($page == $researchlist->currentPage())
                                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                                @endif
                            @endforeach
                    
                            <!-- Next Page Link -->
                            @if ($researchlist->hasMorePages())
                                <li class="page-item">
                                    <a href="{{ $researchlist->nextPageUrl() }}" class="page-link" rel="next">Next</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="modal fade" id="studentRequestAccess" tabindex="-1"> 
              <div class="modal-dialog modal-lg">
                <div class="modal-content">

                  <div class="modal-header">
                    <h5 class="modal-title">Research Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <div class="modal-body">
                    <div id="spinner" class="spinner-border text-primary" role="status"></div>

                    <section class="section profile" id="ResearchInfo">
                      <div class="row">
                        <div class="col-xl-4">
                        </div>
                
                        <div class="col-xl-12">
                
                          <div class="card">
                            <div class="card-body pt-3">
                              <div class="tab-content pt-2">
                
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                  <h5 class="card-title">Research Title</h5>
                                  <p id="researchtitle" class="large fst-italic"></p>
        
                                  <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Abstract</div>
                                    <div id="researchabstract" class="col-lg-9 col-md-8"></div>
                                  </div>
    
                                  <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Department</div>
                                    <div id="researchdepartment" class="col-lg-9 col-md-8"></div>
                                  </div>
    
                                  <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Course</div>
                                    <div id="researchcourse" class="col-lg-9 col-md-8"></div>
                                  </div>
                                  
                                  <h5 class="card-title">Research Details</h5>
                
                                  <div class="row" id="a1">
                                    <div class="col-lg-3 col-md-4 label ">Faculty Adviser 1</div>
                                    <div id="facultyadviser1" class="col-lg-9 col-md-8"></div>
                                  </div>
    
                                  <div class="row" id="a2">
                                    <div class="col-lg-3 col-md-4 label ">Faculty Adviser 2</div>
                                    <div id="facultyadviser2" class="col-lg-9 col-md-8"></div>
                                  </div>
    
                                  <div class="row" id="a3">
                                    <div class="col-lg-3 col-md-4 label ">Faculty Adviser 3</div>
                                    <div id="facultyadviser3" class="col-lg-9 col-md-8"></div>
                                  </div>
    
                                  <div class="row" id="a4">
                                    <div class="col-lg-3 col-md-4 label ">Faculty Adviser 4</div>
                                    <div id="facultyadviser4" class="col-lg-9 col-md-8"></div>
                                  </div>
    
                                  <div class="row" id="r1">
                                    <div class="col-lg-3 col-md-4 label ">Researcher 1</div>
                                    <div id="researchers1" class="col-lg-9 col-md-8"></div>
                                  </div>
                
                                  <div class="row" id="r2">
                                    <div class="col-lg-3 col-md-4 label">Researcher 2</div>
                                    <div id="researchers2" class="col-lg-9 col-md-8"></div>
                                  </div>
                
                                  <div class="row" id="r3">
                                    <div class="col-lg-3 col-md-4 label">Researcher 3</div>
                                    <div id="researchers3" class="col-lg-9 col-md-8"></div>
                                  </div>
                                  
                                  <div class="row" id="r4">
                                    <div class="col-lg-3 col-md-4 label ">Researcher 4</div>
                                    <div id="researchers4" class="col-lg-9 col-md-8"></div>
                                  </div>
                
                                  <div class="row" id="r5">
                                    <div class="col-lg-3 col-md-4 label">Researcher 5</div>
                                    <div id="researchers5" class="col-lg-9 col-md-8"></div>
                                  </div>
    
                                  <div class="row" id="r6">
                                    <div class="col-lg-3 col-md-4 label">Researcher 6</div>
                                    <div id="researchers6" class="col-lg-9 col-md-8"></div>
                                  </div>
                
                                  <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Time Frame</div>
                                    <div id="timeframe" class="col-lg-9 col-md-8"></div>
                                  </div>
                
                                  <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Date Completion</div>
                                    <div id="datecompletion" class="col-lg-9 col-md-8"></div>
                                  </div>
                
                                </div>
                              </div>
                            </div>
                          </div>
                
                        </div>
                      </div>
                    </section>

                    <div class="text-center" id="accessDeneid">
                      <div class="col-md-12" >      
                        <i class="bi bi-lock-fill" style="color: maroon; font-size: 8em; padding-top: 300px;"></i>
                      </div>
              
                      <div class="col-md-12" style="padding-top: 20px">
                        <h5>To gain access to the information, you need to send a permission request.</h5>
                      </div>
                      <br>
                      <button type="button" class="btn btn-dark" onclick="toggleRequestAccessForm()"><i class="bi bi-key"></i> Request Access</button>
                    </div>

                    <div class="text-center" id="processingRequest">
                      <div class="col-md-12" >      
                        <i class="bi bi-hourglass-split" style="color: maroon; font-size: 8em; padding-top: 300px;"></i>
                      </div>
              
                      <div class="col-md-12" style="padding-top: 20px">
                        <h5>Request processing, Please wait.</h5>
                      </div>
                    </div>

                    <div class="text-center" id="rejectRequest">
                      <div class="col-md-12" >      
                        <i class="bi bi-shield-x" style="color: maroon; font-size: 8em; padding-top: 300px;"></i>
                      </div>
              
                      <div class="col-md-12" style="padding-top: 20px">
                        <h5>The access you have requested has been denied.</h5>
                      </div>
                      <br>
                      <button type="button" class="btn btn-dark" onclick="toggleRequestAccessForm()"><i class="bi bi-key"></i> Reapply for Permission</button>
                    </div>
          
                    <form id="requestAccessForm" class="row g-3" method="POST" action="{{ route('student.sending.request.access') }}" style="display: none;">
                        @csrf
            
                      <input type="hidden" class="form-control" id="researchId" name="researchId">

                      <div class="row mb-3">
                        <label for="purpose" class="col-sm-12 col-form-label">Access request purpose?</label>
                        <div class="col-sm-12">
                          <textarea class="form-control" id="purpose" name="purpose" style="height: 100px"></textarea>
                        </div>
                      </div>
              
                      <div class="col-" style="padding-top: 20px">
                        <div class="d-flex justify-content-end">
                          <button type="submit" class="btn btn-outline-dark">Send Request</button>
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

        </div>
    </div>
</main>
<script>
  function showRequestAccessForm() {
        document.getElementById('requestAccessForm').style.display = 'block';
    }

  function toggleRequestAccessForm() {
              var requestAccessForm = document.getElementById('requestAccessForm');
              if (requestAccessForm.style.display === 'none' || requestAccessForm.style.display === '') {
                requestAccessForm.style.display = 'block';
              } else {
                requestAccessForm.style.display = 'none';
              }
          }

          // Assume you have a function to load data
  function loadData() {
    // Start the spinner when data loading begins
    document.getElementById("spinner").style.display = "block";

    // Simulating data loading with setTimeout
    setTimeout(function() {
      // Data loading is done, stop the spinner
      document.getElementById("spinner").style.display = "none";
      // Show your data content or perform other actions here
    }, 2000); // Change 2000 to the time it takes to load your data
  }

  // Call the function to load data when needed
  loadData();
</script>
