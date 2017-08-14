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

Route::get('/', function () {
	return redirect('/home');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/register', 'Auth\RegisterController@create')->name('register');

Route::get('/alltrip','AllTripController@listAllTrip')->name('alltrip');
Route::middleware('auth')->group(function () {
	Route::get('/profile','UserpageController@getProfile')->name('profile');
	Route::get('/edit_profile','UserpageController@getEditProfile')->name('get.edit.profile');
	Route::post('/edit_profile','UserpageController@postEditProfile')->name('post.edit.profile');
	Route::get('/create_new_trip','TripController@showFormCreateTrip')->name('form_create_trip');
	Route::post('/create_new_trip','TripController@CreateTrip')->name('create_new_trip');
	Route::get('/list_join','UserpageController@listTripJoin')->name('list_join');
	Route::get('/list_follow', 'UserpageController@listTripFolow')->name('list_follow');
	Route::get('/list_my_create', 'UserpageController@listTripCreate')->name('list_my_create');

	Route::get('/trip_home/plan/{trip_id}/edit', 'TripController@editPlan')->name('edit_trip_plan')
	->middleware('check_exist_trip','check_is_owner');
	Route::post('/trip_home/plan/{trip_id}/edit', 'TripController@doEditPlan')->name('do_edit_trip_plan')
	->middleware('check_exist_trip','check_is_owner');
	Route::get('/trip_home/addFolow/{trip_id}', 'TripPageController@addFollow')->name('add_follow')
	->middleware('check_exist_trip');
	Route::get('/trip_home/add_request_join/{trip_id}', 'TripPageController@addRequestJoin')->name('add_request_join')
	->middleware('check_exist_trip');
	Route::get('/trip_home/delete_request_join/{trip_id}', 'TripPageController@deleteRequestJoin')->name('delete_request_join')
	->middleware('check_exist_trip');
	Route::get('/trip_home/deleteFollow/{trip_id}','TripPageController@deleteFollow')->name('delete_follow')
	->middleware('check_exist_trip');
	Route::get('/trip_home/quit_trip/{trip_id}','TripPageController@quitTrip')->name('quit_trip')
	->middleware('check_exist_trip');
	Route::post('/trip_home/comment/{trip_id}','CommentController@post_comment')->name('post.comment')
	->middleware('check_exist_trip');
	Route::post('/rep_comment/{trip_id}/{father_id}','CommentController@post_rep_comment')->name('post.rep.comment')
	->middleware('check_exist_trip','check_exist_comment_father');
});
Route::get('/trip_home/plan/{trip_id}', 'TripPageController@showPage')->name('show_trip_plan')
->middleware('check_exist_trip');
Route::get('/trip_home/list_member/{trip_id}', 'TripPageController@show_member')->name('show_member');
Route::get('/trip_home/list_member/add_mem/{trip_id}/{user_id}', 'TripController@addMember')->name('add_member')
->middleware('check_exist_trip','check_is_owner');
Route::get('/trip_home/list_member/delete_request/{trip_id}/{user_id}', 'TripController@deleteRequest')->name('delete_request')
->middleware('check_exist_trip','check_is_owner');
Route::get('/trip_home/list_member/delete_member/{trip_id}/{user_id}', 'TripController@deleteJoiner')->name('delete_member')
->middleware('check_exist_trip','check_is_owner');
Route::get('/trip_home/comment/{trip_id}','CommentController@get_comment')->name('get.comment')
->middleware('check_exist_trip');