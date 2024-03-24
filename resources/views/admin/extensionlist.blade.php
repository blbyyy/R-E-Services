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

          <h5 class="card-title">List of All Extension Application</h5>
            <div class="table-container">
                <table class="table table-hover">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">Requestor</th>
                        <th scope="col">Application Title</th>
                        <th scope="col">Appointment 1</th>
                        <th scope="col">Appointment 2</th>
                        <th scope="col">Appointment 3</th>
                        <th scope="col">Files/Other Details</th>
                        <th scope="col">Documentation Photos</th>
                        <th scope="col">Prototype Files/Details</th>
                        <th scope="col">Prototype Docu Photos</th>
                        <th scope="col">Application Status</th>
                        <th scope="col">Percentage Status</th>
                    </tr>
                    </thead>
                    @foreach ($extension as $extensions)
                        <tbody>
                            <tr class="text-center">
                                <td><i>{{$extensions->fname .' '. $extensions->mname .' '. $extensions->lname}}</i></td>
                                <td><i>{{$extensions->title}}</i></td>
                                <td>
                                    @if ($extensions->appointment1_id === null)
                                        <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="No appointment has been made yet.">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    @else
                                        <button style="width: 50px" data-id="{{$extensions->appointment1_id}}" type="button" class="btn btn-primary appointment1" data-bs-toggle="modal" data-bs-target="#proposalAppointment">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if ($extensions->appointment2_id === null)
                                        <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="No appointment has been made yet.">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    @else
                                        <button style="width: 50px" data-id="{{$extensions->appointment2_id}}" type="button" class="btn btn-primary appointment2" data-bs-toggle="modal" data-bs-target="#preEvaluationAppointment">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if ($extensions->appointment3_id === null)
                                        <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="No appointment has been made yet.">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    @else
                                        <button style="width: 50px" data-id="{{$extensions->appointment3_id}}" type="button" class="btn btn-primary appointment3" data-bs-toggle="modal" data-bs-target="#midEvaluationAppointment">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    @endif    
                                </td>
                                <td>
                                    <button style="width: 50px" data-id="{{$extensions->id}}" type="button" class="btn btn-primary extensionFiles" data-bs-toggle="modal" data-bs-target="#extensionFiles">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </td>
                                <td>
                                    <button style="width: 50px" data-id="{{$extensions->id}}" type="button" class="btn btn-primary doumentationPhotos" data-bs-toggle="modal" data-bs-target="#doumentationPhotos">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </td>
                                <td>
                                    @if ($extensions->prototype_id === null)
                                        <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="No prototype has been made yet.">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    @else
                                        <button style="width: 50px" data-id="{{$extensions->prototype_id}}" type="button" class="btn btn-primary prototypeFiles" data-bs-toggle="modal" data-bs-target="#prototypeFiles">
                                            <i class="bi bi-eye"></i>
                                        </button> 
                                    @endif
                                </td>
                                <td>
                                    @if ($extensions->prototype_id === null)
                                        <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="No prototype documentation photos has been uploaded or there no prototype in this application">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    @else
                                        <button style="width: 50px" data-id="{{$extensions->prototype_id}}" type="button" class="btn btn-primary prototypePhotos" data-bs-toggle="modal" data-bs-target="#prototypePhotos">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    @endif
                                </td>
                                <td><b>{{$extensions->status}}</b></td>
                                <td>
                                    <div class="progress mt-3">
                                        <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: {{$extensions->percentage_status}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$extensions->percentage_status}}%</div>
                                    </div>  
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
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

                        <div class="col-md-6" id="prpnts1">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Proponent1:</b></h5>
                                <span id="proponent1"></span>
                            </div>
                        </div>

                        <div class="col-md-6" id="prpnts2">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Proponent2:</b></h5>
                                <span id="proponent2"></span>
                            </div>
                        </div>

                        <div class="col-md-6" id="prpnts3">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Proponent3:</b></h5>
                                <span id="proponent3"></span>
                            </div>
                        </div>

                        <div class="col-md-6" id="prpnts4">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Proponent4:</b></h5>
                                <span id="proponent4"></span>
                            </div>
                        </div>

                        <div class="col-md-6" id="prpnts5">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Proponent5:</b></h5>
                                <span id="proponent5"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Implementation Proper:</b></h5>
                                <span id="implementationProper"></span>
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
</main>