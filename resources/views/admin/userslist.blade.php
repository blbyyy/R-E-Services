@extends('layouts.navigation')
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">List of Users</h5>

        <form class="row g-3" method="POST" action="{{ route('admin.userlist.specific-role') }}">
          @csrf
          <div class="row">
              <label for="userRole" class="form-label"><b>Filter By Specific Role:</b></label>
              <div class="col-md-9" style="padding-bottom: 0px">
                  <select name="userRole" id="userRole" class="form-select" required>
                      <option selected>--- SELECT ROLE ---</option>
                      <option value="All">All Users</option>
                      <option value="Student">Student</option>
                      <option value="Faculty">Faculty</option>
                      <option value="Staff">Staff</option>
                  </select>
              </div>
              <div class="col-md-3">
                  <button type="submit" class="btn btn-outline-dark">Change</button>
                  <a href="{{url('admin/userlist')}}" class="btn btn-outline-dark">Refresh</a>
              </div>
          </div>
        </form>


        @if($users->isEmpty())
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
                      <i class="bi bi-person-x" style="font-size: 50px; margin-right: 10px;"></i>
                      No Users Detected
                  </span>
              </div>
          </div>
        @else
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Actions</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr>
                  <td>
                      <button data-id="{{$user->id}}" type="button" class="btn btn-info studentshowBtn" data-bs-toggle="modal" data-bs-target="#showstudentinfo"><i class="bi bi-eye"></i></button>
                      <button data-id="{{$user->id}}" type="button" class="btn btn-primary studenteditBtn" data-bs-toggle="modal" data-bs-target="#editstudentinfo"><i class="bi bi-pencil-square"></i></button>
                      <button data-id="{{$user->id}}" type="button" class="btn btn-danger studentdeleteBtn"><i class="bi bi-trash"></i></button>
                  </td>
                  <td>{{$user->fname .' '. $user->mname .' '. $user->lname}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->role}}</td>
                </tr>                
              @endforeach
            </tbody>
          </table>
        @endif

        </div>
      </div>
</main>