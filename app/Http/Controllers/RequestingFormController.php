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
        
        $application = DB::table('requestingform')
            ->join('files', 'files.id', '=', 'requestingform.research_id')
            ->select('files.*', 'requestingform.*')
            ->where('requestingform.status', '=', 'Pending')
            ->orderBy('requestingform.id')
            ->get();

        $adminNotifCount = DB::table('notifications')
            ->where('type', 'Admin Notification')
            ->count();

        $adminNotification = DB::table('notifications')
            ->where('type', 'Admin Notification')
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();

        return View::make('applications.applicationslist',compact('student', 'staff', 'faculty', 'admin', 'application','adminNotifCount','adminNotification'));
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

    //MOBILE START
    public function apply_certifications(Request $request)
    { 
        // $student =  Student::where('user_id',Auth::id())->first();
        $student =  Student::where('user_id', $request->user_id)->first();

        $studentfullname = $student->fname .' '. $student->mname .' '. $student->lname;

            $form = new RequestingForm;
            
            $form->date = now();

            $form->advisors_turnitin_precheck = $request->advisors_turnitin_precheck;
            $form->submission_frequency = $request->submission_frequency;
            $form->thesis_type = $request->thesis_type;
            $form->requestor_type = $request->requestor_type;

            $form->researchers_name1 = $request->researchers_name1;
            $form->researchers_name2 = $request->researchers_name2;
            $form->researchers_name3 = $request->researchers_name3;
            $form->researchers_name4 = $request->researchers_name4;
            $form->researchers_name5 = $request->researchers_name5;
            $form->researchers_name6 = $request->researchers_name6;
            $form->researchers_name7 = $request->researchers_name7;
            $form->researchers_name8 = $request->researchers_name8;

            $form->purpose = $request->purpose;
            $form->research_specialist = $request->research_specialist;
            $form->research_staff = $request->research_staff;
            $form->adviser_name = $request->adviser_name;
            $form->adviser_email = $request->adviser_email;
            $form->college = $request->college;
            $form->course = $request->course;
            
            $form->agreement = 'Yes';

            $form->score = 0;
            
            $form->research_id = $request->research_id;
            // $form->research_id = 22;

            $form->user_id = $student->user_id;
            $form->requestor_name = $studentfullname;
            $form->email_address = $student->email;
            $form->tup_mail = $student->email;
            $form->tup_id = $student->tup_id;
            $form->sex = $student->gender;

            $form->save();

            $file = Files::find($request->research_id);
            // $file = Files::find($form->research_id);
            $file->status = 'Pending';
            $file->initial_simmilarity_percentage = $request->initial_simmilarity_percentage;
            $file->simmilarity_percentage_results = '0';
            $file->save();

            return response()->json(["form" => $form, "file" => $file ]);

    }
    //MOBILE END
}
