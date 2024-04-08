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
        <h1>Research Proposal List</h1>
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
            <h5 class="card-title">List of Research Proposal</h5>
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Owner</th>
                        <th scope="col">Research Proposal Title</th>
                        <th scope="col">Research Proposal Type</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                @foreach ($proposal as $proposals)
                    <tbody>
                        <tr class="text-center">
                            <td>{{$proposals->fname .' '.$proposals->mname .' '. $proposals->lname}}<span>({{$proposals->role}})</span></td>
                            <td>{{$proposals->title}}</td>
                            <td>{{$proposals->research_type}}</td>
                            <td>
                                @if ($proposals->status === 'Pending R&E Office Approval')
                                    <h5><span class="badge bg-warning">{{$proposals->status}}</span></h5>
                                @elseif ($proposals->status === 'Research Proposal Approved By R&E Office')
                                    <h5><span class="badge bg-success">{{$proposals->status}}</span></h5>
                                @elseif ($proposals->status === 'Research Proposal Rejected By R&E Office')
                                    <h5><span class="badge bg-danger">{{$proposals->status}}</span></h5>
                                @endif 
                            </td>
                            <td>
                                @if ($proposals->status === 'Pending R&E Office Approval')
                                    <button data-id="{{$proposals->id}}" type="button" class="btn btn-primary processResearchProposal" data-bs-toggle="modal" data-bs-target="#processingResearchProposal"><i class="bi bi-arrow-right"></i></button>
                                @elseif ($proposals->status === 'Research Proposal Approved By R&E Office')
                                    <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This proposal has already been approved."><i class="bi bi-arrow-right"></i></button>
                                @elseif ($proposals->status === 'Research Proposal Rejected By R&E Office')
                                    <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="This proposal has already been rejected."><i class="bi bi-arrow-right"></i></button>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>

    <div class="modal fade" id="processingResearchProposal" tabindex="-1">
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
                                        <span id="researchProposalTitle"></span>
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
                                        <span id="researchProposalStatus"></span>
                                    </div>
                                </div>

                                <form class="col-md-12" method="POST" action="{{ route('admin.sending-back.research.proposal') }}" enctype="multipart/form-data">
                                    @csrf
                
                                    <input name="proposalId" type="hidden" class="form-control" id="proposalId">
                    
                                    <div class="col-12 text-center">
                                        <label for="status" class="form-label">This research proposal passed?</label>
                                        <select id="status" class="form-select" name="status">
                                        <option selected>Choose....</option>
                                        <option value="Research Proposal Approved By R&E Office">Yes</option>
                                        <option value="Research Proposal Rejected By R&E Office">No</option>
                                        </select>
                                    </div>

                                    <div id="colloquiumContainer" class="text-center" style="padding-top: 20px; display: none;" >
                                        <div class="row">
                                            <h5><b style="color: maroon">Make Schedule for Research Colloquium</b></h5>
                                            <div class="col-6 text-center">
                                                <label for="colloquium_date">Date</label>
                                                <input class="form-control" type="date" id="colloquium_date" name="colloquium_date"></input>
                                            </div>
                                            <div class="col-6 text-center">
                                                <label for="colloquium_time">Time</label>
                                                <input class="form-control" type="time" id="colloquium_time" name="colloquium_time"></input>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12" style="padding-top: 20px">
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-outline-dark">Submit</button>
                                        </div>
                                    </div>
                    
                                </form>

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
            var colloquiumContainer = document.getElementById('colloquiumContainer');

            if (this.value === 'Research Proposal Approved By R&E Office') {
                colloquiumContainer.style.display = 'block';
            } else {
                colloquiumContainer.style.display = 'none';
            }
        });

        $('#processingResearchProposal').on('hidden.bs.modal', function () {
                $('#colloquiumContainer').hide();
        });
    });
</script>