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

            <div class="col-xxl-6 col-md-6">
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
            <div class="col-xxl-6 col-md-6">
                <div class="card info-card blue-card">

                    <a href="{{url('/admin/reserch-proposal/list')}}">
                        <div id="departments-table" class="card-body">
                        <h5 class="card-title">Research Proposals</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-file-earmark-text"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 id="researchCount">{{$researchProposalCount}}</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
   
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Users Daily Count</h5>
                        </div> 
                        <canvas id="dailyUserChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const dailyUserCount = <?php echo json_encode($dailyUserCount); ?>;
                                const labels = dailyUserCount.map(data => data.date);
                                const counts = dailyUserCount.map(data => data.count);
                                const admin = <?php echo json_encode($admin); ?>;
            
                                new Chart(document.querySelector('#dailyUserChart'), {
                                    type: 'line',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'User',
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
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Users Monthly Count</h5>
                        </div> 
                        <canvas id="monthlyUserChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const monthlyUserCount = <?php echo json_encode($monthlyUserCount); ?>;
                                const labels = monthlyUserCount.map(data => data.month);
                                const counts = monthlyUserCount.map(data => data.count);
                                const admin = <?php echo json_encode($admin); ?>;
            
                                new Chart(document.querySelector('#monthlyUserChart'), {
                                    type: 'bar',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'User',
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
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Users Yearly Count</h5>
                        </div> 
                        <canvas id="yearlyUserChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const yearlyUserCount = <?php echo json_encode($yearlyUserCount); ?>;
                                const labels = yearlyUserCount.map(data => data.year);
                                const counts = yearlyUserCount.map(data => data.count);
                                const admin = <?php echo json_encode($admin); ?>;
            
                                new Chart(document.querySelector('#yearlyUserChart'), {
                                    type: 'bar',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'User',
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

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Applications Daily Count</h5>
                        </div>

                        <!-- Bar Chart -->
                        <canvas id="dailyApplicationsChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const dailyApplicationsCount = <?php echo json_encode($dailyApplicationsCount); ?>;
                                const labels = dailyApplicationsCount.map(data => data.date);
                                const counts = dailyApplicationsCount.map(data => data.count);
                                new Chart(document.querySelector('#dailyApplicationsChart'), {
                                    type: 'line',
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
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Applications Daily Count</h5>
                        </div>

                        <!-- Bar Chart -->
                        <canvas id="monthlyApplicationsChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const monthlyApplicationsCount = <?php echo json_encode($monthlyApplicationsCount); ?>;
                                const labels = monthlyApplicationsCount.map(data => data.month);
                                const counts = monthlyApplicationsCount.map(data => data.count);
                                new Chart(document.querySelector('#monthlyApplicationsChart'), {
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
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Applications Yearly Count</h5>
                        </div>

                        <!-- Bar Chart -->
                        <canvas id="yearlyApplicationsChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const yearlyApplicationsCount = <?php echo json_encode($yearlyApplicationsCount); ?>;
                                const labels = yearlyApplicationsCount.map(data => data.year);
                                const counts = yearlyApplicationsCount.map(data => data.count);
                                new Chart(document.querySelector('#yearlyApplicationsChart'), {
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

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Research Proposal Daily Count</h5>
                        </div>

                        <!-- Bar Chart -->
                        <canvas id="dailyResearchProposalChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const dailyResearchProposalCount = <?php echo json_encode($dailyResearchProposalCount); ?>;
                                const labels = dailyResearchProposalCount.map(data => data.date);
                                const counts = dailyResearchProposalCount.map(data => data.count);
                                new Chart(document.querySelector('#dailyResearchProposalChart'), {
                                    type: 'line',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Research Proposal',
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
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Research Proposals Monthly Count</h5>
                        </div>

                        <!-- Bar Chart -->
                        <canvas id="monthlyResearchProposalChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const monthlyResearchProposalCount = <?php echo json_encode($monthlyResearchProposalCount); ?>;
                                const labels = monthlyResearchProposalCount.map(data => data.month);
                                const counts = monthlyResearchProposalCount.map(data => data.count);
                                new Chart(document.querySelector('#monthlyResearchProposalChart'), {
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
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Research Proposals Yearly Count</h5>
                        </div>

                        <!-- Bar Chart -->
                        <canvas id="yearlyReseearchProposalChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const yearlyResearchProposalCount = <?php echo json_encode($yearlyResearchProposalCount); ?>;
                                const labels = yearlyResearchProposalCount.map(data => data.year);
                                const counts = yearlyResearchProposalCount.map(data => data.count);
                                new Chart(document.querySelector('#yearlyReseearchProposalChart'), {
                                    type: 'bar',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Research Proposal',
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

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Researches Daily Count</h5>
                        </div>

                        <!-- Bar Chart -->
                        <canvas id="dailyResearchesChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const dailyResearchesCount = <?php echo json_encode($dailyResearchesCount); ?>;
                                const labels = dailyResearchesCount.map(data => data.date);
                                const counts = dailyResearchesCount.map(data => data.count);
                                new Chart(document.querySelector('#dailyResearchesChart'), {
                                    type: 'line',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Researches',
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
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Researches Monthly Count</h5>
                        </div>

                        <!-- Bar Chart -->
                        <canvas id="monthlyResearchesChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const monthlyResearchesCount = <?php echo json_encode($monthlyResearchesCount); ?>;
                                const labels = monthlyResearchesCount.map(data => data.month);
                                const counts = monthlyResearchesCount.map(data => data.count);
                                new Chart(document.querySelector('#monthlyResearchesChart'), {
                                    type: 'bar',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Researches',
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
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Researches Yearly Count</h5>
                        </div>

                        <!-- Bar Chart -->
                        <canvas id="yearlyReseearchesChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const yearlyResearchesCount = <?php echo json_encode($yearlyResearchesCount); ?>;
                                const labels = yearlyResearchesCount.map(data => data.year);
                                const counts = yearlyResearchesCount.map(data => data.count);
                                new Chart(document.querySelector('#yearlyReseearchesChart'), {
                                    type: 'bar',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Researches',
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

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Extension Applications Daily Count</h5>
                        </div>

                        <!-- Bar Chart -->
                        <canvas id="dailyExtensionChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const dailyExtensionCount = <?php echo json_encode($dailyExtensionCount); ?>;
                                const labels = dailyExtensionCount.map(data => data.date);
                                const counts = dailyExtensionCount.map(data => data.count);
                                new Chart(document.querySelector('#dailyExtensionChart'), {
                                    type: 'line',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Extension Applications',
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
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Extension Applications Monthly Count</h5>
                        </div>

                        <!-- Bar Chart -->
                        <canvas id="monthlyExtensionChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const monthlyExtensionCount = <?php echo json_encode($monthlyExtensionCount); ?>;
                                const labels = monthlyExtensionCount.map(data => data.month);
                                const counts = monthlyExtensionCount.map(data => data.count);
                                new Chart(document.querySelector('#monthlyExtensionChart'), {
                                    type: 'bar',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Extension Applications',
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
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Extension Applications Yearly Count</h5>
                        </div>

                        <!-- Bar Chart -->
                        <canvas id="yearlyExtensionChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const yearlyExtensionCount = <?php echo json_encode($yearlyExtensionCount); ?>;
                                const labels = yearlyExtensionCount.map(data => data.year);
                                const counts = yearlyExtensionCount.map(data => data.count);
                                new Chart(document.querySelector('#yearlyExtensionChart'), {
                                    type: 'bar',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Extension Applications',
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

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">CSM (Client Satisfaction Measurement) Daily</h5>
                        </div>

                        <!-- Bar Chart -->
                        <canvas id="dailyCsmChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const dailyCsmCount = <?php echo json_encode($dailyCsmCount); ?>;
                                const labels = dailyCsmCount.map(data => data.date);
                                const counts = dailyCsmCount.map(data => data.count);
                                new Chart(document.querySelector('#dailyCsmChart'), {
                                    type: 'line',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Respondents',
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
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">CSM (Client Satisfaction Measurement) Monthly</h5>
                        </div>

                        <!-- Bar Chart -->
                        <canvas id="monthlyCsmChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const monthlyCsmCount = <?php echo json_encode($monthlyCsmCount); ?>;
                                const labels = monthlyCsmCount.map(data => data.month);
                                const counts = monthlyCsmCount.map(data => data.count);
                                new Chart(document.querySelector('#monthlyCsmChart'), {
                                    type: 'bar',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Respondents',
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
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">CSM (Client Satisfaction Measurement) Yearly</h5>
                        </div>

                        <!-- Bar Chart -->
                        <canvas id="yearlyCsmChart" style="max-height: 400px;"></canvas>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const yearlyCsmCount = <?php echo json_encode($yearlyCsmCount); ?>;
                                const labels = yearlyCsmCount.map(data => data.year);
                                const counts = yearlyCsmCount.map(data => data.count);
                                new Chart(document.querySelector('#yearlyCsmChart'), {
                                    type: 'bar',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Respondents',
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

