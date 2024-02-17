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
                  <a href="{{url('/admin/applicationlist')}}" class="btn btn-outline-dark">Refresh</a>
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
                  <td>
                      <button data-id="{{$research->id}}" type="button" class="btn btn-info studentshowBtn" data-bs-toggle="modal" data-bs-target="#showstudentinfo"><i class="bi bi-eye"></i></button>
                      <button data-id="{{$research->id}}" type="button" class="btn btn-primary studenteditBtn" data-bs-toggle="modal" data-bs-target="#editstudentinfo"><i class="bi bi-pencil-square"></i></button>
                      <button data-id="{{$research->id}}" type="button" class="btn btn-danger studentdeleteBtn"><i class="bi bi-trash"></i></button>
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

        </div>
      </div>
</main>