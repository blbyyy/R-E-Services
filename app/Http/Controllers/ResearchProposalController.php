<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\ResearchProposal;
use View, DB, File, Auth;

class ResearchProposalController extends Controller
{
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
            ->select('research_proposal.*','users.*')
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
            $proposal->remarks = 'Your research proposal will undergo a review process. Please wait for the results once your proposal has been assessed.';
            $proposal->user_id  = Auth::id();

            $pdfFile = $request->file('researchProposalFile');
            $pdfFileName = time() . '_' . $pdfFile->getClientOriginalName();
            $pdfFile->move(public_path('uploads/researchProposal'), $pdfFileName);
            $proposal->proposal_file = $pdfFileName;

            $proposal->save();

            return redirect()->to('/faculty/research-proposal')->with('success', 'Research Proposal Successfully Sent.');

    }
}
