<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

// login type validity
Route::post('/login-credential-check', 'LoginTypeController@loginCredentialCheck')->name('login.credential.check');
// end of login type validity
Route::post('/users/reset-password', 'UserController@resetPassword')->name('reset.password');
	
//Customers
Route::get('customer', 'CustomerController@index')->name('customer.index');
// get voucher list from prezent
Route::post('/prezent/voucher/', 'Dashboard@getPrezentVoucher')->name('get.prezent.voucher');
Route::get('/prezent/voucher/detail', 'Dashboard@getPrezentVoucherDetail')->name('get.prezent.voucher.detail');
Route::post('/prezent/voucher/filter/', 'Dashboard@getPrezentVoucherFiltered')->name('get.prezent.voucher.filter');
// add to cart
Route::post('/add-to-cart', 'CustomerController@addToCart')->name('add.to.cart');
Route::get('/get-cart-item/{id}', 'CustomerController@getCartItem')->name('get.cart.item');
Route::get('/customer/cart/{id}', 'CustomerController@cart')->name('customer.cart');
Route::get('/customer/cart/delete/{id}', 'CustomerController@cartRemoveItem')->name('cart.remove.item');




//Vouchers
Route::get('customer/vouchers','VoucherController@index')->name('voucher.index');
Route::get('customer/voucher/detail','CustomerController@voucherDetail')->name('voucher.detail');
Route::get('customer/vouchers/send','VoucherController@sendGift')->name('voucher.send');
Route::post('customer/voucher/send/process','VoucherController@sendGiftProcess')->name('voucher.send.process');
Route::get('customer/voucher/send/result','VoucherController@sendGiftResult')->name('voucher.send.result');


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'Dashboard@index')->name('home');
    Route::get('/home', 'Dashboard@index')->name('home');
    // campaign
    Route::get('/campaign', 'CampaignController@index')->name('campaign.index');
    Route::get('/campaign/create', 'CampaignController@create')->name('campaign.create');
    Route::post('/campaign/profile-store', 'CampaignController@campaignProfileStore')->name('campaign.profile.store');
    Route::get('/campaign/message-voucher/{id}', 'CampaignController@campaignMessageVoucher')->name('campaign.message.voucher');
    Route::post('/campaign/message-voucher-store/{id}', 'CampaignController@campaignMessageVoucherStore')->name('campaign.message.voucher.store');
    Route::get('/campaign/checkout/{id}', 'CampaignController@campaignCheckout')->name('campaign.checkout');
    Route::get('/campaign/checkout-store/{id}', 'CampaignController@campaignCheckoutStore')->name('campaign.checkout.store');
    Route::get('/campaign/datatable', 'CampaignController@campaignDatatable')->name('campaign.datatable');
    
    Route::get('/campaign/edit/{id}', 'CampaignController@campaignEdit')->name('campaign.edit');
    Route::post('/campaign/edit/store/{id}', 'CampaignController@campaignEditStore')->name('campaign.edit.store');
    Route::get('/campaign/edit/message-voucher/{id}', 'CampaignController@campaignEditMessageVoucher')->name('campaign.edit.message.voucher');
    Route::post('/campaign/edit/store/message-voucher/{id}', 'CampaignController@campaignEditStoreMessageVoucher')->name('campaign.edit.message.voucher.store');
    
    Route::get('campaign/detail/{id}', 'CampaignController@campaignDetail')->name('campaign.detail');
    Route::get('campaign/recipient/datatable', 'CampaignController@campaignRecipientDatatable')->name('campaign.recipient.datatable');
    Route::get('campaign/delete/{id}', 'CampaignController@campaignDelete')->name('campaign.delete');
    Route::get('/campaign/approve/{id}', 'CampaignController@campaignApprove')->name('campaign.approve');
    Route::post('/campaign/reject/', 'CampaignController@campaignReject')->name('campaign.reject');
    // end of campaign

    // reports
    Route::get('/reports', 'ReportController@index')->name('reports.index');
    Route::get('/reports/datatable', 'ReportController@reportListDatatable')->name('reports.datatable');
    Route::get('/reports/detail/{id}', 'ReportController@reportDetail')->name('reports.detail');
    Route::get('/reports/detail-datatable/{id}', 'ReportController@reportDetailDatatable')->name('reports.detail.datatable');
    // end of reports

    Route::get('/admin', 'AdminController@index')->name('dashboard.index');

    // clients
    Route::get('/clients', 'ClientController@index')->name('clients.index');
    Route::get('/clients/datatable', 'ClientController@clientDatatable')->name('client.datatable');
    Route::get('/clients/create', 'ClientController@create')->name('clients.create');
    Route::post('/clients/information-store', 'ClientController@clientInfoStore')->name('clients.info.store');
    Route::get('/clients/billing/{id}', 'ClientController@clientBilling')->name('clients.billing');
    Route::post('/clients/billing-store/{id}', 'ClientController@clientBillingStore')->name('clients.billing.store');
    Route::get('/clients/setting/{id}', 'ClientController@clientSetting')->name('clients.setting');
    Route::post('/clients/city', 'ClientController@getCity')->name('get.city');
    Route::post('/clients/area', 'ClientController@getArea')->name('get.area');
    Route::post('/clients/setting-store/{id}', 'ClientController@clientSettingStore')->name('clients.setting.store');
    Route::get('/clients/edit/{id}', 'ClientController@clientEdit')->name('clients.edit');
    Route::post('/clients/information-update/{id}', 'ClientController@clientInfoUpdate')->name('clients.info.update');
    Route::get('/clients/billing/edit/{id}', 'ClientController@clientBillingEdit')->name('clients.billing.edit');
    Route::post('/clients/billing-update/{id}', 'ClientController@clientBillingUpdate')->name('clients.billing.update');
    Route::get('/clients/setting/edit/{id}', 'ClientController@clientSettingEdit')->name('clients.setting.edit');
    Route::post('/clients/setting-update/{id}', 'ClientController@clientSettingUpdate')->name('clients.setting.update');
    Route::get('/clients/delete/{id}', 'ClientController@clientDelete')->name('clients.delete');
    Route::get('/clients/detail/{id}', 'ClientController@clientDetail')->name('clients.detail');
	
	Route::get('/clients/get-bank-info','ClientController@getBank')->name('clients.bank');
	
    // end of clients

    // users
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/users/create', 'UserController@create')->name('users.create');
    Route::post('/users/store', 'UserController@store')->name('users.store');
    Route::get('/users/datatable', 'UserController@userDatatable')->name('user.datatable');
    Route::get('/users/edit/{id}', 'UserController@edit')->name('users.edit');
    Route::post('/users/update/{id}', 'UserController@update')->name('users.update');
    Route::get('/users/delete/{id}', 'UserController@destroy')->name('users.delete');
    Route::get('/users/change-password', 'UserController@changePassword')->name('users.change.password');
    Route::post('/users/change-password/store', 'UserController@changePasswordStore')->name('change.password.store');

    //end of users 
    Route::get('/reports', 'ReportController@index')->name('reports.index');


    Route::get('/balance', 'BalanceController@index')->name('balance.index');
	
	//Balances
	Route::get('/balance','DepositController@index')->name('balance.index');
	Route::get('/balance/datatable','DepositController@balanceDatatable')->name('balance.datatable');

	Route::get('/balance/topup','DepositController@topup')->name('balance.topup');
	Route::get('/balance/edit/{id}','DepositController@edit')->name('balance.edit');
	Route::post('/balance/topup/process','DepositController@topupProcess')->name('balance.topup.process');
	Route::post('/balance/topup/update','DepositController@update')->name('balance.topup.update');
	Route::get('/balance/search','DepositController@search')->name('balance.search');
	Route::get('/balance/history','DepositController@history')->name('balance.history');
	Route::get('/balance/history/datatable','DepositController@historyDatatable')->name('campaign.balance.history.datatable');

	Route::post('/balance/detail','DepositController@detail')->name('balance.detail');
	Route::get('/balance/approve/{idx}','DepositController@approval')->name('balance.approve');
	Route::get('/balance/reject/{idx}','DepositController@reject')->name('balance.reject');
	Route::get('/balance/delete/{idx}','DepositController@remove')->name('balance.delete');
	
    

});

route::get('/redeem/{voucher}','RedeemController@index')->name('redeem.front.idx');
route::post('/redeem/process','RedeemController@process')->name('redeem.front.process');
