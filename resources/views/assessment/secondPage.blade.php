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

            <label class="form-label">11. Rank the following skills according to your preference, with 1 being the skill you like the most, and 7 being the one you like the least.
                 (Pumili ng pitong (7) Kasanayan iayos ayon sa pagkasunosunod: 1 - pinakagusto hangang 7 - pinka-huling gusto):
            </label>

            <h5 class="text-center"><b>List of Skill Trainings</b></h5>

            <ol class="list-group list-group-numbered text-center" style="padding-bottom: 20px">
                @foreach ($extension as $extensions)
                    <li class="list-group-item">{{$extensions->topics}}</li>
                @endforeach
            </ol>

            <form class="row g-3" method="POST" action="{{route('forms.community-survey-training-needs.third-page')}}" enctype="multipart/form-data">
                @csrf

                <div class="col-2 text-center">
                    <label for="rank1" class="form-label">Rank 1:</label>
                </div>
                <div class="col-10">
                    @foreach ($extension as $extensions)
                        <select name="rank1" class="form-select" id="rank1" required>
                            <option selected>--- Select ---</option>
                            <option value="{{$extensions->topics}}">{{$extensions->topics}}</option>
                        </select>
                    @endforeach
                </div>

                <div class="col-2 text-center">
                    <label for="rank2" class="form-label">Rank 2:</label>
                </div>
                <div class="col-10">
                    @foreach ($extension as $extensions)
                        <select name="rank2" class="form-select" id="rank2" required>
                            <option selected>--- Select ---</option>
                            <option value="{{$extensions->topics}}">{{$extensions->topics}}</option>
                        </select>
                    @endforeach
                </div>

                <div class="col-2 text-center">
                    <label for="rank3" class="form-label">Rank 3:</label>
                </div>
                <div class="col-10">
                    @foreach ($extension as $extensions)
                        <select name="rank3" class="form-select" id="rank3" required>
                            <option selected>--- Select ---</option>
                            <option value="{{$extensions->topics}}">{{$extensions->topics}}</option>
                        </select>
                    @endforeach
                </div>

                <div class="col-2 text-center">
                    <label for="rank4" class="form-label">Rank 4:</label>
                </div>
                <div class="col-10">
                    @foreach ($extension as $extensions)
                        <select name="rank4" class="form-select" id="rank4" required>
                            <option selected>--- Select ---</option>
                            <option value="{{$extensions->topics}}">{{$extensions->topics}}</option>
                        </select>
                    @endforeach
                </div>

                <div class="col-2 text-center">
                    <label for="rank5" class="form-label">Rank 5:</label>
                </div>
                <div class="col-10">
                    @foreach ($extension as $extensions)
                        <select name="rank5" class="form-select" id="rank5" required>
                            <option selected>--- Select ---</option>
                            <option value="{{$extensions->topics}}">{{$extensions->topics}}</option>
                        </select>
                    @endforeach
                </div>

                <div class="col-2 text-center">
                    <label for="rank6" class="form-label">Rank 6:</label>
                </div>
                <div class="col-10">
                    @foreach ($extension as $extensions)
                        <select name="rank6" class="form-select" id="rank6" required>
                            <option selected>--- Select ---</option>
                            <option value="{{$extensions->topics}}">{{$extensions->topics}}</option>
                        </select>
                    @endforeach
                </div>

                <div class="col-2 text-center">
                    <label for="rank7" class="form-label">Rank 7:</label>
                </div>
                <div class="col-10">
                    @foreach ($extension as $extensions)
                        <select name="rank7" class="form-select" id="rank7" required>
                            <option selected>--- Select ---</option>
                            <option value="{{$extensions->topics}}">{{$extensions->topics}}</option>
                        </select>
                    @endforeach
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