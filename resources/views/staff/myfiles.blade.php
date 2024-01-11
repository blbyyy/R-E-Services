@extends('layouts.navigation')
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
        <h1>My Files</h1>
    </div>
    <div class="row g-4">
        <div class="col-12">
            <button type="button" class="btn btn-dark" onclick="toggleFileUploadForm()"><i class="bi bi-folder-plus"></i> Upload File</button>
        </div>
        
        <div id="fileUploadForm" class="col-md-12" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Upload a file</h5>
        
                    <form class="row g-3" method="POST" action="{{ route('staff_upload_file') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label for="research_title" class="form-label">Research Title</label>
                            <input type="text" class="form-control" id="research_title" name="research_title">
                        </div>
                        <div class="col-12">
                            <label for="research_file" class="form-label">Research File</label>
                            <input type="file" class="form-control" id="research_file" name="research_file">
                        </div>
        
                        <div class="col-12" style="padding-top: 20px">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-dark">Upload file</button>
                                <button type="reset" class="btn btn-outline-dark ms-2" onclick="toggleFileUploadForm()">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        @if(count($myfiles) > 0)
            @foreach($myfiles as $files)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{$files->research_title}}</h5>
                            <div class="icon">
                                <i class="bi bi-file-earmark-pdf"></i>
                            </div>
                        
                            <center>
                                <button type="button" class="btn btn-outline-dark staffshowpdfinfo" data-bs-toggle="modal" data-bs-target="#staffshowfiles" data-id="{{$files->id}}">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-outline-dark stafffiledeleteBtn" data-id="{{$files->id}}">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <button type="button" class="btn btn-outline-dark stafffilehistory" data-bs-toggle="modal" data-bs-target="#staffshowhistory" data-id="{{$files->id}}">
                                    <i class="bi bi-clock-history"></i>
                                </button>
                            </center>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <div class="icon">
                        <i class="bi bi-folder2-open"></i>
                    </div>
                    <div class="body">
                        <h2>Nothing has been uploaded here.</h2>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

        <div class="modal fade" id="staffshowfiles" tabindex="-1">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="pdf-container"></div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="staffshowhistory" tabindex="-1">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                          <h5 id="stafftitle" class="card-title"></h5>
                          <table id="staffhistoryTable" class="table table-hover">
                            <thead>
                              <tr>
                                <th scope="col">Submission Frequency</th>
                                <th scope="col">Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Initial Similarity</th>
                                <th scope="col">Similarity Result</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row"></th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                            </tbody>
                          </table>
                          <p id="staffmessage">
                        </div>
                      </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>

</main>
<script>
    function showFileUploadForm() {
        document.getElementById('fileUploadForm').style.display = 'block';
    }

    function toggleFileUploadForm() {
                var fileUploadForm = document.getElementById('fileUploadForm');
                if (fileUploadForm.style.display === 'none' || fileUploadForm.style.display === '') {
                    fileUploadForm.style.display = 'block';
                } else {
                    fileUploadForm.style.display = 'none';
                }
            }
</script>