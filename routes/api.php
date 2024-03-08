<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ResearchController;

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

Route::delete('/staff/citation/{id}/deleted', [
    'uses' => 'CitationController@staffDeleteCitation',
          'as' => 'staffDeleteCitation'
  ]);

Route::delete('/admin/userlist/{id}/deleted', [
    'uses' => 'AdminController@deleteUserInfo',
          'as' => 'admin.deleteUserInfo'
  ]);
  
Route::delete('/admin/applicationlist/{id}/deleted', [
    'uses' => 'AdminController@deleteApplicationInfo',
          'as' => 'admin.deleteApplicationInfo'
  ]);

Route::delete('/admin/researchlist/{id}/deleted', [
    'uses' => 'AdminController@deleteResearchInfo',
          'as' => 'admin.deleteResearchInfo'
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
Route::post('/mobilechangeavatar', 'App\Http\Controllers\StudentController@mobilechangeavatar');
Route::post('/upload_file', 'App\Http\Controllers\StudentController@mobileupload_file');
Route::get('/mobilecertification', 'App\Http\Controllers\StudentController@mobilecertification');
Route::post('mobileapply_certification/{id}', 'App\Http\Controllers\StudentController@mobileapply_certification');
Route::get('/mobileshowpdf/{fileName}', 'App\Http\Controllers\StudentController@mobileshowpdf');
Route::get('/myfiles/{id}', 'App\Http\Controllers\StudentController@mobilemyfiles')->name('mobilemyfiles');
Route::delete('/delete_file/{file}', 'StudentController@deleteFile');
Route::get('/get_files/{id}', 'App\Http\Controllers\StudentController@get_files')->name('get_files');
Route::get('/mobileapplication_status/status/{id}', 'App\Http\Controllers\StudentController@mobileapplication_status');
Route::get('/mobileshow_application/{id}', 'App\Http\Controllers\StudentController@mobileshow_application');
Route::post('/mobilereApply', 'App\Http\Controllers\StudentController@mobilereApply');

Route::get('/mobile/title-checker-page', 'App\Http\Controllers\StudentController@mobiletitleChecker');
Route::get('/mobile/show-research-info/{id}', 'App\Http\Controllers\StudentController@mobileshowResearchInfo');

// Route::post('/apply-certification', 'App\Http\Controllers\RequestingFormController@apply_certifications');

Route::get('/mobileadministration', [AdminController::class, 'mobileadministration']);
Route::post('/mobileaddadministration', [AdminController::class, 'mobileaddAdministration']);
Route::get('/mobileeditadministration/{id}', [AdminController::class, 'mobileeditAdministration']);
Route::put('/mobileupdateadministration/{id}', [AdminController::class, 'mobileupdateAdministration']);
Route::get('/mobileeditadministrationrole/{id}', [AdminController::class, 'mobileeditAdministrationRole']);
Route::put('/mobileupdateadministrationrole/{id}', [AdminController::class, 'mobileupdateAdministrationRole']);
Route::delete('/mobiledeleteadministration/{id}', [AdminController::class, 'mobiledeleteAdministration']);

Route::get('/mobile/students/application/{id}', [FacultyController::class, 'mobilestudents_application']);
Route::get('/mobile/students/application/specific/{id}', [FacultyController::class, 'mobilestudents_application_specific']);
Route::get('/mobile/technicalAdviser/approval/{id}', [FacultyController::class, 'mobiletechnicalAdviserApproval']);
Route::post('/mobile/sending/technicalAdviser/approval/{id}', [FacultyController::class, 'mobilesendingTechnicalAdviserApproval']);
Route::get('/mobile/subjectAdviser/approval/{id}', [FacultyController::class, 'mobilesubjectAdviserApproval']);
Route::post('/mobile/sending/subjectAdviser/approval/{id}', [FacultyController::class, 'mobilesendingSubjectAdviserApproval']);

Route::get('/mobilehomepage/{id}', 'App\Http\Controllers\LayoutsController@mobilehomepage');

Route::get('mobile/student/send-request-access/{id}', 'App\Http\Controllers\ResearchController@mobilestudentSendRequestAccess');
Route::post('/student/send-request-access', [ResearchController::class, 'mobilestudentSendinRequestAccess']);
//MOBILE END