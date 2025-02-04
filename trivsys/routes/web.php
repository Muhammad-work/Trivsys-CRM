<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\saleContoller;
use App\Http\Middleware\validUser;
use App\Http\Middleware\validRole;


Route::controller(dashboardController::class)->group(function () {
    Route::get('/dashboard', 'viewDashboard')->name('dashboard')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/viewAgentSaleTable', 'viewAgentSaleTable')->name('viewAgentSaleTable')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/viewAgentLeadlTable', 'viewAgentLeadlTable')->name('viewAgentLeadlTable')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/viewAgentTrialTable', 'viewAgentTrialTable')->name('viewAgentTrialTable')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/{id}/update_customer', 'cutomerUPdateDetailFormVIew')->name('cutomerUPdateDetailFormVIew')->middleware(validUser::class)->middleware(validRole::class);
    Route::post('/dashboard/{id}/cutomerUPdateDetailStore', 'cutomerUPdateDetailStore')->name('cutomerUPdateDetailStore')->middleware(validUser::class)->middleware(validRole::class);
    Route::post('/dashboard/{id}/cutomerUPdateDetailSaleStore', 'cutomerUPdateDetailSaleStore')->name('cutomerUPdateDetailSaleStore')->middleware(validUser::class)->middleware(validRole::class);
    Route::post('/dashboard/{id}/cutomerUPdateDetailTrialStore', 'cutomerUPdateDetailTrialStore')->name('cutomerUPdateDetailTrialStore')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/{id}/cutomerUPdateSaleDetailFormVIew', 'cutomerUPdateSaleDetailFormVIew')->name('cutomerUPdateSaleDetailFormVIew')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/{id}/cutomerUPdateTrialDetailFormVIew', 'cutomerUPdateTrialDetailFormVIew')->name('cutomerUPdateTrialDetailFormVIew')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/{id}/deleteLeadCustomerDetails', 'deleteLeadCustomerDetails')->name('deleteLeadCustomerDetails')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/{id}/deleteSaleCustomerDetails', 'deleteSaleCustomerDetails')->name('deleteSaleCustomerDetails')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/{id}/deleteTrialCustomerDetails', 'deleteTrialCustomerDetails')->name('deleteTrialCustomerDetails')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/{id}/updateCustomerStatus', 'updateCustomerStatus')->name('updateCustomerStatus')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/{id}/deleteCustomerDetails', 'deleteCustomerDetails')->name('deleteCustomerDetails')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/Help-Request', 'viewHelpRequestTableDashboard')->name('viewHelpRequestTableDashboard')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/{id}/downHelpRequestStatus', 'downHelpRequestStatus')->name('downHelpRequestStatus')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/{id}/cancelHelpRequestStatus', 'cancelHelpRequestStatus')->name('cancelHelpRequestStatus')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/{id}/viewTrialDaysForm', 'viewTrialDaysForm')->name('viewTrialDaysForm')->middleware(validUser::class)->middleware(validRole::class);
    Route::post('/dashboard/update-customer-status', 'updateStatusCustomerTrial')->name('updateStatusCustomerTrial')->middleware(validUser::class);
    Route::get('/dashboard/{id}/view-update-customer-status', 'viewupdateSaleCustomerStatus')->name('viewupdateSaleCustomerStatus')->middleware(validUser::class)->middleware(validRole::class);
    Route::post('/dashboard/{id}/update-customer-sale-status', 'updateSaleCustomerStatus')->name('updateSaleCustomerStatus')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/{id}/add-customer-sale-day', 'viewSaleDaysForm')->name('viewSaleDaysForm')->middleware(validUser::class)->middleware(validRole::class);
    Route::post('/dashboard/{id}/addSaleCustomerStatus', 'addSaleCustomerStatus')->name('addSaleCustomerStatus')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/add-numbers', 'viewAddNumbersForm')->name('viewAddNumbersForm')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/all-agent-sale-reports/{id}/', 'viewSaleTable')->name('viewSaleTable')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/all-agent-lead-reports/{id}/', 'viewleadtable')->name('viewleadtable')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/distribute-lead/{id}/', 'distributeLeadsForm')->name('distributeLeadsForm')->middleware(validUser::class)->middleware(validRole::class);
    Route::post('/dashboard/updateLeadAgent/{id}', 'updateLeadAgent')->name('updateLeadAgent')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/all-agent-meeting', 'viewAgentMeeting')->name('viewAgentMeeting')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/{id}/all-agent-meeting-table', 'viewMeetingTable')->name('viewMeetingTable')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/{id}/viewAgentDistributeMeeting', 'viewAgentDistributeMeeting')->name('viewAgentDistributeMeeting')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/{id}/cutomerMeetingUPdateDetailFormVIew', 'cutomerMeetingUPdateDetailFormVIew')->name('cutomerMeetingUPdateDetailFormVIew')->middleware(validUser::class)->middleware(validRole::class);
    Route::post('/dashboard/{id}/cutomerMeetingUPdateDetailStore', 'cutomerMeetingUPdateDetailStore')->name('cutomerMeetingUPdateDetailStore')->middleware(validUser::class)->middleware(validRole::class);
    Route::post('/dashboard/{id}/updateMeetingAgent', 'updateMeetingAgent')->name('updateMeetingAgent')->middleware(validUser::class)->middleware(validRole::class);
    Route::post('/dashboard/{id}/cutomerUPdateDetailMeetingDoneStore', 'cutomerUPdateDetailMeetingDoneStore')->name('cutomerUPdateDetailMeetingDoneStore')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/{id}/deleteMeetingCustomerDetails', 'deleteMeetingCustomerDetails')->name('deleteMeetingCustomerDetails')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/{id}/cutomerUPdateMeetingDoneDetailFormVIew', 'cutomerUPdateMeetingDoneDetailFormVIew')->name('cutomerUPdateMeetingDoneDetailFormVIew')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/{id}/deleteCustomerMeetingDoneDetails', 'deleteCustomerMeetingDoneDetails')->name('deleteCustomerMeetingDoneDetails')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/viewAgentMeetingDoneTable', 'viewAgentMeetingDoneTable')->name('viewAgentMeetingDoneTable')->middleware(validUser::class)->middleware(validRole::class);
    Route::get('/dashboard/expense', 'expense')->name('expense')->middleware(validUser::class)->middleware(validRole::class);
});


Route::controller(userController::class)->middleware(validUser::class)->middleware(validRole::class)->group(function () {
    Route::get('/dashboard/all-user', 'viewUserTable')->name('viewUserTable');
    Route::get('/dashboard/add-user', 'addUser')->name('addUser');
    Route::get('/dashboard/{id}/update-user', 'viewEditForm')->name('viewEditFormUser');
    Route::post('/dashboard/storeUserdetail', 'storeUserdetail')->name('storeUserdetail');
    Route::post('/dashboard/{id}/storeUpdateUser', 'storeUpdateUser')->name('storeUpdateUser');
    Route::get('/dashboard/{id}/deleteUser', 'deleteUser')->name('deleteUser');
    Route::get('/dashboard/sendMail', 'sendMail')->name('sendMail');
});

Route::get('/user/{id}/activate', [UserController::class, 'activateUser'])->name('activateUser');
Route::get('/user/{id}/deactivateUser', [UserController::class, 'deactivateUser'])->name('deactivateUser');


Route::controller(adminController::class)->middleware(validUser::class)->middleware(validRole::class)->group(function () {
    Route::get('/dashboard/all-admin', 'viewAdminTable')->name('viewAdminTable');
    Route::get('/dashboard/add-admin', 'viewAddForm')->name('viewAddForm');
    Route::get('/dashboard/{id}/edit-admin', 'viewEditForm')->name('viewEditFormAdmin');
    Route::post('/dashboard/storeAdminDetail', 'storeAdminDetail')->name('storeAdminDetail');
    Route::post('/dashboard/{id}/storeUpdateAdmin', 'storeUpdateAdmin')->name('storeUpdateAdmin');
    Route::get('/dashboard/{id}/deleteAdmin', 'deleteAdmin')->name('deleteAdmin');
    Route::get('/dashboard/change-password', 'viewAdminUpdatePasswordForm')->name('viewAdminUpdatePasswordForm');
    Route::post('/dashboard/{id}/changePasswordStore', 'changePasswordStore')->name('changePasswordStore');
});


Route::controller(userController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/storeLogin', 'loginstore')->name('loginstore');
    Route::get('/logout', 'logout')->name('logout');
});


Route::controller(homeController::class)->group(function () {
    Route::get('/', 'viewHome')->name('viewHome')->middleware(validUser::class);
});

Route::controller(CustomerController::class)->middleware(validUser::class)->group(function () {
    Route::post('/storeCustomerDetail', 'storeCustomerDetail')->name('storeCustomerDetail');
    Route::post('/customerStatus/{id}', 'customerStatus')->name('customerStatus');

    Route::get('/customerSalesTable', 'customerSalesTable')->name('customerSalesTable');
    Route::get('/customerLeadTable', 'customerLeadTable')->name('customerLeadTable');
    Route::get('/customerTrialTable', 'customerTrialTable')->name('customerTrialTable');

    Route::get('/{id}/edit-customer-numbers', 'viewCustomerNumberEditForm')->name('viewCustomerNumberEditForm');
    Route::post('/{id}/storeCustomerNumberEditDetails', 'storeCustomerNumberEditDetails')->name('storeCustomerNumberEditDetails');

    Route::get('/{id}/add-old-customer-data', 'viewOldCustomerNewPKG')->name('viewOldCustomerNewPKG');
    Route::post('/{id}/storeOldCustomerNewPKGData', 'storeOldCustomerNewPKGData')->name('storeOldCustomerNewPKGData');

    Route::get('/{id}/edit-sale', 'viewEditCustomerSaleDetailForm')->name('viewEditCustomerSaleDetailForm');
    Route::post('/{id}/storeEditCustomerSaleDetails', 'storeEditCustomerSaleDetails')->name('storeEditCustomerSaleDetails');

    Route::get('/{id}/update-lead', 'viewleadEditForm')->name('viewleadEditForm');
    Route::post('/{id}/storeUpdateLeadData', 'storeUpdateLeadData')->name('storeUpdateLeadData');

    Route::get('/{id}/update-trial', 'viewTrialEditForm')->name('viewTrialEditForm');
    Route::post('/{id}/storeUpdateTrialData', 'storeUpdateTrialData')->name('storeUpdateTrialData');

    Route::get('/customerDeniedTable', 'customerDeniedTable')->name('customerDeniedTable');
    Route::get('/meeting', 'viewMeetingPage')->name('viewMeetingPage');
    Route::get('/meeting-done', 'viewMeetingDonePage')->name('viewMeetingDonePage');

    Route::get('/Expense', 'viewexpensepage')->name('viewexpensepage');
    Route::get('/Expense-Form', 'viewExpenseForm')->name('viewExpenseForm');
    Route::post('/storeExpenseData', 'storeExpenseData')->name('storeExpenseData');
});


Route::controller(HelpController::class)->group(function () {
    Route::get('/help-Request', 'viewHelpForm')->name('help')->middleware(validUser::class);
    Route::get('/help-Detail', 'viewHelpTable')->name('viewHelpTable')->middleware(validUser::class);
    Route::post('/storeHelpRequest', 'storeHelpRequest')->name('storeHelpRequest')->middleware(validUser::class);
});

