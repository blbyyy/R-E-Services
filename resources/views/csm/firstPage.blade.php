@extends('layouts.navigation')
<main id="main" class="main">

    <div class="card mb-3">
        <div class="card-body">
            <h4 class="card-title">Client Satisfaction Measurement (CSM)</h4>
            <p>
                We would like to know what you think about the services TUP-Taguig provides, 
                so we can make sure we are meeting your needs and improve our work. 
                All personal information you provided and your responses will remain confidential and anonymous, 
                and shall be disclosed only to the extent authorized by law. Thank you for your time!
            </p>

        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h4 class="card-title"></h4>

            <form class="row g-3" method="POST" action="{{route('form.submit1')}}" enctype="multipart/form-data">
                @csrf
                <div class="col-12">
                    <label for="email" class="form-label">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Your Email">
                </div>
            
                <div class="col-12">
                    <label for="office" class="form-label">Office Being Rated:</label>
                    <select name="office" class="form-select" id="office">
                        <option selected>--- Select Office ---</option>
                        <option value="Extension Office">Extension Office</option>
                        <option value="Research Office">Research Office</option>
                    </select>
                </div>
            
                <div class="col-12">
                    <label for="date" class="form-label">Date:</label>
                    <input type="date" class="form-control" id="date" name="date">
                </div>
            
                <div class="col-12">
                    <label for="time" class="form-label">Time:</label>
                    <input type="time" class="form-control" id="time" name="time">
                </div>
            
                <div class="col-12">
                    <label for="email_address" class="form-label">Email Address:</label>
                    <input type="text" class="form-control" id="email_address" name="email_address" placeholder="Your Answer">
                </div>
            
                <div class="col-12">
                    <label for="name" class="form-label">Name (Optional):</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Answer">
                </div>
            
                <div class="col-12">
                    <label for="type" class="form-label">Are you a/an?</label>
                    <select name="type" class="form-select" id="type">
                        <option selected>--- Select ---</option>
                        <option value="Student">Student</option>
                        <option value="Employee">Employee</option>
                        <option value="Alumni">Alumni</option>
                    </select>
                </div>
            
                <div class="col-12">
                    <label for="purpose" class="form-label">Purpose of Transaction:</label>
                    <input type="text" class="form-control" id="purpose" name="purpose" placeholder="Your Answer">
                </div>
            
                <div class="col-12">
                    <label for="assisted_by" class="form-label">Name of specific person who assisted you in your transaction:</label>
                    <input type="text" class="form-control" id="assisted_by" name="assisted_by" placeholder="Your Answer">
                </div>
            
                <div class="col-12" style="padding-top: 20px">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-outline-dark">Next</button>
                        <button type="reset" class="btn btn-outline-dark ms-2">Reset</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>

</main>