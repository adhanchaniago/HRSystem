<?php

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

Route::get('/', function () {return view('welcome');});
Route::get('/dashboard', 'UserController@ShowDashboard');

Route::get('/login', function(){return view('auth.login');});
Route::get('/register', function(){return view('auth.register');});


Route::get('/report', 'ReportController@ShowReport');
Route::get('/mailbox', 'UserController@ShowMailbox');
Route::post('/add-task', 'UserController@AddTask');
Route::post('/mailbox/new-message', 'UserController@ComposeMessage');
Route::get('/mailbox/{id}', 'UserController@ShowMessageDetails');

Route::get('/profile', 'UserController@ShowProfile');
Route::post('/profile/update-info', 'UserController@UpdatePersonalInfo');
Route::post('/profile/upload-document', 'DocumentController@UploadDocument');
Route::get('/profile/delete-document/{id}', 'DocumentController@DeleteDocument');
Route::post('/profile/update-career-info', 'UserController@UpdateCareerInfo');


Route::get('/job', 'JobController@ShowAllJob');
Route::post('/job/add-application-progress/{id}', 'JobController@AddApplicationProgress');

Route::post('/job/upload-progress-document/{id}', 'JobController@UploadProgressDocument');

Route::get('/job/applied-jobs', 'JobController@ShowAppliedJobs');
Route::get('/job/applied-jobs/{id}', 'JobController@AppliedJobDetails');
Route::post('/job/apply-job', 'ApplicantController@ApplyJob');

Route::post('/job/add-new-job', 'JobController@AddNewJob');
Route::get('/job/active', 'JobController@ShowActiveJob');
Route::get('/job/inactive', 'JobController@ShowInactiveJob');
Route::get('/job/{id}/applicants', 'ApplicantController@ShowJobApplicant');

Route::get('/job/details/{id}', 'JobController@JobDetail');
Route::get('/job/deactive-job/{id}', 'JobController@DeactiveJob');
Route::post('/job/reactive-job/{id}', 'JobController@ReactiveJob');
Route::get('/job/delete-job/{id}', 'JobController@DeleteJob');
Route::get('/job/delete-progress/{id}', 'JobController@DeleteProgress');

Route::get('/technical-test', 'JobController@ShowTechnicalTest');

Route::get('/member/list', 'UserController@ShowAllMember');
Route::post('/member/compare', 'UserController@CompareMember');


Route::get('/applicant/all-job', 'JobController@ShowApplicantByJob');
Route::post('/applicant/compare/{id}', 'ApplicantController@CompareApplicant');
Route::get('/applicant/list', 'ApplicantController@ShowAllApplicant');
Route::get('/applicant/{id}', 'ApplicantController@ShowApplicantDetails');
Route::post('/applicant/reject/{id}', 'ApplicantController@RejectApplicant');
Route::post('/applicant/proceed/{id}', 'ApplicantController@ProceedApplicant');

Route::get('/technical-test/{id}', 'ApplicantController@TechnicalTestDetail');
Route::post('/technical-test/update/{id}', 'ApplicantController@TechnicalTestUpdate');
Route::post('/technical-test/proceed/{id}', 'ApplicantController@TechnicalTestProceed');
Route::post('/technical-test/reject/{id}', 'ApplicantController@TechnicalTestReject');
Route::post('/technical-test/upload-answer/{id}', 'ApplicantController@UploadTestAnswers');

Route::get('/{reportType}/{id}/print', 'ApplicantController@ApplicantReportPrint');

Route::get('/interview/schedule', 'ApplicantController@ShowAllInterview');

Route::get('/interview/{id}', 'ApplicantController@InterviewDetail');
Route::get('/interview/session/{code}', 'ApplicantController@InterviewSession');
Route::post('/interview/completed/{id}', 'ApplicantController@InterviewCompleted');
Route::post('/interview/proceed/{id}', 'ApplicantController@InterviewProceed');
Route::post('/interview/reject/{id}', 'ApplicantController@InterviewReject');

Route::get('/interview/signer', 'ApplicantController@InterviewSigner');


//Route::post('/interview/session/{code}', 'ApplicantController@InterviewSession');

Route::get('/department', 'JobController@ShowAllDepartment');
Route::get('/department/update/{id}', 'JobController@UpdateDepartment');
Route::get('/department/delete/{id}', 'JobController@DeleteDepartment');
Route::post('/department/add-new-department', 'JobController@AddDepartment');

Route::post('/document/add-new-document-type', 'DocumentController@AddDocumentType');
Route::post('/document/delete-document-type/{id}', 'DocumentController@DeleteDocumentType');
Route::get('/document/applicant', 'DocumentController@ShowApplicantDocument');
Route::get('/document/recruiter', 'DocumentController@ShowRecruiterDocument');
Route::get('/document/type', 'DocumentController@ShowDocumentType');

Route::get('/logout', 'UserController@UserLogout');
Route::post('/login', 'UserController@UserSignIn');
Route::post('/register', 'UserController@UserRegister');

