<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Notifications;
use Illuminate\Http\Request;
use App\Models\Appointments;
use App\Models\Extension;
use View, DB, File, Auth;

class AppointmentController extends Controller
{
    public function appointments()
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

        $appointments = DB::table('appointments')
        ->join('users','users.id','appointments.user_id')
        ->select(
            'appointments.*',
            'users.id as userID',
            'users.role',
            DB::raw("CONCAT(users.fname, ' ', COALESCE(users.mname, ''), ' ', users.lname) AS requestor_name")
        )
        ->orderBy('appointments.created_at', 'desc')
        ->get();

        return View::make('appointments.appointments',compact('admin','adminNotifCount','adminNotification','appointments'));
    }

    public function proposalAppointmentId($id)
    {
        $appointments = DB::table('appointments')
        ->join('users', 'users.id', '=', 'appointments.user_id')
        ->join('extension', 'extension.appointment1_id', '=', 'appointments.id')
        ->select(
            'extension.*',
            'appointments.id as appointmentId',
            'appointments.time',
            'appointments.purpose',
            'appointments.date',
            'users.id as userID',
            'users.role',
            DB::raw("CONCAT(users.fname, ' ', COALESCE(users.mname, ''), ' ', users.lname) AS requestor_name")
        )
        ->where('appointments.id', $id)
        ->first();

        return response()->json($appointments);
    }

    public function preSurveyAppointmentId($id)
    {
        $appointments = DB::table('appointments')
        ->join('users', 'users.id', '=', 'appointments.user_id')
        ->join('extension', 'extension.appointment2_id', '=', 'appointments.id')
        ->select(
            'extension.*',
            'appointments.id as appointmentId',
            'appointments.time',
            'appointments.purpose',
            'appointments.date',
            'users.id as userID',
            'users.role',
            DB::raw("CONCAT(users.fname, ' ', COALESCE(users.mname, ''), ' ', users.lname) AS requestor_name")
        )
        ->where('appointments.id', $id)
        ->first();

        return response()->json($appointments);
    }

    public function midSurveyAppointmentId($id)
    {
        $appointments = DB::table('appointments')
        ->join('users', 'users.id', '=', 'appointments.user_id')
        ->join('extension', 'extension.appointment3_id', '=', 'appointments.id')
        ->select(
            'extension.*',
            'appointments.id as appointmentId',
            'appointments.time',
            'appointments.purpose',
            'appointments.date',
            'users.id as userID',
            'users.role',
            DB::raw("CONCAT(users.fname, ' ', COALESCE(users.mname, ''), ' ', users.lname) AS requestor_name")
        )
        ->where('appointments.id', $id)
        ->first();

        return response()->json($appointments);
    }

    public function sendingAppointmentProposal(Request $request)
    { 
        $purpose = Appointments::where('id', $request->appointmentId1)
        ->orderBy('created_at', 'desc')
        ->value('status');

        $userID = Appointments::where('id', $request->appointmentId1)
        ->orderBy('created_at', 'desc')
        ->value('user_id');

        if ($request->status === 'Appointment Set') {

            $appointment = Appointments::find($request->appointmentId1);
            $appointment->status = $request->status;
            $appointment->save();

            $extension = Extension::find($request->extensionId1);
            $extension->status = 'Appointment Set for Proposal Consultation';
            $extension->percentage_status = 5;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Appointment Set for Proposal Consultation';
            $notif->message = 'Your appointment was set to your chosen date.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $userID;
            $notif->save();

            return redirect()->to('/appointments')->with('success', 'Appointment Successfully Set.');

        } elseif ($request->status === 'Appointment Done') {

            $appointment = Appointments::find($request->appointmentId1);
            $appointment->status = $request->status;
            $appointment->message = $request->message;
            $appointment->save();

            $extension = Extension::find($request->extensionId1);
            $extension->status = 'Appointment Done for Proposal Consultation';
            $extension->percentage_status = 8;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Appointment Done for Proposal Consultation';
            $notif->message = 'Your appointment was done.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $userID;
            $notif->save();

            return redirect()->to('/appointments')->with('success', 'Appointment Done.');
            
        } elseif ($request->status === 'Appointment Cancelled') {

            $appointment = Appointments::find($request->appointmentId1);
            $appointment->status = $request->status;
            $appointment->message = $request->message;
            $appointment->save();

            $extension = Extension::find($request->extensionId1);
            $extension->status = 'Proposal Consultation Appointment Cancelled';
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Appointment Cancelled for Proposal Consultation';
            $notif->message = 'Your appointment was cancelled.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $userID;
            $notif->save();

            return redirect()->to('/appointments')->with('error', 'Appointment Cancelled.');
            
        }
    }

    public function sendingAppointmentPreSurvey(Request $request)
    { 
        $purpose = Appointments::where('id', $request->appointmentId2)
        ->orderBy('created_at', 'desc')
        ->value('status');

        $userID = Appointments::where('id', $request->appointmentId2)
        ->orderBy('created_at', 'desc')
        ->value('user_id');

        if ($request->status === 'Appointment Set') {

            $appointment = Appointments::find($request->appointmentId2);
            $appointment->status = $request->status;
            $appointment->save();

            $extension = Extension::find($request->extensionId2);
            $extension->status = 'Appointment Set for Pre-Survey Consultation';
            $extension->percentage_status = 68;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Appointment Set for Pre-Survey Consultation';
            $notif->message = 'Your appointment was set to your chosen date.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $userID;
            $notif->save();

            return redirect()->to('/appointments')->with('success', 'Appointment Successfully Set.');

        } elseif ($request->status === 'Appointment Done') {

            $appointment = Appointments::find($request->appointmentId2);
            $appointment->status = $request->status;
            $appointment->message = $request->message;
            $appointment->save();

            $extension = Extension::find($request->extensionId2);
            $extension->status = 'Appointment Done for Pre-Survey Consultation';
            $extension->percentage_status = 70;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Appointment Done for Pre-Survey Consultation';
            $notif->message = 'Your appointment was done.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $userID;
            $notif->save();

            return redirect()->to('/appointments')->with('success', 'Appointment Done.');
            
        } elseif ($request->status === 'Appointment Cancelled') {

            $appointment = Appointments::find($request->appointmentId2);
            $appointment->status = $request->status;
            $appointment->message = $request->message;
            $appointment->save();

            $extension = Extension::find($request->extensionId2);
            $extension->status = 'Appointment Cancelled for Pre-Survey Consultation';
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Appointment Cancelled for Pre-Survey Consultation';
            $notif->message = 'Your appointment was cancelled.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $userID;
            $notif->save();

            return redirect()->to('/appointments')->with('error', 'Appointment Cancelled.');
            
        }
    }

    public function sendingAppointmentMidSurvey(Request $request)
    { 
        $purpose = Appointments::where('id', $request->appointmentId3)
        ->orderBy('created_at', 'desc')
        ->value('status');

        $userID = Appointments::where('id', $request->appointmentId3)
        ->orderBy('created_at', 'desc')
        ->value('user_id');

        if ($request->status === 'Appointment Set') {

            $appointment = Appointments::find($request->appointmentId3);
            $appointment->status = $request->status;
            $appointment->save();

            $extension = Extension::find($request->extensionId3);
            $extension->status = 'Appointment Set for Mid-Survey Consultation';
            $extension->percentage_status = 72;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Appointment Set for Mid-Survey Consultation';
            $notif->message = 'Your appointment was done.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $userID;
            $notif->save();

            return redirect()->to('/appointments')->with('success', 'Appointment Successfully Set.');

        } elseif ($request->status === 'Appointment Done'){

            $appointment = Appointments::find($request->appointmentId3);
            $appointment->status = $request->status;
            $appointment->message = $request->message;
            $appointment->save();

            $extension = Extension::find($request->extensionId3);
            $extension->status = 'Appointment Done for Mid-Survey Consultation';
            $extension->percentage_status = 74;
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Appointment Done for Mid-Survey Consultation';
            $notif->message = 'Your appointment was done.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $userID;
            $notif->save();

            return redirect()->to('/appointments')->with('success', 'Appointment Done.');
            
        } elseif ($request->status === 'Appointment Cancelled'){

            $appointment = Appointments::find($request->appointmentId3);
            $appointment->status = $request->status;
            $appointment->message = $request->message;
            $appointment->save();

            $extension = Extension::find($request->extensionId3);
            $extension->status = 'Appointment Cancelled for Mid-Survey Consultation';
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Faculty Notification';
            $notif->title = 'Appointment Cancelled for Mid-Survey Consultation';
            $notif->message = 'Your appointment was cancelled.';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = $userID;
            $notif->save();

            return redirect()->to('/appointments')->with('error', 'Appointment Cancelled.');
            
        }
    }

    public function appointment1()
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

        return View::make('appointments.appointment1',compact('faculty','facultyNotifCount','facultyNotification'));
    }

    public function checkingDate(Request $request)
    {
        $date = $request->input('date');
        $time = $request->input('time');

        $existingAppointment = Appointments::where('date', $date)
        ->where('time', $time)
        ->whereIn('status', ['Appointment Set', 'Appointment Pending'])
        ->exists();

        return response()->json(['exists' => $existingAppointment]);
    }

    public function checkingAppointments(Request $request)
    {
        $purpose = $request->purpose;
        $userID = $request->userId;
        
        if ($purpose === 'Proposal Consultation') {
            $proposalProposal = Appointments::where('user_id', $userID)
                ->where('purpose', $purpose)
                ->whereIn('status', ['Appointment Done', 'Appointment Pending'])
                ->exists();

            $condition = Appointments::where('user_id', $userID)
                ->where('purpose', $purpose) 
                ->orderBy('created_at', 'desc')
                ->value('status');

            if ($condition === 'Appointment Done') {
                $message = 'You are done to this type of appointment please proceed to the next step';
                $title = 'Appointment Done';
            } elseif ($condition === 'Appointment Pending') {
                $message = 'You have currently pending appointment';
                $title = 'Appointment Pending';
            } 
            
            if (!$proposalProposal) {
                return response()->json(['exists' => false, ]);
            } else {
                return response()->json(['exists' => true, 'message' => $message, 'title' => $title]);
            }
        } 

        if ($purpose === 'Pre-Survey Consultation') {
            $preSurveyAppointmentExists = Appointments::where('user_id', $userID)
                ->where('purpose', $purpose)
                ->orderBy('created_at', 'desc')
                ->exists();
        
            if (!$preSurveyAppointmentExists) {
                $message = 'There is no previous Pre-Survey Consultation appointment.';
                $title = 'Appointment Requirement';
                return response()->json(['exists' => false, 'message' => $message, 'title' => $title]);
            } else {
                $status = Appointments::where('user_id', $userID)
                    ->where('purpose', $purpose)
                    ->orderBy('created_at', 'desc')
                    ->value('status');
        
                if ($status === 'Appointment Done') {
                    $message = 'You have completed the Pre-Survey Consultation appointment. Please proceed to the next step.';
                    $title = 'Appointment Done';
                } elseif ($status === 'Appointment Pending') {
                    $message = 'You have a pending Pre-Survey Consultation appointment.';
                    $title = 'Appointment Pending';
                }
        
                return response()->json(['exists' => true, 'message' => $message, 'title' => $title]);
            }
        }
        
        if ($purpose === 'Mid-Survey Consultation') {
            $preSurveyAppointmentExists = Appointments::where('user_id', $userID)
                ->where('purpose', $purpose)
                ->orderBy('created_at', 'desc')
                ->exists();
        
            if (!$preSurveyAppointmentExists) {
                $message = 'There is no previous Mid-Survey Consultation appointment.';
                $title = 'Appointment Requirement';
                return response()->json(['exists' => false, 'message' => $message, 'title' => $title]);
            } else {
                $status = Appointments::where('user_id', $userID)
                    ->where('purpose', $purpose)
                    ->orderBy('created_at', 'desc')
                    ->value('status');
        
                if ($status === 'Appointment Done') {
                    $message = 'You have completed the Pre-Survey Consultation appointment. Please proceed to the next step.';
                    $title = 'Appointment Done';
                } elseif ($status === 'Appointment Pending') {
                    $message = 'You have a pending Pre-Survey Consultation appointment.';
                    $title = 'Appointment Pending';
                }
        
                return response()->json(['exists' => true, 'message' => $message, 'title' => $title]);
            }
        }
        
    }

    public function facultySchedulingAppointment1(Request $request)
    { 

        if ($request->purpose === 'Proposal Consultation') {

            $extension = DB::table('extension')
            ->where('id', $request->extensionId)
            ->first();

            if ($extension->status === 'New Application') {
                
                $appointments = new Appointments;
                $appointments->date = $request->date;
                $appointments->time = $request->time;
                $appointments->purpose = $request->purpose;
                $appointments->status = 'Appointment Pending';
                $appointments->user_id = Auth::id();
                $appointments->save();
                $lastId = DB::getPdo()->lastInsertId();

                $extension = Extension::find($request->extensionId);
                $extension->appointment1_id = $lastId;
                $extension->status = 'Pending Approval for Proposal Consultation Appointment';
                $extension->percentage_status = 3;
                $extension->save();

            } else {
                
                $appointments = Appointments::find($extension->appointment1_id);
                $appointments->date = $request->date;
                $appointments->time = $request->time;
                $appointments->purpose = $request->purpose;
                $appointments->status = 'Appointment Pending';
                $appointments->user_id = Auth::id();
                $appointments->save();

                $extension = Extension::find($request->extensionId);
                $extension->status = 'Pending Approval for Proposal Consultation Appointment';
                $extension->save();
                
            }
            
            $notif = new Notifications;
            $notif->type = 'Admin Notification';
            $notif->title = 'Requesting Appointment for Proposal Consultation';
            $notif->message = 'Someone requested appointment for proposal consultation';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = 0;
            $notif->save();

            return redirect()->to('/faculty/extension/application')->with('success', 'Your schedule has been sent; kindly wait to be approved.');
        
        } elseif ($request->purpose === 'Pre-Survey Consultation') {

            $extension = DB::table('extension')
            ->where('id', $request->extensionId)
            ->first();

            if ($extension->status === 'Topics and Sub Topics Inputted') {
                
                $appointments = new Appointments;
                $appointments->date = $request->date;
                $appointments->time = $request->time;
                $appointments->purpose = $request->purpose;
                $appointments->status = 'Appointment Pending';
                $appointments->user_id = Auth::id();
                $appointments->save();
                $lastId = DB::getPdo()->lastInsertId();

                $extension = Extension::find($request->extensionId);
                $extension->appointment2_id = $lastId;
                $extension->status = 'Pending Approval for Pre-Survey Consultation Appointment';
                $extension->percentage_status = 67;
                $extension->save();

            } else {
                
                $appointments = Appointments::find($extension->appointment2_id);
                $appointments->date = $request->date;
                $appointments->time = $request->time;
                $appointments->purpose = $request->purpose;
                $appointments->status = 'Appointment Pending';
                $appointments->save();

                $extension = Extension::find($request->extensionId);
                $extension->status = 'Pending Approval for Pre-Survey Consultation Appointment';
                $extension->save();

            }

            $notif = new Notifications;
            $notif->type = 'Admin Notification';
            $notif->title = 'Requesting Appointment for Pre-Survey Consultation';
            $notif->message = 'Someone requested appointment for pre-survey consultation';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = 0;
            $notif->save();
            
            return redirect()->to('/faculty/extension/application')->with('success', 'Your schedule has been sent; kindly wait to be approved.');

        } elseif ($request->purpose === 'Mid-Survey Consultation') {

            $extension = DB::table('extension')
            ->where('id', $request->extensionId)
            ->first();

            if ($extension->status === 'Appointment Done for Pre-Survey Consultation') {
                
                $appointments = new Appointments;
                $appointments->date = $request->date;
                $appointments->time = $request->time;
                $appointments->purpose = $request->purpose;
                $appointments->status = 'Appointment Pending';
                $appointments->user_id = Auth::id();
                $appointments->save();
                $lastId = DB::getPdo()->lastInsertId();

                $extension = Extension::find($request->extensionId);
                $extension->appointment3_id = $lastId;
                $extension->status = 'Pending Approval for Mid-Survey Consultation Appointment';
                $extension->percentage_status = 70;
                $extension->save();

            } else {
                
                $appointments = Appointments::find($extension->appointment3_id);
                $appointments->date = $request->date;
                $appointments->time = $request->time;
                $appointments->purpose = $request->purpose;
                $appointments->status = 'Appointment Pending';
                $appointments->save();

                $extension = Extension::find($request->extensionId);
                $extension->status = 'Pending Approval for Mid-Survey Consultation Appointment';
                $extension->save();

            }

            $notif = new Notifications;
            $notif->type = 'Admin Notification';
            $notif->title = 'Requesting Appointment for Mid-Survey Consultation';
            $notif->message = 'Someone requested appointment for mid-survey consultation';
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = 0;
            $notif->save();

            return redirect()->to('/faculty/extension/application')->with('success', 'Your schedule has been sent; kindly wait to be approved.');

        }
    
    }

<<<<<<< HEAD
    //MOBILE START
    public function mobilecheckingDate(Request $request)
    {
        $date = $request->input('date');
        $time = $request->input('time');

        $existingAppointment = Appointments::where('date', $date)
        ->where('time', $time)
        ->whereIn('status', ['Appointment Set', 'Appointment Pending'])
        ->exists();

        return response()->json(['exists' => $existingAppointment]);
    }

    public function mobilecheckingAppointments(Request $request)
    {
        $purpose = $request->purpose;
        $userID = $request->userId;
        
        if ($purpose === 'Proposal Consultation') {
            $proposalProposal = Appointments::where('user_id', $userID)
                ->where('purpose', $purpose)
                ->whereIn('status', ['Appointment Done', 'Appointment Pending'])
                ->exists();

            $condition = Appointments::where('user_id', $userID)
                ->where('purpose', $purpose) 
                ->orderBy('created_at', 'desc')
                ->value('status');

            if ($condition === 'Appointment Done') {
                $message = 'You are done to this type of appointment please proceed to the next step';
                $title = 'Appointment Done';
            } elseif ($condition === 'Appointment Pending') {
                $message = 'You have currently pending appointment';
                $title = 'Appointment Pending';
            } 
            
            if (!$proposalProposal) {
                return response()->json(['exists' => false, ]);
            } else {
                return response()->json(['exists' => true, 'message' => $message, 'title' => $title]);
            }
        } 

        if ($purpose === 'Pre-Survey Consultation') {
            $preSurveyAppointmentExists = Appointments::where('user_id', $userID)
                ->where('purpose', $purpose)
                ->orderBy('created_at', 'desc')
                ->exists();
        
            if (!$preSurveyAppointmentExists) {
                $message = 'There is no previous Pre-Survey Consultation appointment.';
                $title = 'Appointment Requirement';
                return response()->json(['exists' => false, 'message' => $message, 'title' => $title]);
            } else {
                $status = Appointments::where('user_id', $userID)
                    ->where('purpose', $purpose)
                    ->orderBy('created_at', 'desc')
                    ->value('status');
        
                if ($status === 'Appointment Done') {
                    $message = 'You have completed the Pre-Survey Consultation appointment. Please proceed to the next step.';
                    $title = 'Appointment Done';
                } elseif ($status === 'Appointment Pending') {
                    $message = 'You have a pending Pre-Survey Consultation appointment.';
                    $title = 'Appointment Pending';
                }
        
                return response()->json(['exists' => true, 'message' => $message, 'title' => $title]);
            }
        }
        
        if ($purpose === 'Mid-Survey Consultation') {
            $preSurveyAppointmentExists = Appointments::where('user_id', $userID)
                ->where('purpose', $purpose)
                ->orderBy('created_at', 'desc')
                ->exists();
        
            if (!$preSurveyAppointmentExists) {
                $message = 'There is no previous Mid-Survey Consultation appointment.';
                $title = 'Appointment Requirement';
                return response()->json(['exists' => false, 'message' => $message, 'title' => $title]);
            } else {
                $status = Appointments::where('user_id', $userID)
                    ->where('purpose', $purpose)
                    ->orderBy('created_at', 'desc')
                    ->value('status');
        
                if ($status === 'Appointment Done') {
                    $message = 'You have completed the Pre-Survey Consultation appointment. Please proceed to the next step.';
                    $title = 'Appointment Done';
                } elseif ($status === 'Appointment Pending') {
                    $message = 'You have a pending Pre-Survey Consultation appointment.';
                    $title = 'Appointment Pending';
                }
        
                return response()->json(['exists' => true, 'message' => $message, 'title' => $title]);
            }
        }
        
    }

    public function mobilefacultySchedulingAppointment1(Request $request)
    { 
        if ($request->purpose === 'Proposal Consultation' || $request->purpose === 'Pre-Survey Consultation' || $request->purpose === 'Mid-Survey Consultation') {

            $appointments = new Appointments;
            $appointments->date = $request->date;
            $appointments->time = $request->time;
            $appointments->purpose = $request->purpose;
            $appointments->status = 'Appointment Pending';
            $appointments->user_id = Auth::id();
            $appointments->save();
            $lastId = DB::getPdo()->lastInsertId();

            $extension = Extension::find($request->extensionId);
            
            if ($request->purpose === 'Proposal Consultation') {
                $extension->appointment1_id = $lastId;
                $extension->status = 'Pending Approval for Proposal Consultation Appointment';
                $extension->percentage_status = 3;
            } elseif ($request->purpose === 'Pre-Survey Consultation') {
                $extension->appointment2_id = $lastId;
                $extension->status = 'Pending Approval for Pre-Survey Consultation Appointment';
                $extension->percentage_status = 67;
            } elseif ($request->purpose === 'Mid-Survey Consultation') {
                $extension->appointment3_id = $lastId;
                $extension->status = 'Pending Approval for Mid-Survey Consultation Appointment';
                $extension->percentage_status = 70;
            }
            
            $extension->save();

            $notif = new Notifications;
            $notif->type = 'Admin Notification';
            $notif->title = 'Requesting Appointment for ' . $request->purpose;
            $notif->message = 'Someone requested appointment for ' . strtolower($request->purpose);
            $notif->date = now();
            $notif->user_id = Auth::id();
            $notif->reciever_id = 0;
            $notif->save();

            return response()->json(['success' => true, 'message' => 'Your schedule has been sent; kindly wait to be approved.'], 200);
        }
        
        return response()->json(['success' => false, 'message' => 'Invalid purpose.'], 400);
    }
    //MOBILE START

    

=======
>>>>>>> 7323b02d4d31f405be196f10c5c452c818216995
}
