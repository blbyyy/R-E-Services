@extends('layouts.navigation')
<main id="main" class="main">

    <div class="card mb-3">
        <div class="card-body">
            <h4 class="card-title">Community Survey For Training Needs</h4>
            <p>
                Ang TUP-Taguig po ay may adhikaing matulungan at mapalawak ang kaalaman ng ating mga nasasakupang barangay sa pamamagitan
                ng pagbibigay ng seminar o pagsasanay sa aspeto teknikal. Ang pagsasanay na ito ay maaring magamit nila sa kanilang kabuhayan.
            </p>
            <p>
                Pakisagutan ang mga sumusunod nakatanungan upang malaman naming ang iyong interes at ang mga paraan upang maayos naming kayong 
                mapaglingkuran. pakilagyan lamang ang mga sumusunod at punan ang mga patlang ayon sa inyong sagot.
            </p>

        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h4 class="card-title"></h4>

            <form class="row g-3" method="POST" action="{{route('forms.community-survey-training-needs.second-page')}}" enctype="multipart/form-data">
                @csrf
                <div class="col-12">
                    <label for="name" class="form-label">1. Name (Pangalan):</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                </div>

                <div class="col-12">
                    <label for="address" class="form-label">2. Address (Tirahan):</label>
                    <textarea class="form-control" placeholder="Your Answer" id="address" name="address" style="height: 100px;"></textarea>
                </div>

                <div class="col-12">
                    <label for="age" class="form-label">3. Age (Edad):</label>
                    <input type="text" class="form-control" id="age" name="age" placeholder="Your Age" required>
                </div>
            
                <div class="col-6">
                    <label for="status" class="form-label">4. Status</label>
                    <select name="status" class="form-select" id="status" required>
                        <option selected>--- Select ---</option>
                        <option value="Single">Single</option>
                        <option value="Marrieds">Married</option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="sex" class="form-label">5. Sex (Kasarian)</label>
                    <select name="sex" class="form-select" id="sex" required>
                        <option selected>--- Select ---</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="col-12">
                    <label for="phone" class="form-label">6. Contact Number (Telepono):</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Your Contact Number" required>
                </div>
                
                <div class="col-12">
                    <label for="education_level" class="form-label">7. Education Level (Antas ng Pinagaralan):</label>
                    <select name="education_level" class="form-select" id="education_level" required>
                        <option selected>--- Select ---</option>
                        <option value="Didn't finish elementary school">Didn't finish elementary school (Di nakatapos ng elementarya)</option>
                        <option value="Finished elementary school">Finished elementary school (Tapos ng elementary)</option>
                        <option value="Didn't finish high school">Didn't finish high school (Di nakatapos ng high school)</option>
                        <option value="Finished high school">Finished high school (Tapos ng high school)</option>
                        <option value="Didn't finish vocational">Didn't finish vocational (Di nakatapos ng vocational)</option>
                        <option value="Finished voacational course">Finished voacational course (Tapos ng kursong vocational)</option>
                        <option value="Didn't finish college">Didn't finish college (Di nakatapos ng collegel)</option>
                        <option value="Finished college">Finished college (Tapos ng college)</option>
                    </select>
                </div>

                <fieldset class="row mb-3" style="padding-top: 20px; padding-bottom: 10px;">
                    <legend class="col-form-label col-sm-2 pt-0">8. Have a current job? if none continue to #10 (May kasalukuyang trabaho? kung wala magpatuloy sa #10)</legend>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="employment" id="employment" value="There is">
                          <label class="form-check-label" for="employment">
                              There is (Meron)
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="employment" id="employment" value="None">
                            <label class="form-check-label" for="employment">
                              None (Wala)
                            </label>
                          </div>
                    </div>
                </fieldset>

                <fieldset class="row mb-3" style="padding-top: 20px; padding-bottom: 10px;">
                    <legend class="col-form-label col-sm-2 pt-0">9. State of employment (Estado ng pagtratrabaho)</legend>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="employment_state" id="employment_state" value="Permanent">
                          <label class="form-check-label" for="employment_state">
                              Permanent 
                          </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="employment_state" id="employment_state" value="Not permanent ">
                            <label class="form-check-label" for="employment_state">
                                Not permanent 
                            </label>
                          </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="employment_state" id="employment_state" value="Contractual">
                          <label class="form-check-label" for="employment_state">
                                Contractual 
                          </label>
                        </div>
                  </div>
                </fieldset>

                <label class="form-label">10. Have you had technical trainings? If available, provide the last three technical trainings obtained (Kayo po ba ay nagkaroon nang mga teknikal trainings? Kung meron magbigay ng huling tatlong nakuha teknikal training):</label>
                <div class="col-4">
                    <label for="training1" class="form-label">Training1</label>
                    <input type="text" class="form-control" id="training1" name="training1" placeholder="Your Answer" required>
                </div>
                <div class="col-4">
                    <label for="training2" class="form-label">Training2</label>
                    <input type="text" class="form-control" id="training2" name="training2" placeholder="Your Answer" required>
                </div>
                <div class="col-4">
                    <label for="training3" class="form-label">Training3</label>
                    <input type="text" class="form-control" id="training3" name="training3" placeholder="Your Answer" required>
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