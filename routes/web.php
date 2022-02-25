<?php


use App\Http\Controllers\Accounts\BusinessLocationController;
use App\Http\Controllers\Accounts\EmployeeLoanController;
use App\Http\Controllers\Accounts\PermissionController;
use App\Http\Controllers\Accounts\ProductController;
use App\Http\Controllers\Accounts\RoleController;
use App\Http\Controllers\Accounts\UserController;
use App\Http\Controllers\AutocompleteController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Marquee\APIController;
use App\Http\Controllers\SyncBetweenOfflineOnline;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Accounts\CustomerController;
use App\Http\Controllers\Accounts\SaleController;
use App\Http\Controllers\Accounts\CategoryController;
use App\Http\Controllers\Accounts\UnitController;
use App\Http\Controllers\Accounts\PettyCashController;
use App\Http\Controllers\Accounts\SupplierController;
use App\Http\Controllers\Accounts\PurchaseController;
use App\Http\Controllers\Accounts\BankController;
use App\Http\Controllers\Accounts\StockController;
use App\Http\Controllers\Accounts\AccountController;
use App\Http\Controllers\Accounts\AttendanceController;
use App\Http\Controllers\Accounts\SalaryGenerateController;
use App\Http\Controllers\Accounts\SalarySetupsController;
use App\Http\Controllers\Accounts\IncomeController;
use App\Http\Controllers\Accounts\IncomeHeadController;
use App\Http\Controllers\Accounts\CashTransferVocherController;
use App\Http\Controllers\Accounts\ExpenseController;
use App\Http\Controllers\Accounts\ExpenseHeadController;
use App\Http\Controllers\Accounts\Office_loan\OfficeLoanController;
use App\Http\Controllers\Accounts\Personal_loan\PersonalLoanController;
use App\Http\Controllers\Accounts\TaxController;
use App\Http\Controllers\Accounts\IncomeTaxController;
use App\Http\Controllers\Accounts\DesignationController;
use App\Http\Controllers\Accounts\EmployeeController;
use App\Http\Controllers\Accounts\CommissionController;
use App\Http\Controllers\Accounts\ReportController;
use App\Http\Controllers\Accounts\ReturnController;
use App\Http\Controllers\Accounts\BenifitsController;
use App\Http\Controllers\Accounts\ServiceController;
use App\Http\Controllers\Accounts\ServiceInvoiceController;
use App\Http\Controllers\Accounts\Acc_ReportController;
use App\Http\Controllers\Accounts\QuotationController;
use App\Http\Controllers\Accounts\Setting\SettingsController;
use App\Http\Controllers\Accounts\Setting\Data_SynchronizerController;
use App\Http\Controllers\Accounts\AccountVoucherController;
use App\Http\Controllers\Accounts\DailyClosingController;
use App\Http\Controllers\Accounts\CompanyController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Accounts\DebitVoucherController;
use App\Http\Controllers\Accounts\CreditVoucherController;
use App\Http\Controllers\Accounts\ContraVoucherController;
use App\Http\Controllers\Accounts\JournalVoucherController;
use App\Http\Controllers\Marquee\FoodDemandController;

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
Route::group(['prefix' => 'api'], function () {
    Route::post('/supplier_balance', [SupplierController::class, 'ApiSupplierBalance'])->name('api.supplier.balance');
    Route::post('/customer_balance', [CustomerController::class, 'ApiCustomerBalance'])->name('api.customer.balance');
    Route::post('/account_balance', [AccountController::class, 'ApiAccountHeadBalance'])->name('api.account.balance');
    Route::post('/get_tax_details', [TaxController::class, 'ApiTaxDetails'])->name('api.tax.details');
    Route::post('/get_payment_accounts_by_type', [AccountController::class, 'getPaymentAccountsByType'])->name('api.payment.accounts.by.type');
});

Route::group(['prefix' => 'dashboard'], function () {

//    Route::get('home', [HomeController::class, 'index'])->name('dashboard');
    Route::get('accounts/location-settings', [BusinessLocationController::class, 'locationSettings'])->name('dashboard.accounts.location-settings');
    Route::post('accounts/update-location-settings', [BusinessLocationController::class, 'updateLocationSettings'])->name('dashboard.accounts.update.location-settings');

    Route::resource('accounts/products', ProductController::class, ['as' => 'dashboard.accounts']);

    Route::resource('accounts/users', UserController::class, ['as' => 'dashboard.accounts']);
    Route::resource('accounts/roles', RoleController::class, ['as' => 'dashboard.accounts']);
    Route::resource('accounts/permissions', PermissionController::class, ['as' => 'dashboard.accounts']);
    Route::get('accounts/permissions/sync/all', [PermissionController::class, 'syncPermissions'])->name('dashboard.accounts.permissions.sync');

    // Product
    Route::resource('accounts/category', CategoryController::class, ['as' => 'dashboard.accounts']);
    Route::resource('accounts/unit', UnitController::class, ['as' => 'dashboard.accounts']);

    // Sale
    Route::resource('accounts/sale', SaleController::class, ['as' => 'dashboard.accounts']);
    Route::get('accounts/sale/invoice/{id}', [SaleController::class, 'SaleInvoice'])->name('dashboard.accounts.sale.invoice');

    //Company
    Route::resource('accounts/companies', CompanyController::class, ['as' => 'dashboard.accounts']);

    Route::get('accounts/gui_pos', [CustomerController::class, 'gui_pos'])->name('gui.pos');
    // Customer
    Route::resource('accounts/customer', CustomerController::class, ['as' => 'dashboard.accounts']);
    Route::get('accounts/customer_ledger', [CustomerController::class, 'ledger'])->name('customer.ledger');
    Route::get('accounts/customer_credit', [CustomerController::class, 'creditCustomer'])->name('customer.credit');
    Route::get('accounts/paid_customer', [CustomerController::class, 'paidCustomer'])->name('paid.customer');
    Route::get('accounts/customer_advance', [CustomerController::class, 'customerAdvance'])->name('customer.advance');
    Route::post('accounts/add/customer/advance', [CustomerController::class, 'addCustomerAdvance'])->name('add.customer.advance');

    // Purchase
    Route::resource('accounts/purchase', PurchaseController::class, ['as' => 'dashboard.accounts']);
    Route::get('accounts/purchase/invoice/{id}', [PurchaseController::class, 'ViewInvoice'])->name('dashboard.accounts.purchase.invoice');
        // PettyCash
    Route::resource('accounts/pettycash', PettyCashController::class, ['as' => 'dashboard.accounts']);
    Route::get('accounts/pettycash_ledger', [PettyCashController::class, 'ledger'])->name('pettycash.ledger');

    // Supplier
    Route::resource('accounts/supplier', SupplierController::class, ['as' => 'dashboard.accounts']);
    Route::get('accounts/supplier_ledger', [SupplierController::class, 'ledger'])->name('supplier.ledger');
    Route::get('accounts/supplier_advance', [SupplierController::class, 'supplierAdvance'])->name('supplier.advance');
    Route::post('accounts/add/supplier/advance', [SupplierController::class, 'addSupplierAdvance'])->name('add.supplier.advance');
    // Reports
    //    Route::get('accounts/closing', [ReportController::class, 'closing'])->name('closing');
    Route::resource('accounts/closing/report', DailyClosingController::class, ['as' => 'dashboard.accounts.closing']);
    Route::get('accounts/closing_report', [ReportController::class, 'closingReport'])->name('closing.report');
    Route::get('accounts/today_report', [ReportController::class, 'TodayReport'])->name('today.report');
    Route::get('accounts/today/customer/receipt', [ReportController::class, 'todayCustomerReceipt'])->name('today.customer.receipt');
    Route::get('accounts/sales_report', [ReportController::class, 'SalesReport'])->name('sales.report');
    Route::get('accounts/user_wise_sales_report', [ReportController::class, 'UserWiseSalesReport'])->name('user_wise.sales_report');
    Route::get('accounts/due_report', [ReportController::class, 'DueReport'])->name('due.report');
    Route::get('accounts/supplier_due_report', [ReportController::class, 'SupplierDueReport'])->name('supplier.due.report');
    Route::get('accounts/shipping_cost_report', [ReportController::class, 'ShippingCostReport'])->name('shipping.cost_report');
    Route::get('accounts/purchase_report', [ReportController::class, 'PurchaseReport'])->name('purchase.report');
    Route::get('accounts/purchase_report_category_wise', [ReportController::class, 'PurchaseReportCategoryWise'])->name('purchase_report.category_wise');;
    Route::get('accounts/sales_report_product_wise', [ReportController::class, 'ProductWiseSale'])->name('product.wise');
    Route::get('accounts/sales_report_category_wise', [ReportController::class, 'SalesReportCategoryWise'])->name('sales_report.category_wise');
    Route::get('accounts/sales_return', [ReportController::class, 'SalesReturn'])->name('sales.return');
    Route::get('accounts/supplier_return', [ReportController::class, 'SupplierReturn'])->name('supplier.return.report');
    Route::get('accounts/tax_report', [ReportController::class, 'TaxReport'])->name('tax.report');
    Route::get('accounts/profit_report_sales_wise', [ReportController::class, 'ProfitReportSalesWise'])->name('profit_report.sales_wise');
    // Return
    Route::get('/return', [ReturnController::class, 'return'])->name('return');
    Route::get('/stock_return_list', [ReturnController::class, 'StockReturnList'])->name('stock.return');
    Route::get('/supplier_return_list', [ReturnController::class, 'SupplierReturnList'])->name('supplier.return');
    Route::get('/wastage_return_list', [ReturnController::class, 'WastageReturnList'])->name('wastage.return');
    // Settings > Software Setting
    Route::post('/accounts/settings/savegeneral', [SettingsController::class, 'SaveGeneral'])->name('dashboard.settings.savegeneral');
    Route::post('/accounts/settings/saveprefixes', [SettingsController::class, 'SavePrefixes'])->name('dashboard.settings.saveprefixes');


    // Settings > Hardware Setting
    Route::get('/accounts/settings/hardware', [SettingsController::class, 'getHardwareSetting'])->name('settings.hardware.settings');
    Route::post('/accounts/settings/update_hardware', [SettingsController::class, 'updateHardwareSetting'])->name('settings.hardware.update');

    Route::resource('accounts/settings', SettingsController::class, ['as' => 'dashboard.accounts']);
    Route::get('/manage_company', [SettingsController::class, 'ManageCompany'])->name('manage.company');
    Route::get('/language', [SettingsController::class, 'language'])->name('language');
    Route::get('/currency', [SettingsController::class, 'currency'])->name('currency');
    Route::get('/print_setting', [SettingsController::class, 'PrintSetting'])->name('print.setting');
    Route::get('/mail_setting', [SettingsController::class, 'MailSetting'])->name('mail.setting');
    Route::get('/app_setting', [SettingsController::class, 'AppSetting'])->name('app.setting');
    // Settings > SMS
    Route::get('/sms_setting', [SettingsController::class, 'SmsSetting'])->name('sms.setting');
    // Settings > Data_Synchronizer
    Route::get('/restore', [Data_SynchronizerController::class, 'restore'])->name('restore');
    Route::get('/import', [Data_SynchronizerController::class, 'import'])->name('import');
    Route::get('/back_up', [Data_SynchronizerController::class, 'back_up'])->name('back.up');
    // Settings > Update Now
    Route::get('/update_now', [Data_SynchronizerController::class, 'update_now'])->name('update.now');
    // Stock
    Route::get('/stock_report', [StockController::class, 'stock'])->name('stock.report');
    Route::get('/stock_quantity_report', [StockController::class, 'stock_quantity'])->name('stock.quantity_report');
    Route::get('/fix_assets_stock_report', [StockController::class, 'fixAssetsStock'])->name('fix.assets.stock.report');
    // Bank
    Route::resource('accounts/bank', BankController::class, ['as' => 'dashboard.accounts']);
    Route::get('/bank_transaction', [BankController::class, 'transaction'])->name('bank.transaction');
    Route::get('/bank_ledger', [BankController::class, 'ledger'])->name('bank.ledger');
    Route::post('/add/bank/transactions', [BankController::class, 'addTransaction'])->name('add.bank.transactions');
    // Service
    Route::resource('accounts/service', ServiceController::class, ['as' => 'dashboard.accounts']);
    Route::resource('accounts/service_invoice', ServiceInvoiceController::class, ['as' => 'dashboard.accounts']);
    // Route::resource('service', 'App\Http\Controllers\Dashboard\ServiceController');
    // Route::resource('service_invoice', 'App\Http\Controllers\Dashboard\ServiceInvoiceController');
    // Accounts
    Route::get('accounts/charts_account', [AccountController::class, 'charts'])->name('charts.account');
    Route::get('accounts/opening/balance', [AccountController::class, 'opening'])->name('opening.balance');
    Route::post('accounts/add/opening/balance', [AccountController::class, 'addOpeningBalance'])->name('add.opening.balance');
    Route::get('accounts/suppliers/payment', [AccountController::class, 'supplierPayment'])->name('supplier.payment');
    Route::post('accounts/add/supplier/payment', [AccountController::class, 'addSupplierPayment'])->name('add.supplier.payment');
    Route::get('accounts/supplier/payment/receipt/{transactionId}', [AccountController::class, 'supplierPaymentReceipt'])->name('supplier.payment.receipt');

    Route::get('accounts/payment/receipt/', [AccountController::class, 'CommonPaymentReceipt'])->name('common.payment.receipt');

    Route::get('accounts/customers/receive', [AccountController::class, 'customerReceive'])->name('customer.receive');
    Route::post('accounts/add/customers/receive', [AccountController::class, 'addCustomerReceive'])->name('add.customer.receive');
    Route::get('accounts/customer/payment/receipt/{transactionId}', [AccountController::class, 'customerPaymentReceipt'])->name('customer.payment.receipt');
    Route::get('accounts/cash/adjustment', [AccountController::class, 'cashAdjustment'])->name('cash.adjustment');
    Route::post('accounts/add/cash/adjustment', [AccountController::class, 'addCashAdjustment'])->name('add.cash.adjustment');
    Route::resource('accounts/cashtransfer/voucher', CashTransferVocherController::class, ['as' => 'dashboard.accounts.cashtransfer']);
    Route::resource('accounts/debit/voucher', DebitVoucherController::class, ['as' => 'dashboard.accounts.debit']);
    Route::resource('accounts/credit/voucher', CreditVoucherController::class, ['as' => 'dashboard.accounts.credit']);
    Route::resource('accounts/contra/voucher', ContraVoucherController::class, ['as' => 'dashboard.accounts.contra']);
    Route::resource('accounts/journal/voucher', JournalVoucherController::class, ['as' => 'dashboard.accounts.journal']);

    //Voucher Approval
    Route::resource('accounts/voucher/approval', AccountVoucherController::class, ['as' => 'dashboard.accounts.voucher']);
    //Open New Account
    Route::get('accounts/create/account', [AccountController::class, 'createAccountHead'])->name('create.account');
    Route::post('accounts/add/account', [AccountController::class, 'AddAccountHead'])->name('add.account');

    // Route::get('accounts/voucher/approval', [AccountController::class, 'approvalVoucher'])->name('voucher.approval');

    // Headcode
    Route::get('accounts/get/headcode/{id}', [AccountController::class, 'getHeadCode'])->name('get.headcode');
    // Accounts > Report
    Route::get('/cash_book', [Acc_ReportController::class, 'CashBook'])->name('cash.book');
    Route::get('/inventory_ledger', [Acc_ReportController::class, 'InventoryLedger'])->name('inventory.ledger');
    Route::get('/bank_book', [Acc_ReportController::class, 'BankBook'])->name('bank.book');
    Route::get('/general_ledger', [Acc_ReportController::class, 'GeneralLedger'])->name('general.ledger');

    Route::get('/general_head', [Acc_ReportController::class, 'GeneralHead'])->name('general.head');
    Route::post('/general/head/report', [Acc_ReportController::class, 'generalHeadReport'])->name('general.head.report');

    //ajax
    Route::post('/accounts/general/led/{id}', [Acc_ReportController::class, 'generalLed'])->name('general.led');
    Route::post('/general/ledger/report', [Acc_ReportController::class, 'generalLedgerReport'])->name('general.ledger.report');
    Route::get('/trail_balance', [Acc_ReportController::class, 'trailBalanceForm'])->name('trail.balance');
    Route::post('/trail/balance/report', [Acc_ReportController::class, 'trailBalanceReport'])->name('trail.balance.report');
    Route::get('/profit_loss', [Acc_ReportController::class, 'profitLossForm'])->name('profit.loss');
    Route::post('/profit/loss/report', [Acc_ReportController::class, 'profitLossReport'])->name('profit.loss.report');
    Route::get('/cash_flow', [Acc_ReportController::class, 'CashFlow'])->name('cash.flow');
    Route::get('/coa_print', [Acc_ReportController::class, 'CoaPrint'])->name('coa.print');
    Route::get('/balance_sheet', [Acc_ReportController::class, 'BalanceSheet'])->name('balance.sheet');
    // commision
    Route::get('/commission', [CommissionController::class, 'commission'])->name('commission');
    // Quotation
    Route::resource('accounts/quotation', QuotationController::class, ['as' => 'dashboard.accounts']);

    // Tax
    Route::resource('accounts/tax', TaxController::class, ['as' => 'dashboard.accounts']);
    /*Route::get('/tax_setting', [TaxController::class, 'setting'])->name('tax.setting');
    Route::resource('accounts/income_tax', IncomeTaxController::class, ['as' => 'dashboard.accounts']);
    Route::get('/tax_report_1', [TaxController::class, 'TaxReport'])->name('tax.report');
    Route::get('/invoice_wise_tax_report', [TaxController::class, 'InvoiceWise'])->name('invoice.wise');*/

    // Human Resource > HRM
    Route::post('/sync_hrm', [EmployeeController::class, 'syncEmployeeWithMachine'])->name('sync.hrm');
    Route::resource('accounts/designation', DesignationController::class, ['as' => 'dashboard.accounts']);
    Route::resource('accounts/employee', EmployeeController::class, ['as' => 'dashboard.accounts']);
    // Human Resource > Attendance
    Route::get('accounts/attendance/report', [AttendanceController::class, 'attendanceReport'])->name('attendance.report');
    Route::post('accounts/attendance/sync', [AttendanceController::class, 'syncAttendanceFromMachine'])->name('sync.attendance');
    Route::resource('accounts/attendance', AttendanceController::class, ['as' => 'dashboard.accounts']);

    // Human Resource > Payroll
    Route::resource('accounts/benifits', BenifitsController::class, ['as' => 'dashboard.accounts']);
    Route::resource('accounts/salary_setups', SalarySetupsController::class, ['as' => 'dashboard.accounts']);
    Route::resource('accounts/salary_generate', SalaryGenerateController::class, ['as' => 'dashboard.accounts']);

    Route::get('/salary_payment', [SalaryGenerateController::class, 'SalaryPayment'])->name('salary.payment');

    Route::get('/advance/salary/form', [SalaryGenerateController::class, 'advanceSalaryForm'])->name('advance.salary.form');
    Route::post('accounts/add/advance/salary', [SalaryGenerateController::class, 'generateAdvanceSalary'])->name('gen.advance.salary');
    //    ajax for advance salary
    Route::get('accounts/calc/advance/salary/{id}/{month}', [SalaryGenerateController::class, 'calcAdvanceSalary'])->name('calc.advance.salary');
    Route::get('accounts/payroll/payslip/{id}', [SalaryGenerateController::class, 'salaryPayslip'])->name('payroll.payslip');
    Route::post('accounts/payroll/paynow/', [SalaryGenerateController::class, 'salaryPaynow'])->name('payroll.paynow');
    Route::get('/salary_employee', [SalaryGenerateController::class, 'salary_employee'])->name('salary.employee');
    Route::post('accounts/add/salary/employee', [SalaryGenerateController::class, 'addEmployeeSalary'])->name('add.salary.employee');

    // select_employ ajax request
    Route::post('/get_daily_wage', [SalaryGenerateController::class, 'getDailyWage']);
    // Human Resource > Income
    Route::resource('accounts/incomehead', IncomeHeadController::class, ['as' => 'dashboard.accounts']);
    Route::get('/autocomplete/subincomehead', [IncomeHeadController::class, 'FindSubIncomeHead'])->name('autocomplete.subincomehead');

    Route::resource('accounts/income', IncomeController::class, ['as' => 'dashboard.accounts']);

    Route::get('/income_statement', [IncomeController::class, 'IncomeStatement'])->name('income.statement');
    // Human Resource > Income
    Route::resource('accounts/expensehead', ExpenseHeadController::class, ['as' => 'dashboard.accounts']);
    Route::get('/autocomplete/subexpensehead', [ExpenseHeadController::class, 'FindSubExpenseHead'])->name('autocomplete.subexpensehead');

    Route::resource('accounts/expense', ExpenseController::class, ['as' => 'dashboard.accounts']);

    Route::get('/expense_statement', [ExpenseController::class, 'ExpenseStatement'])->name('expense.statement');
    // Human Resource > Office Loan
    Route::resource('accounts/loan/person', OfficeLoanController::class, ['as' => 'dashboard.accounts']);
    Route::get('/add_loan', [OfficeLoanController::class, 'AddLoan'])->name('add.loan');
    Route::get('/add_payement', [OfficeLoanController::class, 'AddPayement'])->name('add.payement');
    // Human Resource > Personal Loan
    Route::resource('accounts/person_1', PersonalLoanController::class, ['as' => 'dashboard.accounts']);
    Route::get('/add_loan_1', [PersonalLoanController::class, 'AddLoan'])->name('add.loan_1');
    Route::get('/add_payement_1', [PersonalLoanController::class, 'AddPayement'])->name('add.payement_1');

    Route::resource('/food_demand', FoodDemandController::class, ['as' => 'food_demand.create']);
    Route::get('/food_demand_report', [FoodDemandController::class, 'fooddemandreport'])->name('food.report');

    // Loan Management
    Route::get('/accounts/employee_loan/report', [EmployeeLoanController::class, 'loanReport'])->name('employee.loan.report');
    Route::get('/accounts/employee_loan/receive', [EmployeeLoanController::class, 'loanReceive'])->name('employee.loan.receive');
    Route::post('/accounts/employee_loan/add_receive', [EmployeeLoanController::class, 'addLoanReceive'])->name('employee.loan.add.receive');
    Route::post('/get_applicable_loan', [EmployeeLoanController::class, 'getApplicableLoan'])->name('employee.applicable.loan');
    Route::post('/get_loan_receive_data', [EmployeeLoanController::class, 'loanReceiveData'])->name('employee.loan.receive.data');
    Route::post('/get_loan_details', [EmployeeLoanController::class, 'getLoanDetails'])->name('employee.loan.details');
    Route::post('/update_loan_status', [EmployeeLoanController::class, 'updateLoanStatus'])->name('employee.loan.status');
    Route::post('/pay_loan', [EmployeeLoanController::class, 'payLoanAmount'])->name('loan.pay');
    Route::resource('accounts/employee_loan', EmployeeLoanController::class, ['as' => 'dashboard.accounts']);

    require __DIR__ . '/custom-routes/marquee.php';
    require __DIR__ . '/custom-routes/textile.php';
    require __DIR__ . '/custom-routes/plastic.php';
    require __DIR__ . '/custom-routes/manufacturing.php';

});

//Route::post('add/customer', [CustomerController::class, 'customerAddAjax'])->name('add.customer.ajax');
Route::post('add/product', [ProductController::class, 'productAddAjax'])->name('add.product.ajax');
Route::post('add/supplier', [SupplierController::class, 'supplierAddAjax'])->name('add.supplier.ajax');

Route::get('/form', function () {
    return view('dashboard.Purchase.form');
});

Route::get('/dash', [HomeController::class, 'index'])->name('dashboard');

//Autocomplete Product and product Date
Route::post('/product_autocomplete', [ProductController::class, 'productAutocompleteData'])->name('product.autocomplete');
Route::post('/retrieve_product_data', [ProductController::class, 'retrieveProductData'])->name('product.retrieved');

Route::get('/add_product_csv', [ProductController::class, 'csv'])->name('product.csv');


// Settings > Role Permission
Route::resource('role', 'App\Http\Controllers\Dashboard\RoleController');
Route::get('/user_assign_role', [RoleController::class, 'user_assign_role'])->name('user.role');


//Authentication Routes
Auth::routes();
/**
 *  Return to dashboard...
 */
Route::get('/', function () {
    return redirect()->route('dashboard');
});

//Language
Route::get('language/{locale}', function ($locale) {
    if (!in_array($locale, config('app.available_locales'))) {
        abort(400);
    }
    session()->put('locale', $locale);
    return redirect()->back();
})->name('lang');

/**
 * Online offline syncing
 */
Route::get('call-offline-online-syncing', [SyncBetweenOfflineOnline::class, 'call'])->name('call-offline-online-syncing');

Route::get('autocomplete/seat-plannings', [AutocompleteController::class, 'seatingPlannings'])
    ->name('autocomplete.seat-plannings');
Route::get('autocomplete/add-on-features', [AutocompleteController::class, 'addOnFeatures'])
    ->name('autocomplete.add-on-features');
Route::get('autocomplete/stage-decorations', [AutocompleteController::class, 'stageDecorations'])
    ->name('autocomplete.stage-decorations');
Route::get('autocomplete/menus', [AutocompleteController::class, 'getMenus'])
    ->name('autocomplete.menus');
Route::get('autocomplete/booking', [AutocompleteController::class, 'getBooking'])
    ->name('autocomplete.booking');
Route::get('autocomplete/ingredients', [AutocompleteController::class, 'getRawMaterials']);
Route::get('autocomplete/demand', [AutocompleteController::class, 'getDemandItems'])
    ->name('autocomplete.demand');
Route::get('autocomplete/customer', [AutocompleteController::class, 'getCustomer'])
    ->name('autocomplete.customer');
Route::get('autocomplete/customer_of_booking', [AutocompleteController::class, 'GetCustomerOfBooking'])
    ->name('autocomplete.bookings.customer');
Route::get('autocomplete/extra_food_items', [AutocompleteController::class, 'getExtraFoodItems'])
    ->name('autocomplete.extra.food.items.by.id');

Route::group(['prefix' => 'api'], function () {
    Route::get('marquee/food_items_by_menu_id/{menu_id}', [APIController::class, 'getFoodItemsByMenuId'])
        ->name('api.marquee.foode.items.by.menu.id');
    Route::get('marquee/reset_food_menu', [APIController::class, 'ResetFoodMenu'])
        ->name('api.marquee.foode.items.reset');
    Route::post('add/customer', [CustomerController::class, 'customerAddAjax'])->name('add.customer.ajax');
});
/**
 * Temporary Route to clear cache
 */
Route::get('/clear-cache', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
})->name('clear.cache');

require __DIR__ . '/custom-routes/super-admin.php';
