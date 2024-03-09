<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\QrCodeController;
use App\Models\Department;

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
// Route::get('/homepage', [
//     'uses' => 'AdminController@showannouncement',
//           'as' => 'homepage'
//   ]);

Route::get('login/google', 'Auth\LoginController@redirectToGoogle');

Route::get('login/google/callback', 'Auth\LoginController@handleGoogleCallback');

Route::get('/student/fillup', [
    'uses' => 'StudentController@fillup',
          'as' => 'student.fillup'
  ]);

Route::post('/student/fillup/sent}', [
    'uses' => 'StudentController@filled',
          'as' => 'student.fillup-sent'
  ]);

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
          'as' => 'student_update_avatar'
  ]);

Route::post('/student/profile/validate-password', [
    'uses' => 'StudentController@validatePassword',
          'as' => 'student_validate_password'
  ]);

Route::post('/Student/Profile/Change-Password', [
    'uses' => 'StudentController@changePassword',
          'as' => 'student_change_password'
  ]);

Route::get('/student/myfiles', [
    'uses' => 'StudentController@myfiles',
          'as' => 'student_myfiles'
  ]);

Route::post('/student/myfiles/upload',[
    'uses' => 'StudentController@upload_file',
    'as' => 'student_upload_file'
]);

Route::get('/pdf/{fileName}', [
    'uses' => 'StudentController@showpdf',
          'as' => 'student_pdf_show'
  ]);

Route::get('/show/pdf/{id}', [
    'uses' => 'StudentController@pdfinfo',
          'as' => 'student_pdf_info'
  ]);

Route::get('/student/show/history/{id}', [
    'uses' => 'StudentController@history',
          'as' => 'student_pdf_history'
  ]);

Route::get('/apply/certification', [
    'uses' => 'StudentController@certification',
          'as' => 'student.certification.page'
  ]);

Route::get('/get/file/{id}', [
    'uses' => 'StudentController@getfile_id',
          'as' => 'student_get-file-id'
  ]);

Route::post('/apply/certification/requested/{id}',[
    'uses' => 'StudentController@apply_certification',
    'as' => 'StudentRequested'
]);

Route::get('/student/reapply/get/file/{id}', [
  'uses' => 'StudentController@re_apply_getfile_id',
        'as' => 'student_reapply_get-file-id'
]);

Route::post('/student/re-apply/certification/requested/{id}', [
  'uses' => 'StudentController@reApply',
        'as' => 'student.reapply.certification'
]);

Route::get('/application/status', [
  'uses' => 'StudentController@application_status',
        'as' => 'student.application.status'
]);

Route::get('/application/status/{id}', [
  'uses' => 'StudentController@show_application',
        'as' => 'student.get-specific-data'
]);

Route::get('/student/title-checker', [
  'uses' => 'StudentController@titleChecker',
        'as' => 'student.titleChecker'
]);

Route::get('/student/title-checker/search/show/{id}', [
  'uses' => 'StudentController@showResearchInfo',
        'as' => 'student.title.checker.show'
]);

Route::get('/student/research/{id}/request-access', [
  'uses' => 'ResearchController@studentSendRequestAccess',
        'as' => 'student.request.access'
]);

Route::post('/student/research/request-access/sent', [
  'uses' => 'ResearchController@studentSendinRequestAccess',
        'as' => 'student.sending.request.access'
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

Route::post('/staff/profile/validate-password', [
    'uses' => 'StaffController@validatePassword',
          'as' => 'staff_validate_password'
  ]);

Route::post('/Staff/Profile/Avatar/Changed', [
    'uses' => 'StaffController@changeavatar',
          'as' => 'staff_update_avatar'
  ]);

Route::post('/Staff/Profile/Change-Password', [
    'uses' => 'StaffController@changePassword',
          'as' => 'staff_change_password'
  ]);

Route::get('/staff/myfiles', [
    'uses' => 'StaffController@myfiles',
          'as' => 'staff_myfiles'
  ]);

Route::post('/staff/myfiles/upload',[
    'uses' => 'StaffController@upload_file',
    'as' => 'staff_upload_file'
]);

Route::get('/staff/pdf/{fileName}', [
    'uses' => 'StaffController@showpdf',
          'as' => 'staff_pdf_show'
  ]);

Route::get('/staff/show/pdf/{id}', [
    'uses' => 'StaffController@pdfinfo',
          'as' => 'staff_pdf_info'
  ]);

Route::get('/staff/get/file/{id}', [
    'uses' => 'StaffController@getfile_id',
          'as' => 'staff_get-file-id'
  ]);

Route::get('/staff/apply/certification', [
    'uses' => 'StaffController@certification',
          'as' => 'staff.certification.page'
  ]);

Route::post('/staff/apply/certification/requested/{id}',[
    'uses' => 'StaffController@apply_certification',
    'as' => 'StaffRequested'
]);

Route::get('/staff/reapply/get/file/{id}', [
  'uses' => 'StaffController@re_apply_getfile_id',
        'as' => 'staff_reapply_get-file-id'
]);

Route::post('/staff/re-apply/certification/requested/{id}', [
  'uses' => 'StaffController@reApply',
        'as' => 'staff.reapply.certification'
]);

Route::get('/staff/application/status', [
    'uses' => 'StaffController@application_status',
          'as' => 'staff.application.status'
  ]);

Route::get('/staff/application/status/{id}', [
    'uses' => 'StaffController@show_application',
          'as' => 'staff.get-specific-data'
  ]);

Route::get('/staff/show/history/{id}', [
    'uses' => 'StaffController@history',
          'as' => 'staff_pdf_history'
  ]);

Route::get('/staff/citation', [
    'uses' => 'CitationController@staffCitationCount',
          'as' => 'staffCitationCount'
  ]);

Route::post('/staff/citation/added', [
    'uses' => 'CitationController@staffAddCitation',
          'as' => 'staffAddCitation'
  ]);

Route::get('/staff/citation/{id}', [
    'uses' => 'CitationController@staffShowCitationInfo',
          'as' => 'staffSpecificCitation'
  ]);

Route::get('/staff/citation/{id}/edit', [
    'uses' => 'CitationController@staffEditCitationInfo',
          'as' => 'staffSpecificCitationEdit'
  ]);

Route::post('/staff/citation/{id}/edit/updated', [
    'uses' => 'CitationController@staffUpdateCitation',
          'as' => 'staffSpecificCitationUpdated'
  ]);
//END OF STAFF POV

//START FACULTY POV
Route::get('/Register/Faculty', [
  'uses' => 'FacultyController@registration_page',
        'as' => 'faculty.registration'
]);

Route::post('Faculty/Registered',[
    'uses' => 'FacultyController@register',
    'as' => 'FacultyRegistered'
]);

Route::get('/faculty/profile/{id}', [
    'uses' => 'FacultyController@profile',
          'as' => 'faculty.profile'
  ]);

Route::put('/Faculty/Profile/Updated/{id}', [
    'uses' => 'FacultyController@updateprofile',
          'as' => 'faculty.update-profile'
  ]);

Route::post('/faculty/profile/validate-password', [
    'uses' => 'FacultyController@validatePassword',
          'as' => 'faculty_validate_password'
  ]);

Route::post('/faculty/profile/avatar/changed', [
    'uses' => 'FacultyController@changeavatar',
          'as' => 'faculty_update_avatar'
  ]);

Route::post('/faculty/profile/avatar/change-password', [
    'uses' => 'FacultyController@changePassword',
          'as' => 'faculty_change_password'
  ]);

Route::get('/faculty/myfiles', [
    'uses' => 'FacultyController@myfiles',
          'as' => 'faculty_myfiles'
  ]);

Route::post('/faculty/myfiles/upload',[
    'uses' => 'FacultyController@upload_file',
    'as' => 'faculty_upload_file'
]);

Route::get('/faculty/pdf/{fileName}', [
    'uses' => 'FacultyController@showpdf',
          'as' => 'faculty_pdf_show'
  ]);

Route::get('/faculty/show/pdf/{id}', [
    'uses' => 'FacultyController@pdfinfo',
          'as' => 'faculty_pdf_info'
  ]);

Route::get('/faculty/get/file/{id}', [
    'uses' => 'FacultyController@getfile_id',
          'as' => 'faculty_get-file-id'
  ]);

Route::get('/faculty/apply/certification', [
    'uses' => 'FacultyController@certification',
          'as' => 'facultycertification.page'
  ]);

Route::post('/faculty/apply/certification/requested/{id}',[
    'uses' => 'FacultyController@apply_certification',
    'as' => 'FacultyRequested'
]);

Route::get('/faculty/reapply/get/file/{id}', [
  'uses' => 'FacultyController@re_apply_getfile_id',
        'as' => 'faculty_reapply_get-file-id'
]);

Route::post('/faculty/re-apply/certification/requested/{id}', [
  'uses' => 'FacultyController@reApply',
        'as' => 'faculty.reapply.certification'
]);

Route::get('/faculty/application/status', [
    'uses' => 'FacultyController@application_status',
          'as' => 'faculty.application.status'
  ]);

Route::get('/faculty/application/status/{id}', [
    'uses' => 'FacultyController@show_application',
          'as' => 'faculty.get-specific-data'
  ]);

Route::get('/faculty/show/history/{id}', [
    'uses' => 'FacultyController@history',
          'as' => 'faculty_pdf_history'
  ]);

Route::get('/faculty/student-applications', [
    'uses' => 'FacultyController@students_application',
          'as' => 'faculty_student_applications'
  ]);

Route::get('/faculty/student-applications/{id}', [
    'uses' => 'FacultyController@students_application_specific',
          'as' => 'faculty_student_applications-specific'
  ]);

Route::get('/faculty/student-applications/technicalAdviser/approval/{id}', [
    'uses' => 'FacultyController@technicalAdviserApproval',
          'as' => 'technicalAdviserApproval'
  ]);

Route::post('/faculty/student-applications/technicalAdviser/approval/{id}/sent', [
    'uses' => 'FacultyController@sendingTechnicalAdviserApproval',
          'as' => 'technicalAdviserApprovalSent'
  ]);

Route::get('/faculty/student-applications/subjectAdviser/approval/{id}', [
    'uses' => 'FacultyController@subjectAdviserApproval',
          'as' => 'subjectAdviserApproval'
  ]);

Route::post('/faculty/student-applications/subjectAdviser/approval/{id}/sent', [
    'uses' => 'FacultyController@sendingSubjectAdviserApproval',
          'as' => 'subjectAdviserApprovalSent'
  ]);

Route::get('/faculty/citation', [
    'uses' => 'CitationController@facultyCitationCount',
          'as' => 'facultyCitationCount'
  ]);

Route::post('/faculty/citation/added', [
    'uses' => 'CitationController@facultyAddCitation',
          'as' => 'facultyAddCitation'
  ]);

Route::get('/faculty/citation/{id}', [
    'uses' => 'CitationController@facultyShowCitationInfo',
          'as' => 'facultySpecificCitation'
  ]);

Route::get('/faculty/citation/{id}/edit', [
    'uses' => 'CitationController@facultyEditCitationInfo',
          'as' => 'facultySpecificCitationEdit'
  ]);

Route::post('/faculty/citation/{id}/edit/updated', [
    'uses' => 'CitationController@facultyUpdateCitation',
          'as' => 'facultySpecificCitationUpdated'
  ]);

Route::get('/faculty/research-list', [
    'uses' => 'FacultyController@searchResearchList',
          'as' => 'searchResearchList'
  ]);

Route::get('/faculty/research-list/{id}', [
    'uses' => 'FacultyController@showResearchInfo',
          'as' => 'showResearchInfo'
  ]);

Route::get('/faculty/research/templates', [
    'uses' => 'FacultyController@researchTemplates',
          'as' => 'researchTemplates'
  ]);

Route::get('/faculty/extension/templates', [
    'uses' => 'FacultyController@extensionTemplates',
          'as' => 'extensionTemplates'
  ]);

Route::get('/homepage', [
    'uses' => 'LayoutsController@homepage',
          'as' => 'home'
  ]);

Route::get('/faculty/research-inventory', [
    'uses' => 'FacultyController@researchInventory',
          'as' => 'researchInventory'
  ]);

Route::post('/faculty/research-inventory/added', [
    'uses' => 'FacultyController@addResearch',
          'as' => 'faculty.addResearch'
  ]);

Route::get('/faculty/research-list/{id}/request-access', [
    'uses' => 'ResearchController@facultySendRequestAccess',
          'as' => 'faculty.request.access'
  ]);
  
Route::post('/faculty/research-list/request-access/sent', [
    'uses' => 'ResearchController@facultySendinRequestAccess',
          'as' => 'faculty.sending.request.access'
  ]);

//END OF FACULTY POV

Route::get('/applicationlist', [
    'uses' => 'RequestingFormController@application_list',
          'as' => 'application.list'
  ]);

Route::get('/', [
    'uses' => 'LayoutsController@navigation',
          'as' => 'navigation'
  ]);

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

Route::post('/admin/profile/avatar/changed', [
    'uses' => 'AdminController@changeavatar',
          'as' => 'admin_update_avatar'
  ]);

Route::post('/admin/profile/avatar/change-password', [
    'uses' => 'AdminController@changePassword',
          'as' => 'admin_change_password'
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

    $staff = DB::table('staff')
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

    return View::make('admin.announcement',compact('admin','staff','adminNotifCount','adminNotification'));

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

    $department = Department::orderBy('id')->get();

    return View::make('admin.addfaculty',compact('admin','department'));

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

Route::get('/application/status/certification/{id}', [
  'uses' => 'AdminController@admin_certification',
        'as' => 'admin-certification'
]);

Route::post('/application/status/certification/{id}/sent', [
    'uses' => 'AdminController@certification',
          'as' => 'certification'
  ]);

// Route::get('/events', [CalendarController::class, 'index']);
Route::get('/events', 'CalendarController@index')->name('events');
Route::post('/events/create', 'CalendarController@create_event')->name('create_event');
Route::post('/fullcalendars/update', [CalendarController::class, 'update']);
Route::delete('/fullcalendars/delete', [CalendarController::class, 'destroy']);

Route::post('/validate-password', 'StudentController@validatePassword')->name('validate.password');

Route::get('/admin/departmentlist', [
  'uses' => 'DepartmentController@index',
        'as' => 'department.list'
]);

Route::post('/admin/add/department', [
  'uses' => 'DepartmentController@add_department',
        'as' => 'admin.add.department'
]);

Route::get('/admin/departmentlist/{id}', [
  'uses' => 'DepartmentController@edit_department',
        'as' => 'admin.edit.department'
]);

Route::post('/admin/departmentlist/{id}/updated', [
  'uses' => 'DepartmentController@update_department',
        'as' => 'admin.update.department'
]);

Route::get('/administration', [
  'uses' => 'AdminController@administration',
        'as' => 'administration'
]);

Route::get('/administration/{id}/edit', [
  'uses' => 'AdminController@editAdministration',
        'as' => 'editAdministration'
]);

Route::post('/administration/{id}/edit/updated', [
    'uses' => 'AdminController@updateAdministration',
          'as' => 'updateAdministration'
  ]);

Route::get('/administration/edit/{id}/role', [
    'uses' => 'AdminController@editAdministrationRole',
          'as' => 'editAdministrationRole'
  ]);
  
Route::post('/administration/edit/{id}/role/updated', [
      'uses' => 'AdminController@updateAdministrationRole',
            'as' => 'updateAdministrationRole'
    ]);

Route::post('/administration/add', [
      'uses' => 'AdminController@addAdministration',
            'as' => 'addAdministration'
    ]);

Route::get('/certificate/tracking', [
      'uses' => 'AdminController@certificate_tracking',
            'as' => 'certificateTracking'
    ]);

Route::get('/certificate/tracking/{certId}', [
      'uses' => 'AdminController@show_certificate',
            'as' => 'certificate.get-specific-data'
    ]);

Route::post('/certificate/fetch-data', [
      'uses' => 'AdminController@fetchSpecificCertificate',
            'as' => 'certificateFetchData'
    ]);

Route::get('/qrcode', [QrCodeController::class, 'index']);

Route::get('/admin/userlist', [
  'uses' => 'AdminController@userlist',
        'as' => 'admin.userlist'
]);

Route::get('/admin/userlist/{id}', [
  'uses' => 'AdminController@showUserlistInfo',
        'as' => 'admin.showUserlistInfo'
]);

Route::post('/admin/userlist/{id}/update', [
  'uses' => 'AdminController@updateUserInfo',
        'as' => 'admin.updateUserlistInfo'
]);

Route::post('/admin/userlist/specific-role', [
  'uses' => 'AdminController@selectedSpecificRole',
        'as' => 'admin.userlist.specific-role'
]);

Route::get('/admin/applicationlist', [
  'uses' => 'AdminController@applicationlist',
        'as' => 'admin.applicationlist'
]);

Route::post('/admin/applicationlist/specific-status', [
  'uses' => 'AdminController@selectedSpecificStatus',
        'as' => 'admin.applicationlist.specific-status'
]);

Route::get('/admin/applicationlist/{id}', [
  'uses' => 'AdminController@showApplicationlistInfo',
        'as' => 'admin.applicationlist.show'
]);

Route::get('/admin/researchlist', [
  'uses' => 'AdminController@researchlist',
        'as' => 'admin.researchlist'
]);

Route::get('/admin/researchlist/{id}', [
  'uses' => 'AdminController@showResearchInfo',
        'as' => 'admin.researchlist.show'
]);

Route::post('/admin/researchlist/specific-department', [
  'uses' => 'AdminController@selectedSpecificDepartment',
        'as' => 'admin.researchlist.specific-department'
]);

Route::get('/userCountTable', [
  'uses' => 'PdfController@userCountTable',
        'as' => 'userCountTable.pdf'
]);

Route::get('/applicationsCountTable', [
  'uses' => 'PdfController@applicationsCountTable',
        'as' => 'applicationsCountTable.pdf'
]);

Route::get('/thesisTypeCountTable', [
  'uses' => 'PdfController@thesisTypeCountTable',
        'as' => 'thesisTypeCountTable.pdf'
]);

Route::get('/courseCountTable', [
  'uses' => 'PdfController@courseCountTable',
        'as' => 'courseCountTable.pdf'
]);

Route::get('/researchesDepartmentCountTable', [
  'uses' => 'PdfController@departmentCountTable',
        'as' => 'departmentCountTable.pdf'
]);

Route::get('/researchesCourseCountTable', [
  'uses' => 'PdfController@researchesCourseCountTable',
        'as' => 'researchesCourseCountTable.pdf'
]);

Route::get('/certificate/{control_id}', [
  'uses' => 'QrCodeController@landingPage',
        'as' => 'certificate.landingPage'
]);

Route::get('/student-research-access-requests', [
  'uses' => 'ResearchController@studentResearchAccessRequests',
        'as' => 'student.research.access.requests'
]);

Route::get('/student-research-access-requests/{id}', [
  'uses' => 'ResearchController@studentProcessingAccessFile',
        'as' => 'student.processing.access.request'
]);

Route::post('/student-research-access-requests/sent', [
  'uses' => 'ResearchController@studentSendingAccessFile',
        'as' => 'student.sending.access.file'
]);

Route::get('/faculty-research-access-requests', [
  'uses' => 'ResearchController@facultyResearchAccessRequests',
        'as' => 'faculty.research.access.requests'
]);

Route::get('/faculty-research-access-requests/{id}', [
  'uses' => 'ResearchController@facultyProcessingAccessFile',
        'as' => 'faculty.processing.access.request'
]);

Route::post('/faculty-research-access-requests/sent', [
  'uses' => 'ResearchController@facultySendingAccessFile',
        'as' => 'faculty.sending.access.file'
]);

Route::get('/admin/all/notifications', [
  'uses' => 'LayoutsController@adminNotifications',
        'as' => 'admin.all.notifications'
]);