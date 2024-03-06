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
                            <button data-id="{{ $research['id'] }}" type="button" class="btn btn-info researchViewInfoBtn" data-bs-toggle="modal" data-bs-target="#researchShowInfo"><i class="bi bi-eye"></i></button>
                            <button data-id="{{ $research['id'] }}" type="button" class="btn btn-secondary requestAccessBtn" data-bs-toggle="modal" data-bs-target="#requestAccess">Request</button>
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

            <div class="modal fade" id="researchShowInfo" tabindex="-1">
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
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
            </div>

            <div class="modal fade" id="requestAccess" tabindex="-1"> 
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Request Access</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
          
                      <form class="row g-3" method="POST" action="{{ route('student.sending.request.access') }}">
                        @csrf
            
                      <input type="hidden" class="form-control" id="titleResearch" name="titleResearch">

                      <b><p id="researchTitle" class="large fst-italic"></p></b>
                
                      <div class="col-md-12">
                        <div class="form-floating">
                          <textarea class="form-control" id="purpose" name="purpose" style="height: 150px;"></textarea>
                          <label for="purpose">Purpose</label>
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
