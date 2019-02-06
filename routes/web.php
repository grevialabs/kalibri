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

// Route::get('/login', 'Modular\ModularController@login');
// Route::any('/login', 'Modular\ModularLoginController@login');
Route::any('/login', 'Client\ClientController@login');
Route::any('/article', 'Modular\ModularArticleController@article');

Route::any('/company', 'Modular\ModularCompanyController@company');
// Route::any('/company_list', 'Modular\ModularCompanyController@company_list');
// Route::any('/company_form', 'Modular\ModularCompanyController@company_form');


Route::any('/article-vue', 'Modular\ModularController@article_vue');
Route::any('/forgotpass', 'Modular\ModularForgotpassController@forgotpass');


Route::prefix('modular')->group(function () {
	
	// Return to controller
	Route::get('/', 'Modular\ModularController@index');
	Route::get('/welcome', 'Modular\ModularController@welcome');
	Route::get('/about', 'Modular\ModularController@about');
	Route::get('/list-user', 'Modular\ModularListUserController@listUser');
	
});

Route::prefix('admin/')->group(function () {
	
	// return view
	// Route::get('welcome', function () {
		// return view('Modular\ModularController@welcome');
	// });
	
	// Return to controller
	Route::get('welcome', 'Admin\AdminController@welcome');
	Route::get('about', 'Admin\AdminController@about');
	
});

Route::prefix('client/')->group(function () {
	
	// return view
	// Route::get('welcome', function () {
		// return view('Modular\ModularController@welcome');
	// });
	
	// Return to controller
	Route::get('/', 'Client\ClientController@index');
	Route::get('welcome', 'Client\ClientController@welcome');
	Route::get('about', 'Client\ClientController@about');
	Route::get('login', 'Client\ClientController@login');
	Route::get('example', 'Client\ClientController@example');
	
	// DONE
	Route::get('company', 'Client\ClientCompanyController@company');
	Route::any('company/insert', 'Client\ClientCompanyController@insert');
	Route::any('company/update', 'Client\ClientCompanyController@update');
	Route::any('company/delete', 'Client\ClientCompanyController@delete');
	Route::any('company/bulk', 'Client\ClientCompanyController@bulk');

	Route::get('user', 'Client\ClientUserController@user');
	Route::any('user/insert', 'Client\ClientUserController@insert');
	Route::any('user/update', 'Client\ClientUserController@update');
	Route::any('user/delete', 'Client\ClientUserController@delete');
	Route::any('user/bulk', 'Client\ClientUserController@bulk');
	
	Route::get('user_attribute', 'Client\ClientUserAttributeController@user_attribute');
	Route::any('user_attribute/insert', 'Client\ClientUserAttributeController@insert');
	Route::any('user_attribute/update', 'Client\ClientUserAttributeController@update');
	Route::any('user_attribute/delete', 'Client\ClientUserAttributeController@delete');
	Route::any('user_attribute/bulk', 'Client\ClientUserAttributeController@bulk');
	
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

	Route::get('level', 'Client\ClientLevelController@level');
	Route::any('level/insert', 'Client\ClientLevelController@insert');
	Route::any('level/update', 'Client\ClientLevelController@update');
	Route::any('level/delete', 'Client\ClientLevelController@delete');
	Route::any('level/bulk', 'Client\ClientLevelController@bulk');
	
	// Route::get('reason_type', 'Client\ClientController@reason_type');
	// Route::any('reason_type/insert', 'Client\ClientController@insert');
	// Route::any('reason_type/update', 'Client\ClientController@update');
	// Route::any('reason_type/delete', 'Client\ClientController@delete');
	// Route::any('reason_type/bulk', 'Client\ClientController@bulk');
	
	// Route::get('', 'Client\ClientController@');
	// Route::any('/update', 'Client\ClientController@update');
	// Route::any('/delete', 'Client\ClientController@delete');
	// Route::any('/bulk', 'Client\ClientController@bulk');
	
	
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

Route::group(['prefix' => 'member', 'middleware' => ['check.member']], function () {
	
	// Return to controller
	Route::get('/home', 'Member\MemberController@home');
	Route::get('/logout', 'Member\MemberController@logout');
	
});


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


	