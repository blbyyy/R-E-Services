@extends('layouts.navigation')
<main id="main" class="main">
<div class="card">
    <div class="card-header">REDigitalize</div>
    <div class="card-body">
      <h5 class="card-title">Create a User Profile</h5>
      <hr class="thick-hr">
      All users must have a user profile to use the services. Please select how you will be using REDigitalize:
      <br><br>
        <a href="{{ url('Register/Student') }}">
            <span>Student</span>
        </a>
        <br>
        <a href="{{ url('Register/Faculty') }}">
            <span>Faculty Member</span>
        </a>
        <br>
        <a href="{{ url('Register/Staff') }}">
            <span>Staff</span>
        </a>
        <br><br><br>
        <h5>Existing User?</h5>
        <hr class="thick-hr">
        If you've used the service before, there is no requirment to create a new user profile. Log in 
        <a href="{{ route('login') }}">
            <span>here</span>
        </a> 
        with your old credentials.
    </div>

</div>
</main>