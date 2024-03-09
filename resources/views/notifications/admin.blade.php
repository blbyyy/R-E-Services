@extends('layouts.navigation')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Entire List of Notifications</h1>
    </div>
   
    <div class="row">
        @foreach ($notification as $notifications)
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$notifications->title}}
                        <span>    ({{ \Carbon\Carbon::parse($notifications->date)->diffForHumans() }})</span>
                    </h4>
                    <h6>
                        {{$notifications->fname . ' ' . $notifications->mname . ' ' . $notifications->lname}}
                        <span style="font-size: medium">({{$notifications->role}})</span>
                    </h6>
                    <span style="font-style: italic">"{{$notifications->message}}"</span>

                    @if ($notifications->title === 'Research Access Request for Documents')
                        <div class="d-flex justify-content-end">
                            <a href="{{url('/faculty-research-access-requests')}}">View</a>
                        </div>
                    @elseif ($notifications->title === 'Research Access Request for Information')
                        <div class="d-flex justify-content-end">
                            <a href="{{url('/student-research-access-requests')}}">View</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
</main>