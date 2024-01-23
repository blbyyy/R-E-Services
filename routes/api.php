<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/mobileevents', 'CalendarController@mobileindex')->name('mobileevents');
Route::post('/mobileevents/create', 'CalendarController@mobilecreate_event')->name('mobilecreate_event');
Route::post('/mobilefullcalendars/update', [CalendarController::class, 'mobileupdate']);
Route::delete('/mobilefullcalendars/delete', [CalendarController::class, 'mobiledestroy']);
//MOBILE END



