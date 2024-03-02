@extends('layouts.navigation')
@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Citation References</h1>
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
        <button type="button" class="btn btn-dark" onclick="toggleCitationForm()"><i class="bi bi-plus"></i> Add Citation</button>
    </div>
    <br>

    <div id="addCitationForm" class="col-md-12" style="display: none;">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add Citation</h5>
                <form class="row g-3" method="POST" action="{{ route('facultyAddCitation') }}">
                    @csrf
    
                    <div class="col-12">
                        <div class="form-floating">
                          <textarea name="researchTitle" class="form-control" placeholder="Research Title" id="researchTitle" style="height: 100px;"></textarea>
                          <label for="researchTitle">Research Title</label>
                        </div>
                    </div>
    
                    <div class="col-12">
                        <div class="form-floating">
                          <textarea name="conferenceForum" class="form-control" placeholder="Conference/Forum" id="conferenceForum" style="height: 100px;"></textarea>
                          <label for="conferenceForum">Conference/Forum</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="date" name="date" class="form-control" id="date" placeholder="Date">
                            <label for="date">Date</label>
                        </div>
                    </div>
    
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="venue" class="form-control" id="venue" placeholder="Venue">
                            <label for="venue">Venue</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                          <select name="country" class="form-select" id="country" aria-label="State">
                              <option selected>Choose.....</option>
                              <option value="Philippines">Philippines</option>
                              <option value="Kuala Lumpur">Kuala Lumpur</option>
                              <option value="Canada">Canada</option>
                              <option value="Bangkok">Bangkok</option>
                              <option value="Singapore">Singapore</option>
                          </select>
                          <label for="country">County</label>
                      </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="presentation" class="form-control" id="presentation" placeholder="Presentation">
                            <label for="presentation">Presentation</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" name="publication" class="form-control" id="publication" placeholder="Publication">
                            <label for="publication">Publication</label>
                        </div>
                    </div>
    
                    <div id="additionalPresentor">
                      <div class="col-md-12">
                        <div class="form-floating">
                            <input name="presentor1" class="form-control" id="presentor1" placeholder="Presentor 1">
                            <label for="presentor1">Presentor 1</label>
                        </div>
                      </div>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                      <button type="button" class="btn btn-outline-dark" id="addPresentor"><i class="bi bi-plus-lg"></i> Add Presentor</button>
                    </div>
    
                    <div id="additionalAuthor">
                      <div class="col-md-12">
                        <div class="form-floating">
                            <input name="author1" class="form-control" id="author1" placeholder="Author 1">
                            <label for="author1">Author 1</label>
                        </div>
                      </div>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                      <button type="button" class="btn btn-outline-dark" id="addAuthor"><i class="bi bi-plus-lg"></i> Add Author</button>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                          <input type="text" name="document" class="form-control" id="document" placeholder="Document">
                          <label for="document">Document</label>
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

    <div class="card">
        <div class="card-body">
          <h5 class="card-title">Citations List</h5>

          <table class="table table-hover">
            <thead>
              <tr class="text-center">
                <th scope="col">Actions</th>
                <th scope="col">Research Title</th>
                <th scope="col">Date</th>
                <th scope="col">Conference/Forum</th>
                <th scope="col">Venue</th>
                <th scope="col">Country</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($facultyCitation as $facultyCitations)
                    <tr class="text-center">
                        <td>
                            <button data-id="{{$facultyCitations->id}}" type="button" class="btn btn-info citationShowBtn" data-bs-toggle="modal" data-bs-target="#showCitaionInfo"><i class="bi bi-eye"></i></button>
                            <button data-id="{{$facultyCitations->id}}" type="button" class="btn btn-primary citationEditBtn" data-bs-toggle="modal" data-bs-target="#editCitationInfo"><i class="bi bi-pencil-square"></i></button>
                            <button data-id="{{$facultyCitations->id}}" type="button" class="btn btn-danger citationDeleteBtn"><i class="bi bi-trash"></i></button>
                        </td>
                        <td>{{$facultyCitations->researchTitle}}</td>
                        <td>{{$facultyCitations->date}}</td>
                        <td>{{$facultyCitations->conferenceForum}}</td>
                        <td>{{$facultyCitations->venue}}</td>
                        <td>{{$facultyCitations->country}}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>

          <div class="modal fade" id="showCitaionInfo" tabindex="-1">
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
                                <p id="citationResearchTitle" class="large fst-italic"></p>
      
                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label ">Conference Forum</div>
                                  <div id="citationConferenceForum" class="col-lg-9 col-md-8"></div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label ">Date</div>
                                  <div id="citationDate" class="col-lg-9 col-md-8"></div>
                                </div>

                                <div class="row">
                                  <div class="col-lg-3 col-md-4 label ">Venue</div>
                                  <div id="citationVenue" class="col-lg-9 col-md-8"></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Presentation</div>
                                    <div id="citationPresentation" class="col-lg-9 col-md-8"></div>
                                </div>
  
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Publication</div>
                                    <div id="citationPublication" class="col-lg-9 col-md-8"></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Document</div>
                                    <div id="citationDocument" class="col-lg-9 col-md-8"></div>
                                </div>
                                
                                <h5 class="card-title">Other Details</h5>
              
                                <div class="row" id="p1">
                                  <div class="col-lg-3 col-md-4 label ">Presentor 1</div>
                                  <div id="citationPresentor1" class="col-lg-9 col-md-8"></div>
                                </div>

                                <div class="row" id="p2">
                                  <div class="col-lg-3 col-md-4 label ">Presentor 2</div>
                                  <div id="citationPresentor2" class="col-lg-9 col-md-8"></div>
                                </div>

                                <div class="row" id="p3">
                                  <div class="col-lg-3 col-md-4 label ">Presentor 3</div>
                                  <div id="citationPresentor3" class="col-lg-9 col-md-8"></div>
                                </div>

                                <div class="row" id="p4">
                                  <div class="col-lg-3 col-md-4 label ">Presentor 4</div>
                                  <div id="citationPresentor4" class="col-lg-9 col-md-8"></div>
                                </div>

                                <div class="row" id="p5">
                                    <div class="col-lg-3 col-md-4 label ">Presentor 5</div>
                                    <div id="citationPresentor5" class="col-lg-9 col-md-8"></div>
                                  </div>

                                <div class="row" id="a1">
                                  <div class="col-lg-3 col-md-4 label ">Author 1</div>
                                  <div id="citationAuthor1" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row" id="a2">
                                  <div class="col-lg-3 col-md-4 label">Author 2</div>
                                  <div id="citationAuthor2" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row" id="a3">
                                  <div class="col-lg-3 col-md-4 label">Author 3</div>
                                  <div id="citationAuthor3" class="col-lg-9 col-md-8"></div>
                                </div>
                                
                                <div class="row" id="a4">
                                  <div class="col-lg-3 col-md-4 label ">Author 4</div>
                                  <div id="citationAuthor4" class="col-lg-9 col-md-8"></div>
                                </div>
              
                                <div class="row" id="a5">
                                  <div class="col-lg-3 col-md-4 label">Author 5</div>
                                  <div id="citationAuthor5" class="col-lg-9 col-md-8"></div>
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

          <div class="modal fade" id="editCitationInfo" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header" >
                  <h5 class="modal-title" >Edit Citation Information</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"></h5>
        
                      <form id="citationInfoForm" class="row g-3" enctype="multipart/form-data">
                        @csrf

                        <input type="text" class="form-control" id="citationEditId" name="citationEditId" hidden>
                        
                        <div class="col-12">
                            <div class="form-floating">
                              <textarea name="citation_researchTitle" class="form-control" placeholder="Research Title" id="citation_researchTitle" style="height: 100px;"></textarea>
                              <label for="citation_researchTitle">Research Title</label>
                            </div>
                        </div>
        
                        <div class="col-12">
                            <div class="form-floating">
                              <textarea name="citation_conferenceForum" class="form-control" placeholder="Conference/Forum" id="citation_conferenceForum" style="height: 100px;"></textarea>
                              <label for="citation_conferenceForum">Conference/Forum</label>
                            </div>
                        </div>
    
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="date" name="citation_date" class="form-control" id="citation_date" placeholder="Date">
                                <label for="citation_date">Date</label>
                            </div>
                        </div>
        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="citation_venue" class="form-control" id="citation_venue" placeholder="Venue">
                                <label for="citation_venue">Venue</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-floating mb-3">
                              <select name="citation_country" class="form-select" id="citation_country" aria-label="State">
                                  <option selected>Choose.....</option>
                                  <option value="Philippines">Philippines</option>
                                  <option value="Kuala Lumpur">Kuala Lumpur</option>
                                  <option value="Canada">Canada</option>
                                  <option value="Bangkok">Bangkok</option>
                                  <option value="Singapore">Singapore</option>
                              </select>
                              <label for="citation_country">County</label>
                          </div>
                        </div>
    
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="citation_presentation" class="form-control" id="citation_presentation" placeholder="Presentation">
                                <label for="citation_presentation">Presentation</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="citation_publication" class="form-control" id="citation_publication" placeholder="Publication">
                                <label for="citation_publication">Publication</label>
                            </div>
                        </div>
        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input name="citation_presentor1" class="form-control" id="citation_presentor1" placeholder="Presentor 1">
                                <label for="citation_presentor1">Presentor 1</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input name="citation_presentor2" class="form-control" id="citation_presentor2" placeholder="Presentor 1">
                                <label for="citation_presentor2">Presentor 2</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input name="citation_presentor3" class="form-control" id="citation_presentor3" placeholder="Presentor 1">
                                <label for="citation_presentor3">Presentor 3</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input name="citation_presentor4" class="form-control" id="citation_presentor4" placeholder="Presentor 1">
                                <label for="citation_presentor4">Presentor 4</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating">
                                <input name="citation_presentor5" class="form-control" id="citation_presentor5" placeholder="Presentor 1">
                                <label for="citation_presentor5">Presentor 5</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input name="citation_author1" class="form-control" id="citation_author1" placeholder="Author 1">
                                <label for="citation_author1">Author 1</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input name="citation_author2" class="form-control" id="citation_author2" placeholder="Author 1">
                                <label for="citation_author2">Author 2</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input name="citation_author3" class="form-control" id="citation_author3" placeholder="Author 1">
                                <label for="citation_author3">Author 3</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input name="citation_author4" class="form-control" id="citation_author4" placeholder="Author 1">
                                <label for="citation_author4">Author 4</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating">
                                <input name="citation_author5" class="form-control" id="citation_author5" placeholder="Author 1">
                                <label for="citation_author5">Author 5</label>
                            </div>
                        </div>

    
                        <div class="col-md-12">
                            <div class="form-floating">
                              <input type="text" name="citation_document" class="form-control" id="citation_document" placeholder="Document">
                              <label for="citation_document">Document</label>
                            </div>
                        </div>
                       
                        <div >
                          <button  type="submit" class="btn btn-primary citationUpdateBtn">Save Changes</button>
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
    //toggle citation form
    function showCitationForm() {
        document.getElementById('addCitationForm').style.display = 'block';
    }
    function toggleCitationForm() {
                var addCitationForm = document.getElementById('addCitationForm');
                if (addCitationForm.style.display === 'none' || addCitationForm.style.display === '') {
                    addCitationForm.style.display = 'block';
                } else {
                    addCitationForm.style.display = 'none';
                }
    }

    //add presentor
    document.addEventListener('DOMContentLoaded', function () {
        // Initial count of visible input fields
        let presentorCount = 1;

        // Add button click event
        document.getElementById('addPresentor').addEventListener('click', function () {
            // Increment the count
            presentorCount++;

            // Create a new input field
            const newPresentorField = document.createElement('div');
            newPresentorField.innerHTML = `
                <br>
                <div class="col-md-12">
                    <div class="form-floating">
                        <input name="citation_presentor${presentorCount}" class="form-control" id="citation_presentor${presentorCount}" placeholder="Presentor">
                        <label for="citation_presentor${presentorCount}">Presentor ${presentorCount}</label>
                    </div>
                </div>
            `;

            // Append the new input field to the container
            document.getElementById('additionalPresentor').appendChild(newPresentorField);
        });
    });

    //add author
    document.addEventListener('DOMContentLoaded', function () {
        // Initial count of visible input fields
        let authorCount = 1;

        // Add button click event
        document.getElementById('addAuthor').addEventListener('click', function () {
            // Increment the count
            authorCount++;

            // Create a new input field
            const newAuthorFields = document.createElement('div');
            newAuthorFields.innerHTML = `
                <br>
                <div class="col-md-12">
                    <div class="form-floating">
                        <input name="citation_author${authorCount}" class="form-control" id="citation_author${authorCount}" placeholder="Author">
                        <label for="citation_author${authorCount}">Author ${authorCount}</label>
                    </div>
                </div>
            `;

            // Append the new input field to the container
            document.getElementById('additionalAuthor').appendChild(newAuthorFields);
        });
    });
</script>