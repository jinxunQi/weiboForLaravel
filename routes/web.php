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
use Illuminate\Support\Facades\Route;

Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');
Route::get('/signup', 'UsersController@create')->name('signup');
Route::resource('users', 'UsersController');
//Route::get('/users/{user}', 'UsersController@show')->name('users.show');

//登录、退出会话
Route::get('/login', 'SessionsController@create')->name('login');
Route::post('/login', 'SessionsController@store')->name('login');
Route::delete('/logout', 'SessionsController@destroy')->name('logout');

Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');//其实在上面的resource资源路由已经包含了

Route::get('/signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

//找回密码
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');//显示重置密码的邮箱发送页面
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');//邮箱发送重设链接
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');//密码更新页面
Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');//执行密码更新操作

//博客
Route::resource('statuses', 'StatusesController', ['only' => ['store', 'destroy']]);

//用户的关注列表
Route::get('/users/{user}/followings', 'UsersController@followings')->name('users.followings');
//用户的粉丝列表
Route::get('/users/{user}/followers', 'UsersController@followers')->name('users.followers');

//关注和取消关注
Route::post('/users/followers/{user}', 'FollowersController@store')->name('followers.store');
Route::delete('/users/followers/{user}', 'FollowersController@destroy')->name('followers.destroy');
