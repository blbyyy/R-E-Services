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
    <h1>Application List</h1>
  </div>

  <div style="padding-bottom: 10px">
    <button type="button" class="btn btn-dark" onclick="showOrToggleView('tiles')">
      <i class="bi bi-grid"></i> Tile View
    </button>
    <button type="button" class="btn btn-dark" onclick="showOrToggleView('table')">
      <i class="bi bi-layout-text-window-reverse"></i> Table View
    </button>
  </div>

  <div class="col-md-12" >
    <div class="card" id="default" style="display: block;">
        <div class="card-body">
            <h5 class="card-title"></h5>
            <div class="icon">
              <i class="bi bi-question-lg"></i>
            </div>
            <div class="body">a
                <h2>There's no view selected.</h2>
            </div>
        </div>
    </div>
  </div>

  <div id="tiles" style="display: none;">
    <div class="row g-4">
        @foreach($application as $applications)
          <div class="col-md-4">
              <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">{{$applications->research_title}}<span>({{$applications->status}})</span></h5>
                    <div class="icon">
                      <i class="bi bi-file-earmark-pdf"></i>
                    </div>
                    <h6 class="text-center">{{$applications->submission_frequency}}</h6>

                    @if($applications->status == 'Passed')
                      <center>
                      <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="This file is already passed the certification.">
                        <i class="bi bi-info-circle"></i> See More
                      </button>
                      </center>
                    @elseif($applications->status == 'Returned')
                      <center>
                      <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="This file is already returned due to failed of certification.">
                        <i class="bi bi-info-circle"></i> See More
                      </button>
                      </center>
                    @else
                      <center>
                        <button type="button" class="btn btn-outline-dark admincertification" data-bs-toggle="modal" data-bs-target="#viewapplicationInfo" data-id="{{ $applications->id }}">
                          <i class="bi bi-info-circle"></i> See More
                        </button>
                      </center>
                    @endif
                  </div>
              </div>
          </div>
        @endforeach
    </div>
  </div>

  <div id="table" style="display: none;">
    <div class="row g-4">
      <div class="table">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"></h5>

            <!-- Table with hoverable rows -->
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Actions</th>
                  <th scope="col">Requestor Name</th>
                  <th scope="col">Research Title</th>
                  <th scope="col">Frequency Submission</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($application as $applications)
                  <tr>
                    <td>
                      @if($applications->status == 'Passed')
                        <button data-id="{{$applications->id}}" type="button" class="btn btn-success " data-bs-toggle="modal" disabled><i class="bi bi-patch-check"></i></button>
                      @elseif ($applications->status == 'Returned')
                        <button data-id="{{$applications->id}}" type="button" class="btn btn-danger " data-bs-toggle="modal" disabled><i class="bi bi-patch-exclamation"></i></button>
                      @elseif ($applications->status == 'Pending')
                        <button data-id="{{$applications->id}}" type="button" class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#viewapplicationInfo"><i class="bi bi-patch-question"></i></button>
                      @endif
                    </td>
                    <td>{{$applications->requestor_name}}</td>
                    <td>{{$applications->research_title}}</td>
                    <td>{{$applications->submission_frequency}}</td>
                    <td>
                      @if ($applications->status === 'Returned')
                        <span class="badge border-danger border-1 text-danger">{{$applications->status}}</span>
                      @elseif ($applications->status === 'Passed')
                        <span class="badge border-success border-1 text-success">{{$applications->status}}</span>
                      @elseif ($applications->status === 'Pending')
                        <span class="badge border-warning border-1 text-warning"> {{$applications->status}}</span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <!-- End Table with hoverable rows -->

          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="viewapplicationInfo" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Certification</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="row g-3">

            <div class="col-md-4">
                <div class="icon" style="padding-bottom: 20px; padding-top: 50px;">
                  <i class="bi bi-file-earmark-pdf"></i>
                </div>
            
                <center>
                  <div id="pdf">
                  </div>
                </center>
            
            </div>
        
            <div class="col-md-6">
              <form class="row g-3" style="padding-top: 20px" id="certificationform" enctype="multipart/form-data">
                @csrf

                <input name="file_id" type="hidden" class="form-control" id="file_id">

                <div class="col-md-12">
                  <div class="form-floating mb-3">
                      <select name="status" class="form-select" id="status" aria-label="State">
                          <option selected>Choose....</option>
                          <option value="Passed">Passed</option>
                          <option value="Returned">Returned</option>
                      </select>
                      <label for="status">Status</label>
                  </div>
                </div>

                  <div class="col-12">
                      <div class="form-floating">
                          <input name="simmilarity_percentage_results" type="text" class="form-control" id="simmilarity_percentage_results" placeholder="Similarity Result">
                          <label for="simmilarity_percentage_results">Similarity Result</label>
                      </div>
                  </div>

                  <div class="col-12" id="certificationFileContainer" style="display: none;">
                    <div class="form-floating">
                        <input name="certification_file" type="file" class="form-control" id="certification_file" placeholder="Certification File">
                        <label for="certification_file">Certification File</label>
                    </div>
                  </div>

                  <div class="col-12" style="padding-top: 20px">
                    <div class="d-flex justify-content-end">
                      {{-- {{$applications->file_id}} --}}
                    <button type="submit" class="btn btn-outline-dark certificationBtn">Send</button>
                    </div>
                  </div>

              </form>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    document.getElementById('status').addEventListener('change', function () {
          var certificationFileContainer = document.getElementById('certificationFileContainer');

          // Toggle the display of the certificationFileContainer based on the selected status
          if (this.value === 'Passed') {
              certificationFileContainer.style.display = 'block';
          } else {
              certificationFileContainer.style.display = 'none';
          }
      });

      $('#viewapplicationInfo').on('hidden.bs.modal', function () {
              // Assuming your form has an ID of certificationform
              $('#certificationform')[0].reset();

              // Optionally, you can hide the certificationFileContainer again
              $('#certificationFileContainer').hide();
          });
  });

  // var currentViewId = '';  // Variable to store the ID of the currently visible view

  // function showOrToggleView(viewId) {
  //     var targetView = document.getElementById(viewId);

  //     if (currentViewId !== viewId) {
  //         // Hide the currently visible view
  //         if (currentViewId !== '') {
  //             document.getElementById(currentViewId).style.display = 'none';
  //         }

  //         // Show the new view
  //         targetView.style.display = 'block';
  //         currentViewId = viewId;
  //     } else {
  //         // Toggle the display if it's the same view
  //         if (targetView.style.display === 'none' || targetView.style.display === '') {
  //             targetView.style.display = 'block';
  //         } else {
  //             targetView.style.display = 'none';
  //             currentViewId = '';  // No view is currently visible
              
  //         }
  //     }
  // }

  var currentViewId = '';  // Variable to store the ID of the currently visible view

// Get the default card by ID
var defaultCard = document.getElementById('default');

function showOrToggleView(viewId) {
    var targetView = document.getElementById(viewId);

    // Hide the default card initially
    defaultCard.style.display = 'none';

    if (currentViewId !== viewId) {
        // Hide the currently visible view
        if (currentViewId !== '') {
            document.getElementById(currentViewId).style.display = 'none';
        }

        // Show the new view
        targetView.style.display = 'block';
        currentViewId = viewId;
    } else {
        // Toggle the display if it's the same view
        if (targetView.style.display === 'none' || targetView.style.display === '') {
            targetView.style.display = 'block';
        } else {
            targetView.style.display = 'none';
            currentViewId = '';  // No view is currently visible

            // Show the default card when no view is selected
            defaultCard.style.display = 'block';
        }
    }
}


</script>