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

Route::post('/faculty/extension/schedule-appointment/checking-date', [
    'uses' => 'AppointmentController@checkingDate',
          'as' => 'appointments.date.check'
  ]);

Route::post('/faculty/extension/schedule-appointment/checking-appointment', [
    'uses' => 'AppointmentController@checkingAppointments',
          'as' => 'appointments.purpose.check'
  ]);

//MOBILE START
//MOBILE 
Route::post('/students/register', 'App\Http\Controllers\StudentController@RegisterMobile');
Route::get('mobilefacultyregistration-page', [FacultyController::class, 'mobilefacultyregistration_page']);
Route::post('mobilefacultyregister', [FacultyController::class, 'mobilefacultyregister']);


// >>>>>>> ce5adb40f149d3bc3c76207b44141feb885c1ba9
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
Route::post('/add-comment/{id}', 'CommentController@mobileaddcomment');

Route::get('/staffprofile/{id}', 'App\Http\Controllers\StaffController@getProfile');

Route::get('/profile/{id}', 'App\Http\Controllers\StudentController@getProfile');
Route::get('/facultyprofile/{id}', 'App\Http\Controllers\FacultyController@getProfile');

// Route::get('/facultyprofile/{id}', 'App\Http\Controllers\FacultyController@getProfile');

Route::post('/mobilechangeavatar/{email}', 'App\Http\Controllers\StudentController@mobilechangeavatar');
Route::put('/studentedit/profile/{email}', 'App\Http\Controllers\StudentController@mobileupdateprofile');

Route::post('/facultymobilechangeavatar/{email}', 'App\Http\Controllers\FacultyController@mobilechangeavatar');
Route::put('/facultyedit/profile/{email}', 'App\Http\Controllers\FacultyController@mobileupdateprofile');

Route::post('/upload_file', 'App\Http\Controllers\StudentController@mobileupload_file');
Route::get('/mobilecertification', 'App\Http\Controllers\StudentController@mobilecertification');
Route::post('mobileapply_certification/{id}', 'App\Http\Controllers\StudentController@mobileapply_certification');

Route::post('mobilefacultyapply_certification/{id}', 'App\Http\Controllers\FacultyController@mobileapply_certification');

Route::get('/mobileshowpdf/{fileName}', 'App\Http\Controllers\StudentController@mobileshowpdf');
Route::get('/myfiles/{id}', 'App\Http\Controllers\StudentController@mobilemyfiles')->name('mobilemyfiles');
Route::delete('/delete_file/{file}', 'StudentController@deleteFile');
Route::get('/get_files/{id}', 'App\Http\Controllers\StudentController@get_files')->name('get_files');
Route::get('/mobileapplication_status/status/{id}', 'App\Http\Controllers\StudentController@mobileapplication_status');
Route::get('/mobileshow_application/{id}', 'App\Http\Controllers\StudentController@mobileshow_application');

Route::get('/mobileapplication_statusfaculty/status/{id}', 'App\Http\Controllers\FacultyController@mobileapplication_status');
Route::get('/mobileshow_applicationfaculty/{id}', 'App\Http\Controllers\FacultyController@mobileshow_application');

Route::post('/mobilereApply', 'App\Http\Controllers\StudentController@mobilereApply');
Route::post('/mobilereApplyfaculty', 'App\Http\Controllers\FacultyController@mobilereApply');

Route::get('/mobile/title-checker-page', 'App\Http\Controllers\StudentController@mobiletitleChecker');
Route::get('/mobile/show-research-info/{id}', 'App\Http\Controllers\StudentController@mobileshowResearchInfo');

Route::get('/mobile/faculty-checker-page', 'App\Http\Controllers\FacultyController@mobilesearchResearchList');

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
Route::post('mobile/sending/technicalAdviser/approval/{id}', [FacultyController::class, 'mobilesendingTechnicalAdviserApproval']);
Route::get('/mobile/subjectAdviser/approval/{id}', [FacultyController::class, 'mobilesubjectAdviserApproval']);
Route::post('mobile/sending/subjectAdviser/approval/{id}', [FacultyController::class, 'mobilesendingSubjectAdviserApproval']);

Route::get('/mobilehomepage/{id}', 'App\Http\Controllers\LayoutsController@mobilehomepage');

Route::get('mobile/student/send-request-access/{id}', 'App\Http\Controllers\ResearchController@mobilestudentSendRequestAccess');
Route::post('/student/send-request-access', [ResearchController::class, 'mobilestudentSendinRequestAccess']);

Route::get('mobile/faculty/send-request-access/{id}', 'App\Http\Controllers\ResearchController@mobilefacultySendRequestAccess');
Route::get('mobile/facultyFILE/send-request-access/{id}', 'App\Http\Controllers\ResearchController@mobilefacultySendRequestAccessFILE');
Route::post('/faculty/send-request-access', [ResearchController::class, 'mobilefacultySendinRequestAccess']);

Route::post('/extension/mobileapplication', 'App\Http\Controllers\ExtensionController@mobilecreateApplication');
Route::get('/faculty/mobileapplication/{user_id}', 'App\Http\Controllers\ExtensionController@mobilefacultyApplication');

Route::post('/mobilecheckingDate', 'App\Http\Controllers\AppointmentController@mobilecheckingDate');
Route::post('/mobilecheckingAppointments', 'App\Http\Controllers\AppointmentController@mobilecheckingAppointments');
Route::post('/mobilefacultySchedulingAppointment1', 'App\Http\Controllers\AppointmentController@mobilefacultySchedulingAppointment1');
Route::post('/mobileproposal1', 'App\Http\Controllers\ExtensionController@mobileproposal1');
Route::post('/mobileproposal2', 'App\Http\Controllers\ExtensionController@mobileproposal2');

Route::get('/mobileresearchProposal/{id}', 'App\Http\Controllers\ResearchProposalController@mobileresearchProposal');
Route::post('/mobileuploadResearchProposal', 'App\Http\Controllers\ResearchProposalController@mobileuploadResearchProposal');
Route::get('/mobilereSubmitProposalFetchingId/{id}', 'App\Http\Controllers\ResearchProposalController@mobilereSubmitProposalFetchingId');
Route::post('/mobilereUploadResearchProposal', 'App\Http\Controllers\ResearchProposalController@mobilereUploadResearchProposal');
Route::get('/mobileresearchProposalStatus/{id}', 'App\Http\Controllers\ResearchProposalController@mobileresearchProposalStatus');
Route::get('/mobilecolloquiumSchedule/{id}', 'App\Http\Controllers\ResearchProposalController@mobilecolloquiumSchedule');
Route::get('/RPmobileshowpdf/{fileName}', 'App\Http\Controllers\ResearchProposalController@RPmobileshowpdf');

//MOBILE END
