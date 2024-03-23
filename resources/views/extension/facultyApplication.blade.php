@extends('layouts.navigation')
@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <h1>Extension Application</h1>
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

    <div class="col-12" style="padding-bottom: 20px;">
      <button type="button" class="btn btn-dark" onclick="toggleCreateApplicationForm()"><i class="bi bi-folder-plus"></i> Create Application</button>
    </div>

    <div id="createApplicationForm" class="col-md-12" style="display: none;">
      <div class="card">
          <div class="card-body">
              <h5 class="card-title">Create an Application</h5>
  
              <form class="row g-3" method="POST" action="{{ route('faculty.extension.application.created') }}" enctype="multipart/form-data">
                  @csrf

                  <div class="col-12">
                      <label for="title" class="form-label">Application Title</label>
                      <input type="text" class="form-control" id="title" name="title">
                  </div>
  
                  <div class="col-12" style="padding-top: 20px">
                      <div class="d-flex justify-content-end">
                          <button type="submit" class="btn btn-outline-dark">Create</button>
                          <button type="reset" class="btn btn-outline-dark ms-2" onclick="toggleFileUploadForm()">Close</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
    </div>

    <section class="section">
      <div class="row">
        @if(count($application) > 0)
          @foreach($application as $applications)
            @if($applications->status == 'New Application')
                <div class="card mb-3">
                  <div class="row g-0">
                    <div class="col-md-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$applications->title}}</h5>   
                            <span class="badge rounded-pill bg-primary">{{$applications->status}}</span>
                            <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                            </div>    
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div>
                          <button type="button" class="btn btn-outline-dark proposal0GetId" data-bs-toggle="modal" data-bs-target="#proposal0" data-id="{{$applications->id}}">
                            Submit Proposal
                          </button>
                        </div>
                    </div>
                  </div>
                </div>
            @elseif($applications->status == 'Pending Approval for Proposal Consultation Appointment')
                <div class="card mb-3">
                  <div class="row g-0">
                    <div class="col-md-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$applications->title}}</h5>   
                            <span class="badge rounded-pill bg-warning">{{$applications->status}}</span>
                            <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                            </div>   
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div>
                          <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="Please wait to approve your appointment">
                            Submit Proposal
                          </button>
                        </div>
                    </div>
                  </div>
                </div>
            @elseif($applications->status == 'Appointment Set for Proposal Consultation')
                <div class="card mb-3">
                  <div class="row g-0">
                    <div class="col-md-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$applications->title}}</h5>   
                            <span class="badge rounded-pill bg-primary">{{$applications->status}}</span>
                            <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                            </div>   
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div>
                          <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="Proposal consultation appointment is ongoing please wait to proceed to next step.">
                            Submit Proposal
                          </button>
                        </div>
                    </div>
                  </div>
                </div>
            @elseif($applications->status == 'Appointment Done for Proposal Consultation')
                <div class="card mb-3">
                  <div class="row">
                    <div class="col-md-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$applications->title}}</h5>   
                            <span class="badge rounded-pill bg-primary">{{$applications->status}}</span>
                            <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                            </div>   
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div>
                          <button type="button" class="btn btn-outline-dark proposal1GetId" data-bs-toggle="modal" data-bs-target="#proposal1" data-id="{{$applications->id}}">
                            Submit Proposal
                          </button> 
                        </div>
                    </div>
                  </div>
                </div>
            @elseif($applications->status == 'Proposal Consultation Appointment Cancelled')
                <div class="card mb-3">
                  <div class="row">
                    <div class="col-md-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$applications->title}}</h5>   
                            <span class="badge rounded-pill bg-danger">{{$applications->status}}</span>
                            <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                            </div>   
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div>
                          <button type="button" class="btn btn-outline-dark proposal0GetId" data-bs-toggle="modal" data-bs-target="#proposal0" data-id="{{$applications->id}}">
                            Submit Proposal
                          </button> 
                        </div>
                    </div>
                  </div>
                </div>
            @elseif($applications->status == 'Pending Approval of R&E Office') 
                <div class="card mb-3">
                  <div class="row g-0">
                    <div class="col-md-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$applications->title}}</h5>   
                            <span class="badge rounded-pill bg-warning">{{$applications->status}}</span>
                            <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div>
                          <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="This proposal is currently undergoing approval of R&E Office.">
                            Submit Proposal
                          </button>
                        </div>
                    </div>
                  </div>
                </div>
            @elseif($applications->status == 'Proposal Approved by R&E Office')
                <div class="card mb-3">
                  <div class="row">
                    <div class="col-md-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$applications->title}}</h5>   
                            <span class="badge rounded-pill bg-primary">{{$applications->status}}</span>
                            <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                            </div>   
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div>
                          <button type="button" class="btn btn-outline-dark proposal2GetId" data-bs-toggle="modal" data-bs-target="#proposal2" data-id="{{$applications->id}}">
                            Submit Proposal
                          </button> 
                        </div>
                    </div>
                  </div>
                </div>
            @elseif($applications->status == 'Proposal Rejected by R&E Office')
                <div class="card mb-3">
                  <div class="row">
                    <div class="col-md-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$applications->title}}</h5>   
                            <span class="badge rounded-pill bg-danger">{{$applications->status}}</span>
                            <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                            </div>   
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div>
                          <button type="button" class="btn btn-outline-dark proposal1GetId" data-bs-toggle="modal" data-bs-target="#proposal1" data-id="{{$applications->id}}">
                            Submit Proposal
                          </button> 
                        </div>
                    </div>
                  </div>
                </div>
            @elseif($applications->status == 'Pending Approval of DO')
              <div class="card mb-3">
                  <div class="row g-0">
                    <div class="col-md-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$applications->title}}</h5>   
                            <span class="badge rounded-pill bg-warning">{{$applications->status}}</span>
                            <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div>
                          <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="This application is pending of approval of DO, Please wait the result.">
                            Submit Proposal
                          </button>
                        </div>
                    </div>
                  </div>
              </div>
            @elseif($applications->status == 'Proposal Rejected By DO')
              <div class="card mb-3">
                <div class="row">
                  <div class="col-md-10 d-flex justify-content-center align-items-center">
                      <div class="card-body">
                          <h5 class="card-title">{{$applications->title}}</h5>   
                          <span class="badge rounded-pill bg-danger">{{$applications->status}}</span>
                          <div class="progress mt-3">
                            <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                          </div>   
                      </div>
                  </div>
                  <div class="col-md-2 d-flex justify-content-center align-items-center">
                      <div>
                        <button type="button" class="btn btn-outline-dark proposal2GetId" data-bs-toggle="modal" data-bs-target="#proposal2" data-id="{{$applications->id}}">
                          Submit Proposal
                        </button> 
                      </div>
                  </div>
                </div>
              </div>
            @elseif($applications->status == 'Pending Proposal Approval By UES')
              <div class="card mb-3">
                  <div class="row g-0">
                    <div class="col-md-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$applications->title}}</h5>   
                            <span class="badge rounded-pill bg-warning">{{$applications->status}}</span>
                            <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                            </div>   
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div>
                          <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="This application is pending of approval of UES, Please wait the result.">
                            Submit Proposal
                          </button>
                        </div>
                    </div>
                  </div>
              </div>
            @elseif($applications->status == 'Proposal Rejected By UES')
              <div class="card mb-3">
                <div class="row">
                  <div class="col-md-10 d-flex justify-content-center align-items-center">
                      <div class="card-body">
                          <h5 class="card-title">{{$applications->title}}</h5>   
                          <span class="badge rounded-pill bg-danger">{{$applications->status}}</span>
                          <div class="progress mt-3">
                            <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                          </div>   
                      </div>
                  </div>
                  <div class="col-md-2 d-flex justify-content-center align-items-center">
                      <div>
                        <button type="button" class="btn btn-outline-dark proposal2GetId" data-bs-toggle="modal" data-bs-target="#proposal2" data-id="{{$applications->id}}">
                          Submit Proposal
                        </button> 
                      </div>
                  </div>
                </div>
              </div>
            @elseif($applications->status == 'Pending Proposal Approval By President') 
              <div class="card mb-3">
                  <div class="row g-0">
                    <div class="col-md-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$applications->title}}</h5>   
                            <span class="badge rounded-pill bg-warning">{{$applications->status}}</span>
                            <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                            </div>   
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div>
                          <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="This application is pending of approval of President, Please wait the result.">
                            Submit Proposal
                          </button>
                        </div>
                    </div>
                  </div>
              </div>
            @elseif($applications->status == 'Proposal Approved By President')
              <div class="card mb-3">
                <div class="row">
                  <div class="col-md-10 d-flex justify-content-center align-items-center">
                      <div class="card-body">
                          <h5 class="card-title">{{$applications->title}}</h5>   
                          <span class="badge rounded-pill bg-primary">{{$applications->status}}</span>
                          <div class="progress mt-3">
                            <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                          </div>    
                      </div>
                  </div>
                  <div class="col-md-2 d-flex justify-content-center align-items-center">
                      <div>
                        <button type="button" class="btn btn-outline-dark proposal3GetId" data-bs-toggle="modal" data-bs-target="#proposal3" data-id="{{$applications->id}}">
                          Submit Proposal
                        </button> 
                      </div>
                  </div>
                </div>
              </div>
            @elseif($applications->status == 'Proposal Rejected By President')
              <div class="card mb-3">
                <div class="row">
                  <div class="col-md-10 d-flex justify-content-center align-items-center">
                      <div class="card-body">
                          <h5 class="card-title">{{$applications->title}}</h5>   
                          <span class="badge rounded-pill bg-danger">{{$applications->status}}</span>
                          <div class="progress mt-3">
                            <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                          </div>   
                      </div>
                  </div>
                  <div class="col-md-2 d-flex justify-content-center align-items-center">
                      <div>
                        <button type="button" class="btn btn-outline-dark proposal2GetId" data-bs-toggle="modal" data-bs-target="#proposal2" data-id="{{$applications->id}}">
                          Submit Proposal
                        </button> 
                      </div>
                  </div>
                </div>
              </div>
            @elseif($applications->status == 'Pending Approval of Board')
              <div class="card mb-3">
                  <div class="row g-0">
                    <div class="col-md-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$applications->title}}</h5>   
                            <span class="badge rounded-pill bg-warning">{{$applications->status}}</span>
                            <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                            </div>   
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div>
                          <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="This application is pending of approval of Board, Please wait the result.">
                            Submit Proposal
                          </button>
                        </div>
                    </div>
                  </div>
              </div>
            @elseif($applications->status == 'Proposal Rejected By Board')
              <div class="card mb-3">
                <div class="row">
                  <div class="col-md-10 d-flex justify-content-center align-items-center">
                      <div class="card-body">
                          <h5 class="card-title">{{$applications->title}}</h5>   
                          <span class="badge rounded-pill bg-danger">{{$applications->status}}</span>
                          <div class="progress mt-3">
                            <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                          </div>   
                      </div>
                  </div>
                  <div class="col-md-2 d-flex justify-content-center align-items-center">
                      <div>
                        <button type="button" class="btn btn-outline-dark proposal2GetId" data-bs-toggle="modal" data-bs-target="#proposal2" data-id="{{$applications->id}}">
                          Submit Proposal
                        </button> 
                      </div>
                  </div>
                </div>
              </div>
            @elseif($applications->status == 'Pending Proposal Approval By OSG')
              <div class="card mb-3">
                  <div class="row g-0">
                    <div class="col-md-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$applications->title}}</h5>   
                            <span class="badge rounded-pill bg-warning">{{$applications->status}}</span>
                            <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                            </div>    
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div>
                          <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="This application is pending of approval of OSG, Please wait the result.">
                            Submit Proposal
                          </button>
                        </div>
                    </div>
                  </div>
              </div>
            @elseif($applications->status == 'Proposal Rejected By OSG')
              <div class="card mb-3">
                <div class="row">
                  <div class="col-md-10 d-flex justify-content-center align-items-center">
                      <div class="card-body">
                          <h5 class="card-title">{{$applications->title}}</h5>   
                          <span class="badge rounded-pill bg-danger">{{$applications->status}}</span>
                          <div class="progress mt-3">
                            <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                          </div>   
                      </div>
                  </div>
                  <div class="col-md-2 d-flex justify-content-center align-items-center">
                      <div>
                        <button type="button" class="btn btn-outline-dark proposal2GetId" data-bs-toggle="modal" data-bs-target="#proposal2" data-id="{{$applications->id}}">
                          Submit Proposal
                        </button> 
                      </div>
                  </div>
                </div>
              </div>
            @elseif($applications->status == 'Proposal Approved By OSG')
              <div class="card mb-3">
                <div class="row">
                  <div class="col-md-10 d-flex justify-content-center align-items-center">
                      <div class="card-body">
                          <h5 class="card-title">{{$applications->title}}</h5>   
                          <span class="badge rounded-pill bg-primary">{{$applications->status}}</span>
                          <div class="progress mt-3">
                            <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                          </div>   
                      </div>
                  </div>
                  <div class="col-md-2 d-flex justify-content-center align-items-center">
                      <div>
                        <button type="button" class="btn btn-outline-dark proposal4GetId" data-bs-toggle="modal" data-bs-target="#proposal4" data-id="{{$applications->id}}">
                          Submit Proposal
                        </button> 
                      </div>
                  </div>
                </div>
              </div>
            @elseif($applications->status == 'Pending Implementation Approval by R&E-Office')
              <div class="card mb-3">
                  <div class="row g-0">
                    <div class="col-md-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$applications->title}}</h5>   
                            <span class="badge rounded-pill bg-warning">{{$applications->status}}</span> 
                            <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                            </div>   
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div>
                          <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="This application is pending of approval of R&E-Office, Please wait the result.">
                            Submit Proposal
                          </button>
                        </div>
                    </div>
                  </div>
              </div>
            @elseif($applications->status == 'Implementation Rejected By R&E-Office')
              <div class="card mb-3">
                <div class="row">
                  <div class="col-md-10 d-flex justify-content-center align-items-center">
                      <div class="card-body">
                          <h5 class="card-title">{{$applications->title}}</h5>   
                          <span class="badge rounded-pill bg-danger">{{$applications->status}}</span>
                          <div class="progress mt-3">
                            <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                          </div> 
                      </div>
                  </div>
                  <div class="col-md-2 d-flex justify-content-center align-items-center">
                      <div>
                        <button type="button" class="btn btn-outline-dark proposal4GetId" data-bs-toggle="modal" data-bs-target="#proposal4" data-id="{{$applications->id}}">
                          Submit Proposal
                        </button> 
                      </div>
                  </div>
                </div>
              </div>
            @elseif($applications->status == 'Implementation Approved By R&E-Office')
              <div class="card mb-3">
                <div class="row">
                  <div class="col-md-10 d-flex justify-content-center align-items-center">
                      <div class="card-body">
                          <h5 class="card-title">{{$applications->title}}</h5>   
                          <span class="badge rounded-pill bg-primary">{{$applications->status}}</span>
                          <div class="progress mt-3">
                            <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                          </div> 
                      </div>
                  </div>
                  <div class="col-md-2 d-flex justify-content-center align-items-center">
                      <div>
                        <button type="button" class="btn btn-outline-dark proposal5GetId" data-bs-toggle="modal" data-bs-target="#proposal5" data-id="{{$applications->id}}">
                          Submit Proposal
                        </button> 
                      </div>
                  </div>
                </div>
              </div>
            @elseif($applications->status == 'Topics and Sub Topics Inputted') 
              <div class="card mb-3">
                  <div class="row g-0">
                    <div class="col-md-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$applications->title}}</h5>   
                            <span class="badge rounded-pill bg-primary">{{$applications->status}}</span> 
                            <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                            </div>   
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div>
                          <button type="button" class="btn btn-outline-dark proposal0GetId" data-bs-toggle="modal" data-bs-target="#proposal0" data-id="{{$applications->id}}">
                            Submit Proposal
                          </button>
                        </div>
                    </div>
                  </div>
              </div>
            @elseif($applications->status == 'Pending Approval for Pre-Survey Consultation Appointment')
              <div class="card mb-3">
                  <div class="row g-0">
                    <div class="col-md-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$applications->title}}</h5>   
                            <span class="badge rounded-pill bg-warning">{{$applications->status}}</span>
                            <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                            </div>   
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div>
                          <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="Appointment for Pre-Survey Consultation is Pending; Please wait the approval to proceed in next step.">
                            Submit Proposal
                          </button>
                        </div>
                    </div>
                  </div>
              </div>
            @elseif($applications->status == 'Appointment Cancelled for Pre-Survey Consultation')
              <div class="card mb-3">
                  <div class="row g-0">
                    <div class="col-md-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$applications->title}}</h5>   
                            <span class="badge rounded-pill bg-warning">{{$applications->status}}</span>
                            <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                            </div>   
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div>
                          <button type="button" class="btn btn-outline-dark proposal0GetId" data-bs-toggle="modal" data-bs-target="#proposal0" data-id="{{$applications->id}}">
                            Submit Proposal
                          </button>
                        </div>
                    </div>
                  </div>
              </div>
            @elseif($applications->status == 'Appointment Set for Pre-Survey Consultation')
              <div class="card mb-3">
                  <div class="row g-0">
                    <div class="col-md-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$applications->title}}</h5>   
                            <span class="badge rounded-pill bg-primary">{{$applications->status}}</span>
                            <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                            </div>   
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div>
                          <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="Appointment for Pre-Seurvey Consultation is Ongoing; Please wait to be done to process the next step.">
                            Submit Proposal
                          </button>
                        </div>
                    </div>
                  </div>
              </div>
            @elseif($applications->status == 'Appointment Done for Pre-Survey Consultation')
              <div class="card mb-3">
                  <div class="row g-0">
                    <div class="col-md-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$applications->title}}</h5>   
                            <span class="badge rounded-pill bg-primary">{{$applications->status}}</span>    
                            <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div>
                          <button type="button" class="btn btn-outline-dark proposal0GetId" data-bs-toggle="modal" data-bs-target="#proposal0" data-id="{{$applications->id}}">
                            Submit Proposal
                          </button>
                        </div>
                    </div>
                  </div>
              </div>
            @elseif($applications->status == 'Pending Approval for Mid-Survey Consultation Appointment')
              <div class="card mb-3">
                  <div class="row g-0">
                    <div class="col-md-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$applications->title}}</h5>   
                            <span class="badge rounded-pill bg-warning">{{$applications->status}}</span>
                            <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                            </div>  
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div>
                          <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="Appointment for Mid-Survey Consultation is Pending; Please wait the approval to proceed in next step.">
                            Submit Proposal
                          </button>
                        </div>
                    </div>
                  </div>
              </div>
            @elseif($applications->status == 'Appointment Cancelled for Mid-Survey Consultation')
              <div class="card mb-3">
                  <div class="row g-0">
                    <div class="col-md-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$applications->title}}</h5>   
                            <span class="badge rounded-pill bg-danger">{{$applications->status}}</span>
                            <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                            </div>   
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div>
                          <button type="button" class="btn btn-outline-dark proposal0GetId" data-bs-toggle="modal" data-bs-target="#proposal0" data-id="{{$applications->id}}">
                            Submit Proposal
                          </button>
                        </div>
                    </div>
                  </div>
              </div>
            @elseif($applications->status == 'Appointment Set for Mid-Survey Consultation')
              <div class="card mb-3">
                  <div class="row g-0">
                    <div class="col-md-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$applications->title}}</h5>   
                            <span class="badge rounded-pill bg-primary">{{$applications->status}}</span>
                            <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                            </div>   
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div>
                          <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="Appointment for Mid-Survey Consultation is Ongoing; Please wait to be done to proceed to the next step.">
                            Submit Proposal
                          </button>
                        </div>
                    </div>
                  </div>
              </div>
            @elseif($applications->status == 'Appointment Done for Mid-Survey Consultation')
              <div class="card mb-3">
                <div class="row">
                  <div class="col-md-10 d-flex justify-content-center align-items-center">
                      <div class="card-body">
                          <h5 class="card-title">{{$applications->title}}</h5>   
                          <span class="badge rounded-pill bg-primary">{{$applications->status}}</span>
                          <div class="progress mt-3">
                            <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                          </div>  
                      </div>
                  </div>
                  <div class="col-md-2 d-flex justify-content-center align-items-center">
                      <div>
                        <button type="button" class="btn btn-outline-dark proposal6GetId" data-bs-toggle="modal" data-bs-target="#proposal6" data-id="{{$applications->id}}">
                          Submit Proposal
                        </button> 
                      </div>
                  </div>
                </div>
              </div>
            @elseif($applications->status == 'Inserted: Certificate, Documentation, Attendance, and Capsule Details')
              <div class="card mb-3">
                <div class="row">
                  <div class="col-md-10 d-flex justify-content-center align-items-center">
                      <div class="card-body">
                          <h5 class="card-title">{{$applications->title}}</h5>   
                          <span class="badge rounded-pill bg-primary">{{$applications->status}}</span> 
                          <div class="progress mt-3">
                            <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-2 d-flex justify-content-center align-items-center">
                      <div>
                        <button type="button" class="btn btn-outline-dark proposal7GetId" data-bs-toggle="modal" data-bs-target="#proposal7" data-id="{{$applications->id}}">
                          Submit Proposal
                        </button> 
                      </div>
                  </div>
                </div>
              </div>
            @elseif($applications->status == 'Have Prototype: Letter, NDA, COA Inserted')
              <div class="card mb-3">
                <div class="row">
                  <div class="col-md-10 d-flex justify-content-center align-items-center">
                      <div class="card-body">
                          <h5 class="card-title">{{$applications->title}}</h5>   
                          <span class="badge rounded-pill bg-primary">{{$applications->status}}</span> 
                          <div class="progress mt-3">
                            <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-2 d-flex justify-content-center align-items-center">
                      <div>
                        <button type="button" class="btn btn-outline-dark proposal8GetId" data-bs-toggle="modal" data-bs-target="#proposal8" data-id="{{$applications->id}}">
                          Submit Proposal
                        </button> 
                      </div>
                  </div>
                </div>
              </div>
            @elseif($applications->status == 'Prototype Pre-Evaluation Survey Not Done')
              <div class="card mb-3">
                <div class="row">
                  <div class="col-md-10 d-flex justify-content-center align-items-center">
                      <div class="card-body">
                          <h5 class="card-title">{{$applications->title}}</h5>   
                          <span class="badge rounded-pill bg-danger">{{$applications->status}}</span> 
                          <div class="progress mt-3">
                            <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-2 d-flex justify-content-center align-items-center">
                      <div>
                        <button type="button" class="btn btn-outline-dark proposal8GetId" data-bs-toggle="modal" data-bs-target="#proposal8" data-id="{{$applications->id}}">
                          Submit Proposal
                        </button> 
                      </div>
                  </div>
                </div>
              </div>
            @elseif($applications->status == 'Prototype Pre-Evaluation Survey Done')
              <div class="card mb-3">
                <div class="row">
                  <div class="col-md-10 d-flex justify-content-center align-items-center">
                      <div class="card-body">
                          <h5 class="card-title">{{$applications->title}}</h5>   
                          <span class="badge rounded-pill bg-primary">{{$applications->status}}</span> 
                          <div class="progress mt-3">
                            <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-2 d-flex justify-content-center align-items-center">
                      <div>
                        <button type="button" class="btn btn-outline-dark proposal9GetId" data-bs-toggle="modal" data-bs-target="#proposal9" data-id="{{$applications->id}}">
                          Submit Proposal
                        </button> 
                      </div>
                  </div>
                </div>
              </div>
            @elseif($applications->status == 'Prototype Mid-Evaluation Survey Done')
              <div class="card mb-3">
                <div class="row">
                  <div class="col-md-10 d-flex justify-content-center align-items-center">
                      <div class="card-body">
                          <h5 class="card-title">{{$applications->title}}</h5>   
                          <span class="badge rounded-pill bg-primary">{{$applications->status}}</span> 
                          <div class="progress mt-3">
                            <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-2 d-flex justify-content-center align-items-center">
                      <div>
                        <button type="button" class="btn btn-outline-dark proposal10GetId" data-bs-toggle="modal" data-bs-target="#proposal10" data-id="{{$applications->id}}">
                          Submit Proposal
                        </button> 
                      </div>
                  </div>
                </div>
              </div>
            @elseif($applications->status == 'Prototype Mid-Evaluation Survey Not Done')
              <div class="card mb-3">
                <div class="row">
                  <div class="col-md-10 d-flex justify-content-center align-items-center">
                      <div class="card-body">
                          <h5 class="card-title">{{$applications->title}}</h5>   
                          <span class="badge rounded-pill bg-primary">{{$applications->status}}</span> 
                          <div class="progress mt-3">
                            <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-2 d-flex justify-content-center align-items-center">
                      <div>
                        <button type="button" class="btn btn-outline-dark proposal9GetId" data-bs-toggle="modal" data-bs-target="#proposal9" data-id="{{$applications->id}}">
                          Submit Proposal
                        </button> 
                      </div>
                  </div>
                </div>
              </div>
            @elseif($applications->status == 'Prototype Post-Evaluation Survey Done')
              <div class="card mb-3">
                <div class="row">
                  <div class="col-md-10 d-flex justify-content-center align-items-center">
                      <div class="card-body">
                          <h5 class="card-title">{{$applications->title}}</h5>   
                          <span class="badge rounded-pill bg-primary">{{$applications->status}}</span> 
                          <div class="progress mt-3">
                            <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-2 d-flex justify-content-center align-items-center">
                      <div>
                        <button type="button" class="btn btn-outline-dark proposal11GetId" data-bs-toggle="modal" data-bs-target="#proposal11" data-id="{{$applications->id}}">
                          Submit Proposal
                        </button> 
                      </div>
                  </div>
                </div>
              </div>
            @elseif($applications->status == 'Prototype Post-Evaluation Survey Not Done')
              <div class="card mb-3">
                <div class="row">
                  <div class="col-md-10 d-flex justify-content-center align-items-center">
                      <div class="card-body">
                          <h5 class="card-title">{{$applications->title}}</h5>   
                          <span class="badge rounded-pill bg-danger">{{$applications->status}}</span> 
                          <div class="progress mt-3">
                            <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-2 d-flex justify-content-center align-items-center">
                      <div>
                        <button type="button" class="btn btn-outline-dark proposal10GetId" data-bs-toggle="modal" data-bs-target="#proposal10" data-id="{{$applications->id}}">
                          Submit Proposal
                        </button> 
                      </div>
                  </div>
                </div>
              </div>
            @elseif($applications->status == 'Process Done')
              <div class="card mb-3">
                <div class="row">
                  <div class="col-md-10 d-flex justify-content-center align-items-center">
                      <div class="card-body">
                          <h5 class="card-title">{{$applications->title}}</h5>   
                          <span class="badge rounded-pill bg-success">{{$applications->status}}</span> 
                          <div class="progress mt-3">
                            <div class="progress-bar progress-bar-striped bg-primary progress-bar-animated" role="progressbar" style="width: {{$applications->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$applications->percentage_status}}%</div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-2 d-flex justify-content-center align-items-center">
                      <div>
                        <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="This application is already completed.">
                          <i class="bi bi-arrow-right"></i>
                        </button> 
                      </div>
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
    </section>

    <div class="modal fade" id="proposal0" tabindex="-1"> 
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="p1Title">Make an Appointment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
  
            <form class="row g-3" method="POST" action="{{ route('faculty.extension.schedule.appointment1.sent') }}" enctype="multipart/form-data">
              @csrf

              <input name="extensionId" type="hidden" class="form-control" id="extensionId">
  
              <div class="col-12">
                <label for="purpose" class="form-label">Purpose</label>
                <select id="purpose" name="purpose" class="form-select">
                  <option selected>--- SELECT PURPOSE ---</option>
                  <option value="Proposal Consultation">Consultation Meeting for Proposal</option>
                  <option value="Pre-Survey Consultation">Consultation Meeting for Pre-Evaluation Survey</option>
                  <option value="Mid-Survey Consultation">Consultation Meeting for Mid-Evaluation Survey</option>
                  <option value=""></option>
                </select>
              </div>
  
              <div class="col-6">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date">
              </div>
  
              <div class="col-6">
                <label for="time" class="form-label">Time</label>
                <select id="time" name="time" class="form-select">
                  <option selected>--- SELECT TIME RANGE ---</option>
                  <option value="09:00 AM - 10:00 AM">09:00 AM - 10:00 AM</option>
                  <option value="10:00 AM - 11:00 AM">10:00 AM - 11:00 AM</option>
                  <option value="11:00 AM - 12:00 NN">11:00 AM - 12:00 NN</option>
                  <option value="01:00 PM - 02:00 PM">01:00 PM - 02:00 PM</option>
                  <option value="02:00 PM - 03:00 PM">02:00 PM - 03:00 PM</option>
                  <option value="03:00 PM - 04:00 PM">03:00 PM - 04:00 PM</option>
                  <option value=""></option>
                </select>
              </div>
          
              <div class="col-12" style="padding-top: 20px">
                  <div class="d-flex justify-content-end">
                      <button type="submit" class="btn btn-outline-dark">Submit</button>
                      <button type="reset" class="btn btn-outline-dark ms-2">Reset</button>
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
  
    <div class="modal fade" id="proposal1" tabindex="-1"> 
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="p2Title" >Submission of Proposal</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
  
            <form class="row g-3" method="POST" action="{{ route('faculty.extension.proposal1.sent') }}" enctype="multipart/form-data">
              @csrf
  
              <input type="hidden" class="form-control" id="proposalId" name="proposalId">
      
              <div class="col-12">
                <label for="beneficiary" class="form-label">Beneficiary:</label>
                <input type="text" class="form-control" id="beneficiary" name="beneficiary">
              </div>

              <div class="col-12">
                <label for="mou_file" class="form-label">Upload MOU File:</label>
                <input type="file" class="form-control" id="mou_file" name="mou_file">
              </div>

              <div class="col-" style="padding-top: 20px">
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-outline-dark">Submit Proposal</button>
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

    <div class="modal fade" id="proposal2" tabindex="-1"> 
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Submission of Documents</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
  
            <form class="row g-3" method="POST" action="{{ route('faculty.extension.proposal2.sent') }}" enctype="multipart/form-data">
              @csrf
  
              <input type="hidden" class="form-control" id="proposal2Id" name="proposal2Id">

              <div class="col-12">
                <label for="ppmp_file" class="form-label">Upload PPMP(Project Procurement Management Plan):</label>
                <input type="file" class="form-control" id="ppmp_file" name="ppmp_file">
              </div>

              <div class="col-12">
                <label for="pr_file" class="form-label">Upload PR(Purchase Request):</label>
                <input type="file" class="form-control" id="pr_file" name="pr_file">
              </div>

              <div class="col-12">
                <label for="market_study_file" class="form-label">Upload Request for Qoutation/Market Study:</label>
                <input type="file" class="form-control" id="market_study_file" name="market_study_file">
              </div>

              <div class="col-" style="padding-top: 20px">
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-outline-dark">Submit Proposal</button>
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

    <div class="modal fade" id="proposal3" tabindex="-1"> 
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Extension Application</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
  
            <form class="row g-3" method="POST" action="{{ route('faculty.extension.proposal3.sent') }}" enctype="multipart/form-data">
              @csrf
  
              <input type="hidden" class="form-control" id="proposal3Id" name="proposal3Id">

              <div class="col-12">
                <label for="moa_file" class="form-label">Upload MOA (Memorandum Of Agreement):</label>
                <input type="file" class="form-control" id="moa_file" name="moa_file">
              </div>

              <div class="col-" style="padding-top: 20px">
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-outline-dark">Submit Proposal</button>
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

    <div class="modal fade" id="proposal4" tabindex="-1"> 
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Extension Application</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
  
            <form class="row g-3" method="POST" action="{{ route('faculty.extension.proposal4.sent') }}" enctype="multipart/form-data">
              @csrf
  
              <input type="hidden" class="form-control" id="proposal4Id" name="proposal4Id">

              <div class="col-12">
                <label for="implementation_proper" class="form-label">Enter Implementation Proper:</label>
                <input type="text" class="form-control" id="implementation_proper" name="implementation_proper">
              </div>

              <div id="additionalProponents">
                <div class="col-12">
                  <label for="proponents1" class="form-label">Proponent 1</label>
                  <input type="text" name="proponents1" class="form-control" id="proponents1">
                </div>
              </div>
              <div class="d-grid gap-2 mt-3">
                <button type="button" class="btn btn-outline-dark" id="addProponents"><i class="bi bi-plus-lg"></i> Add Proponents</button>
              </div>

              <div class="col-" style="padding-top: 20px">
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-outline-dark">Submit Proposal</button>
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

    <div class="modal fade" id="proposal5" tabindex="-1"> 
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Extension Application</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
  
            <form class="row g-3" method="POST" action="{{ route('faculty.extension.proposal5.sent') }}" enctype="multipart/form-data">
              @csrf
  
              <input type="hidden" class="form-control" id="proposal5Id" name="proposal5Id">

              <div class="col-12">
                <label for="topics" class="form-label">Enter Topics:</label>
                <input type="text" class="form-control" id="topics" name="topics">
              </div>

              <div class="col-12">
                <label for="subtopics" class="form-label">Enter Sub Topics:</label>
                <input type="text" class="form-control" id="subtopics" name="subtopics">
              </div>

              <div class="col-" style="padding-top: 20px">
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-outline-dark">Submit Proposal</button>
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

    <div class="modal fade" id="proposal6" tabindex="-1"> 
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Extension Application</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
  
            <form class="row g-3" method="POST" action="{{ route('faculty.extension.proposal6.sent') }}" enctype="multipart/form-data">
              @csrf
  
              <input type="hidden" class="form-control" id="proposal6Id" name="proposal6Id">

              <div class="col-12">
                <label for="post_evaluation_attendance" class="form-label">Upload Attendance for Post-Evaluation Survey:</label>
                <input type="file" class="form-control" id="post_evaluation_attendance" name="post_evaluation_attendance">
              </div>

              <div class="col-12">
                <label for="evaluation_form" class="form-label">Evaluation Form:</label>
                <input type="file" class="form-control" id="evaluation_form" name="evaluation_form">
              </div>
              
              <div class="col-12">
                <label for="capsule_detail" class="form-label">Upload Capsule Detail/Narrative:</label>
                <input type="file" class="form-control" id="capsule_detail" name="capsule_detail">
              </div>

              <div class="col-12">
                <label for="certificate" class="form-label">Upload Certificate:</label>
                <input type="file" class="form-control" id="certificate" name="certificate">
              </div>

              <div class="col-12">
                <label for="attendance" class="form-label">Upload Attendance:</label>
                <input type="file" class="form-control" id="attendance" name="attendance">
              </div>

              <div class="col-md-12">
                <label for="content" class="form-label">Documentation Photos:</label>
                <input name="img_path[]" type="file" multiple id="img_path" class="form-control" id="documentation">
              </div>

              <div class="col-" style="padding-top: 20px">
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-outline-dark">Submit Proposal</button>
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

    <div class="modal fade" id="proposal7" tabindex="-1"> 
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Extension Application7</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
  
            <form class="row g-3" method="POST" action="{{ route('faculty.extension.proposal7.sent') }}" enctype="multipart/form-data">
              @csrf
  
              <input type="hidden" class="form-control" id="proposal7Id" name="proposal7Id">

              <div class="col-12 text-center">
                <label for="confirmation" class="form-label">Do you have a prototype?</label>
                <select id="confirmation" class="form-select" name="confirmation">
                  <option selected>Choose.........</option>
                  <option value="Yes">Yes</option>
                  <option value="None">None</option>
                </select>
              </div>

              <div id="fileContainer" style="display: none;">
                <div class="col-12">
                  <label for="letter" class="form-label">Upload Letter:</label>
                  <input type="file" class="form-control" id="letter" name="letter">
                </div>
                <div class="col-12">
                  <label for="nda" class="form-label">Upload NDA (Non Diclosure Agreement):</label>
                  <input type="file" class="form-control" id="nda" name="nda">
                </div>
                <div class="col-12">
                  <label for="coa" class="form-label">Upload COA (Certificate of Acceptance):</label>
                  <input type="file" class="form-control" id="coa" name="coa">
                </div>
              </div>

              <div class="col-" style="padding-top: 20px">
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-outline-dark">Submit Proposal</button>
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

    <div class="modal fade" id="proposal8" tabindex="-1"> 
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Extension Application8</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
  
            <form class="row g-3" method="POST" action="{{ route('faculty.extension.proposal8.sent') }}" enctype="multipart/form-data">
              @csrf
  
              <input type="hidden" class="form-control" id="proposal8Id" name="proposal8Id">
              <input type="hidden" class="form-control" id="prototype1Id" name="prototype1Id">

              <div class="col-12 text-center">
                <label for="pre_evaluation" class="form-label">Pre-Evaluation Survey</label>
                <select id="pre_evaluation" class="form-select" name="pre_evaluation">
                  <option selected>Choose.........</option>
                  <option value="Prototype Pre-Evaluation Survey Done">Done</option>
                  <option value="Prototype Pre-Evaluation Survey Not Done">Not Done</option>
                </select>
              </div>

              <div class="col-" style="padding-top: 20px">
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-outline-dark">Submit</button>
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

    <div class="modal fade" id="proposal9" tabindex="-1"> 
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Extension Application9</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
  
            <form class="row g-3" method="POST" action="{{ route('faculty.extension.proposal9.sent') }}" enctype="multipart/form-data">
              @csrf
  
              <input type="hidden" class="form-control" id="proposal9Id" name="proposal9Id">
              <input type="hidden" class="form-control" id="prototype2Id" name="prototype2Id">

              <div class="col-12 text-center">
                <label for="mid_evaluation" class="form-label">Mid-Evaluation Survey</label>
                <select id="mid_evaluation" class="form-select" name="mid_evaluation">
                  <option selected>Choose.........</option>
                  <option value="Prototype Mid-Evaluation Survey Done">Done</option>
                  <option value="Prototype Mid-Evaluation Survey Not Done">Not Done</option>
                </select>
              </div>

              <div class="col-" style="padding-top: 20px">
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-outline-dark">Submit</button>
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

    <div class="modal fade" id="proposal10" tabindex="-1"> 
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Extension Application10</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
  
            <form class="row g-3" method="POST" action="{{ route('faculty.extension.proposal10.sent') }}" enctype="multipart/form-data">
              @csrf
  
              <input type="hidden" class="form-control" id="proposal10Id" name="proposal10Id">
              <input type="hidden" class="form-control" id="prototype3Id" name="prototype3Id">

              <div class="col-12 text-center">
                <label for="post_evaluation" class="form-label">Post-Evaluation Survey</label>
                <select id="post_evaluation" class="form-select" name="post_evaluation">
                  <option selected>Choose.........</option>
                  <option value="Prototype Post-Evaluation Survey Done">Done</option>
                  <option value="Prototype Post-Evaluation Survey Not Done">Not Done</option>
                </select>
              </div>

              <div class="col-" style="padding-top: 20px">
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-outline-dark">Submit</button>
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

    <div class="modal fade" id="proposal11" tabindex="-1"> 
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Extension Application11</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
  
            <form class="row g-3" method="POST" action="{{ route('faculty.extension.proposal11.sent') }}" enctype="multipart/form-data">
              @csrf
  
              <input type="hidden" class="form-control" id="proposal11Id" name="proposal11Id">
              <input type="hidden" class="form-control" id="prototype4Id" name="prototype4Id">

              <div class="col-12">
                <label for="capsule_detail" class="form-label">Upload Capsule Detail/Narrative:</label>
                <input type="file" class="form-control" id="capsule_detail" name="capsule_detail">
              </div>

              <div class="col-12">
                <label for="certificate" class="form-label">Upload Certificate:</label>
                <input type="file" class="form-control" id="certificate" name="certificate">
              </div>

              <div class="col-12">
                <label for="attendance" class="form-label">Upload Attendance:</label>
                <input type="file" class="form-control" id="attendance" name="attendance">
              </div>

              <div class="col-md-12">
                <label for="content" class="form-label">Prototype Documentation Photos:</label>
                <input name="img_path[]" type="file" multiple id="img_path" class="form-control" id="documentation">
              </div>

              <div class="col-" style="padding-top: 20px">
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-outline-dark">Submit</button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
        let proponentsCount = 1;

        document.getElementById('addProponents').addEventListener('click', function () {
            proponentsCount++;

            const newProponentsFields = document.createElement('div');
            newProponentsFields.innerHTML = `
                <br>
                <div class="col-12">
                  <label for="proponents${proponentsCount}" class="form-label">Proponent ${proponentsCount}</label>
                  <input type="text" name="proponents${proponentsCount}" class="form-control" id="proponents${proponentsCount}">
                </div>
            `;
            document.getElementById('additionalProponents').appendChild(newProponentsFields);
        });

        //if modal is hidden or close it will refresh 
        $('#proposal4').on('hidden.bs.modal', function () {
            // Select all added proponents except the default one (proponents1) and remove them
            $('#additionalProponents').find('div.col-md-12:not(:first-child)').remove();
            
            // Reset proponentsCount to 1
            proponentsCount = 1;
        });
  });

  $(document).ready(function() {
    document.getElementById('confirmation').addEventListener('change', function () {
          var fileContainer = document.getElementById('fileContainer');

          if (this.value === 'Yes') {
            fileContainer.style.display = 'block';
          } else {
            fileContainer.style.display = 'none';
          }
      });

      $('#proposal7').on('hidden.bs.modal', function () {
              $('#confirmation').val('');
              $('#fileContainer').hide();
          });
  });

  function showCreateApplicationForm() {
        document.getElementById('createApplicationForm').style.display = 'block';
    }

    function toggleCreateApplicationForm() {
                var createApplicationForm = document.getElementById('createApplicationForm');
                if (createApplicationForm.style.display === 'none' || createApplicationForm.style.display === '') {
                  createApplicationForm.style.display = 'block';
                } else {
                  createApplicationForm.style.display = 'none';
                }
            }
</script>