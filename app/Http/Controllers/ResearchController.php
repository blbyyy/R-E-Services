<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Algolia\AlgoliaSearch\SearchClient;
use App\Models\Student;
use App\Models\Staff;
use App\Models\Faculty;
use App\Models\User;
use App\Models\Research;
use App\Models\RequestAccess;
use App\Http\Redirect;
use View;
use DB;
use File;
use Auth;

class ResearchController extends Controller
{
    public function researchlist(Request $request)
    {
        $admin = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $query = $request->input('query');
        $researchlist = Research::search($query)->paginate(10);

        return View::make('research.researchlist',compact('researchlist','admin'));
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
        $research = DB::table('research_list')
        ->where('id', $id)
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

            $users = new RequestAccess;
            $users->requestor_id = $student->user_id;
            $users->requestor_type = $student->role;
            $users->research_title = $request->titleResearch;
            $users->purpose = $request->purpose;
            $users->status = 'Pending';
            $users->save();

            return redirect()->to('/student/title-checker')->with('success', 'Request was successfully sent');
    }

    public function facultySendRequestAccess($id)
    {
        $research = DB::table('research_list')
        ->where('id', $id)
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

            $users = new RequestAccess;
            $users->requestor_id = $faculty->user_id;
            $users->requestor_type = $faculty->role;
            $users->research_title = $request->titleResearch;
            $users->purpose = $request->purpose;
            $users->status = 'Pending';
            $users->save();

            return redirect()->to('/faculty/research-list')->with('success', 'Request was successfully sent');
    }

    public function researchAccessRequests()
    {
        $admin = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $requestAccess = DB::table('request_access')
        ->join('users','users.id','request_access.requestor_id')
        ->select(
            'request_access.*',
            'users.fname',
            'users.mname',
            'users.lname',
            'users.id as userID')
        ->orderBy('request_access.id')
        ->get();

        return View::make('admin.researchAccessRequests',compact('admin','requestAccess'));
    }

    public function processingAccessFile($id)
    {
        $access = DB::table('request_access')
        ->where('id', $id)
        ->first();

        return response()->json($access);
    }

    public function sendingAccessFile(Request $request)
    {
        $access = RequestAccess::find($request->requestId);

        if ($request->status === 'Sent') {

            $pdfFile = $request->file('research_file');
            $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
            $pdfFile->move(public_path('uploads/accessRequested'), $pdfFileName);
            
            $access->file = $pdfFileName;
            $access->status = 'Sent';
            $access->save();

            return redirect()->to('/research-access-requests')->with('success', 'Accesss file successfully sent.');

        } else {

            $access->status = 'Rejected';
            $access->save();

            return redirect()->to('/research-access-requests')->with('error', 'The access file has not been sent.');
        }
        
        
    }

    
}
