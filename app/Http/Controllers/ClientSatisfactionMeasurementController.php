<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Csm;
use App\Http\Redirect;
use View, DB, File, Auth, Session;

class ClientSatisfactionMeasurementController extends Controller
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

        return View::make('csm.firstPage',compact('faculty','student','staff','admin'));
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
            'office' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'email_address' => 'required|email',
            'name' => 'nullable|string',
            'type' => 'required',
            'purpose' => 'required|string',
            'assisted_by' => 'nullable|string',
        ]);

        $request->session()->put('form_data', $validatedData);

        $session = session('form_data');

        return view('csm.secondPage', ['session' => $session]);
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

        if ($request->cc1 === 'No, I am not aware of the CC') {
            
            $existingData = $request->session()->get('form_data', []);

            $validatedData = array_merge($existingData, $request->validate([
                'cc1' => 'nullable|string',
            ]));

            $request->session()->put('form_data', $validatedData);

            $session = session('form_data');

            return view('csm.fifthPage', ['session' => $session]);

        } else {
            
            $existingData = $request->session()->get('form_data', []);

            $validatedData = array_merge($existingData, $request->validate([
                'cc1' => 'nullable|string',
            ]));

            $request->session()->put('form_data', $validatedData);

            $session = session('form_data');

            return view('csm.thirdPage', ['session' => $session]);

        }
        
        
    }

    public function session3(Request $request)
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

        if ($request->cc2 === "No, I did not see this office's CC") {
            
            $existingData = $request->session()->get('form_data', []);

            $validatedData = array_merge($existingData, $request->validate([
                'cc2' => 'nullable|string',
            ]));

            $request->session()->put('form_data', $validatedData);

            $session = session('form_data');

            return view('csm.fifthPage', ['session' => $session]);

        } else {
            
            $existingData = $request->session()->get('form_data', []);

            $validatedData = array_merge($existingData, $request->validate([
                'cc2' => 'nullable|string',
            ]));

            $request->session()->put('form_data', $validatedData);

            $session = session('form_data');

            return view('csm.fourthPage', ['session' => $session]);

        }
        
        
    }

    public function session4(Request $request)
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

        if ($request->cc3 === "No, I was not able to use the CC") {
            
            $existingData = $request->session()->get('form_data', []);

            $validatedData = array_merge($existingData, $request->validate([
                'cc3' => 'nullable|string',
                'cc3_explanation' => 'nullable|string',
            ]));

            $request->session()->put('form_data', $validatedData);

            $session = session('form_data');

            return view('csm.fifthPage', ['session' => $session]);

        } else {
            
            $existingData = $request->session()->get('form_data', []);

            $validatedData = array_merge($existingData, $request->validate([
                'cc3' => 'nullable|string',
                'cc3_explanation' => 'nullable|string',
            ]));

            $request->session()->put('form_data', $validatedData);

            $session = session('form_data');

            return view('csm.fifthPage', ['session' => $session]);

        }
        
        
    }

    public function session5(Request $request)
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

        $csm = new Csm;
        $csm->q1 = "I spent an acceptable amount of time to complete my transaction (Responsiveness)";
        $csm->q2 = "The office accurately informed and followed the transaction's requirements and steps (Reliability)";
        $csm->q3 = "My online transaction (including steps and payment) was simple and convenient (Access and Facilities)";
        $csm->q4 = "I easily found information about my transaction from the office or its website (Communication)";
        $csm->q5 = "I paid an acceptable amount of fees for my transaction (Costs)";
        $csm->q6 = "I am confident my online transaction was secure (Integrity)";
        $csm->q7 = "The office's online support was available, or (if asked questions) onlin support was quick to respond (Assurance)";
        $csm->q8 = "I got what I needed from the government office (Outcome)";
        $csm->a1 = $request->a1;
        $csm->a2 = $request->a2;
        $csm->a3 = $request->a3;
        $csm->a4 = $request->a4;
        $csm->a5 = $request->a5;
        $csm->a6 = $request->a6;
        $csm->a7 = $request->a7;
        $csm->a8 = $request->a8;
        $csm->comprehensive_type = $request->comprehensive_type;
        $csm->complaint_message = $request->complaint_message;

        $csm->email = $existingData['email'];
        $csm->rated_office = $existingData['office'];
        $csm->date = $existingData['date'];
        $csm->time = $existingData['time'];
        $csm->email_address = $existingData['email_address'];
        $csm->name = $existingData['name'];
        $csm->user_type = $existingData['type'];
        $csm->transaction_purpose = $existingData['purpose'];
        $csm->facilitator = $existingData['assisted_by'];
        $csm->cc1 = $existingData['cc1'];
        $csm->cc2 = $existingData['cc2'];
        $csm->cc3 = $existingData['cc3'];
        $csm->cc3_explanation = $existingData['cc3_explanation'];

        $csm->save();

        $request->session()->flush();
        
        return redirect()->to('/sixthPage')->with('success', 'Your Proposal has been sent to Board and OSG; kindly wait the result if the result is out we immediately contact you.');
    }

    public function sixthPage()
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

        return View::make('csm.sixthPage',compact('faculty','student','staff','admin'));
    }

}
