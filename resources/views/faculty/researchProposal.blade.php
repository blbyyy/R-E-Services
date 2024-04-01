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
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Submit Research Proposal</h5>
                <hr style="color: maroon; height: 5px;">
                <p>
                    <span class="badge bg-warning text-dark">Notes:</span> 
                    (To make sure your document is in the proper format, 
                    you can check it to the <a href="{{url('faculty/research/templates')}}">downloadable templates</a> 
                    by searching for <b>"Standard Research Proposal,</b> and make sure you follow to 
                    the reference file's content accurately to prevent the proposal from being rejected.)
                </p>
                <p>
                    <i><b>Research Program:</b> consists of two or more multi-disciplinary research projects wherein a Program Leader,
                    assisted by Project Leaders, is assigned to oversee the successful implementation of the research that is expected
                    to be completed within 18 months above.</i>
                </p>
                <p>
                    <i><b>Research Project:</b> consists of two or more related or inter-disciplinary studies headed by a Project Leader that is
                    expected to be completed within 12 to 20 months.</i>
                </p>
                <p>
                    <i><b>Independent Study:</b> a research study that is expected to be completed within two semesters.</i>
                </p>
                <hr style="color: maroon; height: 5px;">
    
                <form class="row g-3" method="POST" action="{{ route('faculty.research-proposal.sent') }}" enctype="multipart/form-data" style="padding-top: 20px;">
                    @csrf

                    <div class="col-12 text-center">
                        <label for="title" class="form-label">Research Proposal Title</label>
                        <textarea name="title" class="form-control" id="title" style="height: 100px;"></textarea>
                    </div>

                    <div class="col-6 text-center">
                        <label for="research_type" class="form-label">Select Research Proposal Type:</label>
                        <select name="research_type" class="form-select" id="research_type" aria-label="State">
                            <option selected>Choose.....</option>
                            <option value="Research Program">Research Program</option>
                            <option value="Research Project">Research Project</option>
                            <option value="Independent Study">Independent Study</option>
                        </select>
                    </div>

                    <div class="col-6 text-center">
                        <label for="researchProposalFile" class="form-label">Research Proposal File</label>
                        <input type="file" class="form-control" id="researchProposalFile" name="researchProposalFile">
                    </div>
    
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

    <div class="row">
        @if(count($proposal) > 0)
            @foreach($proposal as $proposals)
                <div class="card mb-3">
                    <div class="card-body">
                    <h5 class="card-title">{{$proposals->title}}</h5>
                   
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
