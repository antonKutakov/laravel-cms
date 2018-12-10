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

Route::group(['middleware' => 'admin'], function () {
    
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/post/{slug}', 'HomeController@show')->name('post.show');
Route::get('/tag/{slug}', 'HomeController@tag')->name('tag.show');
Route::get('/category/{slug}', 'HomeController@category')->name('category.show');
Route::post('/subscribe', 'SubsController@subscribe');

Route::group(['middleware' => 'guest'], function (){
    Route::get('/register', 'AuthController@registerForm')->name('register');
    Route::post('/register', 'AuthController@register');
    Route::get('/login', 'AuthController@loginForm')->name('login');
    Route::post('/login', 'AuthController@login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', 'AuthController@logout')->name('logout');
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::post('/profile', 'ProfileController@store');
    Route::post('/comment', 'CommentsController@store');
});

Route::get('/post', function(){
    return redirect()->action('HomeController@index');
});

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => 'admin'
    ], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::resource('/categories', 'CategoriesController'); 
    Route::resource('/tags', 'TagsController');
    Route::resource('/users', 'UsersController');
    Route::resource('/posts', 'PostsController');
    Route::get('/comments', 'CommentsController@index')->name('comments');
    Route::get('/comments/toggle/{id}', 'CommentsController@toggle');
    Route::delete('/comments/{id}/destroy', 'CommentsController@destroy')->name('comments.destroy');
});


