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
    return view('welcome');
});
Route::get('home',function(){
	return view('home');})->name('home');

Route::get('a',function(){
	return view('header');
});
Route::get('login',function(){
	return view('layout.login');
})->name('get_login');
Route::get('register',function(){
	return view('layout.register');
})->name('get_register');
Route::get('logout',function(){
	return view('home');})->name('logout');