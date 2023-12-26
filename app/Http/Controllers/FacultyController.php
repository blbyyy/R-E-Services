<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\User;
use View;
use DB;
use File;
use Auth;

class FacultyController extends Controller
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

            $faculty = new Faculty;
            $faculty->fname = $request->fname;
            $faculty->lname = $request->lname;
            $faculty->mname = $request->mname;
            $faculty->department = $request->department;
            $faculty->position = $request->position;
            $faculty->designation = $request->designation;
            $faculty->tup_id = $request->tup_id;
            $faculty->email = $request->email;
            $faculty->gender = $request->gender;
            $faculty->phone = $request->phone;
            $faculty->address = $request->address;
            $faculty->birthdate = $request->birthdate;
            $faculty->user_id = $last;
            $faculty->save();

            auth()->login($users, true);

            return redirect()->to('/homepage');

    }

    public function profile($id)
    {
        $faculty = DB::table('faculty')
        ->join('users','users.id','faculty.user_id')
        ->select('faculty.*','users.*')
        ->where('user_id',Auth::id())
        ->first();
        
        return View::make('faculty.profile',compact('faculty'));
    }

    public function updateprofile(Request $request, $id)
    {
        $faculty_id = DB::table('faculty')
        ->select('faculty.id')
        ->where('user_id',Auth::id())
        ->first();

        $faculty = Faculty::find($faculty_id->id);
        $faculty->fname = $request->fname;
        $faculty->lname = $request->lname;
        $faculty->mname = $request->mname;
        $faculty->department = $request->department;
        $faculty->position = $request->position;
        $faculty->designation = $request->designation;
        $faculty->tup_id = $request->fid;
        $faculty->email = $request->email;
        $faculty->gender = $request->gender;
        $faculty->phone = $request->phone;
        $faculty->address = $request->address;
        $faculty->birthdate = $request->birthdate;

        $user = User::find(Auth::id());
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->mname = $request->mname;
        $user->email = $request->email;
        $user->save();

        return redirect()->to('/Faculty/Profile/{id}');
    }
}
