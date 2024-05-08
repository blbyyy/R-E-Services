<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\ResearchProposal; 
use App\Models\Notifications;
use Illuminate\Support\Facades\Storage;
use App\Mail\ResearchDoApproval;
use App\Mail\ResearchUrdsApproval;
use App\Mail\ResearchVpressApproval;
use App\Mail\ResearchPressApproval;
use App\Models\ColloquiumSchedule;
use View, DB, File, Auth;

class ResearchProposalController extends Controller
{
    //Faculty POV
    public function researchProposal()
    {
        $faculty = DB::table('faculty')
        ->join('users','users.id','faculty.user_id')
        ->select('faculty.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $facultyNotifCount = DB::table('notifications')
            ->where('type', 'Faculty Notification')
            ->where('reciever_id', Auth::id())
            ->where('status', 'not read')
            ->count();

        $facultyNotification = DB::table('notifications')
            ->where('type', 'Faculty Notification')
            ->where('reciever_id', Auth::id())
            ->orderBy('date', 'desc')
            ->take(4)
            ->get();

        $proposal = DB::table('research_proposal')
            ->join('users','users.id','research_proposal.user_id')
            ->select(
                'research_proposal.*',
                'users.id as userId',
                'users.fname','users.mname',
                'users.lname','users.role',
                )
            ->where('research_proposal.user_id',Auth::id())
            ->get();

        return View::make('faculty.researchProposal',compact('faculty','facultyNotifCount','facultyNotification','proposal'));
    }

    public function uploadResearchProposal(Request $request)
    { 
            $proposal = new ResearchProposal;
            $proposal->research_type = $request->research_type;
            $proposal->title = $request->title;
            $proposal->status = 'Pending R&E Office Approval';
            $proposal->remarks = 'Your research proposal will undergo a review process. Please wait for the results once your proposal has been assessed, we will contact you immediately.';
            $proposal->user_id  = Auth::id();

            $pdfFile = $request->file('researchProposalFile');
            $pdfFileName = time().'-'.$pdfFile->getClientOriginalName();
            Storage::put('public/researchProposal/'.time().'-'.$pdfFile->getClientOriginalName(), file_get_contents($pdfFile));

            $proposal->proposal_file = $pdfFileName;
            $proposal->save();

            $notif = new Notifications;
            $notif->type = 'Admin Notification';
            $notif->title = 'Faculty Research Proposal Submitted';
            $notif->message = 'Someone submitted an research proposal for assesment.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->save();

            return redirect()->to('/faculty/research-proposal')->with('success', 'Research Proposal Successfully Sent.');

    }

    public function reSubmitProposalFetchingId($id)
    {
        $proposal = DB::table('research_proposal')
            ->join('users','users.id','research_proposal.user_id')
            ->select('research_proposal.*','users.*')
            ->where('research_proposal.id', $id)
            ->first();

        return response()->json($proposal);
    }

    public function reUploadResearchProposal(Request $request)
    { 
            $proposal = ResearchProposal::find($request->proposalId);
            $proposal->title = $request->title;
            $proposal->status = 'Pending R&E Office Approval';
            $proposal->remarks = 'Your research proposal will undergo a review process. Please wait for the results once your proposal has been assessed, we will contact you immediately.';

            $pdfFile = $request->file('researchProposalFile');
            $pdfFileName = time().'-'.$pdfFile->getClientOriginalName();
            Storage::put('public/researchProposal/'.time().'-'.$pdfFile->getClientOriginalName(), file_get_contents($pdfFile));

            $proposal->proposal_file = $pdfFileName;
            $proposal->save();

            $notif = new Notifications;
            $notif->type = 'Admin Notification';
            $notif->title = 'Faculty Research Proposal Submitted';
            $notif->message = 'Someone submitted an research proposal for assesment.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->save();

            return redirect()->to('/faculty/research-proposal')->with('success', 'Research Proposal Successfully Sent.');

    }

    public function researchProposalStatus($id)
    {
        $proposal = DB::table('research_proposal')
            ->join('users','users.id','research_proposal.user_id')
            ->leftJoin('colloquium_schedule','research_proposal.id','colloquium_schedule.researchProposal_id')
            ->select(
                'research_proposal.*',
                'users.id as userId','users.fname','users.mname','users.lname','users.role',
                'colloquium_schedule.id as colloquiumId','colloquium_schedule.time',
                'colloquium_schedule.date','colloquium_schedule.status as colloquiumStatus')
            ->where('research_proposal.id', $id)
            ->first();

        return response()->json($proposal);
    }

    public function gettingProposalFile($id)
    {
        $proposal = DB::table('research_proposal')
            ->join('users','users.id','research_proposal.user_id')
            ->select(
                'research_proposal.*',
                'users.id as userId','users.fname','users.mname','users.lname','users.role',)
            ->where('research_proposal.id', $id)
            ->first();
        return response()->json($proposal);
    }

    public function colloquiumSchedule($id)
    {
        $proposal = DB::table('research_proposal')
            ->join('users','users.id','research_proposal.user_id')
            ->select('research_proposal.*','users.*')
            ->where('research_proposal.id', $id)
            ->first();

        return response()->json($proposal);
    }

    public function sendingResearchFile(Request $request)
    { 
        $requestor = DB::table('users')
            ->select(DB::raw("CONCAT(fname, ' ', COALESCE(mname, ''), ' ', lname) AS requestor"))
            ->where('id', Auth::id())
            ->value('requestor');
        
        $proposalFile = DB::table('research_proposal')
            ->select('proposal_file')
            ->where('id', $request->researchProposalId)
            ->value('proposal_file');
        
        $proposalTitle = DB::table('research_proposal')
            ->select('title')
            ->where('id', $request->researchProposalId)
            ->value('title');

        $data = [
            'requestor' => $requestor,
            'proposalFile' => $proposalFile,
            'proposalTitle' => $proposalTitle,
        ];
        
        if ($request->do != null) {
            $proposal = ResearchProposal::find($request->researchProposalId);
            $proposal->remarks = 'Your research proposal will be sent to the respective recipient. Please wait for the results once your proposal has been assessed, we will contact you immediately.';
            $proposal->status = 'Proposal Sent to Respective Recipient';
            $proposal->save();

            $doEmail = 'josephandrebalbada@gmail.com';
            Mail::to($doEmail)->send(new ResearchDoApproval($data));
        }

        if ($request->urds != null) {
            $proposal = ResearchProposal::find($request->researchProposalId);
            $proposal->remarks = 'Your research proposal will be sent to the respective recipient. Please wait for the results once your proposal has been assessed, we will contact you immediately.';
            $proposal->status = 'Proposal Sent to Respective Recipient';
            $proposal->save();

            $urdsEmail = 'josephandrebalbada@gmail.com';
            Mail::to($urdsEmail)->send(new ResearchUrdsApproval($data));
        }

        if ($request->vpress != null) {
            $proposal = ResearchProposal::find($request->researchProposalId);
            $proposal->remarks = 'Your research proposal will be sent to the respective recipient. Please wait for the results once your proposal has been assessed, we will contact you immediately.';
            $proposal->status = 'Proposal Sent to Respective Recipient';
            $proposal->save();

            $vpressEmail = 'josephandrebalbada@gmail.com';
            Mail::to($vpressEmail)->send(new ResearchVpressApproval($data));
        }

        if ($request->press != null) {
            $proposal = ResearchProposal::find($request->researchProposalId);
            $proposal->remarks = 'Your research proposal will be sent to the respective recipient. Please wait for the results once your proposal has been assessed, we will contact you immediately.';
            $proposal->status = 'Proposal Sent to Respective Recipient';
            $proposal->save();

            $pressEmail = 'josephandrebalbada@gmail.com';
            Mail::to($pressEmail)->send(new ResearchPressApproval($data));
        }
        
        return redirect()->to('/faculty/research-proposal')->with('success', 'Research Proposal Successfully Sent.');

    }

    //Admin POV
    public function researchProposalList()
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

        $proposal = DB::table('research_proposal')
            ->join('users','users.id','research_proposal.user_id')
            ->select(
                'research_proposal.*',
                'users.id as userId',
                'users.fname','users.mname',
                'users.lname','users.role',
                )
            ->get();

        return View::make('admin.researchProposalList',compact('admin','adminNotifCount','adminNotification','proposal'));
    }

    public function processingResearchProposal($id)
    {
        $proposal = DB::table('research_proposal')
            ->join('users','users.id','research_proposal.user_id')
            ->select('research_proposal.*','users.*')
            ->where('research_proposal.id', $id)
            ->first();

        return response()->json($proposal);
    }

    public function sendingBackResearchProposal(Request $request)
    { 
            $userId = DB::table('research_proposal')->where('id', $request->proposalId)->value('user_id');

            if ($request->status === 'Research Proposal Approved By R&E Office') {

                $proposal = ResearchProposal::find($request->proposalId);
                $proposal->status = $request->status;
                $proposal->remarks = 'We would like to inform you, your research proposal has been approved by the R&E Office. Please proceed to the R&E Office to obtain the wet signature for your proposal.';
                $proposal->save();

                // $colloquium = new ColloquiumSchedule;
                // $colloquium->time = $request->colloquium_time;
                // $colloquium->date = $request->colloquium_date;
                // $colloquium->status = 'Date Set';
                // $colloquium->researchProposal_id = $request->proposalId;
                // $colloquium->save();
                
                $notif = new Notifications;
                $notif->type = 'Faculty Notification';
                $notif->title = 'Faculty Research Proposal Approved';
                $notif->message = 'The R&E Office has approved your research proposal.';
                $notif->date = now();
                $notif->user_id = Auth::id();
                $notif->reciever_id = $userId;
                $notif->save();

            } else {

                $proposal = ResearchProposal::find($request->proposalId);
                $proposal->status = $request->status;
                $proposal->remarks = $request->remarks;
                $proposal->save();
                
                $notif = new Notifications;
                $notif->type = 'Faculty Notification';
                $notif->title = 'Faculty Research Proposal Rejected';
                $notif->message = 'The R&E Office has rejected your research proposal.';
                $notif->date = now();
                $notif->user_id = Auth::id();
                $notif->reciever_id = $userId;
                $notif->save();

            }
            
            return redirect()->to('/admin/research-proposal')->with('success', 'Research Proposal Process Done.');

    }

    //MOBILE START
    public function mobileresearchProposal($id)
    {

        $faculty = DB::table('faculty')
            ->join('users','users.id','faculty.user_id')
            ->select('faculty.*','users.*')
            ->where('user_id', $id)
            ->first();

        $proposal = DB::table('research_proposal')
            ->join('users','users.id','research_proposal.user_id')
            ->select(
                'research_proposal.*',
                'users.id as userId',
                'users.fname','users.mname',
                'users.lname','users.role',
                )
            ->where('research_proposal.user_id', $id)
            ->get();

        $data = [
            'faculty' => $faculty,
            'proposal' => $proposal
        ];

        return response()->json($data);
    }

    public function mobileuploadResearchProposal(Request $request)
    { 
        $proposal = new ResearchProposal;
        $proposal->research_type = $request->research_type;
        $proposal->title = $request->title;
        $proposal->status = 'Pending R&E Office Approval';
        $proposal->remarks = 'Your research proposal will undergo a review process. Please wait for the results once your proposal has been assessed, we will contact you immediately.';
        $proposal->user_id  = $request->user_id;

        $pdfFile = $request->file('researchProposalFile');
        $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
        $pdfFile->move(public_path('uploads/researchProposal'), $pdfFileName);
        $proposal->proposal_file = $pdfFileName;

        $proposal->save();

            $notif = new Notifications;
            $notif->type = 'Admin Notification';
            $notif->title = 'Faculty Research Proposal Submitted';
            $notif->message = 'Someone submitted an research proposal for assesment.';
            $notif->date = now();
            $notif->user_id = $request->user_id;
            $notif->save();

        $response = [
            'success' => true,
            'message' => 'Research Proposal Successfully Sent.'
        ];

        return response()->json($response);
    }

    public function mobilereSubmitProposalFetchingId($id)
    {
        $proposal = DB::table('research_proposal')
            ->join('users','users.id','research_proposal.user_id')
            ->select('research_proposal.id as resid')
            ->where('research_proposal.id', $id)
            ->first();

        return response()->json($proposal);
    }

    public function mobilereUploadResearchProposal(Request $request)
    { 
        $proposal = ResearchProposal::find($request->proposalId);
        $proposal->title = $request->title;
        $proposal->status = 'Pending R&E Office Approval';
        $proposal->remarks = 'Your research proposal will undergo a review process. Please wait for the results once your proposal has been assessed, we will contact you immediately.';

        $pdfFile = $request->file('researchProposalFile');
        $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
        $pdfFile->move(public_path('uploads/researchProposal'), $pdfFileName);
        $proposal->proposal_file = $pdfFileName;

        $proposal->save();

            $notif = new Notifications;
            $notif->type = 'Admin Notification';
            $notif->title = 'Faculty Research Proposal Submitted';
            $notif->message = 'Someone submitted an research proposal for assesment.';
            $notif->date = now();
            $notif->user_id = $request->user_id;
            $notif->save();

        $response = [
            'success' => true,
            'message' => 'Research Proposal Successfully Sent.'
        ];

        return response()->json($response);
    }

    public function mobileresearchProposalStatus($id)
    {
        $proposal = DB::table('research_proposal')
            ->join('users','users.id','research_proposal.user_id')
            ->leftJoin('colloquium_schedule','research_proposal.id','colloquium_schedule.researchProposal_id')
            ->select(
                'research_proposal.*',
                'users.id as userId','users.fname','users.mname','users.lname','users.role',
                'colloquium_schedule.id as colloquiumId','colloquium_schedule.time',
                'colloquium_schedule.date','colloquium_schedule.status as colloquiumStatus')
            ->where('research_proposal.id', $id)
            ->first();

        return response()->json($proposal);
    }

    public function mobilecolloquiumSchedule($id)
    {
        $proposal = DB::table('research_proposal')
            ->join('users','users.id','research_proposal.user_id')
            ->select('research_proposal.*','users.*')
            ->where('research_proposal.id', $id)
            ->first();

        return response()->json($proposal);
    }

    public function RPmobileshowpdf($fileName)
    {
        $filePath = public_path("uploads/researchProposal/{$fileName}");

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
    //MOBILE END
}
