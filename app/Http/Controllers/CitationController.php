<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Mail;
use App\Mail\CitationMonetize;
use App\Models\Citation;
use App\Models\Event;
use App\Models\Staff;
use Redirect,Response,DB,Auth,View;

class CitationController extends Controller
{
    public function facultyCitationCount()
    {
        $faculty = DB::table('faculty')
        ->join('users','users.id','faculty.user_id')
        ->select('faculty.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $facultyCitation = DB::table('citations')
        ->join('users','users.id','citations.user_id')
        ->join('faculty','users.id','faculty.user_id')
        ->select('faculty.*','users.*','citations.*')
        ->where('citations.user_id',Auth::id())
        ->get();

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
        
        return View::make('faculty.citations',compact('faculty','facultyCitation','facultyNotifCount','facultyNotification'));
    }

    public function facultyAddCitation(Request $request)
    { 
            $citation = new Citation;
            $citation->researchTitle = $request->researchTitle;
            $citation->conferenceForum = $request->conferenceForum;
            $citation->date = $request->date;
            $citation->venue = $request->venue;
            $citation->country =  $request->country;
            $citation->presentation = $request->presentation;
            $citation->publication =  $request->publication;
            $citation->presentor1 = $request->presentor1;
            $citation->presentor2 = $request->presentor2;
            $citation->presentor3 = $request->presentor3;
            $citation->presentor4 = $request->presentor4;
            $citation->presentor5 = $request->presentor5;
            $citation->author1 = $request->author1;
            $citation->author2 = $request->author2;
            $citation->author3 = $request->author3;
            $citation->author4 = $request->author4;
            $citation->author5 = $request->author5;
            $citation->document = $request->document;
            $citation->user_id = Auth::id();
            $citation->save();

            $faculty = DB::table('faculty')
            ->join('users','users.id','faculty.user_id')
            ->select('faculty.*','users.*')
            ->where('user_id',Auth::id())
            ->first();

            $facultyCitation = DB::table('citations')
            ->join('users','users.id','citations.user_id')
            ->join('faculty','users.id','faculty.user_id')
            ->select('faculty.*','users.*','citations.*')
            ->where('citations.user_id',Auth::id())
            ->get();

            $facultyCitationCount = $facultyCitation->count();

            if ($facultyCitationCount >= 5) {
                $data = [
                    'citationCount' => $facultyCitationCount,
                    'facultyName' => $faculty->fname .' '. $faculty->mname .' '. $faculty->lname,
                ];
            
                Mail::to($faculty->email)->send(new CitationMonetize($data));
            }

            return redirect()->to('/faculty/citation')->with('success', 'Citation Added');

    }

    public function facultyShowCitationInfo($id)
    {
        $citation = DB::table('citations')
        ->join('users','users.id','citations.user_id')
        ->join('faculty','users.id','faculty.user_id')
        ->select('faculty.*','users.*','citations.*')
        ->where('citations.id', $id)
        ->first();

        return response()->json($citation);
    }

    public function facultyEditCitationInfo($id)
    {
        $citation = DB::table('citations')
        ->join('users','users.id','citations.user_id')
        ->join('faculty','users.id','faculty.user_id')
        ->select('faculty.*','users.*','citations.*')
        ->where('citations.id', $id)
        ->first();

        return response()->json($citation);
    }

    public function facultyUpdateCitation(Request $request, $id)
    { 
            $citation = Citation::find($id);
            $citation->researchTitle = $request->citation_researchTitle;
            $citation->conferenceForum = $request->citation_conferenceForum;
            $citation->date = $request->citation_date;
            $citation->venue = $request->citation_venue;
            $citation->country =  $request->citation_country;
            $citation->presentation = $request->citation_presentation;
            $citation->publication =  $request->citation_publication;
            $citation->presentor1 = $request->citation_presentor1;
            $citation->presentor2 = $request->citation_presentor2;
            $citation->presentor3 = $request->citation_presentor3;
            $citation->presentor4 = $request->citation_presentor4;
            $citation->presentor5 = $request->citation_presentor5;
            $citation->author1 = $request->citation_author1;
            $citation->author2 = $request->citation_author2;
            $citation->author3 = $request->citation_author3;
            $citation->author4 = $request->citation_author4;
            $citation->author5 = $request->citation_author5;
            $citation->document = $request->citation_document;
            $citation->user_id = Auth::id();
            $citation->save();

            return response()->json(["citation" => $citation]);

    }

    public function facultyDeleteCitation(string $id)
    {
        $citation = Citation::findOrFail($id);
        $citation->delete();
        $data = array('success' =>'deleted','code'=>'200');
        return response()->json($data);
    }

    public function staffCitationCount()
    {
        $staff = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $staffCitation = DB::table('citations')
        ->join('users','users.id','citations.user_id')
        ->join('staff','users.id','staff.user_id')
        ->select('staff.*','users.*','citations.*')
        ->where('citations.user_id',Auth::id())
        ->get();

        $staffNotifCount = DB::table('notifications')
            ->where('type', 'Staff Notification')
            ->where('reciever_id', Auth::id())
            ->count();

        $staffNotification = DB::table('notifications')
            ->where('type', 'Staff Notification')
            ->where('reciever_id', Auth::id())
            ->orderBy('date', 'desc')
            ->take(4)
            ->get();
        
        return View::make('staff.citations',compact('staff','staffCitation','staffNotifCount','staffNotification'));
    }

    public function staffAddCitation(Request $request)
    { 
            $citation = new Citation;
            $citation->researchTitle = $request->researchTitle;
            $citation->conferenceForum = $request->conferenceForum;
            $citation->date = $request->date;
            $citation->venue = $request->venue;
            $citation->country =  $request->country;
            $citation->presentation = $request->presentation;
            $citation->publication =  $request->publication;
            $citation->presentor1 = $request->presentor1;
            $citation->presentor2 = $request->presentor2;
            $citation->presentor3 = $request->presentor3;
            $citation->presentor4 = $request->presentor4;
            $citation->presentor5 = $request->presentor5;
            $citation->author1 = $request->author1;
            $citation->author2 = $request->author2;
            $citation->author3 = $request->author3;
            $citation->author4 = $request->author4;
            $citation->author5 = $request->author5;
            $citation->document = $request->document;
            $citation->user_id = Auth::id();
            $citation->save();

            $staff = DB::table('staff')
            ->join('users','users.id','staff.user_id')
            ->select('staff.*','users.*')
            ->where('user_id',Auth::id())
            ->first();

            $staffCitation = DB::table('citations')
            ->join('users','users.id','citations.user_id')
            ->join('staff','users.id','staff.user_id')
            ->select('staff.*','users.*','citations.*')
            ->where('citations.user_id',Auth::id())
            ->get();

            $staffCitationCount = $staffCitation->count();

            if ($staffCitationCount >= 5) {
                $data = [
                    'citationCount' => $staffCitationCount,
                    'staffName' => $staff->fname .' '. $staff->mname .' '. $staff->lname,
                ];
            
                Mail::to($staff->email)->send(new CitationMonetize($data));
            }

            return redirect()->to('/staff/citation')->with('success', 'Citation Added');

    }

    public function staffShowCitationInfo($id)
    {
        $citation = DB::table('citations')
        ->join('users','users.id','citations.user_id')
        ->join('staff','users.id','staff.user_id')
        ->select('staff.*','users.*','citations.*')
        ->where('citations.id', $id)
        ->first();

        return response()->json($citation);
    }

    public function staffEditCitationInfo($id)
    {
        $citation = DB::table('citations')
        ->join('users','users.id','citations.user_id')
        ->join('staff','users.id','staff.user_id')
        ->select('staff.*','users.*','citations.*')
        ->where('citations.id', $id)
        ->first();

        return response()->json($citation);
    }

    public function staffUpdateCitation(Request $request, $id)
    { 
            $citation = Citation::find($id);
            $citation->researchTitle = $request->citation_researchTitle;
            $citation->conferenceForum = $request->citation_conferenceForum;
            $citation->date = $request->citation_date;
            $citation->venue = $request->citation_venue;
            $citation->country =  $request->citation_country;
            $citation->presentation = $request->citation_presentation;
            $citation->publication =  $request->citation_publication;
            $citation->presentor1 = $request->citation_presentor1;
            $citation->presentor2 = $request->citation_presentor2;
            $citation->presentor3 = $request->citation_presentor3;
            $citation->presentor4 = $request->citation_presentor4;
            $citation->presentor5 = $request->citation_presentor5;
            $citation->author1 = $request->citation_author1;
            $citation->author2 = $request->citation_author2;
            $citation->author3 = $request->citation_author3;
            $citation->author4 = $request->citation_author4;
            $citation->author5 = $request->citation_author5;
            $citation->document = $request->citation_document;
            $citation->user_id = Auth::id();
            $citation->save();

            return response()->json(["citation" => $citation]);

    }

    public function staffDeleteCitation(string $id)
    {
        $citation = Citation::findOrFail($id);
        $citation->delete();
        $data = array('success' =>'deleted','code'=>'200');
        return response()->json($data);
    }
}
