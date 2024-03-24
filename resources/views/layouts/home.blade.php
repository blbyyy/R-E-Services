@extends('layouts.navigation')
@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .custom {
      height: 400px;
      width: 100%;
      padding-bottom: 50px;
      padding-top: 10px;
    }
    .cal{
        color: #ffffff;
        font-style: italic;
        background-color: maroon;
        padding: 20px;
    }
    .fc-day-number {
        color: #ffffff; 
        font-style: italic;
    }
</style>
<main id="main" class="main">

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

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
          Hello Welcome back,  {{Auth::user()->fname .' '. Auth::user()->lname .' '. Auth::user()->mname}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Home</h5>

          <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist" >
            <li class="nav-item flex-fill" role="presentation">
                <button style="color: maroon;" class="nav-link w-100 active" id="announcement-tab" data-bs-toggle="tab" data-bs-target="#announcementTab" type="button" role="tab" aria-controls="home" aria-selected="true">
                    <i class="bi bi-megaphone"></i> Announcement
                </button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
                <button style="color: maroon;" class="nav-link w-100" id="events-tab" data-bs-toggle="tab" data-bs-target="#eventsTab" type="button" role="tab" aria-controls="profile" aria-selected="false">
                    <i class="bi bi-calendar-event"></i> Events 
                </button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
                <button style="color: maroon;" class="nav-link w-100" id="organization-tab" data-bs-toggle="tab" data-bs-target="#organizationTab" type="button" role="tab" aria-controls="contact" aria-selected="false">
                    <i class="bi bi-diagram-3-fill"></i> Organization
                </button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
                <button style="color: maroon;" class="nav-link w-100" id="certificationGuide-tab" data-bs-toggle="tab" data-bs-target="#certificationGuideTab" type="button" role="tab" aria-controls="contact" aria-selected="false">
                    <i class="bi bi-book"></i> Certification Guide
                </button>
            </li>
          </ul>

          <div class="tab-content pt-2" id="myTabjustifiedContent">
            <div class="tab-pane fade show active" id="announcementTab" role="tabpanel" aria-labelledby="announcement-tab">
                @foreach($announcements as $announcementId => $photos)
                        <br>
                          <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                  <img style="width: 50px; height: 40px;" class="rounded-circle" src="https://tse4.mm.bing.net/th?id=OIP.sRdQAfzOzF_ZjC3dnAZVSQHaGw&pid=Api&P=0&h=180" alt=""/>
                              </div>
                              <div class="ps-3">
                                  <h4>{{ $photos[0]->fname .' '. $photos[0]->mname .' '. $photos[0]->lname }}</h4>
                                  <span style="font-size: smaller">({{ $photos[0]->role }}) {{ $photos[0]->created_time }}</span>
                              </div>
                          </div>
              
                          <h5 style="font-style: italic; padding-bottom: 20px; padding-top: 30px;">{{ $photos[0]->title }}</h5>
                          <h6>{{ $photos[0]->content }}</h6>
                     
                            <div class="row">
                                @php $displayedPhotos = 0; @endphp
                                @foreach($photos as $key => $photo)
                                    @if($key < 3) 
                                        <div class="col-md-4 mb-3">
                                            <a data-bs-toggle="modal" data-bs-target="#LargeImageModal{{ $announcementId }}_{{ $key }}">
                                                <img src="{{ asset('images/'.$photo->img_path) }}" class="custom" alt="...">
                                            </a>
                                        </div>
                                        <div class="modal fade" id="LargeImageModal{{ $announcementId }}_{{ $key }}" tabindex="-1" aria-labelledby="LargeImageModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="LargeImageModalLabel"></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                      <img src="{{ asset('images/'.$photo->img_path) }}" class="img-fluid" alt="Large Image" style="width: 100%; height: 100vh;">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php $displayedPhotos++; @endphp
                                    @endif
                                @endforeach
                            </div>
              
                          <div class="row" style="padding-bottom: 20px">
              
                              <div>
                                  <button data-id="{{$photos[0]->announcement_id}}" type="button" class="btn btn-outline-dark commentshowBtn" data-bs-toggle="modal" data-bs-target="#showcomments">
                                      Comments <i class="bi bi-chat-dots"></i>
                                  </button>
                                  @if(count($photos) > 3)
                                      <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#RemainingImagesModal{{ $announcementId }}">
                                          +{{ count($photos) - 3 }} <i class="bi bi-images"></i>
                                      </button>
                                  @endif
                              </div>
                          
                              <div class="modal fade" id="showcomments" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header" >
                                      <h5 id="header" class="modal-title" >All Comments <i class="bi bi-chat-dots"></i></h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <section class="section profile">
                                        <div class="row">
                                          <div class="col-xl-4">
                                          </div>
                                          <div class="col-xl-12">
                                            
                                            <div id="try" style="padding-bottom: 30px">
              
                                            </div>
              
                                            <form id="addcommentform" class="row g-3" enctype="multipart/form-data">
                                              @csrf
                                              <input type="hidden" class="form-control id" id="announcement_id" name="announcement_id">
                                              <div class="col-md-10">
                                                <input type="text" id="content" name="content" class="form-control" placeholder="Write a comment">
                                              </div>
                                              <div class="col-md-2">
                                                <button data-id="{{$photo->announcement_id}}" type="submit" class="btn btn-outline-dark addcommentBtn">Comment</button>
                                              </div>
                                            </form>
                                       
                                          </div>
                                        </div>
                                      </section>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          
                              <div class="modal fade" id="RemainingImagesModal{{ $announcementId }}" tabindex="-1" aria-labelledby="RemainingImagesModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                              <div class="modal-header">
                                                  <h5 class="modal-title" id="RemainingImagesModalLabel">Remaining Picture(s) <i class="bi bi-images"></i></h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                  <div id="carouselRemaining{{ $announcementId }}" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-inner">
                                                      @for ($i = 3; $i < count($photos); $i++)
                                                          <div class="carousel-item {{ $i === 3 ? 'active' : '' }}">
                                                              <a data-bs-toggle="modal" data-bs-target="#LargeImageModal{{ $announcementId }}_{{ $i }}">
                                                                <img src="{{ asset('images/'.$photos[$i]->img_path) }}" class="d-block mx-auto" style="width: 100%; height: 100vh;" alt="...">
                                                              </a>
                                                          </div>  
                                                      @endfor
                                                  </div>
                    
                                                      <button class="carousel-control-prev" type="button" data-bs-target="#carouselRemaining{{ $announcementId }}" data-bs-slide="prev">
                                                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                          <span class="visually-hidden">Previous</span>
                                                      </button>
                                                      <button class="carousel-control-next" type="button" data-bs-target="#carouselRemaining{{ $announcementId }}" data-bs-slide="next">
                                                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                          <span class="visually-hidden">Next</span>
                                                      </button>
                                              </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                              </div>
                          </div>
                        </div>

                @endforeach
            </div>

            <div class="tab-pane fade" id="eventsTab" role="tabpanel" aria-labelledby="events-tab">
                <div class="container">
                    <div class="response"></div>
                    <div class="cal" id='calendar'></div>  
                </div>
            </div>

            <div class="tab-pane fade" id="organizationTab" role="tabpanel" aria-labelledby="organization-tab">
                organization
            </div>

            <div class="tab-pane fade" id="certificationGuideTab" role="tabpanel" aria-labelledby="certificationGuide-tab">
                @if (Auth::user()->role !== 'Admin' && Auth::user()->role !== 'Moderator' && Auth::user()->role !== 'Super Admin')
                        <h5 class="card-title">How can your application be certified?</h5>
                        <hr class="thick-hr">
                        <span style="font-size: large; color:maroon; font-weight: bold;">Step 1:</span>
                        <p style="padding-top: 10px">
                        Select the
                        @if (Auth::user()->role === 'Student')
                            <a href="{{ url('student/myfiles') }}">
                            <span>"My Files"</span>
                            </a> 
                        @elseif (Auth::user()->role === 'Faculty')
                            <a href="{{ url('faculty/myfiles') }}">
                            <span>"My Files"</span>
                            </a> 
                        @endif 
                        tab and upload the files that you would like certified. 
                        Make sure the files you upload are only 10 MB in size and are only in PDF format.
                        </p>
            
                        <hr class="thick-hr">
                        <span style="font-size: large; color:maroon; font-weight: bold;">Step 2:</span>
                        <p style="padding-top: 10px">
                        Next select the 
                        @if (Auth::user()->role === 'Student')
                            <a href="{{ url('apply/certification') }}">
                            <span>"Certification"</span>
                            </a> 
                        @elseif (Auth::user()->role === 'Faculty')
                            <a href="{{ url('faculty/apply/certification') }}">
                            <span>"Certification"</span>
                            </a> 
                        @endif 
                        tab, where you will find the file you uploaded. 
                        Click on Apply Certification and complete all of the required fields.
                        and if your application is marked as "Returned" 
                        simply click "Re-Apply" and send in your revised application.
                        </p>
            
                        <hr class="thick-hr">
                        <span style="font-size: large; color:maroon; font-weight: bold;">Step 3:</span>
                        <p style="padding-top: 10px; padding-bottom: 30px;">
                        Right now, your application is being considered. 
                        Please wait for a staff member or administrator to process it. 
                        Under the 
                        @if (Auth::user()->role === 'Student')
                            <a href="{{ url('application/status') }}">
                            <span>"Application Status"</span>
                            </a> 
                        @elseif (Auth::user()->role === 'Faculty')
                            <a href="{{ url('faculty/application/status') }}">
                            <span>"Application Status"</span>
                            </a> 
                        @endif
                        tab, you can see its current state. and after the procedure is over, 
                        it will email you or alert the system itself.
                        </p>
            
                        <hr class="thick-hr">
                        <p style="font-style: italic">
                        "Thank you for choosing R&E-Services! We're grateful for your support. 
                        We're here to help, so feel free to reach out anytime. 
                        We look forward to serving you again soon!"
                        </p>
               
                @else
                @endif
            </div>
          </div>

        </div>
    </div>

</main>
