<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\ResearchProposal; 
use App\Models\Notifications;
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
            $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
            $pdfFile->move(public_path('uploads/researchProposal'), $pdfFileName);
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
            $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
            $pdfFile->move(public_path('uploads/researchProposal'), $pdfFileName);
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

    public function colloquiumSchedule($id)
    {
        $proposal = DB::table('research_proposal')
            ->join('users','users.id','research_proposal.user_id')
            ->select('research_proposal.*','users.*')
            ->where('research_proposal.id', $id)
            ->first();

        return response()->json($proposal);
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
            ->count();

        $adminNotification = DB::table('notifications')
            ->where('type', 'Admin Notification')
            ->orderBy('date', 'desc')
            ->take(5)
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

                $colloquium = new ColloquiumSchedule;
                $colloquium->time = $request->colloquium_time;
                $colloquium->date = $request->colloquium_date;
                $colloquium->status = 'Date Set';
                $colloquium->researchProposal_id = $request->proposalId;
                $colloquium->save();
                
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
                $proposal->remarks = 'We would like to inform you, that your research proposal has not been approved by the R&E Office. You are welcome to revise and resubmit your proposal for further consideration.';
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
            ->join('users', 'users.id', 'faculty.user_id')
            ->select('faculty.*', 'users.*')
            ->where('user_id', $id)
            ->first();

        $proposal = DB::table('research_proposal')
            ->join('users', 'users.id', 'research_proposal.user_id')
            ->select('research_proposal.*', 'users.*')
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
        $proposal->remarks = 'Your research proposal will undergo a review process. Please wait for the results once your proposal has been assessed.';
        $proposal->user_id  = $request->user_id;

        $pdfFile = $request->file('researchProposalFile');
        $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
        $pdfFile->move(public_path('uploads/researchProposal'), $pdfFileName);
        $proposal->proposal_file = $pdfFileName;

        $proposal->save();

        $response = [
            'success' => true,
            'message' => 'Research Proposal Successfully Sent.'
        ];

        return response()->json($response);
    }
    //MOBILE END
}
