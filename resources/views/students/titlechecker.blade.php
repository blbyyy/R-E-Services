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
        <h1>Title Checker</h1>   
    </div>
    <div style="padding-bottom: 10px">
        <a href="{{url('student/title-checker')}}">
            <button type="button" class="btn btn-dark"><i class="bi bi-arrow-clockwise"></i> Refresh</button>
        </a>
    </div>

    <form class="row g-3" method="POST" action="{{ route('studentTitleCheckerSearch') }}" enctype="multipart/form-data">
    @csrf
        <div class="col-11">
            <input type="text" class="form-control" id="research_title" name="research_title">
        </div>
        <div class="col-1">
            <button type="submit" class="btn btn-dark" style="height: 40px; width: 70px;"><i class="bi bi-search"></i></button>
        </div>
    </form>

    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Research List</h5>
          @if($researchCount === 0)
            <div class="alert alert-primary bg-primary text-light border-0 alert-dismissible fade show" role="alert">
                Nothing matched your title.
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @else
            <table class="table table-hover">
                <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                    There are "{{ $researchCount }}" research findings.
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <tbody>
                    @foreach($researchList as $researchLists)
                        <tr>
                            <td>
                                <a href="" id="researchInfo" data-bs-toggle="modal" data-bs-target="#researchInfoModal" data-id="{{ $researchLists->id }}">
                                    {{$researchLists->research_title}}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          @endif
        </div>
    </div>

    <div class="modal fade" id="researchInfoModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Research Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="card-title">Research Title</h5>
                    <div id="researchTitle"></div>
                <h5 class="card-title">Research Abstract</h5>
                    <div id="researchAbstract"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>

</main>