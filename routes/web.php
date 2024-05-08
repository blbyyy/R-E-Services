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
Route::get('/csm-form/firsPage', [
      'uses' => 'ClientSatisfactionMeasurementController@firstPage',
            'as' => 'csm.page1'
    ]);

Route::post('/form-submit1', 'ClientSatisfactionMeasurementController@session1')->name('form.submit1');

Route::get('/csm-form/secondPage', [
      'uses' => 'ClientSatisfactionMeasurementController@secondPage',
            'as' => 'csm.page2'
    ]);

Route::post('/form-submit2', 'ClientSatisfactionMeasurementController@session2')->name('form.submit2');

Route::get('/csm-form/thirdPage', [
      'uses' => 'ClientSatisfactionMeasurementController@thirdPage',
            'as' => 'csm.page3'
    ]);

Route::post('/form-submit3', 'ClientSatisfactionMeasurementController@session3')->name('form.submit3');

Route::get('/csm-form/fourthPage', [
      'uses' => 'ClientSatisfactionMeasurementController@fourthPage',
            'as' => 'csm.page4'
    ]);

Route::post('/form-submit4', 'ClientSatisfactionMeasurementController@session4')->name('form.submit4');

Route::get('/csm-form/fifthPage', [
      'uses' => 'ClientSatisfactionMeasurementController@fifthPage',
            'as' => 'csm.page5'
    ]);

Route::get('/csm-form/sixthPage', [
      'uses' => 'ClientSatisfactionMeasurementController@sixthPage',
            'as' => 'csm.page6'
    ]);

Route::post('/form-submit5', 'ClientSatisfactionMeasurementController@session5')->name('form.submit5');

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

Route::get('/student/application/turnitin-proof-photos/{id}', [
      'uses' => 'StudentController@getTurnitinProofPhotos',
            'as' => 'student.get.application.turnitin-proof-proof.specific'
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

Route::get('/student/all/notifications', [
  'uses' => 'LayoutsController@studentNotifications',
        'as' => 'student.all.notifications'
]);

Route::get('/admin/research-proposal', [
      'uses' => 'ResearchProposalController@researchProposalList',
            'as' => 'admin.research-proposal'
    ]);

Route::get('/admin/research-proposal/{id}', [
      'uses' => 'ResearchProposalController@processingResearchProposal',
            'as' => 'admin.process.research-proposal'
    ]);

Route::post('/admin/research-proposal/sent', [
      'uses' => 'ResearchProposalController@sendingBackResearchProposal',
            'as' => 'admin.sending-back.research.proposal'
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

Route::get('/staff/all/notifications', [
    'uses' => 'LayoutsController@staffNotifications',
          'as' => 'staff.all.notifications'
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

Route::get('/faculty/all/notifications', [
    'uses' => 'LayoutsController@facultyNotifications',
          'as' => 'faculty.all.notifications'
  ]);

Route::get('/faculty/extension/schedule-appointment', [
    'uses' => 'AppointmentController@appointment1',
          'as' => 'faculty.extension.schedule.appointment1'
  ]);

Route::post('/faculty/extension/schedule-appointment1/sent', [
    'uses' => 'AppointmentController@facultySchedulingAppointment1',
          'as' => 'faculty.extension.schedule.appointment1.sent'
  ]);

Route::get('/faculty/extension/application', [
    'uses' => 'ExtensionController@facultyApplication',
          'as' => 'faculty.extension.application'
  ]);

Route::get('/faculty/extension/application/status', [
      'uses' => 'ExtensionController@facultyApplicationStatus',
            'as' => 'faculty.extension.application.status'
    ]);

Route::get('/faculty/extension/application/status/appointment/{id}', [
      'uses' => 'ExtensionController@getAppointment',
            'as' => 'faculty.extension.application.status.specific'
    ]);

Route::get('/faculty/extension/application/status/extension/files/{id}', [
      'uses' => 'ExtensionController@getFileExtension',
            'as' => 'faculty.extension.application.files.specific'
    ]);

Route::get('/faculty/extension/application/status/extension/documentation-photos/{id}', [
      'uses' => 'ExtensionController@getDoumentationPhotos',
            'as' => 'faculty.extension.application.documentation-photos.specific'
    ]);

Route::get('/faculty/extension/application/status/prototype/files/{id}', [
      'uses' => 'ExtensionController@getFilePrototype',
            'as' => 'faculty.extension.application.prototype.files.specific'
    ]);

Route::get('/faculty/extension/application/status/extension/prototype-photos/{id}', [
      'uses' => 'ExtensionController@getProtoypePhotos',
            'as' => 'faculty.extension.application.prototype-photos.specific'
    ]);

Route::post('/faculty/extension/application/created', [
      'uses' => 'ExtensionController@createApplication',
            'as' => 'faculty.extension.application.created'
    ]);

Route::get('/faculty/extension/application/proposal0/{id}', [
      'uses' => 'ExtensionController@proposal0ExtenxionId',
            'as' => 'faculty.extension.proposal0.id'
    ]);

Route::get('/faculty/extension/application/proposal1/{id}', [
    'uses' => 'ExtensionController@proposal1ExtenxionId',
          'as' => 'faculty.extension.proposal1.id'
  ]);

Route::post('/faculty/extension/application/proposal1/sent', [
    'uses' => 'ExtensionController@proposal1',
          'as' => 'faculty.extension.proposal1.sent'
  ]);

Route::get('/faculty/extension/application/proposal2/{id}', [
    'uses' => 'ExtensionController@proposal2ExtenxionId',
          'as' => 'faculty.extension.proposal2.id'
  ]);

Route::post('/faculty/extension/application/proposal2/sent', [
    'uses' => 'ExtensionController@proposal2',
          'as' => 'faculty.extension.proposal2.sent'
  ]);

Route::get('/faculty/extension/application/proposal3/{id}', [
    'uses' => 'ExtensionController@proposal3ExtenxionId',
          'as' => 'faculty.extension.proposal3.id'
  ]);

Route::post('/faculty/extension/application/proposal3/sent', [
    'uses' => 'ExtensionController@proposal3',
          'as' => 'faculty.extension.proposal3.sent'
  ]);

Route::get('/faculty/extension/application/proposal4/{id}', [
    'uses' => 'ExtensionController@proposal4ExtenxionId',
          'as' => 'faculty.extension.proposal4.id'
  ]);

Route::post('/faculty/extension/application/proposal4/sent', [
    'uses' => 'ExtensionController@proposal4',
          'as' => 'faculty.extension.proposal4.sent'
  ]);

Route::get('/faculty/extension/application/proposal5/{id}', [
    'uses' => 'ExtensionController@proposal5ExtenxionId',
          'as' => 'faculty.extension.proposal5.id'
  ]);

Route::post('/faculty/extension/application/proposal5/sent', [
    'uses' => 'ExtensionController@proposal5',
          'as' => 'faculty.extension.proposal5.sent'
  ]);

Route::get('/faculty/extension/application/proposal6/{id}', [
      'uses' => 'ExtensionController@proposal6ExtenxionId',
            'as' => 'faculty.extension.proposal6.id'
    ]);
  
Route::post('/faculty/extension/application/proposal6/sent', [
      'uses' => 'ExtensionController@proposal6',
            'as' => 'faculty.extension.proposal6.sent'
    ]);

Route::get('/faculty/extension/application/proposal7/{id}', [
      'uses' => 'ExtensionController@proposal7ExtenxionId',
            'as' => 'faculty.extension.proposal7.id'
    ]);
  
Route::post('/faculty/extension/application/proposal7/sent', [
      'uses' => 'ExtensionController@proposal7',
            'as' => 'faculty.extension.proposal7.sent'
    ]);

Route::get('/faculty/extension/application/proposal8/{id}', [
      'uses' => 'ExtensionController@proposal8ExtenxionId',
            'as' => 'faculty.extension.proposal8.id'
    ]);
  
Route::post('/faculty/extension/application/proposal8/sent', [
      'uses' => 'ExtensionController@proposal8',
            'as' => 'faculty.extension.proposal8.sent'
    ]);

Route::get('/faculty/extension/application/proposal9/{id}', [
      'uses' => 'ExtensionController@proposal9ExtenxionId',
            'as' => 'faculty.extension.proposal9.id'
    ]);
  
Route::post('/faculty/extension/application/proposal9/sent', [
      'uses' => 'ExtensionController@proposal9',
            'as' => 'faculty.extension.proposal9.sent'
    ]);

Route::get('/faculty/extension/application/proposal10/{id}', [
      'uses' => 'ExtensionController@proposal10ExtenxionId',
            'as' => 'faculty.extension.proposal10.id'
    ]);
  
Route::post('/faculty/extension/application/proposal10/sent', [
      'uses' => 'ExtensionController@proposal10',
            'as' => 'faculty.extension.proposal10.sent'
    ]);

Route::get('/faculty/extension/application/proposal11/{id}', [
      'uses' => 'ExtensionController@proposal11ExtenxionId',
            'as' => 'faculty.extension.proposal11.id'
    ]);
  
Route::post('/faculty/extension/application/proposal11/sent', [
      'uses' => 'ExtensionController@proposal11',
            'as' => 'faculty.extension.proposal11.sent'
    ]);

Route::get('/faculty/research-proposal', [
      'uses' => 'ResearchProposalController@researchProposal',
            'as' => 'faculty.research-proposal'
    ]);

Route::post('/faculty/research-proposal/sent', [
      'uses' => 'ResearchProposalController@uploadResearchProposal',
            'as' => 'faculty.research-proposal.sent'
    ]);

Route::get('/faculty/research-proposal/resbumit/{id}', [
      'uses' => 'ResearchProposalController@reSubmitProposalFetchingId',
            'as' => 'faculty.research-proposal.resubmit'
    ]);

Route::post('/faculty/research-proposal/resubmit/sent', [
      'uses' => 'ResearchProposalController@reUploadResearchProposal',
            'as' => 'faculty.research-proposal.resubmit.sent'
    ]);

Route::get('/faculty/research-proposal/{id}', [
      'uses' => 'ResearchProposalController@researchProposalStatus',
            'as' => 'faculty.research-proposal.status'
    ]);

Route::get('/faculty/research-proposal/sepcific/{id}', [
      'uses' => 'ResearchProposalController@gettingProposalFile',
            'as' => 'faculty.research-proposal.specific'
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
        ->where('status', 'not read')
        ->count();

      $adminNotification = DB::table('notifications')
        ->where('type', 'Admin Notification')
        ->orderBy('date', 'desc')
        ->take(4)
        ->get();

      $staffNotifCount = DB::table('notifications')
        ->where('type', 'Staff Notification')
        ->where('reciever_id', Auth::id())
        ->count();

      $staffNotification = DB::table('notifications')
        ->where('type', 'Staff Notification')
        ->where('reciever_id', Auth::id())
        ->orderBy('date', 'desc')
        ->take(4)
        ->get();

    return View::make('admin.announcement',compact('admin','staff','adminNotifCount','adminNotification','staffNotifCount','staffNotification'));

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

Route::get('/admin/extensionlist', [
      'uses' => 'AdminController@extensionlist',
            'as' => 'admin.extensionlist'
    ]);

Route::get('/userCountTable', [
  'uses' => 'PdfController@userCountTable',
        'as' => 'userCountTable.pdf'
]);

Route::get('/studentCountTable', [
      'uses' => 'PdfController@studentCountTable',
            'as' => 'studentCountTable.pdf'
    ]);

Route::get('/facultyCountTable', [
      'uses' => 'PdfController@facultyCountTable',
            'as' => 'facultyCountTable.pdf'
    ]);

Route::get('/researchCoordinatorCountTable', [
      'uses' => 'PdfController@researchCoordinatorCountTable',
            'as' => 'researchCoordinatorCountTable.pdf'
    ]);

Route::get('/staffAdminCountTable', [
      'uses' => 'PdfController@staffAdminCountTable',
            'as' => 'staffAdminCountTable.pdf'
    ]);

Route::get('/applicationsCountTable', [
  'uses' => 'PdfController@applicationsCountTable',
        'as' => 'applicationsCountTable.pdf'
]);

Route::post('/thesisTypeCountTable', [
  'uses' => 'PdfController@thesisTypeCountTable',
        'as' => 'thesisTypeCountTable.pdf'
]);

Route::post('/requestorTypeCountTable', [
      'uses' => 'PdfController@requestorTypeCountTable',
            'as' => 'requestorTypeCountTable.pdf'
    ]);

Route::post('/statusTypeCountTable', [
      'uses' => 'PdfController@statusTypeCountTable',
            'as' => 'statusTypeCountTable.pdf'
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

Route::post('/researchListByDepartmentAndYear', [
      'uses' => 'PdfController@researchListByDepartmentAndYear',
            'as' => 'researchListByDepartmentAndYear.pdf'
    ]);

Route::get('/researchesCountTable', [
      'uses' => 'PdfController@researchesCountTable',
            'as' => 'researchesCountTable.pdf'
    ]);

Route::get('/researchListByInputText', [
      'uses' => 'PdfController@researchListByInputText',
            'as' => 'researchListByInputText.pdf'
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

Route::get('/appointments', [
  'uses' => 'AppointmentController@appointments',
        'as' => 'appointments.list'
]);

Route::get('/appointments/proposal/{id}', [
  'uses' => 'AppointmentController@proposalAppointmentId',
        'as' => 'appointments.list.proposal'
]);

Route::post('/appointment/proposal/sent', [
      'uses' => 'AppointmentController@sendingAppointmentProposal',
            'as' => 'appointment.proposal.sent'
    ]);

Route::get('/appointments/implentation-proper/{id}', [
      'uses' => 'AppointmentController@implementationProperAppointmentId',
            'as' => 'appointments.list.implementation-proper'
    ]);

Route::post('/appointment/implentation-proper/sent', [
      'uses' => 'AppointmentController@sendingImplementationProperAppointment',
            'as' => 'appointment.implementation-proper.sent'
    ]);

Route::get('/appointments/pre-survey/{id}', [
      'uses' => 'AppointmentController@preSurveyAppointmentId',
            'as' => 'appointments.list.pre-survey'
    ]);

Route::post('/appointment/pre-survey/sent', [
      'uses' => 'AppointmentController@sendingAppointmentPreSurvey',
            'as' => 'appointment.pre-survey.sent'
    ]);

Route::get('/appointments/mid-survey/{id}', [
      'uses' => 'AppointmentController@midSurveyAppointmentId',
            'as' => 'appointments.list.mid-survey'
    ]);

Route::post('/appointment/mid-survey/sent', [
      'uses' => 'AppointmentController@sendingAppointmentMidSurvey',
            'as' => 'appointment.mid-survey.sent'
    ]);

Route::get('/admin/extension/proposal-list', [
  'uses' => 'ExtensionController@proposalList',
        'as' => 'admin.proposal.list'
]);

Route::get('/admin/extension/proposalList/proposal1/{id}', [
  'uses' => 'ExtensionController@proposal1Id',
        'as' => 'admin.proposallist.proposal1'
]);

Route::post('/admin/extension/proposal-list/sent1', [
  'uses' => 'ExtensionController@adminProposalApproval1',
        'as' => 'admin.proposal.list.specific.sent1'
]);

Route::get('/admin/extension/proposalList/proposal2/{id}', [
  'uses' => 'ExtensionController@proposal2Id',
        'as' => 'admin.proposallist.proposal2'
]);

Route::post('/admin/extension/proposal-list/sent2', [
  'uses' => 'ExtensionController@adminProposalApproval2',
        'as' => 'admin.proposal.list.specific.sent2'
]);

Route::get('/admin/extension/proposalList/proposal3/{id}', [
  'uses' => 'ExtensionController@proposal3Id',
        'as' => 'admin.proposallist.proposal3'
]);

Route::post('/admin/extension/proposal-list/sent3', [
  'uses' => 'ExtensionController@adminProposalApproval3',
        'as' => 'admin.proposal.list.specific.sent3'
]);

Route::get('/admin/extension/proposalList/proposal4/{id}', [
  'uses' => 'ExtensionController@proposal4Id',
        'as' => 'admin.proposallist.proposal4'
]);

Route::post('/admin/extension/proposal-list/sent4', [
  'uses' => 'ExtensionController@adminProposalApproval4',
        'as' => 'admin.proposal.list.specific.sent4'
]);

Route::get('/admin/extension/proposalList/proposal5/{id}', [
  'uses' => 'ExtensionController@proposal5Id',
        'as' => 'admin.proposallist.proposal5'
]);

Route::post('/admin/extension/proposal-list/sent5', [
  'uses' => 'ExtensionController@adminProposalApproval5',
        'as' => 'admin.proposal.list.specific.sent5'
]);

Route::get('/admin/extension/proposalList/proposal6/{id}', [
  'uses' => 'ExtensionController@proposal6Id',
        'as' => 'admin.proposallist.proposal6'
]);

Route::post('/admin/extension/proposal-list/sent6', [
  'uses' => 'ExtensionController@adminProposalApproval6',
        'as' => 'admin.proposal.list.specific.sent6'
]);

Route::get('/admin/extension/proposalList/proposal7/{id}', [
      'uses' => 'ExtensionController@proposal7Id',
            'as' => 'admin.proposallist.proposal7'
    ]);
    
Route::post('/admin/extension/proposal-list/sent7', [
      'uses' => 'ExtensionController@adminProposalApproval7',
            'as' => 'admin.proposal.list.specific.sent7'
    ]);

Route::get('/admin/printable-data', [
      'uses' => 'PdfController@printableData',
            'as' => 'admin.printable.data'
    ]);

Route::get('/admin/users-pending', [
      'uses' => 'AdminController@usersPending',
            'as' => 'admin.users.pending'
    ]);

Route::get('/admin/users-pending/{id}', [
      'uses' => 'AdminController@usersPendingId',
            'as' => 'admin.users.pending.specific'
    ]);

Route::post('/admin/users-pending/verified', [
      'uses' => 'AdminController@usersVerified',
            'as' => 'admin.users.pending.verified'
    ]);

Route::post('/admin/create-user', [
      'uses' => 'AdminController@createUserProfile',
            'as' => 'admin.create.user.profile'
    ]);

Route::get('/admin/reserch-proposal/list', [
      'uses' => 'AdminController@researchProposalslist',
            'as' => 'admin.research-proposal.list'
    ]);

Route::post('/admin/reserch-proposal/specific-research-type', [
      'uses' => 'AdminController@selectedSpecificResearchType',
            'as' => 'admin.reserch-proposal.specific-department'
    ]);

Route::post('/notification/is-read', [
      'uses' => 'LayoutsController@markAsRead',
            'as' => 'notifications.is-read'
    ]);

Route::get('/forms/customer-satisfaction-survey/first-page', [
      'uses' => 'CustomerSatisfactionSurveyController@index',
            'as' => 'forms.customer-satisfaction-survey'
    ]);

Route::post('/forms/customer-satisfaction-survey/second-page', 'CustomerSatisfactionSurveyController@session1')->name('forms.customer-satisfaction-survey.second-page');

Route::post('/forms/customer-satisfaction-survey/third-page', 'CustomerSatisfactionSurveyController@session2')->name('forms.customer-satisfaction-survey.third-page');

Route::get('/forms/customer-satisfaction-survey/submitted', [
      'uses' => 'CustomerSatisfactionSurveyController@submittedPage',
            'as' => 'forms.customer-satisfaction-survey.submitted'
    ]);

Route::get('/forms/community-survey-training-needs/first-page', [
      'uses' => 'AssessmentController@firstPage',
            'as' => 'forms.community-survey-training-needs'
    ]);

Route::post('/forms/community-survey-training-needs/second-page', 'AssessmentController@secondPage')->name('forms.community-survey-training-needs.second-page');

Route::post('/forms/community-survey-training-needs/third-page', 'AssessmentController@submiting')->name('forms.community-survey-training-needs.third-page');

Route::get('/forms/community-survey-training-needs/submitted', [
      'uses' => 'AssessmentController@submittedPage',
            'as' => 'forms.community-survey-training-needs.submitted'
    ]);

Route::post('/tryyys', [
      'uses' => 'ResearchProposalController@sendingResearchFile',
            'as' => 'ResearchProposalController.sendingResearchFile'
    ]);
