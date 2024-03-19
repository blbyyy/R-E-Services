@extends('layouts.navigation')
@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Appointments</h1>
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
          <h5 class="card-title">List of People Making Appointment Requests</h5>
          <table class="table table-hover">
            <thead>
                <tr class="text-center">
                    <th scope="col">Actions</th>
                    <th scope="col">Requestor</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Purpose</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr class="text-center">
                        <td>
                          @if ($appointment->purpose === 'Proposal Consultation')
                            @if ($appointment->status === 'Appointment Done') 
                              <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This appointment is already done"><i class="bi bi-arrow-right"></i></button>
                            @elseif ($appointment->status === 'Appointment Rejected')
                              <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This appointment has been rejected."><i class="bi bi-arrow-right"></i></button>
                            @else
                              <button data-id="{{$appointment->id}}" type="button" class="btn btn-primary processAppointmentProposal" data-bs-toggle="modal" data-bs-target="#processingAppointmentProposal"><i class="bi bi-arrow-right"></i></button>
                            @endif
                          @elseif ($appointment->purpose === 'Pre-Survey Consultation')
                            @if ($appointment->status === 'Appointment Done') 
                              <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This appointment is already done"><i class="bi bi-arrow-right"></i></button>
                            @elseif ($appointment->status === 'Appointment Rejected')
                              <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This appointment has been rejected."><i class="bi bi-arrow-right"></i></button>
                            @else
                              <button data-id="{{$appointment->id}}" type="button" class="btn btn-primary processAppointmentPreSurvey" data-bs-toggle="modal" data-bs-target="#processingAppointmentPreSurvey"><i class="bi bi-arrow-right"></i></button>
                            @endif
                          @elseif ($appointment->purpose === 'Mid-Survey Consultation')
                            @if ($appointment->status === 'Appointment Done') 
                              <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This appointment is ongoing"><i class="bi bi-arrow-right"></i></button>
                            @elseif ($appointment->status === 'Appointment Rejected')
                              <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This appointment has been rejected."><i class="bi bi-arrow-right"></i></button>
                            @else
                              <button data-id="{{$appointment->id}}" type="button" class="btn btn-primary processAppointmentMidSurvey" data-bs-toggle="modal" data-bs-target="#processingAppointmentMidSurvey"><i class="bi bi-arrow-right"></i></button>
                            @endif
                          @endif
                        </td>
                        <td>
                            {{$appointment->requestor_name}}
                            <span style="font-size: small">({{$appointment->role}})</span>
                        </td>
                        <td>{{$appointment->date}}</td>
                        <td>{{$appointment->time}}</td>
                        <td>{{$appointment->purpose}}</td>
                        <td>
                          @if ($appointment->status === 'Appointment Set') 
                            <span class="badge bg-primary">{{$appointment->status}}</span>
                          @elseif ($appointment->status === 'Appointment Done')
                            <span class="badge bg-success">{{$appointment->status}}</span>
                          @elseif ($appointment->status === 'Appointment Rejected')
                            <span class="badge bg-danger">{{$appointment->status}}</span>
                          @elseif ($appointment->status === 'Appointment Pending')
                            <span class="badge bg-warning">{{$appointment->status}}</span>
                          @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>

        <div class="modal fade" id="processingAppointmentProposal" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Appointments</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                 
                    <div class="text-center" style="padding-bottom: 30px; padding-top: 30px;">
                        <h5><b style="color: maroon">Requestor:</b> <span id="requestor1"></span></h5>
                        <h5><b style="color: maroon">Date:</b> <span id="date1"></span></h5>
                        <h5><b style="color: maroon">Time Range:</b> <span id="time1"></span></h5>
                        <h5><b style="color: maroon">Purpose:</b> <span id="purpose1"></span></h5>
                        <h5><b style="color: maroon">Status:</b> <span id="status1"></span></h5>
                    </div>

                    <form class="row g-3" method="POST" action="{{ route('appointment.proposal.sent') }}" enctype="multipart/form-data">
                            @csrf

                        <input name="appointmentId1" type="hidden" class="form-control" id="appointmentId1">
                        <input name="extensionId1" type="hidden" class="form-control" id="extensionId1">

                        <div class="col-md-12">
                            <div class="form-floating">
                                <select name="status" class="form-select" id="status" aria-label="State">
                                    <option selected>Choose....</option>
                                    <option value="Appointment Set">Approve</option>
                                    <option value="Appointment Done">Done</option>
                                    <option value="Appointment Cancelled">Reject</option>
                                </select>
                                <label for="status">Status</label>
                            </div>
                        </div>

                        <div class="col-12" id="messageContainer" style="display: none;">
                            <div class="form-floating">
                            <textarea class="form-control" id="message" name="message" style="height: 100px;"></textarea>
                            <label for="message">Message</label>
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

        <div class="modal fade" id="processingAppointmentPreSurvey" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Appointments2</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
               
                  <div class="text-center" style="padding-bottom: 30px; padding-top: 30px;">
                      <h5><b style="color: maroon">Requestor:</b> <span id="requestor2"></span></h5>
                      <h5><b style="color: maroon">Date:</b> <span id="date2"></span></h5>
                      <h5><b style="color: maroon">Time Range:</b> <span id="time2"></span></h5>
                      <h5><b style="color: maroon">Purpose:</b> <span id="purpose2"></span></h5>
                      <h5><b style="color: maroon">Status:</b> <span id="status2"></span></h5>
                  </div>

                  <form class="row g-3" method="POST" action="{{ route('appointment.pre-survey.sent') }}" enctype="multipart/form-data">
                          @csrf

                      <input name="appointmentId2" type="hidden" class="form-control" id="appointmentId2">
                      <input name="extensionId2" type="hidden" class="form-control" id="extensionId2">

                      <div class="col-md-12">
                          <div class="form-floating">
                              <select name="status" class="form-select" id="status" aria-label="State">
                                  <option selected>Choose....</option>
                                  <option value="Appointment Set">Approve</option>
                                  <option value="Appointment Done">Done</option>
                                  <option value="Appointment Cancelled">Reject</option>
                              </select>
                              <label for="status">Status</label>
                          </div>
                      </div>

                      <div class="col-12" id="messageContainer" style="display: none;">
                          <div class="form-floating">
                          <textarea class="form-control" id="message" name="message" style="height: 100px;"></textarea>
                          <label for="message">Message</label>
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

        <div class="modal fade" id="processingAppointmentMidSurvey" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Appointments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
               
                  <div class="text-center" style="padding-bottom: 30px; padding-top: 30px;">
                      <h5><b style="color: maroon">Requestor:</b> <span id="requestor3"></span></h5>
                      <h5><b style="color: maroon">Date:</b> <span id="date3"></span></h5>
                      <h5><b style="color: maroon">Time Range:</b> <span id="time3"></span></h5>
                      <h5><b style="color: maroon">Purpose:</b> <span id="purpose3"></span></h5>
                      <h5><b style="color: maroon">Status:</b> <span id="status3"></span></h5>
                  </div>

                  <form class="row g-3" method="POST" action="{{ route('appointment.mid-survey.sent') }}" enctype="multipart/form-data">
                          @csrf

                      <input name="appointmentId3" type="hidden" class="form-control" id="appointmentId3">
                      <input name="extensionId3" type="hidden" class="form-control" id="extensionId3">

                      <div class="col-md-12">
                          <div class="form-floating">
                              <select name="status" class="form-select" id="status" aria-label="State">
                                  <option selected>Choose....</option>
                                  <option value="Appointment Set">Approve</option>
                                  <option value="Appointment Done">Done</option>
                                  <option value="Appointment Cancelled">Reject</option>
                              </select>
                              <label for="status">Status</label>
                          </div>
                      </div>

                      <div class="col-12" id="messageContainer" style="display: none;">
                          <div class="form-floating">
                          <textarea class="form-control" id="message" name="message" style="height: 100px;"></textarea>
                          <label for="message">Message</label>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    document.getElementById('status').addEventListener('change', function () {
          var messageContainer = document.getElementById('messageContainer');

          if (this.value === 'Rejected') {
            messageContainer.style.display = 'block';
          } else {
            messageContainer.style.display = 'none';
          }
      });

      $('#processingAppointment').on('hidden.bs.modal', function () {
              $('#messageContainer').hide();
          });
  });
</script>