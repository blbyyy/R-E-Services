<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        $session1 = session('form_data');

        return view('csm.secondPage', ['session1' => $session1]);
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

            $session2 = session('form_data');

            return view('csm.thirdPage', ['session2' => $session2]);

        } else {
            
            $existingData = $request->session()->get('form_data', []);

            $validatedData = array_merge($existingData, $request->validate([
                'cc1' => 'nullable|string',
            ]));

            $request->session()->put('form_data', $validatedData);

            $session2 = session('form_data');

            return view('csm.thirdPage', ['session2' => $session2]);

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

            return view('csm.fourthPage', ['session' => $session]);

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
            ]));

            $request->session()->put('form_data', $validatedData);

            $session = session('form_data');

            return view('csm.fifthPage', ['session' => $session]);

        } else {
            
            $existingData = $request->session()->get('form_data', []);

            $validatedData = array_merge($existingData, $request->validate([
                'cc3' => 'nullable|string',
            ]));

            $request->session()->put('form_data', $validatedData);

            $session = session('form_data');

            return view('csm.fifthPage', ['session' => $session]);

        }
        
        
    }

}
