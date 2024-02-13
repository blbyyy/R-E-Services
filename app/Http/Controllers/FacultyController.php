<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubjectAdviserApproval;
use App\Mail\TechnicalAdviserApprovalSuccess;
use App\Mail\TechnicalAdviserApprovalReject;
use App\Mail\SubjectAdviserApprovalSuccess;
use App\Mail\SubjectAdviserApprovalReject;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use App\Models\RequestingForm;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\User;
use App\Models\Files; 
use View;
use DB;
use File;
use Auth;

class FacultyController extends Controller
{
    public function registration_page()
    {
        $department = Department::orderBy('id')->get();

        return View::make('faculty.register',compact('department'));
    }

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

            $faculty = new Faculty;
            $faculty->fname = $request->fname;
            $faculty->lname = $request->lname;
            $faculty->mname = $request->mname;
            $faculty->department_id = $request->department;
            $faculty->position = $request->position;
            $faculty->designation = $request->designation;
            $faculty->tup_id = $request->tup_id;
            $faculty->email = $request->email;
            $faculty->gender = $request->gender;
            $faculty->phone = $request->phone;
            $faculty->address = $request->address;
            $faculty->birthdate = $request->birthdate;
            $faculty->user_id = $last;
            $faculty->save();

            auth()->login($users, true);

            return redirect()->to('/homepage');

    }

    public function profile($id)
    {
        $faculty = DB::table('faculty')
        ->join('users','users.id','faculty.user_id')
        ->join('departments','departments.id','faculty.department_id')
        ->select('faculty.*','users.*','departments.*')
        ->where('user_id',Auth::id())
        ->first();
        
        return View::make('faculty.profile',compact('faculty'));
    }

    public function updateprofile(Request $request, $id)
    {
        $faculty_id = DB::table('faculty')
        ->select('faculty.id')
        ->where('user_id',Auth::id())
        ->first();

        $faculty = Faculty::find($faculty_id->id);
        $faculty->fname = $request->fname;
        $faculty->lname = $request->lname;
        $faculty->mname = $request->mname;
        $faculty->department = $request->department;
        $faculty->position = $request->position;
        $faculty->designation = $request->designation;
        $faculty->tup_id = $request->fid;
        $faculty->email = $request->email;
        $faculty->gender = $request->gender;
        $faculty->phone = $request->phone;
        $faculty->address = $request->address;
        $faculty->birthdate = $request->birthdate;

        $user = User::find(Auth::id());
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->mname = $request->mname;
        $user->email = $request->email;
        $user->save();

        Alert::success('Success', 'Profile was successfully updated');

        return redirect()->to('/faculty/profile/{id}')->with('success', 'Profile was successfully updated');
    }

    public function changeavatar(Request $request)
    {
        $faculty = DB::table('faculty')
        ->select('faculty.id')
        ->where('user_id',Auth::id())
        ->first();

        $faculty = Faculty::find($faculty->id);
        $files = $request->file('avatar');
        $faculty->avatar = 'images/'.time().'-'.$files->getClientOriginalName();

        $faculty->save();

        $data = array('status' => 'saved');
        Storage::put('public/images/'.time().'-'.$files->getClientOriginalName(), file_get_contents($files));
        $faculty->save();

        Alert::success('Success', 'Avatar changed successfully!');

        return redirect()->to('/faculty/profile/{id}')->with('success', 'Avatar changed successfully.');
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
            return redirect()->to('/Faculty/Profile/{id}')->with('success', 'Password changed successfully.');
        }
    }

    public function myfiles()
    {
        $faculty = DB::table('faculty')
        ->join('users','users.id','faculty.user_id')
        ->select('faculty.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $myfiles = DB::table('files')
        ->join('users', 'users.id', '=', 'files.user_id')
        ->join('faculty', 'faculty.user_id', '=', 'users.id') // Join with the students table
        ->select('files.*') // Select columns from requestingform, users, and students
        ->where('files.user_id', Auth::id())
        ->get();

        return View::make('faculty.myfiles',compact('faculty','myfiles'));
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

        return redirect()->to('/faculty/myfiles');
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
        $faculty = DB::table('faculty')
        ->join('users','users.id','faculty.user_id')
        ->select('faculty.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $myfiles = DB::table('files')
        ->join('users', 'users.id', '=', 'files.user_id')
        ->join('faculty', 'faculty.user_id', '=', 'users.id')
        ->select('files.*') 
        ->where('files.user_id', Auth::id())
        ->get();

        $advisers = DB::table('faculty')
        ->join('departments', 'departments.id', '=', 'faculty.department_id')
        ->select('faculty.*','departments.department_name','departments.id as department_id') 
        ->get();
        
        return View::make('faculty.requesting',compact('faculty','myfiles','advisers'));
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

        $faculty =  Faculty::where('user_id',Auth::id())->first();

        $advisers = Faculty::orderBy('id')->get();

        $facultyfullname = $faculty->fname .' '. $faculty->mname .' '. $faculty->lname;

            $form = new RequestingForm;
            $form->date = now();
            $form->email_address = $faculty->email;
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

            // $form->adviser_id = $request->adviser_id;

            // $adviser_email = DB::table('faculty')
            // ->where('id', $request->adviser_id)
            // ->value('email');

            // $form->adviser_email = $adviser_email;

            $form->research_specialist = 'tba';
            $form->research_staff = 'tba';
            $form->tup_id = $faculty->email;
            $form->requestor_name = $facultyfullname;
            $form->tup_mail = $faculty->email;
            $form->sex = $faculty->gender;
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
            $form->user_id = $faculty->user_id;
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
        $faculty = DB::table('faculty')
        ->join('users','users.id','faculty.user_id')
        ->select('faculty.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $facultystats = DB::table('requestingform')
        ->join('users', 'users.id', 'requestingform.user_id')
        ->join('files', 'files.id', 'requestingform.research_id')
        ->select('requestingform.*', 'files.research_title')
        ->where('requestingform.user_id', Auth::id())
        ->get();

        return View::make('faculty.applicationstatus',compact('faculty', 'facultystats'));
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

    public function students_application()
    {
        $faculty = DB::table('faculty')
        ->join('users','users.id','faculty.user_id')
        ->select('faculty.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $faculty_id = DB::table('faculty')
            ->where('user_id', Auth::id())
            ->value('id');
        
        $application = DB::table('requestingform')
            ->join('users', 'users.id', 'requestingform.user_id')
            ->join('students', 'users.id', 'students.user_id')
            ->join('files', 'files.id', 'requestingform.research_id')
            ->select('requestingform.*','files.id as file_id','files.research_title')
            ->where(function($query) use ($faculty_id) {
                $query->where('requestingform.technicalAdviser_id', $faculty_id)
                      ->where('requestingform.status', 'Pending Technical Adviser Approval');
            })
            ->orWhere(function($query) use ($faculty_id) {
                $query->where('requestingform.subjectAdviser_id', $faculty_id)
                      ->where('requestingform.status', 'Pending Subject Adviser Approval');
            })
            ->get();
        

        return View::make('faculty.student_application',compact('application','faculty'));
    }

    public function students_application_specific($id)
    {
        // $application = DB::table('requestingform')
        // ->join('faculty', 'faculty.id', '=', 'requestingform.technicalAdviser_id')
        // ->join('files', 'files.id', '=', 'requestingform.research_id')
        // ->where('requestingform.id', $id)
        // ->select(
        //     'requestingform.*',
        //     'files.id as files_id', 'files.research_file',
        //     'faculty.id as faculty_id',
        //     DB::raw("CONCAT(faculty.fname, ' ', faculty.lname, ' ', faculty.mname) as TechnicalAdviserName"),
        //     DB::raw("CONCAT(faculty.fname, ' ', faculty.lname, ' ', faculty.mname) as SubjectAdviserName")
        // )
        // ->first();
        $application = DB::table('requestingform')
            ->join('faculty as technical_adviser', 'technical_adviser.id', '=', 'requestingform.technicalAdviser_id')
            ->join('faculty as subject_adviser', 'subject_adviser.id', '=', 'requestingform.subjectAdviser_id')
            ->join('files', 'files.id', '=', 'requestingform.research_id')
            ->where('requestingform.id', $id)
            ->select(
                'requestingform.*',
                'files.id as files_id',
                'files.research_file',
                'technical_adviser.id as technical_adviser_id',
                'subject_adviser.id as subject_adviser_id',
                DB::raw("CONCAT(technical_adviser.fname, ' ', technical_adviser.lname, ' ', technical_adviser.mname) as TechnicalAdviserName"),
                DB::raw("CONCAT(subject_adviser.fname, ' ', subject_adviser.lname, ' ', subject_adviser.mname) as SubjectAdviserName")
            )
            ->first();
    
        return response()->json($application);
    }

    public function technicalAdviserApproval($id)
    {
        $specificData = DB::table('requestingform')
        ->join('files', 'files.id', 'requestingform.research_id')
        ->join('users', 'users.id', 'requestingform.user_id')
        ->select('requestingform.*', 'files.*')
        ->where('requestingform.id', $id)
        ->first();

        return response()->json($specificData);

    }

    public function sendingTechnicalAdviserApproval(Request $request, $id)
    {
        if ($request->technicalAdviserRemarks === null) {
                
                $form = RequestingForm::find($id);
                $form->status = $request->technicalAdviserStatus;
                $form->save();

                $file = Files::find($request->fileId1);
                $file->file_status = $request->technicalAdviserStatus;
                $file->save();

                $subjectAdviser = DB::table('requestingform')
                ->where('id', $id)
                ->first();

                $research = DB::table('files')
                ->where('id', $subjectAdviser->research_id)
                ->first();

                $subjectAdviserName = DB::table('faculty')
                ->select(DB::raw("CONCAT(fname, ' ', COALESCE(mname, ''), ' ', lname) AS subjectAdviserName"))
                ->where('id', $subjectAdviser->subjectAdviser_id)
                ->value('subjectAdviserName');

                $technicalAdviserName = DB::table('faculty')
                ->select(DB::raw("CONCAT(fname, ' ', COALESCE(mname, ''), ' ', lname) AS technicalAdviserName"))
                ->where('id', $subjectAdviser->technicalAdviser_id)
                ->value('technicalAdviserName');

                $data = [
                    'subjectAdviserName' => $subjectAdviserName,
                ];
                Mail::to($subjectAdviser->subjectAdviserEmail)->send(new SubjectAdviserApproval($data));

                $success = [
                    'requestorName' => $subjectAdviser->requestor_name,
                    'researchTitle' => $research->research_title,
                    'technicalAdviserName' => $technicalAdviserName
                ];
                Mail::to($subjectAdviser->email_address)->send(new TechnicalAdviserApprovalSuccess($success));

            return response()->json($form);

        } else {

                $form = RequestingForm::find($id);
                $form->status = $request->technicalAdviserStatus;
                $form->remarks = $request->technicalAdviserRemarks;
                $form->save();

                $file = Files::find($request->fileId1);
                $file->file_status = $request->technicalAdviserStatus;
                $file->save();

                $subjectAdviser = DB::table('requestingform')
                ->where('id', $id)
                ->first();

                $technicalAdviserName = DB::table('faculty')
                ->select(DB::raw("CONCAT(fname, ' ', COALESCE(mname, ''), ' ', lname) AS technicalAdviserName"))
                ->where('id', $subjectAdviser->technicalAdviser_id)
                ->value('technicalAdviserName');

                $research = DB::table('files')
                ->where('id', $subjectAdviser->research_id)
                ->first();

                $reject = [
                    'requestorName' => $subjectAdviser->requestor_name,
                    'researchTitle' => $research->research_title,
                    'remarks' => $request->technicalAdviserRemarks,
                    'technicalAdviserName' => $technicalAdviserName
                ];
                Mail::to($subjectAdviser->email_address)->send(new TechnicalAdviserApprovalReject($reject));

            return response()->json($form);
            
        }

           

            
    }

    public function subjectAdviserApproval($id)
    {
        $specificData = DB::table('requestingform')
        ->join('files', 'files.id', 'requestingform.research_id')
        ->join('users', 'users.id', 'requestingform.user_id')
        ->select('requestingform.*', 'files.*')
        ->where('requestingform.id', $id)
        ->first();

        return response()->json($specificData);

    }

    public function sendingSubjectAdviserApproval(Request $request, $id)
    {
        if ($request->subjectAdviserRemarks === null) {
                
                $form = RequestingForm::find($id);
                $form->status = $request->subjectAdviserStatus;
                $form->save();

                $file = Files::find($request->fileId2);
                $file->file_status = $request->subjectAdviserStatus;
                $file->save();

                $subjectAdviser = DB::table('requestingform')
                ->where('id', $id)
                ->first();

                $research = DB::table('files')
                ->where('id', $subjectAdviser->research_id)
                ->first();

                $subjectAdviserName = DB::table('faculty')
                ->select(DB::raw("CONCAT(fname, ' ', COALESCE(mname, ''), ' ', lname) AS subjectAdviserName"))
                ->where('id', $subjectAdviser->subjectAdviser_id)
                ->value('subjectAdviserName');

                $success = [
                    'requestorName' => $subjectAdviser->requestor_name,
                    'researchTitle' => $research->research_title,
                    'subjectAdviserName' => $subjectAdviserName
                ];
                Mail::to($subjectAdviser->email_address)->send(new SubjectAdviserApprovalSuccess($success));             

            return response()->json($form);

        } else {

                $form = RequestingForm::find($id);
                $form->status = $request->subjectAdviserStatus;
                $form->remarks = $request->subjectAdviserRemarks;
                $form->save();

                $file = Files::find($request->fileId2);
                $file->file_status = $request->subjectAdviserRemarks;
                $file->save();

                $subjectAdviser = DB::table('requestingform')
                ->where('id', $id)
                ->first();

                $subjectAdviserName = DB::table('faculty')
                ->select(DB::raw("CONCAT(fname, ' ', COALESCE(mname, ''), ' ', lname) AS subjectAdviserName"))
                ->where('id', $subjectAdviser->subjectAdviser_id)
                ->value('subjectAdviserName');

                $research = DB::table('files')
                ->where('id', $subjectAdviser->research_id)
                ->first();

                $reject = [
                    'requestorName' => $subjectAdviser->requestor_name,
                    'researchTitle' => $research->research_title,
                    'remarks' => $request->subjectAdviserRemarks,
                    'subjectAdviserName' => $subjectAdviserName
                ];
                Mail::to($subjectAdviser->email_address)->send(new SubjectAdviserApprovalReject($reject));

            return response()->json($form);
            
        }
                   
    }
}
