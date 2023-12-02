@extends('layouts.navigation')
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
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Research List</h5>
          
            <a href="{{url('/add/research')}}">
              <button type="button" class="btn btn-primary">
                <i class="bi bi-person-plus"></i>
                Add Research 
              </button>
            </a>

            <hr>

            <fieldset class="row mb-3">
              <legend class="col-form-label col-sm-2 pt-0">Filter By:</legend>
              <div class="col-sm-12">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="search" id="searchbar" value="option1">
                  <label class="form-check-label" for="searchbar">
                    Search Bar
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="search" id="departments" value="option2">
                  <label class="form-check-label" for="departments">
                    Department
                  </label>
                </div>
                <div class="form-check disabled">
                  <input class="form-check-input" type="radio" name="search" id="courses" value="option3">
                  <label class="form-check-label" for="courses">
                    Course
                  </label>
                </div>
            </fieldset>

            <div id="courseForm" class="col-md-6" style="display: none;">
              <select name="coursesearch" class="form-select" id="coursesearch" aria-label="State">
                      <option value="CHOOSE.....">Choose Course</option>
                      <option value="All">All</option>
                      <option value="BSIT">BSIT</option>
                      <option value="ECE">ECE</option>
                      <option value="BSCE">BSCE</option>
                      <option value="BSME">BSME</option>
              </select>
            </div>

            <div id="deptForm" class="col-md-6" style="display: none;">
              <select name="deptsearch" class="form-select" id="deptsearch" aria-label="State">
                      <option value="CHOOSE.....">Choose Department</option>
                      <option value="All">All</option>
                      <option value="EAAD">EAAD</option>
                      <option value="CAAD">CAAD</option>
                      <option value="MAAD">MAAD</option>
                      <option value="BSAD">BSAD</option>
              </select>
            </div>
 
            <div id="searchForm" class="row g-3" style="display: none;">
              <div class="col-md-6">
                <input type="text" id="searchtype" name="searchtype" class="form-control" placeholder="">
              </div>
              <div class="col-md-2">
                <button type="submit" class="btn btn-outline-dark addcommentBtn"><i class="bi bi-search"></i> Search</button>
              </div>
            </div>

            <hr>

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
              <!-- "No Data" message inside the table -->
              <tfoot id="noDataMessage" style="display: none;">
                  <tr>
                    <td colspan="6" class="text-center" style="padding-top: 20px; padding-bottom: 20px">
                      <h5 class="icon"><i class="bi bi-journal-x"></i> No Data</h5>
                  </td>
                  </tr>
              </tfoot>
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
              
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label ">Faculty Adviser 1</div>
                                  <div id="facultyadviser1" class="col-lg-9 col-md-8"></div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label ">Faculty Adviser 2</div>
                                  <div id="facultyadviser2" class="col-lg-9 col-md-8"></div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label ">Faculty Adviser 3</div>
                                  <div id="facultyadviser3" class="col-lg-9 col-md-8"></div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label ">Faculty Adviser 4</div>
                                  <div id="facultyadviser4" class="col-lg-9 col-md-8"></div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label ">Researcher 1</div>
                                  <div id="researchers1" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Researcher 2</div>
                                  <div id="researchers2" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Researcher 3</div>
                                  <div id="researchers3" class="col-lg-9 col-md-8"></div>
                                </div>
                                
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label ">Researcher 4</div>
                                  <div id="researchers4" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label">Researcher 5</div>
                                  <div id="researchers5" class="col-lg-9 col-md-8"></div>
                                </div>

                                <div class="row">
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

                        <input type="text" class="form-control" id="research_edit_id" name="research_edit_id" hidden>
                        
                        <div class="col-12">
                          <div class="form-floating">
                            <textarea name="research_title" class="form-control" placeholder="Research Title" id="research_title" style="height: 100px;"></textarea>
                            <label for="research_title">Research Title</label>
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
                                <option value="EAAD">EAAD</option>
                                <option value="CAAD">CAAD</option>
                                <option value="MAAD">MAAD</option>
                                <option value="BSAD">BSAD</option>
                            </select>
                            <label for="department">Department</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" name="course" class="form-control" id="course" placeholder="Course">
                            <label for="course">Course</label>
                          </div>
                      </div>
          
                      <div class="col-md-6">
                        <div class="form-floating">
                          <input type="text" name="faculty_adviser1" class="form-control" id="faculty_adviser1" placeholder="Faculty Adviser 1">
                          <label for="faculty_adviser1">Faculty Adviser 1</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" name="faculty_adviser2" class="form-control" id="faculty_adviser2" placeholder="Faculty Adviser 2">
                            <label for="faculty_adviser2">Faculty Adviser 2</label>
                          </div>
                      </div>
                      
                      <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" name="faculty_adviser3" class="form-control" id="faculty_adviser3" placeholder="Faculty Adviser 3">
                            <label for="faculty_adviser3">Faculty Adviser 3</label>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" name="faculty_adviser4" class="form-control" id="faculty_adviser4" placeholder="Faculty Adviser 4">
                            <label for="faculty_adviser4">Faculty Adviser 4</label>
                          </div>
                      </div>
          
                      <div class="col-md-6">
                        <div class="form-floating">
                          <input type="text" name="researcher1" class="form-control" id="researcher1" placeholder="Researcher 1">
                          <label for="researcher1">Researcher 1</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" name="researcher2" class="form-control" id="researcher2" placeholder="Researcher 2">
                            <label for="researcher">Researcher 2</label>
                          </div>
                      </div>
          
                      <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" name="researcher3" class="form-control" id="researcher3" placeholder="Researcher 3">
                            <label for="researcher3">Researcher 3</label>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" name="researcher4" class="form-control" id="researcher4" placeholder="Researcher 4">
                            <label for="researcher4">Researcher 4</label>
                          </div>
                      </div>
          
                      <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" name="researcher5" class="form-control" id="researcher5" placeholder="Researcher 5">
                            <label for="researcher5">Researcher 5</label>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" name="researcher6" class="form-control" id="researcher6" placeholder="Researcher 6">
                            <label for="researcher6">Researcher 6</label>
                          </div>
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

            // Hide all forms
            $('#searchForm, #deptForm, #courseForm').hide();

            // Show the corresponding form based on the selected radio button
            if (selectedValue === 'option1') {
                $('#searchForm').show();
            } else if (selectedValue === 'option2') {
                $('#deptForm').show();
            } else if (selectedValue === 'option3') {
                $('#courseForm').show();
            }
        }

        // Attach the handleRadioSelection function to the change event of the radio buttons
        $('input[name="search"]').on('change', handleRadioSelection);

     // SEARCH BAR
     function liveSearch() {
            var searchTerm = $('#searchtype').val().toLowerCase();

            // Loop through each row in the table body
            $('#researchTableBody tr').each(function () {
                var rowText = $(this).text().toLowerCase();

                // If the row contains the search term, show the row; otherwise, hide it
                if (rowText.includes(searchTerm)) {
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

        // Attach the liveSearch function to the input event of the search input
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

</script>