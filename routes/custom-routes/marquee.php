<?php

use App\Http\Controllers\Marquee\AddOnFeatureController;
use App\Http\Controllers\Marquee\BookingController;
use App\Http\Controllers\Marquee\EventAreaController;
use App\Http\Controllers\Marquee\ExtraFoodItemController;
use App\Http\Controllers\Marquee\MenuController;
use App\Http\Controllers\Marquee\SeatPlanningController;
use App\Http\Controllers\Marquee\StageDecorationController;
use App\Http\Controllers\Marquee\StageBookingController;
use App\Http\Controllers\Marquee\GatePassController;
use App\Http\Controllers\Marquee\ReceiveGatePassController;
use App\Http\Controllers\Marquee\ReceiveDemandController;
use App\Http\Controllers\Marquee\IssueDemandController;
use App\Http\Controllers\Marquee\DemandController;
use App\Http\Controllers\Marquee\RecipeController;
use App\Http\Controllers\Marquee\InvoiceController;
use App\Http\Controllers\Marquee\BookingPaymentController;
use App\Http\Controllers\Marquee\ChildBookingController;
use App\Http\Controllers\Marquee\DemandBookingController;
use App\Http\Controllers\Marquee\TentativeBookingController;
use App\Http\Controllers\Marquee\TermsConditionsController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\Marquee\StageQuotationController;
use App\Http\Controllers\Marquee\BookingQuotationController;
use App\Http\Controllers\Accounts\CustomerController;
use App\Http\Controllers\Marquee\DashboardController;
use App\Http\Controllers\Marquee\HRDemandController;

Route::resource('marquee/booking/quotation', BookingQuotationController::class, ['names' => [
    'index' => 'dashboard.marquee.booking.quotation.index',
    'create' => 'dashboard.marquee.booking.quotation.create',
    'store' => 'dashboard.marquee.booking.quotation.store',
    'edit' => 'dashboard.marquee.booking.quotation.edit',
    'update' => 'dashboard.marquee.booking.quotation.update',
    'destroy' => 'dashboard.marquee.booking.quotation.destroy'
]]);
Route::get('/booking_advance_payment_report', [BookingPaymentController::class, 'AdvancePayReport'])->name('booking.advance.payment.report');
Route::get('/booking_report', [BookingController::class, 'bookingreport'])->name('booking.report');
Route::get('marquee/booking/add-to-booking/{id}',[BookingController::class,'addToBooking'])->name('marquee.booking.add-to-booking');
Route::get('marquee/booking/kitchen_sheet/{bookingID}',[BookingController::class,'ViewKitchenSheet'])->name('marquee.booking.sheet.kitchen');
Route::get('marquee/booking/function_sheet/{bookingID}',[BookingController::class,'ViewFunctionSheet'])->name('marquee.booking.sheet.function');
Route::get('marquee/booking/customer_sheet/{bookingID}',[BookingController::class,'ViewCustomerSheet'])->name('marquee.booking.sheet.customer');
Route::get('marquee/booking/final_invoice/{bookingID}',[BookingController::class,'ViewFinalInvoice'])->name('marquee.booking.final.invoice');
Route::get('marquee/booking/calendar',[BookingController::class,'ViewCalendar'])->name('marquee.booking.calendar');
Route::get('marquee/booking/cancel',[BookingController::class,'CancelEvent'])->name('marquee.booking.cancel');
Route::post('marquee/booking/cancel_save',[BookingController::class,'CancelEventSave'])->name('marquee.booking.cancel.save');

Route::resource('marquee/booking', BookingController::class, ['names' => [
    'index' => 'dashboard.marquee.booking.index',
    'create' => 'dashboard.marquee.booking.create',
    'store' => 'dashboard.marquee.booking.store',
    'edit' => 'dashboard.marquee.booking.edit',
    'update' => 'dashboard.marquee.booking.update',
    'destroy' => 'dashboard.marquee.booking.destroy',
    'show' => 'dashboard.marquee.booking.show'
]]);
//Route::get('marquee/booking/show/{id}',[BookingController::class,'show'])->name('booking.type.show');

Route::resource('marquee/add-on-invoice', ChildBookingController::class, ['as' => 'dashboard.marquee'])->parameters([
    'create' => 'id'
]);

Route::resource('marquee/menu', MenuController::class, ['names' => [
    'index' => 'dashboard.marquee.menu.index',
    'create' => 'dashboard.marquee.menu.create',
    'store' => 'dashboard.marquee.menu.store',
    'edit' => 'dashboard.marquee.menu.edit',
    'update' => 'dashboard.marquee.menu.update',
    'destroy' => 'dashboard.marquee.menu.destroy'
]]);

Route::resource('marquee/stage-decorations', StageDecorationController::class, ['names' => [
    'index' => 'dashboard.marquee.stage-decorations.index',
    'create' => 'dashboard.marquee.stage-decorations.create',
    'store' => 'dashboard.marquee.stage-decorations.store',
    'edit' => 'dashboard.marquee.stage-decorations.edit',
    'update' => 'dashboard.marquee.stage-decorations.update',
    'destroy' => 'dashboard.marquee.stage-decorations.destroy'
]]);

Route::resource('marquee/seat-plannings', SeatPlanningController::class, ['names' => [
    'index' => 'dashboard.marquee.seat-plannings.index',
    'create' => 'dashboard.marquee.seat-plannings.create',
    'store' => 'dashboard.marquee.seat-plannings.store',
    'edit' => 'dashboard.marquee.seat-plannings.edit',
    'update' => 'dashboard.marquee.seat-plannings.update',
    'destroy' => 'dashboard.marquee.seat-plannings.destroy'
]]);

Route::resource('marquee/add-on-features', AddOnFeatureController::class, ['names' => [
    'index' => 'dashboard.marquee.add-on-features.index',
    'create' => 'dashboard.marquee.add-on-features.create',
    'store' => 'dashboard.marquee.add-on-features.store',
    'edit' => 'dashboard.marquee.add-on-features.edit',
    'update' => 'dashboard.marquee.add-on-features.update',
    'destroy' => 'dashboard.marquee.add-on-features.destroy'
]]);

Route::resource('marquee/extra_food_items', ExtraFoodItemController::class, ['names' => [
    'index' => 'dashboard.marquee.extra_food_items.index',
    'create' => 'dashboard.marquee.extra_food_items.create',
    'store' => 'dashboard.marquee.extra_food_items.store',
    'edit' => 'dashboard.marquee.extra_food_items.edit',
    'update' => 'dashboard.marquee.extra_food_items.update',
    'destroy' => 'dashboard.marquee.extra_food_items.destroy'
]]);

Route::resource('marquee/event_area', EventAreaController::class, ['names' => [
    'index' => 'dashboard.marquee.eventarea.index',
    'create' => 'dashboard.marquee.eventarea.create',
    'store' => 'dashboard.marquee.eventarea.store',
    'edit' => 'dashboard.marquee.eventarea.edit',
    'update' => 'dashboard.marquee.eventarea.update',
    'destroy' => 'dashboard.marquee.eventarea.destroy'
]]);

Route::resource('marquee/terms_conditions', TermsConditionsController::class, ['names' => [
    'index' => 'dashboard.marquee.terms.index',
    'create' => 'dashboard.marquee.terms.create',
    'store' => 'dashboard.marquee.terms.store',
    'edit' => 'dashboard.marquee.terms.edit',
    'update' => 'dashboard.marquee.terms.update',
    'destroy' => 'dashboard.marquee.terms.destroy'
]]);

Route::get('/stage_report', [StageBookingController::class, 'stagereport'])->name('stage.report');
Route::get('marquee/stage/booking/wob', [StageBookingController::class, 'createWithoutBooking'])->name('dashboard.marquee.stage.wob');
Route::resource('marquee/stage/booking', StageBookingController::class, ['names' => [
    'index' => 'dashboard.marquee.stage.booking.index',
    'create' => 'dashboard.marquee.stage.booking.create',
    'store' => 'dashboard.marquee.stage.booking.store',
    'edit' => 'dashboard.marquee.stage.booking.edit',
    'update' => 'dashboard.marquee.stage.booking.update',
    'destroy' => 'dashboard.marquee.stage.booking.destroy',
]]);

Route::get('/invoice_wise_tax_report', [BookingController::class, 'bookingInvoice'])->name('invoice.wise');
Route::get('marquee/stage/invoice/{id}', [StageBookingController::class, 'stageBookingInvoice'])->name('stage.invoice');
Route::get('marquee/stage/edit/{id}', [StageBookingController::class, 'stageBookingWob'])->name('stage.edit');


Route::get('marquee/invoice/{id}', [InvoiceController::class,'invoiceId'])->name('invoice.id.search');
Route::post('marquee/invoice/cnic', [InvoiceController::class,'invoiceCnic'])->name('marquee.invoice.cnic');

Route::get('marquee/view/quotation/booking/{id}', [InvoiceController::class,'QuotationBooking'])->name('view.quotation.booking');
Route::get('marquee/view/quotation/stage/{id}', [InvoiceController::class,'QuotationStage'])->name('view.quotation.stage');

Route::resource('marquee/payments', BookingPaymentController::class, ['as' => 'dashboard.marquee'])->parameters([
    'create' => 'bookingid'
]);

Route::resource('marquee/gatepass', GatePassController::class, ['as' => 'dashboard.marquee']);
Route::resource('marquee/gatepass-receive', ReceiveGatePassController::class, ['as' => 'dashboard.marquee.gatepass']);

Route::resource('marquee/receive/demand', ReceiveDemandController::class, ['names' => [
   'index' => 'dashboard.marquee.receive.demand.index',
 ]]);

Route::get('marquee/demand/wob/', [DemandController::class, 'createWithoutBooking'])->name('dashboard.marquee.demand.wob');
Route::resource('marquee/demand',DemandController::class, ['as' => 'dashboard.marquee']);
Route::resource('marquee/booking/demand',DemandBookingController::class, ['as' => 'dashboard.marquee.booking'])->parameters([
    'create' => 'id'
]);

Route::get('marquee/issue/invoice/{id}', [DemandController::class, 'DemandInvoice'])->name('demand.invoice');
Route::get('marquee/recipe/{id}', [RecipeController::class, 'RecipeInvoice'])->name('recipe.marquee');



// Route::resource('marquee/issue/demand',IssueDemandController::class, ['names' => [
//     'create' => 'dashboard.marquee.issue.demand.create',
//     'index' => 'dashboard.marquee.issue.demand.index'
// ]]);




Route::post('/customer', [CustomerController::class, 'customer'])->name('customer');




 Route::resource('marquee/create/recipe',RecipeController::class, ['names' => [
    'create' => 'dashboard.marquee.recipe.create',
    'store' => 'dashboard.marquee.recipe.store',
    'index' => 'dashboard.marquee.recipe.index',
    'update' => 'dashboard.marquee.recipe.update',
    'edit' => 'dashboard.marquee.recipe.edit',
    'destroy' => 'dashboard.marquee.recipe.destroy'

]]);

Route::resource('marquee/quotation/booking',BookingQuotationController::class, ['as' => 'dashboard.marquee.quotation']);
Route::get('/bookingquotation_report', [BookingQuotationController::class, 'bookingquotationreport'])->name('bookingquotation.report');

Route::resource('marquee/quotation/stage',StageQuotationController::class, ['as' => 'dashboard.marquee.quotation']);
Route::get('/stagequotation_report', [StageQuotationController::class, 'stagequotationreport'])->name('stagequotation.report');
Route::resource('marquee/home',DashboardController::class, ['as' => 'dashboard.marquee']);
Route::resource('marquee/hr_demand', HRDemandController::class, ['as' => 'dashboard.marquee']);

Route::resource('marquee/tentative-booking', TentativeBookingController::class, ['names' => [
    'index' => 'dashboard.marquee.tentative-booking.index',
    'create' => 'dashboard.marquee.tentative-booking.create',
    'store' => 'dashboard.marquee.tentative-booking.store',
    'edit' => 'dashboard.marquee.tentative-booking.edit',
    'update' => 'dashboard.marquee.tentative-booking.update',
    'destroy' => 'dashboard.marquee.tentative-booking.destroy',
    'show' => 'dashboard.marquee.tentative-booking.show'
]]);

Route::post('marquee/check-booking-available', [TentativeBookingController::class, 'checkBookingAvailable'])->name('booking.available');
