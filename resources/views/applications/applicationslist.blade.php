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
    <h1>Applications List</h1>
  </div>

  <div id="table">
    <div class="row g-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">List of Pending Certification Applications</h5>

            <table class="table table-hover">
              <thead>
                <tr class="text-center">
                  <th scope="col">Actions</th>
                  <th scope="col">Requestor Name</th>
                  <th scope="col">Research Title</th>
                  <th scope="col">Frequency Submission</th>
                </tr>
              </thead>
              <tbody>
                @foreach($application as $applications)
                  <tr class="text-center">
                    <td>
                        <button data-id="{{$applications->id}}" type="button" class="btn btn-success adminCertification" data-bs-toggle="modal" data-bs-target="#viewApplicationInfo"><i class="bi bi-award"></i></button>
                    </td>
                    <td>{{$applications->requestor_name}}</td>
                    <td>{{$applications->research_title}}</td>
                    <td>{{$applications->submission_frequency}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>

          </div>
        </div>
    </div>
  </div>

  <div class="modal fade" id="viewApplicationInfo" tabindex="-1">
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
              <form class="row g-3" style="padding-top: 20px" id="certificationForm" enctype="multipart/form-data">
                @csrf

                <input name="file_id" type="hidden" class="form-control" id="file_id">
                  <div class="col-md-12">
                    <div class="form-floating">
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
                          <input name="simmilarity_percentage_results" type="number" class="form-control" id="simmilarity_percentage_results" placeholder="Similarity Result">
                          <label for="simmilarity_percentage_results">Similarity Result</label>
                      </div>
                  </div>

                  <div class="col-12" id="remarksContainer" style="display: none;">
                    <div class="form-floating">
                      <textarea class="form-control" id="remarks" name="remarks" style="height: 150px;"></textarea>
                      <label for="remarks">Remarks</label>
                    </div>
                  </div>

                  <div class="col-12" style="padding-top: 20px">
                    <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-outline-dark" id="certificationBtn">Send</button>
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
          var remarksContainer = document.getElementById('remarksContainer');

          if (this.value === 'Returned') {
            remarksContainer.style.display = 'block';
          } else {
            remarksContainer.style.display = 'none';
          }
      });

      $('#viewApplicationInfo').on('hidden.bs.modal', function () {
              $('#certificationForm')[0].reset();
              $('#remarksContainer').hide();
          });
  });
  
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