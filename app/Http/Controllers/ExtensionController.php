<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Mail;
use App\Mail\PresidentApproval;
use App\Mail\BoardApproval;
use App\Mail\DoApproval;
use App\Mail\UesApproval;
use App\Mail\OsgApproval;
use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Models\Appointments;
use App\Models\Extension;
use App\Models\Prototype;
use View, DB, File, Auth;

class ExtensionController extends Controller
{
    //FACULTY PART
    public function createApplication(Request $request)
    { 
        $extension = new Extension;
        $extension->title = $request->title;
        $extension->percentage_status = 0;
        $extension->status = 'New Application';
        $extension->user_id = Auth::id();
        $extension->save();

        return redirect()->to('/faculty/extension/application')->with('success', 'Created Application Successfully');
       
    }

    public function facultyApplication()
    {
        $faculty = DB::table('faculty')
        ->join('users','users.id','faculty.user_id')
        ->select('faculty.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

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

        $application = DB::table('extension')
            ->join('users','users.id','extension.user_id')
            ->select(
                'extension.*',
                'users.id as userId',
                'users.fname','users.mname',
                'users.lname','users.role')
            ->where('extension.user_id',Auth::id())
            ->orderBy('extension.created_at', 'desc')
            ->get();

            $extension = DB::table('extension')
            ->join('users','users.id','=','extension.user_id')
            ->select('extension.*','users.*')
            ->where('extension.user_id', Auth::id())
            ->get();

        return View::make('extension.facultyApplication',compact('faculty','facultyNotifCount','facultyNotification','application'));
    }

    public function facultyApplicationStatus()
    {
        $faculty = DB::table('faculty')
        ->join('users','users.id','faculty.user_id')
        ->select('faculty.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

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

        $extension = DB::table('extension')->where('extension.user_id', Auth::id())->get();

        return View::make('extension.facultyApplicationStatus',compact('faculty','facultyNotifCount','facultyNotification','extension'));
    }

    public function getAppointment($id)
    {
        $appointment = Appointments::find($id);
        return response()->json($appointment);
    }
    
    public function getFileExtension($id)
    {
        $extension = Extension::find($id);
        return response()->json($extension);
    }

    public function getDoumentationPhotos($id)
    {
        $photos = DB::table('extension')
        ->join('documentation_photos','extension.id','documentation_photos.extension_id')
        ->select('documentation_photos.*')
        ->where('extension.id', $id)
        ->get();

        return response()->json($photos);
    }

    public function getFilePrototype($id)
    {
        $prototype = Prototype::find($id);
        return response()->json($prototype);
    }

    public function proposal0ExtenxionId($id)
    {
        $extension = Extension::find($id);
        return response()->json($extension);
    }

    public function proposal1ExtenxionId($id)
    {
        $extension = Extension::find($id);
        return response()->json($extension);
    }

    public function proposal1(Request $request)
    {
        $extension = Extension::find($request->proposalId);
        $extension->beneficiary = $request->beneficiary;
        $extension->status = 'Pending Approval of R&E Office';
        $extension->percentage_status = 15;

        $pdfFile = $request->file('mou_file');
        $pdfFileName = $pdfFile->getClientOriginalName();
        $pdfFile->move(public_path('uploads/extension'), $pdfFileName);
            
        $extension->mou_file = $pdfFileName;
        $extension->save();

        $notif = new Notifications;
        $notif->type = 'Admin Notification';
        $notif->title = 'Extension Application Proposal Submitted';
        $notif->message = 'Someone submit an application proposal for approval.';
        $notif->date = now();
        $notif->user_id = Auth::id();
        $notif->reciever_id = 0;
        $notif->save();
        
        return redirect()->to('/faculty/extension/application')->with('success', 'Your Proposal has been sent; kindly wait to be approved.');
    }

    public function proposal2ExtenxionId($id)
    {
        $extension = Extension::find($id);
        return response()->json($extension);
    }

    public function proposal2(Request $request)
    { 
        $doEmail = 'josephandrebalbada@gmail.com';

        $extension = Extension::find($request->proposal2Id);
        $extension->status = 'Pending Approval of DO';
        $extension->percentage_status = 25;
        $extension->do_email = $doEmail;

        $pdfFile = $request->file('ppmp_file');
        $ppmpFileName = $pdfFile->getClientOriginalName();
        $pdfFile->move(public_path('uploads/extension'), $ppmpFileName);
        $extension->ppmp_file = $ppmpFileName;

        $pdfFile = $request->file('pr_file');
        $prFileName = $pdfFile->getClientOriginalName();
        $pdfFile->move(public_path('uploads/extension'), $prFileName);
        $extension->pr_file = $prFileName;

        $pdfFile = $request->file('market_study_file');
        $marketStudyFileName = $pdfFile->getClientOriginalName();
        $pdfFile->move(public_path('uploads/extension'), $marketStudyFileName);
        $extension->market_study_file = $marketStudyFileName;
        $extension->save();

        $notif = new Notifications;
        $notif->type = 'Admin Notification';
        $notif->title = 'PPMP, PR and Request for Qoutation/Market Study Submitted';
        $notif->message = 'Someone send ppmp, pr and request for qoutation/market study for document approval';
        $notif->date = now();
        $notif->user_id = Auth::id();
        $notif->reciever_id = 0;
        $notif->save();

        $requestor = DB::table('users')
            ->select(DB::raw("CONCAT(fname, ' ', COALESCE(mname, ''), ' ', lname) AS requestor"))
            ->where('id', Auth::id())
            ->value('requestor');

        $data = [
            'requestor' => $requestor,
            'ppmpFile' => $ppmpFileName,
            'prFile' => $prFileName,
            'marketStudyFile' => $marketStudyFileName,
        ];
    
        // Mail::to($doEmail)->send(new DoApproval($data));
        
        return redirect()->to('/faculty/extension/application')->with('success', 'Your Proposal has been sent to Do; kindly wait the result we immediately contact you about the result.');
    }

    public function proposal3ExtenxionId($id)
    {
        $extension = Extension::find($id);
        return response()->json($extension);
    }

    public function proposal3(Request $request)
    { 
        $boardEmail = 'josephandrebalbada@gmail.com';

        $extension = Extension::find($request->proposal3Id);
        $extension->status = 'Pending Approval of Board';
        $extension->percentage_status = 45;
        $extension->board_email = $boardEmail;

        $pdfFile = $request->file('moa_file');
        $moaFileName = $pdfFile->getClientOriginalName();
        $pdfFile->move(public_path('uploads/extension'), $moaFileName);
        $extension->moa_file = $moaFileName;
        $extension->save();

        $notif = new Notifications;
        $notif->type = 'Admin Notification';
        $notif->title = 'MOA(Memorandum of Agreement) Submitted';
        $notif->message = 'Someone send moa(memorandum of agreement) for document approval';
        $notif->date = now();
        $notif->user_id = Auth::id();
        $notif->reciever_id = 0;
        $notif->save();

        $proposals = DB::table('extension')
            ->join('users','users.id','extension.user_id')
            ->select(
                'extension.*',
                'users.id as userID','users.role',
                DB::raw("CONCAT(users.fname, ' ', COALESCE(users.mname, ''), ' ', users.lname) AS requestor_name")
            )
            ->where('extension.id', $request->proposal3Id)
            ->first();

        $data = [
            'requestor' => $proposals->requestor_name,
            'ppmpFile' => $proposals->ppmp_file,
            'prFile' => $proposals->pr_file,
            'marketStudyFile' => $proposals->market_study_file,
            'moaFile' => $moaFileName,
        ];
    
        // Mail::to($boardEmail)->send(new BoardApproval($data));
        
        return redirect()->to('/faculty/extension/application')->with('success', 'Your Proposal has been sent to Board; kindly wait the result if the result is out we immediately contact you.');
    }

    public function proposal4ExtenxionId($id)
    {
        $extension = Extension::find($id);
        return response()->json($extension);
    }

    public function proposal4(Request $request)
    { 
        $extension = Extension::find($request->proposal4Id);
        $extension->status = 'Pending Implementation Approval by R&E-Office';
        $extension->implementation_proper = $request->implementation_proper;
        $extension->proponents1 = $request->proponents1;
        $extension->proponents2 = $request->proponents2;
        $extension->proponents3 = $request->proponents3;
        $extension->proponents4 = $request->proponents4;
        $extension->proponents5 = $request->proponents5;
        $extension->save();

        $notif = new Notifications;
        $notif->type = 'Admin Notification';
        $notif->title = 'Implementation Proper and Proponents Submitted';
        $notif->message = 'Someone send implementation proper and proponents for implementation approval';
        $notif->date = now();
        $notif->user_id = Auth::id();
        $notif->reciever_id = 0;
        $notif->save();

        return redirect()->to('/faculty/extension/application')->with('success', 'Your Proposal has been sent to R&E-Office; kindly wait the result if the result is out we immediately contact you.');
    }

    public function proposal5ExtenxionId($id)
    {
        $extension = Extension::find($id);
        return response()->json($extension);
    }

    public function proposal5(Request $request)
    { 
        $extension = Extension::find($request->proposal5Id);
        $extension->status = 'Topics and Sub Topics Inputted';
        $extension->percentage_status = 65;
        $extension->topics = $request->topics;
        $extension->subtopics = $request->subtopics;
        $extension->save();

        $notif = new Notifications;
        $notif->type = 'Admin Notification';
        $notif->title = 'Topics and Sub Topics Inserted';
        $notif->message = 'Topics and Subtopics Inserted';
        $notif->date = now();
        $notif->user_id = Auth::id();
        $notif->reciever_id = 0;
        $notif->save();

        return redirect()->to('/faculty/extension/application')->with('success', 'Topics and Subtopics Inputted; Kindly make an appointment for consultation about the Pre-Evaluation survey.');
    }

    public function proposal6ExtenxionId($id)
    {
        $extension = Extension::find($id);
        return response()->json($extension);
    }

    public function documentation_img_upload($filename)
    {
        $photo = array('photo' => $filename);
        $destinationPath = public_path().'/images/documentation'; 
        $original_filename = time().$filename->getClientOriginalName();
        $extension = $filename->getClientOriginalExtension(); 
        $filename->move($destinationPath, $original_filename); 
    }

    public function proposal6(Request $request)
    { 
        $extension = Extension::find($request->proposal6Id);

        $pdfFile = $request->file('post_evaluation_attendance');
        $postEvaluationAttendanceFileName = $pdfFile->getClientOriginalName();
        $pdfFile->move(public_path('uploads/extension'), $postEvaluationAttendanceFileName);
        $extension->post_evaluation_attendance = $postEvaluationAttendanceFileName;

        $pdfFile = $request->file('evaluation_form');
        $evaluationFormFileName = $pdfFile->getClientOriginalName();
        $pdfFile->move(public_path('uploads/extension'), $evaluationFormFileName);
        $extension->evaluation_form = $evaluationFormFileName;

        $pdfFile = $request->file('capsule_detail');
        $capsuleDetailFileName = $pdfFile->getClientOriginalName();
        $pdfFile->move(public_path('uploads/extension'), $capsuleDetailFileName);
        $extension->capsule_detail = $capsuleDetailFileName;

        $pdfFile = $request->file('certificate');
        $certificateFileName = $pdfFile->getClientOriginalName();
        $pdfFile->move(public_path('uploads/extension'), $certificateFileName);
        $extension->certificate = $certificateFileName;

        $pdfFile = $request->file('attendance');
        $attendanceFileName = $pdfFile->getClientOriginalName();
        $pdfFile->move(public_path('uploads/extension'), $attendanceFileName);
        $extension->attendance = $attendanceFileName;
        
        $extension->status = 'Inserted: Certificate, Documentation, Attendance, and Capsule Details';
        $extension->percentage_status = 80;
        $extension->save();

        $notif = new Notifications;
        $notif->type = 'Admin Notification';
        $notif->title = 'Post Evaluation Attendance, Evaluatin Form, Capsule Detail, Certificate, Attendance and Documentation Photos Inserted';
        $notif->message = 'Inserted post-evaluation survey attendance, evaluation form, capsule detail, certificate, attendance and documentation photos';
        $notif->date = now();
        $notif->user_id = Auth::id();
        $notif->reciever_id = 0;
        $notif->save();

        $files = $request->file('img_path');
            foreach ($files as $file) 
            {
                $this->documentation_img_upload($file);
                $multi['img_path']=time().$file->getClientOriginalName();
                $multi['extension_id'] = $request->proposal6Id ;
                DB::table('documentation_photos')->insert($multi);
            }

        return redirect()->to('/faculty/extension/application')->with('success', 'Process Done');
    }

    public function proposal7ExtenxionId($id)
    {
        $extension = Extension::find($id);
        return response()->json($extension);
    }

    public function proposal7(Request $request)
    { 
        if ($request->confirmation == 'Yes') {
            
            $prototype = new Prototype;
            
            $pdfFile = $request->file('letter');
            $letterFileName = $pdfFile->getClientOriginalName();
            $pdfFile->move(public_path('uploads/prototype'), $letterFileName);
            $prototype->letter = $letterFileName;
    
            $pdfFile = $request->file('nda');
            $ndaFileName = $pdfFile->getClientOriginalName();
            $pdfFile->move(public_path('uploads/prototype'), $ndaFileName);
            $prototype->nda = $ndaFileName;
    
            $pdfFile = $request->file('coa');
            $coaFileName = $pdfFile->getClientOriginalName();
            $pdfFile->move(public_path('uploads/prototype'), $coaFileName);
            $prototype->coa = $coaFileName;
            
            $prototype->save();
            $lastId = DB::getPdo()->lastInsertId();

            $extension = Extension::find($request->proposal7Id);
            $extension->prototype_id = $lastId;
            $extension->status = 'Have Prototype: Letter, NDA, COA Inserted';
            $extension->percentage_status = 85;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Admin Notification';
            $notif->title = 'Letter, Non Diclosure Agreement and Certificate of Acceptance Inserted';
            $notif->message = 'Inserted letter, nda and coa ';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = 0;
            $notif->save();

            return redirect()->to('/faculty/extension/application')->with('success', 'Inserted: Letter, NDA and COA File');

        } else {

            $extension = Extension::find($request->proposal7Id);
            $extension->status = 'Process Done';
            $extension->percentage_status = 100;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Admin Notification';
            $notif->title = 'Extension Application Process Done';
            $notif->message = 'Extension application was completed all the process ';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = 0;
            $notif->save();

            return redirect()->to('/faculty/extension/application')->with('success', 'Process Done');
        }

    }

    public function proposal8ExtenxionId($id)
    {
        $extension = DB::table('extension')
        ->join('prototype','prototype.id','extension.prototype_id')
        ->select('prototype.id as prototypeID','extension.*')
        ->where('extension.id', $id)
        ->first();

        return response()->json($extension);
    }

    public function proposal8(Request $request)
    { 
        if ($request->pre_evaluation == 'Prototype Pre-Evaluation Survey Done') {
            
            $extension = Extension::find($request->proposal8Id);
            $extension->status = $request->pre_evaluation;
            $extension->percentage_status = 87;
            $extension->save();

            $extension = Prototype::find($request->prototype1Id);
            $extension->pre_evaluation_survey = $request->pre_evaluation;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Admin Notification';
            $notif->title = 'Prototype Pre-Evaluation Survey Done';
            $notif->message = 'Quick update: prototype pre-evaluation survey done';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = 0;
            $notif->save();

            return redirect()->to('/faculty/extension/application')->with('success', 'Prototype Pre-Evaluation Survey Done');

        } else {

            $extension = Extension::find($request->proposal8Id);
            $extension->status = $request->pre_evaluation;
            $extension->save();

            $extension = Prototype::find($request->prototype1Id);
            $extension->pre_evaluation_survey = $request->pre_evaluation;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Admin Notification';
            $notif->title = 'Prototype Pre-Evaluation Survey Not Done';
            $notif->message = 'Quick update: prototype pre-evaluation survey not done';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = 0;
            $notif->save();

            return redirect()->to('/faculty/extension/application')->with('error', 'Prototype Pre-Evaluation Survey Not Done');
        }

    }

    public function proposal9ExtenxionId($id)
    {
        $extension = DB::table('extension')
        ->join('prototype','prototype.id','extension.prototype_id')
        ->select('prototype.id as prototypeID','extension.*')
        ->where('extension.id', $id)
        ->first();

        return response()->json($extension);
    }

    public function proposal9(Request $request)
    { 
        if ($request->mid_evaluation == 'Prototype Mid-Evaluation Survey Done') {
            
            $extension = Extension::find($request->proposal9Id);
            $extension->status = $request->mid_evaluation;
            $extension->percentage_status = 89;
            $extension->save();

            $extension = Prototype::find($request->prototype2Id);
            $extension->mid_evaluation_survey = $request->mid_evaluation;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Admin Notification';
            $notif->title = 'Prototype Mid-Evaluation Survey Done';
            $notif->message = 'Quick update: prototype mid-evaluation survey done';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = 0;
            $notif->save();

            return redirect()->to('/faculty/extension/application')->with('success', 'Prototype Mid-Evaluation Survey Done');

        } else {

            $extension = Extension::find($request->proposal9Id);
            $extension->status = $request->mid_evaluation;
            $extension->save();

            $extension = Prototype::find($request->prototype2Id);
            $extension->mid_evaluation_survey = $request->mid_evaluation;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Admin Notification';
            $notif->title = 'Prototype Mid-Evaluation Survey Not Done';
            $notif->message = 'Quick update: prototype mid-evaluation survey not done';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = 0;
            $notif->save();

            return redirect()->to('/faculty/extension/application')->with('error', 'Prototype Mid-Evaluation Survey Not Done');
        }

    }

    public function proposal10ExtenxionId($id)
    {
        $extension = DB::table('extension')
        ->join('prototype','prototype.id','extension.prototype_id')
        ->select('prototype.id as prototypeID','extension.*')
        ->where('extension.id', $id)
        ->first();

        return response()->json($extension);
    }

    public function proposal10(Request $request)
    { 
        if ($request->post_evaluation == 'Prototype Post-Evaluation Survey Done') {
            
            $extension = Extension::find($request->proposal10Id);
            $extension->status = $request->post_evaluation;
            $extension->percentage_status = 91;
            $extension->save();

            $extension = Prototype::find($request->prototype3Id);
            $extension->post_evaluation_survey = $request->post_evaluation;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Admin Notification';
            $notif->title = 'Prototype Post-Evaluation Survey Done';
            $notif->message = 'Quick update: prototype post-evaluation survey done';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = 0;
            $notif->save();

            return redirect()->to('/faculty/extension/application')->with('success', 'Prototype Post-Evaluation Survey Done');

        } else {

            $extension = Extension::find($request->proposal10Id);
            $extension->status = $request->post_evaluation;
            $extension->save();

            $extension = Prototype::find($request->prototype3Id);
            $extension->post_evaluation_survey = $request->post_evaluation;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Admin Notification';
            $notif->title = 'Prototype Post-Evaluation Survey Not Done';
            $notif->message = 'Quick update: prototype post-evaluation survey not done';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = 0;
            $notif->save();

            return redirect()->to('/faculty/extension/application')->with('error', 'Prototype Mid-Evaluation Survey Not Done');
        }

    }

    public function proposal11ExtenxionId($id)
    {
        $extension = DB::table('extension')
        ->join('prototype','prototype.id','extension.prototype_id')
        ->select('prototype.id as prototypeID','extension.*')
        ->where('extension.id', $id)
        ->first();

        return response()->json($extension);
    }

    public function prototypeDocumentation_img_upload($filename)
    {
        $photo = array('photo' => $filename);
        $destinationPath = public_path().'/images/prototypeDocumentation'; 
        $original_filename = time().$filename->getClientOriginalName();
        $extension = $filename->getClientOriginalExtension(); 
        $filename->move($destinationPath, $original_filename); 
    }

    public function proposal11(Request $request)
    { 

        $extension = Extension::find($request->proposal11Id);
        $extension->status = 'Process Done';
        $extension->percentage_status = 100;
        $extension->save();

        $prototype = Prototype::find($request->prototype4Id);
        
        $pdfFile = $request->file('capsule_detail');
        $capsuleDetailFileName = $pdfFile->getClientOriginalName();
        $pdfFile->move(public_path('uploads/prototype'), $capsuleDetailFileName);
        $prototype->capsule_detail = $capsuleDetailFileName;
    
        $pdfFile = $request->file('certificate');
        $certificateFileName = $pdfFile->getClientOriginalName();
        $pdfFile->move(public_path('uploads/prototype'), $certificateFileName);
        $prototype->certificate = $certificateFileName;
    
        $pdfFile = $request->file('attendance');
        $attendanceFileName = $pdfFile->getClientOriginalName();
        $pdfFile->move(public_path('uploads/prototype'), $attendanceFileName);
        $prototype->attendance = $attendanceFileName;

        $files = $request->file('img_path');
            foreach ($files as $file) 
            {
                $this->prototypeDocumentation_img_upload($file);
                $multi['img_path']=time().$file->getClientOriginalName();
                $multi['prototype_id'] = $request->prototype4Id ;
                DB::table('prototype_photos')->insert($multi);
            }

        $prototype->save();

        $notif = new Notifications;
        $notif->type = 'Admin Notification';
        $notif->title = 'Inserted Prototype Capsule Detail, Certificate, Documentation Photos and Attendance';
        $notif->message = 'Inserted prototype capsule detail, certificate, documentation photos, and attendance.';
        $notif->date = now();
        $notif->user_id = Auth::id();
        $notif->reciever_id = 0;
        $notif->save();

        return redirect()->to('/faculty/extension/application')->with('success', 'Capsule Detail, Certificate, Attendance and Documentation Photos Inserted.');

    }

    //ADMIN PART
    public function proposalList()
    {
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
            ->take(4)
            ->get();

        $proposals = DB::table('extension')
            ->join('users','users.id','extension.user_id')
            ->select(
                'extension.*',
                'users.id as userID','users.role',
                DB::raw("CONCAT(users.fname, ' ', COALESCE(users.mname, ''), ' ', users.lname) AS requestor_name")
            )
            ->orderBy('extension.created_at', 'desc')
            ->get();

        return View::make('admin.extensionProposals',compact('admin','adminNotifCount','adminNotification','proposals'));
    }

    public function proposal1Id($id)
    {
        $proposals = DB::table('extension')
            ->join('users','users.id','extension.user_id')
            ->select(
                'extension.*',
                'users.id as userID','users.role',
                DB::raw("CONCAT(users.fname, ' ', COALESCE(users.mname, ''), ' ', users.lname) AS requestor_name")
            )
            ->where('extension.id', $id)
            ->first();

        return response()->json($proposals);
    }

    public function adminProposalApproval1(Request $request)
    { 
        $userID = Extension::where('id', $request->proposalId1)
        ->orderBy('created_at', 'desc')
        ->value('user_id');

        if ($request->status === 'Proposal Approved by R&E Office') {

            $extension = Extension::find($request->proposalId1);
            $extension->status = $request->status;
            $extension->percentage_status = 20;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Proposal Approved by R&E Office';
            $notif->message = 'Your proposal was approved by R&E Office.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $userID;
            $notif->save();

            return redirect()->to('/admin/extension/proposal-list')->with('success', 'Proposal Approved.');

        } else {

            $extension = Extension::find($request->proposalId1);
            $extension->status = $request->status;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Proposal Rejected by R&E Office';
            $notif->message = 'Your proposal was rejected by R&E Office.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $userID;
            $notif->save();

            return redirect()->to('/admin/extension/proposal-list')->with('error', 'Proposal Rejected.');
            
        }
    }

    public function proposal2Id($id)
    {
        $proposals = DB::table('extension')
            ->join('users','users.id','extension.user_id')
            ->select(
                'extension.*',
                'users.id as userID','users.role',
                DB::raw("CONCAT(users.fname, ' ', COALESCE(users.mname, ''), ' ', users.lname) AS requestor_name")
            )
            ->where('extension.id', $id)
            ->first();

        return response()->json($proposals);
    }

    public function adminProposalApproval2(Request $request)
    { 
        $uesEmail = 'josephandrebalbada@gmail.com';

        $userID = Extension::where('id', $request->proposalId2)
        ->orderBy('created_at', 'desc')
        ->value('user_id');

        if ($request->status === 'Pending Proposal Approval By UES') {

            $extension = Extension::find($request->proposalId2);
            $extension->status = $request->status;
            $extension->percentage_status = 30;
            $extension->ues_email = $uesEmail;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Documents Approved By DO';
            $notif->message = 'Your documents was approved by DO.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $userID;
            $notif->save();

            $proposals = DB::table('extension')
            ->join('users','users.id','extension.user_id')
            ->select(
                'extension.*',
                'users.id as userID','users.role',
                DB::raw("CONCAT(users.fname, ' ', COALESCE(users.mname, ''), ' ', users.lname) AS requestor_name")
            )
            ->where('extension.id', $request->proposalId2)
            ->first();

            $data = [
                'requestor' => $proposals->requestor_name,
                'ppmpFile' => $proposals->ppmp_file,
                'prFile' => $proposals->pr_file,
                'marketStudyFile' => $proposals->market_study_file,
            ];
        
            // Mail::to($uesEmail)->send(new UesApproval($data));

            return redirect()->to('/admin/extension/proposal-list')->with('success', 'Proposal Approved By DO.');

        } else {

            $extension = Extension::find($request->proposalId2);
            $extension->status = $request->status;
            $extension->remarks = $request->remarks;
            $extension->percentage_status = 20;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Documents Rejected By DO';
            $notif->message = 'Your documents was rejected by DO.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $userID;
            $notif->save();

            return redirect()->to('/admin/extension/proposal-list')->with('error', 'Proposal Rejected By DO.');
            
        }
    }

    public function proposal3Id($id)
    {
        $proposals = DB::table('extension')
            ->join('users','users.id','extension.user_id')
            ->select(
                'extension.*',
                'users.id as userID','users.role',
                DB::raw("CONCAT(users.fname, ' ', COALESCE(users.mname, ''), ' ', users.lname) AS requestor_name")
            )
            ->where('extension.id', $id)
            ->first();

        return response()->json($proposals);
    }

    public function adminProposalApproval3(Request $request)
    { 
        $presidentEmail = 'josephandrebalbada@gmail.com';

        $userID = Extension::where('id', $request->proposalId3)
        ->orderBy('created_at', 'desc')
        ->value('user_id');

        if ($request->status === 'Pending Proposal Approval By President') {

            $extension = Extension::find($request->proposalId3);
            $extension->status = $request->status;
            $extension->percentage_status = 35;
            $extension->president_email = $presidentEmail;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Documents Approved By UES';
            $notif->message = 'Your documents was approved by UES.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $userID;
            $notif->save();

            $proposals = DB::table('extension')
            ->join('users','users.id','extension.user_id')
            ->select(
                'extension.*',
                'users.id as userID','users.role',
                DB::raw("CONCAT(users.fname, ' ', COALESCE(users.mname, ''), ' ', users.lname) AS requestor_name")
            )
            ->where('extension.id', $request->proposalId3)
            ->first();

            $data = [
                'requestor' => $proposals->requestor_name,
                'ppmpFile' => $proposals->ppmp_file,
                'prFile' => $proposals->pr_file,
                'marketStudyFile' => $proposals->market_study_file,
            ];
        
            // Mail::to($presidentEmail)->send(new PresidentApproval($data));

            return redirect()->to('/admin/extension/proposal-list')->with('success', 'Proposal Approved By UES.');

        } else {

            $extension = Extension::find($request->proposalId3);
            $extension->status = $request->status;
            $extension->remarks = $request->remarks;
            $extension->percentage_status = 20;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Documents Rejected By UES';
            $notif->message = 'Your documents was rejected by UES.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $userID;
            $notif->save();

            return redirect()->to('/admin/extension/proposal-list')->with('error', 'Proposal Rejected By UES.');
            
        }
    }

    public function proposal4Id($id)
    {
        $proposals = DB::table('extension')
            ->join('users','users.id','extension.user_id')
            ->select(
                'extension.*',
                'users.id as userID','users.role',
                DB::raw("CONCAT(users.fname, ' ', COALESCE(users.mname, ''), ' ', users.lname) AS requestor_name")
            )
            ->where('extension.id', $id)
            ->first();

        return response()->json($proposals);
    }

    public function adminProposalApproval4(Request $request)
    { 
        $userID = Extension::where('id', $request->proposalId4)
        ->orderBy('created_at', 'desc')
        ->value('user_id');

        if ($request->status === 'Proposal Approved By President') {

            $extension = Extension::find($request->proposalId4);
            $extension->status = $request->status;
            $extension->percentage_status = 40;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Documents Approved By President';
            $notif->message = 'Your documents was approved by President.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $userID;
            $notif->save();

            return redirect()->to('/admin/extension/proposal-list')->with('success', 'Proposal Approved By President.');

        } else {

            $extension = Extension::find($request->proposalId4);
            $extension->status = $request->status;
            $extension->remarks = $request->remarks;
            $extension->percentage_status = 20;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Documents Rejected By President';
            $notif->message = 'Your documents was rejected by President.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $userID;
            $notif->save();

            return redirect()->to('/admin/extension/proposal-list')->with('error', 'Proposal Rejected By President.');
            
        }
    }

    public function proposal5Id($id)
    {
        $proposals = DB::table('extension')
            ->join('users','users.id','extension.user_id')
            ->select(
                'extension.*',
                'users.id as userID','users.role',
                DB::raw("CONCAT(users.fname, ' ', COALESCE(users.mname, ''), ' ', users.lname) AS requestor_name")
            )
            ->where('extension.id', $id)
            ->first();

        return response()->json($proposals);
    }

    public function adminProposalApproval5(Request $request)
    { 
        $osgEmail = 'josephandrebalbada@gmail.com';

        $userID = Extension::where('id', $request->proposalId5)
        ->orderBy('created_at', 'desc')
        ->value('user_id');

        if ($request->status === 'Pending Proposal Approval By OSG') {

            $extension = Extension::find($request->proposalId5);
            $extension->status = $request->status;
            $extension->percentage_status = 50;
            $extension->osg_email = $osgEmail;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Documents Approved By Board';
            $notif->message = 'Your documents was approved by Board.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $userID;
            $notif->save();

            $proposals = DB::table('extension')
            ->join('users','users.id','extension.user_id')
            ->select(
                'extension.*',
                'users.id as userID','users.role',
                DB::raw("CONCAT(users.fname, ' ', COALESCE(users.mname, ''), ' ', users.lname) AS requestor_name")
            )
            ->where('extension.id', $request->proposalId5)
            ->first();

            $data = [
                'requestor' => $proposals->requestor_name,
                'ppmpFile' => $proposals->ppmp_file,
                'prFile' => $proposals->pr_file,
                'marketStudyFile' => $proposals->market_study_file,
                'moaFile' => $proposals->moa_file,
            ];
        
            // Mail::to($osgEmail)->send(new OsgApproval($data));

            return redirect()->to('/admin/extension/proposal-list')->with('success', 'Proposal Approved By Board.');

        } else {

            $extension = Extension::find($request->proposalId5);
            $extension->status = $request->status;
            $extension->remarks = $request->remarks;
            $extension->percentage_status = 20;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Documents Rejected By Board';
            $notif->message = 'Your documents was rejected by Board.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $userID;
            $notif->save();

            return redirect()->to('/admin/extension/proposal-list')->with('error', 'Proposal Rejected By Board.');
            
        }
    }

    public function proposal6Id($id)
    {
        $proposals = DB::table('extension')
            ->join('users','users.id','extension.user_id')
            ->select(
                'extension.*',
                'users.id as userID','users.role',
                DB::raw("CONCAT(users.fname, ' ', COALESCE(users.mname, ''), ' ', users.lname) AS requestor_name")
            )
            ->where('extension.id', $id)
            ->first();

        return response()->json($proposals);
    }

    public function adminProposalApproval6(Request $request)
    { 
        $userID = Extension::where('id', $request->proposalId6)
        ->orderBy('created_at', 'desc')
        ->value('user_id');

        if ($request->status === 'Proposal Approved By OSG') {

            $extension = Extension::find($request->proposalId6);
            $extension->status = $request->status;
            $extension->percentage_status = 55;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Documents Approved By OSG';
            $notif->message = 'Your documents was approved by OSG.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $userID;
            $notif->save();

            return redirect()->to('/admin/extension/proposal-list')->with('success', 'Proposal Approved By OSG.');

        } else {

            $extension = Extension::find($request->proposalId6);
            $extension->status = $request->status;
            $extension->remarks = $request->remarks;
            $extension->percentage_status = 20;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Documents Rejected By OSG';
            $notif->message = 'Your documents was rejected by OSG.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $userID;
            $notif->save();

            return redirect()->to('/admin/extension/proposal-list')->with('error', 'Proposal Rejected By OSG.');
            
        }
    }

    public function proposal7Id($id)
    {
        $proposals = DB::table('extension')
            ->join('users','users.id','extension.user_id')
            ->select(
                'extension.*',
                'users.id as userID','users.role',
                DB::raw("CONCAT(users.fname, ' ', COALESCE(users.mname, ''), ' ', users.lname) AS requestor_name")
            )
            ->where('extension.id', $id)
            ->first();

        return response()->json($proposals);
    }

    public function adminProposalApproval7(Request $request)
    { 
        $userID = Extension::where('id', $request->proposalId7)
        ->orderBy('created_at', 'desc')
        ->value('user_id');

        if ($request->status === 'Implementation Approved By R&E-Office') {

            $extension = Extension::find($request->proposalId7);
            $extension->status = $request->status;
            $extension->percentage_status = 60;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Implementation Approved By R&E Office';
            $notif->message = 'Your implementation yous send was approved by R&E Office.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $userID;
            $notif->save();

            return redirect()->to('/admin/extension/proposal-list')->with('success', 'Implementation Approved By R&E-Office.');

        } else {

            $extension = Extension::find($request->proposalId7);
            $extension->status = $request->status;
            $extension->remarks = $request->remarks;
            $extension->percentage_status = 55;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Implementation Rejected By R&E Office';
            $notif->message = 'Your implementation yous send was rejected by R&E Office.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $userID;
            $notif->save();

            return redirect()->to('/admin/extension/proposal-list')->with('error', 'Implementation Rejected By R&E-Office.');
            
        }
    }

    //MOBILE START
    public function mobilecreateApplication(Request $request)
    { 
        $extension = new Extension;
        $extension->title = $request->title;
        $extension->percentage_status = 0;
        $extension->status = 'New Application';
        $extension->user_id = $request->user_id;
        $extension->save();

        return response()->json(['message' => 'Created Application Successfully', 'extension_id' => $extension->id], 200);
    }

    public function mobilefacultyApplication($user_id)
    {
        $faculty = DB::table('faculty')
            ->join('users', 'users.id', 'faculty.user_id')
            ->select('faculty.*', 'users.*')
            ->where('user_id', $user_id)
            ->first();

        // $facultyNotifCount = DB::table('notifications')
        //     ->where('type', 'Faculty Notification')
        //     ->where('receiver_id', Auth::id())
        //     ->count();

        // $facultyNotification = DB::table('notifications')
        //     ->where('type', 'Faculty Notification')
        //     ->where('receiver_id', Auth::id())
        //     ->orderBy('date', 'desc')
        //     ->take(4)
        //     ->get();

        $application = DB::table('extension')
            ->join('users', 'users.id', 'extension.user_id')
            ->select(
                'extension.*',
                'users.id as userId',
                'users.fname', 'users.mname',
                'users.lname', 'users.role'
            )
            ->where('extension.user_id', $user_id)
            ->orderBy('extension.created_at', 'desc')
            ->get();

        // Create an associative array to hold all the data
        $data = [
            'faculty' => $faculty,
            // 'facultyNotifCount' => $facultyNotifCount,
            // 'facultyNotification' => $facultyNotification,
            'application' => $application,
        ];

        // Return JSON response
        return response()->json($data);
    }

    public function mobileproposal1(Request $request)
    {
        try {
            $extension = Extension::find($request->proposalId);
            $extension->beneficiary = $request->beneficiary;
            $extension->status = 'Pending Approval of R&E Office';
            $extension->percentage_status = 15;

            if ($request->hasFile('mou_file')) {
                $pdfFile = $request->file('mou_file');
                $pdfFileName = $pdfFile->getClientOriginalName();
                $pdfFile->move(public_path('uploads/extension'), $pdfFileName);
                
                $extension->mou_file = $pdfFileName;
            }

            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Admin Notification';
            $notif->title = 'Extension Application Proposal Submitted';
            $notif->message = 'Someone submit an application proposal for approval.';
            $notif->date = now();
            $notif->user_id = $request->user_id;
            $notif->reciever_id = 0;
            $notif->save();
            
            // Construct the response data
            $response = [
                'success' => true,
                'message' => 'Your Proposal has been sent; kindly wait to be approved.'
            ];

            return response()->json($response);
        } catch (\Exception $e) {
            // Handle any exceptions
            return response()->json([
                'success' => false,
                'message' => 'Error submitting proposal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function mobileproposal2(Request $request)
    { 
        $doEmail = 'josephandrebalbada@gmail.com';

        $extension = Extension::find($request->proposal2Id);
        $extension->status = 'Pending Approval of DO';
        $extension->percentage_status = 25;
        $extension->do_email = $doEmail;

        $pdfFile = $request->file('ppmp_file');
        $ppmpFileName = $pdfFile->getClientOriginalName();
        $pdfFile->move(public_path('uploads/extension'), $ppmpFileName);
        $extension->ppmp_file = $ppmpFileName;

        $pdfFile = $request->file('pr_file');
        $prFileName = $pdfFile->getClientOriginalName();
        $pdfFile->move(public_path('uploads/extension'), $prFileName);
        $extension->pr_file = $prFileName;

        $pdfFile = $request->file('market_study_file');
        $marketStudyFileName = $pdfFile->getClientOriginalName();
        $pdfFile->move(public_path('uploads/extension'), $marketStudyFileName);
        $extension->market_study_file = $marketStudyFileName;
        $extension->save();

        $notif = new Notifications;
        $notif->type = 'Admin Notification';
        $notif->title = 'PPMP, PR and Request for Qoutation/Market Study Submitted';
        $notif->message = 'Someone send ppmp, pr and request for qoutation/market study for document approval';
        $notif->date = now();
        $notif->user_id = $request->user_id;
        $notif->reciever_id = 0;
        $notif->save();

        $requestor = DB::table('users')
            ->select(DB::raw("CONCAT(fname, ' ', COALESCE(mname, ''), ' ', lname) AS requestor"))
            ->where('id', $request->user_id)
            ->value('requestor');

        $data = [
            'requestor' => $requestor,
            'ppmpFile' => $ppmpFileName,
            'prFile' => $prFileName,
            'marketStudyFile' => $marketStudyFileName,
        ];

        // Mail::to($doEmail)->send(new DoApproval($data));
        
        return response()->json([
            'success' => true,
            'message' => 'Your Proposal has been sent to Do; kindly wait the result we immediately contact you about the result.',
            'data' => $data,
        ]);
    }
    //MOBILE END
}

