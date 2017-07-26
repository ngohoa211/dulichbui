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


Route::get('/alltrip', function () {
    return view('all trip.alltrip');
})->name('alltrip');

Route::get('/profile','UserpageController@getInsert')->name('profile');

Route::get('/create_new_trip', function () {
    return view('trips.trips_create');
})->name('create');