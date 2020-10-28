<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
// use App\Events\BroadcastEvent;


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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin/dashboard', 'Admin\AdminController@admin')->name('admin.dashboard');
    Route::resource('/admin/user-management', 'Admin\UserManagementController');
    Route::resource('/admin/question/manage-question', 'Admin\QuestionController');
    Route::resource('/admin/blog/blog-category', 'Admin\BlogCategoryController');
    Route::resource('/admin/blog/manage-blog', 'Admin\BlogController');
    Route::resource('/admin/question/question-category', 'Admin\QuestionCategoryController');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/user/dashboard', 'User\UserController@dashboard')->name('user.dashboard');
});

Route::get('/view-question/{id}', 'User\QuestionController@index')->name('view-question');
Route::get('/view-blog/{id}', 'User\BlogController@viewBlog')->name('view-blog');

Route::fallback(function () {
    echo "
   <div style='padding: 10px 20px; width:250px; height:200px; text-align:center; position:absolute; top:0; bottom:0; left:0; right:0; margin:auto;'>
    <h1>404 not found <br></h1>
   <a style='border:1px solid blue;text-decoration:none;padding: 10px 20px;' href='" . route('home') . "'>Home<Home>
   </div>";
});
