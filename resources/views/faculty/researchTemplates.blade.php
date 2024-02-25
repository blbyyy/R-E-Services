@extends('layouts.navigation')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Downloadable Templates Under Research</h1>
    </div>
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">List of Templates</h5>

          <ol class="list-group list-group-numbered" >
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Purchase Request</div>
                </div>
                <a href="{{ asset('uploads/researchTemplates/template1.pdf') }}" target="_blank" class="btn-sm" style="color: maroon">
                    Download    
                    <i class="bi bi-arrow-right-circle"></i>
                </a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Research Progress Report</div>
                </div>
                <a href="{{ asset('uploads/researchTemplates/template2.pdf') }}" target="_blank" class="btn-sm" style="color: maroon">
                    Download    
                    <i class="bi bi-arrow-right-circle"></i>
                </a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Profile of Researcher</div>
                </div>
                <a href="{{ asset('uploads/researchTemplates/template3.pdf') }}" target="_blank" class="btn-sm" style="color: maroon">
                    Download    
                    <i class="bi bi-arrow-right-circle"></i>
                </a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Terminal Report Form</div>
                </div>
                <a href="{{ asset('uploads/researchTemplates/template4.pdf') }}" target="_blank" class="btn-sm" style="color: maroon">
                    Download    
                    <i class="bi bi-arrow-right-circle"></i>
                </a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Research Waiver and Warranty</div>
                </div>
                <a href="{{ asset('uploads/researchTemplates/template5.pdf') }}" target="_blank" class="btn-sm" style="color: maroon">
                    Download    
                    <i class="bi bi-arrow-right-circle"></i>
                </a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Standard Research Proposal</div>
                </div>
                <a href="{{ asset('uploads/researchTemplates/template6.pdf') }}" target="_blank" class="btn-sm" style="color: maroon">
                    Download    
                    <i class="bi bi-arrow-right-circle"></i>
                </a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Project Procurement Management Plan </div>
                </div>
                <a href="{{ asset('uploads/researchTemplates/template7.pdf') }}" target="_blank" class="btn-sm" style="color: maroon">
                    Download    
                    <i class="bi bi-arrow-right-circle"></i>
                </a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Waiver Form for Copyright National Library</div>
                </div>
                <a href="{{ asset('uploads/researchTemplates/template8.pdf') }}" target="_blank" class="btn-sm" style="color: maroon">
                    Download    
                    <i class="bi bi-arrow-right-circle"></i>
                </a>
            </li>
          </ol>

        </div>
      </div>
</main>