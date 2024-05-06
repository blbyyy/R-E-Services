@extends('layouts.navigation')
@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <h1>Research Proposal</h1>
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

    <div class="col-12" style="padding-bottom: 20px;">
        <button type="button" class="btn btn-dark" onclick="toggleResearchProposalUploadForm()">Submit Research Proposal</button>
    </div>

    <div id="researchProposalUploadForm" class="col-md-12" style="display: none;">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Submit Research Proposal</h5>

                <p>
                    <span class="badge bg-warning text-dark">Note:</span> 
                    (To make sure your document is in the proper format, 
                    you can check it to the <a href="{{url('faculty/research/templates')}}">downloadable templates</a> 
                    by searching for <b>"Standard Research Proposal,</b> and make sure you follow to 
                    the reference file's content accurately to prevent the proposal from being rejected.)
                </p>
    
                <form class="row g-3" method="POST" action="{{ route('faculty.research-proposal.sent') }}" enctype="multipart/form-data" style="padding-top: 20px;">
                    @csrf

                    <div class="col-12 text-center">
                        <label for="title" class="form-label">Research Proposal Title</label>
                        <textarea name="title" class="form-control" id="title" style="height: 100px;"></textarea>
                    </div>

                    <div class="col-12 text-center">
                        <label for="research_type" class="form-label">Select Research Proposal Type:</label>
                        <select name="research_type" class="form-select" id="research_type" aria-label="State">
                            <option selected>Choose.....</option>
                            <option value="Research Program">Research Program</option>
                            <option value="Research Project">Research Project</option>
                            <option value="Independent Study">Independent Study</option>
                        </select>
                    </div>

                    <div class="col-12 text-center">
                        <label for="researchProposalFile" class="form-label">Research Proposal File</label>
                        <input type="file" class="form-control" id="researchProposalFile" name="researchProposalFile">
                    </div>
                    <span style="font-size: small; color: maroon">(Note: We recommend using either PDF or Word formats, with a preference for Word.)</span>
    
                    <div class="col-12" style="padding-top: 20px">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-outline-dark">Submit</button>
                            <button type="reset" class="btn btn-outline-dark ms-2" onclick="toggleResearchProposalUploadForm()">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row g-0">
        @if(count($proposal) > 0)
            @foreach($proposal as $proposals)
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-10 d-flex justify-content-center align-items-center">
                            <div class="card-body">
                                <h5 class="card-title">{{$proposals->title}}</h5>  
                                @if ($proposals->status === 'Research Proposal Approved By R&E Office')
                                    <span class="badge rounded-pill bg-success">{{$proposals->status}}</span> 
                                @elseif ($proposals->status === 'Research Proposal Rejected By R&E Office')
                                    <span class="badge rounded-pill bg-danger">{{$proposals->status}}</span>
                                @else 
                                    <span class="badge rounded-pill bg-warning">{{$proposals->status}}</span>
                                @endif 
                                
                            </div>
                        </div>
                        <div class="col-md-2 d-flex justify-content-center align-items-center">
                            <div>
                                @if ($proposals->status === 'Research Proposal Rejected By R&E Office')
                                    <button type="button" class="btn btn-outline-dark viewReseachProposalStatus" data-bs-toggle="modal" data-bs-target="#researchProposalStatus" data-id="{{$proposals->id}}">
                                        <i class="ri-file-info-line" style="font-size: 25px"></i>
                                    </button> 
                                    <button type="button" class="btn btn-outline-dark reSubmitResearchProposal" data-bs-toggle="modal" data-bs-target="#reSubmitResearchProposal" data-id="{{$proposals->id}}">
                                        <i class="ri-file-edit-line" style="font-size: 25px"></i>
                                    </button> 
                                @elseif ($proposals->status === 'Research Proposal Approved By R&E Office')
                                    <button type="button" class="btn btn-outline-dark viewReseachProposalStatus" data-bs-toggle="modal" data-bs-target="#researchProposalStatus" data-id="{{$proposals->id}}">
                                        <i class="ri-file-info-line" style="font-size: 25px"></i>
                                    </button> 
                                    <button type="button" class="btn btn-outline-dark sendingProposalFile" data-bs-toggle="modal" data-bs-target="#sendingFile" data-id="{{$proposals->id}}">
                                        <i class="ri-arrow-right-line" style="font-size: 25px"></i>
                                    </button> 
                                @else
                                    <button type="button" class="btn btn-outline-dark viewReseachProposalStatus" data-bs-toggle="modal" data-bs-target="#researchProposalStatus" data-id="{{$proposals->id}}">
                                        <i class="ri-file-info-line" style="font-size: 25px"></i>
                                    </button> 
                                @endif 
                                
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
                            <i class="ri-file-forbid-line"></i>
                        </div>
                        <div class="body">
                            <h2>Nothing has been uploaded here.</h2>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="modal fade" id="researchProposalStatus" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Process Research Proposal</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Research Proposal File:</b></h5>
                                <i class="bx bxs-file-pdf" style="font-size: 4em; color: maroon;"></i>
                                <p id="pdfFile" style="color: maroon; font-size: small;"></p>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Research Proposal Title:</b></h5>
                                <span id="researchTitle"></span>
                            </div>
                        </div>
    
                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Research Proposal Type:</b></h5>
                                <span id="researchProposalType"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Status:</b></h5>
                                <span id="status"></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card-body text-center">
                                <h5><b style="color: maroon">Remarks:</b></h5>
                                <span id="researchProposalRemarks"></span>
                            </div>
                        </div>     

                        {{-- <div id="colloquiumSchedule" class="text-center" style="padding-top: 20px;">
                            <div class="row">
                                <h5 style="padding-bottom: 20px;"><b style="color: maroon;">Research Colloquium Schedule</b></h5>
                                <div class="col-md-6">
                                    <div class="card-body text-center">
                                        <i class="bx bxs-time" style="font-size: 4em; color: maroon;"></i>
                                    <h5 class="card-title">Time:</h5>
                                    <span class="card-text" id="colloquiumTime"></span>
                                    </div>
                                </div>
        
                                <div class="col-md-6">
                                    <div class="card-body text-center">
                                        <i class="bx bxs-calendar" style="font-size: 4em; color: maroon;"></i>
                                    <h5 class="card-title">Date:</h5>
                                    <p class="card-text" id="colloquiumDate"></p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>

        <div class="modal fade" id="reSubmitResearchProposal" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">ReSubmit Research Proposal</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
    
                    <form class="row g-3" method="POST" action="{{ route('faculty.research-proposal.resubmit.sent') }}" enctype="multipart/form-data" style="padding-top: 20px;">
                        @csrf

                        <input name="proposalId" type="hidden" class="form-control" id="proposalId">
    
                        <div class="col-12 text-center">
                            <label for="title" class="form-label">Research Proposal Title</label>
                            <textarea name="title" class="form-control" id="title" style="height: 100px;"></textarea>
                        </div>
    
                        <div class="col-12 text-center">
                            <label for="researchProposalFile" class="form-label">Research Proposal File</label>
                            <input type="file" class="form-control" id="researchProposalFile" name="researchProposalFile">
                            <span style="font-size: small">(Note: Please ensure that you upload the revised research proposal in this field to prevent rejection.)</span>
                        </div>
        
                        <div class="col-12" style="padding-top: 20px">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-dark">Submit</button>
                                <button type="reset" class="btn btn-outline-dark ms-2">Reset</button>
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

        <div class="modal fade" id="sendingFile" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Sending Proposal File</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row mb-3">
                        <legend class="col-form-label col-sm-3 pt-0">Choose Recipient:</legend>
                        <div class="col-sm-9">
      
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="">
                            <label class="form-check-label" for="gridCheck1">
                              Director Office
                            </label>
                          </div>
      
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck2">
                            <label class="form-check-label" for="gridCheck2">
                                University Research and Development Services
                            </label>
                          </div>

                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck2">
                            <label class="form-check-label" for="gridCheck2">
                              Vice President
                            </label>
                          </div>

                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck2">
                            <label class="form-check-label" for="gridCheck2">
                              President
                            </label>
                          </div>
      
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
    function showResearchProposalUploadForm() {
        document.getElementById('researchProposalUploadForm').style.display = 'block';
    }

    function toggleResearchProposalUploadForm() {
                var researchProposalUploadForm = document.getElementById('researchProposalUploadForm');
                if (researchProposalUploadForm.style.display === 'none' || researchProposalUploadForm.style.display === '') {
                    researchProposalUploadForm.style.display = 'block';
                } else {
                    researchProposalUploadForm.style.display = 'none';
                }
            }
</script>
