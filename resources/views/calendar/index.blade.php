@extends('layouts.navigation')
<style>
    .cal{
        color: #ffffff;
        font-style: italic;
    }
    .fc-day-number {
        color: #ffffff; 
        font-style: italic;
    }
</style>
@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<main id="main" class="main">

    @if(session('success'))
      <script>
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: '{{ session('success') }}',
          });
      </script>
    @endif

    <div class="col-12">
        <button type="button" class="btn btn-dark" onclick="toggleCreateEventForm()"><i class="bi bi-calendar-plus"></i> Create Event</button>
    </div>
    <hr>

<div id="createeventForm" class="col-md-12" style="display: none;">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Create Event</h5>

            <form class="row g-3" method="POST" action="{{ route('create_event') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-12">
                    <label for="title" class="form-label">Event Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>

                <div class="col-6">
                    <label for="start" class="form-label">Event Start</label>
                    <input type="datetime-local" class="form-control" id="start" name="start">
                </div>
                <div class="col-6">
                    <label for="end" class="form-label">Event End</label>
                    <input type="datetime-local" class="form-control" id="end" name="end">
                </div>

                <div class="col-12" style="padding-top: 20px">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-outline-dark">Create Event</button>
                        <button type="reset" class="btn btn-outline-dark ms-2" onclick="toggleCreateEventForm()">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <hr>
</div>

<div class="container">
      <div class="response"></div>
      <div class="cal" id='calendar'></div>  
</div>

</main>
<script>
    function showCreateEventForm() {
        document.getElementById('createeventForm').style.display = 'block';
    }

    function toggleCreateEventForm() {
                var createeventForm = document.getElementById('createeventForm');
                if (createeventForm.style.display === 'none' || createeventForm.style.display === '') {
                    createeventForm.style.display = 'block';
                } else {
                    createeventForm.style.display = 'none';
                }
            }
</script>


