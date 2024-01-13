<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use RealRashid\SweetAlert\Facades\Alert;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\RequestingForm;
use App\Models\User;
use App\Models\Files; 
use View;
use DB;
use File;
use Auth;

class StudentController extends Controller
{
    public function register(Request $request)
    { 
            $users = new User;
            $users->fname = $request->fname;
            $users->lname = $request->lname;
            $users->mname = $request->mname;
            $users->email = $request->email;
            $users->password = bcrypt($request->password);
            $users->role = $request->role;   
            $users->save();
            $last = DB::getPdo()->lastInsertId();

            $students = new Student;
            $students->fname = $request->fname;
            $students->lname = $request->lname;
            $students->mname = $request->mname;
            $students->college = $request->college;
            $students->course = $request->course;
            $students->tup_id = $request->tup_id;
            $students->email = $request->email;
            $students->gender = $request->gender;
            $students->phone = $request->phone;
            $students->address = $request->address;
            $students->birthdate = $request->birthdate;
            $students->user_id = $last;
            $students->save();

            auth()->login($users, true);

            return redirect()->to('/homepage');

    }

    public function fillup()
    {
        $student = DB::table('students')
        ->join('users','users.id','students.user_id')
        ->select('students.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        return View::make('auth.fillup',compact('student'));
    }

    public function filled(Request $request)
    { 
        $student_id = DB::table('students')
        ->select('students.id')
        ->where('user_id',Auth::id())
        ->first();

        $student = Student::find($student_id->id);
        $student->mname = $request->mname;
        $student->college = $request->college;
        $student->course = $request->course;
        $student->tup_id = $request->tup_id;
        $student->gender = $request->gender;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->birthdate = $request->birthdate;

        if ($request->hasFile('avatar')) {
            $files = $request->file('avatar');
            $student->avatar = 'images/' . time() . '-' . $files->getClientOriginalName();
            Storage::put('public/images/'.time().'-'.$files->getClientOriginalName(), file_get_contents($files));
        } else {
            $student->avatar = 'avatar.jpg';
        }
        
        $student->save();

        $user = User::find(Auth::id());
        $user->mname = $request->mname;
        $user->save();

        return redirect()->to('/homepage')->with('success', 'User profile was set up properly.');

    }
    
    public function profile($id)
    {
        $student = DB::table('students')
        ->join('users','users.id','students.user_id')
        ->select('students.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        return View::make('students.profile',compact('student'));
    }

    public function updateprofile(Request $request, $id)
    {
        $student_id = DB::table('students')
        ->select('students.id')
        ->where('user_id',Auth::id())
        ->first();

        $student = Student::find($student_id->id);
        $student->fname = $request->fname;
        $student->lname = $request->lname;
        $student->mname = $request->mname;
        $student->college = $request->college;
        $student->course = $request->course;
        $student->tup_id = $request->tup_id;
        $student->gender = $request->gender;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->birthdate = $request->birthdate;

        $user = User::find(Auth::id());
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->mname = $request->mname;
        $user->save();

        Alert::success('Success', 'Profile was successfully updated');

        return redirect()->to('/Student/Profile/{id}')->with('success', 'Profile was successfully updated');
    }

    public function changeavatar(Request $request)
    {
        $students = DB::table('students')
        ->select('students.id')
        ->where('user_id',Auth::id())
        ->first();

        $student = Student::find($students->id);
        $files = $request->file('avatar');
        $student->avatar = 'images/'.time().'-'.$files->getClientOriginalName();

        $student->save();

        $data = array('status' => 'saved');
        Storage::put('public/images/'.time().'-'.$files->getClientOriginalName(), file_get_contents($files));
        $student->save();

        Alert::success('Success', 'Avatar changed successfully!');

        return redirect()->to('/Student/Profile/{id}')->with('success', 'Avatar changed successfully.');
    }
    
    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'newpassword' => 'required|min:8',
            'renewpassword' => 'required|same:newpassword',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            Alert::error('Error', 'Current password is incorrect.');
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }else {
            $user->update([
                'password' => Hash::make($request->newpassword),
            ]);
            Alert::success('Success', 'Password changed successfully!');
            return redirect()->to('/Student/Profile/{id}')->with('success', 'Password changed successfully.');
        }
    }
    
    public function validatePassword(Request $request)
    {
        $enteredPassword = $request->input('password');
        $user = Auth::user();

        // Check if the entered password matches the stored hashed password
        $isMatch = Hash::check($enteredPassword, $user->password);

        return response()->json(['match' => $isMatch]);
    }

    public function myfiles()
    {
        $student = DB::table('students')
        ->join('users','users.id','students.user_id')
        ->select('students.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $myfiles = DB::table('files')
        ->join('users', 'users.id', '=', 'files.user_id')
        ->join('students', 'students.user_id', '=', 'users.id') // Join with the students table
        ->select('files.*') // Select columns from requestingform, users, and students
        ->where('files.user_id', Auth::id())
        ->get();

        return View::make('students.myfiles',compact('student','myfiles'));
    }

    public function upload_file(Request $request)
    {
        $request->validate([
            'research_file' => 'required|mimes:pdf|max:2048', // PDF file validation
        ]);

        $file = new Files;
        $file->file_status = 'Available';
        $file->research_title = $request->research_title;

        $pdfFile = $request->file('research_file');
        $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
        $pdfFile->move(public_path('uploads/pdf'), $pdfFileName);
        
        $file->research_file = $pdfFileName;
        $file->user_id = Auth::id();
        $file->save();

        return redirect()->to('/student/myfiles');
    }

    public function showpdf($fileName)
    {
        $filePath = public_path("uploads/pdf/{$fileName}");

        return response()->file($filePath);
    }

    public function deletepdf(string $id)
    {
        try {
            // Find the file in the database
            $file = Files::findOrFail($id);

            // Get the file path from the database
            $filePath = $file->research_file;

            // Delete the file record from the database
            $file->delete();

            // Check if the file exists before attempting to delete it
            if (Storage::exists($filePath)) {
                // Attempt to delete the file from the uploads/pdf directory
                Storage::delete($filePath);
            }

            // If successful, return a success response
            $response = [
                'success' => 'File and record deleted',
                'code' => 200
            ];

            return response()->json($response);
        } catch (\Exception $e) {
            // If an error occurs during file deletion, log the error and return an error response
            \Log::error('Error deleting file: ' . $e->getMessage());

            $errorResponse = [
                'error' => 'Failed to delete file',
                'code' => 500
            ];

            return response()->json($errorResponse, 500);
        }
    }

    public function history($id)
    {
        $title = DB::table('requestingform')
            ->join('files', 'files.id', 'requestingform.research_id')
            ->select('files.*', 'requestingform.*')
            ->where('requestingform.research_id', $id)
            ->first();

        $history = DB::table('requestingform')
            ->join('files', 'files.id', 'requestingform.research_id')
            ->select('files.*', 'requestingform.*')
            ->where('requestingform.research_id', $id)
            ->orderBy('requestingform.date', 'asc') 
            ->get();

        $response = [
            'title' => $title,
            'history' => $history,
        ];
        
        // Return the array as JSON
        return response()->json($response);
    }

    public function pdfinfo($id)
    {
        $cert = Files::find($id);
        return response()->json($cert);
    }

    public function certification()
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
        
        return View::make('students.requesting',compact('student','myfiles'));
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

        return View::make('students.applicationstatus',compact('student', 'studentstats', 'staffstats', 'facultystats'));
    }

    public function show_application($id)
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

}