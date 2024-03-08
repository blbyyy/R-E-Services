@extends('layouts.navigation')
@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Research Access Requests</h1>
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
          <h5 class="card-title">List of Student Access Requests</h5>

          <table class="table table-hover">
            <thead>
              <tr class="text-center">
                <th scope="col">Actions</th>
                <th scope="col">Requestor</th>
                <th scope="col">Research Title</th>
                <th scope="col">Purpose</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
            @foreach($requestAccess as $request)
              <tr class="text-center">
                <td>
                  @if ($request->status === 'Access Approved')
                    <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="At the moment, this request has access."><i class="bi bi-key-fill"></i></button>
                  @elseif ($request->status === 'Rejected')
                    <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="This request is not granted."><i class="bi bi-key-fill"></i></button>
                  @else
                    <button data-id="{{$request->id }}" type="button" class="btn btn-primary studentProcessAccessRequest" data-bs-toggle="modal" data-bs-target="#studentResearchAccessRequest"><i class="bi bi-key-fill"></i></button>
                  @endif
                <td>
                    {{$request->fname . ' ' . $request->mname . ' ' . $request->lname}}
                    <span style="font-size: small">({{$request->requestor_type}})</span>
                </td>
                <td>{{$request->research_title}}</td>
                <td>{{$request->purpose}}</td>
                <td>
                    @if ($request->status === 'Rejected')
                        <span class="badge rounded-pill bg-danger">{{$request->status}}</span>
                    @elseif ($request->status === 'Access Approved')
                        <span class="badge rounded-pill bg-success">{{$request->status}}</span>
                    @else
                        <span class="badge rounded-pill bg-warning">{{$request->status}}</span>
                    @endif
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>

          <div class="modal fade" id="studentResearchAccessRequest" tabindex="-1"> 
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Sending Access File</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
        
                    <form class="row g-3" method="POST" action="{{ route('student.sending.access.file') }}" enctype="multipart/form-data">
                      @csrf
          
                    <input type="hidden" class="form-control" id="requestId" name="requestId">

                    <h5 style="color: maroon">Requested Research Title:</h5>
                    <p id="researchTitle" class="large fst-italic"></p>

                    <h5 style="color: maroon">Purpose:</h5>
                    <p id="purpose"></p>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <select name="status" class="form-select" id="status" aria-label="State">
                                <option selected>Select Status....</option>
                                <option value="Access Approved">Approved</option>
                                <option value="Rejected">Reject</option>
                            </select>
                            <label for="status">Status</label>
                        </div>
                    </div>
              
                    <div class="col-md-12" id="fileContainer" style="display: none;">
                        <label for="research_file" class="form-label" style="color: maroon">Research File</label>
                        <input type="file" class="form-control" id="research_file" name="research_file">
                    </div>
            
                    <div class="col-" style="padding-top: 20px">
                      <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-outline-dark">Send</button>
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
          var fileContainer = document.getElementById('fileContainer');

          if (this.value === 'Sent') {
            fileContainer.style.display = 'block';
          } else {
            fileContainer.style.display = 'none';
          }
      });

      $('#viewApplicationInfo').on('hidden.bs.modal', function () {
              $('#certificationForm')[0].reset();
              $('#remarksContainer').hide();
          });
  });
</script>