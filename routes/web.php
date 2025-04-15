<?php

use App\Helpers\Helper;
use App\Http\Controllers\DPRTemplateController;
use App\Http\Controllers\DocumentDriveController;
use App\Http\Controllers\ErpDprMasterController;
use App\Http\Controllers\OrganizationServiceController;
use App\Http\Controllers\LoanProgress\AppraisalController;
use App\Http\Controllers\LoanProgress\ApprovalController;
use App\Http\Controllers\LoanProgress\AssessmentController;
use App\Http\Controllers\LoanProgress\LegalDocumentationController;
use App\Http\Controllers\LoanProgress\ProcessingFeeController;
use App\Http\Controllers\UserSignatureController;

use Illuminate\Support\Facades\Broadcast;
// se App\Http\Controllers\UMS\Admin\TimetableController;
use App\Http\Controllers\ums\Faculty\AttendenceController;
use App\Http\Controllers\ums\Faculty\ExternalMarksController;
use App\Http\Controllers\ums\Faculty\InternalMarksController;
use App\Http\Controllers\ums\Faculty\PracticalMarksController;
use App\Http\Controllers\ums\Faculty\LectureScheduleController;
use App\Http\Controllers\ums\Faculty\LoginController as FacultyLoginController;

use App\Http\Controllers\ums\Admin\Master\FacultyController;

use App\Http\Controllers\ums\Admin\UserController;
use App\Http\Controllers\ums\Admin\Master\ExamFeeAllController;
use App\Http\Controllers\ums\Admin\Master\ExamFeeAllController as MasterExamFeeAllController;
use App\Http\Controllers\ums\Admin\Master\ExamFeeAllController as challengeExamFeeAllController;
use App\Http\Controllers\ums\Admin\Master\CampusController;
use App\Http\Controllers\ums\Admin\InternalMarksMappingController;
use App\Http\Controllers\ums\Admin\Master\CategoryController;
use App\Http\Controllers\ums\Admin\Master\CourseController;
use App\Http\Controllers\ums\Admin\Master\DepartmentController;
use App\Http\Controllers\ums\SettingController;
use App\Http\Controllers\ums\Admin\BackPaperController;

use App\Http\Controllers\ums\Admin\Master\FeeController;
use App\Http\Controllers\ums\Admin\OldGradeController;
use App\Http\Controllers\ums\Admin\Master\SemesterController;
use App\Http\Controllers\ums\Admin\Master\StreamController;
use App\Http\Controllers\ums\Admin\TimetableController;
use App\Http\Controllers\ums\Admin\GrievanceController;
// use App\Http\Controllers\ums\Admin\UserController;
use App\Http\Controllers\ums\Admin\StudentController;
use App\Http\Controllers\ums\Admin\Master\SubjectController;
use App\Http\Controllers\ums\Admin\Master\AdmitCardController;

use App\Http\Controllers\ums\Admin\Master\ShiftController;
use App\Http\Controllers\ums\Admin\Master\PeriodController;
use App\Http\Controllers\ums\Admin\Master\EntranceExamConrtoller;
use App\Http\Controllers\ums\Admin\Master\EntranceExamScheduleController;
use App\Http\Controllers\ums\Admin\Master\ExamCenterController;
use App\Http\Controllers\ums\Admin\ApprovalSystemController;
use App\Http\Controllers\ums\Admin\Master\ExamScheduleController;
use App\Http\Controllers\ums\Admin\Master\NotificationController;
use App\Http\Controllers\ums\Report\BackReportController;
use App\Http\Controllers\ums\Report\RegularMarkFillingController;
use App\Http\Controllers\ums\Admin\MbbsTrController;
use App\Http\Controllers\ums\Affiliate\DashboardController;
use App\Http\Controllers\ums\Admin\Master\DepartmentFacaultiesController;
use App\Http\Controllers\ums\Admin\MbbsResultController;
use App\Http\Controllers\ums\Admin\TrController;
// use App\Http\Controllers\ums\SettingController;
use App\Http\Controllers\ums\Report\ReportController;
use App\Http\Controllers\ums\Admin\IcardsController;
use App\Http\Controllers\ums\Admin\ResultController;
use App\Http\Controllers\ums\Admin\ChallengeAllowedController;
// use App\Http\Controllers\ums\Admin\Master\FeeController;
// use App\Http\Controllers\ums\admin\OldGradeController;
use App\Http\Controllers\ums\Faculty\DashboardController as FacultyDashboardController;
use  App\Http\Controllers\ums\AdminController;
use App\Http\Controllers\ums\HomeController as UmsHomeController;
use App\Http\Controllers\ums\User\HomeController as UserHomeController;
use App\Http\Controllers\ums\Admin\Master\NotificationController as MasterNotificationController;
// use App\Http\Controllers\ums\Admin\Master\SemesterController

use App\Http\Controllers\LoanProgress\SanctionLetterController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HsnController;
use App\Http\Controllers\MrnController;
use App\Http\Controllers\LoanManagement\LoanDisbursementController;
use App\Http\Controllers\LoanManagement\LoanRecoveryController;
use App\Http\Controllers\LoanManagement\LoanSettlementController;
use App\Http\Controllers\FileTrackingController;
use App\Http\Controllers\FixedAsset\RegistrationController;
use App\Http\Controllers\FixedAsset\IssueTransferController;
use App\Http\Controllers\FixedAsset\InsuranceController;
use App\Http\Controllers\FixedAsset\MaintenanceController;

use App\Http\Controllers\ums\DashboardController as AdminDashboardController;
use App\Http\Controllers\ums\Student\LoginController;
use App\Http\Controllers\ums\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\ums\Student\IcardsController as StudentIcardsController;
use App\Http\Controllers\ums\Student\NotificationController as StudentNotificationController;
use App\Http\Controllers\ums\Student\SemesterController as StudentSemesterController;
use App\Http\Controllers\ums\Student\ExaminationController as StudentExaminationController;
use App\Http\Controllers\ums\Student\SemesterFeeController;
use App\Http\Controllers\ums\Student\SemesterFeeController as studentformsemesterFeeController;
use App\Http\Controllers\ums\Student\AdmitCardController as StudentAdmitCardController;


use App\Http\Controllers\TaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LandController;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ErpBinController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ErpRackController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\BookTypeController;
use App\Http\Controllers\ums\PaymentController;
// use App\Http\Controllers\CategoryController;

use App\Http\Controllers\StockAccountController;
use App\Http\Controllers\CogsAccountController;
use App\Http\Controllers\GrAccountController;
use App\Http\Controllers\SalesAccountController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ErpShelfController;
use App\Http\Controllers\ums\Admin\Master\AffiliateCircularController;
use App\Http\Controllers\ErpStoreController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\IssueTypeController;
use App\Http\Controllers\AmendementController;
use App\Http\Controllers\ProfitLossController;
use App\Http\Controllers\PaymentTermController;
use App\Http\Controllers\AutocompleteController;
use App\Http\Controllers\BalanceSheetController;
use App\Http\Controllers\ErpSaleOrderController;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\Ledger\GroupController;
use App\Http\Controllers\TrialBalanceController;
use App\Http\Controllers\Land\LandPlotController;
use App\Http\Controllers\Ledger\LedgerController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\ErpSaleInvoiceController;
use App\Http\Controllers\ErpSaleReturnController;
use App\Http\Controllers\PaymentVoucherController;
use App\Http\Controllers\ProductSectionController;
use App\Http\Controllers\ums\Admin\CourseSwitchingController;
use App\Http\Controllers\ApprovalProcessController;
use App\Http\Controllers\Land\LandParcelController;
use App\Http\Controllers\Land\LandReportController;
use App\Http\Controllers\MaterialReceiptController;
use App\Http\Controllers\DocumentApprovalController;
use App\Http\Controllers\Land\Lease\LeaseController;
use App\Http\Controllers\PurchaseOrder\PoController;
use App\Http\Controllers\HomeLoan\HomeLoanController;
use App\Http\Controllers\PurchaseIndent\PiController;
use App\Http\Controllers\TermLoan\TermLoanController;
use App\Http\Controllers\UserOrganizationsMappingController;
use App\Http\Controllers\ExpenseAdviseController;
use App\Http\Controllers\VehicleLoan\VehicleLoanController;
use App\Http\Controllers\TermsAndConditionController;
use App\Http\Controllers\InventoryReportController;
use App\Http\Controllers\BillOfMaterial\BomController;
use App\Http\Controllers\CostCenter\CostGroupController;
use App\Http\Controllers\ProductSpecificationController;
use App\Http\Controllers\CostCenter\CostCenterController;
use App\Http\Controllers\LoanManagement\LoanReportController;
use App\Http\Controllers\LoanManagement\LoanDisbursementReportController;
use App\Http\Controllers\LoanManagement\LoanRepaymentReportController;
// use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\LoanManagement\LoanDashboardController;
use App\Http\Controllers\LoanManagement\LoanManagementController;
use App\Http\Controllers\LoanManagement\LoanInterestRateController;
use App\Http\Controllers\LoanManagement\LoanFinancialSetupController;
use App\Http\Controllers\PurchaseOrder\PurchaseOrderReportController;
use Aap\Http\Controllers\ums\Admin\Master\QuestionBankController as StudentQuestionBankController;
use App\Http\Controllers\ums\Admin\Master\DepartmentFacaultiesControllery;
use App\Http\Controllers\ums\Admin\HolidayCalenderController;
use App\Http\Controllers\ums\Admin\AdmissionController;
// use App\Http\Controllers\ums\Admin\Master\EntranceExamScheduleController;
// use App\Http\Controllers\ums\report\ReportController;
use App\Http\Controllers\ums\Admin\CouncellingController;
use App\Http\Controllers\PurchaseBillController;
use App\Http\Controllers\DiscountMasterController;
use App\Http\Controllers\ExpenseMasterController;
use App\Http\Controllers\PurchaseReturnController;
//s
use App\Http\Controllers\ums\sports\SportsMasterController;
use App\Http\Controllers\ums\SportsController;
use App\Http\Controllers\ums\SportRegisterController;
//
use App\Http\Controllers\ums\sports\SportMasterController;

use App\Http\Controllers\ums\sports\GroupMasterController;


// use App\Http\Controllers\ums\sports\ActivityMasterController;

use App\Http\Controllers\ums\sports\SportFeeController;
use App\Http\Controllers\Auth\SportsForgotPasswordController;
use App\Http\Controllers\Auth\SportsResetPasswordController;

use App\Http\Controllers\ums\sports\Activity\ScreeningMasterController;
use App\Http\Controllers\ums\sports\Activity\ActivityMasterController;



// Password Reset Routes
Route::get('sports/password/reset', [SportsForgotPasswordController::class, 'showForgotForm'])->name('sports.password.request');
Route::post('sports/password/email', [SportsForgotPasswordController::class, 'sendResetLink'])->name('sports.password.email');
Route::get('sports/password/reset/{token}', [SportsForgotPasswordController::class, 'showResetForm'])->name('sports.password.reset');
Route::post('sports/password/reset', [SportsForgotPasswordController::class, 'resetPassword'])->name('sports.password.update');

Route::post('sport-type-add', [SportsMasterController::class, 'SportTypeAdd'])->name('sport-type-add');
Route::get('sport-type', [SportsMasterController::class, 'indexSportType'])->name('sport-type');
Route::get('sport-type-add', [SportsMasterController::class, 'showSportTypeAddForm'])->name('sport-type-add.form');
Route::get('sport-type-edit/{id}', [SportsMasterController::class, 'SportTypeEdit'])->name('sport-type-edit');
Route::put('sport-type-edit/{id}', [SportsMasterController::class, 'SportTypeUpdate'])->name('sport-type-update');
Route::get('sport-type-delete/{id}', [SportsMasterController::class, 'sportTypeDelete'])->name('sport-type-delete');
Route::post('/get-sections-by-batch', [SportRegisterController::class, 'getSectionsByBatch'])->name('get.sections.by.batch');


// Sports Routes
Route::group(['middleware' => ['sports']], function()
{
    Route::get('sports-students',function()
    {
        return view('ums.sports.students');
    });
    Route::get('/sport-registration', [SportRegisterController::class, 'registration'])->name('sports.registration');
    Route::get('/guidelines', [SportRegisterController::class, 'guidelines'])->name('sports.dashboard');
    Route::post('/sport-registration-post', [SportRegisterController::class, 'postRegistration'])->name('sport-registration-post');
    Route::put('/profile-registration-update/{id}', [SportRegisterController::class, 'profileRegistrationUpdate'])->name('profile-registration-update');
    Route::get('/sports/profile/{id}', [SportRegisterController::class, 'showProfile'])->name('sports.profile');
    Route::get('/update/registration/{id}', [SportRegisterController::class, 'profileRegistration'])->name('update.registration');
    Route::post('/get-batch-years-student', [SportRegisterController::class, 'get_batch_year'])->name('get.batch.year.student');
    Route::post('/get-batch-names-student', [SportRegisterController::class, 'get_batch_names'])->name('get.batch.names.student');
    Route::get('/get-quotas/{batchId}', [SportRegisterController::class, 'getQuotas']);
});
Route::get('/fetch-fee-structure', [SportRegisterController::class, 'fetchFeeStructure'])->name('fetch.fee.structure');
Route::put('/sport-registration-update/{id}', [SportRegisterController::class, 'postRegistrationUpdate'])->name('sport-registration-update');
Route::get('/edit-registration/{id}', [SportRegisterController::class, 'edit'])->name('edit-registration')->middleware(['admin_or_sports']);
Route::get('/view-registration/{id}', [SportRegisterController::class, 'viewRegistration'])->name('view-registration');
Route::get('/sports-students', [SportRegisterController::class, 'fetch'])->name('sports-students');
Route::get('/get-states/{countryId}', [SportRegisterController::class, 'getStates'])->name('get.states');
Route::get('/get-cities/{stateId}', [SportRegisterController::class, 'getCities'])->name('get.cities');
Route::post('update-payment',[SportRegisterController::class,'update_payment'])->name('update-payment');
Route::post('update-payment-status',[SportRegisterController::class,'update_payment_status'])->name('update-payment-status');

Route::post('/update-fee-mandatory-status',[SportRegisterController::class,'updateMandatoryStatus'])->name('update.fee.mandatory.status');

// Route::get('sports-registration',function(){
//     return view('ums.sports.registration');
// });
Route::get('sports-register/confirm-email',function(){
    return view('ums.sports.confirm_email');
});
Route::get('sports-registration-approve',function(){
    return view('ums.sports.registration_approve');
});
//  confirm payment
Route::get('sport-confirm-stu/{id}', [SportRegisterController::class,'confirm'])->name('sport-confirm-stu');

Route::get('sports-login',[SportRegisterController::class, 'login'])->name('sports.login');

Route::get('sports-register',function () 
{
    return view('ums.sports.register');
})->name('sports.register');
// Route::view('sport-master','ums.sports.sport_master');
// Route::view('sport-master-add','ums.sports.sport_master_add');
// Route::view('activity-master','ums.sports.activity.activity_master');
// Route::view('activity-master-add','ums.sports.activity.activity_master_add');

//blades
Route::view('activity-scheduler','ums.sports.activity.activity_scheduler');
Route::view('activity-scheduler-add','ums.sports.activity.activity_scheduler_add');
Route::view('activity-attendance','ums.sports.activity.activity_attendance');
Route::view('activity-assessment','ums.sports.activity.activity_assessment');
Route::view('mark-attendance','ums.sports.activity.mark_attendance');
Route::view('view-mark-attendance','ums.sports.activity.view_mark_attendance');
Route::view('view-mark-access','ums.sports.activity.view_mark_access');
Route::view('mark-assess','ums.sports.activity.mark_assess');

//blades



//register and login
Route::post('/sports-register', [SportsController::class, 'register'])->name('sports-register');
Route::post('/post-sports-login', [SportsController::class, 'login'])->name('post.sport.login');
Route::get('/sports-logout', [SportsController::class, 'logout'])->name('sport.logout');
Route::post('/verify-otp', [SportsController::class, 'verifyOTP'])->name('verify.otp');
Route::get('/verify-email', [SportsController::class, 'verifyEmail'])->name('verify.email');


// Activity Marter 

Route::get('activity-master', [ActivityMasterController::class, 'index'])->name('activity-master');
Route::get('activity-master-add', [ActivityMasterController::class, 'activityMaster'])->name('activity-master-add');
Route::get('activity-master-edit/{id}', [ActivityMasterController::class, 'ActivityEdit'])->name('activity-master-edit');
Route::get('activity-master-view/{id}', [ActivityMasterController::class, 'ActivityView'])->name('activity-master-view');
Route::post('activity-master-edit/{id}', [ActivityMasterController::class, 'ActivityUpdate'])->name('activity-master-edit');
Route::post('activity-master-add', [ActivityMasterController::class, 'activityMasterAdd'])->name('activity-master-add');
Route::get('activity-master-delete/{id}', [ActivityMasterController::class, 'ActivityDelete'])->name('activity-master-delete');



//Screening Master 

Route::get('screening-master',[ScreeningMasterController::class,'list']);
Route::get('screening-master-add',[ScreeningMasterController::class,'index'])->name('screening-master/add');
Route::post('screening-add',[ScreeningMasterController::class,'store'])->name('screening-add');
Route::get('screening-master-delete/{id}',[ScreeningMasterController::class,'screening_delete']);
// Route::post('screening-edit/{id}',[ScreeningMasterController::class,'store'])->name('screening-edit');
Route::post('screening-update/{id}', [ScreeningMasterController::class, 'update'])->name('screening.update');

Route::get('screening-master-edit/{id}',[ScreeningMasterController::class,'edit']);
Route::get('screening-master-view/{id}',[ScreeningMasterController::class,'viewpage']);





//sport master

Route::get('sport-master-add', [SportsMasterController::class, 'SportType'])->name('sport-master-add');
Route::post('sport-master-add', [SportsMasterController::class, 'SportMasterAdd']);
Route::get('sport-master', [SportsMasterController::class, 'indexSportMaster'])->name('sport-master');
Route::get('sport-master-edit/{id}', [SportsMasterController::class, 'SportMasterEdit'])->name('sport-master-edit');

Route::put('sport-master-edit/{id}', [SportsMasterController::class, 'SportMasterUpdate'])->name('sport-master-update');
Route::get('sport-master-delete/{id}', [SportsMasterController::class, 'softDelete']);
Route::get('sport-master-view/{id}', [SportsMasterController::class, 'SportMasterView'])->name('sport-master-view');


//fee master

// quota_master
Route::view('quota-master/add','ums.sports.master.quota_master_add');
Route::post('quota-add',[SportMasterController::class,'quota_add']);
Route::get('quota-master', [SportMasterController::class, 'quota_list'])->name('quota.index');
Route::get('quota-edit/{id}', [SportMasterController::class, 'edit'])->name('quota.edit');
Route::post('quota-update/{id}', [SportMasterController::class, 'quota_edit'])->name('quota.update');
Route::get('quota-delete/{id}', [SportMasterController::class, 'delete'])->name('quota.delete');


Route::post('/sports-fee-schedule/clone/{id}',[SportFeeController::class,'clone'])->name('sports-fee-schedule.clone');


Route::get('section-master/add',[SportMasterController::class,'section_index'])->name('section.add');

Route::post('section-add',[SportMasterController::class,'section_add']);

Route::get('section-master', [SportMasterController::class, 'section_list'])->name('section.index');

Route::get('section-edit/{id}', [SportMasterController::class, 'sec_edits'])->name('section.edit');

Route::post('section-update/{id}', [SportMasterController::class, 'section_edit'])->name('section.update');

Route::get('section-delete/{id}', [SportMasterController::class, 'sec_delete'])->name('section.delete');


Route::get('/master-batches', [SportMasterController::class, 'batch']);

Route::get('/master-batches-add', function () {
    return view('ums.sports.master.master_batches_add');
});

Route::post('/master-batches-add', [SportMasterController::class, 'store'])->name('batches-store');

Route::get('/master-batches-edit/{id}', [SportMasterController::class, 'batch_edit'])->name('batches-edit');

Route::put('/master-batches-update/{id}', [SportMasterController::class, 'update'])->name('batches-update');

Route::delete('/master-batches-delete/{id}', [SportMasterController::class, 'destroy'])->name('batches-destroy');


Route::get('/get-batch-names', [SportFeeController::class,'get_batch_name'])->name('get-batches-name');

Route::post('/get-batch-year', [SportFeeController::class, 'get_batch_year'])->name('get.batch.year');
Route::post('/get-batch-names', [SportFeeController::class, 'get_batch_names'])->name('get.batch.names');


Route::post('/get-section-names', [SportFeeController::class, 'get_section_names'])->name('section.fetch');
Route::post('/get-batch-names', [SportFeeController::class, 'get_batch_name'])->name('get-batches-name');

// import
Route::post('fee-import', [SportFeeController::class, 'import'])->name('excel.import');

//Group Master

Route::get('group-master',[GroupMasterController::class,'Index'])->name('group-master');

Route::post('group-master-add',[GroupMasterController::class,'GroupMasterAdd'])->name('group-master-add');
Route::get('group-master-add',[GroupMasterController::class,'GroupAdd'])->name('group-add');
Route::get('group-master-edit/{id}',[GroupMasterController::class,'GroupMasterEdit'])->name('group-master-edit');
Route::get('group-master-view/{id}',[GroupMasterController::class,'GroupMasterView'])->name('group-master-view');
Route::put('group-master-update/{id}',[GroupMasterController::class,'GroupMasterUpdate'])->name('group-master-update');
Route::get('group-master-delete/{id}', [GroupMasterController::class, 'GroupMasterDelete'])->name('group-master-delete');





//ums 
Route::get('/', [UmsHomeController::class, 'index'])->name('index');
Route::get('/ums-login', [UmsHomeController::class, 'umsLogin'])->name('ums.login');
Route::post('/post-ums-login', [UmsHomeController::class, 'postUmsLogin'])->name('post.ums.login');
Route::get('/admission-portal', [UmsHomeController::class, 'admissionPortal'])->name('admission-portal');
Route::post('/enquery-register', [UmsHomeController::class, 'enquery_register'])->name('enquery-register');
Route::post('/enquery-login', [UmsHomeController::class, 'enquery_login'])->name('enquery-login');
Route::post('forgot-password', [UmsHomeController::class, 'forgotPassword'])->name('user-forgot-password');
Route::get('forgot-password-change', [UmsHomeController::class, '@forgotPasswordChange'])->name('user-forgot-password-change');
Route::post('forgot-password-change', [UmsHomeController::class, '@forgotPasswordChangeSave']);

Route::get('user-dashboard', [UserHomeController::class, 'userDashboardAndProfile'])->name('user.dashboard');
Route::get('user-application-form', [UserHomeController::class, 'application_form'])->name('user-application-form');
Route ::post('/application-course-list',[UserHomeController::class,'applicationCourseList']);
Route ::post('/get-state',[UserHomeController::class,'get_state']);
Route ::post('/get-district',[UserHomeController::class,'get_district']);
Route::get('/education-single-row', [UserHomeController::class,'education_single_row'])->name('education-single-row');
Route::get('entrance-admit-card/{id}', [UserHomeController::class,'entranceAdmitCard']);
Route::post('application-form', [UserHomeController::class, 'applicationSave'])->middleware('auth');
Route::group(['middleware' => ['admin']], function () {
    Route::get('/sports-fee-schedule',[SportFeeController::class,'listing']);
    Route::get('/sports-fee-schedule/add',[SportFeeController::class,'index']);
    Route::post('fee-master/add',[SportFeeController::class,'store']);
    Route::get('/sports-fee-schedule/edit/{id}',[SportFeeController::class,'edit']);
    Route::get('/sports-fee-schedule/view/{id}',[SportFeeController::class,'ViewPage']);
    Route::post('sports-fee-schedule/update/{id}',[SportFeeController::class,'update']);
    Route::get('sports-fee-schedule/delete/{id}',[SportFeeController::class,'fee_delete']);

    //clone 
    Route::post('/sports-fee-schedule/clone/{id}',[SportFeeController::class,'clone'])->name('sports-fee-schedule-clone');

//    Route::post('application-form', [UserHomeController::class, 'applicationSave']);
Route::get('/ums-dashboard', [UmsHomeController::class, 'dashboard'])->name('ums.dashboard');
Route::post('/ums-logout', [UmsHomeController::class, 'logout'])->name('ums.logout');



    Route::post('login', [UmsHomeController::class, 'enquery_login'])->name('enquery-login');
    // Route::get('/dashboard', function () {
    //     return view('ums.dashboard');
    // });

    Route::get('/dashboard', [AdminDashboardController::class,'index'])->name('admin-dashboard');

    Route::get('/profile', function () {
        return view('ums.profile');
    });
    Route::get('/profile_edit', function () {
        return view('ums.profile_edit');
    });
    Route::get('/admin-meta', function () {
        return view('ums.admin.admin-meta');
    });


    //faculty 

    Route::get('faculty-secret-login/{id}', [FacultyLoginController::class,'secretLogin'])->name('faculty-secret-login');
    Route::get('/faculty',[FacultyController::class,'index'])->name('faculty');
    Route::get('faculty-dashboard', [FacultyDashboardController::class, 'index']);


    Route::get('/faculty_edit', function () {
        return view('ums.master.faculty.faculty_edit');
    });
    Route::get('/faculty_add', function () {
        return view('ums.master.faculty.faculty_add');
    });
    Route::get('/facultynotification', [FacultyNotificationController::class, 'index2']);
  
    Route::get('/Holiday', [HolidayCalenderController::class, 'holidayCalenderForStudent']);


    // Route::get('/time_table', function () {
    //     return view('ums.master.faculty.time_table');
    // });
    Route::get('/time_table', [TimetableController::class, 'index']);

    Route::get('/time_table_add', function () {
        return view('ums.master.faculty.time_table_add');
    });
    Route::post('/time_table_add', [TimetableController::class, 'addtimetable'])->name('get-timetables');
    Route::get('/time_table_add', [TimetableController::class, 'add']);

    // Route to show the edit form
    Route::get('/time_table_edit/{id}', [TimetableController::class, 'edittimetables'])->name('time_table_edit');

    // Route to handle the form submission for updating the timetable
    Route::post('/time_table', [TimetableController::class, 'editTimetable'])->name('get-timetables');
    Route::get('/attendance', [AttendenceController::class, 'index']);
    Route::get('/show_Attendance', [AttendenceController::class, 'searchAttendence']);


    Route::get('/lecture_schedule', function () {
        return view('ums.master.faculty.lecture_schedule');
    });
    // Route::get('/external_marks', function () {
    //     return view('ums.master.faculty.external_marks');
    // });
    Route::get('external_marks', [ExternalMarksController::class, 'external']);
    Route::post('external_marks', [ExternalMarksController::class, 'externalMarksShow']);

    // Route::get('/internal_marks', function () {
    //     return view('ums.master.faculty.internal_marks_filling');
    // });
    Route::get('internal_marks', [InternalMarksController::class, 'internal']);
    // Route::get('internal_marks', [InternalMarksController::class, 'internal']);

    // Route::get('/practical_marks_filling', function () {
    //     return view('ums.master.faculty.practical_marks');
    // });
    Route::get('practical_marks_filling', [PracticalMarksController::class, 'practicalMarksShow']);

    //usermanagement
    Route::get('secret-login/{id}', [LoginController::class, 'secretLogin'])->name('student-secret-login');

    Route::get('view-icard/{id}', [StudentIcardsController::class, 'singleIcard'])->name('view-icard');
    Route::get('icard-form/{type}', [StudentIcardsController::class, 'icardForm'])->name('icard-form');
    Route::post('icard-form', [StudentIcardsController::class, 'icardForm_Submit'])->name('icard-form-submit');



    Route::get('/stu-profile', [StudentDashboardController::class, 'profile'])->name('student-profile');
    Route::get('/stu-dashboard', [StudentDashboardController::class, 'index'])->name('student-dashboard');
    Route::get('stu-notification', [StudentNotificationController::class, 'showNotification'])->name('studentNotification');
    Route::get('calender', [StudentDashboardController::class, 'holidayCalenderForStudent'])->name('calender');
    Route::get('questionbankdownload', [StudentQuestionBankController::class, 'index'])->name('questionbankdownload');




    // Route::get('/stu-profile', [StudentDashboardController::class, 'profile'])->name('student-profile');
    // Route::get('/stu-dashboard', [StudentDashboardController::class, 'index'])->name('student-dashboard');
    




    Route::get('/user-password-change/{id}', [UserController::class, 'userPasswordChange'])->name('user-password-change');
    Route::get('/admin-get', [UserController::class, 'admins'])->name('usermanagement.admin');
    // Admin Edit Routes
    Route::get('/admin-edit', function () {
        return view('ums.usermanagement.admin.admin_edit');
    })->name('usermanagement.admin.edit');

    Route::get('admin-edit/{slug}', [UserController::class, 'editusers'])->name('usermanagement.admin.editget');
    Route::post('admin-edit-form', [UserController::class, 'editUser'])->name('usermanagement.admin.editform');
    // Admin Add Routes
    Route::get('/admin-add', function () {
        return view('ums.usermanagement.admin.admin_add');
    })->name('usermanagement.admin.add');
    Route::post('admin-add-form', [UserController::class, 'addUser'])->name('usermanagement.admin.addform');
    // Admin Delete Route
    Route::get('admin-delete-model-trim/{slug}', [UserController::class, 'softDelete'])->name('usermanagement.admin.delete');
    // User Secret Login Route
    Route::get('user-secret-login/{id}', [UmsHomeController::class, 'secretLogin'])->name('user-secret-login');
    // Email Template Management Routes
    Route::get('/email-template', [UserController::class, 'getTemplate'])->name('email.email-template');

    // Email Template Add Route
    Route::get('/email-template-add', function () {
        return view('ums.usermanagement.email.email_template_add');
    })->name('email.add');
    Route::post('email-add-form', [UserController::class, 'addEmailTemplate'])->name('email.addform');

    // Email Template Edit Routes
    Route::get('/email-template-edit', function () {
        return view('ums.usermanagement.email.email_template_edit');
    })->name('email.edit');
    Route::post('/email-edit-form', [UserController::class, 'EditEmailTemplate'])->name('email.editform');
    Route::get('/email-template/edit/{slug}', [UserController::class, 'editEmailTemplates'])->name('email.editget');

    // Email Soft Delete Route
    Route::get('email/delete-model-trim/{slug}', [UserController::class, 'EmailsoftDelete'])->name('usermanagement.email.delete');
    // student Route 
    Route::get('/student-hindi-name', [StudentController::class, 'studentHindiName']);
    Route::post('/student/save-email', [StudentController::class, 'updateEmail']);
    Route::get('/students', [StudentController::class, 'index'])->name('admin.student.index');
    Route::post('/user/edit-user-form', [UserController::class, 'editUser'])->name('edit-user-form');
    Route::get('/user/edit-user/{slug}', [UserController::class, 'editUsers']);
    Route::get('/users', [UserController::class, 'index'])->name('get-user');
    Route::get('view-application-form', [UserHomeController::class, 'view_application_form'])->name('view-application-form');
    Route::get('pay-success', [PaymentController::class, 'paymentSuccess'])->name('pay-success');

    Route::get('education-single-row', [UserHomeController::class, 'education_single_row'])->name('education-single-row');
    Route::get('add-application-form', [UserHomeController::class, 'add_application_form'])->name('add-application-form');
    Route::post('add-application-form', [UserHomeController::class, 'add_application_form_save']);

    Route::post('edit-application-form/{id}', 'User\HomeController@edit_application_form_save')->name('edit-application-form');
    Route::get('delete-application/{id}', 'User\HomeController@delApplication')->name('delete-application');
    Route::get('pay-now', [PaymentController::class, 'payNow'])->name('pay-now')/*->middleware('underMaintainance')*/;
    // Route::post('redirect-payment-getway', 'PaymentController@redirectPaymentGetway')->name('redirect-payment-getway');
    // Route::get('pay-success', 'PaymentController@paymentSuccess')->name('pay-success');
    // Route::post('pay-success', 'PaymentController@paymentSuccessSave')->name('pay-success-save');
    // Route::post('payment-save', 'PaymentController@paymentSave')->name('payment-save');

    Route::post('login', 'HomeController@enquery_login')->name('enquery-login');
    // Route::get('user-secret-login/{id}', 'HomeController@secretLogin')->name('user-secret-login');

    Route::get('activate-your-account/{email}', 'HomeController@activateYourAcc')->name('activate-again');
    Route::get('active-account/{id}', 'HomeController@active_account')->name('active-account');



    Route::get('/campus_list', [CampusController::class, 'index'])->name('campus_list');
    Route::post('/campus_list_add', [CampusController::class, 'addCampus'])->name('campus-list_add');
    Route::get('/campus_list_add', function () {
        return view('ums.master.campus_list.campus_list_add');
    });
    Route::get('/campus_list_delete/{id}', [CampusController::class, 'softDelete'])->name('campus_list_delete');
    // Route::get('/campus_list_edit', function () {
    //     return view('ums.master.campus_list.campus_list_edit');
    // });

    Route::get('/campus_list_edit/{id}', [CampusController::class, 'editcampuses'])->name('campus_list_edit');
    Route::put('/campus_list_edit', [CampusController::class, 'editCampus'])->name('campus_list_edit');

    Route::get('/category_list', [CategoryController::class, 'index'])->name('category_list');
    Route::get('/category_list_add', function () {
        return view('ums.master.category_list.category_list_add');
    });
    Route::post('/category_list_add', [CategoryController::class, 'addCategory'])->name('category_list_add');
    Route::get('/category_list_edit/{id}', [CategoryController::class, 'editcategories'])->name('category_list_edit');
    Route::put('/category_list_update', [CategoryController::class, 'editCategory'])->name('category_list_update');
    Route::get('/category_list_delete/{id}', [CategoryController::class, 'softDelete'])->name('category_list_delete');


    Route::get('/period_list', [PeriodController::class, 'index'])->name('get-periods');
    Route::get('/period_list_add', function () {
        return view('ums.master.period_list.period_list_add');
    });

    Route::post('/add-period', [PeriodController::class, 'addPeriod'])->name('add-period');

    Route::get('/period_list_edit/{id}', [PeriodController::class, 'editperiods'])->name('period_list_edit');

    Route::post('/period_list_edit', [PeriodController::class, 'editPeriod'])->name('update_period');

    Route::get('/exam_center_add', function () {
        return view('ums.master.exam_center.Exam_center_add');
    });

    Route::get('/exam_center/export', [ExamCenterController::class, 'examEenterExport']);
    Route::get('/exam_center', [ExamCenterController::class, 'index'])->name('exam_center');
    Route::post('/exam_center/add', [ExamCenterController::class, 'add']);
    Route::get('/exam_center_edit/{id}', [ExamCenterController::class, 'edit'])->name('Exam_center_edit');
    Route::put('/exam_center/update/{id}', [ExamCenterController::class, 'update'])->name('exam_center.update');

    Route::post('/exam_center/delete/{id}', [ExamCenterController::class, 'delete'])->name('exam_center.destroy');


    Route::get('/department_faculty', [DepartmentFacaultiesController::class, 'index'])->name('department_faculty');
    Route::get('/department_faculty/add', [DepartmentFacaultiesController::class, 'addPage'])->name('department_faculty_add');;
    Route::post('/department_faculty/add', [DepartmentFacaultiesController::class, 'add'])->name('department_facultyadd');
    Route::get('/department_faculty/edit/{id}', [DepartmentFacaultiesController::class, 'edit']);
    Route::put('/department_faculty/{id}', [DepartmentFacaultiesController::class, 'update'])->name('department_faculty.update');
    Route::get('/department_faculty/delete/{id}', [DepartmentFacaultiesController::class, 'delete'])->name('department_faculty.delete');

    Route::get('/department', [DepartmentController::class, 'index'])->name('get-department');
    Route::get('/department_add', [DepartmentController::class, 'addPage']);
    Route::post('/department_add', [DepartmentController::class, 'add']);
    Route::get('/department_edit/{id}', [DepartmentController::class, 'edit']);
    Route::put('/department_update/{id}', [DepartmentController::class, 'update']);
    Route::get('/department_delete/{id}', [DepartmentController::class, 'delete']);
    Route::get('/department_export', [DepartmentController::class, 'departmentExport']);

    Route::get('/subject_list', [SubjectController::class, 'index'])->name('subject_list');
    // Route::get('/subject_list/edit/{id}', [SubjectController::class, 'editsubjects'])->name('edit-subject');
    // Route::post('/subject_list/update/{id}', [SubjectController::class, 'editSubject'])->name('update-subject');
    Route::get('/subject_list_edit', function () {
        return view('ums.master.subject_list.subject_list_edit');
    });
    Route::get('/subject_add', function () {
        return view('ums.master.subject_list.subject_add');
    });
    Route::get('/subject_bulk_upload', function () {
        return view('ums.master.subject_list.subject_bulk_upload');
    });
    Route::get('subject_setting', [SubjectController::class, 'subject_settings']);
    Route::post('subject_setting', [SubjectController::class, 'subject_settingsSave']);

    // Route::get('/phd_entrance_exam', function () {
    //     return view('ums.master.entrance_exam.phd_entrance_exam');
    // });
    Route::get('/phd_entrance_add', function () {
        return view('ums.master.entrance_exam.phd_entrance_add');
    });
    // Route::get('/phd_entrance_edit', function () {
    //     return view('ums.master.entrance_exam.phd_entrance_edit');
    // })entrance-exam-schedule
    Route::get('/phd_entrance_exam', [EntranceExamScheduleController::class, 'index'])->name('phd-entrance-exam');
    // Route::get('/phd_entrance_exam', [EntranceExamScheduleController::class,'index'])->name('phd-entrance-exam');
    Route::post('/phd_entrance_post', [EntranceExamScheduleController::class, 'add'])->name('phd-entrance-exam_add');
    Route::get('/phd_entrance_edit/{id}', [EntranceExamScheduleController::class, 'edit'])->name('phd_entrance_edit');
    Route::put('/phd_entrance_update/{id}', [EntranceExamScheduleController::class, 'update'])->name('entrance_exam_update');
    Route::get('/phd_entrance_delete/{id}', [EntranceExamScheduleController::class, 'delete'])->name('phd_entrance_delete');

    Route::get('/entrance_exam', [EntranceExamConrtoller::class, 'index'])->name('get-entrance-exam');
    Route::get('/Entrance_exam_add', [EntranceExamConrtoller::class, 'add'])->name('add-entrance-exam');
    Route::POST('/Entrance_exam_add', [EntranceExamConrtoller::class, 'addEntranceExam'])->name('post-entrance-exam');


    Route::get('/shift_list', [ShiftController::class, 'index'])->name('get-shift');
    Route::post('/shift_add', [ShiftController::class, 'addShift'])->name('add_shift');
    Route::get('/shift_edit/{id}', [ShiftController::class, 'editshifts'])->name('shift_edit');
    Route::put('/shift_update', [ShiftController::class, 'editShift'])->name('update_shift');
    Route::post('/shift_add', [ShiftController::class, 'addShift'])->name('add_shift');
    Route::get('/shift_delete/{id}', [ShiftController::class, 'softDelete'])->name('delete_shift');
    Route::get('/shift_add', function () {
        return view('ums.master.shift.shift_add');
    });



    // Route::get('/notification', function () {
    //     return view('ums.master.notification.notification');
    // });


    Route::get('/semester_list', [SemesterController::class, 'index'])->name('semester_list');
    Route::post('/semester_list_add', [SemesterController::class, 'addSemester'])->name('semester_list_add');
    Route::get('/semester_list_add', [SemesterController::class, 'add'])->name('semester_list_add');
    // GET route (for showing the form to edit)

    // POST route (for submitting the form)
    Route::get('/semester_list_edit/{slug}', [SemesterController::class, 'editsemesters'])->name('semester_list_edit');

    Route::put('/semester_list_edit/{slug}', [SemesterController::class, 'editSemester'])->name('semester_list_update');
    Route::get('/semester_list_delete/{slug}', [SemesterController::class, 'softDelete'])->name('semester_list_delete');


    Route::get('/course_list', [CourseController::class, 'index'])->name('course_list');
    Route::get('/course_fee', function () {
        return view('ums.master.course.course_fees');
    });

    Route::get('/add_course', [CourseController::class, 'add'])->name('course_list_add');

    Route::post('/add_course', [CourseController::class, 'addCourse'])->name('course_list_add');
    Route::get('/course_list_edit/{id}', [CourseController::class, 'editcourses'])->name('course_list_edit');
    // Route::put('/course_list_update', [CourseController::class, 'editCourse'])->name('course_list_update');
    Route::get('/course_list_delete/{id}', [CourseController::class, 'softDelete'])->name('course_list_delete');
    // Route::get('/course_edit', function () {
    //     return view('ums.master.course.course_edit');
    // });

    Route::get('/affiliate_circular', [AffiliateCircularController::class, 'index']);
    Route::get('/affiliate_circular_add', [AffiliateCircularController::class, 'addView']);
    Route::post('/affiliate_circular_add', [AffiliateCircularController::class, 'add']);
    Route::get('/affiliate_circular_edit/{id}', [AffiliateCircularController::class, 'edit']);
    Route::get('/affiliate_circular_delete/{id}', [AffiliateCircularController::class, 'delete']);
    Route::put('/affiliate_circular_update/{id}', [AffiliateCircularController::class, 'update']);
    Route::get('/affiliate_circular_export', [AffiliateCircularController::class, 'affiliateCircularExport']);
    // Route::get('/affiliate_circular', function () {
    //     return view('ums.master.affiliate.affiliate_circular');
    // });
    Route::get('/affiliate_circular_edit', function () {
        return view('ums.master.affiliate.affiliate_circular_edit');
    });
    Route::get('/affiliate_circular_add', function () {
        return view('ums.master.affiliate.affiliate_circular_add');
    });


    Route::get('/question-bank/delete/{slug}', [QuestionBankController::class, 'softDelete'])->name('delete-question-bank');
    Route::get('/question-bank/edit/{slug}', [QuestionBankController::Class, 'editShow'])->name('edit-question-bank');
    Route::get('question-bank-list', [QuestionBankController::class, 'index'])->name('question-bank-list');

    Route::get('semester-form', [StudentSemesterController::class, 'index'])->name('semester-form');
    Route::get('exam-form', [StudentExaminationController::class, 'index'])->name('exam-form');

    Route::get('question_bank', [QuestionBankController::class, 'index'])->name('questionbankdownload');
    // Route::get('/add_question_bank', function () {
    //     return view('ums.master.question_bank.add_question_bank');
    // });
    Route::get('question_bank_add', [QuestionBankController::class, 'add'])->name('question-bank-add');
    Route::post('question_bank_add', [QuestionBankController::class, 'addQuestionBank'])->name('question-bank-save');

    Route::get('/holiday_calender', [HolidayCalenderController::class, 'holidayCalender'])->name('holiday_calender');

    // Route to save holiday data (POST method)
    Route::post('/holiday_calender/save', [HolidayCalenderController::class, 'holidayCalenderSave'])->name('holidayCalenderSave');

    Route::get('/holiday_calender/delete/{id}', [HolidayCalenderController::class, 'holidayCalenderDelete'])->name('holidayCalenderDelete');
    Route::get('/add_holiday_calender', function () {
        return view('ums.master.holiday_calender.add_holiday_calender');
    });


    Route::get('/add_grading', function () {
        return view('ums.master.grading.add_grading');
    });

    // Route::get('/fees_list' , [FeeController::class , 'index'])->name('fees_list');
    // Route::get('delete_fee/{id}',[FeeController::class , 'softDelete'])->name('delete_fee');
    Route::get('/fees_list', [FeeController::class, 'index'])->name('master.fees_list');
    Route::get('/add_fee_list', [FeeController::class, 'add']);
    Route::post('/submit-fee-form', [FeeController::class, 'addCourseSession']);
    Route::get('delete_fee/{id}', [FeeController::class, 'softDelete'])->name('delete_fee');

    Route::get('/fee_list_edit/{id}', [FeeController::class, 'editcoursesessions'])->name('fee_list_edit');
    Route::post('/edit-fee-form/{id?}', [FeeController::class, 'editCoursesession'])->name('edit-fee');

    Route::get('/old_grading', [OldGradeController::class, 'index']);
    Route::get('oldgrade_delete/{id}', [OldGradeController::class, 'oldgrade_delete'])->name('oldgrade_delete');
    // Route::get('/add_fee_list', function () {
    //     return view('ums.master.fee_list.add_fee_list');
    // });
    // Route::get('/fee_list_edit', function () {
    //     return view('ums.master.fee_list.fee_list_edit');
    // });


    Route::get('/stream_list', [StreamController::class, 'index'])->name('stream_list');
    Route::get('/add_stream_list', [StreamController::class, 'add'])->name('add_stream');  // For viewing the form
    Route::post('/add_stream_list', [StreamController::class, 'addStream'])->name('add_stream_list');  // For handling form submission
    Route::get('/stream_list_edit/{id}', [StreamController::class, 'editstreams'])->name('stream_list_edit');  // For handling form submission
    Route::put('/stream_list_update', [StreamController::class, 'editStream'])->name('stream_list_update');  // For handling form submission
    Route::get('/stream_list_delete/{id}', [StreamController::class, 'softDelete'])->name('stream_list_delete');  // For handling form submission




    //setting





    Route::get('/open_admission_edit_form', [SettingController::class, 'admissionSettingEdit'])->name('open_addmission_edit_form');

    Route::get('open_exam_form', [SettingController::class, 'index'])->name('open-exam-form');
    Route::post('open_exam_form', [SettingController::class, 'store']);
    Route::get('delete-from-setting/{id}', [SettingController::class, 'destroy']);

    Route::get('open_addmission_form', [SettingController::class, 'admissionSetting'])->name('open_addmission_form');
    Route::post('open_addmission_form', [SettingController::class, 'admissionSettingStore'])->name('open_addmission_form_Post');
    Route::get('delete-admission-setting/{id}', [SettingController::class, 'deleteAdmissionSetting']);

    //edit setting
    Route::get('/open_exam_form-edit', function () {
        return view('ums.setting.setting_edit.open_exam_form-edit');
    });


    Route::get('all_enrollment', [ReportController::class, 'all_enrollment_list'])->name('all-enrollment-list');
    Route::get('all-enrollment-list-export', [ReportController::class, 'enrollmentListExport'])->name('enrollmentListExport');

    Route::get('/mbbs_result', [MbbsResultController::class, 'mbbs_all_result'])->name('admin.all-mbbs-result');

    Route::get('/bulk_result', [MbbsResultController::class, 'mbbsResult'])->name('admin.mbbs-result');


    //reports//

    Route::get('Mbbs_bulk_result', [MbbsResultController::class, 'mbbsResult'])->name('Mbbs-bulk-result');

    Route::get('mark_sheet_position', [ReportController::class, 'marksheetPositionUpdate'])->name('marksheet-position-update');

    Route::get('cgpa_report', [ReportController::class, 'cgpaReport'])->name('reportscgpa_report');

    Route::get('/studying_student_report', [ReportController::class, 'studyingStudents'])->name('reports.studyingStudents');

    Route::get('/medal_list', [ReportController::class, 'medalListCgpa'])->name('reports.medal_list');

    Route::get('/scholarship_report', [ReportController::class, 'scholarshipReport'])->name('reports.scholarshipreport');

    Route::get('/scholarship_report_new', [ReportController::class, 'scholarshipReport1'])->name('reports.scholarshipreport1');

    Route::get('/passed_student_report', [ReportController::class, 'passedStudentReport'])->name('reports.passedstudentreport');

    Route::get('/pass_out_student_report', [ReportController::class, 'passOutStudentReport'])->name('reports.passout-student-report');

    Route::get('/nirf_report', function () {
        return view('ums.reports.nirf_report');
    });
    Route::get('/mbbs_security_report', [ReportController::class, 'scrutinyReport'])->name('mbbs_security_report');

    Route::get('Mark_Filling_Report', [ReportController::class, 'markFillingReport'])->name('markFillingReport');

    Route::get('/enrollment_report', [ReportController::class, 'allenrollreport'])->name('reports.allenrollmentReport');

    Route::get('/enrollment_summary', [ReportController::class, 'countEnrolledStudent'])->name('count-enrolled-report');

    Route::get('/disability_report_list', [ReportController::class, 'disabilityReport'])->name('reports.disabilityreport');

    Route::get('/digilocker_list', [ReportController::class, 'digilockerList'])->name('reports.digilockerList');

    Route::get('/digi_shakti_report', [ReportController::class, 'digiShaktiReport'])->name('reports.digishaktireport');

    Route::get('/degree_report_list', [ReportController::class, 'degreeListReport'])->name('reports.degreeListReport');

    Route::get('/chart_for_maximum_marks', [ReportController::class, 'chartForMaxMarks'])->name('reports.chartForMaxMarks');

    Route::get('/award_sheet_for_all', [ReportController::class, 'awardsheet'])->name('awardsheet-all');

    Route::get('/Application_Report', [ReportController::class, 'applicationReportList'])->name('Application_Report');
    Route::post('/get-course', 'Master\SubjectController@get_programm')->name('get-courses');
    Route::get('/all_studying_student', [ReportController::class, 'allstudyingStudents'])->name('allstudyingStudents');

    Route::get('/tr_summary', [ReportController::class, 'trSummary'])->name('tr_summary');

    Route::get('/regular_exam_form_report', [ReportController::class, 'regularPaperReport'])->name('reports.regular-exam-report');

    //studentform
    Route::get('/challengeform', function () {
        return view('ums.studentform.challengeForm');
    });
    //studentfees
    Route::get('/semester_fee', function () {
        return view('ums.studentfees.semester_fee');
    });
    // Route definition example:
    Route::get('semester-fee', [SemesterFeeController::class, 'index'])->name('semester-fee-index');
    Route::get('semester', [studentformsemesterFeeController::class, 'addfee'])->name('student-semesterfee');
    Route::post('semester', [studentformsemesterFeeController::class, 'addsemesterFee']);
    Route::get('/add_semesterfee', function () {
        return view('ums.studentfees.add_semesterfee');
    });

    Route::get('/edit_semesterfee', function () {
        return view('ums.studentfees.edit_semesterfee');
    });


    //result

    //---------------------------------------------route result

    Route::get('/award_sheet_report', function () {
        return view('ums.result.award_sheet_report');
    });
    Route::get('semester_result', [ResultController::class, 'view']);
    Route::get('/md_marksheet_list', [MdResultController::class, 'mdMarksheetList'])->name('md_marksheet_list');
    Route::get('/md_marksheet', [MdResultController::class, 'mdMarksheet'])->name('md_marksheet');
    Route::get('result_list', [ResultController::class, 'allResults'])->name('result_list');
    Route::get('tabulation-chart', [ReportController::class, 'tabulationChart'])->name('tabulationChart');
    Route::get('/md_tr_generate', [TrController::class, 'mdTrView'])->name('md-tr-view');
    Route::get('/regular_tr_view', [TrController::class, 'universityTrView'])->name('university-tr-view');
    Route::get('/regular_tr_generate', [TrController::class, 'index'])->name('university-tr');

    Route::get('/final_back_tr_generate', function () {
        return view('ums.result.final_back_tr_generate');
    });
    Route::get('/final_back_tr_view', function () {
        return view('ums.result.final_back_tr_view');
    });

    //-----------------------------------------end routes

    Route::get('/bulkuploads', function () {
        return view('ums.icards.bulkuploads');
    });

    Route::get('card_list', [IcardsController::class, 'icardList'])->name('card_list');
    Route::get('view-icard/{id}', [IcardsController::class, 'singleIcard'])->name('view-icard');
    Route::get('icard-form/{type}', [IcardsController::class, 'bulkIcardsFiles'])->name('icard-form');
    Route::post('icard-form-save/{type}', [IcardsController::class, 'bulkIcardsFilesSave'])->name('icard-form-save');
    Route::get('single-icard-delete/{id}', [IcardsController::class, 'singleIcardDelete'])->name('single-icard-delete');
    Route::get('single_icard', [IcardsController::class, 'singleIcard'])->name('single_icard');

    // Route::get('/single_icard', function () {
    //     return view('ums.icards.single_icard');
    // });
    Route::get('bulk_icard_print', [IcardsController::class, 'bulkIcardPrint'])->name('bulk-icard-print');


    //facultymapingsystem
    Route::get('faculty_mapping', [InternalMarksMappingController::class, 'index'])->name('faculty_mapping');
    Route::get('internal_mapping_edit/{id}', [InternalMarksMappingController::class, 'editShow']);
    Route::put('internal_mapping_update/{id}', [InternalMarksMappingController::class, 'update']);
    Route::get('internal_mapping_add', [InternalMarksMappingController::class, 'add']);
    Route::post('internal_mapping_add', [InternalMarksMappingController::class, 'add_mapping']);
    Route::post('/internal_mapping/get-subjects', [InternalMarksMappingController::class, 'get_Subject']);
    Route::post('/internal_mapping/get-semester', [InternalMarksMappingController::class, 'get_Semester']);
    Route::get('/internal_mapping/delete/{id}', [InternalMarksMappingController::class, 'softDelete']);
    // Route::get('/faculty_mapping', [InternalMarksMappingController::class, 'index'])->name('faculty_mapping');
    // Route::get('/faculty_mapping', [InternalMarksMappingController::class, 'internal'])->name('faculty_mapping');
    // Route::get('/internal_mapping_edit', function () {
    //     return view('ums.facultymapingsystem.internal_mapping_edit');
    // });
    // Route::get('/internal_mapping_add', function () {
    //     return view('ums.facultymapingsystem.internal_mapping_add');
    // });

    //exam

    Route::get('exam-fee', [ExaminationController::class, 'exam_fee'])->name('examination-fee');
    Route::post('exam-fee', [ExaminationController::class, 'exam_fee_submit'])->name('examination-fee');


    Route::get('back-paper-report', [BackReportController::class, 'index'])->name('back-report');
    Route::get('/regular_mark_filling', function () {
        return view('ums.exam.regular_mark_filling');
    });
    Route::post('exam-schedule-bulk-uploading', [ExamScheduleController::class, 'schedule_bulk_uploading'])->name('exam-schedule-bulk-uploading');
    Route::get('regular-mark-filling', [RegularMarkFillingController::class, 'regularMarkFilling'])->name('regularMarkFilling');
    Route::get('/Exam-list', [MasterExamFeeAllController::class, 'index'])->name('get-examfees');
    Route::get('/master/examfee/delete/{slug}', [MasterExamFeeAllController::class, 'resetPayment'])->name('delete_exam_form');
    Route::get('update-student-subjects/{id}', [ExaminationController::class, 'update_student_subjects'])->name('update-student-subjects');
    Route::get('admitcard-download/{id}', [AdmitCardController::class, 'adminCardView'])->name('download-admit-card');
    Route::get('/master/examfee/delete-regular-exam-form/{slug}', [MasterExamFeeAllController::class, 'deleteRegularExamForm'])->name('delete-regular-exam-form');
    Route::get('/master/examfee/view/{slug}', [MasterExamFeeAllController::class, 'view_exam_form'])->name('view_exam_form');
    Route::get('admitcard-download', [StudentAdmitCardController::class, 'index'])->name('download-admit-card');
    Route::get('/master/exam-edit-back/{slug}', [MasterExamFeeAllController::class, 'edit_exam_back_form'])->name('edit-back-exam-form');
    Route::get('/master/exam-edit-back-single/{slug}', [MasterExamFeeAllController::class, 'edit_exam_back_form_single'])->name('edit_exam_back_form_single');
    Route::post('/master/exam-edit-back/{slug}', [MasterExamFeeAllController::class, 'edit_exam_back_form_post']);
    Route::put('/master/exam-edit-back-update/{slug}', [MasterExamFeeAllController::class, 'edit_exam_back_form_update']);
    Route::get('/master/examfee', [MasterExamFeeAllController::class, 'index'])->name('get-examfees');
    Route::get('/master/exam-form/edit/{slug}', [MasterExamFeeAllController::class, 'edit_exam_form'])->name('edit-exam-form');
    Route::post('/master/exam-form/edit/{slug}', [MasterExamFeeAllController::class, 'edit_exam_form_post']);
    Route::get('student-login-redirect', [StudentController::class, 'studentLoginRedirect']);
    // Route::post('exam-form',[ExaminationController::class,'examinationForm'])->name('examination-form-submit');
    Route::get('exam-form-view/{slug}', [ExaminationController::class, 'StudentExamformview']);
    Route::get('check-eligibility', [BackReportController::class, 'checkEligibilityBackStudent'])->name('check-eligibility');
    Route::get('exam/pay-success', [ExaminationController::class, 'paymentSlip']);

    Route::get('/Exam_paper_approvel_system', function () {
        return view('ums.exam.Exam_paper_approvel_system');
    });
    Route::get('Exam-paper-approvel-system', [ApprovalSystemController::class, 'index'])->name('approval-system');
    Route::post('paper-allow-create', [ApprovalSystemController::class, 'store'])->name('paper-allow-create');
    // Route::post('paper-allowed-edit','ApprovalSystemController@update');
    Route::get('exam-approve-delete/{roll_no}', [ApprovalSystemController::class, 'destroy']);
    Route::get('bulk-back-paper', [BackPaperController::class, 'bulkBackPaper']);
    Route::post('bulk-back-paper', [BackPaperController::class, 'bulkBackPaperSave']);
    Route::get('Exam-Schedule', [ExamScheduleController::class, 'schedule_show'])->name('exam-schedule');
    Route::post('Exam-Schedule', [ExamScheduleController::class, 'schedule_post'])->name('exam-schedule');
    // Route::post('exam-schedule-bulk-uploading','Master\ExamScheduleController@schedule_bulk_uploading')->name('exam-schedule-bulk-uploading');
    Route::get('view-time-tables', [ExamScheduleController::class, 'timetable'])->name('examtime-table');
    Route::post('get-semester', [ExamScheduleController::class, 'get_Semester'])->name('semester');
    Route::post('/schedule-update', [ExamScheduleController::class, 'schedule_update'])->name('schedule-update');
    Route::get('mbbs-bscnursing-exam-report', [ReportController::class, 'mbbsBscNursingReport'])->name('mbbs-bscnursing-exam-report');
    Route::get('/reqular-exam-form-list', [BackReportController::class, 'regularExamFormReport']);

    Route::get('/time_table', [TimetableController::class, 'index']);


    //challengform
    Route::get('/allowed_student_for_challenge', [ChallengeAllowedController::class, 'index'])->name('allowed_student_for_challenge');
    Route::post('/allowed_student_for_challenge', [ChallengeAllowedController::class, 'store'])->name('challenge_allowed_create');

    Route::post('/challengeform_edit/{roll_no}', [ChallengeAllowedController::class, 'update'])->name('challenge_allowed_edit');
    Route::DELETE('/challenge-allowed-delete/{roll_no}', [ChallengeAllowedController::class, 'destroy'])->name('challenge-allowed-delete'); //update method get to DELETE

    Route::get('/challengeform_edit', function () {
        return view('ums.challengeform.challengeform_edit');
    });
    //admitcard
    // Route::get('/admit_card_list', function () {
    //     return view('ums.admitcard.admit_card_list');
    // });
    Route::get('/admit_card_list', [AdmitCardController::class, 'cardList'])->name('admit-card');
    Route::get('/admit_card_list_edit/{id}', [AdmitCardController::class, 'cardList'])->name('admit-card_edit');
    Route::put('/admit_card_list', [AdmitCardController::class, 'cardList'])->name('admit-card_update');
    Route::get('admit_card_delete/{id}', [AdmitCardController::class, 'deleteAdmitCard'])->name('admit_card_delete');

    // Route::get('/admit_card_edit', function () {
    //     return view('ums.admitcard.admit_card_edit');
    // });

    Route::get('/Bulk_Admit_Card_Approval', [AdmitCardController::class, 'bulk_approve'])->name('admit-card_edit');
    Route::post('/Bulk_Admit_Card_Approval', [AdmitCardController::class, 'bulk_approve_post'])->name('admit-card_update');
    //admissions
    Route::get('/admission_list', function () {
        return view('ums.admissions.admission_list');
    });

    Route::get('/council_data', [AdmissionController::class, 'counciledData'])->name('council-data');

    // Route::get('/course_transfer', [CourseSwitchingController::class, 'courseSwitching'])->name('course-transfer');
    // Route::POST('/course_transfer', [CourseSwitchingController::class, 'courseSwitchingSave']);
    Route::get('bulk_counselling', [CouncellingController::class, 'bulkCouncelling']);
    Route::get('/admission_counselling', [AdmissionController::class, 'applicationCouncil'])->name('admission-counselling');
    Route::POST('/admission_counselling', [AdmissionController::class, 'saveCouncil'])->name('admission-counselling_post');

    Route::get('/entrance_exam_schedule', [EntranceExamScheduleController::class, 'index'])->name('entrance-exam-schedule');
    Route::get('/enrolled_student', [AdmissionController::class, 'enrolledStudent'])->name('enrolled-student');


    //mbbs/para/nursing
    Route::get('/all_mbbs_result', [MbbsResultController::class, 'mbbs_all_result'])->name('all_mbbs_result');
    Route::get('/edit', function () {
        return view('ums.mbbsparanursing.edit');
    });

    Route::get('bpt_bmlt_tr', [MbbsTrController::class, 'bptBmltTr1'])->name('bptBmltTr1');
    // Route::get('/bpt_bmlt_tr', function () {
    //     return view('ums.mbbsparanursing.bpt_bmlt_tr');
    // });
    Route::get('/dpharma_tr', [MbbsTrController::class, 'dpharma_tr'])->name('dpharma_tr');
    Route::get('/mbbs_allowed_students', [MbbsTrController::class, 'mbbs_allowed_students'])->name('mbbs_allowed_students');
    // Route::get('/MBBS_RT_2019_2020_2020_2021', function () {
    //     return view('ums.mbbsparanursing.MBBS_RT_2019_2020_2020_2021');
    // });

    Route::get('MBBS_RT_2019_2020_2020_2021', [MbbsTrController::class, 'index_2019_2020And2020_2021'])->name('MBBS_RT_2019_2020_2020_2021');
    // Route::get('/MBBS_RT_2019_2020_2020_2021', [MbbsTrController::class, 'index_2019_2020And2020_2021'])->name('MBBS_RT_2019_2020_2020_2021');
    Route::post('saveExternalValue', [MbbsTrController::class, 'saveExternalValue'])->name('saveExternalValue');

    Route::get('mbbs_tr_third', [MbbsTrController::class, 'mbbs_tr_third'])->name('mbbs_tr_third');

    // Route::get('/mbbs_tr_third', function () {
    //     return view('ums.mbbsparanursing.mbbs_tr_third');
    // });

    // Route::get('/mbbs_tr', function () {
    //     return view('ums.mbbsparanursing.mbbs_tr');
    // });
    Route::get('/mbbs_tr', [MbbsTrController::class, 'index'])->name('mbbs_tr');

    Route::get('/bulk_result', function () {
        return view('ums.mbbsparanursing.bulk_result');
    });
    //affiliate_information
    // Route::get('/affiliate_information_view', function () {
    //     return view('ums.affiliate_information_view.affiliate_informations_view');
    // });

    Route::get('/affiliate_information_view', [DashboardController::class, 'information'])->name('affiliate_information_view');

    //grievance
    Route::get('grievance-complaint-list', [GrievanceController::class, 'complaintList']);
    Route::get('grievance', [GrievanceController::class, 'complaints']);
    Route::get('grievance-complaint-details', [GrievanceController::class, 'complaintDetails']);
    Route::post('grievance-complaint-details', [GrievanceController::class, 'complaintDetailsSave'])->name('complaintDetails.add');
});

















/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/clear', function () {
    Artisan::call('optimize:clear');
    return "Cleared!";
});
Route::get('/assign-menu', function () {
    $menuName = request()->menu_name ?? '';
    $menuAlias = request()->menu_alias ?? '';
    $serviceIds = request()->service_ids ?? '';
    if ($serviceIds) {
        $serviceIds = explode(',', $serviceIds);
    }
    return Helper::setMenuAccessToEmployee($menuName, $menuAlias, $serviceIds);
});


Route::get('/testing', [TestingController::class, 'testing']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/pos/report', [PurchaseOrderReportController::class, 'index'])->name('po.report');

Route::post('/broadcasting/auth', function (Illuminate\Http\Request $request) {
    return Broadcast::auth($request);
})->middleware(['user.auth']);



Route::middleware(['user.auth'])->group(function () {
    Route::get('/sales-order/create', [ErpSaleOrderController::class, 'create'])->name('sale.order.create');
    Route::get('/sales-quotation/create', [ErpSaleOrderController::class, 'create'])->name('sale.quotation.create');
    Route::post('/sales-order/store', [ErpSaleOrderController::class, 'store'])->name('sale.order.store');
    // Route::get('/sales-order/{type}', [ErpSaleOrderController::class, 'index'])->name('sale.order.index');
    Route::get('/sales-order', [ErpSaleOrderController::class, 'index'])->name('sale.order.index');
    Route::get('/sales-quotation', [ErpSaleOrderController::class, 'index'])->name('sale.quotation.index');
    Route::get('/sales-order/edit/{id}', [ErpSaleOrderController::class, 'edit'])->name('sale.order.edit');
    Route::get('/sales-quotation/edit/{id}', [ErpSaleOrderController::class, 'edit'])->name('sale.quotation.edit');
    Route::get('/sales-order/quotation', [ErpSaleOrderController::class, 'processQuotation'])->name('sale.order.quotation.get');
    Route::get('/sales-order/quotations/get', [ErpSaleOrderController::class, 'getQuotations'])->name('sale.order.quotation.get.all');
    Route::get('/customer/addresses/{customerId}', [ErpSaleOrderController::class, 'getCustomerAddresses'])->name('get_customer_addresses');
    Route::get('/item/attributes/{itemId}', [ErpSaleOrderController::class, 'getItemAttributes'])->name('get_item_attributes');
    Route::get('/customer/address/{id}', [ErpSaleOrderController::class, 'getCustomerAddress'])->name('get_customer_address');
    Route::get('/item/inventory/details', [ErpSaleOrderController::class, 'getItemDetails'])->name('get_item_inventory_details');
    Route::get('/item/store/details', [ErpSaleOrderController::class, 'getItemStoreData'])->name('get_item_store_details');
    Route::post('/address/customers/save', [ErpSaleOrderController::class, 'addAddress'])->name('sales_order.add.address');
    Route::get('/sale-order/generate-pdf/{id}', [ErpSaleOrderController::class, 'generatePdf'])->name('sale.order.generate-pdf');
    Route::get('/sales-order/amend/{id}', [ErpSaleOrderController::class, 'amendmentSubmit'])->name('sale.order.amend');
    Route::get('/sales-order/bom/check', [ErpSaleOrderController::class, 'checkItemBomExists'])->name('sale.order.bom.check');
    Route::post('/sales-order/revoke', [ErpSaleOrderController::class, 'revokeSalesOrderOrQuotation'])->name('sale.order.revoke');
    Route::get('/sales-invoice/amend/{id}', [ErpSaleInvoiceController::class, 'amendmentSubmit'])->name('sale.invoice.amend');
    Route::get('/sales-invoice/posting/get', [ErpSaleInvoiceController::class, 'getPostingDetails'])->name('sale.invoice.posting.get');
    Route::post('/sales-invoice/post', [ErpSaleInvoiceController::class, 'postInvoice'])->name('sale.invoice.post');
    Route::get('/sales-return/amend/{id}', [ErpSaleReturnController::class, 'amendmentSubmit'])->name('sale.return.amend');
    Route::get('/sales-return/posting/get', [ErpSaleReturnController::class, 'getPostingDetails'])->name('sale.return.posting.get');
    Route::post('/sales-return/post', [ErpSaleReturnController::class, 'postReturn'])->name('sale.return.post');
    Route::get('/', [HomeController::class, 'index'])->name('/');
    Route::post('/update-organization', [CustomerController::class, 'updateOrganization'])->name('update-organization');
    Route::post('/approveVoucher', [VoucherController::class, 'approveVoucher'])->name('approveVoucher');

    // Notification
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notification/read/{id}', [NotificationController::class, 'markAsRead'])->name('notification.read');
    Route::get('/notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.readAll');

    Route::post('uploadVouchers', [PaymentVoucherController::class, 'uploadVouchers'])->name('uploadVouchers');
    Route::get('receipt-vouchers/{type}', [PaymentVoucherController::class, 'index'])->name('paymentVoucher.receipt');
    Route::post('approvePaymentVoucher', [PaymentVoucherController::class, 'approvePaymentVoucher'])->name('approvePaymentVoucher');
    Route::post('getParties', [PaymentVoucherController::class, 'getParties'])->name('getParties');
    Route::get('paymentVouchersAmendment/{id}', [PaymentVoucherController::class, 'amendment'])->name('paymentVouchers.amendment');
    Route::resource('payments', PaymentVoucherController::class)->except(['show', 'destroy', 'edit']);
    Route::resource('receipts', PaymentVoucherController::class)->except(['show', 'destroy', 'edit']);
    Route::get('payments/{payment}/edit', [PaymentVoucherController::class, 'edit'])->name('payments.edit');
    Route::get('receipts/{payment}/edit', [PaymentVoucherController::class, 'edit'])->name('receipts.edit');
    Route::get('/payment-vouchers/voucher/get', [PaymentVoucherController::class, 'getPostingDetails'])->name('paymentVouchers.getPostingDetails');
    Route::post('/payment-vouchers/voucher/post', [PaymentVoucherController::class, 'postPostingDetails'])->name('paymentVouchers.post');
    Route::post('getExchangeRate', [ExchangeRateController::class, 'getExchangeRate'])->name('getExchangeRate');

    Route::post('getLedgerVouchers', [VoucherController::class, 'getLedgerVouchers'])->name('getLedgerVouchers');
    Route::get('/voucher', [VoucherController::class, 'index']);
    Route::post('/vouchers', [VoucherController::class, 'store'])->name('vouchers.store');
    Route::get('vouchersAmendment/{id}', [VoucherController::class, 'amendment'])->name('vouchers.amendment');
    // Route::get('/', [CustomerController::class, 'index'])->name('/');
    Route::get('getVoucherNo/{book_id}', [VoucherController::class, 'get_voucher_no'])->name('get_voucher_no');
    Route::get('getVoucherSeries/{id}', [VoucherController::class, 'get_series'])->name('get_voucher_series');
    Route::post('ledgersSearch', [VoucherController::class, 'ledgers_search'])->name('ledgers.search');
    Route::resource('vouchers', VoucherController::class)->except(['show', 'destroy']);
    Route::get('vouchers/getLedgerGroups', [VoucherController::class, 'getLedgerGroups'])->name('voucher.getLedgerGroups');


    Route::resource('ledger-groups', GroupController::class)->except(['show']);
    Route::get('/search/group', [GroupController::class, 'getLedgerGroup'])->name('groups.search');
    Route::resource('ledgers', LedgerController::class)->except(['show']);
    Route::get('/ledgers/{ledgerId}/groups', [LedgerController::class, 'getLedgerGroups'])->name('ledgers.groups');;
    Route::get('/search/ledger', [LedgerController::class, 'getLedger'])->name('ledger.search');



    Route::resource('cost-group', CostGroupController::class)->except(['show']);
    Route::resource('cost-center', CostCenterController::class)->except(['show']);

    Route::get('/city', [CityController::class, 'index']);

    Route::get('/vendor', [VendorController::class, 'index']);

    Route::get('/vendors/users', [VendorController::class, 'users']);

  
    Route::prefix('vendors')->controller(VendorController::class)->group(function () {
        Route::get('/', 'index')->name('vendor.index');
        Route::get('/create', 'create')->name('vendor.create');
        Route::post('/', 'store')->name('vendor.store');
        Route::get('/search', 'getVendor')->name('vendors.search');
        Route::get('/{id}', 'show')->name('vendor.show');
        Route::get('/{id}/edit', 'edit')->name('vendor.edit');
        Route::put('/{id}', 'update')->name('vendor.update');
        Route::delete('/{id}', 'destroy')->name('vendor.destroy');
        Route::delete('/vendor-items/{id}', 'deleteVendorItem')->name('vendor.vendor-item.destroy');
        Route::delete('/bank-info/{id}', 'deleteBankInfo')->name('vendor.bank-info.destroy');
        Route::delete('/contacts/{id}', 'deleteContact')->name('vendor.contacts.delete');
        Route::delete('/address/{id}', 'deleteAddress')->name('vendor.address.delete');
        Route::get('/states/{country_id}', 'getStates')->name('vendor.get.states');
        Route::get('/cities/{state_id}', 'getCities')->name('vendor.get.cities');
        Route::get('/{vendorId}/compliance-by-country/{countryId}', 'getComplianceByCountry');
        Route::get('/compliance/{id}', 'getComplianceById');
        Route::post('/get-uoms', 'getUOM')->name('send.uom');
    });


    Route::prefix('customers')->controller(CustomerController::class)->group(function () {
        Route::get('/', 'index')->name('customer.index');
        Route::get('/create', 'create')->name('customer.create');
        Route::post('/', 'store')->name('customer.store');
        Route::get('/search', 'getCustomer')->name('customers.search');
        Route::get('/{id}', 'show')->name('customer.show');
        Route::get('/{id}/edit', 'edit')->name('customer.edit');
        Route::put('/{id}', 'update')->name('customer.update');
        Route::delete('/{id}', 'destroy')->name('customer.destroy');
        Route::delete('/customer-items/{id}', 'deleteCustomerItem')->name('customer-item.destroy');
        Route::delete('/bank-info/{id}', 'deleteBankInfo')->name('customer.bank-info.destroy');
        Route::delete('/contacts/{id}', 'deleteContact')->name('customer.contacts.delete');
        Route::delete('/address/{id}', 'deleteAddress')->name('customer.address.delete');
        Route::get('/states/{country_id}', 'getStates')->name('customer.get.states');
        Route::get('/cities/{state_id}', 'getCities')->name('customer.get.cities');
        Route::get('/states/{country_id}', 'getStates');
        Route::get('/cities/{state_id}', 'getCities');
        Route::get('/{customerId}/compliance-by-country/{countryId}', 'getComplianceByCountry');
        Route::get('/compliance/{id}', 'getComplianceById');
    });

  
    Route::prefix('pos')->controller(PurchaseOrderReportController::class)->group(function () {
        Route::get('/report', 'index')->name('po.report');
    });


    // po report po.report
    Route::get('/get-attribute-values/{attributeId}', [PurchaseOrderReportController::class, 'getAttributeValues'])->name('po.report.getattributevalues');
    Route::get('/pos/report/filter', [PurchaseOrderReportController::class, 'getPurchaseOrdersFilter'])->name('po.report.filter');
    Route::post('/pos/add-scheduler', [PurchaseOrderReportController::class, 'addScheduler'])->name('po.add.scheduler');
    Route::get('/pos/report-send/mail', [PurchaseOrderReportController::class, 'sendReportMail'])->name('po.send.report');

    // Route::prefix('purchase-order')
    //     ->name('po.')
    Route::prefix('{type}')
        ->where(['type' => 'purchase-order|supplier-invoice'])
        ->name('po.')
        ->controller(PoController::class)
        ->group(function () {
            Route::get('revoke-document', 'revokeDocument')->name('revoke.document');
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            /*Shobhit Code*/
            Route::get('add-item-row', 'addItemRow')->name('item.row');
            Route::get('get-item-attribute', 'getItemAttribute')->name('item.attr');
            Route::get('add-discount-row', 'addDiscountRow')->name('item.discount.row');
            Route::get('/tax-calculation', 'taxCalculation')->name('tax.calculation');
            Route::get('/get-address', 'getAddress')->name('get.address');
            Route::get('/edit-address', 'editAddress')->name('edit.address');
            Route::get('/get-itemdetail', 'getItemDetail')->name('get.itemdetail');
            Route::post('/address-save', 'addressSave')->name('address.save');
            Route::delete('component-delete', 'componentDelete')->name('comp.delete');
            Route::get('/{id}/pdf', 'generatePdf')->name('generate-pdf');
            Route::get('amendment-submit/{id}', 'amendmentSubmit')->name('amendment.submit');
            Route::get('get-purchase-indent', 'getPi')->name('get.pi');
            Route::get('process-pi-item', 'processPiItem')->name('process.pi-item');

            /*Remove data*/
            Route::delete('remove-dis-item-level', 'removeDisItemLevel')->name('remove.item.dis');
            Route::delete('remove-dis-header-level', 'removeDisHeaderLevel')->name('remove.header.dis');
            Route::delete('remove-exp-header-level', 'removeExpHeaderLevel')->name('remove.header.exp');
        });

    Route::prefix('purchase-indent')
        ->name('pi.')
        ->controller(PiController::class)
        ->group(function () {
            Route::get('revoke-document', 'revokeDocument')->name('revoke.document');
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('add-item-row', 'addItemRow')->name('item.row');
            Route::get('get-item-attribute', 'getItemAttribute')->name('item.attr');
            Route::get('/get-itemdetail', 'getItemDetail')->name('get.itemdetail');
            Route::get('/{id}/pdf', 'generatePdf')->name('generate-pdf');

            Route::get('get-so', 'getSo')->name('get.so');
            Route::get('process-so-item', 'processSoItem')->name('process.so-item');
            Route::get('process-so-item-submit', 'processSoItemSubmit')->name('process.so-item.submit');
        });
    // Route::prefix('pos')->controller(PurchaseOrderReportController::class)->group(function () {
    //     Route::get('/report', 'index')->name('po.report');
    // });
    //Route::get('/pos/report', [PurchaseOrderReportController::class, 'index'])->name('po.report');
    // Route::get('/test', function () {
    //     return 'Test route works!';
    // })->name('po.report');


    Route::prefix('items')->controller(ItemController::class)->group(function () {
        Route::get('get-cost', 'getItemCost')->name('items.get.cost');
        Route::get('/', 'index')->name('item.index');
        Route::get('/create', 'create')->name('item.create');
        Route::post('/', 'store')->name('item.store');
        Route::get('/import', 'showImportForm')->name('items.import');
        Route::post('/import', 'import');
        Route::post('/generate-item-code', 'generateItemCode')->name('generate-item-code');
        Route::get('/search', 'getItem')->name('items.search');
        Route::get('/{id}', 'show')->name('item.show');
        Route::get('/{id}/edit', 'edit')->name('item.edit');
        Route::put('/{id}', 'update')->name('item.update');
        Route::delete('/{id}', 'destroy')->name('item.destroy');
        Route::delete('/alternate-uom/delete/{id}', 'deleteAlternateUOM')->name('items.alternate-uom.delete');
        Route::delete('/approved-customer/delete/{id}', 'deleteApprovedCustomer')->name('items.approved-customer.delete');
        Route::delete('/approved-vendor/delete/{id}', 'deleteApprovedVendor')->name('items.approved-vendor.delete');;
        Route::delete('/attribute/delete/{id}', 'deleteAttribute')->name('items.attribute.delete');
        Route::delete('/alternate-item/delete/{id}', 'deleteAlternateItem')->name('items.alternate-item.delete');
        Route::post('/get-uom', 'getUOM')->name('send.uom');
    });

    Route::prefix('hsn')->controller(HsnController::class)->group(function () {
        Route::get('/', 'index')->name('hsn.index');
        Route::get('/create', 'create')->name('hsn.create');
        Route::post('/', 'store')->name('hsn.store');
        Route::get('/{id}/edit', 'edit')->name('hsn.edit');
        Route::put('/{id}', 'update')->name('hsn.update');
        Route::delete('/{id}', 'destroy')->name('hsn.destroy');
        Route::delete('/hsn-detail/{id}', 'deleteHsnDetail')->name('hsn-detail.delete');
    });

    Route::prefix('categories')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index')->name('categories.index');
        Route::get('/create', 'create')->name('categories.create');
        Route::post('/', 'store')->name('categories.store');
        Route::get('/{id}/edit', 'edit')->name('categories.edit');
        Route::put('/{id}', 'update')->name('categories.update');
        Route::delete('/{id}', 'destroy')->name('categories.destroy');
        Route::delete('/subcategory/{id}', 'deleteSubcategory')->name('subcategory.delete');
        Route::get('/subcategories/{categoryId}', 'getSubcategories')->name('categories.subcategory');
    });

    Route::prefix('payment-terms')->controller(PaymentTermController::class)->group(function () {
        Route::get('/', 'index')->name('payment-terms.index');
        Route::post('/', 'store')->name('payment-terms.store');
        Route::get('/create', 'create')->name('payment-terms.create');
        Route::get('/{id}/edit', 'edit')->name('payment-terms.edit');
        Route::get('/{id}', 'show')->name('payment-terms.show');
        Route::put('/{id}', 'update')->name('payment-terms.update');
        Route::delete('/payment-term-detail/{id}', 'deletePaymentTermDetail')->name('payment-term-detail.delete');
        Route::delete('/{id}', 'destroy')->name('payment-terms.destroy');
        Route::get('/{categoryId}/sub-payment-terms', 'getSubPaymentTerms')->name('payment-terms.sub-payment-terms');
    });

    Route::prefix('units')->controller(UnitController::class)->group(function () {
        Route::get('/', 'index')->name('units.index');
        Route::get('/create', 'create')->name('units.create');
        Route::post('/', 'store')->name('units.store');
        Route::get('/{id}', 'show')->name('units.show');
        Route::get('/{id}/edit', 'edit')->name('units.edit');
        Route::put('/{id}', 'update')->name('units.update');
        Route::delete('/{id}', 'destroy')->name('units.destroy');
    });

    Route::prefix('erp-document')->controller(DocumentController::class)->group(function () {
        Route::get('/', 'index')->name('documents.index');
        Route::get('/create', 'create')->name('documents.create');
        Route::post('/', 'store')->name('documents.store');
        Route::get('/{id}', 'show')->name('documents.show');
        Route::get('/{id}/edit', 'edit')->name('documents.edit');
        Route::put('/{id}', 'update')->name('documents.update');
        Route::delete('/{id}', 'destroy')->name('documents.destroy');
    });

    Route::prefix('attributes')->controller(AttributeController::class)->group(function () {
        Route::get('/', 'index')->name('attributes.index');
        Route::get('/create', 'create')->name('attributes.create');
        Route::post('/store', 'store')->name('attributes.store');
        Route::get('/{group_id}', 'getAttributesByGroup')->name('attributes.byGroup');
        Route::get('/{id}', 'show')->name('attributes.show');
        Route::get('/{id}/edit', 'edit')->name('attributes.edit');
        Route::put('/{id}', 'update')->name('attributes.update');
        Route::delete('/attributes-detail/{id}', 'deleteAttributeDetail')->name('attribute-detail.delete');
        Route::delete('/{id}', 'destroy')->name('attributes.destroy');
    });

    // ErpDprTemplateMaster
    Route::prefix('dpr-templates')->name('dpr-template.')->controller(DPRTemplateController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}/update', 'update')->name('update');
    });

    // ErpDprMaster
    Route::prefix('dpr-master')->name('dpr-master.')->controller(ErpDprMasterController::class)->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}/update', 'update')->name('update');
        // Route::get('/{group_id}', 'getAttributesByGroup')->name('attributes.byGroup');
        // Route::get('/{id}', 'show')->name('attributes.show');
        // Route::get('/{id}/edit', 'edit')->name('attributes.edit');
        // Route::put('/{id}', 'update')->name('attributes.update');
        // Route::delete('/attributes-detail/{id}', 'deleteAttributeDetail')->name('attribute-detail.delete');
        // Route::delete('/{id}', 'destroy')->name('attributes.destroy');
    });

    Route::prefix('stock-accounts')->controller(StockAccountController::class)->group(function () {
        Route::get('/', 'index')->name('stock-accounts.index');
        Route::post('/', 'store')->name('stock-accounts.store');
        Route::get('test-ledger', 'testLedgerGroupAndLedgerId');
        Route::delete('/{id}', 'destroy')->name('stock-accounts.destroy');
        Route::get('organizations/{companyId}', 'getOrganizationsByCompany');
        Route::get('data-by-organization/{organizationId}', 'getDataByOrganization');
        Route::get('items-and-subcategories-by-category', 'getItemsAndSubCategoriesByCategory');
        Route::get('items-by-subcategory', 'getItemsBySubCategory');
        Route::get('ledgers-by-organization/{organizationId}', 'getLedgersByOrganization');
        Route::get('categories-by-organization/{organizationId}', 'getCategoriesByOrganization');
        Route::get('sub-categories-by-category/{categoryId}', 'getSubcategoriesByCategory');
        Route::get('ledgers-by-group', 'getLedgerGroupByLedger');
    });

    Route::prefix('cogs-accounts')->controller(CogsAccountController::class)->group(function () {
        Route::get('/', 'index')->name('cogs-accounts.index');
        Route::post('/', 'store')->name('cogs-accounts.store');
        Route::delete('/{id}', 'destroy')->name('cogs-accounts.destroy');
        Route::get('/test-ledger', 'testLedgerGroupAndLedgerId')->name('cogs-accounts.test-ledger');
    });

    Route::prefix('gr-accounts')->controller(GrAccountController::class)->group(function () {
        Route::get('/', 'index')->name('gr-accounts.index');
        Route::post('/', 'store')->name('gr-accounts.store');
        Route::delete('/{id}', 'destroy')->name('gr-accounts.destroy');
        Route::get('/test-ledger', 'testLedgerGroupAndLedgerId')->name('gr-accounts.test-ledger');
    });


    Route::prefix('sales-accounts')->controller(SalesAccountController::class)->group(function () {
        Route::get('/', 'index')->name('sales-accounts.index');
        Route::post('/', 'store')->name('sales-accounts.store');
        Route::delete('/{id}', 'destroy')->name('sales-accounts.destroy');
        Route::get('test-ledger', 'testLedgerGroupAndLedgerId');
        Route::get('organizations/{companyId}', 'getOrganizationsByCompany');
        Route::get('data-by-organization/{organizationId}', 'getDataByOrganization');
        Route::get('customer-subcategories-by-category', 'getCustomerAndSubCategoriesByCategory');
        Route::get('customer-by-subcategory', 'getCustomerBySubCategory');
        Route::get('item-subcategories-by-category', 'getItemsAndSubCategoriesByCategory');
        Route::get('items-by-subcategory', 'getItemsBySubCategory');
        Route::get('ledgers-by-organization/{organizationId}', 'getLedgersByOrganization');
        Route::get('categories-by-organization/{organizationId}', 'getCategoriesByOrganization');
        Route::get('subcategories-by-category/{categoryId}', 'getSubcategoriesByCategory');
        Route::get('ledgers-by-group', 'getLedgerGroupByLedger');
    });

    Route::get('/loan', [LoanController::class, 'index']);
    Route::get('/bookType', [BookTypeController::class, 'index'])->name('book-type.index');
    Route::get('/bookType/create', [BookTypeController::class, 'create_bookType'])->name('bookType.create');
    Route::post('/bookType/store', [BookTypeController::class, 'store'])->name('bookTypeStore');
    Route::get('/bookType/edit/{id}', [BookTypeController::class, 'edit_bookType'])->name('bookTypeEdit');
    Route::post('/bookType/update/{id}', [BookTypeController::class, 'update_bookType'])->name('book-type.update');
    Route::get('/bookType/delete/{id}', [BookTypeController::class, 'destroy_bookType'])->name('book-type.delete');


    Route::get('/org-services', [OrganizationServiceController::class, 'index'])->name('org-services.index');
    Route::get('/org-services/edit/{id}', [OrganizationServiceController::class, 'edit'])->name('org-service.edit');
    Route::post('/org-services/update/{id}', [OrganizationServiceController::class, 'update'])->name('org-service.update');

    Route::get('/issue-type', [IssueTypeController::class, 'index'])->name('issue-type.index');
    Route::get('/issue-type/create', [IssueTypeController::class, 'create_issueType'])->name('issueType.create');
    Route::post('/issue-type/store', [IssueTypeController::class, 'store'])->name('issueTypeStore');
    Route::get('/issue-type/edit/{id}', [IssueTypeController::class, 'edit_issueType'])->name('issueTypeEdit');
    Route::post('/issue-type/update/{id}', [IssueTypeController::class, 'update_issueType'])->name('issue-type.update');
    Route::get('/issue-type/delete/{id}', [IssueTypeController::class, 'destroy_issueType'])->name('issue-type.delete');

    Route::get('/book', [BookController::class, 'index'])->name('book');
    Route::get('/bookCreate', [BookController::class, 'book_create'])->name('book_create');
    Route::post('/books/store', [BookController::class, 'store'])->name('books.store');
    Route::get('/editBook/{id}', [BookController::class, 'edit_book'])->name('bookEdit');
    Route::post('/updateBook/{id}', [BookController::class, 'update_book'])->name('book.update');
    Route::get('/deleteBook/{id}', [BookController::class, 'destroy_book'])->name('book.delete');
    Route::post('get_codes', [BookController::class, 'get_codes'])->name('get_codes');
    Route::get('book/get/doc-no-and-parameters', [BookController::class, 'getBookDocNoAndParameters'])->name('book.get.doc_no_and_parameters');
    Route::get('get/service-params/{serviceId}', [BookController::class, 'getServiceParamForBookCreation'])->name('book.get.service_params');
    Route::get('check/approval-level', [BookController::class, 'checkLevelForChange'])->name('book.approval-level.check');
    Route::get('get/approval-employees', [BookController::class, 'getEmployeesForApprovalOrgWise'])->name('book.approval-employees.get');
    Route::get('get/reference-series', [BookController::class, 'getReferenceSeriesFromReferenceService'])->name('book.reference-series.get');
    Route::get('get/service-series', [BookController::class, 'getSeriesOfService'])->name('book.service-series.get');


    Route::get('/legal', [LegalController::class, 'index'])->name('legal');
    Route::get('/legal/add', [LegalController::class, 'legal_create'])->name('legal.legal_add');
    Route::get('/legal/view/{id}', [LegalController::class, 'legal_view'])->name('legal.legal_view');
    Route::get('/legal/edit/{id}', [LegalController::class, 'edit'])->name('legal.edit');
    Route::post('/legal/update/{id}', [LegalController::class, 'update'])->name('legal.update');
    Route::post('/legal/store', [LegalController::class, 'legal_store'])->name('legal.store');
    Route::post('/legal/assignsubmit', [LegalController::class, 'legal_assignsubmit'])->name('legal.assignsubmit');
    Route::post('/legal/send-message', [LegalController::class, 'sendEmail'])->name('legal.send_message');
    Route::post('/legal/close', [LegalController::class, 'close'])->name('legal.close');
    Route::post('/legal/appr-rej', [LegalController::class, 'ApprReject'])->name('legal.appr_rej');
    Route::get('/get-series/{issue_id}', [LegalController::class, 'getSeries'])->name('get.series');
    Route::get('/get-request/{book_id}', [LegalController::class, 'getRequests'])->name('get.requests');
    Route::get('/search-messages', [LegalController::class, 'searchMessages'])->name('search.messages');
    Route::get('/legal/filter', [LegalController::class, 'filter'])->name('legal.filter');
    Route::get('/search-docs', [LegalController::class, 'searchDocs'])->name('legal.search.docs');
    Route::get('/mailer', [LegalController::class, 'mailer'])->name('legal.mailer');

    // ajax url legal for land or lease
    Route::get('/lease/onLeaseAddFilter', [LegalController::class, 'onLeaseAddFilter'])->name('legal.onLeaseAddFilter');




    //profit loss
    Route::get('plGroup', [ProfitLossController::class, 'plGroup'])->name('finance.plGroup');
    Route::post('plGroup', [ProfitLossController::class, 'plGroupStore'])->name('finance.plgroups.store');
    Route::get('profit-loss-report', [ProfitLossController::class, 'profitLoss'])->name('finance.profitLoss');
    Route::post('getPLInitialGroups', [ProfitLossController::class, 'getPLInitialGroups'])->name('finance.getPLInitialGroups');
    Route::post('getPLGroupLedgers', [ProfitLossController::class, 'getPLGroupLedgers'])->name('finance.getPLGroupLedgers');
    Route::post('getPLGroupLedgersMultiple', [ProfitLossController::class, 'getPLGroupLedgersMultiple'])->name('finance.getPLGroupLedgersMultiple');
    Route::post('exportPLLevel', [ProfitLossController::class, 'exportPLLevel'])->name('finance.exportPLLevel');

    //balance_sheet

    Route::get('balance-sheet-report', [BalanceSheetController::class, 'balanceSheet'])->name('finance.balanceSheet');
    Route::post('balanceSheetInitialGroups', [BalanceSheetController::class, 'balanceSheetInitialGroups'])->name('finance.balanceSheetInitialGroups');
    Route::post('getBalanceSheetLedgers', [BalanceSheetController::class, 'getBalanceSheetLedgers'])->name('finance.getBalanceSheetLedgers');
    Route::post('getBalanceSheetLedgersMultiple', [BalanceSheetController::class, 'getBalanceSheetLedgersMultiple'])->name('finance.getBalanceSheetLedgersMultiple');
    Route::post('exportBalanceSheet', [BalanceSheetController::class, 'exportBalanceSheet'])->name('finance.exportBalanceSheet');

    //landplot
    Route::get('/land-plot', [LandPlotController::class, 'index'])->name('land-plot.index');
    Route::get('/land-plot/filter', [LandPlotController::class, 'filter'])->name('land-plot.filter');
    Route::get('/land-plot/add', [LandPlotController::class, 'create'])->name('land-plot.create');
    Route::get('/land-plot/view/{id}', [LandPlotController::class, 'view'])->name('land-plot.view');
    Route::post('/land-plot/save', [LandPlotController::class, 'save'])->name('land-plot.save');
    Route::get('/land-plot/edit/{id}', [LandPlotController::class, 'edit'])->name('land-plot.edit');
    Route::post('/land-plot/update', [LandPlotController::class, 'update'])->name('land-plot.update');
    Route::get('/findland', [LandPlotController::class, 'search'])->name('land.search');
    Route::post('/plot-appr-rej', [LandPlotController::class, 'ApprReject'])->name('landplot.appr_rej');
    Route::get('land-plot/amendment/{id}', [LandPlotController::class, 'amendment'])->name('land-plot.amendment');


    //landparcel
    Route::get('/land-parcel', [LandParcelController::class, 'index'])->name('land-parcel.index');
    Route::get('/land-parcel/filter', [LandParcelController::class, 'filter'])->name('land-parcel.filter');
    Route::get('/land-parcel/add', [LandParcelController::class, 'create'])->name('land-parcel.create');
    Route::post('/land-parcel/save', [LandParcelController::class, 'save'])->name('land-parcel.save');
    Route::get('/land-parcel/edit/{id}', [LandParcelController::class, 'edit'])->name('land-parcel.edit');
    Route::get('/land-parcel/view/{id}', [LandParcelController::class, 'view'])->name('land-parcel.view');
    Route::post('/land-parcel/update', [LandParcelController::class, 'update'])->name('land-parcel.update');
    Route::post('/appr-rej', [LandParcelController::class, 'ApprReject'])->name('land.appr_rej');
    Route::get('land-parcel/amendment/{id}', [LandParcelController::class, 'amendment'])->name('land-parcel.amendment');


    //land
    Route::get('/land', [LandController::class, 'index'])->name('land');
    Route::get('/land/add', [LandController::class, 'create'])->name('land.add');
    Route::post('/save-land', [LandController::class, 'saveLand'])->name('save.land');
    Route::get('/land/edit/{id}', [LandController::class, 'edit'])->name('land.edit');
    Route::post('/update-land', [LandController::class, 'updateLand'])->name('update.land');
    Route::get('/get-land-request/{book_id}', [LandController::class, 'getRequests'])->name('get.landrequests');

    Route::get('/land/recovery', [LandController::class, 'recovery'])->name('land.recovery');
    Route::get('/land/recovery/add', [LandController::class, 'recoveryadd'])->name('land.recoveryadd');
    Route::get('/land/recovery/edit/{id}', [LandController::class, 'recoveryedit'])->name('land.recoveryedit');
    Route::post('/save-recovery', [LandController::class, 'saveRecovery'])->name('save.recovery');
    Route::get('/get-land-by-series/{id}', [LandController::class, 'getLandBySeries'])->name('land.getLandBySeries');
    Route::get('/get-land-details/{id}', [LandController::class, 'getLandDetails'])->name('land.getLandDetails');
    Route::get('/get-lease-details/{id}', [LandController::class, 'getLeaseDetails'])->name('land.getLeaseDetails');

    Route::post('/land/approve-recovery', [LandController::class, 'approveRecovery']);
    Route::post('/land/reject-recovery', [LandController::class, 'rejectRecovery']);
    Route::get('/recovery/filter', [LandController::class, 'recoveryfilter'])->name('recovery.filter');
    Route::get('/lease/filter', [LandController::class, 'leasefilter'])->name('lease.filter');
    Route::get('/land/filter', [LandController::class, 'landfilter'])->name('land.filter');

    Route::prefix('land')->group(function () {
        // Land Dashboard
        Route::get('/dashboard/revenue-report', [LandController::class, 'getDashboardRevenueReport'])->name('land.getDashboardRevenueReport');
        // Land Report
        Route::get('/report', [LandReportController::class, 'index'])->name('land.report');
        Route::get('/report/filter', [LandReportController::class, 'getLandReport'])->name('land.getReportFilter');
        Route::get('/report-send/mail', [LandReportController::class, 'sendReportMail'])->name('land.send.report');
        Route::post('/add-scheduler', [LandReportController::class, 'addScheduler'])->name('land.add.scheduler');
        Route::get('/recovery-scheduler', [LandReportController::class, 'recoverySchedulerReport'])->name('land.recovery.scheduler');
        // End Land Report


    });

    Route::prefix('land-lease')->group(function () {
        //land parcel data
        Route::get('get-land-parcel-data/{land_id}', [LeaseController::class, 'getLandParcelData'])->name('lease.landparceldata');

        //lease
        Route::get('/', [LeaseController::class, 'index'])->name('lease.index');
        Route::get('/create', [LeaseController::class, 'create'])->name('lease.create');
        Route::post('/store', [LeaseController::class, 'store'])->name('lease.store');
        Route::get('/edit/{id}', [LeaseController::class, 'edit'])->name('lease.edit');
        Route::post('/update', [LeaseController::class, 'update'])->name('lease.update');
        Route::get('/show/{id}', [LeaseController::class, 'show'])->name('lease.show');
        Route::delete('/destroy/{id}', [LeaseController::class, 'destroy'])->name('lease.delete');
        Route::get('/add/filter-land', [LeaseController::class, 'leaseFilterLand'])->name('land.onleaseadd.filter-land');
        Route::post('/tax-calculation', [LeaseController::class, 'taxCalculation'])->name('land.onleaseadd.tax');
        Route::post('/lease-appr-rej', [LeaseController::class, 'ApprReject'])->name('lease.appr_rej');
        Route::get('/amendment/{id}', [LeaseController::class, 'amendment'])->name('lease.amendment');
        Route::post('/action', [LeaseController::class, 'action'])->name('lease.action');

        // End lease

        // Extra Route

        Route::get('/get-exchange-rate/{currency_id}', [LeaseController::class, 'getExchangeRate'])->name('get.lease.exchange.rate');
        Route::post('/customer/address/store', [LeaseController::class, 'customerAddressStore'])->name('lease.customer.address.store');
        // End Extra Route

        Route::get('/land/on-lease', [LandController::class, 'onlease'])->name('land.onlease');
        Route::get('/land/on-lease/add', [LandController::class, 'onleaseadd'])->name('land.onleaseadd');
        Route::post('/save-lease', [LandController::class, 'savelease'])->name('save.lease');
        Route::get('/land/on-lease/edit/{id}', [LandController::class, 'onleaseedit'])->name('land.onleaseedit');
        Route::post('/update-lease', [LandController::class, 'updatelease'])->name('update.lease');
    });

    Route::get('/finance-ledger-report', [TrialBalanceController::class, 'getLedgerReport'])->name('getLedgerReport');
    Route::get('/getOrgLedgers/{id}', [TrialBalanceController::class, 'get_org_ledgers'])->name('get_org_ledgers');
    Route::post('/filterLedgerReport', [TrialBalanceController::class, 'filterLedgerReport'])->name('filterLedgerReport');
    Route::post('exportLedgerReport', [TrialBalanceController::class, 'exportLedgerReport'])->name('exportLedgerReport');
    Route::post('exportTrialBalanceReport', [TrialBalanceController::class, 'exportTrialBalanceReport'])->name('exportTrialBalanceReport');

    Route::get('/updateLedgerOpening', [TrialBalanceController::class, 'updateLedgerOpening'])->name('updateLedgerOpening'); ///// temp method to reset opening

    Route::get('/trial-balance-report/{id?}', [TrialBalanceController::class, 'index'])->name('trial_balance');
    Route::get('/trailLedger/{id}', [TrialBalanceController::class, 'trailLedger'])->name('trailLedger');
    Route::post('getInitialGroups', [TrialBalanceController::class, 'getInitialGroups'])->name('getInitialGroups');
    Route::post('getSubGroups', [TrialBalanceController::class, 'getSubGroups'])->name('getSubGroups');
    Route::post('getSubGroupsMultiple', [TrialBalanceController::class, 'getSubGroupsMultiple'])->name('getSubGroupsMultiple');

    // Loan Management
    Route::prefix('loan')->group(function () {
        Route::get('/index', [LoanManagementController::class, 'index'])->name('loan.index');
        Route::get('/home-loan/view/{id}', [LoanManagementController::class, 'viewAllDetail'])->name('loan.view_all_detail');
        Route::get('/home-loan', [LoanManagementController::class, 'home_loan'])->name('loan.home-loan');
        Route::get('/vehicle-loan', [LoanManagementController::class, 'vehicle_loan'])->name('loan.vehicle-loan');
        Route::get('/term-loan', [LoanManagementController::class, 'term_loan'])->name('loan.term-loan');
        Route::get('/loan-get-customer', [LoanManagementController::class, 'loanGetCustomer'])->name('loan.get.customer');

        //recovery
        Route::get('/recovery', [LoanRecoveryController::class, 'recovery'])->name('loan.recovery');
        Route::get('/recovery/view/{id}', [LoanRecoveryController::class, 'viewRecovery'])->name('loan.recovery_view');
        Route::get('/recovery/add', [LoanRecoveryController::class, 'addRecovery'])->name('loan.add-recovery');
        Route::post('/recovery-add-update', [LoanRecoveryController::class, 'recoveryAddUpdate'])->name('loan.recovery.add-update');
        Route::post('/recovery-appr-rej', [LoanRecoveryController::class, 'RecoveryApprReject'])->name('loan.recovery_appr_rej');
        Route::get('/fetch-recovery-approve', [LoanRecoveryController::class, 'fetchRecoveryApprove'])->name('loan.fetch-recovery-approve');
        Route::get('/loan-recovery-customer', [LoanRecoveryController::class, 'loanGetCustomer'])->name('loan.get.recovery.customer');
        Route::get('/get-recovery-interest', [LoanRecoveryController::class, 'getPrincipalInterest'])->name('loan.get.RecoveryInterest');
        Route::get('/loan-recovery-invoice/voucher/get', [LoanRecoveryController::class, 'getPostingDetails'])->name('loan.recovery.getPostingDetails');
        Route::post('/loan-recovery-invoice/voucher/post', [LoanRecoveryController::class, 'postPostingDetails'])->name('loan.recovery.post');

        // Route::get('/disbursement', [LoanManagementController::class, 'disbursement'])->name('loan.disbursement');
        Route::get('/settlement', [LoanManagementController::class, 'settlement'])->name('loan.settlement');


        // Loan Dashboard
        Route::get('/dashboard/loan-analytics', [LoanDashboardController::class, 'getDashboardLoanAnalytics'])->name('loan.analytics');
        Route::get('/dashboard/loan-kpi', [LoanDashboardController::class, 'getDashboardLoanKpi'])->name('loan.kpi');
        Route::get('/dashboard/loan-summary', [LoanDashboardController::class, 'getDashboardLoanSummary'])->name('loan.summary');


        // Loan Report
        Route::get('/report', [LoanReportController::class, 'index'])->name('loan.report');
        Route::get('/report/filter', [LoanReportController::class, 'getLoanFilter'])->name('loan.report.filter');
        Route::post('/add-scheduler', [LoanReportController::class, 'addScheduler'])->name('loan.add.scheduler');
        Route::get('/report-send/mail', [LoanReportController::class, 'sendReportMail'])->name('loan.send.report');

        Route::get('/disbursement-report', [LoanDisbursementReportController::class, 'index'])->name('loandisbursement.report');
        Route::get('/disbursementreport/filter', [LoanDisbursementReportController::class, 'getFilter'])->name('loandisbursement.report.filter');
        Route::post('/disbursement-add-scheduler', [LoanDisbursementReportController::class, 'addScheduler'])->name('loandisbursement.add.scheduler');
        Route::get('/disbursement-report-send/mail', [LoanDisbursementReportController::class, 'sendReportMail'])->name('loandisbursement.send.report');

        Route::get('/repayment-report', [LoanRepaymentReportController::class, 'index'])->name('loanrepayment.report');
        Route::get('/repaymentreport/filter', [LoanRepaymentReportController::class, 'getFilter'])->name('loanrepayment.report.filter');
        Route::post('/repayment-add-scheduler', [LoanRepaymentReportController::class, 'addScheduler'])->name('loanrepayment.add.scheduler');
        Route::get('/repayment-report-send/mail', [LoanRepaymentReportController::class, 'sendReportMail'])->name('loanrepayment.send.report');

        // Interest rate
        Route::get('/interest-rate', [LoanManagementController::class, 'interest_rate'])->name('loan.interest-rate');
        Route::get('/interest-add', [LoanInterestRateController::class, 'add'])->name('loan.interest-add');
        Route::post('/interest-create', [LoanInterestRateController::class, 'create'])->name('loan.interest-create');
        Route::get('/interest-edit/{id}', [LoanInterestRateController::class, 'edit'])->name('loan.interest-edit');
        Route::post('/interest-update/{id}', [LoanInterestRateController::class, 'update'])->name('loan.interest-update');
        Route::get('/interest-delete/{id}', [LoanInterestRateController::class, 'delete'])->name('loan.interest-delete');

        // Financial setup
        Route::get('/financial-setup', [LoanFinancialSetupController::class, 'index'])->name('loan.financial-setup');
        Route::get('/financial-setup-add', [LoanFinancialSetupController::class, 'add'])->name('loan.financial-setup-add');
        Route::post('/financial-setup-create', [LoanFinancialSetupController::class, 'create'])->name('loan.financial-setup-create');
        Route::get('/financial-setup-edit/{id}', [LoanFinancialSetupController::class, 'edit'])->name('loan.financial-setup-edit');
        Route::post('/financial-setup-update/{id}', [LoanFinancialSetupController::class, 'update'])->name('loan.financial-setup-update');
        Route::get('/financial-setup-delete/{id}', [LoanFinancialSetupController::class, 'delete'])->name('loan.financial-setup-delete');

        //Home Loan
        Route::get('/home-loan/add', [HomeLoanController::class, 'add'])->name('loan.home-loan-add');
        Route::post('/home-loan-create-update', [HomeLoanController::class, 'create'])->name('loan.home-loan-createUpdate');
        Route::get('/home-loan/edit/{id}', [HomeLoanController::class, 'edit'])->name('loan.home-loan-edit');
        Route::get('/home-loan/delete/{id}', [HomeLoanController::class, 'destroy'])->name('loan.home-loan-delete');

        // Vehicle Loan
        Route::post('/vehicle-loan-create-update', [VehicleLoanController::class, 'create'])->name('loan.vehicle.loan-createUpdate');
        Route::get('/vehicle-loan/view/{id}', [VehicleLoanController::class, 'viewVehicleDetail'])->name('loan.view_vehicle_detail');
        Route::get('/vehicle-loan/edit/{id}', [VehicleLoanController::class, 'editVehicleDetail'])->name('loan.edit_vehicle_detail');
        Route::get('/vehicle-loan/delete/{id}', [VehicleLoanController::class, 'destroy'])->name('loan.delete_vehicle_detail');

        // Application Delete
        Route::post('application/delete', [LoanManagementController::class, 'destroy'])->name('loan.delete');
        Route::delete('destroy/{id}', [LoanManagementController::class, 'destroy'])->name('loan.destroy');

        // Term Loan
        Route::post('/term-loan-create-update', [TermLoanController::class, 'create'])->name('loan.term-loan-createUpdate');
        Route::get('/term-loan/view/{id}', [TermLoanController::class, 'viewTermDetail'])->name('loan.view_term_detail');
        Route::get('/term-loan/edit/{id}', [TermLoanController::class, 'editTermDetail'])->name('loan.term-loan-edit');
        Route::get('/term-loan/delete/{id}', [TermLoanController::class, 'destroy'])->name('loan.term-loan-delete');

        Route::get('/get-cities', [LoanManagementController::class, 'getCities'])->name('loan.getCities');
        Route::get('/get-city-by-id', [LoanManagementController::class, 'getCityByID'])->name('loan.getCityByID');

        Route::get('/get-state', [LoanManagementController::class, 'getStates'])->name('loan.getStates');
        Route::get('/get-state-by-id', [LoanManagementController::class, 'getStateByID'])->name('loan.getStateByID');

        // Filter
        Route::post('/appr-rej', [LoanManagementController::class, 'ApprReject'])->name('loan.appr_rej');

        // Assessment
        Route::post('/loan-assess', [LoanManagementController::class, 'loanAssessment'])->name('loan.assess');
        Route::get('/get-assess', [LoanManagementController::class, 'getAssessment'])->name('get.loan.assess');

        // Disbursal schedule
        Route::post('/loan-disbursemnt', [LoanManagementController::class, 'loanDisbursemnt'])->name('loan.disbursemnt');
        Route::get('/get-disbursemnt', [LoanManagementController::class, 'getDisbursemnt'])->name('get.loan.disbursemnt');

        // Recovery Schedule
        Route::post('/loan-recovery-schedule', [LoanManagementController::class, 'loanRecoverySchedule'])->name('loan.recovery-schedule');
        Route::get('/get-recovery-schedule', [LoanManagementController::class, 'getRecoverySchedule'])->name('get.loan.recovery.schedule');

        // Documents
        Route::get('/get-doc', [LoanManagementController::class, 'getDoc'])->name('get.loan.docc');

        // Disbursement
        Route::get('/disbursement', [LoanDisbursementController::class, 'disbursement'])->name('loan.disbursement');
        Route::get('/disbursement/add', [LoanDisbursementController::class, 'addDisbursement'])->name('loan.add-disbursement');
        Route::get('/disbursement/view/{id}', [LoanDisbursementController::class, 'viewDisbursement'])->name('loan.view-disbursement');
        Route::get('/disbursement/assesment/view/{id}', [LoanDisbursementController::class, 'viewDisbursementAssesment'])->name('loan.view-disbursement-assesment');
        Route::get('/disbursement/assesment', [LoanDisbursementController::class, 'disbursement_assesment'])->name('loan.disbursement.assesment');
        Route::get('/disbursement/approval/view/{id}', [LoanDisbursementController::class, 'viewDisbursementApproval'])->name('loan.view-disbursement-approval');
        Route::get('/disbursement/approval', [LoanDisbursementController::class, 'disbursement_approval'])->name('loan.disbursement.approval');
        Route::get('/disbursement/submission/view/{id}', [LoanDisbursementController::class, 'viewDisbursementSubmssion'])->name('loan.view-disbursement-submission');
        Route::get('/disbursement/submission', [LoanDisbursementController::class, 'disbursement_submission'])->name('loan.disbursement.submission');
        Route::get('/disbursement-invoice/posting/get', [LoanDisbursementController::class, 'getPostingDetails'])->name('loan.disbursement.getPostingDetails');
        Route::post('/disbursement-invoice/post', [LoanDisbursementController::class, 'postInvoice'])->name('loan.disbursement.post');
        Route::post('/disbursement-payment', [LoanDisbursementController::class, 'disbursement_payment'])->name('disbursement.payment');
        Route::get('/get-bank', [LoanDisbursementController::class, 'get_bank_details'])->name('get.bank.details');
        Route::post('/disbursement-add-update', [LoanDisbursementController::class, 'disbursementAddUpdate'])->name('loan.disbursement.add-update');
        Route::get('/loan-get-disburs-customer', [LoanDisbursementController::class, 'loanGetDisbursCustomer'])->name('loan.get.disburs.customer');
        Route::post('/dis-appr-rej', [LoanDisbursementController::class, 'DisApprReject'])->name('loan.dis_appr_rej');
        Route::post('/proceed-disbursement-assesment', [LoanDisbursementController::class, 'proceedDisbursementAssesment'])->name('loan.proceed.disbursement');
        Route::post('/reject-disbursement-assesment', [LoanDisbursementController::class, 'rejectDisbursementAssesment'])->name('loan.reject.disbursement');
        Route::get('/loan-get-appraisal-customer', [LoanDisbursementController::class, 'loanGetCustomer'])->name('loan.get.customer.appraisal');
        //Route::get('/add-disbursement', [LoanManagementController::class, 'addDisbursement'])->name('loan.add-disbursement');
        //Route::post('/disbursement-add-update', [LoanManagementController::class, 'disbursementAddUpdate'])->name('loan.disbursement.add-update');
        // Route::get('/loan-get-disburs-customer', [LoanManagementController::class, 'loanGetDisbursCustomer'])->name('loan.get.disburs.customer');
        //Route::get('/loan-get-customer', [LoanManagementController::class, 'loanGetCustomer'])->name('loan.get.customer');
        //Route::post('/dis-appr-rej', [LoanManagementController::class, 'DisApprReject'])->name('loan.dis_appr_rej');


        // Settlement
        Route::get('/settlement', [LoanSettlementController::class, 'index'])->name('loan.settlement');
        Route::get('/settlement/add', [LoanSettlementController::class, 'add'])->name('loan.settlement.add');
        Route::get('/settlement/view/{id}', [LoanSettlementController::class, 'view'])->name('loan.settlement.view');
        Route::post('/settlement-add-update', [LoanSettlementController::class, 'save'])->name('loan.settlement.save');
        Route::post('/settle-appr-rej', [LoanSettlementController::class, 'ApprReject'])->name('loan.settlement.appr_rej');
        Route::get('/loan-settled-customer', [LoanSettlementController::class, 'loanGetCustomer'])->name('loan.settlement.customer');
        Route::get('/settlement-invoice/voucher/get', [LoanSettlementController::class, 'getPostingDetails'])->name('loan.settlement.getPostingDetails');
        Route::post('/settlement-invoice/voucher/post', [LoanSettlementController::class, 'postPostingDetails'])->name('loan.settlement.post');


        // Route::get('/add-settlement', [LoanManagementController::class, 'addSettlement'])->name('loan.add-settlement');
        // Route::post('/settlement-add-update', [LoanManagementController::class, 'settlementAddUpdate'])->name('loan.settlement.add-update');
        // Route::post('/settle-appr-rej', [LoanManagementController::class, 'SettleApprReject'])->name('loan.settle_appr_rej');

        // get pending disbursals
        Route::get('/get-pending-disbursal', [LoanManagementController::class, 'getPendingDisbursal'])->name('loan.get-pending-disbursal');
        Route::get('/set-pending-status', [LoanManagementController::class, 'setPendingStatus'])->name('loan.set_pending_status');

        //get series
        Route::get('/get-series', [LoanManagementController::class, 'getSeries'])->name('loan.get_series');

        Route::get('/fetch-disbursement-approve', [LoanManagementController::class, 'fetchDisbursementApprove'])->name('loan.fetch-disbursement-approve');
        Route::get('/fetch-settle-approve', [LoanManagementController::class, 'fetchSettleApprove'])->name('loan.fetch-settle-approve');


        Route::get('/get-loan-cibil', [LoanManagementController::class, 'getLoanCibil'])->name('get.loan.cibil');
        Route::get('/get-principal-interest', [LoanManagementController::class, 'getPrincipalInterest'])->name('loan.get.PrincipalInterest');

        Route::get('/get-loan-request/{book_id}', [LoanManagementController::class, 'getLoanRequests'])->name('get_loan_request');
    });

    # Bill of material
    Route::prefix('bill-of-material')
        ->name('bill.of.material.')
        ->controller(BomController::class)
        ->group(function () {
            Route::get('revoke-document', 'revokeDocument')->name('revoke.document');
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('change-item-code', 'changeItemCode')->name('item.code');
            Route::get('get-item-attribute', 'getItemAttribute')->name('item.attr');
            Route::get('add-item-row', 'addItemRow')->name('item.row');
            Route::get('get-overhead', 'getOverhead')->name('get.overhead');
            Route::get('get-item-detail', 'getItemDetail')->name('get.itemdetail');
            Route::get('get-doc-no', 'getDocNumber')->name('doc.no');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update/{id}', 'update')->name('update');
            # get bom item cost child item
            Route::get('get-item-cost', 'getItemCost')->name('get.item.cost');
            Route::get('/{id}/pdf', 'generatePdf')->name('generate-pdf');

            Route::get('get-quote-bom', 'getQuoteBom')->name('get.quote.bom');
            Route::get('process-bom-item', 'processBomItem')->name('process.bom-item');
        });

    # All type documents approval
    Route::prefix('document-approval')
        ->name('document.approval.')
        ->controller(DocumentApprovalController::class)
        ->group(function () {
            Route::post('bom', 'bom')->name('bom');
            Route::post('saleOrder', 'saleOrder')->name('so');
            Route::post('po', 'po')->name('po');
            Route::post('pi', 'pi')->name('pi');
            Route::post('saleInvoice', 'saleInvoice')->name('saleInvoice');
        });

    // Material Receipt routes
    Route::prefix('material-receipts')
        ->name('material-receipt.')
        ->controller(MaterialReceiptController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/{id}/view', 'show')->name('show');
            Route::get('add-item-row', 'addItemRow')->name('item.row');
            Route::get('po-item-row', 'poItemRows')->name('po-item.row');
            Route::get('get-item-attribute', 'getItemAttribute')->name('item.attr');
            Route::get('add-discount-row', 'addDiscountRow')->name('item.discount.row');
            Route::get('/tax-calculation', 'taxCalculation')->name('tax.calculation');
            Route::get('/get-address', 'getAddress')->name('get.address');
            Route::get('/edit-address', 'editAddress')->name('edit.address');
            Route::post('/address-save', 'addressSave')->name('address.save');
            Route::get('/get-itemdetail', 'getItemDetail')->name('get.itemdetail');
            Route::post('/get-store-racks', 'getStoreRacks')->name('get.store-racks');
            Route::post('/get-rack-shelfs', 'getStoreShelfs')->name('get.rack-shelfs');
            Route::post('/get-shelf-bins', 'getStoreBins')->name('get.shelf-bins');
            Route::get('/validate-quantity', 'validateQuantity')->name('get.validate-quantity');
            Route::get('/{id}/logs', 'logs')->name('logs');
            Route::get('/{id}/pdf', 'generatePdf')->name('generate-pdf');
            Route::delete('component-delete', 'componentDelete')->name('comp.delete');
            Route::get('/get-stock-detail', 'getStockDetail')->name('get.stock-detail');
            Route::get('amendment-submit/{id}', 'amendmentSubmit')->name('amendment.submit');
            Route::get('get-purchase-orders', 'getPo')->name('get.po');
            Route::get('process-po-item', 'processPoItem')->name('process.po-item');
            Route::get('/posting/get', 'getPostingDetails')->name('posting.get');
            Route::post('/post', 'postMrn')->name('post');
            Route::get('revoke-document', 'revokeDocument')->name('revoke.document');

            /*Remove data*/
            Route::delete('remove-dis-item-level', 'removeDisItemLevel')->name('remove.item.dis');
            Route::delete('remove-dis-header-level', 'removeDisHeaderLevel')->name('remove.header.dis');
            Route::delete('remove-exp-header-level', 'removeExpHeaderLevel')->name('remove.header.exp');
        });

    # All type documents approval
    Route::prefix('document-approval')
        ->name('document.approval.')
        ->controller(DocumentApprovalController::class)
        ->group(function () {
            Route::post('material-receipt', 'mrn')->name('material-receipt');
        });

    // # All type documents Amendements
    // Route::prefix('amendement')
    // ->name('document.amendement.')
    // ->controller(AmendementController::class)
    // ->group(function () {
    //     Route::get('amendment-submit/{id}', 'mrnAmendmentSubmit')->name('material-receipt');
    // });

    // Inventory Report routes
    Route::prefix('inventory-reports')
        ->name('inventory-report.')
        ->controller(InventoryReportController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/get-attribute-values', 'getAttributeValues')->name('get.attribute-values');
            Route::get('/report/filter', 'getReportFilter')->name('report.filter');
            Route::get('get-item-attributes', 'getItemAttributes')->name('item.attr');
        });

    // Expense routes
    Route::prefix('expense-advice')
        ->name('expense-adv.')
        ->controller(ExpenseAdviseController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/{id}/view', 'show')->name('show');
            Route::get('add-item-row', 'addItemRow')->name('item.row');
            Route::get('po-item-row', 'poItemRows')->name('po-item.row');
            Route::get('so-item-row', 'soItemRows')->name('so-item.row');

            Route::get('get-item-attribute', 'getItemAttribute')->name('item.attr');
            Route::get('add-discount-row', 'addDiscountRow')->name('item.discount.row');
            Route::get('/tax-calculation', 'taxCalculation')->name('tax.calculation');
            Route::get('/get-address', 'getAddress')->name('get.address');
            Route::get('/edit-address', 'editAddress')->name('edit.address');
            Route::post('/address-save', 'addressSave')->name('address.save');
            Route::get('/get-itemdetail', 'getItemDetail')->name('get.itemdetail');
            Route::post('/get-items-by-vendor', 'getPoItemsByVendorId');
            Route::post('/get-po-items-by-po-id', 'getPoItemsByPoId')->name('get.po-items-by-po-id');
            Route::post('/get-items-by-customer', 'getSoItemsByCustomerId');
            Route::post('/get-so-items-by-so-id', 'getSoItemsBySoId')->name('get.so-items-by-so-id');
            Route::get('/{id}/logs', 'logs')->name('logs');
            Route::get('/{id}/pdf', 'generatePdf')->name('generate-pdf');
            Route::delete('component-delete', 'componentDelete')->name('comp.delete');
            Route::get('/amendment-submit/{id}', 'amendmentSubmit')->name('amendment.submit');
            Route::get('/get-purchase-orders', 'getPo')->name('get.po');
            Route::get('/process-po-item', 'processPoItem')->name('process.po-item');
            Route::get('/get-sales-orders', 'getSo')->name('get.so');
            Route::get('/process-so-item', 'processSoItem')->name('process.so-item');
            Route::get('/posting/get', 'getPostingDetails')->name('posting.get');
            Route::post('/post', 'postExpenseAdvise')->name('post');
            Route::get('revoke-document', 'revokeDocument')->name('revoke.document');

            /*Remove data*/
            Route::delete('remove-dis-item-level', 'removeDisItemLevel')->name('remove.item.dis');
            Route::delete('remove-dis-header-level', 'removeDisHeaderLevel')->name('remove.header.dis');
            Route::delete('remove-exp-header-level', 'removeExpHeaderLevel')->name('remove.header.exp');
        });

    # All type documents approval
    Route::prefix('document-approval')
        ->name('document.approval.')
        ->controller(DocumentApprovalController::class)
        ->group(function () {
            Route::post('expense-adv', 'expense')->name('expense-adv');
        });

    # All type documents Amendements
    Route::prefix('amendement')
        ->name('document.amendement.')
        ->controller(AmendementController::class)
        ->group(function () {
            Route::post('expense-adv', 'expense')->name('expense');
        });

    // Purchase Bill Routes
    Route::prefix('purchase-bills')
        ->name('purchase-bill.')
        ->controller(PurchaseBillController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/{id}/view', 'show')->name('show');
            Route::get('add-item-row', 'addItemRow')->name('item.row');
            Route::get('mrn-item-row', 'mrnItemRows')->name('mrn-item.row');
            Route::get('get-item-attribute', 'getItemAttribute')->name('item.attr');
            Route::get('add-discount-row', 'addDiscountRow')->name('item.discount.row');
            Route::get('/tax-calculation', 'taxCalculation')->name('tax.calculation');
            Route::get('/get-address', 'getAddress')->name('get.address');
            Route::get('/edit-address', 'editAddress')->name('edit.address');
            Route::post('/address-save', 'addressSave')->name('address.save');
            Route::get('/get-itemdetail', 'getItemDetail')->name('get.itemdetail');
            Route::post('/get-items-by-vendor', 'getMrnItemsByVendorId');
            Route::post('/get-mrn-items-by-mrn-id', 'getMrnItemsByMrnId')->name('get.mrn-items-by-mrn-id');
            Route::get('/{id}/logs', 'logs')->name('logs');
            Route::get('/{id}/pdf', 'generatePdf')->name('generate-pdf');
            Route::delete('component-delete', 'componentDelete')->name('comp.delete');
            Route::get('amendment-submit/{id}', 'amendmentSubmit')->name('amendment.submit');
            Route::get('get-mrn', 'getMrn')->name('get.mrn');
            Route::get('process-mrn-item', 'processMrnItem')->name('process.mrn-item');
            Route::get('/posting/get', 'getPostingDetails')->name('posting.get');
            Route::post('/post', 'postPb')->name('post');
            Route::get('revoke-document', 'revokeDocument')->name('revoke.document');

            /*Remove data*/
            Route::delete('remove-dis-item-level', 'removeDisItemLevel')->name('remove.item.dis');
            Route::delete('remove-dis-header-level', 'removeDisHeaderLevel')->name('remove.header.dis');
            Route::delete('remove-exp-header-level', 'removeExpHeaderLevel')->name('remove.header.exp');
        });

    # All type documents approval
    Route::prefix('document-approval')
        ->name('document.approval.')
        ->controller(DocumentApprovalController::class)
        ->group(function () {
            Route::post('purchase-bill', 'purchaseBill')->name('purchase-bill');
        });

    # All type documents Amendements
    Route::prefix('amendement')
        ->name('document.amendement.')
        ->controller(AmendementController::class)
        ->group(function () {
            Route::post('purchase-bill', 'purchaseBill')->name('purchase-bill');
        });

    // Purchase Return routes
    Route::prefix('purchase-return')
        ->name('purchase-return.')
        ->controller(PurchaseReturnController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('/{id}/view', 'show')->name('show');
            Route::get('add-item-row', 'addItemRow')->name('item.row');
            Route::get('mrn-item-row', 'mrnItemRows')->name('mrn-item.row');
            Route::get('get-item-attribute', 'getItemAttribute')->name('item.attr');
            Route::get('add-discount-row', 'addDiscountRow')->name('item.discount.row');
            Route::get('/tax-calculation', 'taxCalculation')->name('tax.calculation');
            Route::get('/get-address', 'getAddress')->name('get.address');
            Route::get('/edit-address', 'editAddress')->name('edit.address');
            Route::post('/address-save', 'addressSave')->name('address.save');
            Route::get('/get-itemdetail', 'getItemDetail')->name('get.itemdetail');
            Route::post('/get-items-by-vendor', 'getMrnItemsByVendorId');
            Route::post('/get-mrn-items-by-mrn-id', 'getMrnItemsByMrnId')->name('get.mrn-items-by-mrn-id');
            Route::get('/{id}/logs', 'logs')->name('logs');
            Route::get('/{id}/pdf', 'generatePdf')->name('generate-pdf');
            Route::delete('component-delete', 'componentDelete')->name('comp.delete');
            Route::get('amendment-submit/{id}', 'amendmentSubmit')->name('amendment.submit');
            Route::get('get-mrn', 'getMrn')->name('get.mrn');
            Route::get('process-mrn-item', 'processMrnItem')->name('process.mrn-item');
            Route::get('/posting/get', 'getPostingDetails')->name('posting.get');
            Route::post('/post', 'postPR')->name('post');
            Route::get('revoke-document', 'revokeDocument')->name('revoke.document');

            /*Remove data*/
            Route::delete('remove-dis-item-level', 'removeDisItemLevel')->name('remove.item.dis');
            Route::delete('remove-dis-header-level', 'removeDisHeaderLevel')->name('remove.header.dis');
            Route::delete('remove-exp-header-level', 'removeExpHeaderLevel')->name('remove.header.exp');
        });

    // Material Request routes
    Route::prefix('material-request')
        ->name('material-request.')
        ->controller(PiController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
        });

    // Material Issue routes
    Route::prefix('material-issue')
        ->name('material-issue.')
        ->controller(MaterialReceiptController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
        });

    // Stock Adjustment routes
    Route::prefix('stock-adjustment')
        ->name('stock-adjustment.')
        ->controller(MaterialReceiptController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
        });

    // Physical Stock Take routes
    Route::prefix('physical-stock-take')
        ->name('physical-stock-take.')
        ->controller(MaterialReceiptController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
        });

    // Production Slip routes
    Route::prefix('production-slip')
        ->name('production-slip.')
        ->controller(MaterialReceiptController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
        });

    // Commercial BOM routes
    Route::prefix('commercial-bom')
        ->name('commercial-bom.')
        ->controller(BomController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
        });

    // Production Work Order routes
    Route::prefix('production-work-order')
        ->name('production-work-order.')
        ->controller(PoController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
        });

    // Job Order routes
    Route::prefix('job-order')
        ->name('job-order.')
        ->controller(PoController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
        });

    Route::prefix('taxes')->controller(TaxController::class)->group(function () {
        Route::get('/test-tax-calculation', 'testCalculateTax')->name('tax.test.calculate');
        Route::get('/tax-calculation', 'calculateItemTax')->name('tax.calculate');
        Route::get('/test-tax-calculation', 'testCalculateTax');
        Route::get('/tax-calculation', 'calculateItemTax');
        Route::get('/', 'index')->name('tax.index');
        Route::get('/create', 'create')->name('tax.create');
        Route::post('/', 'store')->name('tax.store');
        Route::get('/{id}', 'show')->name('tax.show');
        Route::get('/{id}/edit', 'edit')->name('tax.edit');
        Route::put('/{id}', 'update')->name('tax.update');
        Route::delete('/{id}', 'destroy')->name('tax.destroy');
        Route::get('/calculate-tax/sales', 'calculateTaxForSalesModule')->name('tax.calculate.sales');
        Route::delete('/tax-detail/{id}', 'deleteTaxDetail')->name('tax-detail.delete');
    });

    Route::prefix('product-sections')->controller(ProductSectionController::class)->group(function () {
        Route::get('/', 'index')->name('product-sections.index');
        Route::get('/create', 'create')->name('product-sections.create');
        Route::post('/', 'store')->name('product-sections.store');
        Route::get('/{id}/edit', 'edit')->name('product-sections.edit');
        Route::put('/{id}', 'update')->name('product-sections.update');
        Route::delete('/{id}', 'destroy')->name('product-sections.destroy');
        Route::delete('/section-detail/{id}', 'deleteSectionDetail')->name('section-detail.delete');
        Route::get('/subproduct-sections/{productSectionId}', 'getSubProductSection')->name('product-sections.subproduct-sections');
    });

    Route::prefix('product-specifications')->controller(ProductSpecificationController::class)->group(function () {
        Route::get('/', 'index')->name('product-specifications.index');
        Route::post('/', 'store')->name('product-specifications.store');
        Route::get('/create', 'create')->name('product-specifications.create');
        Route::get('/specifications/{id}', 'getSpecificationDetails');
        Route::get('/{id}/edit', 'edit')->name('product-specifications.edit');
        Route::get('/{id}', 'show')->name('product-specifications.show');
        Route::put('/{id}', 'update')->name('product-specifications.update');
        Route::delete('/{id}', 'destroy')->name('product-specifications.destroy');
        Route::delete('/specification-detail/{id}', 'deleteSpecificationDetail')->name('specification-detail.delete');
    });

    Route::prefix('stations')->controller(StationController::class)->group(function () {
        Route::get('/', 'index')->name('stations.index');
        Route::get('/create', 'create')->name('stations.create');
        Route::post('/', 'store')->name('stations.store');
        Route::get('/{id}', 'show')->name('stations.show');
        Route::get('/{id}/edit', 'edit')->name('stations.edit');
        Route::put('/{id}', 'update')->name('stations.update');
        Route::delete('/{id}', 'destroy')->name('stations.destroy');
        Route::delete('/substation/{id}', 'deleteSubstation')->name('substation.delete');
    });

    Route::prefix('terms-conditions')->controller(TermsAndConditionController::class)->group(function () {
        Route::get('/', 'index')->name('terms.index');
        Route::get('/create', 'create')->name('terms.create');
        Route::post('/', 'store')->name('terms.store');
        Route::get('/{id}', 'show')->name('terms.show');
        Route::get('/{id}/edit', 'edit')->name('terms.edit');
        Route::put('/{id}', 'update')->name('terms.update');
        Route::delete('/{id}', 'destroy')->name('terms.destroy');
    });

    Route::prefix('exchange-rates')->controller(ExchangeRateController::class)->group(function () {
        Route::get('/', 'index')->name('exchange-rates.index');
        Route::get('/create', 'create')->name('exchange-rates.create');
        Route::post('/get-currency-exchange-rate', 'getExchangeRate')->name('get.currency.exchange.rate');
        Route::post('/', 'store')->name('exchange-rates.store');
        Route::get('/{id}/edit', 'edit')->name('exchange-rates.edit');
        Route::put('/{id}', 'update')->name('exchange-rates.update');
        Route::delete('/{id}', 'destroy')->name('exchange-rates.destroy');
    });

    Route::prefix('discount-masters')->controller(DiscountMasterController::class)->group(function () {
        Route::get('/', 'index')->name('discount-masters.index');
        Route::post('/', 'store')->name('discount-masters.store');
        Route::put('/{id}', 'update')->name('discount-masters.update');
        Route::delete('/{id}', 'destroy')->name('discount-masters.destroy');
    });

    Route::prefix('expense-masters')->controller(ExpenseMasterController::class)->group(function () {
        Route::get('/', 'index')->name('expense-masters.index');
        Route::post('/', 'store')->name('expense-masters.store');
        Route::put('/{id}', 'update')->name('expense-masters.update');
        Route::delete('/{id}', 'destroy')->name('expense-masters.destroy');
    });

    Route::get('/search', [AutocompleteController::class, 'search'])->name('search');

    Route::get('/countries', [CountryController::class, 'countries'])->name('countries.get');
    Route::get('/states/{countryId}', [CountryController::class, 'states'])->name('states.get');
    Route::get('/cities/{stateId}', [CountryController::class, 'cities'])->name('cities.get');

    //Sale Invoice
    Route::get('/sale-invoices', [ErpSaleInvoiceController::class, 'index'])->name('sale.invoice.index');
    Route::get('/lease-invoices', [ErpSaleInvoiceController::class, 'index'])->name('sale.leaseInvoice.index');


    Route::get('/sale-invoices/create', [ErpSaleInvoiceController::class, 'create'])->name('sale.invoice.create');
    Route::get('/lease-invoices/create', [ErpSaleInvoiceController::class, 'create'])->name('sale.leaseInvoice.create');

    Route::post('/sale-invoices/store', [ErpSaleInvoiceController::class, 'store'])->name('sale.invoice.store');

    Route::get('/sale-invoices/edit/{id}', [ErpSaleInvoiceController::class, 'edit'])->name('sale.invoice.edit');
    Route::get('/lease-invoices/edit/{id}', [ErpSaleInvoiceController::class, 'edit'])->name('sale.leaseInvoice.edit');

    Route::get('/sale-invoices/orders/get', [ErpSaleInvoiceController::class, 'getOrders'])->name('sale.invoice.orders.get');
    Route::get('/sale-invoices/challans/get', [ErpSaleInvoiceController::class, 'getDeliveryChallans'])->name('sale.invoice.challans.get');
    Route::get('/sale-invoices/order', [ErpSaleInvoiceController::class, 'processOrder'])->name('sale.invoice.order.get');
    Route::get('/sale-invoices/challan', [ErpSaleInvoiceController::class, 'processDeliveryChallan'])->name('sale.invoice.challan.get');
    Route::get('/sale-invoices/generate-pdf/{id}/{pattern}', [ErpSaleInvoiceController::class, 'generatePdf'])->name('sale.invoice.generate-pdf');
    Route::get('/sale-invoices/pull/items', [ErpSaleInvoiceController::class, 'getSalesItemsForPulling'])->name('sale.invoice.pull.items');
    Route::get('/sale-invoices/process/items', [ErpSaleInvoiceController::class, 'processPulledItems'])->name('sale.invoice.process.items');
    Route::post('/sale-invoices/revoke', [ErpSaleInvoiceController::class, 'revokeSalesInvoice'])->name('sale.invoice.revoke');

    //Sale Return
    Route::get('/sale-returns', [ErpSaleReturnController::class, 'index'])->name('sale.return.index');
    Route::get('/sale-returns/create', [ErpSaleReturnController::class, 'create'])->name('sale.return.create');
    Route::post('/sale-returns/store', [ErpSaleReturnController::class, 'store'])->name('sale.return.store');
    Route::get('/sale-returns/edit/{id}', [ErpSaleReturnController::class, 'edit'])->name('sale.return.edit');
    Route::get('/sale-returns/orders/get', [ErpSaleReturnController::class, 'getOrders'])->name('sale.return.orders.get');
    Route::get('/sale-returns/challans/get', [ErpSaleReturnController::class, 'getDeliveryChallans'])->name('sale.return.challans.get');
    Route::get('/sale-returns/order', [ErpSaleReturnController::class, 'processOrder'])->name('sale.return.order.get');
    Route::get('/sale-returns/challan', [ErpSaleReturnController::class, 'processDeliveryChallan'])->name('sale.return.challan.get');
    Route::get('/sale-returns/generate-pdf/{id}/{pattern}', [ErpSaleReturnController::class, 'generatePdf'])->name('sale.return.generate-pdf');
    Route::get('/sale-returns/pull/items', [ErpSaleReturnController::class, 'getInvoiceItemsForPulling'])->name('sale.return.pull.items');
    Route::get('/sale-returns/process/items', [ErpSaleReturnController::class, 'processPulledItems'])->name('sale.return.process.items');


    Route::prefix('stores')->controller(StoreController::class)->group(function () {
        Route::get('/', 'index')->name('store.index');
        Route::get('/create', 'create')->name('store.create');
        Route::post('/', 'store')->name('store.store');
        Route::post('/rack', 'rackStore')->name('rack.store');
        Route::post('/shelf', 'shelfStore')->name('shelf.store');
        Route::post('/bin', 'binStore')->name('bin.store');
        Route::get('/get-racks', 'getRacks')->name('store.getRacks');
        Route::get('/get-shelfs', 'getShelves')->name('store.getShelves');
        Route::get('/get-bins', 'getBins')->name('store.getBins');
        Route::get('/get-mapped-racks', 'getMappedRacks')->name('store.getMappedRacks');
        Route::get('/get-mapped-shelfs', 'getMappedShelves')->name('store.getMappedShelves');
        Route::get('/get-mapped-bins', 'getMappedBins')->name('store.getMappedBins');

        Route::get('/stores/searchRacks', 'searchRacks')->name('store.searchRacks');
        Route::get('/stores/searchShelves', 'searchShelves')->name('store.searchShelves');
        Route::get('/stores/searchBins', 'searchBins')->name('store.searchBins');


        Route::get('/{id}', 'show')->name('store.show');
        Route::get('/{id}/edit', 'edit')->name('store.edit');
        Route::put('/{id}', 'update')->name('store.update');
        Route::delete('/{id}', 'destroy')->name('store.destroy');
        Route::delete('/racks/{id}', 'destroyRack')->name('rack.delete');
        Route::delete('/shelfs/{id}', 'destroyShelf')->name('shelf.delete');
        Route::delete('/bins/{id}', 'destroyBin')->name('bin.delete');
    });

    Route::prefix('budgets')->controller(BudgetController::class)->group(function () {
        Route::get('/', 'index')->name('budget.index');
        Route::get('/create', 'create')->name('budget.create');
        Route::post('/', 'store')->name('budget.store');
        Route::get('/{budget}', 'show')->name('budget.show');
        Route::get('/edit/{budget}', 'edit')->name('budget.edit');
        Route::post('/{budget}', 'update')->name('budget.update');
        Route::delete('/{budget}', 'destroy')->name('budget.destroy');
        Route::get('/get-request/{book_id}', 'getRequests')->name('budget.requests');
    });

    Route::prefix('banks')->controller(BankController::class)->group(function () {
        Route::get('/', 'index')->name('bank.index');
        Route::get('/create', 'create')->name('bank.create');
        Route::post('/', 'store')->name('bank.store');
        Route::get('/search', 'search')->name('bank.search');
        Route::get('/{id}', 'show')->name('bank.show');
        Route::get('/{id}/edit', 'edit')->name('bank.edit');
        Route::put('/{id}', 'update')->name('bank.update');
        Route::delete('/bank-detail/{id}', 'deleteBankDetail')->name('bank-detail.delete');
        Route::delete('/{id}', 'destroy')->name('bank.destroy');
        Route::get('/get-request/{book_id}', 'getRequests')->name('bank.requests');
        Route::get('/ifsc/{id}', 'getIfscDetails')->name('bank.ifsc.details');
    });


    // Loan Progress Routes

    Route::prefix('loan/progress/appraisal')->controller(AppraisalController::class)
        ->name('loanAppraisal.')->group(function () {


            Route::get('/', 'index')->name('index');
            Route::get('/view', 'view')->name('view');
            Route::get('/home-loan/view/{id}', 'viewHomeLoan')->name('viewHomeLoan');
            Route::get('/vehicle-loan/view/{id}', 'viewVehicleLoan')->name('viewVehicleLoan');
            Route::get('/term-loan/view/{id}', 'viewTermLoan')->name('viewTermLoan');
            Route::get('/create/{id}', 'create')->name('create');
            Route::post('/save', 'save')->name('save');

            Route::post('/get-interest-rate', 'getInterestRate')->name('getInterestRate');
            Route::post('/get-dpr-fields', 'getDprFields')->name('getDprFields');
            Route::delete('/delete-document', 'deleteDocument')->name('deleteDocument');
            Route::post('/loan-return', 'loanReturn')->name('loan-return');
            Route::post('/loan-reject', 'loanReject')->name('loan-reject');
        });

    Route::prefix('loan/progress/approval')->controller(ApprovalController::class)
        ->name('loanApproval.')->group(function () {

            Route::get('/', 'index')->name('index');
            Route::get('/view', 'view')->name('view');
            Route::get('/home-loan/view/{id}', 'viewHomeLoan')->name('viewHomeLoan');
            Route::get('/vehicle-loan/view/{id}', 'viewVehicleLoan')->name('viewVehicleLoan');
            Route::get('/term-loan/view/{id}', 'viewTermLoan')->name('viewTermLoan');

            Route::post('/loan-approve', 'loanApprove')->name('loan-approve');
            Route::post('/loan-return', 'loanReturn')->name('loan-return');
            Route::post('/loan-reject', 'loanReject')->name('loan-reject');
        });

    Route::prefix('loan/progress/assessment')->controller(AssessmentController::class)
        ->name('loanAssessment.')->group(function () {

            Route::get('/', 'index')->name('index');
            Route::get('/view', 'view')->name('view');
            Route::get('/home-loan/view/{id}', 'viewHomeLoan')->name('viewHomeLoan');
            Route::get('/vehicle-loan/view/{id}', 'viewVehicleLoan')->name('viewVehicleLoan');
            Route::get('/term-loan/view/{id}', 'viewTermLoan')->name('viewTermLoan');
            Route::post('/assessment-proceed', 'assessmentProceed')->name('assessment-proceed');

            Route::post('/loan-return', 'loanReturn')->name('loan-return');
            Route::post('/loan-reject', 'loanReject')->name('loan-reject');
        });

    Route::prefix('loan/progress/legal-documentation')->controller(LegalDocumentationController::class)
        ->name('loanLegalDocumentation.')->group(function () {

            Route::get('/', 'index')->name('index');
            Route::get('/view', 'view')->name('view');
            Route::get('/home-loan/view/{id}', 'viewHomeLoan')->name('viewHomeLoan');
            Route::get('/vehicle-loan/view/{id}', 'viewVehicleLoan')->name('viewVehicleLoan');
            Route::get('/term-loan/view/{id}', 'viewTermLoan')->name('viewTermLoan');

            Route::post('/loan-legal-document', 'loanLegalDocument')->name('loan-legal-document');
            Route::post('/loan-return', 'loanReturn')->name('loan-return');
            Route::post('/loan-reject', 'loanReject')->name('loan-reject');
        });

    Route::prefix('loan/progress/processing-fee')->controller(ProcessingFeeController::class)
        ->name('loanProcessingFee.')->group(function () {

            Route::get('/', 'index')->name('index');
            Route::get('/view', 'view')->name('view');
            Route::get('/home-loan/view/{id}', 'viewHomeLoan')->name('viewHomeLoan');
            Route::get('/vehicle-loan/view/{id}', 'viewVehicleLoan')->name('viewVehicleLoan');
            Route::get('/term-loan/view/{id}', 'viewTermLoan')->name('viewTermLoan');

            Route::post('/loan-process', 'loanProcess')->name('loan-process');
            Route::get('/loan-invoice/posting/get', 'getPostingDetails')->name('getPostingDetails');
            Route::post('/loan-invoice/post', 'postInvoice')->name('post');
            Route::post('/loan-return', 'loanReturn')->name('loan-return');
            Route::post('/loan-reject', 'loanReject')->name('loan-reject');
        });

    Route::prefix('loan/progress/sanction-letter')->controller(SanctionLetterController::class)
        ->name('loanSanctionLetter.')->group(function () {

            Route::get('/', 'index')->name('index');
            Route::get('/view', 'view')->name('view');
            Route::get('/home-loan/view/{id}', 'viewHomeLoan')->name('viewHomeLoan');
            Route::get('/vehicle-loan/view/{id}', 'viewVehicleLoan')->name('viewVehicleLoan');
            Route::get('/term-loan/view/{id}', 'viewTermLoan')->name('viewTermLoan');

            Route::post('/loan-accept', 'loanAccept')->name('loan-accept');
            Route::post('/loan-return', 'loanReturn')->name('loan-return');
            Route::post('/loan-reject', 'loanReject')->name('loan-reject');
            // Route::post('/assessment-proceed', 'assessmentProceed')->name('assessment-proceed');

        });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
        Route::get('/services/edit/{id}', [ServiceController::class, 'edit'])->name('services.edit');
        Route::post('/services/update', [ServiceController::class, 'update'])->name('services.update');
    });

    //Route for Document Drive
    Route::get('/my-drive', [DocumentDriveController::class, 'index'])->name('document-drive.index');
    Route::get('/my-drive/shared-with-me/{id?}', [DocumentDriveController::class, 'sharedWithMe'])->name('document-drive.shared-with-me');
    Route::get('/my-drive/shared-drive/{id?}', [DocumentDriveController::class, 'sharedDrive'])->name('document-drive.shared-drive');
    Route::get('/my-drive/folder/{id}', [DocumentDriveController::class, 'show'])->name('document-drive.folder.show');
    Route::get('/my-drive/files/download/{id}', [DocumentDriveController::class, 'download'])->name('document-drive.files.download');
    Route::get('/my-drive/folders/download/{id}', [DocumentDriveController::class, 'downloadFolder'])->name('document-drive.folders.download');
    Route::delete('/my-drive/delete-file/{id}', [DocumentDriveController::class, 'file_destroy'])->name('document-drive.file.delete');
    Route::delete('/my-drive/delete-folder/{id}', [DocumentDriveController::class, 'folder_destroy'])->name('document-drive.folder.delete');
    Route::post('/my-drive/delete', [DocumentDriveController::class, 'destroy'])->name('document-drive.delete');
    Route::post('/my-drive/folder/create/{parentId?}', [DocumentDriveController::class, 'create_folder'])->name('document-drive.folder.store');
    Route::post('/my-drive/file/upload/{parentId?}', [DocumentDriveController::class, 'upload'])->name('document-drive.file.upload');
    Route::post('/my-drive/folder/upload/{parentId?}', [DocumentDriveController::class, 'uploadFolder'])->name('document-drive.folder.upload');
    Route::get('/my-drive/file/{id}', [DocumentDriveController::class, 'showFile'])->name('document-drive.file.show');
    Route::post('/my-drive/rename/{parent?}', [DocumentDriveController::class, 'rename'])->name('document-drive.rename');
    Route::post('/my-drive/move-to-folder', [DocumentDriveController::class, 'moveFolder'])->name('document-drive.movetofolder');
    Route::post('/my-drive/move-to-folder-multiple', [DocumentDriveController::class, 'moveFolderMultiple'])->name('document-drive.movetofolder.multiple');
    Route::post('/my-drive/share', [DocumentDriveController::class, 'share'])->name('document-drive.share');
    Route::post('/my-drive/share-all', [DocumentDriveController::class, 'shareMultiple'])->name('document-drive.share.all');
    Route::post('/my-drive/download-zip', [DocumentDriveController::class, 'downloadZip'])->name('document-drive.download-zip');
    Route::post('/my-drive/tags', [DocumentDriveController::class, 'addTagsToItems'])->name('document-drive.tags');

    Route::resource('file-tracking', FileTrackingController::class);
    Route::get('/file-tracking/file/{id}', [FileTrackingController::class, 'showFile'])->name('file-tracking.showFile');
    Route::get('/file-tracking/sign-file/{id}', [FileTrackingController::class, 'showSignFile'])->name('file-tracking.showSignFile');
    Route::post('/file-tracking/sign/{id}', [FileTrackingController::class, 'sign'])->name('file-tracking.sign');

    Route::resource('user-signature', UserSignatureController::class);
    Route::get('/user-signature/sign/{id}', [UserSignatureController::class, 'showFile'])->name('user-signature.showFile');
    Route::resource('fixed-asset/registration', RegistrationController::class)->names([
        'index' => 'finance.fixed-asset.registration.index',
        'create' => 'finance.fixed-asset.registration.create',
        'store' => 'finance.fixed-asset.registration.store',
        'show' => 'finance.fixed-asset.registration.show',
        'edit' => 'finance.fixed-asset.registration.edit',
        'update' => 'finance.fixed-asset.registration.update',
        'destroy' => 'finance.fixed-asset.registration.destroy',
    ]);
    Route::get('fixed-asset/getLedgerGroups', [RegistrationController::class, 'getLedgerGroups'])->name('finance.fixed-asset.getLedgerGroups');

    Route::resource('fixed-asset/issue-transfer', IssueTransferController::class)->names([
        'index' => 'finance.fixed-asset.issue-transfer.index',
        'create' => 'finance.fixed-asset.issue-transfer.create',
        'store' => 'finance.fixed-asset.issue-transfer.store',
        'show' => 'finance.fixed-asset.issue-transfer.show',
        'edit' => 'finance.fixed-asset.issue-transfer.edit',
        'update' => 'finance.fixed-asset.issue-transfer.update',
    ]);

    Route::resource('fixed-asset/insurance', InsuranceController::class)->names([
        'index' => 'finance.fixed-asset.insurance.index',
        'create' => 'finance.fixed-asset.insurance.create',
        'store' => 'finance.fixed-asset.insurance.store',
        'show' => 'finance.fixed-asset.insurance.show',
        'edit' => 'finance.fixed-asset.insurance.edit',
        'update' => 'finance.fixed-asset.insurance.update',
    ]);
    Route::resource('fixed-asset/maintenance', MaintenanceController::class)->names([
        'index' => 'finance.fixed-asset.maintenance.index',
        'create' => 'finance.fixed-asset.maintenance.create',
        'store' => 'finance.fixed-asset.maintenance.store',
        'show' => 'finance.fixed-asset.maintenance.show',
        'edit' => 'finance.fixed-asset.maintenance.edit',
        'update' => 'finance.fixed-asset.maintenance.update',
    ]);





});



Route::get('challengeform', [challengeExamFeeAllController::class, 'challengeindex'])->name('get-challengeform');

Route::get('/challengeform_edit', function () {
    return view('ums.challengeform.challengeform_edit');
});
Route::get('/challenge/view/{slug}', [ExamFeeAllController::class, 'view_challenge_form'])->name('view_challenge_form');
Route::get('/challenge/approve/{slug}', [ExamFeeAllController::class, 'approve_challenge'])->name('approve-challenge');
Route::get('challenge-form-view/{slug}', [ExaminationController::class, 'challengeformview'])->name('challenge-form-view');
Route::post('challenge-form-view/{slug}', [ExaminationController::class, 'challengeformviewpost']);
Route::get('delete_challenge_form/{slug}', [ExamFeeAllController::class, 'delete_challenge_form'])->name('delete_challenge_form');



//rekha

Route::get('/admit_card_list', [AdmitCardController::class, 'cardList'])->name('admit-card');
Route::get('/admit_card_list_edit/{id}', [AdmitCardController::class, 'index'])->name('admit_card_list_edit');
Route::post('/admit_card_list_edit/{id}', [AdmitCardController::class, 'adminCardApproval'])->name('admit_card_update');

// Route::get('admitcard-download',[AdmitCardControllerView::class,'index'])->name('download-admit-card');



Route::get('/Bulk_Admit_Card_Approval', [AdmitCardController::class, 'bulk_approve'])->name('Bulk_Admit_Card_Approval');
Route::post('/Bulk_Admit_Card_Approval', [AdmitCardController::class, 'bulk_approve_post']);


//master
Route::get('/campus_list', [CampusController::class, 'index'])->name('campus_list');
Route::post('/campus_list_add', [CampusController::class, 'addCampus'])->name('campus-list_add');
Route::get('/campus_list_add', function () {
    return view('ums.master.campus_list.campus_list_add');
});
Route::get('/campus_list_delete/{id}', [CampusController::class, 'softDelete'])->name('campus_list_delete');
Route::get('/campus_list_edit/{id}', [CampusController::class, 'editcampuses'])->name('campus_list_edit');
Route::put('/campus_list_edit', [CampusController::class, 'editCampus'])->name('campus_list_edit');
Route::get('/category_list', [CategoryController::class, 'index'])->name('category_list');
Route::get('/category_list_add', function () {
    return view('ums.master.category_list.category_list_add');
});
Route::post('/category_list_add', [CategoryController::class, 'addCategory'])->name('category_list_add');
Route::get('/category_list_edit/{id}', [CategoryController::class, 'editcategories'])->name('category_list_edit');
Route::put('/category_list_update', [CategoryController::class, 'editCategory'])->name('category_list_update');
Route::get('/category_list_delete/{id}', [CategoryController::class, 'softDelete'])->name('category_list_delete');
Route::get('/period_list', [PeriodController::class, 'index'])->name('get-periods');
Route::get('/period_list_add', function () {
    return view('ums.master.period_list.period_list_add');
});
Route::post('/add-period', [PeriodController::class, 'addPeriod'])->name('add-period');
Route::get('/period_list_edit/{id}', [PeriodController::class, 'editperiods'])->name('period_list_edit');
Route::post('/period_list_edit', [PeriodController::class, 'editPeriod'])->name('update_period');

Route::get('/exam_center_add', function () {
    return view('ums.master.exam_center.Exam_center_add');
});

Route::get('/exam_center/export', [ExamCenterController::class, 'examEenterExport']);
Route::get('/exam_center', [ExamCenterController::class, 'index'])->name('exam_center');
Route::post('/exam_center/add', [ExamCenterController::class, 'add']);
Route::get('/exam_center_edit/{id}', [ExamCenterController::class, 'edit'])->name('Exam_center_edit');
Route::put('/exam_center/update/{id}', [ExamCenterController::class, 'update'])->name('exam_center.update');

Route::post('/exam_center/delete/{id}', [ExamCenterController::class, 'delete'])->name('exam_center.destroy');


Route::get('/department_faculty', [DepartmentFacaultiesController::class, 'index'])->name('department_faculty');
Route::get('/department_faculty/add', [DepartmentFacaultiesController::class, 'addPage'])->name('department_faculty_add');;
Route::post('/department_faculty/add', [DepartmentFacaultiesController::class, 'add'])->name('department_facultyadd');
Route::get('/department_faculty/edit/{id}', [DepartmentFacaultiesController::class, 'edit']);
Route::put('/department_faculty/{id}', [DepartmentFacaultiesController::class, 'update'])->name('department_faculty.update');
Route::get('/department_faculty/delete/{id}', [DepartmentFacaultiesController::class, 'delete'])->name('department_faculty.delete');

Route::get('/department', [DepartmentController::class, 'index'])->name('get-department');
Route::get('/department_add', [DepartmentController::class, 'addPage']);
Route::post('/department_add', [DepartmentController::class, 'add']);
Route::get('/department_edit/{id}', [DepartmentController::class, 'edit']);
Route::put('/department_update/{id}', [DepartmentController::class, 'update']);
Route::get('/department_delete/{id}', [DepartmentController::class, 'delete']);
Route::get('/department_export', [DepartmentController::class, 'departmentExport']);

Route::get('/subject_list', [SubjectController::class, 'index'])->name('subject_list');
Route::get('/subject_list_edit', function () {
    return view('ums.master.subject_list.subject_list_edit');
});


Route::get('/subject_add', [SubjectController::class, 'add']);


Route::POST('/subject_add', [SubjectController::class, 'addSubject'])->name('add-subject');
Route::get('/master/subject/edit-subject/{slug}', [SubjectController::class, 'editsubjects'])->name('edit-subject-form');
Route::PUT('/master/subject/edit-subject-form', [SubjectController::class, 'editSubject'])->name('update-subject-form');
Route::get('/master/subject/delete-subject-form/{slug}', [SubjectController::class, 'softDelete'])->name('delete-subject-form');

Route::get('/subject_list/edit/{id}', [SubjectController::class, 'editsubjects'])->name('edit-subject');
Route::post('/subject_list/update/{id}', [SubjectController::class, 'editSubject'])->name('update-subject');
Route::post('/get-semesters', [SubjectController::class, 'get_Semester'])->name('get-semesters');
Route::post('/get-streams', [SubjectController::class, 'get_stream'])->name('get-streams');
Route::get('/subject_bulk_upload', [SubjectController::class, 'subjectBulk'])->name('subject_bulk_upload');
Route::get('/subject_bulk_save', [SubjectController::class, 'subjectBulkSave']);
Route::get('/subject_bulk_delete/{id}', [SubjectController::class, 'softDelete'])->name('subject_bulk_delete');
Route::get('/subject_bulk_edit/{id}', [SubjectController::class, 'editsubjects'])->name('subject_bulk_edit');
Route::POST('/subject_bulk_update', [SubjectController::class, 'editSubject'])->name('subject_bulk_update');
// Route ::post('/get-semesters',[SubjectController::class,'get_Semester'])->name('get-semesters');
// Route ::post('/get-streams',[SubjectController::class,'get_stream'])->name('get-streams');


Route::get('/phd_entrance_add', function () {
    return view('ums.master.entrance_exam.phd_entrance_add');
});

Route::get('/phd_entrance_exam', [EntranceExamScheduleController::class, 'index'])->name('phd-entrance-exam');
Route::post('/phd_entrance_post', [EntranceExamScheduleController::class, 'add'])->name('phd-entrance-exam_add');
Route::get('/phd_entrance_edit/{id}', [EntranceExamScheduleController::class, 'edit'])->name('phd_entrance_edit');
Route::put('/phd_entrance_update/{id}', [EntranceExamScheduleController::class, 'update'])->name('entrance_exam_update');
Route::get('/phd_entrance_delete/{id}', [EntranceExamScheduleController::class, 'delete'])->name('phd_entrance_delete');

Route::get('/entrance_exam', [EntranceExamConrtoller::class, 'index'])->name('get-entrance-exam');
Route::get('/Entrance_exam_add', [EntranceExamConrtoller::class, 'add'])->name('add-entrance-exam');
Route::POST('/Entrance_exam_add', [EntranceExamConrtoller::class, 'addEntranceExam'])->name('post-entrance-exam');
Route::get('/delete-entrance-exam/{id}', [EntranceExamConrtoller::class, 'softDelete'])->name('delete-entrance-exam');


Route::get('/shift_list', [ShiftController::class, 'index'])->name('get-shift');
Route::post('/shift_add', [ShiftController::class, 'addShift'])->name('add_shift');
Route::get('/shift_edit/{id}', [ShiftController::class, 'editshifts'])->name('shift_edit');
Route::put('/shift_update', [ShiftController::class, 'editShift'])->name('update_shift');
Route::post('/shift_add', [ShiftController::class, 'addShift'])->name('add_shift');
Route::get('/shift_delete/{id}', [ShiftController::class, 'softDelete'])->name('delete_shift');
Route::get('/shift_add', function () {
    return view('ums.master.shift.shift_add');
});
Route::get('/notification', [MasterNotificationController::class, 'index'])->name('notification');
Route::post('/notification_post', [MasterNotificationController::class, 'add'])->name('notification_post');
Route::get('/notification_edit/{id}', [MasterNotificationController::class, 'edit'])->name('notification_edit');
Route::put('/notification_update/{update}', [MasterNotificationController::class, 'update'])->name('notification_update');
Route::get('/notification_delete/{id}', [MasterNotificationController::class, 'delete'])->name('notification_delete');

Route::get('/notification_add', function () {
    return view('ums.master.notification.notification_add');
});


Route::get('/semester_list', [SemesterController::class, 'index'])->name('semester_list');
Route::post('/semester_list_add', [SemesterController::class, 'addSemester'])->name('semester_list_add');
Route::get('/semester_list_add', [SemesterController::class, 'add'])->name('semester_list_add');

Route::get('/semester_list_edit/{slug}', [SemesterController::class, 'editsemesters'])->name('semester_list_edit');

Route::put('/semester_list_edit/{slug}', [SemesterController::class, 'editSemester'])->name('semester_list_update');
Route::get('/semester_list_delete/{slug}', [SemesterController::class, 'softDelete'])->name('semester_list_delete');


Route::get('/course_list', [CourseController::class, 'index'])->name('course_list');
Route::get('/course_fee', function () {
    return view('ums.master.course.course_fees');
});

Route::get('/add_course', [CourseController::class, 'add'])->name('course_list_add');

Route::post('/add_course', [CourseController::class, 'addCourse'])->name('course_list_add');
Route::get('/course_list_edit/{id}', [CourseController::class, 'editcourses'])->name('course_list_edit');
Route::put('/course_list_update', [CourseController::class, 'editCourse'])->name('course_list_update');
Route::get('/course_list_delete/{id}', [CourseController::class, 'softDelete'])->name('course_list_delete');



Route::get('/affiliate_circular', [AffiliateCircularController::class, 'index']);
Route::get('/affiliate_circular_add', [AffiliateCircularController::class, 'addView']);
Route::post('/affiliate_circular_add', [AffiliateCircularController::class, 'add']);
Route::get('/affiliate_circular_edit/{id}', [AffiliateCircularController::class, 'edit']);
Route::get('/affiliate_circular_delete/{id}', [AffiliateCircularController::class, 'delete']);
Route::put('/affiliate_circular_update/{id}', [AffiliateCircularController::class, 'update']);
Route::get('/affiliate_circular_export', [AffiliateCircularController::class, 'affiliateCircularExport']);

Route::get('/affiliate_circular_edit', function () {
    return view('ums.master.affiliate.affiliate_circular_edit');
});
Route::get('/affiliate_circular_add', function () {
    return view('ums.master.affiliate.affiliate_circular_add');
});

Route::get('question_bank', [QuestionBankController::class, 'index'])->name('questionbankdownload');
Route::get('/add_question_bank', function () {
    return view('ums.master.question_bank.add_question_bank');
});
Route::get('add_question_bank', [QuestionBankController::class, 'add'])->name('question-bank-add');
Route::post('add_question_bank', [QuestionBankController::class, 'addQuestionBank'])->name('question-bank-save');

Route::post('get-questionbank-subject', [QuestionBankController::class, 'get_Subject'])->name('get-questionbank-subject');

Route::post('/get-questionbank-semester', [QuestionBankController::class, 'get_Semester'])->name('get-questionbank-semester');

Route::post('/get-course', [SubjectController::class, 'get_programm'])->name('get-courses');
Route::POST('ums/master/stream/get-course-list', [StreamController::class, 'getCourseList']);


Route::get('/holiday_calender', [HolidayCalenderController::class, 'holidayCalender'])->name('holiday_calender');

// Route to save holiday data (POST method)
Route::post('/holiday_calender/save', [HolidayCalenderController::class, 'holidayCalenderSave'])->name('holidayCalenderSave');

Route::get('/holiday_calender/delete/{id}', [HolidayCalenderController::class, 'holidayCalenderDelete'])->name('holidayCalenderDelete');
Route::get('/add_holiday_calender', function () {
    return view('ums.master.holiday_calender.add_holiday_calender');
});


Route::get('/add_grading', function () {
    return view('ums.master.grading.add_grading');
});


Route::get('/fees_list', [FeeController::class, 'index'])->name('master.fees_list');
Route::get('/add_fee_list', [FeeController::class, 'add']);
Route::post('/submit-fee-form', [FeeController::class, 'addCourseSession']);
Route::get('delete_fee/{id}', [FeeController::class, 'softDelete'])->name('delete_fee');

Route::get('/fee_list_edit/{id}', [FeeController::class, 'editcoursesessions'])->name('fee_list_edit');
Route::post('/edit-fee-form/{id?}', [FeeController::class, 'editCoursesession'])->name('edit-fee');

Route::get('/old_grading', [OldGradeController::class, 'index']);
Route::get('oldgrade_delete/{id}', [OldGradeController::class, 'oldgrade_delete'])->name('oldgrade_delete');



Route::get('/stream_list', [StreamController::class, 'index'])->name('stream_list');
Route::get('/add_stream_list', [StreamController::class, 'add'])->name('add_stream');  // For viewing the form
Route::post('/add_stream_list', [StreamController::class, 'addStream'])->name('add_stream_list');  // For handling form submission
Route::get('/stream_list_edit/{id}', [StreamController::class, 'editstreams'])->name('stream_list_edit');  // For handling form submission
Route::put('/stream_list_update', [StreamController::class, 'editStream'])->name('stream_list_update');  // For handling form submission
Route::get('/stream_list_delete/{id}', [StreamController::class, 'softDelete'])->name('stream_list_delete');  // For handling form submission
//master
//admission
Route::get('/admission_list', function () {
    return view('ums.admissions.admission_list');
});

Route::get('/council_data', [AdmissionController::class, 'counciledData'])->name('council-data');

Route::get('/course_transfer', [CourseSwitchingController::class, 'courseSwitching'])->name('course-transfer');
Route::get('bulk_counselling', [CouncellingController::class, 'bulkCouncelling']);
Route::get('/admission_counselling', [AdmissionController::class, 'applicationCouncil'])->name('admission-counselling');
Route::POST('/admission_counselling', [AdmissionController::class, 'saveCouncil'])->name('admission-counselling_post');
Route::POST('bulk_counselling', [CouncellingController::class, 'bulkCouncellingSave']);
Route::POST('/course_transfer', [CourseSwitchingController::class, 'courseSwitchingSave']);
Route::get('/entrance_exam_schedule', [EntranceExamScheduleController::class, 'index'])->name('entrance-exam-schedule');
Route::get('/enrolled_student', [AdmissionController::class, 'enrolledStudent'])->name('enrolled-student');
//admission
//rekha



//sheetal
Route::get('/affiliate_circular', [AffiliateCircularController::class, 'index']);
Route::get('/affiliate_circular_add', [AffiliateCircularController::class, 'addView']);
Route::post('/affiliate_circular_add', [AffiliateCircularController::class, 'add']);
Route::get('/affiliate_circular_edit/{id}', [AffiliateCircularController::class, 'edit']);
Route::get('/affiliate_circular_delete/{id}', [AffiliateCircularController::class, 'delete']);
Route::put('/affiliate_circular_update/{id}', [AffiliateCircularController::class, 'update']);
Route::get('/affiliate_circular_export', [AffiliateCircularController::class, 'affiliateCircularExport']);
//sheetal




//dhan and manish
Route::get('internal_submit', [ResultController::class, 'internal'])->name('internal_submit');

Route::get('edit_result', [ResultController::class, 'getSingleResult'])->name('edit_result');

Route::get('result_list', [ResultController::class, 'allResults'])->name('result_list');

Route::get('/final_back_tr_view', [TrController::class, 'finalBackUniversityTrView'])->name('finalBackUniversityTrView');

Route::get('/final_back_tr_generate', [TrController::class, 'finalBackTr'])->name('finalBackTr');

Route::get('tabulation_chart', [ReportController::class, 'tabulationChart'])->name('tabulationChart');

Route::get('/md_tr_generate', [TrController::class, 'mdTrView'])->name('md-tr-view');

Route::get('/regular_tr_view', [TrController::class, 'universityTrView'])->name('university-tr-view');

Route::get('/regular_tr_generate', [TrController::class, 'index'])->name('university-tr');

//result approve
Route::get('semester_result_bulk', [ResultController::class, 'semesterResultBulk']);

Route::get('semester_result', [ResultController::class, 'view']);

Route::get('nursing_result_bulk', [ResultController::class, 'nursingResultBulk']);

Route::get('/md_marksheet', [MdResultController::class, 'mdMarksheet'])->name('md_marksheet');

Route::get('md_marksheet_list', [MdResultController::class, 'mdMarksheetList'])->name('md-marksheet-list');



Route::get('mark_sheet_position', [ReportController::class, 'marksheetPositionUpdate'])->name('marksheet-position-update');

Route::get('cgpa_report', [ReportController::class, 'cgpaReport'])->name('reportscgpa_report');

Route::get('/studying_student_report', [ReportController::class, 'studyingStudents'])->name('reports.studyingStudents');

Route::get('/medal_list', [ReportController::class, 'medalListCgpa'])->name('reports.medal_list');

Route::get('/scholarship_report', [ReportController::class, 'scholarshipReport'])->name('reports.scholarshipreport');

Route::get('/scholarship_report_new', [ReportController::class, 'scholarshipReport1'])->name('reports.scholarshipreport1');

Route::get('/passed_student_report', [ReportController::class, 'passedStudentReport'])->name('reports.passedstudentreport');

Route::get('/pass_out_student_report', [ReportController::class, 'passOutStudentReport'])->name('reports.passout-student-report');

Route::get('/nirf_report', [ReportController::class, 'nirfreport'])->name('nirf-Report');

Route::get('/mbbs_security_report', [ReportController::class, 'scrutinyReport'])->name('mbbs_security_report');

Route::get('/Mark_Filling_Report', [ReportController::class, 'markFillingReport'])->name('markFillingReport');

Route::get('/edit-subject/{slug}', [SubjectController::class, 'editsubjects']);

Route::get('/filled-mark-details', [ReportController::class, 'filledMarkDetails'])->name('filledMarkDetails');

Route::get('/enrollment_report', [ReportController::class, 'allenrollreport'])->name('reports.allenrollmentReport');

Route::get('/enrollment_summary', [ReportController::class, 'countEnrolledStudent'])->name('count-enrolled-report');

Route::get('/disability_report_list', [ReportController::class, 'disabilityReport'])->name('reports.disabilityreport');

Route::get('/digilocker_list', [ReportController::class, 'digilockerList'])->name('reports.digilockerList');

Route::get('/digi_shakti_report', [ReportController::class, 'digiShaktiReport'])->name('reports.digishaktireport');

Route::get('/degree_report_list', [ReportController::class, 'degreeListReport'])->name('reports.degreeListReport');

Route::get('/chart_for_maximum_marks', [ReportController::class, 'chartForMaxMarks'])->name('reports.chartForMaxMarks');

Route::get('/award_sheet_for_all', [ReportController::class, 'awardsheet'])->name('awardsheet-all');

Route::get('/Application_Report', [ReportController::class, 'applicationReportList'])->name('Application_Report');

Route::post('/get-course', [SubjectController::Class, 'get_programm'])->name('get-courses');

Route::get('/all_studying_student', [ReportController::class, 'allstudyingStudents'])->name('allstudyingStudents');

Route::get('/tr_summary', [ReportController::class, 'trSummary'])->name('tr_summary');

Route::get('/regular_exam_form_report', [ReportController::class, 'regularPaperReport'])->name('reports.regular-exam-report');
//dhan and manish

//danish
// Route::get('/faculty_dashboard', function () {
//     return view('ums.master.faculty.faculty_dashboard');
// });
Route::get('/faculty_dashboard', [FacultyController::class,'index']);

// Route::get('/faculty_edit', function () {
//     return view('ums.master.faculty.faculty_edit');
// });
// Route::get('/faculty_add', function () {
//     return view('ums.master.faculty.faculty_add');
// });
// Route::get('/facultynotification', [NotificationController::class, 'index2']);

Route::get('/Holiday', [FacultyDashboardController::class, 'holidayCalenderForFaculty']);

Route::get('/time_table', [TimetableController::class, 'index']);

Route::get('/time_table_add', [LectureScheduleController::class, 'add']);
Route::post('/time_table_add', [LectureScheduleController::class, 'addtimetable'])->name('time-table-add');
Route::post('/fetch-semester', [LectureScheduleController::class, 'fetchSemester'])->name('fetch-semester');
Route::post('/fetch-subject', [LectureScheduleController::class, 'fetchSubject'])->name('fetch-subject');

// Route to show the edit form
Route::get('/time_table_edit/{id}', [TimetableController::class, 'edittimetables']);
Route::post('/time_table', [TimetableController::class, 'editTimetable'])->name('get-timetables');
Route::get('/time_table_delete/{id}', [TimetableController::class, 'softDelete']);

// Route to handle the form submission for updating the timetable
Route::get('/attendance', [AttendenceController::class, 'index']);
Route::get('/show_Attendance', [AttendenceController::class, 'searchAttendence']);

Route::get('/lecture_schedule', function () {
    return view('ums.master.faculty.lecture_schedule');
});

Route::get('external_marks', [ExternalMarksController::class, 'external']);
// Route::post('external_marks', [ExternalMarksController::class, 'externalMarksShow']);

//ajax route for dashboard
Route::post('/getsemester',  [InternalMarksController::class, 'get_semester']);
Route::post('/getsubject', [InternalMarksController::class, 'get_subject']);
Route::post('/get_month_year', [InternalMarksController::class, 'get_month_year']);

// Route::get('/internal-marks-list', [InternalMarksController::class, 'index'])->name('internal-marks-list');

// Route::get('internal_marks', [InternalMarksController::class, 'internal']);


Route::get('/internal-marks-list', [InternalMarksController::class, 'index'])->name('internal-marks-list');
Route::get('internal-marks', [InternalMarksController::class, 'internal'])->name('internal-marks');
Route::post('internal-marks', [InternalMarksController::class, 'post_internal']);
Route::get('/semester/{id}', [InternalMarksController::class, 'get_semester'])->name('semester');



// Route::get('/practical_marks_filling', function () {
//     return view('ums.master.faculty.practical_marks');
// });

Route::get('practical_marks_filling', [PracticalMarksController::class, 'index']);
Route::get('/practical-marks', [PracticalMarksController::class, 'practical'])->name('practical-marks');
Route::post('/practical-marks', [PracticalMarksController::class, 'post_practical']);
Route::get('/practical-marks-show', [PracticalMarksController::class, 'practicalMarksShow'])->name('practical-marks-show');
Route::get('/internal-marks/internal-marks-export', [InternalMarksController::class, 'internalMarksExport'])->name('internalMarksExport');

//setting
//setting

Route::post('/get-course-data', [StudentExaminationController::Class, 'get_Course'])->name('get-courses-data');


Route::get('/open_admission_edit_form', [SettingController::class, 'admissionSettingEdit'])->name('open_addmission_edit_form');

Route::get('open_exam_form', [SettingController::class, 'index'])->name('open-exam-form');
Route::post('open_exam_form', [SettingController::class, 'store']);
Route::get('delete-from-setting/{id}', [SettingController::class, 'destroy']);

Route::get('open_addmission_form/{type}', [SettingController::class, 'admissionSetting'])->name('open_admission_form');
// Route::get('open_addmission_form', [SettingController::class, 'admissionSetting'])->name('open_addmission_form');
// Route::post('open_addmission_form', [SettingController::class, 'admissionSettingStore'])->name('open_addmission_form_Post');
Route::post('open_addmission_form/{type}', [SettingController::class, 'admissionSettingStore'])->name('open_admission_form_Post');
Route::get('delete-admission-setting/{id}', [SettingController::class, 'deleteAdmissionSetting']);

//reports//
Route::get('all_enrollment', [ReportController::class, 'all_enrollment_list'])->name('all-enrollment-list');

Route::get('all-enrollment-list-export', [ReportController::class, 'enrollmentListExport'])->name('enrollmentListExport');

Route::get('/mbbs_result', [MbbsResultController::class, 'mbbs_all_result'])->name('admin.all-mbbs-result');

Route::get('/bulk_result', [MbbsResultController::class, 'mbbsResult'])->name('admin.mbbs-result');

Route::get('mark_sheet_position', [ReportController::class, 'marksheetPositionUpdate'])->name('marksheet-position-update');

Route::get('cgpa_report', [ReportController::class, 'cgpaReport'])->name('reportscgpa_report');

Route::get('/studying_student_report', [ReportController::class, 'studyingStudents'])->name('reports.studyingStudents');

Route::get('/medal_list', [ReportController::class, 'medalListCgpa'])->name('reports.medal_list');

Route::get('/scholarship_report', [ReportController::class, 'scholarshipReport'])->name('reports.scholarshipreport');

Route::get('/scholarship_report_new', [ReportController::class, 'scholarshipReport1'])->name('reports.scholarshipreport1');

Route::get('/passed_student_report', [ReportController::class, 'passedStudentReport'])->name('reports.passedstudentreport');

Route::get('/pass_out_student_report', [ReportController::class, 'passOutStudentReport'])->name('reports.passout-student-report');

Route::get('/nirf_report', [ReportController::class, 'nirfreport'])->name('nirf-Report');

Route::get('/mbbs_security_report', [ReportController::class, 'scrutinyReport'])->name('mbbs_security_report');

Route::get('/Mark_Filling_Report', [ReportController::class, 'markFillingReport'])->name('markFillingReport');

Route::get('/edit-subject/{slug}', [SubjectController::class, 'editsubjects']);

Route::get('/filled-mark-details', [ReportController::class, 'filledMarkDetails'])->name('filledMarkDetails');

Route::get('/enrollment_report', [ReportController::class, 'allenrollreport'])->name('reports.allenrollmentReport');

Route::get('/enrollment_summary', [ReportController::class, 'countEnrolledStudent'])->name('count-enrolled-report');

Route::get('/disability_report_list', [ReportController::class, 'disabilityReport'])->name('reports.disabilityreport');

Route::get('/digilocker_list', [ReportController::class, 'digilockerList'])->name('reports.digilockerList');

Route::get('/digi_shakti_report', [ReportController::class, 'digiShaktiReport'])->name('reports.digishaktireport');

Route::get('/degree_report_list', [ReportController::class, 'degreeListReport'])->name('reports.degreeListReport');

Route::get('/chart_for_maximum_marks', [ReportController::class, 'chartForMaxMarks'])->name('reports.chartForMaxMarks');

Route::get('/award_sheet_for_all', [ReportController::class, 'awardsheet'])->name('awardsheet-all');

Route::get('/Application_Report', [ReportController::class, 'applicationReportList'])->name('Application_Report');

Route::post('/get-course', [SubjectController::Class, 'get_programm'])->name('get-courses');

Route::get('/all_studying_student', [ReportController::class, 'allstudyingStudents'])->name('allstudyingStudents');

Route::get('/tr_summary', [ReportController::class, 'trSummary'])->name('tr_summary');

Route::get('/regular_exam_form_report', [ReportController::class, 'regularPaperReport'])->name('reports.regular-exam-report');

// Route::get('all_enrollment', [ReportController::class, 'all_enrollment_list'])->name('all-enrollment-list');
// Route::get('all-enrollment-list-export', [ReportController::class, 'enrollmentListExport'])->name('enrollmentListExport');

// Route::get('/mbbs_result', [MbbsResultController::class, 'mbbs_all_result'])->name('admin.all-mbbs-result');

// Route::get('/bulk_result', [MbbsResultController::class, 'mbbsResult'])->name('admin.mbbs-result');

// Route::get('mark_sheet_position', [ReportController::class, 'marksheetPositionUpdate'])->name('marksheet-position-update');

// Route::get('cgpa_report', [ReportController::class, 'cgpaReport'])->name('reportscgpa_report');

// Route::get('/studying_student_report', [ReportController::class, 'studyingStudents'])->name('reports.studyingStudents');

// Route::get('/medal_list', [ReportController::class, 'medalListCgpa'])->name('reports.medal_list');

// Route::get('/scholarship_report', [ReportController::class, 'scholarshipReport'])->name('reports.scholarshipreport');

// Route::get('/scholarship_report_new', [ReportController::class, 'scholarshipReport1'])->name('reports.scholarshipreport1');

// Route::get('/passed_student_report', [ReportController::class, 'passedStudentReport'])->name('reports.passedstudentreport');

// Route::get('/pass_out_student_report', [ReportController::class, 'passOutStudentReport'])->name('reports.passout-student-report');

// Route::get('/nirf_report', [ReportController::class, 'nirfreport'])->name('nirf-Report');

// Route::get('/mbbs_security_report', [ReportController::class, 'scrutinyReport'])->name('mbbs_security_report');

// Route::get('/Mark_Filling_Report', [ReportController::class, 'markFillingReport'])->name('markFillingReport');

// Route::get('/edit-subject/{slug}', [SubjectController::class, 'editsubjects']);

// Route::get('/filled-mark-details', [ReportController::class, 'filledMarkDetails'])->name('filledMarkDetails');

// Route::get('/enrollment_report', [ReportController::class, 'allenrollreport'])->name('reports.allenrollmentReport');

// Route::get('/enrollment_summary', [ReportController::class, 'countEnrolledStudent'])->name('count-enrolled-report');

// Route::get('/disability_report_list', [ReportController::class, 'disabilityReport'])->name('reports.disabilityreport');

// Route::get('/digilocker_list', [ReportController::class, 'digilockerList'])->name('reports.digilockerList');

// Route::get('/digi_shakti_report', [ReportController::class, 'digiShaktiReport'])->name('reports.digishaktireport');

// Route::get('/degree_report_list', [ReportController::class, 'degreeListReport'])->name('reports.degreeListReport');

// Route::get('/chart_for_maximum_marks', [ReportController::class, 'chartForMaxMarks'])->name('reports.chartForMaxMarks');

// Route::get('/award_sheet_for_all', [ReportController::class, 'awardsheet'])->name('awardsheet-all');

// Route::get('/Application_Report', [ReportController::class, 'applicationReportList'])->name('Application_Report');

// Route::post('/get-course', [SubjectController::Class, 'get_programm'])->name('get-courses');

// Route::get('/all_studying_student', [ReportController::class, 'allstudyingStudents'])->name('allstudyingStudents');

// Route::get('/tr_summary', [ReportController::class, 'trSummary'])->name('tr_summary');

// Route::get('/regular_exam_form_report', [ReportController::class, 'regularPaperReport'])->name('reports.regular-exam-report');
//setting


//report
Route::get('cgpa_update', function () {
    Artisan::call('command:ResultCGPAUpdate');
    return "Updated!";
});

Route::get('ResultSerialNoUpdate', function () {
    Artisan::call('command:ResultSerialNoUpdate');
    return "Done!";
});

// Route::get('one-view-result/{roll_no}', [HomeController::class , 'oneViewResult'])->name('oneViewResult');

Route::get('internal_submit', [ResultController::class, 'internal'])->name('internal_submit');

Route::get('edit_result/{id}', [ResultController::class, 'getSingleResult'])->name('edit_result');

Route::get('result_list', [ResultController::class, 'allResults'])->name('result_list');

Route::get('/final_back_tr_view', [TrController::class, 'finalBackUniversityTrView'])->name('finalBackUniversityTrView');

Route::get('/final_back_tr_generate', [TrController::class, 'finalBackTr'])->name('finalBackTr');

Route::get('tabulation_chart', [ReportController::class, 'tabulationChart'])->name('tabulationChart');

Route::get('/md_tr_generate', [TrController::class, 'mdTrView'])->name('md-tr-view');

Route::get('/regular_tr_view', [TrController::class, 'universityTrView'])->name('university-tr-view');

Route::get('/regular_tr_generate', [TrController::class, 'index'])->name('university-tr');

//result approve
Route::get('semester_result_bulk', [ResultController::class, 'semesterResultBulk']);

Route::get('semester_result', [ResultController::class, 'view']);

Route::get('nursing_result_bulk', [ResultController::class, 'nursingResultBulk']);

Route::get('/md_marksheet', [MdResultController::class, 'mdMarksheet'])->name('md_marksheet');

Route::get('md_marksheet_list', [MdResultController::class, 'mdMarksheetList'])->name('md-marksheet-list');
//report