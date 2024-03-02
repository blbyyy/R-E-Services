<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>R&E-Services</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta content="{{ csrf_token() }}" name="csrf-token" >
  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>

    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
  
  
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  

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

    <div class="card mb-3" style="margin: 30px">
      <div class="row g-0">
        <div class="col-md-2">
          <img src="{{ asset('assets/img/RED.png')}}" alt="" style="width: 200px; margin: 20px;l">
        </div>

        <div class="col-md-10" style="padding-top: 20px">
          <div class="card-body">
            
            <h5 class="card-title">Certifacate Details</h5>
              <hr style="border-width: 10px; color: maroon;">
                  <p class="card-text" style="font-style: italic">
                      "This certificate officially confirms ownership of "<b>{{$certificate->research_title}}</b>", 
                      while also providing assurance that the document has been either approved through 
                      evaluation or subjected to a similarity check, such as those conducted by Turnitin."
                  </p>
              <hr style="border-width: 10px; color: maroon;">
        
          </div>
        </div>

        <div class="col-md-4">
          <div class="card-body text-center">
            <h5 class="card-title">End Date of Processing:</h5>
            <p class="card-text" style="font-weight: bold">
              {{ \Carbon\Carbon::parse($certificate->date_processing_end)->format('F d, Y') }}
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-body text-center">
            <h5 class="card-title">Control ID:</h5>
            <p class="card-text" style="font-weight: bold">
              {{$certificate->control_id}}
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-body text-center">
            <h5 class="card-title">Type of Research:</h5>
            <p class="card-text" style="font-weight: bold">
              {{$certificate->thesis_type}}
            </p>
          </div>
        </div>
        
        <div class="col-md-12">
          <div class="card-body">
            <hr style="border-width: 10px; color: maroon; ">
          </div>
        </div>

        <div class="col-md-4">
          <div class="card-body text-center">
            <h5 class="card-title">Submission Frequency:</h5>
            <p class="card-text" style="font-weight: bold">
              {{$certificate->submission_frequency}}
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-body text-center">
            <h5 class="card-title">Initial Similarity:</h5>
            <p class="card-text" style="font-weight: bold">
              {{$certificate->initial_simmilarity_percentage}}%
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-body text-center">
            <h5 class="card-title">Similarity Percentage Result:</h5>
            <p class="card-text" style="font-weight: bold">
              {{$certificate->simmilarity_percentage_results}}%
            </p>
          </div>
        </div>

        <div class="col-md-12">
          <div class="card-body">
            <hr style="border-width: 10px; color: maroon; ">
          </div>
        </div>

        <div class="col-md-6">
          <div class="card-body text-center">
            <h5 class="card-title">Requestor Name & Email:</h5>
            <p class="card-text" style="font-weight: bold">
              {{$certificate->requestor_name}}<br>
              {{$certificate->email_address}}
            </p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card-body text-center">
            <h5 class="card-title">Other Researcher:</h5>
            <p class="card-text" style="font-weight: bold">
              @for ($i = 1; $i <= 8; $i++)
                  @php
                      $researcherName = "researchers_name$i";
                  @endphp
                  @if ($certificate->$researcherName != null)
                      {{ $certificate->$researcherName }}<br>
                  @else 
                      {{ $certificate->$researcherName }}
                  @endif
              @endfor




    
            </p>
          </div>
        </div>

        <div class="col-md-12">
          <div class="card-body">
            <hr style="border-width: 10px; color: maroon; ">
          </div>
        </div>

      </div>
    </div>
    

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
 
  <script src="{{ asset('assets/js/main.js')}}"></script>
  
</body>
</html>
