<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use View;
use DB;
use File;
use Auth;

//MOBILE
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('login');
        }

        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            auth()->login($existingUser, true);
           
        } else {      
            
            $newUser = new User;
            $newUser->fname = $user['given_name'];
            $newUser->lname = $user['family_name'];
            $newUser->email = $user->email;
            $newUser->role = 'Student'; 
            $newUser->save();
            $last = DB::getPdo()->lastInsertId();

            $newStudent = new Student;
            $newStudent->fname = $user['given_name'];
            $newStudent->lname = $user['family_name'];
            $newStudent->email = $user->email;
            $newStudent->user_id = $last;

            $newStudent->save();
            
            auth()->login($newUser, true);
            return redirect()->to('/student/fillup')->with('success', 'You already logged in; to continue, fill out the remaining fields in your user profile.');
        }
        return redirect()->to('/homepage');
    }

    //MOBILE
    public function LoginMobile(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(["errors" => "Invalid credentials.", "status" => 200]);
        }

        $user = Auth::user();
        $token = JWTAuth::fromUser($user);

        return response()->json([
            "success" => "Login Successfully.",
            "user" => $user,
            "token" => $token,
            "status" => 200,
        ]);
    }

}
