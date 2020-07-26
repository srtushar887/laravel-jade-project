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

//Route::get('/', function () {
//    return view('auth.usersLogin');
//});



Route::get('/cache_clear',function(){
    Artisan::call('cache:clear');
});

Route::get('/view_clear',function(){
    Artisan::call('view:clear');
});
Route::get('/config_clear',function(){
    Artisan::call('config:cache');
});
Route::get('/route_clear',function(){
    Artisan::call('route:clear');
});

Route::get('/', 'HomeController@index')->name('home');
Route::post('forgot-password-send','VerityController@forgot_pass_send')->name('forgot.password');




Route::post('/custom-login', 'customLoginController@login')->name('customlogin');
Route::post('/custom-register', 'customLoginController@register')->name('custom.register');

Auth::routes();




Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');


Route::get('/not-active', 'UserVerifyController@user_verity')->name('user.verify');




Route::prefix('admin')->group(function (){
    Route::get('/login', 'Auth\AdminLoginController@showLoginform')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
});

Route::group(['middleware' => ['auth:admin']],function (){
    Route::prefix('admin')->group(function() {
        Route::get('/', 'Admin\AdminController@index')->name('admin.dashboard');

        //general setting
        Route::get('/general-setting', 'Admin\AdminController@general_setting')->name('admin.general.settings');
        Route::post('/general-setting-save', 'Admin\AdminController@general_setting_save')->name('admin.general.setting.save');

        //profile
        Route::get('/profile', 'Admin\AdminController@profile')->name('admin.profile');
        Route::post('/profile-save', 'Admin\AdminController@profile_save')->name('admin.profile.update');

        //password
        Route::get('/change-password', 'Admin\AdminController@change_password')->name('admin.password');
        Route::post('/change-password-save', 'Admin\AdminController@change_password_save')->name('admin.password.change');


        //property
        Route::get('/property', 'Admin\AdminPropertyController@property')->name('admin.property.list');
        Route::get('/property-get', 'Admin\AdminPropertyController@property_get')->name('getproperty');
        Route::get('/create-property', 'Admin\AdminPropertyController@property_create')->name('admin.create.property');
        Route::post('/create-property-save', 'Admin\AdminPropertyController@property_create_save')->name('admin.property.save');
        Route::get('/edit-property/{id}', 'Admin\AdminPropertyController@property_edit')->name('admin.property.edit');
        Route::post('/property-update', 'Admin\AdminPropertyController@property_update')->name('admin.property.update');
        Route::post('/property-delete', 'Admin\AdminPropertyController@property_delete')->name('admin.property.delete');


        //leased property
        Route::get('/leased-property', 'Admin\AdminPropertyController@leased_property')->name('admin.leased.property');
        Route::get('/leased-property-get', 'Admin\AdminPropertyController@leased_property_get')->name('get.admin.leasedproperty');
        Route::get('/leased-property-view/{id}', 'Admin\AdminPropertyController@leased_property_view')->name('admin.leased.property.view');
        Route::post('/leased-property-cancel', 'Admin\AdminPropertyController@leased_property_cancel')->name('lease.pro.cancel');


        //unleased property
        Route::get('/unleased-property', 'Admin\AdminPropertyController@unleased_property')->name('admin.unleased.property');
        Route::get('/unleased-property-get', 'Admin\AdminPropertyController@unleased_property_get')->name('get.admin.unleasedproperty');
        Route::get('/unleased-property-view/{id}', 'Admin\AdminPropertyController@unleased_property_view')->name('admin.unleased.property.view');


        //assign property
        Route::get('/assign-property', 'Admin\AdminPropertyController@assign_property')->name('admin.assign.property');
        Route::post('/assign-property-save', 'Admin\AdminPropertyController@assign_property_save')->name('admin.save.assign.property');




        //users role
        Route::get('/create-user-role', 'Admin\AdminUserRoleController@user_role')->name('admin.craate.user.role');
        Route::post('/create-user-role-save', 'Admin\AdminUserRoleController@user_role_save')->name('admin.create.role');
        Route::post('/create-user-role-update', 'Admin\AdminUserRoleController@user_role_update')->name('admin.update.role');
        Route::post('/create-user-role-delete', 'Admin\AdminUserRoleController@user_role_delete')->name('admin.delete.role');


        //user create
        Route::get('/create-user', 'Admin\AdminUserController@user_create')->name('admin.create.user');
        Route::post('/create-user-save', 'Admin\AdminUserController@user_create_save')->name('admin.user.save');


        //service request
        Route::get('/service-request-open', 'Admin\AdminRequestController@open_service_request')->name('admin.service.request.open');
        Route::get('/service-request-open-get', 'Admin\AdminRequestController@open_service_request_get')->name('get.admin.active.request');
        Route::post('/service-request-open-save', 'Admin\AdminRequestController@open_service_request_save')->name('admin.request.status.save');
        Route::get('/service-request-close', 'Admin\AdminRequestController@open_service_request_close')->name('admin.service.request.close');
        Route::get('/service-request-close-get', 'Admin\AdminRequestController@open_service_request_close_get')->name('get.admin.close.request');

        //admin transaction
        Route::get('/transaction', 'Admin\AdminController@transaction')->name('admin.transaction');
        Route::get('/transaction-get', 'Admin\AdminController@transaction_get')->name('get.transa.admin');

        //list all user/admin/manager
        Route::get('/admin-list', 'Admin\AdminUserController@admin_list')->name('admin.adminlist');
        Route::get('/admin-list-get', 'Admin\AdminUserController@admin_list_get')->name('admin.getadminlist');
        Route::post('/admin-single-admin', 'Admin\AdminUserController@admin_single_admin')->name('get.single.admindetails');
        Route::post('/admin-admin-details-update', 'Admin\AdminUserController@admin_admin_details_update')->name('admin.admin.details.update');
        Route::get('/admin-manager-list', 'Admin\AdminUserController@admin_manager_list')->name('admin.managerlist');
        Route::get('/admin-manager-get', 'Admin\AdminUserController@admin_manager_get')->name('admin.getmanagerlist');
        Route::post('/admin-manager-single', 'Admin\AdminUserController@admin_manager_single')->name('get.single.managerdetails');
        Route::post('/admin-manager-update', 'Admin\AdminUserController@admin_manager_update')->name('admin.manager.details.update');
        Route::get('/admin-tanant-list', 'Admin\AdminUserController@admin_tanant_list')->name('admin.tanantlist');
        Route::get('/admin-tanant-get', 'Admin\AdminUserController@admin_tanant_get')->name('admin.gettanantlist');
        Route::post('/admin-tanant-single', 'Admin\AdminUserController@admin_tanant_single')->name('get.single.tanantdetails');
        Route::post('/admin-tanant-update', 'Admin\AdminUserController@admin_tanant_update')->name('admin.tanant.details.update');


        //booking list
        Route::get('/swimming-pool-booking', 'Admin\AdminBookingController@booking')->name('admin.swimming.pool.list');
        Route::get('/swimming-pool-booking-get', 'Admin\AdminBookingController@booking_get')->name('get.admin.bookinglist');
        Route::post('/swimming-pool-booking-save', 'Admin\AdminBookingController@booking_save')->name('admin.booking.save');

    });
});


Route::group(['middleware' => ['auth','userverify']],function (){
    Route::prefix('home')->group(function() {

        Route::get('/', 'HomeController@index')->name('home');

        //user property
        Route::get('/my-property', 'Tanant\TanantPropertyController@my_property')->name('user.property');
        Route::get('/my-property-get', 'Tanant\TanantPropertyController@my_property_get')->name('get.myproperty');
        Route::get('/my-property-view', 'Tanant\TanantPropertyController@my_property_view')->name('user.property.view');

        //service request
        Route::get('/service-request-create', 'Tanant\TanantServiceRequestController@create_service_request')->name('user.sercice.request.create');
        Route::post('/service-request-save', 'Tanant\TanantServiceRequestController@save_service_request')->name('user.create.request.save');
        Route::get('/service-request-open', 'Tanant\TanantServiceRequestController@save_service_request_open')->name('user.sercice.request.open');
        Route::get('/service-request-open-get', 'Tanant\TanantServiceRequestController@save_service_request_open_get')->name('get.user.active.request');
        Route::get('/service-request-close', 'Tanant\TanantServiceRequestController@save_service_request_close')->name('user.sercice.request.close');
        Route::get('/service-request-close-get', 'Tanant\TanantServiceRequestController@save_service_request_close_get')->name('get.user.close.request');

        //profile
        Route::get('/profile', 'Tanant\TanantProfileController@profile')->name('user.profile');
        Route::post('/profile-save', 'Tanant\TanantProfileController@profile_save')->name('user.profile.update');

        //password
        Route::get('/change-password', 'Tanant\TanantProfileController@change_password')->name('user.password');
        Route::post('/change-password-save', 'Tanant\TanantProfileController@change_password_save')->name('user.password.change');

        //booking swwing
        Route::get('/booking-swimming-pool', 'Tanant\TanantBookkingController@booking_pool')->name('user.booking.swmming');
        Route::post('/booking-swimming-pool-save', 'Tanant\TanantBookkingController@booking_pool_save')->name('user.save.booking');
        Route::get('/booking-swimming-pool-list', 'Tanant\TanantBookkingController@booking_pool_list')->name('user.booking.list');
        Route::get('/booking-swimming-pool-list-get', 'Tanant\TanantBookkingController@booking_pool_list_get')->name('get.user.bookinglist');


        //make payment
        Route::get('/payment', 'Tanant\TanantPaymentController@payment')->name('user.make.payment');
        Route::post('/payment-create', 'Tanant\TanantPaymentController@payment_create')->name('user.payment.create');
        Route::get('/response', 'Tanant\TanantPaymentTwoController@get_handle_response_data')->name('getresponse');
        Route::get('/result', 'Tanant\TanantPaymentTwoController@result')->name('result');
        Route::get('/paymentttt-success', 'Tanant\TanantPaymentTwoController@payment_success');
        Route::get('/payment-error', 'Tanant\TanantPaymentTwoController@payment_error');

        Route::get('/payment-result/{result}/{trackid}/{PaymentID}/{tranid}/{amount}/{auth}/{var}/{ref}/{postdate}', 'Tanant\TanantPaymentTwoController@payment_success_confirm');
        Route::get('/payment-fail/{result}/{trackid}/{PaymentID}/{tranid}/{amount}/{auth}/{var}/{ref}/{postdate}', 'Tanant\TanantPaymentTwoController@payment_success_error');

        //transaction
        Route::get('/transaction-history', 'Tanant\TanantPaymentTwoController@transaction_history')->name('user.transaction');
        Route::get('/transaction-history-get', 'Tanant\TanantPaymentTwoController@transaction_history_get')->name('get.mytransaction');
        Route::get('/transaction-details/{id}', 'Tanant\TanantPaymentTwoController@pdf')->name('user.pdf.trans');
        Route::get('/download', 'Tanant\TanantPaymentTwoController@downooad')->name('download');


        //subscription payment
        Route::get('/subcription-payment', 'Tanant\TanantSubcriptionController@subs_pay')->name('subs.pay.user');
        Route::post('/subscribe', 'Tanant\TanantSubcriptionController@subs_pay_save')->name('subs.pay.user.save');


    });
});


Route::group(['middleware' => ['auth:manager','managerverify']],function (){
    Route::prefix('manager')->group(function() {

        Route::get('/', 'Manager\ManagerController@index')->name('manager.dashboard');

        //profile
        Route::get('/profile', 'Manager\ManagerController@profile')->name('manager.profile');
        Route::post('/profile-save', 'Manager\ManagerController@profile_save')->name('manager.profile.update');

        //password
        Route::get('/password', 'Manager\ManagerController@password')->name('manager.password');
        Route::post('/password-save', 'Manager\ManagerController@password_save')->name('manager.password.change');

        //tanant list
        Route::get('/tanant-list', 'Manager\ManagerTanantController@tanant_list')->name('manager.tanant.list');
        Route::get('/tanant-list-get', 'Manager\ManagerTanantController@tanant_list_get')->name('get.manager.tanantlist');
        Route::post('/tanant-list-single', 'Manager\ManagerTanantController@tanant_list_single')->name('get.single.managertanantdetails');

        //property list
        Route::get('/property-list', 'Manager\ManagerPropertyController@property_list')->name('manager.property.list');
        Route::get('/property-list-get', 'Manager\ManagerPropertyController@property_list_get')->name('get.manager.propertylist');


        //leased property
        Route::get('/leased-property', 'Manager\ManagerPropertyController@leased_property')->name('manager.leased.property');
        Route::get('/leased-property-get', 'Manager\ManagerPropertyController@leased_property_get')->name('get.manager.leasedproperty');


        //unleased property
        Route::get('/unleased-property', 'Manager\ManagerPropertyController@unleased_property')->name('manager.unleased.property');
        Route::get('/unleased-property-get', 'Manager\ManagerPropertyController@unleased_property_get')->name('get.manager.unleasedproperty');


        //assign property
        Route::get('/assign-property', 'Manager\ManagerPropertyController@assign_property')->name('manager.assign.property');
        Route::post('/assign-property-save', 'Manager\ManagerPropertyController@assign_property_save')->name('manager.save.assign.property');

        //swimming pool
        Route::get('/swimming-pool-booking', 'Manager\ManagerBookingController@booking')->name('manager.swimming.pool.list');
        Route::get('/swimming-pool-booking-get', 'Manager\ManagerBookingController@booking_get')->name('get.manager.bookinglist');
        Route::post('/swimming-pool-booking-save', 'Manager\ManagerBookingController@booking_save')->name('manager.booking.save');

        //service request
        Route::get('/service-request-open', 'Manager\ManagerRequestController@open_service_request')->name('manager.service.request.open');
        Route::get('/service-request-open-get', 'Manager\ManagerRequestController@open_service_request_get')->name('get.manager.active.request');
        Route::post('/service-request-open-save', 'Manager\ManagerRequestController@open_service_request_save')->name('manager.request.status.save');
        Route::get('/service-request-close', 'Manager\ManagerRequestController@open_service_request_close')->name('manager.service.request.close');
        Route::get('/service-request-close-get', 'Manager\ManagerRequestController@open_service_request_close_get')->name('get.manager.close.request');

        //admin transaction
        Route::get('/transaction', 'Manager\ManagerController@transaction')->name('manager.transaction');
        Route::get('/transaction-get', 'Manager\ManagerController@transaction_get')->name('get.transa.manager');


    });
});
