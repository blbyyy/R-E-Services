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

            <form class="row g-3" method="POST" action="{{route('form.submit5')}}" enctype="multipart/form-data" style="padding-top: 60px">
                @csrf
                <hr style="height: 5px; color: maroon;">
                <fieldset class="row mb-3 text-center" style="padding-top: 20px; padding-bottom: 10px;">
                    <legend class="col-form-label col-sm-2 pt-0">I spent an acceptable amount of time to complete my transaction (Responsiveness)</legend>
                    <div class="col-sm-2">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="a1" id="a1" value="5-Strongly Agree">
                        <label class="form-check-label" for="a1">
                            5-Strongly Agree
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a1" id="a1" value="4-Agree">
                          <label class="form-check-label" for="a1">
                            4-Agree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a1" id="a1" value="3-Neither Agree nor Disagree">
                          <label class="form-check-label" for="a1">
                            3-Neither Agree nor Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a1" id="a1" value="2-Disagree">
                          <label class="form-check-label" for="a1">
                            2-Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a1" id="a1" value="1-Strongly Disagree">
                          <label class="form-check-label" for="a1">
                            1-Strongly Disagree
                          </label>
                        </div>
                    </div>
                </fieldset>
                <hr style="height: 5px; color: maroon;">
                <fieldset class="row mb-3 text-center" style="padding-top: 20px; padding-bottom: 10px;">
                    <legend class="col-form-label col-sm-2 pt-0">The office accurately informed and followed the transaction's requirements and steps (Reliability)</legend>
                    <div class="col-sm-2">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="a2" id="a2" value="5-Strongly Agree">
                        <label class="form-check-label" for="a2">
                            5-Strongly Agree
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a2" id="a2" value="4-Agree">
                          <label class="form-check-label" for="a2">
                            4-Agree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a2" id="a2" value="3-Neither Agree nor Disagree">
                          <label class="form-check-label" for="a2">
                            3-Neither Agree nor Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a2" id="a2" value="2-Disagree">
                          <label class="form-check-label" for="a2">
                            2-Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a2" id="a2" value="1-Strongly Disagree">
                          <label class="form-check-label" for="a2">
                            1-Strongly Disagree
                          </label>
                        </div>
                    </div>
                </fieldset>
                <hr style="height: 5px; color: maroon;">
                <fieldset class="row mb-3 text-center" style="padding-top: 20px; padding-bottom: 10px;">
                    <legend class="col-form-label col-sm-2 pt-0">My online transaction (including steps and payment) was simple and convenient (Access and Facilities)</legend>
                    <div class="col-sm-2">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="a3" id="a3" value="5-Strongly Agree">
                        <label class="form-check-label" for="a3">
                            5-Strongly Agree
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a3" id="a3" value="4-Agree">
                          <label class="form-check-label" for="a3">
                            4-Agree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a3" id="a3" value="3-Neither Agree nor Disagree">
                          <label class="form-check-label" for="a3">
                            3-Neither Agree nor Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a3" id="a3" value="2-Disagree">
                          <label class="form-check-label" for="a3">
                            2-Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a3" id="a3" value="1-Strongly Disagree">
                          <label class="form-check-label" for="a3">
                            1-Strongly Disagree
                          </label>
                        </div>
                    </div>
                </fieldset>
                <hr style="height: 5px; color: maroon;">
                <fieldset class="row mb-3 text-center" style="padding-top: 20px; padding-bottom: 10px;">
                    <legend class="col-form-label col-sm-2 pt-0">I easily found information about my transaction from the office or its website (Communication)</legend>
                    <div class="col-sm-2">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="a4" id="a4" value="5-Strongly Agree">
                        <label class="form-check-label" for="a4">
                            5-Strongly Agree
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a4" id="a4" value="4-Agree">
                          <label class="form-check-label" for="a4">
                            4-Agree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a4" id="a4" value="3-Neither Agree nor Disagree">
                          <label class="form-check-label" for="a4">
                            3-Neither Agree nor Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a4" id="a4" value="2-Disagree">
                          <label class="form-check-label" for="a4">
                            2-Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a4" id="a4" value="1-Strongly Disagree">
                          <label class="form-check-label" for="a4">
                            1-Strongly Disagree
                          </label>
                        </div>
                    </div>
                </fieldset>
                <hr style="height: 5px; color: maroon;">
                <fieldset class="row mb-3 text-center" style="padding-top: 20px; padding-bottom: 10px;">
                    <legend class="col-form-label col-sm-2 pt-0">I paid an acceptable amount of fees for my transaction (Costs)</legend>
                    <div class="col-sm-2">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="a5" id="a5" value="5-Strongly Agree">
                        <label class="form-check-label" for="a5">
                            5-Strongly Agree
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a5" id="a5" value="4-Agree">
                          <label class="form-check-label" for="a5">
                            4-Agree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a5" id="a5" value="3-Neither Agree nor Disagree">
                          <label class="form-check-label" for="a5">
                            3-Neither Agree nor Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a5" id="a5" value="2-Disagree">
                          <label class="form-check-label" for="a5">
                            2-Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a5" id="a5" value="1-Strongly Disagree">
                          <label class="form-check-label" for="a5">
                            1-Strongly Disagree
                          </label>
                        </div>
                    </div>
                </fieldset>
                <hr style="height: 5px; color: maroon;">
                <fieldset class="row mb-3 text-center" style="padding-top: 20px; padding-bottom: 10px;">
                    <legend class="col-form-label col-sm-2 pt-0">I am confident my online transaction was secure (Integrity)</legend>
                    <div class="col-sm-2">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="a6" id="a6" value="5-Strongly Agree">
                        <label class="form-check-label" for="a6">
                            5-Strongly Agree
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a6" id="a6" value="4-Agree">
                          <label class="form-check-label" for="a6">
                            4-Agree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a6" id="a6" value="3-Neither Agree nor Disagree">
                          <label class="form-check-label" for="a6">
                            3-Neither Agree nor Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a6" id="a6" value="2-Disagree">
                          <label class="form-check-label" for="a6">
                            2-Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a6" id="a6" value="1-Strongly Disagree">
                          <label class="form-check-label" for="a6">
                            1-Strongly Disagree
                          </label>
                        </div>
                    </div>
                </fieldset>
                <hr style="height: 5px; color: maroon;">
                <fieldset class="row mb-3 text-center" style="padding-top: 20px; padding-bottom: 10px;">
                    <legend class="col-form-label col-sm-2 pt-0">The office's online support was available, or (if asked questions) onlin support was quick to respond (Assurance)</legend>
                    <div class="col-sm-2">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="a7" id="a7" value="5-Strongly Agree">
                        <label class="form-check-label" for="a7">
                            5-Strongly Agree
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a7" id="a7" value="4-Agree">
                          <label class="form-check-label" for="a7">
                            4-Agree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a7" id="a7" value="3-Neither Agree nor Disagree">
                          <label class="form-check-label" for="a7">
                            3-Neither Agree nor Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a7" id="a7" value="2-Disagree">
                          <label class="form-check-label" for="a7">
                            2-Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a7" id="a7" value="1-Strongly Disagree">
                          <label class="form-check-label" for="a7">
                            1-Strongly Disagree
                          </label>
                        </div>
                    </div>
                </fieldset>
                <hr style="height: 5px; color: maroon;">
                <fieldset class="row mb-3 text-center" style="padding-top: 20px; padding-bottom: 10px;">
                    <legend class="col-form-label col-sm-2 pt-0">I got what I needed from the government office (Outcome)</legend>
                    <div class="col-sm-2">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="a8" id="a8" value="5-Strongly Agree">
                        <label class="form-check-label" for="a8">
                            5-Strongly Agree
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a8" id="a8" value="4-Agree">
                          <label class="form-check-label" for="a8">
                            4-Agree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a8" id="a8" value="3-Neither Agree nor Disagree">
                          <label class="form-check-label" for="a8">
                            3-Neither Agree nor Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a8" id="a8" value="2-Disagree">
                          <label class="form-check-label" for="a8">
                            2-Disagree
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a8" id="a8" value="1-Strongly Disagree">
                          <label class="form-check-label" for="a8">
                            1-Strongly Disagree
                          </label>
                        </div>
                    </div>
                </fieldset>
                <hr style="height: 5px; color: maroon;">
                <div class="col-12">
                    <label for="comprehensive_type" class="form-label">Please check if you are providing a:</label>
                    <select name="comprehensive_type" class="form-select" id="comprehensive_type">
                        <option selected>--- Select ---</option>
                        <option value="Praise/Compliment">Praise/Compliment</option>
                        <option value="Comment/Suggestion">Comment/Suggestion</option>
                        <option value="Complaint ">Complaint </option>
                    </select>
                </div>

                <div class="col-12">
                    <label for="complaint_message" class="form-label">Write your complaint, praise or comment & suggestion here.</label>
                    <textarea class="form-control" placeholder="Your Answer" id="complaint_message" name="complaint_message" style="height: 100px;"></textarea>
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
