<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Notifications;
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

        $adminNotifCount = DB::table('notifications')
            ->where('type', 'Admin Notification')
            ->count();

        $adminNotification = DB::table('notifications')
            ->where('type', 'Admin Notification')
            ->orderBy('date', 'desc')
            ->take(5)
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

        $studentNotifCount = DB::table('notifications')
            ->where('type', 'Student Notification')
            ->where('reciever_id', Auth::id())
            ->count();

        $studentNotification = DB::table('notifications')
            ->where('type', 'Student Notification')
            ->where('reciever_id', Auth::id())
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

        $role = DB::table('users')->where('id',Auth::id())->value('role');

        if ($role === 'Student') {
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
                'announcements.title', 
                'announcements.content', 
                'announcementsphoto.img_path', 
                DB::raw('TIME(announcements.created_at) as created_time')
            )
            ->where('viewer', 'Students') 
            ->orderBy('announcements.id') 
            ->get()
            ->groupBy('announcement_id');
        } elseif ($role === 'Faculty') {
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
                'announcements.title', 
                'announcements.content', 
                'announcementsphoto.img_path', 
                DB::raw('TIME(announcements.created_at) as created_time')
            )
            ->where('viewer', 'like', '%Faculty%')
            ->orderBy('announcements.id') 
            ->get()
            ->groupBy('announcement_id');
        } elseif ($role === 'Staff') {
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
                'announcements.title', 
                'announcements.content', 
                'announcementsphoto.img_path', 
                DB::raw('TIME(announcements.created_at) as created_time')
            )
            ->where('viewer', 'like', '%Staff%')
            ->orderBy('announcements.id') 
            ->get()
            ->groupBy('announcement_id');
        } else {
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
                'announcements.title', 
                'announcements.content', 
                'announcementsphoto.img_path', 
                DB::raw('TIME(announcements.created_at) as created_time')
            )
            ->orderBy('announcements.id') 
            ->get()
            ->groupBy('announcement_id');
        }
        
        if(request()->ajax())
        {
         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
         $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end']);
         return Response::json($data);
        }

        return View::make('layouts.home',compact('admin','student','staff','faculty','announcements','adminNotifCount','adminNotification','facultyNotifCount','facultyNotification','studentNotifCount','studentNotification','staffNotifCount','staffNotification'));
    }

    public function navigation()
    {
        $admin = DB::table('staff')
            ->join('users','users.id','staff.user_id')
            ->select('staff.*','users.*')
            ->where('user_id',Auth::id())
            ->first();

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
        
        return View::make('layouts.navigation',compact('admin','student','staff','faculty'));
    }

    public function adminNotifications()
    {
        $admin = DB::table('staff')
            ->join('users','users.id','staff.user_id')
            ->select('staff.*','users.*')
            ->where('user_id',Auth::id())
            ->first();
        
        $notification = DB::table('notifications')
            ->join('users', 'users.id', 'notifications.user_id')
            ->where('type', 'Admin Notification')
            ->orderBy('notifications.created_at', 'desc')
            ->get();

        $twoDaysAgo = Carbon::now()->subDays(2);
            
        $adminNotifCount = DB::table('notifications')
            ->where('type', 'Admin Notification')
            ->where('status', 'not read')
            ->count();

        $adminNotification = DB::table('notifications')
            ->where('type', 'Admin Notification')
            ->where('status', 'not read')
            ->orderBy('date', 'desc')
            ->get();

        return View::make('notifications.admin',compact('admin','notification','adminNotifCount','adminNotification'));
    }

    public function facultyNotifications()
    {
        $faculty = DB::table('faculty')
            ->join('users','users.id','faculty.user_id')
            ->select('faculty.*','users.*')
            ->where('user_id',Auth::id())
            ->first();
        
        $notification = DB::table('notifications')
            ->join('users', 'users.id', 'notifications.user_id')
            ->where('type', 'Faculty Notification')
            ->where('reciever_id', Auth::id())
            ->orderBy('notifications.created_at', 'desc')
            ->get();
            
        $facultyNotifCount = DB::table('notifications')
            ->where('type', 'Faculty Notification')
            ->where('reciever_id', Auth::id())
            ->where('status', '=', 'Unread')
            ->count();

        $facultyNotification = DB::table('notifications')
            ->where('type', 'Faculty Notification')
            ->where('status', '=', 'Unread')
            ->where('reciever_id', Auth::id())
            ->orderBy('date', 'desc')
            ->get();

        return View::make('notifications.faculty',compact('faculty','notification','facultyNotifCount','facultyNotification'));
    }

    public function studentNotifications()
    {
        $student = DB::table('students')
            ->join('users','users.id','students.user_id')
            ->select('students.*','users.*')
            ->where('user_id',Auth::id())
            ->first();
        
        $notification = DB::table('notifications')
            ->join('users', 'users.id', 'notifications.user_id')
            ->where('type', 'Student Notification')
            ->where('reciever_id', Auth::id())
            ->orderBy('notifications.created_at', 'desc')
            ->get();
            
        $studentNotifCount = DB::table('notifications')
            ->where('type', 'Student Notification')
            ->where('reciever_id', Auth::id())
            ->count();

        $studentNotification = DB::table('notifications')
            ->where('type', 'Student Notification')
            ->where('reciever_id', Auth::id())
            ->orderBy('date', 'desc')
            ->take(4)
            ->get();

        return View::make('notifications.student',compact('student','notification','studentNotifCount','studentNotification'));
    }

    public function staffNotifications()
    {
        $staff = DB::table('staff')
            ->join('users','users.id','staff.user_id')
            ->select('staff.*','users.*')
            ->where('user_id',Auth::id())
            ->first();
        
        $notification = DB::table('notifications')
            ->join('users', 'users.id', 'notifications.user_id')
            ->where('type', 'Staff Notification')
            ->where('reciever_id', Auth::id())
            ->orderBy('notifications.created_at', 'desc')
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

        return View::make('notifications.staff',compact('staff','notification','staffNotifCount','staffNotification'));
    }

    public function markAsRead(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = DB::table('users')->where('id', Auth::id())->first();

        if ($user->role === 'Admin') {
            Notifications::where('type', 'Admin Notification')->where('status', 'not read')->update(['status' => 'read']);
        } elseif ($user->role === 'Faculty') {
            Notifications::where('type', 'Faculty')->where('status', 'not read')->update(['status' => 'read']);
        } elseif ($user->role === 'Faculty') {
            Notifications::where('type', 'Research Coordinator')->where('status', 'not read')->update(['status' => 'read']);
        } elseif ($user->role === 'Research Coordinator') {
            Notifications::where('type', 'Student')->where('status', 'not read')->update(['status' => 'read']);
        } 

        return response()->json(['message' => 'Notifications marked as read successfully']);
    }

    //mobile
    public function mobilehomepage($id)
    {
        $student = DB::table('students')
            ->join('users','users.id','students.user_id')
            ->select('students.*','users.*')
            ->where('user_id', $id)
            ->first();

        $staff = DB::table('staff')
            ->join('users','users.id','staff.user_id')
            ->select('staff.*','users.*')
            ->where('user_id', $id)
            ->first();

        $faculty = DB::table('faculty')
            ->join('users','users.id','faculty.user_id')
            ->select('faculty.*','users.*')
            ->where('user_id', $id)
            ->first();

        $admin = DB::table('staff')
            ->join('users','users.id','staff.user_id')
            ->select('staff.*','users.*')
            ->where('user_id', $id)
            ->first();

        $role = DB::table('users')->where('id', $id)->value('role');

        if ($role === 'Student') {
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
                    'announcements.title', 
                    'announcements.content', 
                    'announcementsphoto.img_path', 
                    DB::raw('TIME(announcements.created_at) as created_time')
                )
                ->where('viewer', 'Students') 
                ->orderBy('announcements.id') 
                ->get()
                ->groupBy('announcement_id');
        } elseif ($role === 'Faculty') {
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
                    'announcements.title', 
                    'announcements.content', 
                    'announcementsphoto.img_path', 
                    DB::raw('TIME(announcements.created_at) as created_time')
                )
                ->where('viewer', 'like', '%Faculty%')
                ->orderBy('announcements.id') 
                ->get()
                ->groupBy('announcement_id');
        } elseif ($role === 'Staff') {
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
                    'announcements.title', 
                    'announcements.content', 
                    'announcementsphoto.img_path', 
                    DB::raw('TIME(announcements.created_at) as created_time')
                )
                ->where('viewer', 'like', '%Staff%')
                ->orderBy('announcements.id') 
                ->get()
                ->groupBy('announcement_id');
        } else {
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
                    'announcements.title', 
                    'announcements.content', 
                    'announcementsphoto.img_path', 
                    DB::raw('TIME(announcements.created_at) as created_time')
                )
                ->orderBy('announcements.id') 
                ->get()
                ->groupBy('announcement_id');
        }

        if(request()->ajax())
        {
            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
            $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end']);
            return response()->json($data);
        }

        $responseData = [
            'admin' => $admin,
            'student' => $student,
            'staff' => $staff,
            'faculty' => $faculty,
            'announcements' => $announcements,
        ];

        return response()->json($responseData);
    }

}
