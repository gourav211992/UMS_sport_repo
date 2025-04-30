<?php

use App\Helpers\Helper;
use App\Http\Controllers\ums\SportsForgotPasswordController;
use App\Http\Controllers\DPRTemplateController;
use App\Http\Controllers\EinvoicePdfController;
use App\Http\Controllers\DocumentDriveController;
use App\Http\Controllers\ErpDprMasterController;
use App\Http\Controllers\ErpMaterialIssueController;
use App\Http\Controllers\ErpMaterialReturnController;
use App\Http\Controllers\ErpTransporterRequestController;
use App\Http\Controllers\ErpTransportersController;
use App\Http\Controllers\ErpProductionSlipController;
use App\Http\Controllers\OrganizationServiceController;
use App\Http\Controllers\LoanProgress\AppraisalController;
use App\Http\Controllers\LoanProgress\ApprovalController;
use App\Http\Controllers\LoanProgress\AssessmentController;
use App\Http\Controllers\LoanProgress\LegalDocumentationController;
use App\Http\Controllers\LoanProgress\ProcessingFeeController;
use App\Http\Controllers\PWOController;
use App\Http\Controllers\ErpPublicOutreachAndCommunicationController;
use App\Http\Controllers\SubStoreController;
use App\Http\Controllers\refined_index\IndexController;
use App\Http\Controllers\UserSignatureController;
use App\Http\Controllers\CrDrReportController;
use App\Http\Controllers\FixedAsset\SetupController;
use App\Http\Controllers\FixedAsset\DepreciationController;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\AssetCategoryController;
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
use App\Http\Controllers\ComplaintManagementController;
use App\Http\Controllers\Stakeholder\StakeholderController;
use App\Http\Controllers\FeedbackProcessController;


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
use App\Http\Controllers\StationGroupController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\BookTypeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StockAccountController;
use App\Http\Controllers\CogsAccountController;
use App\Http\Controllers\GrAccountController;
use App\Http\Controllers\WipAccountController;
use App\Http\Controllers\SalesAccountController;
use App\Http\Controllers\PriceVarianceAccountController;
use App\Http\Controllers\PurchaseReturnAccountController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ErpShelfController;
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
use App\Http\Controllers\ExpenseAdviseController;
use App\Http\Controllers\VehicleLoan\VehicleLoanController;
use App\Http\Controllers\TermsAndConditionController;
use App\Http\Controllers\InventoryReportController;
use App\Http\Controllers\BillOfMaterial\BomController;
use App\Http\Controllers\BillOfMaterial\BomImportController;
use App\Http\Controllers\CostCenter\CostGroupController;
use App\Http\Controllers\ProductSpecificationController;
use App\Http\Controllers\CostCenter\CostCenterController;
use App\Http\Controllers\LoanManagement\LoanReportController;
use App\Http\Controllers\LoanManagement\LoanDisbursementReportController;
use App\Http\Controllers\LoanManagement\LoanRepaymentReportController;
use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\LoanManagement\LoanDashboardController;
use App\Http\Controllers\LoanManagement\LoanManagementController;
use App\Http\Controllers\LoanManagement\LoanInterestRateController;
use App\Http\Controllers\LoanManagement\LoanFinancialSetupController;
use App\Http\Controllers\PurchaseOrder\PurchaseOrderReportController;

use App\Http\Controllers\PurchaseBillController;
use App\Http\Controllers\DiscountMasterController;
use App\Http\Controllers\ExpenseMasterController;
use App\Http\Controllers\GateEntryController;
use App\Http\Controllers\PurchaseReturnController;
use App\Http\Controllers\ProductionRouteController;
use App\Http\Controllers\ManufacturingOrder\MoController;
use App\Http\Controllers\EInvoiceServiceController;
use App\Http\Controllers\GstValidationController;
use App\Http\Controllers\Finance\GstrController;
use App\Http\Controllers\ums\sports\SportFeeController;
use App\Http\Controllers\ums\SportRegisterController;
use App\Http\Controllers\ums\sports\SportsMasterController;
use App\Http\Controllers\ums\SportsController;
use App\Http\Controllers\ums\sports\SportMasterController;
use App\Http\Controllers\ums\sports\GroupMasterController;
use App\Http\Controllers\ums\sports\Activity\ScreeningMasterController;
use App\Http\Controllers\ums\sports\Activity\ActivityMasterController;
use App\Http\Controllers\ums\sports\Activity\ActivitySchedulerController;
use App\Http\Controllers\ums\sports\Activity\MyActivityController;

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
Route::prefix('sportquest')->group(function () {
    Route::get('sport-confirm-stu/{id}', [SportRegisterController::class,'confirm'])->name('sport-confirm-stu');

    Route::get('sports-login',[SportRegisterController::class, 'login'])->name('sports.login');
    Route::get('sports/password/reset', [SportsForgotPasswordController::class, 'showForgotForm'])->name('sports.password.request');
    Route::post('sports/password/email', [SportsForgotPasswordController::class, 'sendResetLink'])->name('sports.password.email');
    Route::get('sports/password/reset/{token}', [SportsForgotPasswordController::class, 'showResetForm'])->name('sports.password.reset');
    Route::post('sports/password/reset', [SportsForgotPasswordController::class, 'resetPassword'])->name('sports.password.update');

    Route::get('sports-register', function () {
        return view('ums.sports.register');
    })->name('sports.register');

    Route::post('sports-register', [SportsController::class, 'register'])->name('sports-register');
    Route::post('post-sports-login', [SportsController::class, 'login'])->name('post.sport.login');
    Route::get('sports-logout', [SportsController::class, 'logout'])->name('sport.logout');
    Route::post('verify-otp', [SportsController::class, 'verifyOTP'])->name('verify.otp');
    Route::get('verify-email', [SportsController::class, 'verifyEmail'])->name('verify.email');
});
Route::get('/get-states/{countryId}', [SportRegisterController::class, 'getStates'])->name('get.states');
Route::get('/get-cities/{stateId}', [SportRegisterController::class, 'getCities'])->name('get.cities');
Route::get('/clear', function () {
    Artisan::call('optimize:clear');
    return "Cleared!";
});
Route::get('/assign-menu', function () {
    $menuName = request() -> menu_name ?? '';
    $menuAlias = request() -> menu_alias ?? '';
    $serviceIds = request() -> service_ids ?? '';
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
    
    
    Route::get('/', [HomeController::class, 'index'])->name('/');
    Route::post('/update-organization', [CustomerController::class, 'updateOrganization'])->name('update-organization');
    Route::post('/approveVoucher', [VoucherController::class, 'approveVoucher'])->name('approveVoucher');

    // Notification
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notification/read/{id}', [NotificationController::class, 'markAsRead'])->name('notification.read');
    Route::get('/notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.readAll');


    





    Route::get('/city', [CityController::class, 'index']);

    


  
    
   


  


    











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

   Route::prefix('station-groups')->controller(StationGroupController::class)->group(function () {
        Route::get('/', 'index')->name('station-groups.index');
        Route::get('/create', 'create')->name('station-groups.create');
        Route::post('/', 'store')->name('station-groups.store');
        Route::get('/{id}', 'show')->name('station-groups.show');
        Route::get('/{id}/edit', 'edit')->name('station-groups.edit');
        Route::put('/{id}', 'update')->name('station-groups.update');
        Route::delete('/{id}', 'destroy')->name('station-groups.destroy');
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
    Route::get('/pincodes/{stateId}', [CountryController::class, 'pincodes'])->name('pincodes.get');
    Route::get('/get-state-id-by-code/{stateCode}', [CountryController::class, 'getStateIdByCode']);
    Route::get('/get-country-id-by-state/{stateId}', [CountryController::class, 'getCountryIdByState']);
    Route::get('/get-city-id-by-name/{stateId}/{cityName}', [CountryController::class, 'getCityIdByName']);
    Route::get('/get-pincode-id-by-code/{stateId}/{pincode}', [CountryController::class, 'getPincodeIdByCode']);

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
    Route::post('/sale-invoices/EInvoiceMail', [ErpSaleInvoiceController::class, 'EInvoiceMail'])->name('sale.invoice.eInvoiceMail');
    Route::get('/sale-invoices/pull/items', [ErpSaleInvoiceController::class, 'getSalesItemsForPulling'])->name('sale.invoice.pull.items');
    Route::get('/sale-invoices/process/items', [ErpSaleInvoiceController::class, 'processPulledItems'])->name('sale.invoice.process.items');
    Route::post('/sale-invoices/revoke', [ErpSaleInvoiceController::class, 'revokeSalesInvoice'])->name('sale.invoice.revoke');
    Route::get('/sale-invoices/get/pslip-bundles/so', [ErpSaleInvoiceController::class, 'getBundlesForPulledSo'])->name('sale.invoice.get.pslip.bundles.so');
    Route::get('/sale-invoices/get/free-pslips', [ErpSaleInvoiceController::class, 'getFreePslipsForDirectDeliveryNote'])->name('sale.invoice.get.free.pslips');
    Route::post('/sale-invoices/generate/e-invoice', [ErpSaleInvoiceController::class, 'generateEInvoice'])->name('sale.invoice.generate.einvoice');
    Route::post('/sale-invoices/pod', [ErpSaleInvoiceController::class, 'invoicePod'])->name('sale.invoice.pod');

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
    Route::post('/sale-returns/revoke', [ErpSaleReturnController::class, 'revokeSalesReturn'])->name('sale.return.revoke');
    Route::post('/sale-returns/CreditNoteMail', [ErpSaleReturnController::class, 'CreditNoteMail'])->name('sale.return.creditNoteMail');

    Route::get('/sales-return/amend/{id}', [ErpSaleReturnController::class, 'amendmentSubmit'])->name('sale.return.amend');
    Route::get('/sales-return/posting/get', [ErpSaleReturnController::class, 'getPostingDetails'])->name('sale.return.posting.get');
    Route::post('/sales-return/post', [ErpSaleReturnController::class, 'postReturn'])->name('sale.return.post');
    Route::get('/item/stores/details', [ErpSaleReturnController::class, 'getRacksAndBins'])->name('get_store_data');
    Route::get('/item/shelf/details', [ErpSaleReturnController::class, 'getShelfs'])->name('get_shelfs');
    Route::post('/sale-returns/generate/e-invoice', [ErpSaleReturnController::class, 'generateEInvoice'])->name('sale.return.generate.einvoice');

    #filtered document view
    Route::get('/pending-requests', [IndexController::class, 'requests'])->name('riv.requests');
    Route::get('/pending-approvals', [IndexController::class, 'approvals'])->name('riv.approvals');


    # Production Work Order Route
    Route::prefix('production-work-orders')
        ->name('pwo.')
        ->controller(PWOController::class)
        ->group(function () {
            Route::get('revoke-document','revokeDocument')->name('revoke.document');
            Route::post('close-document','closeDocument')->name('close.document');
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('change-item-code', 'changeItemCode')->name('item.code');
            Route::get('change-item-attr', 'changeItemAttr')->name('item.attr.change');
            Route::get('get-item-attribute', 'getItemAttribute')->name('item.attr');
            Route::get('add-item-row', 'addItemRow')->name('item.row');
            Route::get('get-overhead', 'getOverhead')->name('get.overhead');
            Route::get('get-item-detail', 'getItemDetail')->name('get.itemdetail');
            Route::get('get-item-detail2', 'getItemDetail2')->name('get.itemdetail2');
            Route::get('get-doc-no', 'getDocNumber')->name('doc.no');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update/{id}', 'update')->name('update');
            # get bom item cost child item
            Route::get('get-item-cost', 'getItemCost')->name('get.item.cost');
            Route::get('/{id}/pdf', 'generatePdf')->name('generate-pdf');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::get('get-posting', 'getPostingDetails')->name('posting.get');
            Route::get('post-mo', 'postMo')->name('posting.post');
            Route::get('get-so-item', 'getSoItem')->name('get.so.item');
            Route::get('process-so-item', 'processSoItem')->name('process.so-item');
    });

    //Material Issue
    Route::get('/material-issue', [ErpMaterialIssueController::class, 'index'])->name('material.issue.index');
    Route::get('/material-issue/create', [ErpMaterialIssueController::class, 'create'])->name('material.issue.create');
    Route::get('/material-issue/report', [ErpMaterialIssueController::class, 'report'])->name('material.issue.report');
    Route::get('/material-issue/filter', [ErpMaterialIssueController::class, 'filter'])->name('material.issue.filter');
    Route::post('/material-issue/store', [ErpMaterialIssueController::class, 'store'])->name('material.issue.store');
    Route::get('/material-issue/edit/{id}', [ErpMaterialIssueController::class, 'edit'])->name('material.issue.edit');
    Route::post('/material-issue/revoke', [ErpMaterialIssueController::class, 'revokeMaterialIssue'])->name('material.issue.revoke');
    Route::get('/material-issue/vendor/stores', [ErpMaterialIssueController::class, 'getVendorStores'])->name('material.issue.vendor.stores');
    Route::get('/material-issue/mo/process/mo', [ErpMaterialIssueController::class, 'processPulledItems'])->name('material.issue.process.items');
    Route::get('/material-issue/mo/get/items', [ErpMaterialIssueController::class, 'getMoItemsForPulling'])->name('material.issue.pull.items');
    Route::get('/material-issue/{id}/pdf/{pattern}', [ErpMaterialIssueController::class, 'generatePdf'])->name('material.issue.generate-pdf');
    Route::get('/material-issue/multi-stores-location', [ErpMaterialIssueController::class, 'getLocationsWithMultipleStores'])->name('material.issue.multi-store-location');


    Route::get('/material-return', [ErpMaterialReturnController::class, 'index'])->name('material.return.index');
    Route::get('/material-return/create', [ErpMaterialReturnController::class, 'create'])->name('material.return.create');
    Route::post('/material-return/store', [ErpMaterialReturnController::class, 'store'])->name('material.return.store');
    Route::get('/material-return/edit/{id}', [ErpMaterialReturnController::class, 'edit'])->name('material.return.edit');
    Route::post('/material-return/revoke', [ErpMaterialReturnController::class, 'revokeMaterialreturn'])->name('material.return.revoke');
    Route::get('/material-return/vendor/shipping-addresses', [ErpMaterialReturnController::class, 'getVendorAddresses'])->name('material.return.vendor.addresses');
    Route::get('/material-return/mi/process/mi', [ErpMaterialReturnController::class, 'processPulledItems'])->name('material.return.process.items');
    Route::get('/material-return/mi/get/items', [ErpMaterialReturnController::class, 'getMiItemsForPulling'])->name('material.return.pull.items');
    Route::get('/material-return/{id}/pdf/{pattern}', [ErpMaterialReturnController::class, 'generatePdf'])->name('material.return.generate-pdf');




     //Production Slip
     Route::get('/production-slip', [ErpProductionSlipController::class, 'index'])->name('production.slip.index');
     Route::get('/production-slip/create', [ErpProductionSlipController::class, 'create'])->name('production.slip.create');
     Route::post('/production-slip/store', [ErpProductionSlipController::class, 'store'])->name('production.slip.store');
     Route::get('/production-slip/edit/{id}', [ErpProductionSlipController::class, 'edit'])->name('production.slip.edit');
     Route::post('/production-slip/revoke', [ErpProductionSlipController::class, 'revoke'])->name('production.slip.revoke');
     Route::get('/production-slip/pwo/process/pwo', [ErpProductionSlipController::class, 'processPulledItems'])->name('production.slip.process.items');
     Route::get('/production-slip/pwo/get/items', [ErpProductionSlipController::class, 'getPwoItemsForPulling'])->name('production.slip.pull.items');

    Route::prefix('stores')->controller(StoreController::class)->group(function () {
        # Get Store Address Ajax
        Route::get('get-location', 'getLocation')->name('store.get');
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

        Route::get('/store/racks-bins', 'getStoreRacksAndBins')->name('store.racksAndBins');
        Route::get('/rack/shelfs', 'getRackShelfs')->name('store.rack.shelfs');

    });

    Route::prefix('sub-stores')->name('subStore.')->controller(SubStoreController::class)->group(function () {
        # Get Store Address Ajax
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
        Route::get('/store-wise', 'getSubStoresOfStore')->name('get.from.stores');
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
            Route::get('/approval/{id}', 'approval')->name('approval');
            Route::post('/update-approval', 'updateApproval')->name('update-approval');

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
    Route::get('fixed-asset/sub_asset', [RegistrationController::class, 'subAsset'])->name('finance.fixed-asset.sub_asset');
    Route::get('fixed-asset/getLedgerGroups', [RegistrationController::class, 'getLedgerGroups'])->name('finance.fixed-asset.getLedgerGroups');
    Route::get('fixed-asset/fetch-grn-data', [RegistrationController::class, 'fetchGrnData'])->name('finance.fixed-asset.fetch.grn.data');

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
    Route::get('fixed-asset/setup/category', [SetupController::class, 'category'])->name('finance.fixed-asset.setup.category');

    Route::resource('fixed-asset/setup', SetupController::class)->names([
        'index' => 'finance.fixed-asset.setup.index',
        'create' => 'finance.fixed-asset.setup.create',
        'store' => 'finance.fixed-asset.setup.store',
        'show' => 'finance.fixed-asset.setup.show',
        'edit' => 'finance.fixed-asset.setup.edit',
        'update' => 'finance.fixed-asset.setup.update',
        'destroy' => 'finance.fixed-asset.setup.destroy',
    ]);
    Route::get('fixed-asset/depreciation/posting/get', [DepreciationController::class, 'getPostingDetails'])->name('finance.fixed-asset.depreciation.posting.get');
    Route::post('fixed-asset/depreciation/post', [DepreciationController::class, 'postInvoice'])->name('finance.fixed-asset.depreciation.post');
    Route::get('fixed-asset/depreciation/assets', [DepreciationController::class, 'getAssets'])->name('finance.fixed-asset.depreciation.assets');
    Route::post('fixed-asset/depreciation/approval', [DepreciationController::class, 'documentApproval'])->name('finance.fixed-asset.depreciation.approval');

    Route::resource('fixed-asset/depreciation', DepreciationController::class)->names([
        'index' => 'finance.fixed-asset.depreciation.index',
        'create' => 'finance.fixed-asset.depreciation.create',
        'store' => 'finance.fixed-asset.depreciation.store',
        'show' => 'finance.fixed-asset.depreciation.show',
        'edit' => 'finance.fixed-asset.depreciation.edit',
        'update' => 'finance.fixed-asset.depreciation.update',
        'destroy' => 'finance.fixed-asset.depreciation.destroy',
    ]);


    Route::resource('asset-category',AssetCategoryController::class);
    Route::controller(GstrController::class)->prefix('finance/gstr')->group(function () {
        Route::get('/', 'index')->name('finance.gstr.index');
        Route::get('/json', 'json')->name('finance.gstr.json');
        Route::get('/details/{id}', 'details')->name('finance.gstr.details');
        Route::get('/detail/csv/{id}', 'detailCsv')->name('finance.gstr.detail-csv');
    });


    Route::get('/fee-master',[SportFeeController::class,'listing']);
    Route::get('/sports-students', [SportRegisterController::class, 'fetch'])->name('sports-students');
    Route::get('/sport-registration', [SportRegisterController::class, 'registration'])->name('sports.registration');
    Route::get('/fetch-fee-structure', [SportRegisterController::class, 'fetchFeeStructure'])->name('fetch.fee.structure');
    Route::post('/update-fee-mandatory-status',[SportRegisterController::class,'updateMandatoryStatus'])->name('update.fee.mandatory.status');
    Route::get('/guidelines', [SportRegisterController::class, 'guidelines'])->name('sports.dashboard');
    Route::post('/sport-registration-post', [SportRegisterController::class, 'postRegistration'])->name('sport-registration-post');
    Route::put('/profile-registration-update/{id}', [SportRegisterController::class, 'profileRegistrationUpdate'])->name('profile-registration-update');
    Route::get('/sports/profile/{id}', [SportRegisterController::class, 'showProfile'])->name('sports.profile');
    Route::get('/update/registration/{id}', [SportRegisterController::class, 'profileRegistration'])->name('update.registration');
    Route::post('/get-sportBatch-years-student', [SportRegisterController::class, 'get_batch_year'])->name('get.sportBatch.year.student');
    Route::post('/get-sportBatch-names-student', [SportRegisterController::class, 'get_batch_names'])->name('get.sportBatch.names.student');
    Route::get('/get-quotas/{batchId}', [SportRegisterController::class, 'getQuotas']);
    Route::get('/profile-view-detail/{id}', [SportRegisterController::class, 'profileViewDetail'])->name('profile-view-detail');
    Route::post('update-payment',[SportRegisterController::class,'update_payment'])->name('update-payment');
    Route::post('update-payment-status',[SportRegisterController::class,'update_payment_status'])->name('update-payment-status');
    Route::post('sport-type/add', [SportsMasterController::class, 'SportTypeAdd'])->name('sport-type/add');
    Route::get('sport-type', [SportsMasterController::class, 'indexSportType'])->name('sport-type');
    Route::get('sport-type-add', [SportsMasterController::class, 'showSportTypeAddForm'])->name('sport-type-add.form');
    Route::get('sport-type-edit/{id}', [SportsMasterController::class, 'SportTypeEdit'])->name('sport-type-edit');
    Route::put('sport-type-edit/{id}', [SportsMasterController::class, 'SportTypeUpdate'])->name('sport-type-update');
    Route::get('sport-type-delete/{id}', [SportsMasterController::class, 'sportTypeDelete'])->name('sport-type-delete');
    Route::post('/get-sections-by-sportBatch', [SportRegisterController::class, 'getSectionsByBatch'])->name('get.sections.by.sportBatch');
    Route::post('/get-batch-years-student', [SportRegisterController::class, 'get_batch_year'])->name('get.batch.year.student');
    Route::post('/get-batch-names-student', [SportRegisterController::class, 'get_batch_names'])->name('get.batch.names.student');
    Route::post('/get-sections-by-batch', [SportRegisterController::class, 'getSectionsByBatch'])->name('get.sections.by.batch');
    Route::get('/get-quotas/{batchId}', [SportRegisterController::class, 'getQuotas']);
    Route::get('sport-master-add', [SportsMasterController::class, 'SportType'])->name('sport-master-add');
    Route::post('sport-master-add', [SportsMasterController::class, 'SportMasterAdd']);
    Route::get('sport-master', [SportsMasterController::class, 'indexSportMaster'])->name('sport-master');
    Route::get('sport-master-edit/{id}', [SportsMasterController::class, 'SportMasterEdit'])->name('sport-master-edit');
    Route::put('sport-master-edit/{id}', [SportsMasterController::class, 'SportMasterUpdate'])->name('sport-master-update');
    Route::get('sport-master-delete/{id}', [SportsMasterController::class, 'softDelete']);
    Route::get('sport-master-view/{id}', [SportsMasterController::class, 'SportMasterView'])->name('sport-master-view');
    Route::view('quota-master/add','ums.sports.master.quota_master_add');
    Route::post('quota-add',[SportMasterController::class,'quota_add']);
    Route::get('quota-master', [SportMasterController::class, 'quota_list'])->name('quota.index');
    Route::get('quota-edit/{id}', [SportMasterController::class, 'edit'])->name('quota.edit');
    Route::post('quota-update/{id}', [SportMasterController::class, 'quota_edit'])->name('quota.update');
    Route::get('quota-delete/{id}', [SportMasterController::class, 'delete'])->name('quota.delete');
    Route::get('/master-batches', [SportMasterController::class, 'batch']);
    Route::get('/master-batches-add', function () {
        return view('ums.sports.master.master_batches_add');
    });
    Route::post('/master-batches-add', [SportMasterController::class, 'store'])->name('batches-store');
    Route::post('fee-import', [SportFeeController::class, 'import'])->name('excel.import');
    Route::get('/sports-fee-schedule',[SportFeeController::class,'listing']);
    Route::get('/sports-fee-schedule/add',[SportFeeController::class,'index']);
    Route::post('fee-master/add',[SportFeeController::class,'store']);
    Route::get('/sports-fee-schedule/edit/{id}',[SportFeeController::class,'edit']);
    Route::get('/sports-fee-schedule/view/{id}',[SportFeeController::class,'ViewPage']);
    Route::post('sports-fee-schedule/update/{id}',[SportFeeController::class,'update']);
    Route::get('sports-fee-schedule/delete/{id}',[SportFeeController::class,'fee_delete']);

    Route::get('/get-sportBatch-names', [SportFeeController::class,'get_batch_name'])->name('get-batches-name');
    Route::post('/get-section-names', [SportFeeController::class, 'get_section_names'])->name('section.fetch');
    Route::post('/get-sportBatch-names', [SportFeeController::class, 'get_batch_name'])->name('get-batches-name-post');


    Route::get('/master-batches-edit/{id}', [SportMasterController::class, 'batch_edit'])->name('batches-edit');
    Route::put('/master-batches-update/{id}', [SportMasterController::class, 'update'])->name('batches-update');
    Route::delete('/master-batches-delete/{id}', [SportMasterController::class, 'destroy'])->name('batches-destroy');
    Route::get('section-master/add',[SportMasterController::class,'section_index'])->name('section.add');
    Route::post('section-add',[SportMasterController::class,'section_add']);
    Route::get('section-master', [SportMasterController::class, 'section_list'])->name('section.index');
    Route::get('section-edit/{id}', [SportMasterController::class, 'sec_edits'])->name('section.edit');
    Route::post('section-update/{id}', [SportMasterController::class, 'section_edit'])->name('section.update');
    Route::get('section-delete/{id}', [SportMasterController::class, 'sec_delete'])->name('section.delete');
    Route::get('group-master',[GroupMasterController::class,'Index'])->name('group-master');
    Route::post('group-master-add',[GroupMasterController::class,'GroupMasterAdd'])->name('group-master-add');
    Route::get('group-master-add',[GroupMasterController::class,'GroupAdd'])->name('group-add');
    Route::get('group-master-edit/{id}',[GroupMasterController::class,'GroupMasterEdit'])->name('group-master-edit');
    Route::get('group-master-view/{id}',[GroupMasterController::class,'GroupMasterView'])->name('group-master-view');
    Route::put('group-master-update/{id}',[GroupMasterController::class,'GroupMasterUpdate'])->name('group-master-update');
    Route::get('group-master-delete/{id}', [GroupMasterController::class, 'GroupMasterDelete'])->name('group-master-delete');

            Route::get('my-activity', [MyActivityController::class, 'index'])->name('my-activity');
            Route::get('my-activity-view/{id}/{date}', [MyActivityController::class, 'ActivityView'])->name('activity-view');
            Route::post('save-activity-details', [MyActivityController::class, 'saveActivityDetails'])->name('save-activity-details');

            //player Review
            Route::get('player-review', [MyActivityController::class, 'review'])->name('player-review');
            Route::get('player-review-view/{id}/{date}', [MyActivityController::class, 'playerView'])->name('player-review-view');
            Route::get('player-review-edit/{id}/{date}', [MyActivityController::class, 'playerEdit'])->name('player-review-edit');
            Route::post('save-player-details', [MyActivityController::class, 'savePlayerDetails'])->name('save-player-details');

              

            // Activity Marter 

            Route::get('activity-master', [ActivityMasterController::class, 'index'])->name('activity-master');
            Route::get('activity-master-add', [ActivityMasterController::class, 'activityMaster'])->name('activity-master-add');
            Route::get('activity-master-edit/{id}', [ActivityMasterController::class, 'ActivityEdit'])->name('activity-master-edit');
            Route::get('activity-master-view/{id}', [ActivityMasterController::class, 'ActivityView'])->name('activity-master-view');
            Route::post('activity-master-edit/{id}', [ActivityMasterController::class, 'ActivityUpdate'])->name('activity-master-edit');
            Route::post('activity-master-add', [ActivityMasterController::class, 'activityMasterAdd'])->name('activity-master-add');
            Route::get('activity-master-delete/{id}', [ActivityMasterController::class, 'ActivityDelete'])->name('activity-master-delete');


            //scheduler
            Route::get('activity-scheduler', [ActivitySchedulerController::class, 'index'])->name('activity-scheduler');
            Route::get('activity-scheduler-add', [ActivitySchedulerController::class, 'activityScheduler'])->name('activity-scheduler-add');
            Route::post('activity-scheduler-add', [ActivitySchedulerController::class, 'activitySchedulerAdd'])->name('activity-scheduler-add');
            Route::get('activity-scheduler-edit/{id}', [ActivitySchedulerController::class, 'ActivityEdit'])->name('activity-scheduler-edit');
            Route::post('activity-scheduler-edit/{id}', [ActivitySchedulerController::class, 'ActivityUpdate'])->name('activity-scheduler-edit');
            Route::get('activity-scheduler-view/{id}', [ActivitySchedulerController::class, 'ActivityView'])->name('activity-scheduler-view');
            Route::get('activity-scheduler-delete/{id}', [ActivitySchedulerController::class, 'ActivityDelete'])->name('activity-scheduler-delete');
            Route::post('/get-batch-names-activity', [ActivitySchedulerController::class, 'get_batch_names'])->name('get.batch.names.activity');
            Route::post('/get-batch-section-activity', [ActivitySchedulerController::class, 'get_batch_section'])->name('get.batch.section.activity');
            Route::post('/get-section-group-activity', [ActivitySchedulerController::class, 'get_section_group'])->name('get.section.group.activity');
            Route::post('/get-activity-subactivity', [ActivitySchedulerController::class, 'get_activity_subactivity'])->name('get.activity.subactivities.activity');
            Route::post('/get_batch_student', [ActivitySchedulerController::class, 'get_batch_student'])->name('get_batch_student');


            //Screening Master 

            Route::get('screening-master',[ScreeningMasterController::class,'list']);
            Route::get('screening-master-add',[ScreeningMasterController::class,'index'])->name('screening-master/add');
            Route::post('screening-add',[ScreeningMasterController::class,'store'])->name('screening-add');
            Route::get('screening-master-delete/{id}',[ScreeningMasterController::class,'screening_delete']);
            // Route::post('screening-edit/{id}',[ScreeningMasterController::class,'store'])->name('screening-edit');
            Route::post('screening-update/{id}', [ScreeningMasterController::class, 'update'])->name('screening.update');

            Route::get('screening-master-edit/{id}',[ScreeningMasterController::class,'edit']);
            Route::get('screening-master-view/{id}',[ScreeningMasterController::class,'viewpage']);



                Route::get('/sports-logout', [SportsController::class, 'logout'])->name('sport.logout');


});


// generate IRN

Route::prefix('einvoice')->group(function () {
    Route::post('/generate', [EInvoiceServiceController::class, 'generateInvoice']);
    Route::get('/generate-pdf', [EinvoicePdfController::class, 'generateInvoiceQrPdf']);

});

Route::post('/validate-gst', [GstValidationController::class, 'validateGstNumber']);
