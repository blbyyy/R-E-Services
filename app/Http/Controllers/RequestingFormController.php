<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use App\Models\RequestingForm;
use App\Models\Student;
use App\Models\Files;
use View;
use DB;
use File;
use Auth;

class RequestingFormController extends Controller
{
    public function certification_page()
    {
        $student = DB::table('students')
        ->join('users','users.id','students.user_id')
        ->select('students.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $myfiles = DB::table('files')
        ->join('users', 'users.id', '=', 'files.user_id')
        ->join('students', 'students.user_id', '=', 'users.id')
        ->select('files.*') 
        ->where('files.user_id', Auth::id())
        ->get();
        
        return View::make('certification.requesting',compact('student','myfiles'));
    }

    public function apply_certification(Request $request, $id)
    { 
        $student =  Student::where('user_id',Auth::id())->first();

        $studentfullname = $student->fname .' '. $student->mname .' '. $student->lname;

            $form = new RequestingForm;
            $form->date = now();
            $form->email_address = $student->email;
            $form->thesis_type = $request->thesis_type;
            $form->advisors_turnitin_precheck = $request->advisors_turnitin_precheck;
            $form->adviser_name = $request->adviser_name;
            $form->submission_frequency = $request->submission_frequency;
            $form->research_specialist = $request->research_specialist;
            $form->tup_id = $student->tup_id;
            $form->requestor_name = $studentfullname;
            $form->tup_mail = $student->email;
            $form->sex = $student->gender;
            $form->requestor_type = $request->requestor_type;
            $form->college = $request->college;
            $form->course = $request->course;
            $form->purpose = $request->purpose;
            $form->researchers_name1 = $request->researchers_name1;
            $form->researchers_name2 = $request->researchers_name2;
            $form->researchers_name3 = $request->researchers_name3;
            $form->researchers_name4 = $request->researchers_name4;
            $form->researchers_name5 = $request->researchers_name5;
            $form->researchers_name6 = $request->researchers_name6;
            $form->researchers_name7 = $request->researchers_name7;
            $form->researchers_name8 = $request->researchers_name8;
            $form->adviser_email = $request->adviser_email;
            $form->agreement = $request->agreement;
            $form->score = '0';
            $form->research_staff = $request->research_staff;
            $form->research_id = $request->research_id;
            $form->user_id = $student->user_id;
            $form->status = 'Pending';
            $form->initial_simmilarity_percentage = $request->initial_simmilarity_percentage;
            $form->simmilarity_percentage_results = '0';
            $form->save();

            $file = Files::find($request->research_id);
            $file->file_status = 'Pending';
            $file->save();

            return response()->json(["form" => $form, "file" => $file ]);

    }

    public function application_status()
    {
        $student = DB::table('students')
        ->join('users','users.id','students.user_id')
        ->select('students.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $studentstats = DB::table('requestingform')
        ->join('users', 'users.id', 'requestingform.user_id')
        ->join('files', 'files.id', 'requestingform.research_id')
        ->select('requestingform.*', 'files.research_title')
        ->where('requestingform.user_id', Auth::id())
        ->get();

        // dd($studentstats);

        $staffstats = DB::table('requestingform')
        ->join('users','users.id','requestingform.user_id')
        ->select('users.*','requestingform.*')
        ->where('user_id',Auth::id())
        ->get();

        $facultystats = DB::table('requestingform')
        ->join('users','users.id','requestingform.user_id')
        ->select('users.*','requestingform.*')
        ->where('user_id',Auth::id())
        ->get();

        return View::make('applications.applicationstatus',compact('student', 'studentstats', 'staffstats', 'facultystats'));
    }

    public function show($id)
    {
        $specificData = DB::table('requestingform')
        ->join('files', 'files.id', 'requestingform.research_id')
        ->join('users', 'users.id', 'requestingform.user_id')
        ->leftJoin('certificates', 'certificates.id', 'requestingform.certificate_id')
        ->select('requestingform.*', 'files.*','certificates.certificate_file')
        ->where('requestingform.id', $id)
        ->first();

        return response()->json($specificData);

    }

    public function getfile_id($id)
    {
        $file = RequestingForm::find($id);
        return response()->json($file);
    }

    public function application_list()
    {
        $student = DB::table('students')
        ->join('users','users.id','students.user_id')
        ->select('students.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $staff = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();
        
        $faculty = DB::table('faculty')
        ->join('users','users.id','faculty.user_id')
        ->select('faculty.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $admin = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        // $application = RequestingForm::orderBy('id')->get();

        $application = DB::table('requestingform')
        ->join('files','files.id','requestingform.research_id')
        ->select('files.*','requestingform.*')
        ->orderBy('requestingform.id')
        ->get();
    
        return View::make('applications.applicationslist',compact('student', 'staff', 'faculty', 'admin', 'application'));
    }

    // public function uploadPDF(Request $request)
    // {
    //     $request->validate([
    //         'pdf' => 'required|mimes:pdf|max:2048',
    //     ]);

    //     $pdfFile = $request->eyss->file('pdf');

    //     $path = $pdfFile->storeAs('REDigitalize', $pdfFile->getClientOriginalName(), 'google');

    //     return redirect()->to('/homepage');
    // }
}
