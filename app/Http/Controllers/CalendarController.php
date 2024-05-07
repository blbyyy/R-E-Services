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

        $adminNotifCount = DB::table('notifications')
            ->where('type', 'Admin Notification')
            ->where('status', 'not read')
            ->count();

        $adminNotification = DB::table('notifications')
            ->where('type', 'Admin Notification')
            ->orderBy('date', 'desc')
            ->take(4)
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

        if(request()->ajax())
        {
         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
         $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end']);
         return Response::json($data);
        }
        return View::make('calendar.index',compact('admin','staff','adminNotifCount','adminNotification','staffNotifCount','staffNotification'));
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

        return response()->json(['admin' => $admin, 'staff' => $staff]);
    }

    public function mobilecreate_event(Request $request)
{
    $event = new Event;

    // Validate input
    if (!$request->has('title') || empty($request->title)) {
        return response()->json(['error' => 'Event title is required.'], 400);
    }

    // Set values and save
    $event->title = $request->title;
    $event->start = $request->start;
    $event->end = $request->end;
    $event->save();

    Alert::success('Success', 'Event was successfully created!');

    return response()->json(['message' => 'Event was successfully created!']);
}


    public function mobilecreate(Request $request)
    {
        $insertArr = [
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end
        ];

        $event = Event::create($insertArr);
        return response()->json($event);
    }

    public function mobileupdate(Request $request)
    {
        $where = ['id' => $request->id];
        $updateArr = [
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end
        ];

        $event = Event::where($where)->update($updateArr);
        return response()->json($event);
    }

    public function mobiledestroy(Request $request)
    {
        $event = Event::findOrFail($request->id);
        $event->delete();

        return response()->json(['success' => 'deleted', 'code' => '200']);
    }
    //MOBILE END
        
}
