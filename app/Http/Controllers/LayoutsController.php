<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Imagick, TCPDF, FPDF, View, DB, File, Auth;


class LayoutsController extends Controller
{
    public function homepage()
    {
        $student = DB::table('students')
        ->join('users','users.id','students.user_id')
        ->select('students.*','users.*')
        ->where('user_id',Auth::id())
        ->first();
    
        $staff = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $faculty = DB::table('faculty')
        ->join('users','users.id','faculty.user_id')
        ->select('faculty.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $admin = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        $announcements = DB::table('announcements')
        ->join('announcementsphoto', 'announcementsphoto.announcements_id', 'announcements.id')
        ->join('users', 'announcements.user_id', 'users.id')
        ->select(
            'users.fname',
            'users.lname',
            'users.mname',
            'users.role',
            'announcementsphoto.id as photo_id', 
            'announcements.id as announcement_id', 
            'announcements.title', 'announcements.content', 
            'announcementsphoto.img_path', 
            DB::raw('TIME(announcements.created_at) as created_time')
                )
        ->orderBy('announcements.id') 
        ->get()
        ->groupBy('announcement_id');

        if(request()->ajax())
        {
         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
         $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end']);
         return Response::json($data);
        }

        return View::make('layouts.home',compact('admin','student','staff','faculty','announcements'));
    }
}
