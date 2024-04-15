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
            
            <form class="row g-3" method="POST" action="{{route('form.submit3')}}" enctype="multipart/form-data">
                @csrf

                    <fieldset class="col-md-12">
                        <legend class="col-form-label col-sm-12 pt-0">CC2: If YES to the previous question, did you see this office's Citizen's Charter (CC)?</legend>
                        <div class="col-sm-12">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cc2" id="cc2Answer1" value=" Yes, the CC was easy to find">
                                <label class="form-check-label" for="cc2Answer1">
                                    Yes, the CC was easy to find
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cc2" id="cc2Answer2" value="Yes, but the CC was hard to find">
                                <label class="form-check-label" for="cc2Answer2">
                                    Yes, but the CC was hard to find
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cc2" id="cc2Answer3" value="No, I did not see this office's CC">
                                <label class="form-check-label" for="cc2Answer3">
                                    No, I did not see this office's CC
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

    <div class="card mb-3">
        <div class="card-body">
            @if(session()->has('form_data'))
                <h1>Form Data</h1>
                <ul>
                    @foreach(session('form_data') as $key => $value)
                        <li><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ is_array($value) ? implode(', ', $value) : $value }}</li>
                    @endforeach
                </ul>
            @else
                <p>Form data not found!</p>
            @endif
        </div>
    </div>

</main>
