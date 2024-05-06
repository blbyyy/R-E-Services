<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use View, DB, Auth, File, Session, Redirect;

class AssessmentController extends Controller
{
    public function firstPage()
    {
        $faculty = DB::table('faculty')
            ->join('users','users.id','faculty.user_id')
            ->select('faculty.*','users.*')
            ->where('user_id',Auth::id())
            ->first();

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

        $admin = DB::table('staff')
            ->join('users','users.id','staff.user_id')
            ->select('staff.*','users.*')
            ->where('user_id',Auth::id())
            ->first();

        $adminNotifCount = DB::table('notifications')
            ->where('type', 'Admin Notification')
            ->count();

        $adminNotification = DB::table('notifications')
            ->where('type', 'Admin Notification')
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();
        
        $facultyNotifCount = DB::table('notifications')
            ->where('type', 'Faculty Notification')
            ->where('reciever_id', Auth::id())
            ->count();

        $facultyNotification = DB::table('notifications')
            ->where('type', 'Faculty Notification')
            ->where('reciever_id', Auth::id())
            ->orderBy('date', 'desc')
            ->take(4)
            ->get();

        $studentNotifCount = DB::table('notifications')
            ->where('type', 'Student Notification')
            ->where('reciever_id', Auth::id())
            ->count();

        $studentNotification = DB::table('notifications')
            ->where('type', 'Student Notification')
            ->where('reciever_id', Auth::id())
            ->orderBy('date', 'desc')
            ->take(4)
            ->get();

        $staffNotifCount = DB::table('notifications')
            ->where('type', 'Staff Notification')
            ->where('reciever_id', Auth::id())
            ->count();

        $staffNotification = DB::table('notifications')
            ->where('type', 'Staff Notification')
            ->where('reciever_id', Auth::id())
            ->orderBy('date', 'desc')
            ->take(4)
            ->get();

        return View::make('assessment.firstPage',compact('faculty','student','staff','admin','adminNotifCount','adminNotification','facultyNotifCount','facultyNotification','studentNotifCount','studentNotification','staffNotifCount','staffNotification'));
    }

    public function secondPage(Request $request)
    {
        $faculty = DB::table('faculty')
            ->join('users','users.id','faculty.user_id')
            ->select('faculty.*','users.*')
            ->where('user_id',Auth::id())
            ->first();

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

        $admin = DB::table('staff')
            ->join('users','users.id','staff.user_id')
            ->select('staff.*','users.*')
            ->where('user_id',Auth::id())
            ->first();

        $validatedData = $request->validate([
            'name' => 'nullable|string',
            'address' => 'required',
            'age' => 'required',
            'status' => 'required',
            'phone' => 'required',
            'sex' => 'required',
            'education_level' => 'required',
            'employment' => 'nullable|string',
            'employment_state' => 'nullable|string',
            'training1' => 'nullable|string',
            'training2' => 'nullable|string',
            'training3' => 'nullable|string',
        ]);

        $extension = DB::table('extension')->get();

        $request->session()->put('form_data', $validatedData);

        $session = session('form_data');

        return view('assessment.secondPage', compact('session','extension'));
    }

    public function submiting(Request $request)
    {
        $faculty = DB::table('faculty')
            ->join('users','users.id','faculty.user_id')
            ->select('faculty.*','users.*')
            ->where('user_id',Auth::id())
            ->first();

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

        $admin = DB::table('staff')
            ->join('users','users.id','staff.user_id')
            ->select('staff.*','users.*')
            ->where('user_id',Auth::id())
            ->first();

        $existingData = $request->session()->get('form_data', []);

        $training_cheker = $existingData['training1'] ?? null;

        $assessment = new Assessment;
        $assessment->rank1 = $request->rank1;
        $assessment->rank2 = $request->rank2;
        $assessment->rank3 = $request->rank3;
        $assessment->rank4 = $request->rank4;
        $assessment->rank5 = $request->rank5;
        $assessment->rank6 = $request->rank6;
        $assessment->rank7 = $request->rank7;
        $assessment->date = now();

        if ($training_cheker != null) {
            $assessment->training = 'There Is';
        } else {
            $assessment->training = 'None';
        }
        
        $assessment->name = $existingData['name'] ?? null;
        $assessment->address = $existingData['address'] ?? null;
        $assessment->age = $existingData['age'] ?? null;
        $assessment->status = $existingData['status'] ?? null;
        $assessment->phone = $existingData['phone'] ?? null;
        $assessment->sex = $existingData['sex'] ?? null;
        $assessment->education_level = $existingData['education_level'] ?? null;
        $assessment->employment = $existingData['employment'] ?? null;
        $assessment->employment_state = $existingData['employment_state'] ?? null;
        $assessment->training1 = $existingData['training1'] ?? null;
        $assessment->training2 = $existingData['training2'] ?? null;
        $assessment->training3 = $existingData['training3'] ?? null;

        $assessment->save();

        $request->session()->flush();
        
        return redirect()->to('/forms/community-survey-training-needs/submitted')->with('success', "Thank you for your feedback! We are glad you had a positive experience. Your input is valued, and were committed to improving. Have a great day!");
    }

    public function submittedPage()
    {
        $faculty = DB::table('faculty')
            ->join('users','users.id','faculty.user_id')
            ->select('faculty.*','users.*')
            ->where('user_id',Auth::id())
            ->first();

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

        $admin = DB::table('staff')
            ->join('users','users.id','staff.user_id')
            ->select('staff.*','users.*')
            ->where('user_id',Auth::id())
            ->first();

        return View::make('assessment.thirdPage',compact('faculty','student','staff','admin'));
    }

    //Mobile Start
    public function MobilesecondPage(Request $request)
    {
        $extensions = DB::table('extension')->get();

        return response()->json(['extensions' => $extensions]);
    }

    public function Mobilesubmiting(Request $request)
    {

        $training_cheker = $request->training1;;
        $ranks = $request->ranks;

        $assessment = new Assessment;
        $assessment->rank1 = $ranks[0];
        $assessment->rank2 = $ranks[1];
        $assessment->rank3 = $ranks[2];
        $assessment->rank4 = $ranks[3];
        $assessment->rank5 = $ranks[4];
        $assessment->rank6 = $ranks[5];
        $assessment->rank7 = $ranks[6];
        $assessment->date = now();

        // Assuming $training_cheker is defined somewhere above
        if ($training_cheker != null) {
            $assessment->training = 'There Is';
        } else {
            $assessment->training = 'None';
        }
        
        $assessment->name = $request->name;
        $assessment->address = $request->address;
        $assessment->age = $request->age;
        $assessment->status = $request->status;
        $assessment->sex = $request->sex;
        $assessment->phone = $request->phone;
        $assessment->education_level = $request->education_level;
        $assessment->employment = $request->employment;
        $assessment->employment_state = $request->employment_state;
        $assessment->training1 = $request->training1;
        $assessment->training2 = $request->training2;
        $assessment->training3 = $request->training3;

        $assessment->save();
        
        // Prepare JSON response
        $response = [
            'success' => true,
            'message' => "Thank you for your feedback! We are glad you had a positive experience. Your input is valued, and we're committed to improving. Have a great day!"
        ];

        return response()->json($response);
    }
    //Mobile End
}
