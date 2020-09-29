<?php
  use App\Http\Controllers\LanguageController;

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


// Route url
Route::middleware(['auth', 'isActivated'])->group(function () {

  Route::resource('roles','RoleController');
  Route::resource('users','UserController');

  Route::get('/', 'DashboardController@dashboardAnalytics');

  // Route Dashboards
  Route::get('/dashboard-analytics', 'DashboardController@dashboardAnalytics');
  Route::get('/scrap-image', 'ScrapImageController@index');
  Route::post('/scrap-image', 'ScrapImageController@getImages');

  Route::get('/post-manage', 'PostController@manage_index');
  Route::post('/post-get', 'PostController@getPosts');
  Route::post('/post-save', 'PostController@savePosts');
  Route::post('/post-delete', 'PostController@deletePost');
  Route::post('/post-approve', 'PostController@approvePost');
  Route::get('/post-not-approve', 'PostController@getNotApprovedPost');
  Route::get('/post-view', 'PostController@view_index');
  Route::post('/post-image-download', 'PostController@download_image');

  // My posts
  Route::get('/myposts', 'MyPostController@index');
  Route::delete('/myposts/{post}', 'MyPostController@destroy')->name('myposts.destroy');

  // Free posts
  Route::get('/freeposts', 'FreePostController@index');
  Route::get('/freeposts/create', 'FreePostController@create')->name('freeposts.create');
  Route::post('/freeposts', 'FreePostController@store')->name('freeposts.store');
  Route::delete('/freeposts/{freepost}', 'FreePostController@destroy')->name('freeposts.destroy');

  // Profile
  Route::resource('/profiles', 'ProfileController');

  // Account
  Route::get('/account', 'AccountController@index')->name('account.show');
  Route::post('/account-update/{user}', 'AccountController@update')->name('account.update');
  Route::post('/account-changepassword/{user}', 'AccountController@changePassword')->name('account.changepassword');
});


Auth::routes();

// locale Route
Route::get('lang/{locale}',[LanguageController::class,'swap']);
