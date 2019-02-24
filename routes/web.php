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

Route::get('/', 'Modular\ModularController@index');
// Route::get('/', 'Modular\ModularController@login');
Route::get('/welcome', 'Modular\ModularController@welcome');
Route::get('/about', 'Modular\ModularController@about');
Route::get('/test_curl', 'Modular\ModularController@test_curl');

//old
Route::any('/login', 'Modular\ModularLoginController@login');
Route::any('/dologin', 'Modular\ModularLoginController@dologin');

//new
Route::get('/login', 'Modular\ModularLoginController@login_get');
Route::post('/login', 'Modular\ModularLoginController@login_post');
Route::get('/logout', 'Modular\ModularController@logout');
Route::any('/article-vue', 'Modular\ModularController@article_vue');

Route::any('/forgotpass', 'Modular\ModularForgotpassController@forgotpass');


Route::prefix('modular')->group(function () {
	
	// Return to controller
	Route::get('/', 'Modular\ModularController@index');
	Route::get('/welcome', 'Modular\ModularController@welcome');
	Route::get('/about', 'Modular\ModularController@about');
	Route::get('/list-user', 'Modular\ModularListUserController@listUser');
	
});

// Route::prefix('member')->group(['middleware' => ['check.member']], function () {
// Route::prefix('client/')->group(['middleware' => 'check.user'], function () {
Route::group(['prefix' => 'client/', 'middleware' => 'check.user'], function () {
// Route::prefix('client/')->group(function () {
	
	// return view
	// Route::get('welcome', function () {
		// return view('Modular\ModularController@welcome');
	// });
	
	// Return to controller
	Route::get('/', 'Client\ClientController@index');
	Route::get('dashboard', 'Client\ClientDashboardController@dashboard');
	Route::get('welcome', 'Client\ClientController@welcome');
	Route::get('about', 'Client\ClientController@about');
	Route::get('example', 'Client\ClientController@example');
	Route::get('no_access', 'Client\ClientController@no_access');
	
	Route::get('dashboard', 'Client\ClientDashboardController@dashboard');
	
	// DONE
	Route::get('company', 'Client\ClientCompanyController@company');
	Route::post('company/insert', 'Client\ClientCompanyController@insert');
	Route::post('company/update', 'Client\ClientCompanyController@update');
	Route::any('company/delete', 'Client\ClientCompanyController@delete');
	Route::any('company/bulk', 'Client\ClientCompanyController@bulk');

	Route::get('user', 'Client\ClientUserController@user');
	Route::any('user/insert', 'Client\ClientUserController@insert');
	Route::any('user/update', 'Client\ClientUserController@update');
	Route::any('user/delete', 'Client\ClientUserController@delete');
	Route::any('user/bulk', 'Client\ClientUserController@bulk');
	
	Route::get('user-attribute', 'Client\ClientUserAttributeController@user_attribute');
	Route::any('user-attribute/insert', 'Client\ClientUserAttributeController@insert');
	Route::any('user-attribute/update', 'Client\ClientUserAttributeController@update');
	Route::any('user-attribute/delete', 'Client\ClientUserAttributeController@delete');
	Route::any('user-attribute/bulk', 'Client\ClientUserAttributeController@bulk');
	
	Route::get('site/ajax', 'Client\ClientSiteController@ajax');
	Route::get('site', 'Client\ClientSiteController@site');
	Route::any('site/insert', 'Client\ClientSiteController@insert');
	Route::any('site/update', 'Client\ClientSiteController@update');
	Route::any('site/delete', 'Client\ClientSiteController@delete');
	Route::any('site/bulk', 'Client\ClientSiteController@bulk');
	
	Route::get('pic', 'Client\ClientPicController@pic');
	Route::any('pic/insert', 'Client\ClientPicController@insert');
	Route::any('pic/update', 'Client\ClientPicController@update');
	Route::any('pic/delete', 'Client\ClientPicController@delete');
	Route::any('pic/bulk', 'Client\ClientPicController@bulk');
	
	Route::get('reason', 'Client\ClientReasonController@reason');
	Route::any('reason/insert', 'Client\ClientReasonController@insert');
	Route::any('reason/update', 'Client\ClientReasonController@update');
	Route::any('reason/delete', 'Client\ClientReasonController@delete');
	Route::any('reason/bulk', 'Client\ClientReasonController@bulk');

	Route::get('reason-type', 'Client\ClientReasonTypeController@reason_type');
	Route::any('reason-type/insert', 'Client\ClientReasonTypeController@insert');
	Route::any('reason-type/update', 'Client\ClientReasonTypeController@update');
	Route::any('reason-type/delete', 'Client\ClientReasonTypeController@delete');
	Route::any('reason-type/bulk', 'Client\ClientReasonTypeController@bulk');

	Route::get('level', 'Client\ClientLevelController@level');
	Route::any('level/insert', 'Client\ClientLevelController@insert');
	Route::any('level/update', 'Client\ClientLevelController@update');
	Route::any('level/delete', 'Client\ClientLevelController@delete');
	Route::any('level/bulk', 'Client\ClientLevelController@bulk');
	
	Route::get('article', 'Client\ClientArticleController@article');
	Route::any('article/insert', 'Client\ClientArticleController@insert');
	Route::any('article/update', 'Client\ClientArticleController@update');
	Route::any('article/delete', 'Client\ClientArticleController@delete');
	Route::any('article/bulk', 'Client\ClientArticleController@bulk');
	
	Route::get('reason-type-mapping', 'Client\ClientReasonTypemappingController@reason_type_mapping');
	Route::any('reason-type-mapping/insert', 'Client\ClientReasonTypemappingController@insert');
	Route::any('reason-type-mapping/update', 'Client\ClientReasonTypemappingController@update');
	Route::any('reason-type-mapping/delete', 'Client\ClientReasonTypemappingController@delete');
	Route::any('reason-type-mapping/bulk', 'Client\ClientReasonTypemappingController@bulk');
	
	Route::get('article-stock', 'Client\ClientArticleStockController@article_stock');
	Route::any('article-stock/insert', 'Client\ClientArticleStockController@insert');
	Route::any('article-stock/update', 'Client\ClientArticleStockController@update');
	Route::any('article-stock/delete', 'Client\ClientArticleStockController@delete');
	Route::any('article-stock/bulk', 'Client\ClientArticleStockController@bulk');

	Route::get('article-attribute', 'Client\ClientArticleAttributeController@article_attribute');
	Route::any('article-attribute/insert', 'Client\ClientArticleAttributeController@insert');
	Route::any('article-attribute/update', 'Client\ClientArticleAttributeController@update');
	Route::any('article-attribute/delete', 'Client\ClientArticleAttributeController@delete');
	Route::any('article-attribute/bulk', 'Client\ClientArticleAttributeController@bulk');
	
	Route::get('article-attribute-value', 'Client\ClientArticleAttributeValueController@article_attribute_value');
	Route::any('article-attribute-value/insert', 'Client\ClientArticleAttributeValueController@insert');
	Route::any('article-attribute-value/update', 'Client\ClientArticleAttributeValueController@update');
	Route::any('article-attribute-value/delete', 'Client\ClientArticleAttributeValueController@delete');
	Route::any('article-attribute-value/bulk', 'Client\ClientArticleAttributeValueController@bulk');
	
	Route::get('transaction', 'Client\ClientTransactionController@transaction');
	Route::any('transaction/insert', 'Client\ClientTransactionController@insert');
	Route::any('transaction/update', 'Client\ClientTransactionController@update');
	Route::any('transaction/delete', 'Client\ClientTransactionController@delete');
	Route::any('transaction/bulk', 'Client\ClientTransactionController@bulk');
	
	Route::get('role', 'Client\ClientRoleController@role');
	Route::any('role/insert', 'Client\ClientRoleController@insert');
	Route::any('role/update', 'Client\ClientRoleController@update');
	Route::any('role/delete', 'Client\ClientRoleController@delete');
	Route::any('role/bulk', 'Client\ClientRoleController@bulk');
	
	Route::get('capability', 'Client\ClientCapabilityController@capability');
	Route::any('capability/insert', 'Client\ClientCapabilityController@insert');
	Route::any('capability/update', 'Client\ClientCapabilityController@update');
	Route::any('capability/delete', 'Client\ClientCapabilityController@delete');
	Route::any('capability/bulk', 'Client\ClientCapabilityController@bulk');
	
	Route::get('role-capability', 'Client\ClientRoleCapabilityController@role_capability');
	Route::any('role-capability/insert', 'Client\ClientRoleCapabilityController@insert');
	Route::any('role-capability/update', 'Client\ClientRoleCapabilityController@update');
	Route::any('role-capability/delete', 'Client\ClientRoleCapabilityController@delete');
	Route::any('role-capability/bulk', 'Client\ClientRoleCapabilityController@bulk');
	
	Route::get('rfid-article', 'Client\ClientRfidArticleController@rfid_article');
	Route::any('rfid-article/insert', 'Client\ClientRfidArticleController@insert');
	Route::any('rfid-article/update', 'Client\ClientRfidArticleController@update');
	Route::any('rfid-article/delete', 'Client\ClientRfidArticleController@delete');
	Route::any('rfid-article/bulk', 'Client\ClientRfidArticleController@bulk');
	
	Route::get('article-po', 'Client\ClientArticlePoController@article_po');
	Route::any('article-po/insert', 'Client\ClientArticlePoController@insert');
	Route::any('article-po/update', 'Client\ClientArticlePoController@update');
	Route::any('article-po/delete', 'Client\ClientArticlePoController@delete');
	Route::any('article-po/bulk', 'Client\ClientArticlePoController@bulk');
	
	Route::get('config', 'Client\ClientConfigController@config');
	Route::any('config/insert', 'Client\ClientConfigController@insert');
	Route::any('config/update', 'Client\ClientConfigController@update');
	Route::any('config/delete', 'Client\ClientConfigController@delete');
	Route::any('config/bulk', 'Client\ClientConfigController@bulk');
	
	// Route::get('reason_type', 'Client\ClientController@reason_type');
	// Route::any('reason_type/insert', 'Client\ClientController@insert');
	// Route::any('reason_type/update', 'Client\ClientController@update');
	// Route::any('reason_type/delete', 'Client\ClientController@delete');
	// Route::any('reason_type/bulk', 'Client\ClientController@bulk');
	
	// Route::get('', 'Client\ClientController@');
	// Route::any('/update', 'Client\ClientController@update');
	// Route::any('/delete', 'Client\ClientController@delete');
	// Route::any('/bulk', 'Client\ClientController@bulk');
	
	// Route::any('/logout', 'Client\ClientController@logout');
	
	
});

Route::prefix('testing/')->group(function () {
	
	// Return to controller
	// Route::get('welcome', 'Testing\TestingController@welcome');
	// Route::get('about', 'Testing\TestingController@about');
	// Route::get('company', 'Testing\TestingController@company');
	Route::get('matrix', 'Testing\TestingController@matrix');
	
});

// Route::prefix('member')->group(['middleware' => ['check.member']], function () {
	
// 	// Return to controller
// 	Route::get('/home', 'Member\MemberController@home');
// 	Route::get('/logout', 'Member\MemberController@logout');
	
// });

// Route::group(['prefix' => 'member', 'middleware' => ['check.member']], function () {
	
	// // Return to controller
	// Route::get('/home', 'Member\MemberController@home');
	// Route::get('/logout', 'Member\MemberController@logout');
	
// });


//------------------------------------
// Api start
Route::prefix('api/v1/')->group(function () {
	
	Route::prefix('article')->group(function () {
		Route::get('get', 'Api\v1\ApiArticleController@get');
		Route::post('post', 'Api\v1\ApiArticleController@post');
		Route::put('put', 'Api\v1\ApiArticleController@put');
		Route::delete('delete', 'Api\v1\ApiArticleController@delete');
	});
	
	Route::any('member', 'Api\v1\MemberController@about');
	
});
// Api end
//------------------------------------

// Wildcard route
// Route::get('/{any}', function ($any) {
  // // any other url, subfolders also
  
// })->where('any', '.*');

// 404 Route Handler
// Route::any('{url_param}', function() {
    // abort(404, '404 Error. Page not found!');
// })->where('url_param', '.*');


	