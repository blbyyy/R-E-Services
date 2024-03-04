@extends('layouts.navigation')
@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Create Announcement</h1>
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
      <h5 class="card-title">Add Announcenments</h5>

      <form class="row g-3" method="POST" enctype="multipart/form-data"
      action="{{route('AnnouncementAdded')}}">
      @csrf

        <div class="col-md-12">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title">
        </div>

        <div class="col-md-12">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" name="content" id="content" style="height: 100px;"></textarea>
        </div>

        <div class="col-md-12">
            <label for="content" class="form-label">Photo</label>
            <input name="img_path[]" type="file" multiple id="img_path" class="form-control" id="avatar">
        </div>

        <fieldset class="col-md-12">
          <legend class="col-form-label col-sm-4 pt-0">Select Announcement Viewer:</legend>
          <div class="col-sm-8">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="viewer" id="viewer1" value="Student/Faculty/Staff">
              <label class="form-check-label" for="viewer1">
                All
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="viewer" id="viewer2" value="Students">
              <label class="form-check-label" for="viewer2">
                Students
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="viewer" id="viewer3" value="Faculty">
              <label class="form-check-label" for="viewer3">
                Faculty
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="viewer" id="viewer4" value="Staff">
              <label class="form-check-label" for="viewer4">
                Staff
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="viewer" id="viewer5" value="Faculty/Staff">
              <label class="form-check-label" for="viewer5">
                Faculty & Staff
              </label>
            </div>

          </div>
        </fieldset>
        
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
      </form>
    </div>
</div>
</main>