@extends('layouts.navigation')
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">List of Applications</h5>

        <form class="row g-3" method="POST" action="{{ route('admin.applicationlist.specific-status') }}">
          @csrf
          <div class="row">
              <label for="applicationStatus" class="form-label"><b>Filter By Applications Status:</b></label>
              <div class="col-md-9" style="padding-bottom: 0px">
                  <select name="applicationStatus" id="applicationStatus" class="form-select" required>
                      <option selected>--- SELECT STATUS ---</option>
                      <option value="All">All</option>
                      <option value="Passed">Passed</option>
                      <option value="Pending">Pending</option>
                      <option value="Returned">Returned</option>
                  </select>
              </div>
              <div class="col-md-3">
                  <button type="submit" class="btn btn-outline-dark">Change</button>
                  <a href="{{url('/admin/applicationlist')}}" class="btn btn-outline-dark">Refresh</a>
              </div>
          </div>
        </form>

        @if($applications->isEmpty())
          <table class="table table-hover">
              <thead>
                  <tr>
                    <th scope="col">Actions</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                  </tr>
              </thead>
          </table>
          <div class="alert alert-danger d-flex justify-content-center" role="alert">
              <div class="text-center">
                  <span class="badge border-danger border-1 text-danger" style="font-size: large; display: flex; align-items: center;">
                      <i class="bi bi-file-earmark-x" style="font-size: 50px; margin-right: 10px;"></i>
                      No Applications Populated
                  </span>
              </div>
          </div>
        @else
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Actions</th>
                <th scope="col">Application Title</th>
                <th scope="col">Thesis Type</th>
                <th scope="col">Submission Frequency</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($applications as $application)
                <tr>
                  <td>
                      <button data-id="{{$application->id}}" type="button" class="btn btn-info studentshowBtn" data-bs-toggle="modal" data-bs-target="#showstudentinfo"><i class="bi bi-eye"></i></button>
                      <button data-id="{{$application->id}}" type="button" class="btn btn-primary studenteditBtn" data-bs-toggle="modal" data-bs-target="#editstudentinfo"><i class="bi bi-pencil-square"></i></button>
                      <button data-id="{{$application->id}}" type="button" class="btn btn-danger studentdeleteBtn"><i class="bi bi-trash"></i></button>
                  </td>
                  <td>{{$application->research_title}}</td>
                  <td>{{$application->thesis_type}}</td>
                  <td>{{$application->submission_frequency}}</td>
                  <td>{{$application->status}}</td>
                </tr>                
              @endforeach
            </tbody>
          </table>
        @endif

        </div>
      </div>
</main>