<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Staff;
use App\Models\User;
use View;
use DB;
use File;
use Auth;

class StaffController extends Controller
{
    public function register(Request $request)
    { 
            $users = new User;
            $users->fname = $request->fname;
            $users->lname = $request->lname;
            $users->mname = $request->mname;
            $users->email = $request->email;
            $users->password = bcrypt($request->password);
            $users->role = $request->role;  
            $users->save();
            $last = DB::getPdo()->lastInsertId();

            $staff = new Staff;
            $staff->fname = $request->fname;
            $staff->lname = $request->lname;
            $staff->mname = $request->mname;
            $staff->position = $request->position;
            $staff->designation = $request->designation;
            $staff->tup_id = $request->tup_id;
            $staff->email = $request->email;
            $staff->gender = $request->gender;
            $staff->phone = $request->phone;
            $staff->address = $request->address;
            $staff->birthdate = $request->birthdate;
            $staff->user_id = $last;
            $staff->save();

            auth()->login($users, true);

            return redirect()->to('/homepage');

    }

    public function profile($id)
    {
        $staff = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

        return View::make('staff.profile',compact('staff'));
    }

    public function updateprofile(Request $request, $id)
    {
        $staff_id = DB::table('staff')
        ->select('staff.id')
        ->where('user_id',Auth::id())
        ->first();

        $staff = Staff::find($staff_id->id);
        $staff->fname = $request->fname;
        $staff->lname = $request->lname;
        $staff->mname = $request->mname;
        $staff->position = $request->position;
        $staff->designation = $request->designation;
        $staff->tup_id = $request->tup_id;
        $staff->email = $request->email;
        $staff->gender = $request->gender;
        $staff->phone = $request->phone;
        $staff->address = $request->address;
        $staff->birthdate = $request->birthdate;

        // $files = $request->file('avatar');
        // $staff->avatar = 'images/'.time().'-'.$files->getClientOriginalName();

        // $staff->save();

        // $data = array('status' => 'saved');
        // Storage::put('public/images/'.time().'-'.$files->getClientOriginalName(), file_get_contents($files));

        $user = User::find(Auth::id());
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->mname = $request->mname;
        $user->email = $request->email;
        $user->save();

        return redirect()->to('/Staff/Profile/{id}');
    }
}
