@extends('layouts.navigation')
@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<main id="main" class="main">
    <div class="card">
        <div class="card-body" >
          <h5 class="card-title">User Profile Set-up</h5>

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

    <form class="row g-3" action="{{ route('student.fillup-sent') }}" method="POST" enctype="multipart/form-data">
        @csrf  

            <div class="try profile-card pt-4 d-flex flex-column align-items-center">
            @if($student->avatar === 'avatar.jpg')
                <div>
                    <img style="width: 250px; height: 250px;" id="img" class="rounded-circle" src="https://tse4.mm.bing.net/th?id=OIP.sRdQAfzOzF_ZjC3dnAZVSQHaGw&pid=Api&P=0&h=180" />
                </div>
                <div class="col-sm-4" style="display: none; padding-top: 20px" id="avatarForm">
                    <input class="form-control" type="file" id="avatar" name="avatar">
                </div>
                <div class="text-center" style="padding-bottom: 10px; padding-top: 10px">
                <button id="toggleForm" type="button" class="btn btn-outline-dark">Set Avatar</button>
                </div>
                
            @else
                <div>
                    <img style="width: 250px; height: 250px;" id="img" class="rounded-circle" src="{{ asset('storage/'.$student->avatar) }}" />
                </div>
                <div class="col-sm-6" style="display: none; padding-top: 20px" id="avatarForm">
                    <input class="form-control" type="file" id="avatar" name="avatar">
                </div>
                <div class="text-center" style="padding-bottom: 10px; padding-top: 10px">
                <button id="toggleForm" type="button" class="btn btn-outline-dark">Set Avatar</button>
                </div>
            @endif
            </div>
            
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" value="{{$student->lname}}" disabled>
                        <label for="lname">Last Name</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" value="{{$student->fname}}" disabled>
                        <label for="fname">First Name</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="mname" id="mname" placeholder="Middle Name">
                        <label for="mname">Middle Name</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{$student->email}}" disabled>
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="tup_id" id="tup_id" placeholder="TUP ID">
                        <label for="tup_id">TUP ID</label>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="course" id="course" placeholder="Course">
                        <label for="course">Course</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="date" class="form-control" name="birthdate" id="birthdate" placeholder="BirthDate">
                        <label for="birthdate">BirthDate</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone">
                        <label for="phone">Phone</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                        <label for="address">Address</label>
                    </div>
                </div>  
                <div class="col-md-4">
                    <div class="form-floating mb-3">
                        <select class="form-select" name="gender" id="gender" aria-label="State">
                        <option selected>Select Sex</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        </select>
                        <label for="gender">Sex</label>
                    </div>
                </div>
        
                <div class="d-flex justify-content-end align-items-center">
                    <button type="submit" class="btn btn-outline-dark">Save</button>
                </div>
    </form>

        </div>
      </div>
</main>
<script>
    $(document).ready(function () {
          // When the "Change Avatar" button is clicked
          $("#toggleForm").click(function () {
              // Toggle the visibility of the form
              $("#avatarForm").toggle();
          });
  
      let img = document.getElementById('img');
      let input = document.getElementById('avatar');
  
      input.onchange = (e) => {
        if (input.files[0])
        img.src = URL.createObjectURL(input.files[0])
      }
  
    });
</script>