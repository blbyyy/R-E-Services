<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Algolia\AlgoliaSearch\SearchClient;
use App\Models\Student;
use App\Models\Staff;
use App\Models\Faculty;
use App\Models\User;
use App\Models\Research;
use App\Http\Redirect;
use View;
use DB;
use File;
use Auth;

class ResearchController extends Controller
{
    public function researchlist()
    {
        $admin = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $researchlist = Research::orderBy('id')->get();
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

    
}
