<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/homepage', [
    'uses' => 'AdminController@showannouncement',
          'as' => 'show.announcement'
  ]);

Route::get('login/google', 'Auth\LoginController@redirectToGoogle');

Route::get('login/google/callback', 'Auth\LoginController@handleGoogleCallback');

Route::view('/CreateAccount', 'layouts.createacc');

Route::view('/Contact', 'layouts.contact');

//START STUDENT POV
Route::view('/Register/Student', 'students.register');

Route::post('Student/Registered',[
    'uses' => 'StudentController@register',
    'as' => 'StudentRegistered'
]);

Route::get('/Student/Profile/{id}', [
    'uses' => 'StudentController@profile',
          'as' => 'student.profile'
  ]);

Route::put('/Student/Profile/Updated/{id}', [
    'uses' => 'StudentController@updateprofile',
          'as' => 'student.update-profile'
  ]);

Route::post('/Student/Profile/Avatar/Changed', [
    'uses' => 'StudentController@changeavatar',
          'as' => 'updateavatar'
  ]);

Route::get('/apply/certification', [
    'uses' => 'StudentController@certification',
          'as' => 'certification.page'
  ]);

Route::get('/application/status', [
    'uses' => 'StudentController@application_status',
          'as' => 'application.status'
  ]);

Route::get('/application/status/{id}', 'StudentController@show_application')->name('get-specific-data');

Route::post('/apply/certification/requested/{id}',[
    'uses' => 'StudentController@apply_certification',
    'as' => 'StudentRequested'
]);
//END OF STUDENT POV

//START STAFF POV
Route::view('/Register/Staff', 'staff.register');

Route::post('Staff/Registered',[
    'uses' => 'StaffController@register',
    'as' => 'StaffRegistered'
]);

Route::get('/Staff/Profile/{id}', [
    'uses' => 'StaffController@profile',
          'as' => 'staff.profile'
  ]);

Route::put('/Staff/Profile/Updated/{id}', [
    'uses' => 'StaffController@updateprofile',
          'as' => 'staff.update-profile'
  ]);
//END OF STAFF POV

//START FACULTY POV
Route::view('/Register/Faculty', 'faculty.register');

Route::post('Faculty/Registered',[
    'uses' => 'FacultyController@register',
    'as' => 'FacultyRegistered'
]);

Route::get('/Faculty/Profile/{id}', [
    'uses' => 'FacultyController@profile',
          'as' => 'faculty.profile'
  ]);

Route::put('/Faculty/Profile/Updated/{id}', [
    'uses' => 'FacultyController@updateprofile',
          'as' => 'faculty.update-profile'
  ]);
//END OF FACULTY POV

Route::get('/applicationlist', [
    'uses' => 'RequestingFormController@application_list',
          'as' => 'application.list'
  ]);

Route::get('/', function () {

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

        return View::make('layouts.navigation',compact('admin','student'));

});

Route::get('/old', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index');
    Route::post('/logoutss', 'HomeController@perform');
});



Route::get('/Admin/Profile/{id}', [
    'uses' => 'AdminController@profile',
          'as' => 'admin.profile'
  ]);

Route::put('/Admin/Profile/Updated/{id}', [
    'uses' => 'AdminController@updateprofile',
          'as' => 'admin.update-profile'
  ]);



Route::post('/request',[
    'uses' => 'RequestingFormController@store',
    'as' => 'FormRequested'
]);

Route::get('/announcements', function () {

    $admin = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

    return View::make('admin.announcement',compact('admin'));

});

Route::post('/announcements/added',[
    'uses' => 'AdminController@add_announcements',
    'as' => 'AnnouncementAdded'
]);

Route::get('/dashboard', [
    'uses' => 'AdminController@dashboard',
          'as' => 'dashboard'
  ]);

Route::get('/studentlist', [
    'uses' => 'AdminController@studentlist',
          'as' => 'student.list'
  ]);

Route::get('/add/student', function () {

    $admin = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

    return View::make('admin.addstudent',compact('admin'));

});

Route::post('/student/added', [
    'uses' => 'AdminController@addstudent',
          'as' => 'addstudent'
  ]);

Route::get('/studentlist/show/{id}', 'AdminController@showstudentinfo')->name('get-student-data');

Route::get('/studentlist/{id}/edit', 'AdminController@editstudentinfo')->name('edit-student-data');

Route::post('/studentlist/{id}/edit/updated', [
    'uses' => 'AdminController@updatestudentinfo',
          'as' => 'studentinfo.update'
  ]);

Route::get('/stafflist', [
    'uses' => 'AdminController@stafflist',
          'as' => 'staff.list'
  ]);

Route::get('/add/staff', function () {

    $admin = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

    return View::make('admin.addstaff',compact('admin'));

});

Route::post('/staff/added', [
    'uses' => 'AdminController@addstaff',
          'as' => 'addstaff'
  ]);

Route::get('/stafflist/show/{id}', 'AdminController@showstaffinfo')->name('get-staff-data');

Route::get('/stafflist/{id}/edit', 'AdminController@editstaffinfo')->name('edit-staff-data');

Route::post('/stafflist/{id}/edit/updated', [
    'uses' => 'AdminController@updatestaffinfo',
          'as' => 'staffinfo.update'
  ]);

Route::get('/facultylist', [
    'uses' => 'AdminController@facultymemberlist',
          'as' => 'faculty.list'
  ]);

Route::get('/add/faculty', function () {

    $admin = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

    return View::make('admin.addfaculty',compact('admin'));

});

Route::post('/faculty/added', [
    'uses' => 'AdminController@addfaculty',
          'as' => 'addfaculty'
  ]);

Route::get('/facultylist/show/{id}', 'AdminController@showfacultyinfo')->name('get-faculty-data');

Route::get('/facultylist/{id}/edit', 'AdminController@editfacultyinfo')->name('edit-faculty-data');

Route::post('/facultylist/{id}/edit/updated', [
    'uses' => 'AdminController@updatefacultyinfo',
          'as' => 'facultyinfo.update'
  ]);

Route::get('/researchlist', [
    'uses' => 'ResearchController@researchlist',
          'as' => 'research.list'
  ]);

Route::get('/add/research', function () {

    $admin = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

    return View::make('research.addresearch',compact('admin'));

});

Route::post('/research/added', [
    'uses' => 'ResearchController@addresearch',
          'as' => 'addresearch'
  ]);

Route::get('/researchlist/show/{id}', 'ResearchController@showresearchinfo')->name('get-research-data');

Route::get('/researchlist/{id}/edit', 'ResearchController@editresearchinfo')->name('edit-research-data');

Route::post('/researchlist/{id}/edit/updated', [
    'uses' => 'ResearchController@updateresearchinfo',
          'as' => 'researchinfo.update'
  ]);

Route::get('/show/comments/{id}', 'CommentController@showcomments')->name('get-comments-data');

Route::post('/add/{id}/comment', [
    'uses' => 'CommentController@addcomment',
          'as' => 'addcomment'
  ]);

Route::get('/tryupload', function () {

    $admin = DB::table('staff')
        ->join('users','users.id','staff.user_id')
        ->select('staff.*','users.*')
        ->where('user_id',Auth::id())
        ->first();

    return View::make('research.try',compact('admin'));

});

// Route::post('/upload', 'ResearchController@upload')->name('tryuploads');

Route::get('/pdf/{fileName}', 'StudentController@showpdf')->name('pdf.show');

Route::get('/student/myfiles', 'StudentController@myfiles')->name('myfiles');

Route::post('/student/myfiles/upload', 'StudentController@upload_file')->name('uploadfile');

Route::get('/show/pdf/{id}', 'StudentController@pdfinfo')->name('pdf.info');

Route::get('/get/file/{id}', 'StudentController@getfile_id')->name('get-file-id');

Route::get('/application/status/certification/{id}', 'AdminController@admin_certification')->name('admin-certification');

Route::post('/application/status/certification/{id}/sent', [
    'uses' => 'AdminController@certification',
          'as' => 'certification'
  ]);

Route::post('/change-password', 'StudentController@changePassword')->name('change.password');

// Route::get('/events', [CalendarController::class, 'index']);
Route::get('/events', 'CalendarController@index')->name('events');
Route::post('/events/create', 'CalendarController@create_event')->name('create_event');
Route::post('/fullcalendars/update', [CalendarController::class, 'update']);
Route::delete('/fullcalendars/delete', [CalendarController::class, 'destroy']);
