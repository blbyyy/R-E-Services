@extends('layouts.navigation')
<main id="main" class="main">
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
        
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
      </form>
    </div>
</div>
</main>