<?php

namespace App\Http\Controllers;

use Algolia\AlgoliaSearch\SearchClient;
use App\Models\StudentRequestAccess;
use App\Models\FacultyRequestAccess;
use App\Models\Notifications;
use Illuminate\Http\Request;
use App\Models\Research;
use App\Models\Student;
use App\Models\Faculty;
use App\Http\Redirect;
use App\Models\Staff;
use App\Models\User;
use Carbon\Carbon;
use View, DB, File, Auth;

class ResearchController extends Controller
{
    public function researchlist(Request $request)
    {
        $admin = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $adminNotifCount = DB::table('notifications')
            ->where('type', 'Admin Notification')
            ->where('status', 'not read')
            ->count();

        $adminNotification = DB::table('notifications')
            ->where('type', 'Admin Notification')
            ->orderBy('date', 'desc')
            ->take(4)
            ->get();

        $query = $request->input('query');
        $researchlist = Research::search($query)->paginate(10);

        return View::make('research.researchlist',compact('researchlist','admin','adminNotifCount','adminNotification'));
    }

    public function addresearch(Request $request)
    {
            $research = new Research();
            $research->research_title = $request->research_title;
            $research->faculty_adviser1 = $request->faculty_adviser1;
            $research->faculty_adviser2 = $request->faculty_adviser2;
            $research->faculty_adviser3 = $request->faculty_adviser3;
            $research->faculty_adviser4 = $request->faculty_adviser4;
            $research->researcher1 = $request->researcher1;
            $research->researcher2 = $request->researcher2;
            $research->researcher3 = $request->researcher3;
            $research->researcher4 = $request->researcher4;
            $research->researcher5 = $request->researcher5;
            $research->researcher6 = $request->researcher5;
            $research->time_frame = $request->time_frame;
            $research->date_completion = $request->date_completion;
            $research->abstract = $request->abstract;
            $research->department = $request->department;
            $research->course = $request->course;

            // $pdfFile = $request->file('research_file');
            // $researchFileName = $pdfFile->getClientOriginalName();
            // $pdfFile->move(public_path('uploads/researchFile'), $researchFileName);

            $pdfFile = $request->file('research_file');
            $researchFileName = time().'-'.$pdfFile->getClientOriginalName();
            Storage::put('public/applications/'.time().'-'.$pdfFile->getClientOriginalName(), file_get_contents($pdfFile));
            $research->research_file = $researchFileName;

            $research->save();
                
            return redirect()->to('/researchlist')->with('success', 'Research Added');
    }

    public function showresearchinfo($id)
    {
        $research = Research::find($id);
        return response()->json($research);
    }

    public function editresearchinfo($id)
    {
        $research = Research::find($id);
        return response()->json($research);
    }

    public function updateresearchinfo(Request $request, $id)
    {
        $research = Research::find($id);
        $research->research_title = $request->researchTitle;
        $research->faculty_adviser1 = $request->facultyAdviser1;
        $research->faculty_adviser2 = $request->facultyAdviser2;
        $research->faculty_adviser3 = $request->facultyAdviser3;
        $research->faculty_adviser4 = $request->facultyAdviser4;
        $research->researcher1 = $request->Researcher1;
        $research->researcher2 = $request->Researcher2;
        $research->researcher3 = $request->Researcher3;
        $research->researcher4 = $request->Researcher4;
        $research->researcher5 = $request->Researcher5;
        $research->researcher6 = $request->Researcher6;
        $research->time_frame = $request->timeFrame;
        $research->date_completion = $request->dateCompletion;
        $research->abstract = $request->abstracts;
        $research->department = $request->dept;
        $research->course = $request->researchCourse;
        $research->save();

        return response()->json(["research" => $research]);
    }

    public function deleteresearchinfo(string $id)
    {
        $research = Research::findOrFail($id);
        $research->delete();
        $data = array('success' =>'deleted','code'=>'200');
        return response()->json($data);
    }

    public function studentSendRequestAccess($id)
    {
        $research = DB::table('student_request_access')
        ->join('research_list', 'research_list.id', 'student_request_access.research_id')
        ->join('users', 'users.id', 'student_request_access.requestor_id')
        ->join('students', 'users.id', 'students.user_id')
        ->select('student_request_access.*', 'research_list.*', 'students.*', 'users.*')
        ->where('research_list.id', $id)
        ->where('users.id', Auth::id())
        ->latest('student_request_access.created_at')
        ->first(); 

        return response()->json($research);
    }

    public function studentSendinRequestAccess(Request $request)
    { 
            $student = DB::table('students')
                ->join('users', 'users.id', 'students.user_id')
                ->select('students.*', 'users.*')
                ->where('user_id', Auth::id())
                ->first();

            $research = DB::table('research_list')
                ->where('id', $request->researchId)
                ->first();

            $requests = new StudentRequestAccess;
            $requests->requestor_id = Auth::id();
            $requests->requestor_type = $student->role;
            $requests->research_id = $research->id;
            $requests->start_access_date = now();
            $requests->purpose = $request->purpose;
            $requests->status = 'Pending';
            $requests->save();

            $notif = new Notifications;
            $notif->type = 'Admin Notification';
            $notif->title = 'Research Access Request for Information';
            $notif->message = 'Someone requested access to the research information.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = 0;
            $notif->save();

            return redirect()->to('/student/title-checker')->with('success', 'Request was successfully sent');
    }

    public function facultySendRequestAccess($id)
    {
        $research = DB::table('faculty_request_access')
        ->join('research_list', 'research_list.id', 'faculty_request_access.research_id')
        ->join('users', 'users.id', 'faculty_request_access.requestor_id')
        ->join('faculty', 'users.id', 'faculty.user_id')
        ->select('faculty_request_access.*','research_list.*','faculty.*','users.*')
        ->where('research_list.id', $id)
        ->where('users.id', Auth::id())
        ->latest('faculty_request_access.created_at')
        ->first();

        return response()->json($research);
    }

    public function facultySendinRequestAccess(Request $request)
    { 
            $faculty = DB::table('faculty')
                ->join('users', 'users.id', 'faculty.user_id')
                ->select('faculty.*', 'users.*')
                ->where('user_id', Auth::id())
                ->first();

                $research = DB::table('research_list')
                ->where('id', $request->researchId)
                ->first();

            $requests = new FacultyRequestAccess;
            $requests->requestor_id = Auth::id();
            $requests->requestor_type = $faculty->role;
            $requests->research_id = $research->id;
            $requests->start_access_date = now();
            $requests->purpose = $request->purpose;
            $requests->status = 'Pending';
            $requests->save();

            $notif = new Notifications;
            $notif->type = 'Admin Notification';
            $notif->title = 'Research Access Request for Documents';
            $notif->message = 'Someone requested access to the research documents.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = 0;
            $notif->save();

            return redirect()->to('/faculty/research-list')->with('success', 'Request was successfully sent');
    }

    public function studentResearchAccessRequests()
    {
        $admin = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $requestAccess = DB::table('student_request_access')
        ->join('users', 'users.id', 'student_request_access.requestor_id')
        ->join('research_list', 'research_list.id', 'student_request_access.research_id')
        ->select(
            'student_request_access.*',
            'research_list.id as researchId',
            'research_list.research_title',
            'users.fname',
            'users.mname',
            'users.lname',
            'users.id as userID'
        )
        ->orderByRaw("CASE 
                            WHEN student_request_access.status = 'Pending' THEN 0 
                            WHEN student_request_access.status = 'Access Approved' THEN 1 
                            ELSE 2 
                    END")
        ->orderBy('student_request_access.id') 
        ->get();

        $adminNotifCount = DB::table('notifications')
            ->where('type', 'Admin Notification')
            ->where('status', 'not read')
            ->count();

        $adminNotification = DB::table('notifications')
            ->where('type', 'Admin Notification')
            ->orderBy('date', 'desc')
            ->take(4)
            ->get();

        return View::make('admin.studentResearchAccessRequests',compact('admin','requestAccess','adminNotifCount','adminNotification'));
    }

    public function studentProcessingAccessFile($id)
    {
        $access = DB::table('student_request_access')
        ->join('research_list','research_list.id','student_request_access.research_id')
        ->select(
            'student_request_access.*',
            'research_list.id as researchId',
            'research_list.research_title')
        ->where('student_request_access.id', $id)
        ->first();
        
        return response()->json($access);
    }

    public function studentSendingAccessFile(Request $request)
    {
        $accessDate = now();
        $accessDate = Carbon::parse($accessDate);
        $accessDate->addDays(3);
        $formattedDate = $accessDate->toDateString();

        $access = StudentRequestAccess::find($request->requestId);
        $access->status = $request->status;
        $access->end_access_date = $formattedDate;
        $access->save();

        $recieverId = DB::table('student_request_access')
            ->where('id', $request->requestId)
            ->value('requestor_id');

        if ($request->status === 'Access Approved') {
            $notif = new Notifications;
            $notif->type = 'Student Notification';
            $notif->title = 'Research Access Request Made';
            $notif->message = 'You can now access the information you requested for a duration of three days.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $recieverId;
            $notif->save();
        } elseif ($request->status === 'Rejected') {
            $notif = new Notifications;
            $notif->type = 'Student Notification';
            $notif->title = 'Research Access Request Failed';
            $notif->message = 'Your request has been denied.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $recieverId;
            $notif->save();
        }
        
        



        return redirect()->to('/student-research-access-requests')->with('success', 'Process Done');
    }

    public function facultyResearchAccessRequests()
    {
        $admin = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $requestAccess = DB::table('faculty_request_access')
        ->join('users', 'users.id', 'faculty_request_access.requestor_id')
        ->join('research_list', 'research_list.id', 'faculty_request_access.research_id')
        ->select(
            'faculty_request_access.*',
            'research_list.id as researchId',
            'research_list.research_title',
            'users.fname',
            'users.mname',
            'users.lname',
            'users.id as userID'
        )
        ->orderByRaw("CASE 
                            WHEN faculty_request_access.status = 'Pending' THEN 0 
                            WHEN faculty_request_access.status = 'Access Approved' THEN 1 
                            ELSE 2 
                    END")
        ->orderBy('faculty_request_access.id') 
        ->get();

        $adminNotifCount = DB::table('notifications')
            ->where('type', 'Admin Notification')
            ->where('status', 'not read')
            ->count();

        $adminNotification = DB::table('notifications')
            ->where('type', 'Admin Notification')
            ->orderBy('date', 'desc')
            ->take(4)
            ->get();

        return View::make('admin.facultyResearchAccessRequests',compact('admin','requestAccess','adminNotifCount','adminNotification'));
    }

    public function facultyProcessingAccessFile($id)
    {
        $access = DB::table('faculty_request_access')
        ->join('research_list','research_list.id','faculty_request_access.research_id')
        ->select(
            'faculty_request_access.*',
            'research_list.id as researchId',
            'research_list.research_title')
        ->where('faculty_request_access.id', $id)
        ->first();
        
        return response()->json($access);
    }

    public function facultySendingAccessFile(Request $request)
    {
        $accessDate = now();
        $accessDate = Carbon::parse($accessDate);
        $accessDate->addDays(3);
        $formattedDate = $accessDate->toDateString();

        $access = FacultyRequestAccess::find($request->requestId);
        $access->status = $request->status;
        $access->end_access_date = $formattedDate;
        $access->save();

        return redirect()->to('/faculty-research-access-requests')->with('success', 'Accesss file successfully sent.');
    }

    //MOBILE START
    public function mobilestudentSendRequestAccess(Request $request, $id)
    {
        // Get user id from the authenticated user
        $research = DB::table('student_request_access')
            ->join('research_list', 'research_list.id', 'student_request_access.research_id')
            ->join('users', 'users.id', 'student_request_access.requestor_id')
            ->join('students', 'users.id', 'students.user_id')
            ->select('student_request_access.*','research_list.*','students.*','users.*')
            ->where('research_list.id', $id)
            ->where('users.id', $request->user_id)
            ->latest('student_request_access.created_at')
            ->first();

        return response()->json($research);
    }

    public function mobilestudentSendinRequestAccess(Request $request)
    { 
        $student = DB::table('students')
            ->join('users', 'users.id', 'students.user_id')
            ->select('students.*', 'users.*')
            ->where('user_id', Auth::id())
            ->first();

        $research = DB::table('research_list')
            ->where('id', $request->researchId)
            ->first();

        $requests = new StudentRequestAccess;
        $requests->requestor_id = $request->requestor_id;
        $requests->requestor_type = $request->requestor_type;
        $requests->research_id = $request->research_id;
        $requests->start_access_date = now();
        $requests->purpose = $request->purpose;
        $requests->status = 'Pending';
        $requests->save();

            $notif = new Notifications;
            $notif->type = 'Admin Notification';
            $notif->title = 'Research Access Request for Information';
            $notif->message = 'Someone requested access to the research information.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = 0;
            $notif->save();

        return response()->json([
            'success' => true,
            'message' => 'Request was successfully sent'
        ]);
    }

    public function mobilefacultySendRequestAccess($id)
    {
        $research = DB::table('research_list')
        ->where('id', $id)
        ->first();

        return response()->json($research);
    }

    public function mobilefacultySendRequestAccessFILE(Request $request, $id)
    {
        $research = DB::table('faculty_request_access')
        ->join('research_list', 'research_list.id', 'faculty_request_access.research_id')
        ->join('users', 'users.id', 'faculty_request_access.requestor_id')
        ->join('faculty', 'users.id', 'faculty.user_id')
        ->select('faculty_request_access.*','research_list.*','faculty.*','users.*')
        ->where('research_list.id', $id)
        ->where('users.id', $request->user_id)
        ->latest('faculty_request_access.created_at')
        ->first();

        return response()->json($research);
    }

    public function mobilefacultySendinRequestAccess(Request $request)
    { 
            $faculty = DB::table('faculty')
                ->join('users', 'users.id', 'faculty.user_id')
                ->select('faculty.*', 'users.*')
                ->where('user_id', Auth::id())
                ->first();

                $research = DB::table('research_list')
                ->where('id', $request->researchId)
                ->first();

            $requests = new FacultyRequestAccess;
            $requests->requestor_id = $request->requestor_id;
            $requests->requestor_type = $request->requestor_type;
            $requests->research_id = $request->research_id;
            $requests->start_access_date = now();
            $requests->purpose = $request->purpose;
            $requests->status = 'Pending';
            $requests->save();

            $notif = new Notifications;
            $notif->type = 'Admin Notification';
            $notif->title = 'Research Access Request for Documents';
            $notif->message = 'Someone requested access to the research documents.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = 0;
            $notif->save();

            return redirect()->to('/faculty/research-list')->with('success', 'Request was successfully sent');
    }
    //MOBILE END

    
}
