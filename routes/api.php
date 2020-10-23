<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Check Email
Route::get('/blog/share/checkmail/', 'api\CheckmailController@Check')->name('checkmail');

// Generate Api key
Route::get('blog/share/generatekey', 'api\GenerateApiController@GenerateAPI')->name('generatekey');

// Get existing Api key
Route::get('blog/share/getapi', 'api\GenerateApiController@GetAPI')->name('getapi');


// Api Services  with apikey validation 
Route::group(['middleware' => 'checkApiKey'], function () {
    Route::get('blog/service/user', 'api\ServiceController@getUser')->name('service.user');
    Route::post('/blog/service/user', 'api\RegisterController@UserRegister')->name('loginresigter');
    Route::get('blog/service/question', 'api\QuestionController@getMethod');
    Route::get('blog/service/blog', 'api\BlogController@getBlog');
});


//FrontEnd Section
Route::get('recent-question', 'User\QuestionController@getRecentQuestion');
Route::get('related-question/{id}','User\QuestionController@relatedQuestion');
Route::get('all-blogs', 'User\BlogController@allBlogs');

// Question answer section
Route::get('/question/answer/{id}','User\QuestionController@getAns')->name('get-answer');
Route::post('/question/answer','User\QuestionController@newAns')->name('new-answer');
Route::delete('/delete-answer/{id}','User\QuestionController@deleteAns');
Route::post('/update-answer','User\QuestionController@updateAns');

// Blog comment section
Route::post('new-comment','User\BlogController@newComment')->name('new-blog');
Route::get('get-comments/{id}','User\BlogController@getComment');
Route::delete('delete-comment/{id}','User\BlogController@deleteComment');
Route::put('update-comment','User\BlogController@updateComment');



Route::fallback(function () {
    echo " 
   <div style='padding: 10px 20px; width:250px; height:200px; text-align:center; position:absolute; top:0; bottom:0; left:0; right:0; margin:auto;'>
    <h1>404 not found <br></h1>
   <a style='border:1px solid blue;text-decoration:none;padding: 10px 20px;' href='" . route('home') . "'>Home<Home>
   </div>";
});
