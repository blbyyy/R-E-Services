@extends('layouts.navigation')
@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
  .icon{
      font-size: 2em;
      display: flex;
      justify-content: center;
      align-items: center;
      color: maroon;
  }
</style>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Researches</h1>
  </div>

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

  <div class="col-12">
    <button type="button" class="btn btn-dark" onclick="toggleAddResearch()"><i class="bi bi-file-earmark-plus"></i> Add Research</button>
  </div>
  <br>

  <div id="addResearch" class="col-md-12" style="display: none;">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Add Research</h5>
              <form class="row g-3" method="POST" action="{{ route('addresearch') }}">
                @csrf

                <div class="col-12">
                    <div class="form-floating">
                      <textarea name="research_title" class="form-control" placeholder="Research Title" id="research_title" style="height: 100px;"></textarea>
                      <label for="Address">Research Title</label>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-floating">
                      <textarea name="abstract" class="form-control" placeholder="Research Abstract" id="abstract" style="height: 300px;"></textarea>
                      <label for="abstract">Research Abstract</label>
                    </div>
                </div>

                <div class="col-md-6">
                  <div class="form-floating mb-3">
                      <select name="department" class="form-select" id="department" aria-label="State">
                          <option selected>Choose.....</option>
                          <option value="EAAD">Electrical and Allied Department</option>
                          <option value="CAAD">Civil and Allied Department</option>
                          <option value="MAAD">Mechanical and Allied Department</option>
                          <option value="BSAD">Basic Science Arts Department</option>
                      </select>
                      <label for="department">Department</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                      <select name="course" class="form-select" id="course" aria-label="State">
                          <option selected>Choose.....</option>
                          <option value="BSIT">BS in Information Technology</option>
                          <option value="BSEE">BS in Electrical Engineering</option>
                          <option value="BSECE">BS in Electronics Engineering</option>
                          <option value="BSME">BS in Mechanical Engineering</option>
                          <option value="BSCE">BS in Civil Engineering</option>
                          <option value="BSESSDP">BS in Environmental Science</option>
                          <option value="BETAT">BET Major In Automotive Technology</option>
                          <option value="BETCHT">BET Major In Chemical Technology</option>
                          <option value="BETET">BET Major In Electrical Technology</option>
                          <option value="BETEMT">BET Major In Electromechanical Technology</option>
                          <option value="BETELXT">BET Major In Electronics Technology</option>
                          <option value="BETICT">BET Major In Instrumentation and Control Technology</option>
                          <option value="BETMECT">BET Major In Mechatronics Technology</option>
                          <option value="BETDMT">BET Major In Dies & Moulds Technology</option>
                          <option value="BETHVAC">BET Major In Heating, Ventilation, and Airconditioning/Refrigeration Technology</option>
                          <option value="BETNDTT">BET Major In Non-Destructive Testing Technology</option>
                      </select>
                      <label for="course">Course</label>
                  </div>
                </div>

                <div id="additionalFacultyAdviser">
                  <div class="col-md-12">
                    <div class="form-floating">
                        <input name="faculty_adviser1" class="form-control" id="faculty_adviser1" placeholder="Faculty Adviser 1">
                        <label for="faculty_adviser1">Faculty Adviser 1</label>
                    </div>
                  </div>
                </div>
                <div class="d-grid gap-2 mt-3">
                  <button type="button" class="btn btn-outline-dark" id="addFacultyAdviser"><i class="bi bi-plus-lg"></i> Add Faculty Adviser</button>
                </div>

                <div id="additionalResearcher">
                  <div class="col-md-12">
                    <div class="form-floating">
                        <input name="researcher1" class="form-control" id="researcher1" placeholder="Researcher">
                        <label for="researcher1">Researcher 1</label>
                    </div>
                  </div>
                </div>
                <div class="d-grid gap-2 mt-3">
                  <button type="button" class="btn btn-outline-dark" id="addResearcher"><i class="bi bi-plus-lg"></i> Add Researcher</button>
                </div>
                
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="text" name="time_frame" class="form-control" id="time_frame" placeholder="Time Frame">
                      <label for="time_frame">Time Frame</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="date" name="date_completion" class="form-control" id="date_completion" placeholder="Date Completion">
                      <label for="date_completion">Date Completion</label>
                    </div>
                  </div>
                
                <div class="col-12" style="padding-top: 20px">
                  <div class="d-flex justify-content-end">
                      <button type="submit" class="btn btn-outline-dark">Add</button>
                      <button type="reset" class="btn btn-outline-dark ms-2" onclick="toggleFileUploadForm()">Close</button>
                  </div>
              </div>
              </form>
        </div>
    </div>
  </div>

    <form class="row g-3" action="{{ route('research.list') }}" method="GET">
      <div class="col-9">
          <input type="text" class="form-control" name="query">
      </div>
      <div class="col-1">
          <button type="submit" class="btn btn-dark" style="height: 40px; width: 70px;"><i class="bi bi-search"></i></button>
      </div>
      <div class="col-2">
          <a href="{{url('/researchlist')}}">
              <button type="button" class="btn btn-dark"><i class="bi bi-arrow-clockwise"></i> Refresh</button>
          </a>
      </div>
    </form>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Research List</h5>

          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th scope="col">Actions</th>
                      <th scope="col">Research Title</th>
                      <th scope="col">Abstract</th>
                      <th scope="col">Department</th>
                      <th scope="col">Course</th>
                      <th scope="col">Faculty Adviser</th>
                  </tr>
              </thead>
              <tbody id="researchTableBody">
                  @foreach ($researchlist as $researchlists)
                      <tr>
                          <td style="width: 152px">
                              <button data-id="{{$researchlists->id}}" type="button" class="btn btn-info researchshowBtn" data-bs-toggle="modal" data-bs-target="#showresearchinfo"><i class="bi bi-eye"></i></button>
                              <button data-id="{{$researchlists->id}}" type="button" class="btn btn-primary researcheditBtn" data-bs-toggle="modal" data-bs-target="#editresearchinfo"><i class="bi bi-pencil-square"></i></button>
                              <button data-id="{{$researchlists->id}}" type="button" class="btn btn-danger researchdeleteBtn"><i class="bi bi-trash"></i></button>
                          </td>
                          <td>{{$researchlists->research_title}}</td>
                          <td>{{$researchlists->abstract}}</td>
                          <td>{{$researchlists->department}}</td>
                          <td>{{$researchlists->course}}</td>
                          <td style="width: 220px">
                              {{$researchlists->faculty_adviser1}}<br>
                              {{$researchlists->faculty_adviser2}}<br>
                              {{$researchlists->faculty_adviser3}}<br>
                              {{$researchlists->faculty_adviser4}}
                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
          
          <div class="modal fade" id="showresearchinfo" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header" >
                  <h5 class="modal-title" ></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <section class="section profile">
                    <div class="row">
                      <div class="col-xl-4">
                      </div>
              
                      <div class="col-xl-12">
              
                        <div class="card">
                          <div class="card-body pt-3">
                            <div class="tab-content pt-2">
              
                              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Research Title</h5>
                                <p id="researchtitle" class="large fst-italic"></p>
      
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label ">Abstract</div>
                                  <div id="researchabstract" class="col-lg-9 col-md-8"></div>
                                </div>
  
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label ">Department</div>
                                  <div id="researchdepartment" class="col-lg-9 col-md-8"></div>
                                </div>
  
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label ">Course</div>
                                  <div id="researchcourse" class="col-lg-9 col-md-8"></div>
                                </div>
                                
                                <h5 class="card-title">Research Details</h5>
              
                                <div class="row" id="a1">
                                  <div class="col-lg-3 col-md-4 label ">Faculty Adviser 1</div>
                                  <div id="facultyadviser1" class="col-lg-9 col-md-8"></div>
                                </div>
  
                                <div class="row" id="a2">
                                  <div class="col-lg-3 col-md-4 label ">Faculty Adviser 2</div>
                                  <div id="facultyadviser2" class="col-lg-9 col-md-8"></div>
                                </div>
  
                                <div class="row" id="a3">
                                  <div class="col-lg-3 col-md-4 label ">Faculty Adviser 3</div>
                                  <div id="facultyadviser3" class="col-lg-9 col-md-8"></div>
                                </div>
  
                                <div class="row" id="a4">
                                  <div class="col-lg-3 col-md-4 label ">Faculty Adviser 4</div>
                                  <div id="facultyadviser4" class="col-lg-9 col-md-8"></div>
                                </div>
  
                                <div class="row" id="r1">
                                  <div class="col-lg-3 col-md-4 label ">Researcher 1</div>
                                  <div id="researchers1" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row" id="r2">
                                  <div class="col-lg-3 col-md-4 label">Researcher 2</div>
                                  <div id="researchers2" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row" id="r3">
                                  <div class="col-lg-3 col-md-4 label">Researcher 3</div>
                                  <div id="researchers3" class="col-lg-9 col-md-8"></div>
                                </div>
                                
                                <div class="row" id="r4">
                                  <div class="col-lg-3 col-md-4 label ">Researcher 4</div>
                                  <div id="researchers4" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row" id="r5">
                                  <div class="col-lg-3 col-md-4 label">Researcher 5</div>
                                  <div id="researchers5" class="col-lg-9 col-md-8"></div>
                                </div>
  
                                <div class="row" id="r6">
                                  <div class="col-lg-3 col-md-4 label">Researcher 6</div>
                                  <div id="researchers6" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Time Frame</div>
                                  <div id="timeframe" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Date Completion</div>
                                  <div id="datecompletion" class="col-lg-9 col-md-8"></div>
                                </div>
              
                              </div>
                            </div>
                          </div>
                        </div>
              
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

          <div class="modal fade" id="editresearchinfo" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header" >
                  <h5 class="modal-title" >Edit Staff User Information</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"></h5>
        
                      <form id="researchinfoform" class="row g-3" enctype="multipart/form-data">
                        @csrf

                        <input type="text" class="form-control" id="researchEditId" name="researchEditId" hidden>
                        
                        <div class="col-12">
                          <div class="form-floating">
                            <textarea name="researchTitle" class="form-control" placeholder="Research Title" id="researchTitle" style="height: 100px;"></textarea>
                            <label for="researchTitle">Research Title</label>
                          </div>
                      </div>
          
                      <div class="col-12">
                          <div class="form-floating">
                            <textarea name="abstracts" class="form-control" placeholder="Research Abstract" id="abstracts" style="height: 300px;"></textarea>
                            <label for="abstracts">Research Abstract</label>
                          </div>
                      </div>

                      <div class="col-md-6">
                  <div class="form-floating mb-3">
                      <select name="dept" class="form-select" id="dept" aria-label="State">
                          <option >Choose.....</option>
                          <option value="EAAD">Electrical and Allied Department</option>
                          <option value="CAAD">Civil and Allied Department</option>
                          <option value="MAAD">Mechanical and Allied Department</option>
                          <option value="BSAD">Basic Science Arts Department</option>
                      </select>
                      <label for="dept">Department</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                      <select name="researchCourse" class="form-select" id="researchCourse" aria-label="State">
                          <option >Choose.....</option>
                          <option value="BSIT">BS in Information Technology</option>
                          <option value="BSEE">BS in Electrical Engineering</option>
                          <option value="BSECE">BS in Electronics Engineering</option>
                          <option value="BSME">BS in Mechanical Engineering</option>
                          <option value="BSCE">BS in Civil Engineering</option>
                          <option value="BSESSDP">BS in Environmental Science</option>
                          <option value="BETAT">BET Major In Automotive Technology</option>
                          <option value="BETCHT">BET Major In Chemical Technology</option>
                          <option value="BETET">BET Major In Electrical Technology</option>
                          <option value="BETEMT">BET Major In Electromechanical Technology</option>
                          <option value="BETELXT">BET Major In Electronics Technology</option>
                          <option value="BETICT">BET Major In Instrumentation and Control Technology</option>
                          <option value="BETMECT">BET Major In Mechatronics Technology</option>
                          <option value="BETDMT">BET Major In Dies & Moulds Technology</option>
                          <option value="BETHVAC">BET Major In Heating, Ventilation, and Airconditioning/Refrigeration Technology</option>
                          <option value="BETNDTT">BET Major In Non-Destructive Testing Technology</option>
                      </select>
                      <label for="researchCourse">Course</label>
                  </div>
                </div>
          
                      <div class="col-md-6">
                        <div class="form-floating">
                          <input type="text" name="facultyAdviser1" class="form-control" id="facultyAdviser1" placeholder="Faculty Adviser 1">
                          <label for="facultyAdviser1">Faculty Adviser 1</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" name="facultyAdviser2" class="form-control" id="facultyAdviser2" placeholder="Faculty Adviser 2">
                            <label for="facultyAdviser2">Faculty Adviser 2</label>
                          </div>
                      </div>
                      
                      <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" name="facultyAdviser3" class="form-control" id="facultyAdviser3" placeholder="Faculty Adviser 3">
                            <label for="facultyAdviser3">Faculty Adviser 3</label>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" name="facultyAdviserr4" class="form-control" id="facultyAdviser4" placeholder="Faculty Adviser 4">
                            <label for="facultyAdviser4">Faculty Adviser 4</label>
                          </div>
                      </div>
          
                      <div class="col-md-6">
                        <div class="form-floating">
                          <input type="text" name="Researcher1" class="form-control" id="Researcher1" placeholder="Researcher 1">
                          <label for="Researcher1">Researcher 1</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" name="Researcher2" class="form-control" id="Researcher2" placeholder="Researcher 2">
                            <label for="Researcher2">Researcher 2</label>
                          </div>
                      </div>
          
                      <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" name="Researcher3" class="form-control" id="Researcher3" placeholder="Researcher 3">
                            <label for="Researcher3">Researcher 3</label>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" name="Researcher4" class="form-control" id="Researcher4" placeholder="Researcher 4">
                            <label for="Researcher4">Researcher 4</label>
                          </div>
                      </div>
          
                      <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" name="Researcher5" class="form-control" id="Researcher5" placeholder="Researcher 5">
                            <label for="Researcher5">Researcher 5</label>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" name="Researcher6" class="form-control" id="Researcher6" placeholder="Researcher 6">
                            <label for="Researcher6">Researcher 6</label>
                          </div>
                      </div>
          
                        <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" name="timeFrame" class="form-control" id="timeFrame" placeholder="Time Frame">
                            <label for="timeFrame">Time Frame</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-floating">
                            <input type="date" name="dateCompletion" class="form-control" id="dateCompletion" placeholder="Date Completion">
                            <label for="dateCompletion">Date Completion</label>
                          </div>
                        </div>
                       
                        <div >
                          <button  type="submit" class="btn btn-primary researchupdateBtn">Save Changes</button>
                          <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                      </form><!-- End floating Labels Form -->
        
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

</main>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $(document).ready(function () {
    //RADIO BUTTON CONDITION
    function handleRadioSelection() {
            var selectedValue = $("input[name='search']:checked").val();

            $('#deptForm, #courseForm').hide();

            if (selectedValue === 'option2') {
                $('#deptForm').show();
            } else if (selectedValue === 'option3') {
                $('#courseForm').show();
            }
        }

        $('input[name="search"]').on('change', handleRadioSelection);

     // SEARCH BAR
     function liveSearch() {
            var searchTerm = $('#searchtype').val().toLowerCase();

            $('#researchTableBody tr').each(function () {
                var rowText = $(this).text().toLowerCase();

                if (rowText.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            if ($('#researchTableBody tr:visible').length > 0) {
                $('#noDataMessage').hide();
            } else {
                $('#noDataMessage').show();
            }
        }

        $('#searchtype').on('input', liveSearch);

      // SEARCH FROM DEPARTMENT
      $('#deptsearch').change(function () {
          filterTable();
      });

      // Function to filter the table based on selected department
      function filterTable() {
          var selectedDepartment = $('#deptsearch').val().trim().toUpperCase();

          $('#researchTableBody tr').each(function () {
              var departmentColumn = $(this).find('td:eq(3)').text().trim().toUpperCase(); // Adjust the index based on the department column in your table

              if (selectedDepartment === 'ALL' || selectedDepartment === 'CHOOSE.....' || departmentColumn === selectedDepartment) {
                  $(this).show();
              } else {
                  $(this).hide();
              }
          });

          // Show/hide "No Data" message based on the presence of matching rows
          $('#noDataMessage').toggle($('#researchTableBody tr:visible').length === 0);
      }
  });

        //SEARCH BY COURSE
        function performSearch() {
            var searchTerm = $('#searchtype').val().toLowerCase();
            var selectedCourse = $('#coursesearch').val().toLowerCase();

            // Loop through each row in the table body
            $('#researchTableBody tr').each(function () {
                var rowText = $(this).text().toLowerCase();

                // If the row contains the search term and matches the selected course, show the row; otherwise, hide it
                if (rowText.includes(searchTerm) && (selectedCourse === 'all' || rowText.includes(selectedCourse))) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            // Show or hide the "No Data" message based on the search results
            if ($('#researchTableBody tr:visible').length > 0) {
                $('#noDataMessage').hide();
            } else {
                $('#noDataMessage').show();
            }
        }

        // Attach the performSearch function to the input event of the search input and the change event of the course dropdown
        $('#searchtype, #coursesearch').on('input change', performSearch);

        function showFilterBy() {
            document.getElementById('filterBy').style.display = 'block';
        }

        function toggleFilterBy() {
                    var filterBy = document.getElementById('filterBy');
                    if (filterBy.style.display === 'none' || filterBy.style.display === '') {
                      filterBy.style.display = 'block';
                      
                    } else {
                      filterBy.style.display = 'none';
                      $('#deptForm').hide();
                      $('#courseForm').hide();
                      searchBar.style.display = 'block';
                      $('#filterBy input[type="radio"]').prop('checked', false);

                    }
                }

        function showAddResearch() {
            document.getElementById('addResearch').style.display = 'block';
        }

        function toggleAddResearch() {
                    var addResearch = document.getElementById('addResearch');
                    if (addResearch.style.display === 'none' || addResearch.style.display === '') {
                      addResearch.style.display = 'block';
                      
                    } else {
                      addResearch.style.display = 'none';
                    }
                }


    //add faculty adviser
    document.addEventListener('DOMContentLoaded', function () {
        // Initial count of visible input fields
        let adviserCount = 1;

        // Add button click event
        document.getElementById('addFacultyAdviser').addEventListener('click', function () {
            // Increment the count
            adviserCount++;

            // Create a new input field
            const newFacultyAdviserField = document.createElement('div');
            newFacultyAdviserField.innerHTML = `
                <br>
                <div class="col-md-12">
                    <div class="form-floating">
                        <input name="faculty_adviser${adviserCount}" class="form-control" id="faculty_adviser${adviserCount}" placeholder="Faculty Adviser">
                        <label for="faculty_adviser${adviserCount}">Faculty Adviser ${adviserCount}</label>
                    </div>
                </div>
            `;

            // Append the new input field to the container
            document.getElementById('additionalFacultyAdviser').appendChild(newFacultyAdviserField);
        });
    });

    //add researcher adviser
    document.addEventListener('DOMContentLoaded', function () {
        // Initial count of visible input fields
        let researcherCount = 1;

        // Add button click event
        document.getElementById('addResearcher').addEventListener('click', function () {
            // Increment the count
            researcherCount++;

            // Create a new input field
            const newResearcherFields = document.createElement('div');
            newResearcherFields.innerHTML = `
                <br>
                <div class="col-md-12">
                    <div class="form-floating">
                        <input name="researcher${researcherCount}" class="form-control" id="researcher${researcherCount}" placeholder="Researcher">
                        <label for="researcher${researcherCount}">Researcher ${researcherCount}</label>
                    </div>
                </div>
            `;

            // Append the new input field to the container
            document.getElementById('additionalResearcher').appendChild(newResearcherFields);
        });
    });
</script>