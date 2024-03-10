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
                    <span style="font-style: italic">"{{$notifications->message}}"</span>
                    <h6>
                        <b>From:</b>
                        {{$notifications->fname . ' ' . $notifications->mname . ' ' . $notifications->lname}}
                        <span style="font-size: medium">({{$notifications->role}})</span>
                    </h6>
                    

                    @if ($notifications->title === 'Research Access Request for Documents')
                        <div class="d-flex justify-content-end">
                            <a href="{{url('/staff-research-access-requests')}}">View</a>
                        </div>
                    @elseif ($notifications->title === 'Application Certification Failed')
                        <div class="d-flex justify-content-end">
                            <a href="{{url('/staff/application/status')}}">View</a>
                        </div>
                    @elseif ($notifications->title === 'Faculty Application Certification Submitted')
                        <div class="d-flex justify-content-end">
                            <a href="{{url('/applicationlist')}}">View</a>
                        </div>
                    @elseif ($notifications->title === 'Student Application Certification Submitted')
                        <div class="d-flex justify-content-end">
                            <a href="{{url('/applicationlist')}}">View</a>
                        </div>
                    @elseif ($notifications->title === 'Technical Adviser Certification Approval' || $notifications->title === 'Subject Adviser Certification Approval')
                        <div class="d-flex justify-content-end">
                            <a href="{{url('/faculty/student-applications')}}">View</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
</main>