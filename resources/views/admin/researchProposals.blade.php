@extends('layouts.navigation')
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">List of Research Proposals</h5>

        <form class="row g-3" method="POST" action="{{ route('admin.reserch-proposal.specific-department') }}">
          @csrf
          <div class="row">
              <label for="researchType" class="form-label"><b>Filter By Research Type:</b></label>
              <div class="col-md-9" style="padding-bottom: 0px">
                  <select name="researchType" id="researchType" class="form-select" required>
                      <option selected>--- SELECT RESEARCH TYPE ---</option>
                      <option value="All">All</option>
                      <option value="Research Program">Research Program</option>
                      <option value="Research Study">Research Study</option>
                      <option value="Independent Study">Independent Study</option>
                  </select>
              </div>
              <div class="col-md-3">
                  <button type="submit" class="btn btn-outline-dark">Change</button>
                  <a href="{{url('/admin/reserch-proposal/list')}}" class="btn btn-outline-dark">Refresh</a>
              </div>
          </div>
        </form>

        @if($researchProposal->isEmpty())
          <table class="table table-hover">
              <thead>
                  <tr class="text-center">
                    <th scope="col">Actions</th>
                    <th scope="col">ResearchTitle</th>
                    <th scope="col">Research Proposal Type</th>
                    <th scope="col">Research Proposal File</th>
                    <th scope="col">Status</th>
                  </tr>
              </thead>
          </table>
          <div class="alert alert-danger d-flex justify-content-center" role="alert">
              <div class="text-center">
                  <span class="badge border-danger border-1 text-danger" style="font-size: large; display: flex; align-items: center;">
                      <i class="bi bi-file-earmark-x" style="font-size: 50px; margin-right: 10px;"></i>
                      No Research Proposals Populated
                  </span>
              </div>
          </div>
        @else
          <table class="table table-hover">
            <thead>
                <tr class="text-center">
                    <th scope="col">Actions</th>
                    <th scope="col">ResearchTitle</th>
                    <th scope="col">Research Proposal Type</th>
                    <th scope="col">Research Proposal File</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($researchProposal as $researchProposals)
                <tr class="text-center">
                  <td style="width: 110px">
                      <button data-id="{{$researchProposals->id}}" type="button" class="btn btn-info showResearchInfoBtn" data-bs-toggle="modal" data-bs-target="#showResearchInfo"><i class="bi bi-eye"></i></button>
                      <button data-id="{{$researchProposals->id}}" type="button" class="btn btn-danger deleteResearchBtn"><i class="bi bi-trash"></i></button>
                  </td>
                  <td>{{$researchProposals->title}}</td>
                  <td>{{$researchProposals->research_type}}</td>
                  <td>
                    <a href="{{ asset('uploads/researchProposal/' . $researchProposals->proposal_file) }}" target="_blank">
                        View File
                    </a>
                  </td>
                  <td>{{$researchProposals->status}}</td>
                </tr>                
              @endforeach
            </tbody>
          </table>
        @endif

        <div class="modal fade" id="showResearchInfo" tabindex="-1">
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

        </div>
      </div>
</main>