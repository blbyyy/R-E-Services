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
          <h5 class="card-title">List of Faculty Access Requests</h5>

          @if(count($requestAccess) > 0)
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
                      <button data-id="{{$request->id}}" type="button" class="btn btn-primary facultyProcessAccessRequest" data-bs-toggle="modal" data-bs-target="#facultyResearchAccessRequest"><i class="bi bi-key-fill"></i></button>
                    @endif
                  </td>
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
          @else
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
                <tr>
                </tr>
              </tbody>
            </table>
            <div class="alert alert-danger" role="alert">
                <div class="text-center">
                    <span class="badge border-danger border-1 text-danger" style="font-size: large">No Faculty Access Requests Populated</span>
                </div>
            </div>
          @endif

          <div class="modal fade" id="facultyResearchAccessRequest" tabindex="-1"> 
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Sending Access File</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                  <div class="card-body text-center">
                    <h5 style="color: maroon"><b>Requested Research Title:</b></h5>
                    <p id="researchTitle" class="large fst-italic"></p>
                  </div>
                  <div class="card-body text-center">
                    <h5 style="color: maroon"><b>Purpose:</b></h5>
                    <p id="purpose"></p>
                  </div>
        
                  <form class="row g-3" method="POST" action="{{ route('faculty.sending.access.file') }}" enctype="multipart/form-data">
                      @csrf
          
                    <input type="hidden" class="form-control" id="requestId" name="requestId">

                    <div class="col-12 text-center">
                      <label for="status" class="form-label">Do you approved this request?</label>
                        <select id="status" class="form-select" name="status">
                            <option selected>Select....</option>
                            <option value="Access Approved">Yes</option>
                            <option value="Rejected">No</option>
                        </select>
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