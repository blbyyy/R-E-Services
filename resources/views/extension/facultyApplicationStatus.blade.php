@extends('layouts.navigation')
@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .table-container {
      overflow-y: auto;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
  </style>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Extension Application Status</h1>
    </div>

    <div class="card">
        <div class="card-body">

          <h5 class="card-title">List of your Extension Application</h5>

            <div class="accordion accordion-flush" id="accordionFlushExample">
                @foreach ($extension as $extensions)
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#extension{{$extensions->id}}" aria-expanded="false" aria-controls="flush-collapseOne">
                        <b>{{$extensions->title}}</b>
                    </button>
                  </h2>
                  <div id="extension{{$extensions->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="row"> 
                            <div class="col-12 text-center">
                                <h5 class="text-center" style="color: maroon"><b>Status</b></h5>
                                <p>({{$extensions->status}})</p>
                                <div class="progress mt-3">
                                    <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: {{$extensions->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$extensions->percentage_status}}%</div>
                                </div>
                            </div><br>
                            <div class="col-12 text-center">
                                <i class="bx bxs-calendar-check" style="font-size: 4em; color: maroon; padding-top: 20px"></i>
                                <h5 class="text-center" style="color: maroon"><b>Appointments</b></h5>
                                <div class="row">
                                    <div class="col-6 mb-2 text-center">
                                        @if ($extensions->appointment1_id === null)
                                            <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="No appointment has been made yet.">
                                                Proposal Consultation
                                            </button>
                                        @else
                                            <button style="width: 100%" data-id="{{$extensions->appointment1_id}}" type="button" class="btn btn-outline-dark appointment1" data-bs-toggle="modal" data-bs-target="#proposalAppointment">
                                                Proposal Consultation
                                            </button>
                                        @endif
                                    </div>
                                    <div class="col-6 mb-2 text-center">
                                        @if ($extensions->appointment2_id === null)
                                            <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="No appointment has been made yet.">
                                                Implementation Proper
                                            </button>
                                        @else
                                            <button style="width: 100%" data-id="{{$extensions->appointment2_id}}" type="button" class="btn btn-outline-dark appointment2" data-bs-toggle="modal" data-bs-target="#implementationProperAppointment">
                                                Implementation Proper
                                            </button>
                                        @endif
                                    </div>
                                    <div class="col-6 mb-2 text-center">
                                        @if ($extensions->appointment3_id === null)
                                            <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="No appointment has been made yet.">
                                                Pre-Evaluation Survey
                                            </button>
                                        @else
                                            <button style="width: 100%" data-id="{{$extensions->appointment3_id}}" type="button" class="btn btn-outline-dark appointment3" data-bs-toggle="modal" data-bs-target="#preEvaluationAppointment">
                                                Pre-Evaluation Survey
                                            </button>
                                        @endif
                                    </div>
                                    <div class="col-6 mb-2 text-center">
                                        @if ($extensions->appointment4_id === null)
                                            <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="No appointment has been made yet.">
                                                Mid-Evaluation Survey
                                            </button>
                                        @else
                                            <button style="width: 100%" data-id="{{$extensions->appointment4_id}}" type="button" class="btn btn-outline-dark appointment4" data-bs-toggle="modal" data-bs-target="#midEvaluationAppointment">
                                                Mid-Evaluation Survey
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 text-center">
                                <i class="bx bxs-file" style="font-size: 4em; color: maroon; padding-top: 20px"></i>
                                <h5 class="text-center" style="color: maroon"><b>Files/Details</b></h5>
                                <div class="row">
                                    <div class="col-12 mb-2 text-center">
                                        <button style="width: 100%" data-id="{{$extensions->id}}" type="button" class="btn btn-outline-dark extensionFiles" data-bs-toggle="modal" data-bs-target="#extensionFiles">
                                            Extension
                                        </button>
                                    </div>
                                    <div class="col-12 mb-2 text-center">
                                        @if ($extensions->prototype_id === null)
                                            <button style="width: 100%" type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="No prototype has been made yet.">
                                                Prototype 
                                            </button>
                                        @else
                                            <button style="width: 100%" data-id="{{$extensions->prototype_id}}" type="button" class="btn btn-outline-dark prototypeFiles" data-bs-toggle="modal" data-bs-target="#prototypeFiles">
                                                Prototype
                                            </button> 
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 text-center">
                                <i class="bx bxs-file-image" style="font-size: 4em; color: maroon; padding-top: 20px"></i>
                                <h5 class="text-center" style="color: maroon"><b>Documentation Photos</b></h5>
                                <div class="row">
                                    <div class="col-12 mb-2 text-center">
                                        <button style="width: 100%" data-id="{{$extensions->id}}" type="button" class="btn btn-outline-dark doumentationPhotos" data-bs-toggle="modal" data-bs-target="#doumentationPhotos">
                                            Extension
                                        </button>
                                    </div>
                                    <div class="col-12 mb-2 text-center">
                                        <button style="width: 100%" data-id="{{$extensions->prototype_id}}" type="button" class="btn btn-outline-dark prototypePhotos" data-bs-toggle="modal" data-bs-target="#prototypePhotos">
                                            Prototype
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                  </div>
                </div>
                @endforeach
            </div>

          <div class="modal fade" id="proposalAppointment" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Proposal Consultation Appointment</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Appointment Purpose:</b></h5>
                                <span id="purpose1"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Appointment Status:</b></h5>
                                <span id="status1"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <i class="bi bi-clock" style="font-size: 5em; color: maroon;"></i>
                            <h5 class="card-title">Time:</h5>
                            <span class="card-text" id="time1"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <i class="bi bi-calendar-week" style="font-size: 5em; color: maroon;"></i>
                            <h5 class="card-title">Date:</h5>
                            <p class="card-text" id="date1"></p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="implementationProperAppointment" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Implementation Proper Appointment</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Appointment Purpose:</b></h5>
                                <span id="purpose2"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Appointment Status:</b></h5>
                                <span id="status2"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <i class="bi bi-clock" style="font-size: 5em; color: maroon;"></i>
                            <h5 class="card-title">Time:</h5>
                            <span class="card-text" id="time2"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <i class="bi bi-calendar-week" style="font-size: 5em; color: maroon;"></i>
                            <h5 class="card-title">Date:</h5>
                            <p class="card-text" id="date2"></p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="preEvaluationAppointment" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Pre-Evaluation Consultation Appointment</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Appointment Purpose:</b></h5>
                                <span id="purpose3"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Appointment Status:</b></h5>
                                <span id="status3"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <i class="bi bi-clock" style="font-size: 5em; color: maroon;"></i>
                            <h5 class="card-title">Time:</h5>
                            <span class="card-text" id="time3"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <i class="bi bi-calendar-week" style="font-size: 5em; color: maroon;"></i>
                            <h5 class="card-title">Date:</h5>
                            <p class="card-text" id="date3"></p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          
          <div class="modal fade" id="midEvaluationAppointment" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Mid-Evaluation Consultation Appointment</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Appointment Purpose:</b></h5>
                                <span id="purpose4"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Appointment Status:</b></h5>
                                <span id="status4"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <i class="bi bi-clock" style="font-size: 5em; color: maroon;"></i>
                            <h5 class="card-title">Time:</h5>
                            <span class="card-text" id="time4"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <i class="bi bi-calendar-week" style="font-size: 5em; color: maroon;"></i>
                            <h5 class="card-title">Date:</h5>
                            <p class="card-text" id="date4"></p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div> 

          <div class="modal fade" id="extensionFiles" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Extension Files & Other Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Beneficiary:</b></h5>
                                <span id="beneficiary"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">MOU(Memorandum of Understanding):</b></h5>
                                <span id="mouFile"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">PPMP(Project Procurement Management Plan):</b></h5>
                                <span id="ppmpmFile"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">PR(Purchase Request):</b></h5>
                                <span id="prFile"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Market Study:</b></h5>
                                <span id="marketStudyFile"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">MOA(Memorandum of Agreement):</b></h5>
                                <span id="moaFile"></span>
                            </div>
                        </div> 

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Topics:</b></h5>
                                <span id="topics"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Sub Topics:</b></h5>
                                <span id="subtopics"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Attendance for Post Evaluation Survey:</b></h5>
                                <span id="attendancePostEvaluationSurvey"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Evaluation Form:</b></h5>
                                <span id="evaluationForm"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Capsule Detail:</b></h5>
                                <span id="capsuleDetail"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Certificate:</b></h5>
                                <span id="certificate"></span>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Attendance:</b></h5>
                                <span id="attendance"></span>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div> 

          <div class="modal fade" id="doumentationPhotos" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Documentation Photos</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                        </div>
                    
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                    <div class="col-md-12" id="noDocumentationPhotos">
                        <div class="card-body text-center" style="padding: 40px">
                            <i class="bi bi-file-image" style="font-size: 8em; color: maroon;"></i>
                            <h5 style="padding: 20px"><b style="color: maroon">Nothing has been uploaded here.</b></h5>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="prototypeFiles" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Prototype Files & Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">NDA(Non Disclosure Agreement):</b></h5>
                                <span id="ndaFile"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">COA(Certificate of Acceptance):</b></h5>
                                <span id="coaFile"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Pre-Evaluation Survey:</b></h5>
                                <span id="preEvaluationSurvey"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Mid-Evaluation Survey:</b></h5>
                                <span id="midEvaluationSurvey"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Post-Evaluation Survey:</b></h5>
                                <span id="postEvaluationSurvey"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Capsule Detail/Narative:</b></h5>
                                <span id="prototypeCapsuleDetail"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Certificate:</b></h5>
                                <span id="prototypeCertificate"></span>
                            </div>
                        </div> 

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Attendance:</b></h5>
                                <span id="prototypeAttendance"></span>
                            </div>
                        </div> 
                    </div>
                    
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="prototypePhotos" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Prototype Documentation Photos</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div id="carouselPrototypePhotos" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" id="prototype">
                        </div>
                    
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselPrototypePhotos" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselPrototypePhotos" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                    <div class="col-md-12" id="noPrototypeDocumentationPhotos">
                        <div class="card-body text-center" style="padding: 40px">
                            <i class="bi bi-file-image" style="font-size: 8em; color: maroon;"></i>
                            <h5 style="padding: 20px"><b style="color: maroon">Nothing has been uploaded here.</b></h5>
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
      </div>
</main>