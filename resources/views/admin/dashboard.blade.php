@extends('layouts.navigation')
<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
  
              
              <div class="col-xxl-4 col-md-4">
                <div class="card info-card black-card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>
                            <li><a class="dropdown-item filter-option" data-filter="all" href="#">All</a></li>
                            <li><a class="dropdown-item filter-option" data-filter="student" href="#">Student</a></li>
                            <li><a class="dropdown-item filter-option" data-filter="staff" href="#">Staff</a></li>
                            <li><a class="dropdown-item filter-option" data-filter="faculty" href="#">Faculty Member</a></li>
                        </ul>
                    </div>
            
                    <div id="users-table" class="card-body">
                      <h5 class="card-title">Users <span id="filterText">| All</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="ps-3">
                                <h6 id="userCount">{{$usersCount}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
  
              <div class="col-xxl-4 col-md-4">
                <div class="card info-card black-card">
                  <div class="card-body">
                    <h5 class="card-title">Applications</h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-file-earmark-text"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{$applicationCount}}</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
  
              <div class="col-xxl-4 col-xl-4">
                <div class="card info-card blue-card">
                  <div class="card-body">
                    <h5 class="card-title">Pending Applications</h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-clipboard-x"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{$pendingCount}}</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-xxl-4 col-md-4">
                <div class="card info-card green-card">  
                  <div class="card-body">
                    <h5 class="card-title">Passed Application</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-clipboard-check"></i>
                        </div>
                      <div class="ps-3">
                        <h6>{{$passedCount}}</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- End Customers Card -->

              <div class="col-xxl-4 col-xl-4">
                <div class="card info-card red-card">
                  <div class="card-body">
                    <h5 class="card-title">Returned Applications</h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-clipboard-x"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{$returnedCount}}</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </section>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
      // Initial display (All users count)
      displayUserCount('all');

      // Event handler for filter options
      $('.filter-option').click(function() {
          var filterValue = $(this).data('filter');
          displayUserCount(filterValue);
      });
  });

  function displayUserCount(filter) {
      var count;

      // Determine the count based on the selected filter
      switch (filter) {
          case 'all':
              count = {{$usersCount}};
              break;
          case 'student':
              count = {{$studentCount}};
              break;
          case 'staff':
              count = {{$staffCount}};
              break;
          case 'faculty':
              count = {{$facultyCount}};
              break;
          default:
              count = 0;
      }

      // Update the user count
      $('#userCount').text(count);

      // Update the filter text
      var filterText;
      switch (filter) {
          case 'all':
              filterText = 'All';
              break;
          case 'student':
              filterText = 'Student';
              break;
          case 'staff':
              filterText = 'Staff';
              break;
          case 'faculty':
              filterText = 'Faculty Member';
              break;
          default:
              filterText = '';
      }
      $('#filterText').text('| ' + filterText);
  }
</script>

