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

Route::get('/profile','UserpageController@getProfile')->name('profile');
Route::get('/edit_profile','UserpageController@getEditProfile')->name('get.edit.profile');
Route::post('/edit_profile','UserpageController@postEditProfile')->name('post.edit.profile');
Route::get('/create_new_trip','TripController@showFormCreateTrip')->name('form_create_trip');
//check auth
Route::post('/create_new_trip','TripController@CreateTrip')->name('create_new_trip');

Route::get('/trip_home/plan/{trip_id}', 'TripPageController@showPage')->name('show_trip_plan');
Route::get('/trip_home/plan/{trip_id}/edit', 'TripPageController@editPlan')->name('edit_trip_plan');
Route::get('/list_join','UserpageController@listTripJoin')->name('list_join');
Route::get('/list_follow', 'UserpageController@listTripFolow')->name('list_follow');
Route::get('/list_my_create', 'UserpageController@listTripCreate')->name('list_my_create');

Route::get('/trip_home/list_member/{trip_id}', 'TripPageController@show_member')->name('show_member');
Route::get('/trip_home/addFolow/{trip_id}/{user_id}', 'TripPageController@addFollow')->name('add_follow');
Route::get('/trip_home/add_request_join/{trip_id}', 'TripPageController@addRequestJoin')->name('add_request_join');
Route::get('/trip_home/delete_request_join/{trip_id}', 'TripPageController@deleteRequestJoin')->name('delete_request_join');
Route::get('/trip_home/deleteFollow/{trip_id}','TripPageController@deleteFollow')->name('delete_follow');
Route::get('/trip_home/quit_trip/{trip_id}','TripPageController@quitTrip')->name('quit_trip');
//them midderwate check co phai quan li khong vao day
Route::get('/trip_home/list_member/add_mem/{trip_id}/{user_id}', 'TripController@addMember')->name('add_member');
Route::get('/trip_home/list_member/delete_request/{trip_id}/{user_id}', 'TripController@deleteRequest')->name('delete_request');
Route::get('/trip_home/list_member/delete_member/{trip_id}/{user_id}', 'TripController@deleteJoiner')->name('delete_member');
//
Route::get('/trip_home/comment/{trip_id}','CommentController@get_comment')->name('get.comment');
Route::post('/trip_home/comment/{trip_id}','CommentController@post_comment')->name('post.comment');

Route::post('/rep_comment/{trip_id}/{father_id}','CommentController@post_rep_comment')->name('post.rep.comment');


Route::get('demo', function () {
	return view('js_demo.demo');
});

Route::post('/test_json',function () {
	$comment_id = isset($_POST['s']) ? $_POST['s'] : 'xxx';
	// echo $comment_id; //tra ve object
	return json_encode($comment_id); //return json
});


Route::get('/upload', 'CommentController@uploadForm');
Route::post('/upload', 'CommentController@storeFiles');


Route::get('uploadfile', function(){
	return View::make('demo_comment');
});
// app/routes.php
Route::post('handle-form', function()
{
 $name = Input::file('book')->getClientOriginalName();
 Input::file('book')->move('/storage/directory', $name);
 return 'File was moved.';
});