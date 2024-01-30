<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Laravel\Socialite\Facades\Socialite;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Staff;
use App\Models\User;
use App\Models\Files; 
use App\Models\RequestingForm;
use View;
use DB;
use File;
use Auth;

class StaffController extends Controller
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

            $staff = new Staff;
            $staff->fname = $request->fname;
            $staff->lname = $request->lname;
            $staff->mname = $request->mname;
            $staff->position = $request->position;
            $staff->designation = $request->designation;
            $staff->tup_id = $request->tup_id;
            $staff->email = $request->email;
            $staff->gender = $request->gender;
            $staff->phone = $request->phone;
            $staff->address = $request->address;
            $staff->birthdate = $request->birthdate;
            $staff->user_id = $last;
            $staff->save();

            auth()->login($users, true);

            return redirect()->to('/homepage');

    }

    public function profile($id)
    {
        $staff = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        return View::make('staff.profile',compact('staff'));
    }

    public function updateprofile(Request $request, $id)
    {
        $staff_id = DB::table('staff')
        ->select('staff.id')
        ->where('user_id',Auth::id())
        ->first();

        $staff = Staff::find($staff_id->id);
        $staff->fname = $request->fname;
        $staff->lname = $request->lname;
        $staff->mname = $request->mname;
        $staff->position = $request->position;
        $staff->designation = $request->designation;
        $staff->tup_id = $request->tup_id;
        $staff->email = $request->email;
        $staff->gender = $request->gender;
        $staff->phone = $request->phone;
        $staff->address = $request->address;
        $staff->birthdate = $request->birthdate;

        $user = User::find(Auth::id());
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->mname = $request->mname;
        $user->email = $request->email;
        $user->save();

        return redirect()->to('/Staff/Profile/{id}');
    }

    public function changeavatar(Request $request)
    {
        $staff = DB::table('staff')
        ->select('staff.id')
        ->where('user_id',Auth::id())
        ->first();

        $staff = Staff::find($staff->id);
        $files = $request->file('avatar');
        $staff->avatar = 'images/'.time().'-'.$files->getClientOriginalName();

        $staff->save();

        $data = array('status' => 'saved');
        Storage::put('public/images/'.time().'-'.$files->getClientOriginalName(), file_get_contents($files));
        $staff->save();

        Alert::success('Success', 'Avatar changed successfully!');

        return redirect()->to('/Staff/Profile/{id}')->with('success', 'Avatar changed successfully.');
    }

    public function validatePassword(Request $request)
    {
        $enteredPassword = $request->input('password');
        $user = Auth::user();

        // Check if the entered password matches the stored hashed password
        $isMatch = Hash::check($enteredPassword, $user->password);

        return response()->json(['match' => $isMatch]);
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
            return redirect()->to('/Staff/Profile/{id}')->with('success', 'Password changed successfully.');
        }
        
    }

    public function myfiles()
    {
        $staff = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $myfiles = DB::table('files')
        ->join('users', 'users.id', '=', 'files.user_id')
        ->join('staff', 'staff.user_id', '=', 'users.id') // Join with the students table
        ->select('files.*') // Select columns from requestingform, users, and students
        ->where('files.user_id', Auth::id())
        ->get();

        return View::make('staff.myfiles',compact('staff','myfiles'));
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

        return redirect()->to('/staff/myfiles');
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

        return response()->json($response);
    }

    public function pdfinfo($id)
    {
        $cert = Files::find($id);
        return response()->json($cert);
    }

    public function certification()
    {
        $staff = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $myfiles = DB::table('files')
        ->join('users', 'users.id', '=', 'files.user_id')
        ->join('staff', 'staff.user_id', '=', 'users.id')
        ->select('files.*') 
        ->where('files.user_id', Auth::id())
        ->get();
        
        return View::make('staff.requesting',compact('staff','myfiles'));
    }

    public function apply_certification(Request $request, $id)
    {
        $submission = DB::table('requestingform')
        ->join('users', 'users.id', 'requestingform.user_id')
        ->join('files', 'files.id', 'requestingform.research_id')
        ->where('requestingform.research_id', $request->research_id)
        ->selectRaw(
            'CASE 
                WHEN COUNT(*) = 0 THEN "First Submission"
                WHEN COUNT(*) = 1 THEN "Second Submission"
                WHEN COUNT(*) = 2 THEN "Third Submission"
                WHEN COUNT(*) = 3 THEN "Fourth Submission"
                WHEN COUNT(*) = 4 THEN "Fifth Submission"
                WHEN COUNT(*) = 5 THEN "Sixth Submission"
                ELSE "Other Submission" 
            END as submission_frequency')
        ->value('submission_frequency');

        $latestPercentage = DB::table('requestingform')
            ->join('users', 'users.id', 'requestingform.user_id')
            ->join('files', 'files.id', 'requestingform.research_id')
            ->select('requestingform.simmilarity_percentage_results')
            ->where('requestingform.research_id', $request->research_id)
            ->orderBy('requestingform.id', 'desc') 
            ->value('simmilarity_percentage_results');

        $staff =  Staff::where('user_id',Auth::id())->first();

        $stafffullname = $staff->fname .' '. $staff->mname .' '. $staff->lname;

            $form = new RequestingForm;
            $form->date = now();
            $form->email_address = $staff->email;
            $form->thesis_type = $request->thesis_type;
            
            $form->submission_frequency = $submission;
            $form->initial_simmilarity_percentage = 0;

            if ($submission === 'First Submission') {
                $form->advisors_turnitin_precheck = 'No';
                $form->initial_simmilarity_percentage = 0;
            } else {
                $form->advisors_turnitin_precheck = 'Yes';
                $form->initial_simmilarity_percentage = $latestPercentage;
            } 

            $form->research_specialist = 'tba';
            $form->research_staff = 'tba';
            $form->tup_id = $staff->tup_id;
            $form->requestor_name = $stafffullname;
            $form->tup_mail = $staff->email;
            $form->sex = $staff->gender;
            $form->requestor_type = $request->requestor_type;
            $form->college = $request->college;
            $form->course = $request->course;
            $form->purpose = 'Certification';
            $form->researchers_name1 = $request->researchers_name1;
            $form->researchers_name2 = $request->researchers_name2;
            $form->researchers_name3 = $request->researchers_name3;
            $form->researchers_name4 = $request->researchers_name4;
            $form->researchers_name5 = $request->researchers_name5;
            $form->researchers_name6 = $request->researchers_name6;
            $form->researchers_name7 = $request->researchers_name7;
            $form->researchers_name8 = $request->researchers_name8;
            $form->agreement = $request->agreement;
            $form->score = 0;
            $form->research_id = $request->research_id;
            $form->user_id = $staff->user_id;
            $form->status = 'Pending';
            $form->save();

            $file = Files::find($request->research_id);
            $file->file_status = 'Pending';
            $file->save();

            return response()->json(["form" => $form, "file" => $file ]);

    }

    public function re_apply_getfile_id($id)
    {
        $file = RequestingForm::find($id);
        return response()->json($file);
    }

    public function reApply(Request $request, $id)
    {
        $latestApplication = DB::table('requestingform')
            ->join('users', 'users.id', 'requestingform.user_id')
            ->join('files', 'files.id', 'requestingform.research_id')
            ->select('requestingform.*')
            ->where('requestingform.research_id', $request->reApplyResearchId)
            ->orderBy('requestingform.created_at', 'desc') 
            ->first();
        
        $latestPercentage = DB::table('requestingform')
            ->join('users', 'users.id', 'requestingform.user_id')
            ->join('files', 'files.id', 'requestingform.research_id')
            ->select('requestingform.simmilarity_percentage_results')
            ->where('requestingform.research_id', $request->reApplyResearchId)
            ->orderBy('requestingform.id', 'desc') 
            ->value('simmilarity_percentage_results');

        $submission = DB::table('requestingform')
            ->join('users', 'users.id', 'requestingform.user_id')
            ->join('files', 'files.id', 'requestingform.research_id')
            ->where('requestingform.research_id', $request->reApplyResearchId)
            ->selectRaw(
                'CASE 
                    WHEN COUNT(*) = 0 THEN "First Submission"
                    WHEN COUNT(*) = 1 THEN "Second Submission"
                    WHEN COUNT(*) = 2 THEN "Third Submission"
                    WHEN COUNT(*) = 3 THEN "Fourth Submission"
                    WHEN COUNT(*) = 4 THEN "Fifth Submission"
                    WHEN COUNT(*) = 5 THEN "Sixth Submission"
                    ELSE "Other Submission" 
                END as submission_frequency')
            ->value('submission_frequency');

            $form = new RequestingForm;
            $form->date = now();
            $form->email_address = $latestApplication->email_address;
            $form->thesis_type = $latestApplication->thesis_type;
            $form->submission_frequency = $submission;
            $form->simmilarity_percentage_results = 0;
            $form->advisors_turnitin_precheck = 'Yes';
            $form->initial_simmilarity_percentage = $latestPercentage;
            $form->adviser_id = $latestApplication->adviser_id;

            $adviser_email = DB::table('faculty')
            ->where('id', $latestApplication->adviser_id)
            ->value('email');

            $form->adviser_email = $adviser_email;
            
            $form->research_specialist = 'tba';
            $form->tup_id = $latestApplication->tup_id;
            $form->requestor_name = $latestApplication->requestor_name;
            $form->tup_mail = $latestApplication->tup_mail;
            $form->sex = $latestApplication->sex;
            $form->requestor_type = $latestApplication->requestor_type;
            $form->college = $latestApplication->college;
            $form->course = $latestApplication->course;
            $form->purpose = $latestApplication->purpose;
            $form->researchers_name1 = $latestApplication->researchers_name1;
            $form->researchers_name2 = $latestApplication->researchers_name2;
            $form->researchers_name3 = $latestApplication->researchers_name3;
            $form->researchers_name4 = $latestApplication->researchers_name4;
            $form->researchers_name5 = $latestApplication->researchers_name5;
            $form->researchers_name6 = $latestApplication->researchers_name6;
            $form->researchers_name7 = $latestApplication->researchers_name7;
            $form->researchers_name8 = $latestApplication->researchers_name8;
            $form->agreement = $latestApplication->agreement;
            $form->score = 0;
            $form->research_staff = 'tba';
            $form->research_id = $latestApplication->research_id;
            $form->user_id = $latestApplication->user_id;
            $form->status = 'Pending';
            $form->save();

            if ($submission === 'First Submission') {
                $file = Files::find($request->reApplyResearchId);
                $file->file_status = 'Pending';
                $file->save();
            } else {
                $request->validate([
                    'research_file' => 'required|mimes:pdf|max:10240', // PDF file validation with a maximum size of 10MB
                ]);
                
                $file = Files::find($request->reApplyResearchId);
                $file->file_status = 'Pending';

                $pdfFile = $request->file('research_file');
                $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
                $pdfFile->move(public_path('uploads/pdf'), $pdfFileName);
                
                $file->research_file = $pdfFileName;

                $file->save();
            } 

            return response()->json(["form" => $form, "file" => $file ]);

    }

    public function application_status()
    {
        $staff = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $staffstats = DB::table('requestingform')
        ->join('users', 'users.id', 'requestingform.user_id')
        ->join('files', 'files.id', 'requestingform.research_id')
        ->select('requestingform.*', 'files.research_title')
        ->where('requestingform.user_id', Auth::id())
        ->get();

        return View::make('staff.applicationstatus',compact('staff', 'staffstats'));
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

    //MOBILE START
    public function getProfile($id)
    {
            $staff = DB::table('staff')
                ->join('users', 'users.id', 'staff.user_id')
                ->select('staff.*', 'users.*')
                ->where('user_id', $id)
                ->first();   

        return response()->json($staff);
    }
    //MOBILE END
}
