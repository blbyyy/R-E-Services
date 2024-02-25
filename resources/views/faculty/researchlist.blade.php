@extends('layouts.navigation')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Researches</h1>
    </div>

    <form class="row g-3" action="{{ route('searchResearchList') }}" method="GET">
        <div class="col-9">
            <input type="text" class="form-control" name="query">
        </div>
        <div class="col-1">
            <button type="submit" class="btn btn-dark" style="height: 40px; width: 70px;"><i class="bi bi-search"></i></button>
        </div>
        <div class="col-2">
            <a href="{{url('/faculty/research-list')}}">
                <button type="button" class="btn btn-dark"><i class="bi bi-arrow-clockwise"></i> Refresh</button>
            </a>
        </div>
    </form>

    <div class="card">
        <div class="card-body">

            <h5 class="card-title">List of Researches</h5>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Actions</th>
                        <th scope="col">Research Title</th>
                        <th scope="col">Department</th>
                        <th scope="col">Course</th>
                        <th scope="col">Date Completion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($researchlist as $research)
                    <tr>
                        <td>
                            <button data-id="{{ $research['id'] }}" type="button" class="btn btn-info userlistShowBtn" data-bs-toggle="modal" data-bs-target="#showUserInfo"><i class="bi bi-eye"></i></button>
                        </td>
                        <td>{{ $research['research_title'] }}</td>
                        <td>{{ $research['department'] }}</td>
                        <td>{{ $research['course'] }}</td>
                        <td>{{ $research['date_completion'] }}</td>
                    </tr>                    
                    @endforeach
                </tbody>
            </table>

            <div class="row justify-content-end">
                <div class="col-auto">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <!-- Previous Page Link -->
                            @if ($researchlist->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a href="{{ $researchlist->previousPageUrl() }}" class="page-link" rel="prev">Previous</a>
                                </li>
                            @endif
                    
                            <!-- Pagination Elements -->
                            @foreach ($researchlist as $page => $url)
                                @if ($page == $researchlist->currentPage())
                                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                                @endif
                            @endforeach
                    
                            <!-- Next Page Link -->
                            @if ($researchlist->hasMorePages())
                                <li class="page-item">
                                    <a href="{{ $researchlist->nextPageUrl() }}" class="page-link" rel="next">Next</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
</main>
