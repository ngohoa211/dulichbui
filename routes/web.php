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

Route::get('/profile','UserpageController@getInsert')->name('profile');

Route::get('/create_new_trip', function () {
    return view('trips.trips_create');
})->name('create');
Route::get('/', function () {
    return view('trips.trips_create');
})->name('create');
Route::get('/add_part', function () {
    return view('trips.parts.add_part');
})->name('add_part');
Route::get('/list_join', function () {
    return view('user_page.allTripJoin');
})->name('list_join');
Route::get('/list_follow', function () {
    return view('user_page.allTripFollow');
})->name('list_follow');
Route::get('/list_my_create', function () {
    return view('user_page.allTripCreate');
})->name('list_my_create');
