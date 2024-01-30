<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>R&E-Services</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta content="{{ csrf_token() }}" name="csrf-token" >
  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" />

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
  
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  
    <!-- Vendor CSS Files -->
   <link rel="stylesheet" href="https://redigitalize-production.up.railway.app/assets/vendor/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://redigitalize-production.up.railway.app/assets/vendor/bootstrap-icons/bootstrap-icons.css">
   <link rel="stylesheet" href="https://redigitalize-production.up.railway.app/assets/vendor/boxicons/css/boxicons.min.css">
   <link rel="stylesheet" href="https://redigitalize-production.up.railway.app/assets/vendor/quill/quill.snow.css">
   <link rel="stylesheet" href="https://redigitalize-production.up.railway.app/assets/vendor/quill/quill.bubble.css">
   <link rel="stylesheet" href="https://redigitalize-production.up.railway.app/assets/vendor/remixicon/remixicon.css">
   <link rel="stylesheet" href="https://redigitalize-production.up.railway.app/assets/vendor/simple-datatables/style.css">
   <link rel="stylesheet" href="https://redigitalize-production.up.railway.app/assets/css/style.css">
   <link rel="stylesheet" href="https://redigitalize-production.up.railway.app/css/login.css">
   <link rel="stylesheet" href="https://redigitalize-production.up.railway.app/css/comment.css">
    
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/comment.css') }}" rel="stylesheet">
  
  </head>
  
  <body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ url('/homepage')}}" class="logo d-flex align-items-center">
        <img src="{{ asset('assets/img/RED.png')}}" alt="">
        <span class="d-none d-lg-block">  R&E-Services</span>
      </a> 
    </div><!-- End Logo -->

    <i class="bi bi-list toggle-sidebar-btn"></i>

    @auth
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              @if(Auth::user()->role === 'Student')
                @if($student->avatar === 'avatar.jpg')
                  <img class="rounded-circle" src="https://tse4.mm.bing.net/th?id=OIP.sRdQAfzOzF_ZjC3dnAZVSQHaGw&pid=Api&P=0&h=180" alt=""/>
                @else
                  <img class="rounded-circle" src="{{ asset('storage/'.$student->avatar) }}" alt="" />    
                @endif
              @elseif(Auth::user()->role === 'Staff')
                @if($staff->avatar === 'avatar.jpg')
                  <img class="rounded-circle" src="https://tse4.mm.bing.net/th?id=OIP.sRdQAfzOzF_ZjC3dnAZVSQHaGw&pid=Api&P=0&h=180" alt=""/>
                @else
                  <img class="rounded-circle" src="{{ asset('storage/'.$staff->avatar) }}" alt="" />    
                @endif
              @elseif(Auth::user()->role === 'Faculty')
                @if($faculty->avatar === 'avatar.jpg')
                  <img class="rounded-circle" src="https://tse4.mm.bing.net/th?id=OIP.sRdQAfzOzF_ZjC3dnAZVSQHaGw&pid=Api&P=0&h=180" alt=""/>
                @else
                  <img class="rounded-circle" src="{{ asset('storage/'.$faculty->avatar) }}" alt="" />    
                @endif
              @elseif(Auth::user()->role === 'Admin')
                @if($admin->avatar === 'avatar.jpg')
                  <img class="rounded-circle" src="https://tse4.mm.bing.net/th?id=OIP.sRdQAfzOzF_ZjC3dnAZVSQHaGw&pid=Api&P=0&h=180" alt=""/>
                @else
                  <img class="rounded-circle" src="{{ asset('storage/'.$admin->avatar) }}" alt="" />    
                @endif
              @endif
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->lname .', '. Auth::user()->fname }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ Auth::user()->fname . ' ' . Auth::user()->lname . ' ' . Auth::user()->mname}}</h6>
              <span>{{ Auth::user()->role }}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              @if(Auth::user()->role == 'Student') 
              <a class="dropdown-item d-flex align-items-center" href="{{ url('Student/Profile/{id}') }}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
              @elseif(Auth::user()->role == 'Staff')
              <a class="dropdown-item d-flex align-items-center" href="{{ url('Staff/Profile/{id}') }}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
              @elseif(Auth::user()->role == 'Faculty')
              <a class="dropdown-item d-flex align-items-center" href="{{ url('faculty/profile/{id}') }}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
              @elseif(Auth::user()->role == 'Admin')
              <a class="dropdown-item d-flex align-items-center" href="{{ url('Admin/Profile/{id}') }}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
              @endif
            </li>
            
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ url('/logoutss') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();" >
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
              <form id="logout-form" action="{{ url('/logoutss') }}" method="POST" class="d-none">
                @csrf
            </form>
            </li>

          </ul><!-- End Profile Dropdown Items -->

        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->
    @endauth
    
   
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      @guest
      <li class="nav-item">
        <a class="nav-link " href="{{url('/homepage')}}">
          <i class="bi bi-house-door"></i>
          <span>Home</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{ route('login') }}">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{ url('/CreateAccount')}}">
          <i class="bi bi-person-plus"></i>
          <span>Create Account</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{ url('/Contact')}}">
          <i class="bi bi-patch-question"></i>
          <span>About Us</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{ url('/Contact')}}">
          <i class="bi bi-envelope"></i>
          <span>Contact Us</span>
        </a>
      </li>
      
      @else
      @if(Auth::user()->role == 'Student')
      <li class="nav-item">
        <a class="nav-link " href="{{url('/homepage')}}">
          <i class="bi bi-house-door"></i>
          <span>Home</span>
        </a>
      </li>   
      <li class="nav-item">
        <a class="nav-link " href="{{url('/student/myfiles')}}">
          <i class="bi bi-folder"></i>
          <span>My Files</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/apply/certification')}}">
          <i class="bi bi-award"></i>
          <span>Certification</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/application/status')}}">
          <i class="bi bi-file-earmark-bar-graph"></i>
          <span>Application Status</span>
        </a>
      </li>

      @elseif(Auth::user()->role == 'Staff')
      <li class="nav-item">
        <a class="nav-link " href="{{url('/homepage')}}">
          <i class="bi bi-house-door"></i>
          <span>Home</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('announcements')}}">
          <i class="bi bi-megaphone"></i>
          <span>Announcements</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/events')}}">
          <i class="bi bi-calendar-event"></i>
          <span>Events</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/staff/myfiles')}}">
          <i class="bi bi-folder"></i>
          <span>My Files</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/staff/apply/certification')}}">
          <i class="bi bi-award"></i>
          <span>Certification</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/staff/application/status')}}">
          <i class="bi bi-file-earmark-bar-graph"></i>
          <span>Application Status</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/staff/citation')}}">
          <i class="bi bi-chat-quote-fill"></i>
          <span>Citation References</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/applicationlist')}}">
          <i class="bi bi-journal-bookmark"></i>
          <span>Research Applications</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('certificate/tracking')}}">
          <i class="bi bi-ui-checks"></i>
          <span>Certificate Tracking</span>
        </a>
      </li>

      @elseif(Auth::user()->role == 'Faculty')
      <li class="nav-item">
        <a class="nav-link " href="{{url('/homepage')}}">
          <i class="bi bi-house-door"></i>
          <span>Home</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/faculty/myfiles')}}">
          <i class="bi bi-folder"></i>
          <span>My Files</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/faculty/apply/certification')}}">
          <i class="bi bi-award"></i>
          <span>Certification</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/faculty/application/status')}}">
          <i class="bi bi-file-earmark-bar-graph"></i>
          <span>Application Status</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/faculty/student-applications')}}">
          <i class="bi bi-file-earmark-person"></i>
          <span>Students Application</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/faculty/citation')}}">
          <i class="bi bi-chat-quote-fill"></i>
          <span>Citation References</span>
        </a>
      </li>

      @elseif(Auth::user()->role == 'Admin')
      <li class="nav-item">
        <a style="background-color: {{ Request::is('homepage') ? '#700117' : '#c9c7c8' }};
                  color: {{ Request::is('homepage') ? 'white' : 'black' }}" 
           class="nav-link" href="{{ url('/homepage') }}">
            <i class="bi bi-house-door" style="color: {{ Request::is('homepage') ? 'white' : '#700117' }}"></i>
            <span>Home</span>
        </a>
      </li>
    
      <li class="nav-item">
        <a class="nav-link " href="{{url('/dashboard')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/administration')}}">
          <i class="bi bi-person-fill-gear"></i>
          <span>Administration</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people-fill"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('/studentlist')}}">
              <i class="bi bi-circle"></i><span>Student</span>
            </a>
          </li>
          <li>
            <a href="{{url('/stafflist')}}">
              <i class="bi bi-circle"></i><span>Staff</span>
            </a>
          </li>
          <li>
            <a href="{{url('/facultylist')}}">
              <i class="bi bi-circle"></i><span>Faculty Member</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/admin/departmentlist')}}">
          <i class="bi bi-person-lines-fill"></i>
          <span>Departments</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('announcements')}}">
          <i class="bi bi-megaphone"></i>
          <span>Announcements</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/events')}}">
          <i class="bi bi-calendar-event"></i>
          <span>Events</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/applicationlist')}}">
          <i class="bi bi-journal-bookmark"></i>
          <span>Research Applications</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('certificate/tracking')}}">
          <i class="bi bi-ui-checks"></i>
          <span>Certificate Tracking</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{url('/researchlist')}}">
          <i class="bi bi-file-earmark-check"></i>
          <span>Research List</span>
        </a>
      </li>
      @endif
      @endguest

    </ul>

  </aside><!-- End Sidebar-->
  
  <main id="main" class="main">
    <div class="card" id="spinnerCard" style="display: none;">
      <div class="card-body">
          <h5 class="card-title">Loading...</h5>
          <p>Please wait while we fetch the data.</p>
  
          <!-- Growing spinner -->
          <div class="spinner-grow" role="status">
              <span class="visually-hidden">Loading...</span>
          </div><!-- End Growing spinner -->
      </div>
    </div>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.all.min.js"></script>
  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{ asset('assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{ asset('js/custom.js')}}"></script>

  <script src="https://redigitalize-production.up.railway.app/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="https://redigitalize-production.up.railway.app/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://redigitalize-production.up.railway.app/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="https://redigitalize-production.up.railway.app/assets/vendor/echarts/echarts.min.js"></script>
  <script src="https://redigitalize-production.up.railway.app/assets/vendor/quill/quill.min.js"></script>
  <script src="https://redigitalize-production.up.railway.app/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="https://redigitalize-production.up.railway.app/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="https://redigitalize-production.up.railway.app/assets/vendor/php-email-form/validate.js"></script>
  <script src="https://redigitalize-production.up.railway.app/js/custom.js"></script>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/moment@2.27.0/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js')}}"></script>
  
</body>
</html>
<script>
  $(document).ready(function () {
    var SITEURL = "{{url('/')}}";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var calendar = $('#calendar').fullCalendar({
        editable: true,
        events: SITEURL + "/events",
        displayEventTime: false, // Set to false to hide the event time
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listWeek' // Add listWeek for list view
        },
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }

            // Format start and end times (show only time portion)
            var startTime = event.start.format('HH:mm');
            var endTime = event.end.format('HH:mm');

            // Display title, start time, and end time
            element.find('.fc-title').html(event.title + '<br>' + startTime + ' - ' + endTime);
        },
        selectable: true,
        selectHelper: true,
        eventDrop: function (event, delta) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            $.ajax({
                url: SITEURL + '/fullcalendars/update',
                data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                type: "POST",
                success: function (response) {
                    setTimeout(function() {
                        window.location.href = '/events';
                    }, 1500);
                    Swal.fire(
                        'Updated!',
                        'Event Updated.',
                        'success'
                    )
                }
            });
        },
        eventClick: function (event) {
            if (event.url) {
                window.open(event.url);
                return false;
            }
            var eventData = "Event Title: " + event.title + "<br>" +
                "Start Time: " + event.start.format("YYYY-MM-DD HH:mm:ss") + "<br>" +
                "End Time: " + event.end.format("YYYY-MM-DD HH:mm:ss");

            Swal.fire({
                title: 'Event Details',
                html: eventData,
                icon: 'info',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        }
    });
});

function displayMessage(message) {
    $(".response").html("<div class='success'>"+message+"</div>");
    setInterval(function() { $(".success").fadeOut(); }, 1000);
}

</script>