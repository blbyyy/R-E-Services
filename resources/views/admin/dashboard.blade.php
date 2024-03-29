@extends('layouts.navigation')
<style>
    #printData {
        color: maroon;
    }
</style>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
      </div>
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
                            <li><a class="dropdown-item filter-option" data-filter="all">All</a></li>
                            <li><a class="dropdown-item filter-option" data-filter="student">Student</a></li>
                            <li><a class="dropdown-item filter-option" data-filter="staff">Staff</a></li>
                            <li><a class="dropdown-item filter-option" data-filter="faculty">Faculty Member</a></li>
                        </ul>
                    </div>
                    <a href="{{url('admin/userlist')}}">
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
                    </a>
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
                          <li><a class="dropdown-item filter-options" data-filter="applications">All</a></li>
                          <li><a class="dropdown-item filter-options" data-filter="pending">Pending</a></li>
                          <li><a class="dropdown-item filter-options" data-filter="passed">Passed</a></li>
                          <li><a class="dropdown-item filter-options" data-filter="returned">Returned</a></li>
                      </ul>
                  </div>
          
                <a href="{{url('/admin/applicationlist')}}">
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
                </a>
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
                            <li><a class="dropdown-item filter-optionss" data-filter="departments">All</a></li>
                            <li><a class="dropdown-item filter-optionss" data-filter="eaad">EAAD</a></li>
                            <li><a class="dropdown-item filter-optionss" data-filter="caad">CAAD</a></li>
                            <li><a class="dropdown-item filter-optionss" data-filter="maad">MAAD</a></li>
                            <li><a class="dropdown-item filter-optionss" data-filter="basd">BASD</a></li>
                        </ul>
                    </div>
                    <a href="{{url('/admin/researchlist')}}">
                        <div id="departments-table" class="card-body">
                        <h5 class="card-title">Researches <span id="filterTextss">| All</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-file-earmark-text"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 id="researchCount">{{$researchCount}}</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-xxl-12 col-md-12">
                <div class="card info-card blue-card">

                    <a href="{{url('/admin/extensionlist')}}">
                        <div id="departments-table" class="card-body">
                        <h5 class="card-title">Extension Applications</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-file-earmark-text"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 id="researchCount">{{$extensionCount}}</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Users</h5>
                            <a href="{{url('/userCountTable')}}" class="btn-sm" id="printData">
                                Print Table
                                <i class="bi bi-arrow-right-circle"></i>
                            </a>
                        </div> 
                        <canvas id="rolesChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const rolesCount = <?php echo json_encode($rolesCount); ?>;
                                const labels = rolesCount.map(data => data.role);
                                const counts = rolesCount.map(data => data.count);
                                const admin = <?php echo json_encode($admin); ?>;
            
                                new Chart(document.querySelector('#rolesChart'), {
                                    type: 'line',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Users Count by Role',
                                            data: counts,
                                            fill: false,
                                            borderColor: 'rgb(75, 192, 192)',
                                            tension: 0.1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Applications</h5>
                            <a href="{{url('/applicationsCountTable')}}" class="btn-sm" id="printData">
                                Print Table
                                <i class="bi bi-arrow-right-circle"></i>
                            </a>
                        </div>

                        <!-- Bar Chart -->
                        <canvas id="applicationsChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const applicationsCount = <?php echo json_encode($applicationsCount); ?>;
                                const labels = applicationsCount.map(data => data.status);
                                const counts = applicationsCount.map(data => data.count);
                                new Chart(document.querySelector('#applicationsChart'), {
                                    type: 'bar',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Applications',
                                            data: counts,
                                            backgroundColor: [
                                                'rgba(255, 99, 132, 0.2)',
                                                'rgba(255, 159, 64, 0.2)',
                                                'rgba(255, 205, 86, 0.2)',
                                                'rgba(75, 192, 192, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(153, 102, 255, 0.2)',
                                                'rgba(201, 203, 207, 0.2)'
                                            ],
                                            borderColor: [
                                                'rgb(255, 99, 132)',
                                                'rgb(255, 159, 64)',
                                                'rgb(255, 205, 86)',
                                                'rgb(75, 192, 192)',
                                                'rgb(54, 162, 235)',
                                                'rgb(153, 102, 255)',
                                                'rgb(201, 203, 207)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            });
                        </script>

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Thesis Type Applications</h5>
                            <a href="{{url('/thesisTypeCountTable')}}" class="btn-sm" id="printData">
                                Print Table
                                <i class="bi bi-arrow-right-circle"></i>
                            </a>
                        </div>

                        <canvas id="thesisTypeChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const thesisTypeCount = <?php echo json_encode($thesisTypeCount); ?>;
                                const labels = thesisTypeCount.map(data => data.thesis_type);
                                const counts = thesisTypeCount.map(data => data.count);
                                new Chart(document.querySelector('#thesisTypeChart'), {
                                    type: 'pie',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Thesis Type',
                                            data: counts,
                                            backgroundColor: [
                                                'rgb(255, 99, 132)',
                                                'rgb(54, 162, 235)',
                                                'rgb(255, 205, 86)'
                                                // Add more colors if needed
                                            ],
                                            hoverOffset: 4
                                        }]
                                    }
                                });
                            });
                        </script>

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Course Application Counts</h5>
                            <a href="{{url('/courseCountTable')}}" class="btn-sm" id="printData">
                                Print Table
                                <i class="bi bi-arrow-right-circle"></i>
                            </a>
                        </div>

                        <!-- Doughnut Chart -->
                        <canvas id="applicationCourseChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const courseCount = <?php echo json_encode($courseCount); ?>;
                                const labels = courseCount.map(data => data.course);
                                const counts = courseCount.map(data => data.count);
                                new Chart(document.querySelector('#applicationCourseChart'), {
                                    type: 'doughnut',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Course',
                                            data: counts,
                                            backgroundColor: [
                                                'rgb(255, 99, 132)',
                                                'rgb(54, 162, 235)',
                                                'rgb(255, 205, 86)'
                                                // Add more colors if needed
                                            ],
                                            hoverOffset: 4
                                        }]
                                    }
                                });
                            });
                        </script>
                        <!-- End Doughnut Chart -->

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Department Research Counts</h5>
                            <a href="{{url('/researchesDepartmentCountTable')}}" class="btn-sm" id="printData">
                                Print Table
                                <i class="bi bi-arrow-right-circle"></i>
                            </a>
                        </div>

                        <!-- Bar Chart -->
                        <canvas id="researchDepartmentChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const researchDepartmentCount = <?= json_encode($researchDepartmentCount) ?>;
                                const labels = researchDepartmentCount.map(data => data.department);
                                const counts = researchDepartmentCount.map(data => data.count);
                                
                                new Chart(document.querySelector('#researchDepartmentChart'), {
                                    type: 'bar',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Department',
                                            data: counts,
                                            backgroundColor: [
                                                'rgba(255, 99, 132, 0.2)',
                                                'rgba(255, 159, 64, 0.2)',
                                                'rgba(255, 205, 86, 0.2)',
                                                'rgba(75, 192, 192, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(153, 102, 255, 0.2)',
                                                'rgba(201, 203, 207, 0.2)'
                                            ],
                                            borderColor: [
                                                'rgb(255, 99, 132)',
                                                'rgb(255, 159, 64)',
                                                'rgb(255, 205, 86)',
                                                'rgb(75, 192, 192)',
                                                'rgb(54, 162, 235)',
                                                'rgb(153, 102, 255)',
                                                'rgb(201, 203, 207)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            });
                        </script>
                        <!-- End Bar Chart -->

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Course Research Counts</h5>
                            <a href="{{url('/researchesCourseCountTable')}}" class="btn-sm" id="printData">
                                Print Table
                                <i class="bi bi-arrow-right-circle"></i>
                            </a>
                        </div>

                        <!-- Line Chart -->
                        <canvas id="lineChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const researchCourseCount = <?= json_encode($researchCourseCount) ?>;
                                const labels = researchCourseCount.map(data => data.course);
                                const counts = researchCourseCount.map(data => data.count);

                                new Chart(document.querySelector('#lineChart'), {
                                    type: 'line',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Course',
                                            data: counts,
                                            fill: false,
                                            borderColor: 'rgb(75, 192, 192)',
                                            tension: 0.1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            });
                        </script>
                        <!-- End Line Chart -->

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

  $(document).ready(function() {
      // Initial display (All users count)
      displayDepartmentCount('departments');

      // Event handler for filter options
      $('.filter-optionss').click(function() {
          var filterValue = $(this).data('filter');
          displayDepartmentCount(filterValue);
      });
  });

  function displayDepartmentCount(filter) {
      var count;

      // Determine the count based on the selected filter
      switch (filter) {
          case 'departments':
              count = {{$researchCount}};
              break;
          case 'eaad':
              count = {{$eaadResearchCount}};
              break;
          case 'maad':
              count = {{$maadResearchCount}};
              break;
          case 'caad':
              count = {{$caadResearchCount}};
              break;
          case 'basd':
              count = {{$basdResearchCount}};
              break;
          default:
              count = 0;
      }

      // Update the user count
      $('#researchCount').text(count);

      // Update the filter text
      var filterTexts;
      switch (filter) {
        case 'departments':
              filterText = 'All';
              break;
        case 'eaad':
              filterText = 'EAAD';
              break;
        case 'caad':
              filterText = 'CAAD';
              break;
        case 'maad':
              filterText = 'MAAD';
              break;
        case 'basd':
              filterText = 'BASD';
              break;
          default:
              filterText = '';
      }
      $('#filterTextss').text('| ' + filterText);
  }
</script>

