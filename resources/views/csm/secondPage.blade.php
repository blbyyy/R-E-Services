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
            <h4 class="card-title">INSTRUCTION: Mark check your answer to the Citizen's Charter (CC) questions</h4>
            
            <form class="row g-3" method="POST" action="{{route('form.submit2')}}" enctype="multipart/form-data">
                @csrf

                <fieldset class="col-md-12">
                    <legend class="col-form-label col-sm-12 pt-0">CC1: Do you know about the Citizen's Charter (document of an agency's services and reqs.)?</legend>
                    <div class="col-sm-12">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="cc1" id="cc1Answer1" value="Yes, I am aware before my transaction with this office.">
                        <label class="form-check-label" for="cc1Answer1">
                            Yes, I am aware before my transaction with this office.
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="cc1" id="cc1Answer2" value="Yes, but I am aware only when I saw the CC of this office.">
                        <label class="form-check-label" for="cc1Answer2">
                            Yes, but I am aware only when I saw the CC of this office.
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="cc1" id="cc1Answer3" value="No, I am not aware of the CC">
                        <label class="form-check-label" for="cc1Answer3">
                            No, I am not aware of the CC
                        </label>
                      </div>
                    </div>
                </fieldset>

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
