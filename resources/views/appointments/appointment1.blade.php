@extends('layouts.navigation')
@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Schedule Appointment</h1>
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
          <h5 class="card-title">Make an appointment.</h5>

          <form class="row g-3" method="POST" action="{{ route('faculty.extension.schedule.appointment1.sent') }}" enctype="multipart/form-data">
            @csrf

            <div class="col-12">
              <label for="purpose" class="form-label">Purpose</label>
              <select id="purpose" name="purpose" class="form-select">
                <option selected>--- SELECT PURPOSE ---</option>
                <option value="Proposal Consultation">Consultaion Meeting for Proposal</option>
                <option value="Pre-Survey Consultation">Consultaion Meeting for Pre-Evaluation Survey</option>
                <option value="Mid-Survey Consultation">Consultaion Meeting for Mid-Evaluation Survey</option>
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
            
            <input name="userId" type="hidden" class="form-control" id="userId" value="{{$faculty->user_id}}">
        
            <div class="col-12" style="padding-top: 20px">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-outline-dark">Submit</button>
                    <button type="reset" class="btn btn-outline-dark ms-2">Reset</button>
                </div>
            </div>
          </form>

        </div>
      </div>
</main>
