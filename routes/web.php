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
Route::get('/welcome', 'Modular\ModularController@welcome');
Route::get('/about', 'Modular\ModularController@about');
Route::get('/test_curl', 'Modular\ModularController@test_curl');

// get twitter
Route::get('/scrapetw_cron', 'Scrapetw\ScrapetwCronController@scrapetw_cron');
Route::get('/scrapetw_result', 'Scrapetw\ScrapetwResultController@scrapetw_result');
// Route::get('/scrapetw_export', 'Scrapetw\ScrapetwController@scrapetw_export');

// get IG
Route::get('/scrapeig_cron', 'Scrapeig\ScrapeigCronController@scrapeig_cron');
Route::get('/scrapeig_result', 'Scrapeig\ScrapeigResultController@scrapeig_result');
Route::get('/scrapeig_sampledata', 'Scrapeig\ScrapeigController@scrapeig_sampledata');
Route::get('/scrapeig', 'Scrapeig\ScrapeigController@scrapeig_index');

// Route::get('/login', 'Modular\ModularController@login');
Route::any('/login', 'Modular\ModularLoginController@login');
Route::any('/article', 'Modular\ModularArticleController@article');


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


	