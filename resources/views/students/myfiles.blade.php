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
        <h1>My Applications</h1>
    </div>
    <div class="row">
        <div class="col-12" style="padding-bottom: 20px;">
            <button type="button" class="btn btn-dark" onclick="toggleFileUploadForm()"><i class="bi bi-folder-plus"></i> Upload Application</button>
        </div>
        
        <div id="fileUploadForm" class="col-md-12" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Upload a Application</h5>
        
                    <form class="row g-3" method="POST" action="{{ route('student_upload_file') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label for="research_title" class="form-label">Application Title</label>
                            <input type="text" class="form-control" id="research_title" name="research_title">
                        </div>
                        <div class="col-12">
                            <label for="abstract" class="form-label">Application Abstract</label>
                            <textarea name="abstract" class="form-control" id="abstract" style="height: 300px;"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="research_file" class="form-label">Application File</label>
                            <input type="file" class="form-control" id="research_file" name="research_file">
                            <span style="font-size: small">(Note: The uploaded PDF file should not exceed 10mb in size.)</span>
                        </div>
        
                        <div class="col-12" style="padding-top: 20px">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-dark">Upload</button>
                                <button type="reset" class="btn btn-outline-dark ms-2" onclick="toggleFileUploadForm()">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        @if(count($myfiles) > 0)
            @foreach($myfiles as $files)
                <div class="card mb-3">
                    <div class="row">
                      <div class="col-md-10 d-flex justify-content-center align-items-center">
                          <div class="card-body">
                              <h5 class="card-title">{{$files->research_title}}</h5>     
                          </div>
                      </div>
                      <div class="col-md-2 d-flex justify-content-center align-items-center">
                          <div>
                            <button type="button" class="btn btn-outline-dark studentshowpdfinfo" data-bs-toggle="modal" data-bs-target="#studentshowfiles" data-id="{{$files->id}}">
                                <i class="bi bi-eye"></i>
                            </button>
                            <button type="button" class="btn btn-outline-dark studentfiledeleteBtn" data-id="{{$files->id}}">
                                <i class="bi bi-trash"></i>
                            </button>
                            <button type="button" class="btn btn-outline-dark studentfilehistory" data-bs-toggle="modal" data-bs-target="#studentshowhistory" data-id="{{$files->id}}">
                                <i class="bi bi-clock-history"></i>
                            </button>
                          </div>
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
    
        <div class="modal fade" id="studentshowfiles" tabindex="-1">
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

        <div class="modal fade" id="studentshowhistory" tabindex="-1">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                          <h5 id="studenttitle" class="card-title"></h5>
                          <table id="studenthistoryTable" class="table table-hover">
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
                          <p id="studentmessage">
                        </div>
                      </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
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