@extends('layouts.navigation')
<main id="main" class="main">

    <div class="card mb-3">
        <div class="card-body">
            <h3 style="padding-top: 20px; color: maroon;"><b>Client Satisfaction Measurement (CSM)</b></h3>
            <h6>
                <b style="color: maroon">DIRECTION:</b> Kindly rate how the employee or office has satisfied your needs, request or concern based on the following criteria:
                (Panuto: Paki-rate kung paano natugunan ng empleyado o opisina ang iyong mga pangangailangan, kahilingan o alalahanin batay sa sumusunod na pamantayan:)
            </h6>

            <h6 style="padding-left: 20px">
                <li><b>Strongly Agree (SA) - 5</b></li>
                <li><b>Agree (A) - 4</b></li>
                <li><b>Neither Agree nor Disagree (NAD) - 3</b></li>
                <li><b>Disagree (D) - 2</b></li>
                <li><b>Strongly Disagree (SD) - 1</b></li>
            </h6>
            
            <h6>
                If your transaction does not require cost, leave the item blank. (Kung ang transaksyon ay walang bayad, huwag sagutan ang item na ito.)
            </h6>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">

            <form class="row g-3" method="POST" action="{{route('form.submit2')}}" enctype="multipart/form-data" style="padding-top: 60px">
                @csrf

                <fieldset class="row mb-3 text-center">
                    <legend class="col-form-label col-sm-2 pt-0">I spent an acceptable amount of time to complete my transaction (Responsiveness)</legend>
                    <div class="col-sm-2">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                        <label class="form-check-label" for="gridRadios1">
                            5-Strongly Agree
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            4-Agree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            3-Neither Agree nor Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            2-Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            1-Strongly Disagree
                          </label>
                        </div>
                    </div>
                </fieldset>
 
                <fieldset class="row mb-3 text-center">
                    <legend class="col-form-label col-sm-2 pt-0">The office accurately informed and followed the transaction's requirements and steps (Reliability)</legend>
                    <div class="col-sm-2">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                        <label class="form-check-label" for="gridRadios1">
                            5-Strongly Agree
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            4-Agree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            3-Neither Agree nor Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            2-Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            1-Strongly Disagree
                          </label>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="row mb-3 text-center">
                    <legend class="col-form-label col-sm-2 pt-0">My online transaction (including steps and payment) was simple and convenient (Access and Facilities)</legend>
                    <div class="col-sm-2">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                        <label class="form-check-label" for="gridRadios1">
                            5-Strongly Agree
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            4-Agree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            3-Neither Agree nor Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            2-Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            1-Strongly Disagree
                          </label>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="row mb-3 text-center">
                    <legend class="col-form-label col-sm-2 pt-0">I easily found information about my transaction from the office or its website (Communication)</legend>
                    <div class="col-sm-2">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                        <label class="form-check-label" for="gridRadios1">
                            5-Strongly Agree
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            4-Agree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            3-Neither Agree nor Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            2-Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            1-Strongly Disagree
                          </label>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="row mb-3 text-center">
                    <legend class="col-form-label col-sm-2 pt-0">I paid an acceptable amount of fees for my transaction (Costs)</legend>
                    <div class="col-sm-2">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                        <label class="form-check-label" for="gridRadios1">
                            5-Strongly Agree
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            4-Agree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            3-Neither Agree nor Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            2-Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            1-Strongly Disagree
                          </label>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="row mb-3 text-center">
                    <legend class="col-form-label col-sm-2 pt-0">I am confident my online transaction was secure (Integrity)</legend>
                    <div class="col-sm-2">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                        <label class="form-check-label" for="gridRadios1">
                            5-Strongly Agree
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            4-Agree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            3-Neither Agree nor Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            2-Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            1-Strongly Disagree
                          </label>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="row mb-3 text-center">
                    <legend class="col-form-label col-sm-2 pt-0">The office's online support was available, or (if asked questions) onlin support was quick to respond (Assurance)</legend>
                    <div class="col-sm-2">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                        <label class="form-check-label" for="gridRadios1">
                            5-Strongly Agree
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            4-Agree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            3-Neither Agree nor Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            2-Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            1-Strongly Disagree
                          </label>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="row mb-3 text-center">
                    <legend class="col-form-label col-sm-2 pt-0">I got what I needed from the government office (Outcome)</legend>
                    <div class="col-sm-2">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                        <label class="form-check-label" for="gridRadios1">
                            5-Strongly Agree
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            4-Agree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            3-Neither Agree nor Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            2-Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                          <label class="form-check-label" for="gridRadios1">
                            1-Strongly Disagree
                          </label>
                        </div>
                    </div>
                </fieldset>

                <div class="col-12">
                    <label for="type" class="form-label">Please check if you are providing a:</label>
                    <select name="type" class="form-select" id="type">
                        <option selected>--- Select ---</option>
                        <option value="Praise/Compliment">Praise/Compliment</option>
                        <option value="Comment/Suggestion">Comment/Suggestion</option>
                        <option value="Complaint ">Complaint </option>
                    </select>
                </div>

                <div class="col-12">
                    <label for="name" class="form-label">Write your complaint, praise or comment & suggestion here.</label>
                    <textarea class="form-control" placeholder="Your Answer" id="floatingTextarea" style="height: 100px;"></textarea>
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
