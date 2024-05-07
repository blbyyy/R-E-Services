@extends('layouts.navigation')
<main id="main" class="main">

    <div class="card mb-3">
        <div class="card-body">
            <h4 class="card-title">Research and Extension Services Customer Satisfaction Survey Form</h4>
            <p>
                Your response will be of great value to us. Please let us know the level of your contentment on the services we have provided you. 
                This will help us understand your needs as we review and continually improve our services and operations in the Campus.
            </p>

        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h4 class="card-title"></h4>

            <form class="row g-3" method="POST" action="{{route('forms.customer-satisfaction-survey.second-page')}}" enctype="multipart/form-data">
                @csrf
                <div class="col-12">
                    <label for="email" class="form-label">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Your Email" required>
                </div>
            
                <div class="col-12">
                    <label for="rated_department" class="form-label">Office/Department Being Rated:</label>
                    <select name="rated_department" class="form-select" id="rated_department" required>
                        <option selected>--- Select ---</option>
                        <option value="Research and Development Services">Research and Development Services</option>
                        <option value="Community Extension Services">Community Extension Services</option>
                        <option value="Innovation and Technology Support Office">Innovation and Technology Support Office</option>
                    </select>
                </div>

                <div class="col-12">
                    <label for="transaction_purpose" class="form-label">Purpose of Transaction:</label>
                    <select name="transaction_purpose" class="form-select" id="transaction_purpose" required>
                        <option selected>--- Select ---</option>
                        <option value="Consultation / Assistance">Consultation / Assistance</option>
                        <option value="Technology transfer / Patent / Intellectual Property">Technology transfer / Patent / Intellectual Property</option>
                        <option value="Certificate of Similarity">Certificate of Similarity</option>
                        <option value="Submit document / Terminal report / Certifying document">Submit document / Terminal report / Certifying document</option>
                    </select>
                </div>
            
                <div class="col-12">
                    <label for="date" class="form-label">Date of Transaction:</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
            
                <div class="col-12">
                    <label for="time" class="form-label">Time of Transaction:</label>
                    <input type="time" class="form-control" id="time" name="time" required>
                </div>

                <div class="col-12">
                    <label for="facilitator" class="form-label">Person/Section transacted with:</label>
                    <select name="facilitator" class="form-select" id="facilitator" required>
                        <option selected>--- Select ---</option>
                        <option value="Macapagal, Laarnie">Macapagal, Laarnie</option>
                        <option value="Santos, Rico">Santos, Rico</option>
                        <option value="Camento, Ma. Victoria">Camento, Ma. Victoria</option>
                        <option value="Morgado, Jane">Morgado, Jane</option>
                        <option value="Africa, Ramil">Africa, Ramil</option>
                        <option value="Salve, Maureen">Salve, Maureen</option>
                    </select>
                </div>

                <div class="col-12">
                    <label for="name" class="form-label">Your Name (Optional):</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Answer">
                </div>
            
                <div class="col-12">
                    <label for="email_address" class="form-label">Email Address:</label>
                    <input type="text" class="form-control" id="email_address" name="email_address" placeholder="Your Answer" required>
                </div>
            
                <div class="col-12">
                    <label for="phone" class="form-label">Contact Number:</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Your Answer" required>
                </div>
            
                <div class="col-12">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" placeholder="Your Answer" id="address" name="address" style="height: 100px;"></textarea>
                </div>

                <div class="col-12">
                    <label for="company" class="form-label">Company/Office:</label>
                    <input type="text" class="form-control" id="company" name="company" placeholder="Your Answer" required>
                </div>

                <div class="col-12">
                    <label for="customer_feedback" class="form-label">Customer Feedback:</label>
                    <select name="customer_feedback" class="form-select" id="customer_feedback" required>
                        <option selected>Please select if you are providing:</option>
                        <option value="Compliment">Compliment</option>
                        <option value="Complaint">Complaint</option>
                        <option value="Suggestion">Suggestion</option>
                    </select>
                </div>

                <div class="col-12">
                    <label for="customer_remarks" class="form-label">Write your remarks/feedback about these.</label>
                    <textarea class="form-control" placeholder="Your Answer" id="customer_remarks" name="customer_remarks" style="height: 100px;"></textarea>
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