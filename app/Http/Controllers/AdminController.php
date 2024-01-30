<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Mail;
use App\Mail\CertificationComplete;
use App\Mail\CertificationPassed;
use RealRashid\SweetAlert\Facades\Alert;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Staff;
use App\Models\Faculty;
use App\Models\User;
use App\Models\Certificate;
use App\Models\Announcement;
use App\Models\RequestingForm;
use App\Models\Files;
use App\Http\Redirect;
use View;
use DB;
use File;
use Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $usersCount = DB::table('users')->count();

        $rolesCount = DB::table('users')
        ->select('role', DB::raw('count(*) as count'))
        ->groupBy('role')
        ->get();

        $applicationsCount = DB::table('requestingform')
        ->select('status', DB::raw('count(*) as count'))
        ->groupBy('status')
        ->get();

        $thesisTypeCount = DB::table('requestingform')
        ->select('thesis_type', DB::raw('count(*) as count'))
        ->groupBy('thesis_type')
        ->get();

        $courseCount = DB::table('requestingform')
        ->select('course', DB::raw('count(*) as count'))
        ->groupBy('course')
        ->get();

        $researchDepartmentCount = DB::table('research_list')
        ->select('department', DB::raw('count(*) as count'))
        ->groupBy('department')
        ->get();

        $researchCourseCount = DB::table('research_list')
        ->select('course', DB::raw('count(*) as count'))
        ->groupBy('course')
        ->get();

        $studentCount = DB::table('users')->where('role', 'Student')->count();

        $staffCount = DB::table('users')->where('role', 'Staff')->count();

        $facultyCount = DB::table('users')->where('role', 'Faculty')->count();

        $applicationCount = DB::table('requestingform')->count();
        
        $pendingCount = DB::table('requestingform')
            ->join('files','files.id','requestingform.research_id')
            ->where('requestingform.status', '=', 'Pending')
            ->count();

        $passedCount = DB::table('requestingform')
            ->join('files','files.id','requestingform.research_id')
            ->where('requestingform.status', '=', 'Passed')
            ->count();
        
        $returnedCount = DB::table('requestingform')
            ->join('files','files.id','requestingform.research_id')
            ->where('requestingform.status', '=', 'Returned')
            ->count();

        $admin = DB::table('staff')
            ->join('users','users.id','staff.user_id')
            ->select('staff.*','users.*')
            ->where('user_id',Auth::id())
            ->first();

        $researchCount = DB::table('research_list')->count();
        $eaadResearchCount = DB::table('research_list')->where('department', 'EAAD')->count();
        $maadResearchCount = DB::table('research_list')->where('department', 'MAAD')->count();
        $basdResearchCount = DB::table('research_list')->where('department', 'BASD')->count();
        $caadResearchCount = DB::table('research_list')->where('department', 'CAAD')->count();

        return View::make('admin.dashboard',compact('usersCount','studentCount','staffCount','facultyCount','applicationCount','admin','pendingCount','passedCount','returnedCount','eaadResearchCount','maadResearchCount','caadResearchCount','basdResearchCount','researchCount','rolesCount','applicationsCount','thesisTypeCount','courseCount','researchDepartmentCount','researchCourseCount'));
    }

    public function administration()
    {
        $admin = DB::table('staff')
            ->join('users','users.id','staff.user_id')
            ->select('staff.*','users.*')
            ->where('user_id',Auth::id())
            ->first();

        $adminlist = DB::table('staff')  
            ->join('users', 'users.id', 'staff.user_id')  
            ->select('staff.*', 'users.id as userid', 'users.role')  
            ->get(); 

        // dd($adminlist);
        
        return View::make('admin.administration',compact('admin','adminlist'));
    }

    public function addAdministration(Request $request)
    {
            $users = new User();
            $users->fname = $request->admin_fname; 
            $users->lname = $request->admin_lname;
            $users->mname = $request->admin_mname; 
            $users->role = $request->admin_role; 
            $users->email = $request->admin_email;
            $users->password = bcrypt($request->admin_password);
            $users->save();
            $lastid = DB::getPdo()->lastInsertId();

            $staff = new Staff();
            $staff->fname = $request->admin_fname;
            $staff->lname = $request->admin_lname;
            $staff->mname = $request->admin_mname;
            $staff->position = $request->admin_position;
            $staff->designation = $request->admin_designation;
            $staff->tup_id = $request->admin_id;
            $staff->email = $request->admin_email;
            $staff->gender = $request->admin_gender;
            $staff->phone = $request->admin_phone;
            $staff->address = $request->admin_address;
            $staff->birthdate = $request->admin_birthdate;
            $staff->user_id = $lastid;
            $staff->save();
                
            return redirect()->to('/administration')->with('success', 'Administrator Added');
    }

    public function editAdministration($id)
    {
        $staff = Staff::find($id);
        return response()->json($staff);
    }

    public function updateAdministration(Request $request, $id)
    {
        $staff = Staff::find($id);
        $staff->fname = $request->fname;
        $staff->lname = $request->lname;
        $staff->mname = $request->mname;
        $staff->position = $request->position;
        $staff->designation = $request->designation;
        $staff->tup_id = $request->staffid;
        $staff->email = $request->email;
        $staff->gender = $request->gender;
        $staff->phone = $request->phone;
        $staff->address = $request->address;
        $staff->birthdate = $request->birthdate;
        $staff->save();

        $user_id = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('users.id')
        ->where('staff.id',$id)
        ->first();

        $user = User::find($user_id->id);
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->mname = $request->mname;
        $user->email = $request->email;
        $user->save();

        return response()->json(["staff" => $staff, "user" => $user],201);
    }

    public function editAdministrationRole($id)
    {
        $admin = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.id as userid','users.role')
        ->where('staff.id', $id)
        ->first();

        return response()->json($admin);
    }

    public function updateAdministrationRole(Request $request, $id)
    {
        $user = User::find($request->roleId);
        $user->role = $request->role;
        $user->save();

        return response()->json($user);
    }

    public function deleteAdministration(string $id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();
        $data = array('success' =>'deleted','code'=>'200');
        return response()->json($data);
    }
   
    public function showannouncement()
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

        $announcements = DB::table('announcements')
        ->join('announcementsphoto', 'announcementsphoto.announcements_id', 'announcements.id')
        ->join('users', 'announcements.user_id', 'users.id')
        ->select(
            'users.fname',
            'users.lname',
            'users.mname',
            'users.role',
            'announcementsphoto.id as photo_id', 
            'announcements.id as announcement_id', 
            'announcements.title', 'announcements.content', 
            'announcementsphoto.img_path', 
            DB::raw('TIME(announcements.created_at) as created_time')
                )
        ->orderBy('announcements.id') 
        ->get()
        ->groupBy('announcement_id');

        return View::make('layouts.homepage',compact('admin','student','staff','faculty','announcements'));
    }

    public function profile($id)
    {
        $admin = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        return View::make('admin.profile',compact('admin'));
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
        $staff->profession = $request->profession;
        $staff->staff_id = $request->staff_id;
        $staff->gender = $request->gender;
        $staff->phone = $request->phone;
        $staff->address = $request->address;
        $staff->birthdate = $request->birthdate;

        $user = User::find(Auth::id());
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->mname = $request->mname;
        $user->save();

        Alert::success('Success', 'Profile was successfully updated');

        return redirect()->to('/Admin/Profile/{id}')->with('success', 'Profile was successfully updated');
    }

    public function changeavatar(Request $request)
    {
        $admin = DB::table('staff')
        ->select('staff.id')
        ->where('user_id',Auth::id())
        ->first();

        $admin = Staff::find($admin->id);
        $files = $request->file('avatar');
        $admin->avatar = 'images/'.time().'-'.$files->getClientOriginalName();

        $admin->save();

        $data = array('status' => 'saved');
        Storage::put('public/images/'.time().'-'.$files->getClientOriginalName(), file_get_contents($files));
        $admin->save();

        Alert::success('Success', 'Avatar changed successfully!');

        return redirect()->to('/Admin/Profile/{id}')->with('success', 'Avatar changed successfully.');
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
        }

        $user->update([
            'password' => Hash::make($request->newpassword),
        ]);

        Alert::success('Success', 'Password changed successfully!');
        return redirect()->to('/Admin/Profile/{id}')->with('success', 'Password changed successfully.');
    }

    public function announcement_img_upload($filename)
    {
        $photo = array('photo' => $filename);
        $destinationPath = public_path().'/images'; 
        $original_filename = time().$filename->getClientOriginalName();
        $extension = $filename->getClientOriginalExtension(); 
        $filename->move($destinationPath, $original_filename); 
    }

    public function add_announcements(Request $request)
    {  
            $announcment = new Announcement();
            $announcment->title = $request->title; 
            $announcment->content = $request->content;
            $announcment->user_id = Auth::id();
            $announcment->save();
            $announcment_id = DB::getPdo()->lastInsertId();

                $files = $request->file('img_path');
                foreach ($files as $file) {
                $this->announcement_img_upload($file);
                $multi['img_path']=time().$file->getClientOriginalName();
                $multi['announcements_id'] = $announcment_id ;
                DB::table('announcementsphoto')->insert($multi);
        }

        return redirect()->to('/announcements');
    }

    public function studentlist()
    {
        $admin = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $studentlist = Student::orderBy('id')->get();
        
        return View::make('admin.studentlist',compact('studentlist','admin'));
    }

    public function addstudent(Request $request)
    {
            $users = new User();
            $users->fname = $request->fname; 
            $users->lname = $request->lname;
            $users->mname = $request->mname; 
            $users->role = 'Student'; 
            $users->email = $request->email;
            $users->password = bcrypt($request->password);
            $users->save();
            $lastid = DB::getPdo()->lastInsertId();

            $student = new Student();
            $student->fname = $request->fname; 
            $student->lname = $request->lname;
            $student->mname = $request->mname; 
            $student->email = $request->email;
            $student->college = $request->college; 
            $student->course = $request->course;
            $student->student_id = $request->student_id; 
            $student->phone = $request->phone;
            $student->address = $request->address; 
            $student->gender = $request->gender;
            $student->birthdate = $request->birthdate; 
            $student->user_id = $lastid; 
            $student->save();
            
            return redirect()->to('/studentlist')->with('success', 'Student Added');
    }

    public function showstudentinfo($id)
    {
        $student = Student::find($id);
        return response()->json($student);
    }

    public function editstudentinfo($id)
    {
        $student = Student::find($id);
        return response()->json($student);
    }

    public function updatestudentinfo(Request $request, $id)
    {
        $student = Student::find($id);
        $student->fname = $request->fname;
        $student->lname = $request->lname;
        $student->mname = $request->mname;
        $student->college = $request->college;
        $student->course = $request->course;
        $student->tup_id = $request->sid;
        $student->email = $request->email;
        $student->gender = $request->gender;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->birthdate = $request->birthdate;
        $student->save();

        $user_id = DB::table('students')
        ->join('users','users.id','students.user_id')
        ->select('users.id')
        ->where('students.id',$id)
        ->first();

        $user = User::find($user_id->id);
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->mname = $request->mname;
        $user->email = $request->email;
        $user->save();

        return response()->json(["student" => $student, "user" => $user],201);
    }

    public function deletestudentinfo(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        $data = array('success' =>'deleted','code'=>'200');
        return response()->json($data);
    }

    public function stafflist()
    {
        $admin = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $stafflist = Staff::orderBy('id')->get();
        return View::make('admin.stafflist',compact('stafflist','admin'));
    }

    public function addstaff(Request $request)
    {
            $users = new User();
            $users->fname = $request->fname; 
            $users->lname = $request->lname;
            $users->mname = $request->mname; 
            $users->role = 'Staff'; 
            $users->email = $request->email;
            $users->password = bcrypt($request->password);
            $users->save();
            $lastid = DB::getPdo()->lastInsertId();

            $staff = new Staff();
            $staff->fname = $request->fname;
            $staff->lname = $request->lname;
            $staff->mname = $request->mname;
            $staff->position = $request->position;
            $staff->designation = $request->designation;
            $staff->staff_id = $request->staff_id;
            $staff->email = $request->email;
            $staff->gender = $request->gender;
            $staff->phone = $request->phone;
            $staff->address = $request->address;
            $staff->birthdate = $request->birthdate;
            $staff->save();
                
            return redirect()->to('/stafflist');
    }

    public function showstaffinfo($id)
    {
        $staff = Staff::find($id);
        return response()->json($staff);
    }

    public function editstaffinfo($id)
    {
        $staff = Staff::find($id);
        return response()->json($staff);
    }

    public function updatestaffinfo(Request $request, $id)
    {
        $staff = Staff::find($id);
        $staff->fname = $request->fname;
        $staff->lname = $request->lname;
        $staff->mname = $request->mname;
        $staff->position = $request->position;
        $staff->designation = $request->designation;
        $staff->tup_id = $request->staffid;
        $staff->email = $request->email;
        $staff->gender = $request->gender;
        $staff->phone = $request->phone;
        $staff->address = $request->address;
        $staff->birthdate = $request->birthdate;
        $staff->save();

        $user_id = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('users.id')
        ->where('staff.id',$id)
        ->first();

        $user = User::find($user_id->id);
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->mname = $request->mname;
        $user->email = $request->email;
        $user->save();

        return response()->json(["staff" => $staff, "user" => $user]);
    }

    public function deletestaffinfo(string $id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();
        $data = array('success' =>'deleted','code'=>'200');
        return response()->json($data);
    }

    public function facultymemberlist()
    {
        $admin = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $facultylist = Faculty::orderBy('id')->get();

        return View::make('admin.facultylist',compact('facultylist','admin'));
    }

    public function addfaculty(Request $request)
    {
            $users = new User();
            $users->fname = $request->fname; 
            $users->lname = $request->lname;
            $users->mname = $request->mname; 
            $users->role = 'Faculty'; 
            $users->email = $request->email;
            $users->password = bcrypt($request->password);
            $users->save();
            $lastid = DB::getPdo()->lastInsertId();

            $faculty = new Faculty();
            $faculty->fname = $request->fname;
            $faculty->lname = $request->lname;
            $faculty->mname = $request->mname;
            $faculty->position = $request->position;
            $faculty->designation = $request->designation;
            $faculty->department = $request->department;
            $faculty->tup_id = $request->tup_id;
            $faculty->email = $request->email;
            $faculty->gender = $request->gender;
            $faculty->phone = $request->phone;
            $faculty->address = $request->address;
            $faculty->birthdate = $request->birthdate;
            $faculty->save();
                
            return redirect()->to('/facultylist');
    }

    public function showfacultyinfo($id)
    {
        $faculty = Faculty::find($id);
        return response()->json($faculty);
    }

    public function editfacultyinfo($id)
    {
        $faculty = Faculty::find($id);
        return response()->json($faculty);
    }

    public function updatefacultyinfo(Request $request, $id)
    {
        $faculty = Faculty::find($id);
        $faculty->fname = $request->fname;
        $faculty->lname = $request->lname;
        $faculty->mname = $request->mname;
        $faculty->department = $request->department;
        $faculty->tup_id = $request->staffid;
        $faculty->email = $request->email;
        $faculty->gender = $request->gender;
        $faculty->phone = $request->phone;
        $faculty->address = $request->address;
        $faculty->birthdate = $request->birthdate;
        $faculty->save();

        $user_id = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('users.id')
        ->where('staff.id',$id)
        ->first();

        $user = User::find($user_id->id);
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->mname = $request->mname;
        $user->email = $request->email;
        $user->save();

        return response()->json(["faculty" => $faculty, "user" => $user]);
    }

    public function deletefacultyinfo(string $id)
    {
        $faculty = Faculty::findOrFail($id);
        $faculty->delete();
        $data = array('success' =>'deleted','code'=>'200');
        return response()->json($data);
    }

    public function admin_certification($id)
    {
        $specificData = DB::table('requestingform')
        ->join('files', 'files.id', 'requestingform.research_id')
        ->join('users', 'users.id', 'requestingform.user_id')
        ->select('requestingform.*', 'files.*')
        ->where('requestingform.id', $id)
        ->first();

        return response()->json($specificData);

    }
    
    public function certification(Request $request, $id)
    {
        $request->validate([
            'certification_file' => 'nullable|mimes:pdf|max:2048', 
        ]);

        $fileId = DB::table('files')
        ->join('requestingform','requestingform.research_id','files.id')
        ->select('requestingform.*','files.*')
        ->where('requestingform.id',$id)
        ->first();

        $staff = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $specialist = $staff->fname .' '. $staff->mname .' '. $staff->lname;
        $userEmail = $fileId->tup_mail;
        $userName = $fileId->requestor_name;
        
        if ($request->hasFile('certification_file')) {

            $pdfFile = $request->file('certification_file');
            $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
            $pdfFile->move(public_path('uploads/pdf'), $pdfFileName);
            
            $cert = new Certificate();
            $cert->certificate_file = $pdfFileName;
            $cert->control_id = uniqid();
            $cert->save();
            $lastId = DB::getPdo()->lastInsertId();

            $form = RequestingForm::find($id);
            $form->status = $request->status;
            $form->simmilarity_percentage_results = $request->simmilarity_percentage_results;
            $form->research_specialist = $specialist;
            $form->research_staff = $specialist;
            $form->date_processing_end = now();
            $form->certificate_id = $lastId;
            $form->save();

            $file = Files::find($fileId->id);
            $file->file_status = $request->status;
            $file->save();

            $controlId = DB::table('certificates')
            ->where('id', $lastId)
            ->value('control_id');

            $researchTitle = DB::table('requestingform')
            ->join('files','files.id','requestingform.research_id')
            ->where('certificate_id', $lastId)
            ->value('research_title');
        
            $data = [
                'researchTitle' => $researchTitle,
                'controlId' => $controlId,
                'userName' => $userName,
                'status' => $request->status,
                'percentage_results' => $request->simmilarity_percentage_results,
            ];
        
            Mail::to($userEmail)->send(new CertificationPassed($data));
        }else {  

            $researchTitle = DB::table('requestingform')
            ->join('files','files.id','requestingform.research_id')
            ->where('requestingform.id', $id)
            ->value('research_title');

            $form = RequestingForm::find($id);
            $form->status = $request->status;
            $form->simmilarity_percentage_results = $request->simmilarity_percentage_results;
            $form->date_processing_end = now();
            $form->research_specialist = $specialist;
            $form->research_staff = $specialist;
            $form->save();

            $file = Files::find($fileId->id);
            $file->file_status = $request->status;
            $file->save();

            $data = [
                'researchTitle' => $researchTitle,
                'userName' => $userName,
                'status' => $request->status,
                'percentage_results' => $request->simmilarity_percentage_results,
            ];
        
            Mail::to($userEmail)->send(new CertificationComplete($data));
        }

        return response()->json($file);
    }

    public function certificate_tracking()
    {
        $admin = DB::table('staff')
            ->join('users','users.id','staff.user_id')
            ->select('staff.*','users.*')
            ->where('user_id',Auth::id())
            ->first();

        $staff = DB::table('staff')
            ->join('users','users.id','staff.user_id')
            ->select('staff.*','users.*')
            ->where('user_id',Auth::id())
            ->first();

        $certificates = DB::table('certificates')  
            ->join('requestingform', 'requestingform.certificate_id', 'certificates.id')
            ->join('files', 'files.id', 'requestingform.research_id')  
            ->select(
                'requestingform.*', 
                'files.*', 
                'certificates.id as certid', 
                'certificates.control_id',
                'certificates.certificate_file')  
            ->get(); 
        
        return View::make('certificate.tracking',compact('admin','certificates','staff'));
    }

    public function show_certificate($id)
    {
        $specificData = DB::table('requestingform')
        ->join('files', 'files.id', 'requestingform.research_id')
        ->join('users', 'users.id', 'requestingform.user_id')
        ->leftJoin('certificates', 'certificates.id', 'requestingform.certificate_id')
        ->select(
            'requestingform.*', 
            'files.*',
            'certificates.id as certid',
            "certificates.control_id",
            'certificates.certificate_file')
        ->where('requestingform.certificate_id', 3)
        ->first();

        return response()->json($specificData);
    }

    public function fetchSpecificCertificate(Request $request)
    {
        $admin = DB::table('staff')
            ->join('users','users.id','staff.user_id')
            ->select('staff.*','users.*')
            ->where('user_id',Auth::id())
            ->first();

        $controlNumber = $request->input('controlId');
        
        $certificates = DB::table('certificates')  
            ->join('requestingform', 'requestingform.certificate_id', 'certificates.id')
            ->join('files', 'files.id', 'requestingform.research_id')  
            ->select(
                'requestingform.*', 
                'files.*', 
                'certificates.id as certid', 
                'certificates.control_id',
                'certificates.certificate_file') 
            ->where('certificates.control_id', 'like', "%$controlNumber%") 
            ->get(); 

            return View::make('certificate.tracking',compact('admin','certificates'));

    }

    //MOBILE START
    public function dashboardmobile(Request $request)
    {
        $usersCount = DB::table('users')->count();
    
        $rolesCount = DB::table('users')
            ->select('role', DB::raw('count(*) as count'))
            ->groupBy('role')
            ->get();
    
        $applicationsCount = DB::table('requestingform')
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();
    
        $thesisTypeCount = DB::table('requestingform')
            ->select('thesis_type', DB::raw('count(*) as count'))
            ->groupBy('thesis_type')
            ->get();
    
        $courseCount = DB::table('requestingform')
            ->select('course', DB::raw('count(*) as count'))
            ->groupBy('course')
            ->get();
    
        $researchDepartmentCount = DB::table('research_list')
            ->select('department', DB::raw('count(*) as count'))
            ->groupBy('department')
            ->get();
    
        $researchCourseCount = DB::table('research_list')
            ->select('course', DB::raw('count(*) as count'))
            ->groupBy('course')
            ->get();
    
        $studentCount = DB::table('users')->where('role', 'Student')->count();
    
        $staffCount = DB::table('users')->where('role', 'Staff')->count();
    
        $facultyCount = DB::table('users')->where('role', 'Faculty')->count();
    
        $applicationCount = DB::table('requestingform')->count();
    
        $pendingCount = DB::table('requestingform')
            ->join('files','files.id','requestingform.research_id')
            ->where('requestingform.status', '=', 'Pending')
            ->count();
    
        $passedCount = DB::table('requestingform')
            ->join('files','files.id','requestingform.research_id')
            ->where('requestingform.status', '=', 'Passed')
            ->count();
    
        $returnedCount = DB::table('requestingform')
            ->join('files','files.id','requestingform.research_id')
            ->where('requestingform.status', '=', 'Returned')
            ->count();
    
        $admin = DB::table('staff')
            ->join('users','users.id','staff.user_id')
            ->select('staff.*','users.*')
            ->where('user_id', Auth::id())
            ->first();
    
        $researchCount = DB::table('research_list')->count();
        $eaadResearchCount = DB::table('research_list')->where('department', 'EAAD')->count();
        $maadResearchCount = DB::table('research_list')->where('department', 'MAAD')->count();
        $basdResearchCount = DB::table('research_list')->where('department', 'BASD')->count();
        $caadResearchCount = DB::table('research_list')->where('department', 'CAAD')->count();
    
        $data = compact('usersCount', 'studentCount', 'staffCount', 'facultyCount', 'applicationCount', 'admin', 'pendingCount', 'passedCount', 'returnedCount', 'eaadResearchCount', 'maadResearchCount', 'caadResearchCount', 'basdResearchCount', 'researchCount', 'rolesCount', 'applicationsCount', 'thesisTypeCount', 'courseCount', 'researchDepartmentCount', 'researchCourseCount');
    
        return response()->json($data);
    }

    public function addAnnouncements(Request $request)
    {  
        // Your existing code for creating an announcement
        $announcement = new Announcement();
        $announcement->title = $request->title; 
        $announcement->content = $request->content;
        $announcement->user_id = $request->user_id; // Assuming this is a placeholder value
        $announcement->save();
        $announcement_id = $announcement->id;

        // Fetching images from the request
        $images = $request->file('images');

        if ($images) {
            foreach ($images as $index => $file) {
                $multi = [];

                // Assuming $this->announcement_img_upload() and other functions are defined elsewhere
                $this->announcement_img_upload($file);

                $multi['img_path'] = time() . $file->getClientOriginalName();
                $multi['announcements_id'] = $announcement_id;

                // You can adjust the method of storage or retrieval based on your requirements.
                DB::table('announcementsphoto')->insert($multi);
            }
        }

        // Prepare JSON response
        $response = [
            'success' => true,
            'message' => 'Announcement added successfully',
            'announcement_id' => $announcement_id,
        ];

        return response()->json($response);
    }

    public function listAnnouncement()
    {
        return Announcement::all();
    }

    public function mobileshowannouncement()
    {
        $student = DB::table('students')
            ->join('users', 'users.id', 'students.user_id')
            ->select('students.*', 'users.*')
            ->where('user_id', Auth::id())
            ->first();
    
        $staff = DB::table('staff')
            ->join('users', 'users.id', 'staff.user_id')
            ->select('staff.*', 'users.*')
            ->where('user_id', Auth::id())
            ->first();
    
        $faculty = DB::table('faculty')
            ->join('users', 'users.id', 'faculty.user_id')
            ->select('faculty.*', 'users.*')
            ->where('user_id', Auth::id())
            ->first();
    
        $admin = DB::table('staff')
            ->join('users', 'users.id', 'staff.user_id')
            ->select('staff.*', 'users.*')
            ->where('user_id', Auth::id())
            ->first();
    
        $announcements = DB::table('announcements')
            ->join('announcementsphoto', 'announcementsphoto.announcements_id', 'announcements.id')
            ->join('users', 'announcements.user_id', 'users.id')
            ->select(
                'users.fname',
                'users.lname',
                'users.mname',
                'users.role',
                'announcementsphoto.id as photo_id',
                'announcements.id as announcement_id',
                'announcements.title',
                'announcements.content',
                'announcementsphoto.img_path',
                DB::raw('TIME(announcements.created_at) as created_time')
            )
            ->orderBy('announcements.id')
            ->get()
            ->groupBy('announcement_id');
    
        $data = compact('admin', 'student', 'staff', 'faculty', 'announcements');
    
        // Return the data as JSON response
        return response()->json($data);
    }

    public function mobileadministration()
    {
        $admin = DB::table('staff')
            ->join('users', 'users.id', 'staff.user_id')
            ->select('staff.*', 'users.*')
            ->where('user_id', Auth::id())
            ->first();

        $adminlist = DB::table('staff')
            ->join('users', 'users.id', 'staff.user_id')
            ->select('staff.*', 'users.id as userid', 'users.role')
            ->get();

        $data = [
            'admin' => $admin,
            'adminlist' => $adminlist,
        ];

        return response()->json($data);
    }

    public function mobileaddAdministration(Request $request)
    {
        $users = new User();
        $users->fname = $request->admin_fname;
        $users->lname = $request->admin_lname;
        $users->mname = $request->admin_mname;
        $users->role = $request->admin_role;
        $users->email = $request->admin_email;
        $users->password = bcrypt($request->admin_password);
        $users->save();
        $lastid = DB::getPdo()->lastInsertId();

        $staff = new Staff();
        $staff->fname = $request->admin_fname;
        $staff->lname = $request->admin_lname;
        $staff->mname = $request->admin_mname;
        $staff->position = $request->admin_position;
        $staff->designation = $request->admin_designation;
        $staff->tup_id = $request->admin_id;
        $staff->email = $request->admin_email;
        $staff->gender = $request->admin_gender;
        $staff->phone = $request->admin_phone;
        $staff->address = $request->admin_address;
        $staff->birthdate = $request->admin_birthdate;
        $staff->user_id = $lastid;
        $staff->save();

        $response = [
            'message' => 'Administrator Added',
            'admin' => $users,
            'staff' => $staff,
        ];

        return response()->json($response);
    }

    public function mobileeditAdministration($id)
    {
        $staff = Staff::find($id);

        if (!$staff) {
            return response()->json(['error' => 'Staff not found'], 404);
        }

        return response()->json($staff);
    }

    public function mobileupdateAdministration(Request $request, $id)
    {
        $staff = Staff::find($id);
        $staff->fname = $request->fname;
        $staff->lname = $request->lname;
        $staff->mname = $request->mname;
        $staff->position = $request->position;
        $staff->designation = $request->designation;
        $staff->tup_id = $request->staffid;
        $staff->email = $request->email;
        $staff->gender = $request->gender;
        $staff->phone = $request->phone;
        $staff->address = $request->address;
        $staff->birthdate = $request->birthdate;
        $staff->save();

        $user_id = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('users.id')
        ->where('staff.id',$id)
        ->first();

        $user = User::find($user_id->id);
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->mname = $request->mname;
        $user->email = $request->email;
        $user->save();

        return response()->json(["staff" => $staff, "user" => $user],201);
    }

    public function mobileeditAdministrationRole($id)
    {
        $admin = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.id as userid','users.role')
        ->where('staff.id', $id)
        ->first();

        return response()->json($admin);
    }

    public function mobileupdateAdministrationRole(Request $request, $id)
    {
        $user = User::find($request->roleId);
        $user->role = $request->role;
        $user->save();

        return response()->json($user);
    }

    public function mobiledeleteAdministration(string $id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();
        $data = array('success' =>'deleted','code'=>'200');
        return response()->json($data);
    }
    //MOBILE END
    
}
