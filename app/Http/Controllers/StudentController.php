<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Algolia\AlgoliaSearch\SearchClient;
use Illuminate\Support\Facades\Mail;
use App\Mail\TechnicalAdviserApproval;
use RealRashid\SweetAlert\Facades\Alert;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Notifications;
use App\Models\RequestAccess;
use App\Models\Research;
use App\Models\Faculty;
use App\Models\RequestingForm;
use App\Models\User;
use App\Models\Files; 
use View;
use DB;
use File;
use Auth;

//MOBILE
use Illuminate\Support\Facades\Log;

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
            $users->role = 'Student';   
            $users->save();
            $last = DB::getPdo()->lastInsertId();

            $students = new Student;
            $students->fname = $request->fname;
            $students->lname = $request->lname;
            $students->mname = $request->mname;
            $students->college = 'TUPT';
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

            return redirect()->to('/homepage')->with('success', 'Student Profile Successfully Created.');

    }

    public function fillup()
    {
        $student = DB::table('students')
        ->join('users','users.id','students.user_id')
        ->select('students.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

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

        return View::make('auth.fillup',compact('student','studentNotifCount','studentNotification'));
    }

    public function filled(Request $request)
    { 
        $student_id = DB::table('students')
        ->select('students.id')
        ->where('user_id',Auth::id())
        ->first();

        $student = Student::find($student_id->id);
        $student->mname = $request->mname;
        $student->college = 'TUPT';
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

        $studentNotifCount = DB::table('notifications')
            ->where('type', 'Student Notification')
            ->where('reciever_id', Auth::id())
            ->where('status', 'not read')
            ->count();

        $studentNotification = DB::table('notifications')
            ->where('type', 'Student Notification')
            ->where('reciever_id', Auth::id())
            ->orderBy('date', 'desc')
            ->take(4)
            ->get();

        return View::make('students.profile',compact('student','studentNotifCount','studentNotification'));
    }

    public function updateprofile(Request $request, $id)
    {
        $student_id = DB::table('students')
        ->select('students.id')
        ->where('user_id', Auth::id())
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
        // $files = $request->file('avatar');
        // $avatarFileName = time().'-'.$files->getClientOriginalName();
        // $files->move(public_path('uploads/avatars'), $avatarFileName);

        $files = $request->file('avatar');
        $avatarFileName = time().'-'.$files->getClientOriginalName();
        Storage::put('public/avatars/'.time().'-'.$files->getClientOriginalName(), file_get_contents($files));
        
        $student->avatar = $avatarFileName;
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
        ->join('students', 'students.user_id', '=', 'users.id') 
        ->select('files.*') 
        ->where('files.user_id', Auth::id())
        ->orderBy('files.id', 'desc') 
        ->get();
        
        $studentNotifCount = DB::table('notifications')
            ->where('type', 'Student Notification')
            ->where('reciever_id', Auth::id())
            ->where('status', 'not read')
            ->count();

        $studentNotification = DB::table('notifications')
            ->where('type', 'Student Notification')
            ->where('reciever_id', Auth::id())
            ->orderBy('date', 'desc')
            ->take(4)
            ->get();

        return View::make('students.myfiles',compact('student','myfiles','studentNotifCount','studentNotification'));
    }

    public function upload_file(Request $request)
    {
        $request->validate([
            'research_file' => 'required|mimes:pdf|max:2048', // PDF file validation
        ]);

        $file = new Files;
        $file->file_status = 'Available';
        $file->research_title = $request->research_title;
        $file->abstract = $request->abstract;

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
        ->orderByRaw("CASE WHEN files.file_status = 'Available' THEN 0 ELSE 1 END")
        ->orderBy('files.file_status') 
        ->get();

        $advisers = DB::table('faculty')
        ->join('departments', 'departments.id', '=', 'faculty.department_id')
        ->select('faculty.*','departments.department_name','departments.id as department_id') 
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
        
        return View::make('students.requesting',compact('student','myfiles','advisers','studentNotifCount','studentNotification'));
    }

    public function getfile_id($id)
    {
        $file = RequestingForm::find($id);
        return response()->json($file);
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

        $student =  Student::where('user_id',Auth::id())->first();

        $advisers = Faculty::orderBy('id')->get();

        $studentfullname = $student->fname .' '. $student->mname .' '. $student->lname;

            $form = new RequestingForm;
            $form->date = now();
            $form->email_address = $student->email;
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

            $form->technicalAdviser_id = $request->technicalAdviser_id;
            $technicalAdviserEmail = DB::table('faculty')
            ->where('id', $request->technicalAdviser_id)
            ->value('email');

            $form->subjectAdviser_id = $request->subjectAdviser_id;
            $subjectAdviserEmail = DB::table('faculty')
            ->where('id', $request->subjectAdviser_id)
            ->value('email');

            $form->technicalAdviserEmail = $technicalAdviserEmail;
            $form->subjectAdviserEmail = $subjectAdviserEmail;

            $form->research_specialist = 'tba';
            $form->research_staff = 'tba';
            $form->tup_id = $student->tup_id;
            $form->requestor_name = $studentfullname;
            $form->tup_mail = $student->email;
            $form->sex = $student->gender;
            $form->requestor_type = $request->requestor_type;
            $form->college = $student->college;
            $form->course = $student->course;
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
            $form->user_id = $student->user_id;
            $form->status = 'Pending Technical Adviser Approval';
            $form->remarks = 'Your paper has been processed. Please wait for approval from your technical adviser.';
            $form->save();

            $file = Files::find($request->research_id);
            $file->file_status = 'Pending Technical Adviser Approval';
            $file->save();

            $technicalAdviser = DB::table('faculty')
            ->where('id', $request->technicalAdviser_id)
            ->first();

            $technicalAdviserName = $technicalAdviser->fname .' '. $technicalAdviser->mname .' '. $technicalAdviser->lname;
            
            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Technical Adviser Certification Approval';
            $notif->message = 'Someone submitting an application for approval.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $technicalAdviser->user_id;
            $notif->save();

            $data = [
                'technicalAdviserName' => $technicalAdviserName,
            ];
        
            // Mail::to($technicalAdviserEmail)->send(new TechnicalAdviserApproval($data));

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

            $form->technicalAdviser_id = $latestApplication->technicalAdviser_id;
            $form->subjectAdviser_id = $latestApplication->subjectAdviser_id;

            $form->technicalAdviserEmail = $latestApplication->technicalAdviserEmail;
            $form->subjectAdviserEmail = $latestApplication->subjectAdviserEmail;
            
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
            $form->status = 'Pending Technical Adviser Approval';
            $form->save();

            if ($submission === 'First Submission') {
                $file = Files::find($request->reApplyResearchId);
                $file->file_status = 'Pending Technical Adviser Approval';
                $file->save();
            } else {
                $request->validate([
                    'research_file' => 'required|mimes:pdf|max:10240', // PDF file validation with a maximum size of 10MB
                ]);
                
                $file = Files::find($request->reApplyResearchId);
                $file->file_status = 'Pending Technical Adviser Approval';

                $pdfFile = $request->file('research_file');
                $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
                $pdfFile->move(public_path('uploads/pdf'), $pdfFileName);
                
                $file->research_file = $pdfFileName;

                $file->save();
            } 

            $technicalAdviser = DB::table('faculty')
            ->where('id', $latestApplication->technicalAdviser_id)
            ->first();

            $technicalAdviserName = $technicalAdviser->fname .' '. $technicalAdviser->mname .' '. $technicalAdviser->lname;

            $data = [
                'technicalAdviserName' => $technicalAdviserName,
            ];
        
            // Mail::to($latestApplication->technicalAdviserEmail)->send(new TechnicalAdviserApproval($data));

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
        ->orderBy('requestingform.id', 'desc')
        ->paginate(10);

        $studentNotifCount = DB::table('notifications')
            ->where('type', 'Student Notification')
            ->where('reciever_id', Auth::id())
            ->where('status', 'not read')
            ->count();

        $studentNotification = DB::table('notifications')
            ->where('type', 'Student Notification')
            ->where('reciever_id', Auth::id())
            ->orderBy('date', 'desc')
            ->take(4)
            ->get();

        return View::make('students.applicationstatus',compact('student', 'studentstats','studentNotifCount','studentNotification'));
    }

    public function show_application($id)
    {
        $specificData = DB::table('requestingform')
        ->join('files', 'files.id', 'requestingform.research_id')
        ->join('users', 'users.id', 'requestingform.user_id')
        ->join('faculty as technical_adviser', 'technical_adviser.id', '=', 'requestingform.technicalAdviser_id')
        ->join('faculty as subject_adviser', 'subject_adviser.id', '=', 'requestingform.subjectAdviser_id')
        ->leftJoin('certificates', 'certificates.id', 'requestingform.certificate_id')
        ->select(
            'requestingform.*', 
            'files.*',
            'certificates.certificate_file',
            'technical_adviser.id as technical_adviser_id',
            'subject_adviser.id as subject_adviser_id',
            DB::raw("CONCAT(technical_adviser.fname, ' ', technical_adviser.lname, ' ', technical_adviser.mname) as TechnicalAdviserName"),
            DB::raw("CONCAT(subject_adviser.fname, ' ', subject_adviser.lname, ' ', subject_adviser.mname) as SubjectAdviserName"))
        ->where('requestingform.id', $id)
        ->first();

        return response()->json($specificData);
    }

    public function getTurnitinProofPhotos($id)
    {
        $photos = DB::table('requestingform')
        ->join('turnitin_photos','requestingform.id','turnitin_photos.requestingform_id')
        ->select('turnitin_photos.*')
        ->where('requestingform.id', $id)
        ->get();

        return response()->json($photos);
    }

    public function titleChecker(Request $request)
    {
        $student = DB::table('students')
            ->join('users', 'users.id', 'students.user_id')
            ->select('students.*', 'users.*')
            ->where('user_id', Auth::id())
            ->first();
            
        $studentNotifCount = DB::table('notifications')
            ->where('type', 'Student Notification')
            ->where('reciever_id', Auth::id())
            ->where('status', 'not read')
            ->count();

        $studentNotification = DB::table('notifications')
            ->where('type', 'Student Notification')
            ->where('reciever_id', Auth::id())
            ->orderBy('date', 'desc')
            ->take(4)
            ->get();

        $query = $request->input('query');
        $researchlist = Research::search($query)->paginate(10);

        return view('students.titlechecker', compact('researchlist', 'student','studentNotifCount','studentNotification'));
    }

    public function showResearchInfo($id)
    {
        $research = DB::table('research_list')
        ->where('id', $id)
        ->first();

        return response()->json($research);
    }

    //MOBILE START
    public function RegisterMobile(Request $request)
    { 
        $response = [];

        $users = new User;
        $users->fname = $request->fname;
        $users->lname = $request->lname;
        $users->mname = $request->mname;
        $users->email = $request->email;
        $users->password = bcrypt($request->password);
        $users->role = 'Student';   
        $users->save();
        $last = DB::getPdo()->lastInsertId();

        $students = new Student;
        $students->fname = $request->fname;
        $students->lname = $request->lname;
        $students->mname = $request->mname;
        $students->college = 'TUPT';
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

        $response['message'] = 'Registration successful';
        $response['user'] = $users;
        $response['student'] = $students;

        return response()->json($response, 200);
    }

    public function getProfile($id)
    {
        $student = DB::table('students')
                ->join('users', 'users.id', 'students.user_id')
                ->select('students.*', 'students.id as student_id', 'users.*')
                ->where('user_id', $id)
                ->first();   

        return response()->json($student);
    }

    public function mobilechangeavatar(Request $request, $email)
    {
        $student = Student::where('email', $email)->first();

        if (!$student) {
            return response()->json([
                'status' => 'error',
                'message' => 'Student not found'
            ], 404);
        }

        if (!$request->hasFile('avatar')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Avatar file not provided'
            ], 400);
        }

        $file = $request->file('avatar');
        $fileName = time() . '-' . $file->getClientOriginalName();
        $filePath = 'images/' . $fileName;

        // Update student avatar
        $student->avatar = $filePath;
        $student->save();

        // Save the avatar file
        Storage::put('public/' . $filePath, file_get_contents($file));

        return response()->json([
            'status' => 'success',
            'message' => 'Avatar changed successfully!',
            'avatar' => $filePath // Optionally, you can return the updated avatar path
        ]);
    }

    public function mobileupdateprofile(Request $request, $email)
    {
        $student = Student::where('email', $email)->first();

        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Student not found'], 404);
        }

        // Update student information
        $student->update($request->all());

        // Update user information
        $user = DB::table('users')
            ->join('students', 'students.user_id', '=', 'users.id')
            ->select('users.fname', 'users.lname', 'users.mname')
            ->where('students.user_id', $student->user_id)
            ->first(); // Changed find() to first() to get a single result

        if ($user) {
            DB::table('users')
                ->where('id', $student->user_id)
                ->update($request->only(['fname', 'lname', 'mname']));
        }

        // Prepare the response data
        $responseData = [
            'success' => true,
            'message' => 'Profile was successfully updated',
            'student' => $student // Optionally, you can return the updated student data
        ];

        // Return JSON response
        return response()->json($responseData);
    }

    public function mobileupload_file(Request $request)
    {
        $request->validate([
            'research_title' => 'required|string',
            'research_file' => 'required|mimes:pdf|max:2048',
            'user_id' => 'required|integer' // Add validation for user_id
            // 'initial_simmilarity_percentage' => 'required|integer',
            // 'simmilarity_percentage_results' => 'required|integer',
            
        ]);

        // dd($request->all());

        try {
            $file = new Files;
            $file->research_title = $request->research_title;
            $file->abstract = $request->abstract;
            $file->user_id = $request->user_id;
            // $file->initial_simmilarity_percentage = 0;
            // $file->simmilarity_percentage_results = 0;

            // dd($file->user_id);

            if ($request->hasFile('research_file')) {
                $pdfFile = $request->file('research_file');
                $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
                $pdfFile->move(public_path('uploads/pdf'), $pdfFileName);
                $file->research_file = $pdfFileName;
            }

            $file->save();

            return response()->json(['message' => 'File uploaded successfully','data' => $file], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'File upload failed', 'data' => $file->user_id], 500);
        }
    }

    public function mobileshowpdf($fileName)
    {
        $filePath = public_path("uploads/pdf/{$fileName}");

        // Check if the file exists
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Get file content
        $fileContent = file_get_contents($filePath);

        // Encode file content to base64
        $base64Content = base64_encode($fileContent);

        // Determine file MIME type
        $mimeType = mime_content_type($filePath);

        // Return JSON response with base64 content and MIME type
        return response()->json([
            'fileName' => $fileName,
            'base64Content' => $base64Content,
            'mimeType' => $mimeType
        ]);
    }

    public function mobilemyfiles($id)
    {
        $student = DB::table('students')
            ->join('users', 'users.id', 'students.user_id')
            ->select('students.*', 'users.*')
            ->where('user_id', $id)
            ->first();

        $myfiles = DB::table('files')
            ->join('users', 'users.id', '=', 'files.user_id')
            ->join('students', 'students.user_id', '=', 'users.id')
            ->select('files.*')
            ->where('files.user_id', $id)
            ->get();

        $faculty = DB::table('faculty')
            ->join('users', 'users.id', 'faculty.user_id')
            ->select('faculty.*', 'users.*')
            ->where('user_id', $id)
            ->first();

        $facultymyfiles = DB::table('files')
            ->join('users', 'users.id', '=', 'files.user_id')
            ->join('faculty', 'faculty.user_id', '=', 'users.id')
            ->select('files.*')
            ->where('files.user_id', $id)
            ->get();

        return response()->json(['student' => $student, 'myfiles' => $myfiles, 'facultymyfiles' => $facultymyfiles]);
    }

    public function deleteFile(Files $file)
    {
        try {
            // Delete the file from the storage
            Storage::delete('uploads/pdf/' . $file->research_file);

            // Delete the file record from the database
            $file->delete();

            return response()->json(['message' => 'File deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'File deletion failed'], 500);
        }
    }

    public function get_files($id)
    {
        $student = DB::table('students')
            ->join('users', 'users.id', 'students.user_id')
            ->select('students.*', 'users.*')
            ->where('user_id', $id)
            ->first();
        
        $faculty = DB::table('faculty')
            ->join('users', 'users.id', 'faculty.user_id')
            ->select('faculty.*', 'users.*')
            ->where('user_id', $id)
            ->first();

        $files = DB::table('files')
            ->join('users', 'users.id', '=', 'files.user_id')
            ->join('students', 'students.user_id', '=', 'users.id')
            ->select('files.*')
            ->where('files.user_id', $id)
            ->get();

        $facultyfiles = DB::table('files')
            ->join('users', 'users.id', '=', 'files.user_id')
            ->join('faculty', 'faculty.user_id', '=', 'users.id')
            ->select('files.*')
            ->where('files.user_id', $id)
            ->get();

        return response()->json(['student' => $student, 'files' => $files, 'facultyfiles' => $facultyfiles ]);
    }

    public function mobilecertification()
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

        $advisers = DB::table('faculty')
            ->join('departments', 'departments.id', '=', 'faculty.department_id')
            ->select('faculty.*','departments.department_name','departments.id as department_id') 
            ->get();
        
        // Create an associative array containing the data
        $data = [
            'student' => $student,
            'myfiles' => $myfiles,
            'advisers' => $advisers
        ];

        // Return the data as JSON
        return response()->json($data);
    }

    public function mobileapply_certification(Request $request, $id)
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

        $student =  Student::where('user_id', $id)->first();

        $advisers = Faculty::orderBy('id')->get();

        $studentfullname = $student->fname .' '. $student->mname .' '. $student->lname;

            $form = new RequestingForm;
            $form->date = now();
            $form->email_address = $student->email;
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

            $form->technicalAdviser_id = $request->technicalAdviser_id;
            $technicalAdviserEmail = DB::table('faculty')
            ->where('id', $request->technicalAdviser_id)
            ->value('email');

            $form->subjectAdviser_id = $request->subjectAdviser_id;
            $subjectAdviserEmail = DB::table('faculty')
            ->where('id', $request->subjectAdviser_id)
            ->value('email');

            $form->technicalAdviserEmail = $technicalAdviserEmail;
            $form->subjectAdviserEmail = $subjectAdviserEmail;

            $form->research_specialist = 'tba';
            $form->research_staff = 'tba';
            $form->tup_id = $student->tup_id;
            $form->requestor_name = $studentfullname;
            $form->tup_mail = $student->email;
            $form->sex = $student->gender;
            $form->requestor_type = $request->requestor_type;
            $form->college = $student->college;
            $form->course = $student->course;
            $form->purpose = 'Certification';
            $form->researchers_name1 = $request->researchers_name1;
            $form->researchers_name2 = $request->researchers_name2;
            $form->researchers_name3 = $request->researchers_name3;
            $form->researchers_name4 = $request->researchers_name4;
            $form->researchers_name5 = $request->researchers_name5;
            $form->researchers_name6 = $request->researchers_name6;
            $form->researchers_name7 = $request->researchers_name7;
            $form->researchers_name8 = $request->researchers_name8;
            $form->agreement = 'I Agree';
            $form->score = 0;
            $form->research_id = $request->research_id;
            $form->user_id = $student->user_id;
            $form->status = 'Pending Technical Adviser Approval';
            $form->remarks = 'Your paper has been processed. Please wait for approval from your technical adviser.';
            $form->save();

            $file = Files::find($request->research_id);
            $file->file_status = 'Pending Technical Adviser Approval';
            $file->save();

            $technicalAdviser = DB::table('faculty')
            ->where('id', $request->technicalAdviser_id)
            ->first();

            $technicalAdviserName = $technicalAdviser->fname .' '. $technicalAdviser->mname .' '. $technicalAdviser->lname;
            
            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Technical Adviser Certification Approval';
            $notif->message = 'Someone submitting an application for approval.';
            $notif->date = now();
            $notif->user_id = $id;
            $notif->reciever_id = $technicalAdviser->user_id;
            $notif->status = 'not read';
            $notif->save();

            $data = [
                'technicalAdviserName' => $technicalAdviserName,
            ];
        
            // Mail::to($technicalAdviserEmail)->send(new TechnicalAdviserApproval($data));

            return response()->json(["form" => $form, "file" => $file ]);

    }

    public function mobileapplication_status($id)
    {
        $student = DB::table('students')
            ->join('users', 'users.id', 'students.user_id')
            ->select('students.*', 'users.*')
            ->where('user_id', $id)
            ->first();

        $studentstats = DB::table('requestingform')
            ->join('users', 'users.id', 'requestingform.user_id')
            ->join('files', 'files.id', 'requestingform.research_id')
            ->select('requestingform.*', 'files.research_title')
            ->where('requestingform.user_id', $id)
            ->get();

        $staffstats = DB::table('requestingform')
            ->join('users', 'users.id', 'requestingform.user_id')
            ->select('users.*', 'requestingform.*')
            ->where('user_id', $id)
            ->get();

        $facultystats = DB::table('requestingform')
            ->join('users', 'users.id', 'requestingform.user_id')
            ->select('users.*', 'requestingform.*')
            ->where('user_id', $id)
            ->get();

        // Prepare data for JSON response
        $data = [
            'student' => $student,
            'studentstats' => $studentstats,
            'staffstats' => $staffstats,
            'facultystats' => $facultystats,
        ];

        // Return JSON response
        return response()->json($data);
    }

    public function mobileshow_application($id)
    {
        $specificData = DB::table('requestingform')
        ->join('files', 'files.id', 'requestingform.research_id')
        ->join('users', 'users.id', 'requestingform.user_id')
        ->join('faculty as technical_adviser', 'technical_adviser.id', '=', 'requestingform.technicalAdviser_id')
        ->join('faculty as subject_adviser', 'subject_adviser.id', '=', 'requestingform.subjectAdviser_id')
        ->leftJoin('certificates', 'certificates.id', 'requestingform.certificate_id')
        ->select(
            'requestingform.*', 
            'files.*',
            'certificates.certificate_file',
            'technical_adviser.id as technical_adviser_id',
            'subject_adviser.id as subject_adviser_id',
            DB::raw("CONCAT(technical_adviser.fname, ' ', technical_adviser.lname, ' ', technical_adviser.mname) as TechnicalAdviserName"),
            DB::raw("CONCAT(subject_adviser.fname, ' ', subject_adviser.lname, ' ', subject_adviser.mname) as SubjectAdviserName"))
        ->where('requestingform.id', $id)
        ->first();

        return response()->json($specificData);
    }

    public function mobilereApply(Request $request)
    {
        $latestApplication = DB::table('requestingform')
            ->join('users', 'users.id', 'requestingform.user_id')
            ->join('files', 'files.id', 'requestingform.research_id')
            ->select('requestingform.*')
            ->where('requestingform.research_id', $request->research_id)
            ->orderBy('requestingform.created_at', 'desc') 
            ->first();
        
        $latestPercentage = DB::table('requestingform')
            ->join('users', 'users.id', 'requestingform.user_id')
            ->join('files', 'files.id', 'requestingform.research_id')
            ->select('requestingform.simmilarity_percentage_results')
            ->where('requestingform.research_id', $request->research_id)
            ->orderBy('requestingform.id', 'desc') 
            ->value('simmilarity_percentage_results');

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

            $form = new RequestingForm;
            $form->date = now();
            $form->email_address = $latestApplication->email_address;
            $form->thesis_type = $latestApplication->thesis_type;
            $form->submission_frequency = $submission;
            $form->simmilarity_percentage_results = 0;
            $form->advisors_turnitin_precheck = 'Yes';
            $form->initial_simmilarity_percentage = $latestPercentage;

            $form->technicalAdviser_id = $latestApplication->technicalAdviser_id;
            $form->subjectAdviser_id = $latestApplication->subjectAdviser_id;

            $form->technicalAdviserEmail = $latestApplication->technicalAdviserEmail;
            $form->subjectAdviserEmail = $latestApplication->subjectAdviserEmail;
            
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
            $form->status = 'Pending Technical Adviser Approval';
            $form->save();

            if ($submission === 'First Submission') {
                $file = Files::find($request->research_id);
                $file->file_status = 'Pending Technical Adviser Approval';
                $file->save();
            } else {
                $request->validate([
                    'research_file' => 'required|mimes:pdf|max:10240', // PDF file validation with a maximum size of 10MB
                ]);
                
                $file = Files::find($request->research_id);
                $file->file_status = 'Pending Technical Adviser Approval';

                $pdfFile = $request->file('research_file');
                $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
                $pdfFile->move(public_path('uploads/pdf'), $pdfFileName);
                
                $file->research_file = $pdfFileName;

                $file->save();
            } 

            $technicalAdviser = DB::table('faculty')
            ->where('id', $latestApplication->technicalAdviser_id)
            ->first();

            $technicalAdviserName = $technicalAdviser->fname .' '. $technicalAdviser->mname .' '. $technicalAdviser->lname;

            $data = [
                'technicalAdviserName' => $technicalAdviserName,
            ];
        
            Mail::to($latestApplication->technicalAdviserEmail)->send(new TechnicalAdviserApproval($data));

            return response()->json(["form" => $form, "file" => $file ]);

    }

    public function mobiletitleChecker(Request $request)
    {
        $student = DB::table('students')
            ->join('users', 'users.id', 'students.user_id')
            ->select('students.*', 'users.*')
            ->where('user_id', Auth::id())
            ->first();

        $query = $request->input('query');
        $researchlist = Research::search($query)->get(); // Remove paginate(10)

        // Return JSON response
        return response()->json([
            'researchlist' => $researchlist,
            'student' => $student
        ]);
    }

    public function mobileshowResearchInfo($id)
    {
        $research = DB::table('research_list')
        ->where('id', $id)
        ->first();

        return response()->json($research);
    }

    public function mobilechangePassword(Request $request, $email)
    {
        $student = Student::where('email', $email)->first();

        $request->validate([
            'password' => 'required',
            'newpassword' => 'required|min:8',
            'renewpassword' => 'required|same:newpassword',
        ]);

        // Fetch the User model instance
        $user = User::where('email', $student->email)->first();

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Current password is incorrect.'], 422);
        } else {
            // Update the password using the User model instance
            $user->update([
                'password' => Hash::make($request->newpassword),
            ]);
            return response()->json(['success' => 'Password changed successfully!']);
        }
    }

    public function mobilevalidatePassword(Request $request, $email)
    {
        $student = Student::where('email', $email)->first();
        
        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Student not found'], 404);
        }

        // Fetch the User model instance
        $user = User::where('email', $student->email)->first();

        if (!$user->password) {
            return response()->json(['error' => 'User does not have a password.'], 422);
        }

        $enteredPassword = $request->input('password');
        $isMatch = Hash::check($enteredPassword, $user->password);

        return response()->json(['match' => $isMatch]);
    }
    //MOBILE END


}