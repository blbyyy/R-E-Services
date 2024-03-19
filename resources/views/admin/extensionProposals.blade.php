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
        <h1>Extension Proposals</h1>
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

    <div class="card">
        <div class="card-body">
          <h5 class="card-title">List of Extension Proposal</h5>
          <table class="table table-hover">
            <thead>
                <tr class="text-center">
                    <th scope="col">Application Title</th>
                    <th scope="col">Requestor</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proposals as $proposal)
                    <tr class="text-center">
                        <td>{{$proposal->title}}</td>
                        <td>
                            {{$proposal->requestor_name}}
                            <span style="font-size: small">({{$proposal->role}})</span>
                        </td>
                        <td>
                          @if ($proposal->status == 'Process Done')
                          <span class="badge rounded-pill bg-success">{{$proposal->status}}</span>
                          @else
                          <span class="badge rounded-pill bg-primary">{{$proposal->status}}</span> 
                          @endif
                        </td>
                        <td>
                          @if ($proposal->status === 'Pending Approval for Proposal Consultation Appointment') 
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This application is waiting for approval of proposal consultation appointment."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Appointment Set for Proposal Consultation')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This application is ongoing to proposal consultation please wait to be done."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Appointment Done for Proposal Consultation')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This application was done to proposal consultation."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Proposal Consultation Appointment Cancelled')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="Proposal consultation was cancelled; let the requestor make another schedule to proceed."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Pending Approval of R&E Office')
                            <button data-id="{{$proposal->id}}" type="button" class="btn btn-primary processProposal1" data-bs-toggle="modal" data-bs-target="#processingProposal1"><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Proposal Approved by R&E Office')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This application already approved."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Pending Approval of DO')
                            <button data-id="{{$proposal->id}}" type="button" class="btn btn-primary processProposal2" data-bs-toggle="modal" data-bs-target="#processingProposal2"><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Pending Proposal Approval By UES')
                            <button data-id="{{$proposal->id}}" type="button" class="btn btn-primary processProposal3" data-bs-toggle="modal" data-bs-target="#processingProposal3"><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Pending Proposal Approval By President')
                            <button data-id="{{$proposal->id}}" type="button" class="btn btn-primary processProposal4" data-bs-toggle="modal" data-bs-target="#processingProposal4"><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Proposal Approved By President')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This application already approved by president."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Pending Approval of Board')
                            <button data-id="{{$proposal->id}}" type="button" class="btn btn-primary processProposal5" data-bs-toggle="modal" data-bs-target="#processingProposal5"><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Pending Proposal Approval By OSG')
                            <button data-id="{{$proposal->id}}" type="button" class="btn btn-primary processProposal6" data-bs-toggle="modal" data-bs-target="#processingProposal6"><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Proposal Approved By OSG')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This application already approved by OSG."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Implementation Approved By R&E-Office')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This application already approved by R&E Office."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Topics and Sub Topics Inputted')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This application need to make an appointment for consultation about pre-evaluation survey."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Pending Implementation Approval by R&E-Office') 
                            <button data-id="{{$proposal->id}}" type="button" class="btn btn-primary processProposal7" data-bs-toggle="modal" data-bs-target="#processingProposal7"><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Pending Approval for Pre-Survey Consultation Appointment')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This application waiting for approval of admin for pre-survey consultation appointment."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Appointment Cancelled for Pre-Survey Consultation')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This application was cancelled the appointment abnout pre-survey consultation."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Appointment Set for Pre-Survey Consultation')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This application is ongoing to consultation about Pre-Survey "><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Appointment Done for Pre-Survey Consultation')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This application need to make an appointment for consultation about mid-evaluation survey."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Pending Approval for Mid-Survey Consultation Appointment')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This application waiting for approval of admin for mid-survey consultation appointment."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Appointment Set for Mid-Survey Consultation')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This application is ongoing; please wait to done to proceed next step."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Appointment Done for Mid-Survey Consultation')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This application is done to mid-evaluation survey."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Appointment Cancelled for Mid-Survey Consultation')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This application was cancelled the appointment abnout mid-survey consultation."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Inserted: Certificate, Documentation, Attendance, and Capsule Details')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This application is almost done wait to the owner response if they have ptototype."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Have Prototype: Letter, NDA, COA Inserted')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="The prototype pre-evaluation survey is the next step in this application."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Prototype Pre-Evaluation Survey Done')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="The prototype mid-evaluation survey is the next step in this application."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Prototype Pre-Evaluation Survey Not Done')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="prototype pre-evaluation survey not done."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Prototype Mid-Evaluation Survey Done')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="The prototype post-evaluation survey is the next step in this application."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Prototype Mid-Evaluation Survey Not Done')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="prototype mid-evaluation survey not done."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Prototype Post-Evaluation Survey Done')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="Uploading Capsule Detail/Narative, Certificate, Documentation Photos and Attendancce is the next step in this application."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Prototype Post-Evaluation Survey Not Done')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="prototype post-evaluation survey not done."><i class="bi bi-arrow-right"></i></button>
                          @elseif ($proposal->status === 'Process Done')
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This application is completed."><i class="bi bi-arrow-right"></i></button>
                          
                          @elseif ($proposal->status === 'Proposal Rejected') 
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This application has been rejected."><i class="bi bi-arrow-right"></i></button>
                         
                          @endif
                          </td> 
                    </tr> 
                @endforeach
            </tbody>
          </table>

        <div class="modal fade" id="processingProposal1" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Extension Proposal</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                 
                    <div class="text-center" style="padding-bottom: 30px; padding-top: 30px;">
                        <h5><b style="color: maroon">Requestor:</b> <span id="requestor"></span></h5>
                        <h5><b style="color: maroon">Beneficiary:</b> <span id="beneficiary"></span></h5>
                        <h5><b style="color: maroon">MOU File:</b> <P id="mou_file"></p></h5>
                    </div>

                    <form class="row g-3" method="POST" action="{{ route('admin.proposal.list.specific.sent1') }}" enctype="multipart/form-data">
                            @csrf

                        <input name="proposalId1" type="hidden" class="form-control" id="proposalId1">

                        <div class="col-md-12">
                            <div class="form-floating">
                                <select name="status" class="form-select" id="status" aria-label="State">
                                    <option selected>Choose....</option>
                                    <option value="Proposal Approved by R&E Office">Approve</option>
                                    <option value="Proposal Rejected by R&E Office">Reject</option>
                                </select>
                                <label for="status">Status</label>
                            </div>
                        </div>

                        <div class="col-12" style="padding-top: 20px">
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

        </div>

        <div class="modal fade" id="processingProposal2" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Extension Proposal2</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
               
                  <div class="text-center" style="padding-bottom: 30px; padding-top: 30px;">
                      <h5><b style="color: maroon">Requestor:</b> <span id="proposal2Requestor"></span></h5>
                      <h5><b style="color: maroon">Application Unique ID:</b> <span id="proposal2UniqueId"></span></h5>
                      <h5><b style="color: maroon">Status:</b> <P id="proposal2Status"></p></h5>
                  </div>

                  <form class="row g-3" method="POST" action="{{ route('admin.proposal.list.specific.sent2') }}" enctype="multipart/form-data">
                          @csrf

                      <input name="proposalId2" type="hidden" class="form-control" id="proposalId2">

                      <div class="col-md-12">
                          <div class="form-floating">
                              <select name="status" class="form-select" id="status" aria-label="State">
                                  <option selected>Choose....</option>
                                  <option value="Pending Proposal Approval By UES">Approve</option>
                                  <option value="Proposal Rejected By DO">Reject</option>
                              </select>
                              <label for="status">Status</label>
                          </div>
                      </div>

                      <div class="col-12" style="padding-top: 20px">
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

        <div class="modal fade" id="processingProposal3" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Extension Proposal3</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
               
                  <div class="text-center" style="padding-bottom: 30px; padding-top: 30px;">
                      <h5><b style="color: maroon">Requestor:</b> <span id="proposal3Requestor"></span></h5>
                      <h5><b style="color: maroon">Application Unique ID:</b> <span id="proposal3UniqueId"></span></h5>
                      <h5><b style="color: maroon">Status:</b> <P id="proposal3Status"></p></h5>
                  </div>

                  <form class="row g-3" method="POST" action="{{ route('admin.proposal.list.specific.sent3') }}" enctype="multipart/form-data">
                      @csrf

                      <input name="proposalId3" type="hidden" class="form-control" id="proposalId3">

                      <div class="col-md-12">
                          <div class="form-floating">
                              <select name="status" class="form-select" id="status" aria-label="State">
                                  <option selected>Choose....</option>
                                  <option value="Pending Proposal Approval By President">Approve</option>
                                  <option value="Proposal Rejected By President">Reject</option>
                              </select>
                              <label for="status">Status</label>
                          </div>
                      </div>

                      <div class="col-12" style="padding-top: 20px">
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

        <div class="modal fade" id="processingProposal4" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Extension Proposal4</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
               
                  <div class="text-center" style="padding-bottom: 30px; padding-top: 30px;">
                      <h5><b style="color: maroon">Requestor:</b> <span id="proposal4Requestor"></span></h5>
                      <h5><b style="color: maroon">Application Unique ID:</b> <span id="proposal4UniqueId"></span></h5>
                      <h5><b style="color: maroon">Status:</b> <P id="proposal4Status"></p></h5>
                  </div>

                  <form class="row g-3" method="POST" action="{{ route('admin.proposal.list.specific.sent4') }}" enctype="multipart/form-data">
                      @csrf

                      <input name="proposalId4" type="hidden" class="form-control" id="proposalId4">

                      <div class="col-md-12">
                          <div class="form-floating">
                              <select name="status" class="form-select" id="status" aria-label="State">
                                  <option selected>Choose....</option>
                                  <option value="Proposal Approved By President">Approve</option>
                                  <option value="Proposal Rejected By President">Reject</option>
                              </select>
                              <label for="status">Status</label>
                          </div>
                      </div>

                      <div class="col-12" style="padding-top: 20px">
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

        <div class="modal fade" id="processingProposal5" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Extension Proposal5</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
               
                  <div class="text-center" style="padding-bottom: 30px; padding-top: 30px;">
                      <h5><b style="color: maroon">Requestor:</b> <span id="proposal5Requestor"></span></h5>
                      <h5><b style="color: maroon">Application Unique ID:</b> <span id="proposal5UniqueId"></span></h5>
                      <h5><b style="color: maroon">Status:</b> <P id="proposal5Status"></p></h5>
                  </div>

                  <form class="row g-3" method="POST" action="{{ route('admin.proposal.list.specific.sent5') }}" enctype="multipart/form-data">
                      @csrf

                      <input name="proposalId5" type="hidden" class="form-control" id="proposalId5">

                      <div class="col-md-12">
                          <div class="form-floating">
                              <select name="status" class="form-select" id="status" aria-label="State">
                                  <option selected>Choose....</option>
                                  <option value="Pending Proposal Approval By OSG">Approve</option>
                                  <option value="Proposal Rejected By Board">Reject</option>
                              </select>
                              <label for="status">Status</label>
                          </div>
                      </div>

                      <div class="col-12" style="padding-top: 20px">
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

        <div class="modal fade" id="processingProposal6" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Extension Proposal6</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
               
                  <div class="text-center" style="padding-bottom: 30px; padding-top: 30px;">
                      <h5><b style="color: maroon">Requestor:</b> <span id="proposal6Requestor"></span></h5>
                      <h5><b style="color: maroon">Application Unique ID:</b> <span id="proposal6UniqueId"></span></h5>
                      <h5><b style="color: maroon">Status:</b> <P id="proposal6Status"></p></h5>
                  </div>

                  <form class="row g-3" method="POST" action="{{ route('admin.proposal.list.specific.sent6') }}" enctype="multipart/form-data">
                      @csrf

                      <input name="proposalId6" type="hidden" class="form-control" id="proposalId6">

                      <div class="col-md-12">
                          <div class="form-floating">
                              <select name="status" class="form-select" id="status" aria-label="State">
                                  <option selected>Choose....</option>
                                  <option value="Proposal Approved By OSG">Approve</option>
                                  <option value="Proposal Rejected By OSG">Reject</option>
                              </select>
                              <label for="status">Status</label>
                          </div>
                      </div>

                      <div class="col-12" style="padding-top: 20px">
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

        <div class="modal fade" id="processingProposal7" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Extension Proposal7</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
               
                  <div class="text-center" style="padding-bottom: 30px; padding-top: 30px;">
                      <h5><b style="color: maroon">Requestor:</b> <span id="proposal7Requestor"></span></h5>
                      <h5><b style="color: maroon">Application Unique ID:</b> <span id="proposal7UniqueId"></span></h5>
                      <h5><b style="color: maroon">Status:</b> <P id="proposal7Status"></p></h5>
                  </div>

                  <form class="row g-3" method="POST" action="{{ route('admin.proposal.list.specific.sent7') }}" enctype="multipart/form-data">
                      @csrf

                      <input name="proposalId7" type="hidden" class="form-control" id="proposalId7">

                      <div class="col-md-12">
                          <div class="form-floating">
                              <select name="status" class="form-select" id="status" aria-label="State">
                                  <option selected>Choose....</option>
                                  <option value="Implementation Approved By R&E-Office">Approve</option>
                                  <option value="Implementation Rejected By R&E-Office">Reject</option>
                              </select>
                              <label for="status">Status</label>
                          </div>
                      </div>

                      <div class="col-12" style="padding-top: 20px">
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

        <div class="modal fade" id="processingProposal8" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Extension Proposal8</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
               
                  <div class="text-center" style="padding-bottom: 30px; padding-top: 30px;">
                      <h5><b style="color: maroon">Requestor:</b> <span id="proposal8Requestor"></span></h5>
                      <h5><b style="color: maroon">Application Unique ID:</b> <span id="proposal8UniqueId"></span></h5>
                      <h5><b style="color: maroon">Status:</b> <P id="proposal8Status"></p></h5>
                  </div>

                  <form class="row g-3" method="POST" action="{{ route('admin.proposal.list.specific.sent7') }}" enctype="multipart/form-data">
                      @csrf

                      <input name="proposalId7" type="hidden" class="form-control" id="proposalId7">

                      <div class="col-md-12">
                          <div class="form-floating">
                              <select name="status" class="form-select" id="status" aria-label="State">
                                  <option selected>Choose....</option>
                                  <option value="Proposal Approved By R&E-Office">Approve</option>
                                  <option value="Proposal Rejected By R&E-Office">Reject</option>
                              </select>
                              <label for="status">Status</label>
                          </div>
                      </div>

                      <div class="col-12" style="padding-top: 20px">
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

      </div>
        
      
    </div>

</main>