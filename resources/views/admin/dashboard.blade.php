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
              <div class="card info-card red-card">
                  <div class="filter">
                      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                          <li class="dropdown-header text-start">
                              <h6>Filter</h6>
                          </li>
                          <li><a class="dropdown-item filter-options" data-filter="applications" href="#">All</a></li>
                          <li><a class="dropdown-item filter-options" data-filter="pending" href="#">Pending</a></li>
                          <li><a class="dropdown-item filter-options" data-filter="passed" href="#">Passed</a></li>
                          <li><a class="dropdown-item filter-options" data-filter="returned" href="#">Returned</a></li>
                      </ul>
                  </div>
          
                  <div id="application-table" class="card-body">
                    <h5 class="card-title">Applications <span id="filterTexts">| All</span></h5>
                      <div class="d-flex align-items-center">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-file-earmark-pdf"></i>
                          </div>
                          <div class="ps-3">
                              <h6 id="applicationCount">{{$applicationCount}}</h6>
                          </div>
                      </div>
                  </div>
              </div>
            </div>

            <div class="col-xxl-4 col-md-4">
                <div class="card info-card blue-card">
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
                      <h5 class="card-title">Researchs <span id="filterText">| All</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <div class="ps-3">
                                <h6 id="userCount">{{$usersCount}}</h6>
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

  $(document).ready(function() {
      // Initial display (All users count)
      displayApplicationCount('applications');

      // Event handler for filter options
      $('.filter-options').click(function() {
          var filterValue = $(this).data('filter');
          displayApplicationCount(filterValue);
      });
  });

  function displayApplicationCount(filter) {
      var count;

      // Determine the count based on the selected filter
      switch (filter) {
          case 'applications':
              count = {{$applicationCount}};
              break;
          case 'pending':
              count = {{$pendingCount}};
              break;
          case 'passed':
              count = {{$passedCount}};
              break;
          case 'returned':
              count = {{$returnedCount}};
              break;
          default:
              count = 0;
      }

      // Update the user count
      $('#applicationCount').text(count);

      // Update the filter text
      var filterTexts;
      switch (filter) {
          case 'applications':
              filterText = 'All';
              break;
          case 'pending':
              filterText = 'Pending';
              break;
          case 'passed':
              filterText = 'Passed';
              break;
          case 'returned':
              filterText = 'Returned';
              break;
          default:
              filterText = '';
      }
      $('#filterTexts').text('| ' + filterText);
  }
</script>

