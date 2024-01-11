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

        // $application = RequestingForm::orderBy('id')->get();

        $application = DB::table('requestingform')
        ->join('files', 'files.id', '=', 'requestingform.research_id')
        ->select('files.*', 'requestingform.*')
        ->orderByRaw("CASE WHEN requestingform.status = 'Pending' THEN 0 ELSE 1 END, requestingform.id")
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
