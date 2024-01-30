<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CalendarController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::delete('/admin/departmentlist/{id}/deleted', [
  'uses' => 'DepartmentController@delete_department',
        'as' => 'admin.department.delete'
]);

Route::resource('request', 'RequestingFormController');

Route::delete('/studentlist/{id}/deleted', [
    'uses' => 'AdminController@deletestudentinfo',
          'as' => 'studentinfo.delete'
  ]);

Route::delete('/stafflist/{id}/deleted', [
    'uses' => 'AdminController@deletestaffinfo',
          'as' => 'staffinfo.delete'
  ]);

Route::delete('/facultylist/{id}/deleted', [
    'uses' => 'AdminController@deletefacultyinfo',
          'as' => 'facultyinfo.delete'
  ]);

Route::delete('/researchlist/{id}/deleted', [
    'uses' => 'ResearchController@deleteresearchinfo',
          'as' => 'researchinfo.delete'
  ]);

Route::post('/uploadpdf', [
    'uses' => 'RequestingFormController@uploadPDF',
          'as' => 'uploadpdf'
  ]);

Route::delete('/student/myfiles/{id}/deleted', [
    'uses' => 'StudentController@deletepdf',
          'as' => 'student.file.delete'
  ]);

Route::delete('/staff/myfiles/{id}/deleted', [
    'uses' => 'StaffController@deletepdf',
          'as' => 'staff.file.delete'
  ]);

Route::delete('/faculty/myfiles/{id}/deleted', [
    'uses' => 'FacultyController@deletepdf',
          'as' => 'faculty.file.delete'
  ]);

Route::delete('/administrator/{id}/deleted', [
    'uses' => 'AdminController@deleteAdministration',
          'as' => 'administratorDelete'
  ]);

Route::delete('/faculty/citation/{id}/deleted', [
    'uses' => 'CitationController@facultyDeleteCitation',
          'as' => 'facultyDeleteCitation'
  ]);

//MOBILE START
Route::post('/login-mobile', 'Auth\LoginController@LoginMobile');
Route::get('/dashboardmobile', 'App\Http\Controllers\AdminController@dashboardmobile');

Route::get('/departmentsmobile', 'App\Http\Controllers\DepartmentController@mobileindex');
Route::post('/departmentsmobile', 'App\Http\Controllers\DepartmentController@mobileadd_department');
Route::get('/departmentsmobile/{id}', 'App\Http\Controllers\DepartmentController@mobileedit_department');
Route::put('/departmentsmobile/{id}', 'App\Http\Controllers\DepartmentController@mobileupdate_department');
Route::delete('/departmentsmobile/{id}', 'App\Http\Controllers\DepartmentController@mobiledelete_department');

Route::post('/add-announcements', 'AdminController@addAnnouncements');
Route::get('/announcements', 'AdminController@listAnnouncement');

Route::get('/events', 'CalendarController@mobileindex')->name('mobileindex');
Route::post('/events/create', 'CalendarController@mobilecreate_event')->name('mobilecreate_event');
Route::post('/fullcalendars/update', 'CalendarController@mobileupdate');
Route::delete('/fullcalendars/delete', 'CalendarController@mobiledestroy');

Route::get('/mobileshowannouncement', 'AdminController@mobileshowannouncement');
Route::get('/show/comments/{id}', 'CommentController@mobileshowcomments');
Route::post('/add/{id}/comment', [
  'uses' => 'CommentController@mobileaddcomment',
        'as' => 'mobileaddcomment'
]);

Route::get('/staffprofile/{id}', 'App\Http\Controllers\StaffController@getProfile');

Route::get('/profile/{id}', 'App\Http\Controllers\StudentController@getProfile');
Route::post('/upload_file', 'App\Http\Controllers\StudentController@mobileupload_file');
Route::get('/myfiles/{id}', 'App\Http\Controllers\StudentController@mobilemyfiles')->name('mobilemyfiles');
Route::delete('/delete_file/{file}', 'StudentController@deleteFile');
Route::get('/get_files/{id}', 'App\Http\Controllers\StudentController@get_files')->name('get_files');

Route::post('/apply-certification', 'App\Http\Controllers\RequestingFormController@apply_certifications');
//MOBILE END