<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerSatisfactionSurvey;
use View, DB, Auth, File, Session, Redirect;

use Illuminate\Support\Facades\Log;

class CustomerSatisfactionSurveyController extends Controller
{
    public function index()
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

        return View::make('survey.index',compact('faculty','student','staff','admin','adminNotifCount','adminNotification','facultyNotifCount','facultyNotification','studentNotifCount','studentNotification','staffNotifCount','staffNotification'));
    }

    public function session1(Request $request)
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
            'email' => 'required|email',
            'rated_department' => 'required',
            'transaction_purpose' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'facilitator' => 'required',
            'name' => 'nullable|string',
            'email_address' => 'required|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'company' => 'nullable|string',
            'customer_feedback' => 'nullable|string',
            'customer_remarks' => 'nullable|string',
        ]);

        $request->session()->put('form_data', $validatedData);

        $session = session('form_data');

        return view('survey.secondPage', compact('session'));
    }

    public function session2(Request $request)
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

        $survey = new CustomerSatisfactionSurvey;
        $survey->a1 = $request->a1;
        $survey->a2 = $request->a2;
        $survey->a3 = $request->a3;
        $survey->a4 = $request->a4;
        $survey->a5 = $request->a5;
        $survey->a6 = $request->a6;

        $survey->email = $existingData['email'] ?? null;
        $survey->rated_department = $existingData['rated_department'] ?? null;
        $survey->transaction_purpose = $existingData['transaction_purpose'] ?? null;
        $survey->date = $existingData['date'] ?? null;
        $survey->time = $existingData['time'] ?? null;
        $survey->facilitator = $existingData['facilitator'] ?? null;
        $survey->name = $existingData['name'] ?? null;
        $survey->email_address = $existingData['email_address'] ?? null;
        $survey->phone = $existingData['phone'] ?? null;
        $survey->address = $existingData['address'] ?? null;
        $survey->company = $existingData['company'] ?? null;
        $survey->customer_feedback = $existingData['customer_feedback'] ?? null;
        $survey->customer_remarks = $existingData['customer_remarks'] ?? null;

        $survey->save();

        $request->session()->flush();
        
        return redirect()->to('/forms/customer-satisfaction-survey/submitted')->with('success', "Thank you for your feedback! We are glad you had a positive experience. Your input is valued, and were committed to improving. Have a great day!");
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

        return View::make('survey.thirdPage',compact('faculty','student','staff','admin'));
    }

    //Mobile Start
    public function mobilesession2(Request $request)
    {
        try {
            $survey = new CustomerSatisfactionSurvey;
            $survey->a1 = $request->rating1;
            $survey->a2 = $request->rating2;
            $survey->a3 = $request->rating3;
            $survey->a4 = $request->rating4;
            $survey->a5 = $request->rating5;
            $survey->a6 = $request->rating6;

            // Map other fields as needed
            $survey->email = $request->email;
            $survey->rated_department = $request->rated_department;
            $survey->transaction_purpose = $request->transaction_purpose;
            $survey->date = $request->date;
            $survey->time = $request->time;
            $survey->facilitator = $request->facilitator;
            $survey->name = $request->name;
            $survey->email_address = $request->email_address;
            $survey->phone = $request->phone;
            $survey->address = $request->address;
            $survey->company = $request->company;
            $survey->customer_feedback = $request->customer_feedback;
            $survey->customer_remarks = $request->customer_remarks;

            $survey->save();

            return response()->json([
                'success' => true,
                'message' => "Thank you for your feedback! We are glad you had a positive experience. Your input is valued, and we're committed to improving. Have a great day!",
                'survey' => $survey
            ]);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error saving survey data: ' . $e->getMessage(),
            ], 500);
        }
    }
    //Mobile End
}
