@extends('layouts.navigation')
@include('sweetalert::alert')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<main id="main" class="main">

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

    <div class="card mb-3">
        <div class="card-body">
            <h4 class="card-title">R&E-Services</h4>
            <div class="row">
                <div class=" col-md-12 text-center">
                    <img src="{{ asset('assets/img/RED.png')}}" alt="" style="width: 15%">
                </div>
                <div class=" col-md-12 text-center" style="padding-top: 50px; padding-bottom: 50px;">
                    <i>
                        "Thank you for taking the time to share your feedback with us! Your satisfaction is our priority, 
                        and we're thrilled to hear about your positive experience. 
                        We value your input and look forward to serving you even better in the future. 
                        If you have any further comments or suggestions, please don't hesitate to reach out. Have a fantastic day!"
                    </i>
                </div>
            </div>
        </div>
    </div>

</main>
