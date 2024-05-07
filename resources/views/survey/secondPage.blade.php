@extends('layouts.navigation')
<main id="main" class="main">

    <div class="card mb-3">
        <div class="card-body">
            <h3 style="padding-top: 20px; color: maroon;"><b>Research and Extension Services Customer Satisfaction Survey Form</b></h3>
            <h6>
                <b style="color: maroon">Customer Satisfaction Rating:</b> As you proceed, kindly indicate your choice by selecting the radio button that corresponds to your answer.
            </h6>

            <h6 style="padding-left: 20px">
                <li><b>5 - Outstanding</b></li>
                <li><b>4 - Very Satisfactory</b></li>
                <li><b>3 - Satisfactory</b></li>
                <li><b>2 - Needs Improvement</b></li>
                <li><b>1 - Poor</b></li>
            </h6>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">

            <form class="row g-3" method="POST" action="{{route('forms.customer-satisfaction-survey.third-page')}}" enctype="multipart/form-data" style="padding-top: 60px">
                @csrf
                <hr style="height: 5px; color: maroon;">
                <fieldset class="row mb-3 text-center" style="padding-top: 20px; padding-bottom: 10px;">
                    <legend class="col-form-label col-sm-2 pt-0">How would you rate your OVERALL SATISFACTION with the quality of our service delivery?</legend>
                    <div class="col-sm-2">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="a1" id="a1" value="OUTSTANDING">
                        <label class="form-check-label" for="a1">
                            OUTSTANDING
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a1" id="a1" value="VERY STAISFACTORY">
                          <label class="form-check-label" for="a1">
                            VERY STAISFACTORY
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a1" id="a1" value="SATISFACTORY">
                          <label class="form-check-label" for="a1">
                            SATISFACTORY
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a1" id="a1" value="NEEDS IMPROVEMENT">
                          <label class="form-check-label" for="a1">
                            NEEDS IMPROVEMENT
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a1" id="a1" value="POOR">
                          <label class="form-check-label" for="a1">
                            POOR
                          </label>
                        </div>
                    </div>
                </fieldset>
                <hr style="height: 5px; color: maroon;">
                <fieldset class="row mb-3 text-center" style="padding-top: 20px; padding-bottom: 10px;">
                    <legend class="col-form-label col-sm-2 pt-0">How satisfied were you in the RESPONSE TIME to your transaction given by our office?</legend>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a2" id="a2" value="OUTSTANDING">
                          <label class="form-check-label" for="a2">
                              OUTSTANDING
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="a2" id="a2" value="VERY STAISFACTORY">
                            <label class="form-check-label" for="a2">
                              VERY STAISFACTORY
                            </label>
                          </div>
                    </div>
                    <div class="col-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="a2" id="a2" value="SATISFACTORY">
                            <label class="form-check-label" for="a2">
                              SATISFACTORY
                            </label>
                          </div>
                    </div>
                    <div class="col-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="a2" id="a2" value="NEEDS IMPROVEMENT">
                            <label class="form-check-label" for="a2">
                              NEEDS IMPROVEMENT
                            </label>
                          </div>
                    </div>
                    <div class="col-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="a2" id="a2" value="POOR">
                            <label class="form-check-label" for="a2">
                              POOR
                            </label>
                          </div>
                    </div>
                </fieldset>
                <hr style="height: 5px; color: maroon;">
                <fieldset class="row mb-3 text-center" style="padding-top: 20px; padding-bottom: 10px;">
                    <legend class="col-form-label col-sm-2 pt-0">How satisfied were you with the OUTCOME of the service provider?</legend>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a3" id="a3" value="OUTSTANDING">
                          <label class="form-check-label" for="a3">
                              OUTSTANDING
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="a3" id="a3" value="VERY STAISFACTORY">
                            <label class="form-check-label" for="a3">
                              VERY STAISFACTORY
                            </label>
                          </div>
                    </div>
                    <div class="col-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="a3" id="a3" value="SATISFACTORY">
                            <label class="form-check-label" for="a3">
                              SATISFACTORY
                            </label>
                          </div>
                    </div>
                    <div class="col-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="a3" id="a3" value="NEEDS IMPROVEMENT">
                            <label class="form-check-label" for="a3">
                              NEEDS IMPROVEMENT
                            </label>
                          </div>
                    </div>
                    <div class="col-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="a3" id="a3" value="POOR">
                            <label class="form-check-label" for="a3">
                              POOR
                            </label>
                          </div>
                    </div>
                </fieldset>
                <hr style="height: 5px; color: maroon;">
                <fieldset class="row mb-3 text-center" style="padding-top: 20px; padding-bottom: 10px;">
                    <legend class="col-form-label col-sm-2 pt-0">How satisfied were you with our provision of INFORMATION on the service?</legend>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a4" id="a4" value="OUTSTANDING">
                          <label class="form-check-label" for="a4">
                              OUTSTANDING
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="a4" id="a4" value="VERY STAISFACTORY">
                            <label class="form-check-label" for="a4">
                              VERY STAISFACTORY
                            </label>
                          </div>
                    </div>
                    <div class="col-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="a4" id="a4" value="SATISFACTORY">
                            <label class="form-check-label" for="a4">
                              SATISFACTORY
                            </label>
                          </div>
                    </div>
                    <div class="col-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="a4" id="a4" value="NEEDS IMPROVEMENT">
                            <label class="form-check-label" for="a4">
                              NEEDS IMPROVEMENT
                            </label>
                          </div>
                    </div>
                    <div class="col-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="a4" id="a4" value="POOR">
                            <label class="form-check-label" for="a4">
                              POOR
                            </label>
                          </div>
                    </div>
                </fieldset>
                <hr style="height: 5px; color: maroon;">
                <fieldset class="row mb-3 text-center" style="padding-top: 20px; padding-bottom: 10px;">
                    <legend class="col-form-label col-sm-2 pt-0">How satisfied were you with our COMPETENCE or skill in service delivery?</legend>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a5" id="a5" value="OUTSTANDING">
                          <label class="form-check-label" for="a5">
                              OUTSTANDING
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="a5" id="a5" value="VERY STAISFACTORY">
                            <label class="form-check-label" for="a5">
                              VERY STAISFACTORY
                            </label>
                          </div>
                    </div>
                    <div class="col-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="a5" id="a5" value="SATISFACTORY">
                            <label class="form-check-label" for="a5">
                              SATISFACTORY
                            </label>
                          </div>
                    </div>
                    <div class="col-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="a5" id="a5" value="NEEDS IMPROVEMENT">
                            <label class="form-check-label" for="a5">
                              NEEDS IMPROVEMENT
                            </label>
                          </div>
                    </div>
                    <div class="col-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="a5" id="a5" value="POOR">
                            <label class="form-check-label" for="a5">
                              POOR
                            </label>
                          </div>
                    </div>
                </fieldset>
                <hr style="height: 5px; color: maroon;">
                <fieldset class="row mb-3 text-center" style="padding-top: 20px; padding-bottom: 10px;">
                    <legend class="col-form-label col-sm-2 pt-0">How satisfied were you with our COURTESY, friendliness, politeness, fair treatment, and willingness to do more than what is expected?</legend>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="a6" id="a6" value="OUTSTANDING">
                          <label class="form-check-label" for="a6">
                              OUTSTANDING
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="a6" id="a6" value="VERY STAISFACTORY">
                            <label class="form-check-label" for="a6">
                              VERY STAISFACTORY
                            </label>
                          </div>
                    </div>
                    <div class="col-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="a6" id="a6" value="SATISFACTORY">
                            <label class="form-check-label" for="a6">
                              SATISFACTORY
                            </label>
                          </div>
                    </div>
                    <div class="col-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="a6" id="a6" value="NEEDS IMPROVEMENT">
                            <label class="form-check-label" for="a6">
                              NEEDS IMPROVEMENT
                            </label>
                          </div>
                    </div>
                    <div class="col-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="a6" id="a6" value="POOR">
                            <label class="form-check-label" for="a6">
                              POOR
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
