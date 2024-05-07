@extends('layouts.navigation')
<style>
    #printData {
        color: maroon;
    }
</style>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Printable Data</h1>
    </div>

    
    <div class="row">
        <h3 class="text-center" style="color: white">Users</h3>
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-body">

                    <h4 class="card-title text-center">All Users</h4>

                    <div class="text-center" style="color: maroon; font-size: 4em; padding-bottom: 20px">
                        <i class="bi bi-people-fill"></i>
                    </div>

                    <div class="text-center">
                        <a href="{{url('/userCountTable')}}" class="btn-sm" id="printData">
                            Print Table
                            <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card mb-3">
                <div class="card-body">

                    <h4 class="card-title text-center">Students</h4>

                    <div class="text-center" style="color: maroon; font-size: 4em; padding-bottom: 20px">
                        <i class="ri-user-3-line"></i>
                    </div>

                    <div class="text-center">
                        <a href="{{url('/studentCountTable')}}" class="btn-sm" id="printData">
                            Print Table
                            <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card mb-3">
                <div class="card-body">

                    <h4 class="card-title text-center">Faculty Member</h4>

                    <div class="text-center" style="color: maroon; font-size: 4em; padding-bottom: 20px">
                        <i class="ri-user-2-fill"></i>
                    </div>

                    <div class="text-center">
                        <a href="{{url('/facultyCountTable')}}" class="btn-sm" id="printData">
                            Print Table
                            <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card mb-3">
                <div class="card-body">

                    <h4 class="card-title text-center">Research Coordinator</h4>

                    <div class="text-center" style="color: maroon; font-size: 4em; padding-bottom: 20px">
                        <i class="ri-user-2-line"></i>
                    </div>

                    <div class="text-center">
                        <a href="{{url('/researchCoordinatorCountTable')}}" class="btn-sm" id="printData">
                            Print Table
                            <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card mb-3">
                <div class="card-body">

                    <h4 class="card-title text-center">Staff/Admin</h4>

                    <div class="text-center" style="color: maroon; font-size: 4em; padding-bottom: 20px">
                        <i class="ri-user-settings-line"></i>
                    </div>

                    <div class="text-center">
                        <a href="{{url('/staffAdminCountTable')}}" class="btn-sm" id="printData">
                            Print Table
                            <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <h3 class="text-center" style="color: white">Researches</h3>
        <div class="col-lg-6">
            <div class="card mb-3">
                <div class="card-body">

                    <h4 class="card-title text-center">By Department and Year</h4>

                    <div class="text-center" style="color: maroon; font-size: 3em; padding-bottom: 20px">
                        <i class="bx bxs-file-find"></i>
                    </div>

                    <form class="row g-3" method="POST" action="{{ route('researchListByDepartmentAndYear.pdf') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="col-6 text-center">
                            <label for="department" class="form-label">Select Department:</label>
                            <select name="department" class="form-select" id="department" aria-label="State">
                                <option selected>Choose.....</option>
                                <option value="EAAD">Electrical and Allied Department</option>
                                <option value="CAAD">Civil and Allied Department</option>
                                <option value="MAAD">Mechanical and Allied Department</option>
                                <option value="BSAD">Basic Science Arts Department</option>
                            </select>
                        </div>

                        <div class="col-6 text-center">
                            <label for="year" class="form-label">Select Year:</label>
                            <select name="year" class="form-select" id="year" aria-label="Year">
                                <option selected>Choose.....</option>
                                <?php
                                for ($year = 2000; $year <= 2050; $year++) {
                                    echo "<option value=\"$year\">$year</option>";
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-link" id="printdata" style="text-decoration: none;">
                                Print Table <i class="bi bi-arrow-right-circle"></i>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card mb-3">
                <div class="card-body">

                    <h4 class="card-title text-center">By Input Text</h4>

                    <div class="text-center" style="color: maroon; font-size: 3em; padding-bottom: 20px">
                        <i class="bx bxs-file-find"></i>
                    </div>

                    <form class="row g-3" method="GET" action="{{ route('researchListByInputText.pdf') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="col-12 text-center">
                            <label for="query" class="form-label">Input Text:</label>
                            <input type="text" name="query" id="query" class="form-control">
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-link" id="printdata" style="text-decoration: none;">
                                Print Table <i class="bi bi-arrow-right-circle"></i>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-body">

                    <h4 class="card-title text-center">All Research</h4>

                    <div class="text-center" style="color: maroon; font-size: 4em; padding-bottom: 20px">
                        <i class="bx bxs-file-find"></i>
                    </div>

                    <div class="text-center">
                        <a href="{{url('/researchesCountTable')}}" class="btn-sm" id="printData">
                            Print Table
                            <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-body">

                    <h4 class="card-title text-center">Researches Count By Department</h4>

                    <div class="text-center" style="color: maroon; font-size: 4em; padding-bottom: 20px">
                        <i class="bx bxs-school"></i>
                    </div>

                    <div class="text-center">
                        <a href="{{url('/researchesDepartmentCountTable')}}" class="btn-sm" id="printData">
                            Print Table
                            <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-body">

                    <h4 class="card-title text-center">Researches Count By Course</h4>

                    <div class="text-center" style="color: maroon; font-size: 4em; padding-bottom: 20px">
                        <i class="bx bxs-book-bookmark"></i>
                    </div>

                    <div class="text-center">
                        <a href="{{url('/researchesCourseCountTable')}}" class="btn-sm" id="printData">
                            Print Table
                            <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <h3 class="text-center" style="color: white">Research Applications</h3>
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-body">

                    <h4 class="card-title text-center">All Research Applications</h4>

                    <div class="text-center" style="color: maroon; font-size: 4em; padding-bottom: 20px">
                        <i class="bx bx-spreadsheet"></i>
                    </div>

                    <div class="text-center">
                        <a href="{{url('/applicationsCountTable')}}" class="btn-sm" id="printData">
                            Print Table
                            <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-body">

                    <h4 class="card-title text-center">Research Applications Count By Thesis Type</h4>

                    <div class="text-center" style="color: maroon; font-size: 3em; padding-bottom: 20px">
                        <i class="bx bx-clipboard"></i>
                    </div>

                    <form class="row g-3" method="POST" action="{{ route('thesisTypeCountTable.pdf') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="col-12 text-center">
                            <label for="thesis_type" class="form-label">Select Thesis Type:</label>
                            <select name="thesis_type" class="form-select" id="thesis_type" aria-label="State">
                                <option selected>Choose.....</option>
                                <option value="Thesis">Thesis</option>
                                <option value="Capstone Project">Capstone Project</option>
                                <option value="Project study">Project Study</option>
                                <option value="Special Research Project">Special Research Project</option>
                                <option value="Feasibility Study">Feasibility Study</option>
                            </select>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-link" id="printdata" style="text-decoration: none;">
                                Print Table <i class="bi bi-arrow-right-circle"></i>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-body">

                    <h4 class="card-title text-center">Research Applications Count By Requestor Type</h4>

                    <div class="text-center" style="color: maroon; font-size: 3em; padding-bottom: 20px">
                        <i class="bx bx-clipboard"></i>
                    </div>

                    <form class="row g-3" method="POST" action="{{ route('requestorTypeCountTable.pdf') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="col-12 text-center">
                            <label for="requestor_type" class="form-label">Select Requestor Type:</label>
                            <select name="requestor_type" class="form-select" id="requestor_type" aria-label="State">
                                <option selected>Choose.....</option>
                                <option value="Undergraduate Student">Undergraduate Student</option>
                                <option value="Faculty">Faculty</option>
                            </select>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-link" id="printdata" style="text-decoration: none;">
                                Print Table <i class="bi bi-arrow-right-circle"></i>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-body">

                    <h4 class="card-title text-center">Research Applications Count By Status</h4>
                    <div class="text-center" style="color: maroon; font-size: 3em; padding-bottom: 20px">
                        <i class="bx bx-clipboard"></i>
                    </div>

                    <form class="row g-3" method="POST" action="{{ route('statusTypeCountTable.pdf') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="col-12 text-center">
                            <label for="status" class="form-label">Select Application Status:</label>
                            <select name="status" class="form-select" id="status" aria-label="State">
                                <option selected>Choose.....</option>
                                <option value="Pending Technical Adviser Approval">Pending Technical Adviser Approval</option>
                                <option value="Pending Subject Adviser Approval">Pending Subject Adviser Approval</option>
                                <option value="Pending">Pending</option>
                                <option value="Passed">Passed</option>
                                <option value="Returned">Returned</option>
                            </select>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-link" id="printdata" style="text-decoration: none;">
                                Print Table <i class="bi bi-arrow-right-circle"></i>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    
</main>