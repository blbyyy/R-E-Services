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
</style>
<main id="main" class="main">

<div class="row g-4">
  @foreach($application as $applications)
 
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{$applications->research_title}}<span>({{$applications->status}})</span></h5>
              <div class="icon">
                <i class="bi bi-file-earmark-pdf"></i>
              </div>

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
            
        </div>
    </div>
    
  @endforeach
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
</script>