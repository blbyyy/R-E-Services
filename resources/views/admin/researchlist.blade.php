@extends('layouts.navigation')
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">List of Researches</h5>

        <form class="row g-3" method="POST" action="{{ route('admin.researchlist.specific-department') }}">
          @csrf
          <div class="row">
              <label for="researchDepartment" class="form-label"><b>Filter By Department:</b></label>
              <div class="col-md-9" style="padding-bottom: 0px">
                  <select name="researchDepartment" id="researchDepartment" class="form-select" required>
                      <option selected>--- SELECT DEPARTMENT ---</option>
                      <option value="All">All</option>
                      <option value="EAAD">Electrical and Allied Department</option>
                      <option value="MAAD">Mechanical and Allied Department</option>
                      <option value="CAAD">Civil and Allied Department</option>
                      <option value="BASD">Basic Arts Science Department</option>
                  </select>
              </div>
              <div class="col-md-3">
                  <button type="submit" class="btn btn-outline-dark">Change</button>
                  <a href="{{url('/admin/researchlist')}}" class="btn btn-outline-dark">Refresh</a>
              </div>
          </div>
        </form>

        

        @if($researches->isEmpty())
          <table class="table table-hover">
              <thead>
                  <tr>
                    <th scope="col">Actions</th>
                    <th scope="col">Research Title</th>
                    <th scope="col">Department</th>
                    <th scope="col">Course</th>
                    <th scope="col">Date of Completion</th>
                  </tr>
              </thead>
          </table>
          <div class="alert alert-danger d-flex justify-content-center" role="alert">
              <div class="text-center">
                  <span class="badge border-danger border-1 text-danger" style="font-size: large; display: flex; align-items: center;">
                      <i class="bi bi-file-earmark-x" style="font-size: 50px; margin-right: 10px;"></i>
                      No Research Populated
                  </span>
              </div>
          </div>
        @else
          <table class="table table-hover">
            <thead>
              <tr>
                    <th scope="col">Actions</th>
                    <th scope="col">Research Title</th>
                    <th scope="col">Department</th>
                    <th scope="col">Course</th>
                    <th scope="col">Date of Completion</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($researches as $research)
                <tr>
                  <td style="width: 110px">
                      <button data-id="{{$research->id}}" type="button" class="btn btn-info showResearchInfoBtn" data-bs-toggle="modal" data-bs-target="#showResearchInfo"><i class="bi bi-eye"></i></button>
                      <button data-id="{{$research->id}}" type="button" class="btn btn-danger deleteResearchBtn"><i class="bi bi-trash"></i></button>
                  </td>
                  <td>{{$research->research_title}}</td>
                  <td>{{$research->department}}</td>
                  <td>{{$research->course}}</td>
                  <td>{{$research->date_completion}}</td>
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