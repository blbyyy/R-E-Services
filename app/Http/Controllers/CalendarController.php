<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Event;
use App\Models\Staff;
use Redirect,Response,DB,Auth,View;

class CalendarController extends Controller
{
    public function index()
    {
        $staff = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $admin = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        if(request()->ajax())
        {
         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
         $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end']);
         return Response::json($data);
        }
        return View::make('calendar.index',compact('admin','staff'));
    }

    public function create_event(Request $request)
    { 
        $event = new Event;
        $event->title = $request->title;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->save();

        Alert::success('Success', 'Event was successfully created!');

        return redirect()->to('/events')->with('success', 'Event was successfully created!');
    }

    public function create(Request $request)
    { 
        $insertArr = [ 'title' => $request->title,
                       'start' => $request->start,
                       'end' => $request->end
                    ];
        $event = Event::insert($insertArr);  
        return Response::json($event);
    }

    public function update(Request $request)
    {  
        $where = array('id' => $request->id);
        $updateArr = ['title' => $request->title,'start' => $request->start, 'end' => $request->end];
        $event  = Event::where($where)->update($updateArr);
        return Response::json($event);
    }
 
    public function destroy(Request $request)
    {
        $event = Event::findOrFail($request->id);
        $event->delete();
        $data = array('success' =>'deleted','code'=>'200');
        return response()->json($data);
    }

    //MOBILE START
    public function mobileindex()
    {
        $staff = DB::table('staff')
            ->join('users', 'users.id', 'staff.user_id')
            ->select('staff.*', 'users.*')
            ->where('user_id', Auth::id())
            ->first();

        $admin = DB::table('staff')
            ->join('users', 'users.id', 'staff.user_id')
            ->select('staff.*', 'users.*')
            ->where('user_id', Auth::id())
            ->first();

        if (request()->ajax()) {
            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
            $data = Event::whereDate('start', '>=', $start)->whereDate('end', '<=', $end)->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
        }

        return response()->json(['error' => 'Invalid request']);
    }

    public function mobilecreate_event(Request $request)
    { 
        $event = new Event;
        $event->title = $request->title;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->save();

        return response()->json(['success' => true, 'message' => 'Event was successfully created!']);
    }

    public function mobileupdate(Request $request)
    {  
        $where = array('id' => $request->id);
        $updateArr = ['title' => $request->title, 'start' => $request->start, 'end' => $request->end];
        $event = Event::where($where)->update($updateArr);
        
        return response()->json(['success' => true, 'message' => 'Event updated successfully']);
    }

    public function mobiledestroy(Request $request)
    {
        $event = Event::findOrFail($request->id);
        $event->delete();
        $data = ['success' => true, 'message' => 'Event deleted successfully'];
        return response()->json($data);
    }
    //MOBILE END
        
}
