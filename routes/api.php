<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apiController;
use App\Http\Controllers\applicationAPIsController;
use App\Http\Controllers\jobAPIsController;
use App\Http\Controllers\authController;
use App\Models\Category;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware'=>['auth:sanctum']],function() {
    Route::post('/blogs', [apiController::class,'blogStore']);
    Route::post('/jobs',[jobAPIsController::class,'jobStore']);
    Route::put('/jobs/{id}',[jobAPIsController::class,'jobUpdate']);
    Route::delete('/jobs/{id}',[jobAPIsController::class,'jobDestroy']);
    Route::post('/applications',[applicationAPIsController::class,'applicationStore']);
    Route::delete('/applications/{id}',[applicationAPIsController::class,'applicationDestroy']);
    Route::post('/logout', [authController::class,'logout']);
});

//auth routes
Route::post('/register', [authController::class,'register']);
Route::post('/login', [authController::class,'login']);

//blog routes
Route::get('/blogs', [apiController::class,'blogIndex']);
// Route::post('/blogs', [apiController::class,'blogStore']);
Route::get('/blogs/{id}', [apiController::class,'blogShow']);
Route::get('/blogs/search/{title}', [apiController::class,'blogSearch']);
Route::get('/blogs/{id}/category', [apiController::class,'blogShowCategory']);
Route::get('/blogs/{id}/tags', [apiController::class,'blogShowTag']);

//category routes
Route::get('/categories',[apiController::class,'categoryIndex']);
Route::get('/categories/{id}', [apiController::class,'categoryShow']);
Route::get('/categories/search/{category_name}', [apiController::class,'categorySearch']);
Route::get('/categories/{id}/blogs', [apiController::class,'categoryShowBlog']);

//tag routes
Route::get('/tags',[apiController::class,'tagIndex']);
Route::get('/tags/{id}', [apiController::class,'tagShow']);
Route::get('/tags/search/{tag_name}', [apiController::class,'tagSearch']);
Route::get('/tags/{id}/blogs', [apiController::class,'tagShowBlog']);

//job routes
Route::get('/jobs',[jobAPIsController::class,'jobIndex']);
Route::get('/jobs/{id}',[jobAPIsController::class,'jobShow']);
Route::get('/jobs/{id}/applications',[jobAPIsController::class,'jobShowApplications']);
Route::get('/recruiter/{id}/jobs',[jobAPIsController::class,'userJobs']);

//application routes
Route::get('/applications',[applicationAPIsController::class,'applicationIndex']);
Route::get('/applications/{id}',[applicationAPIsController::class,'applicationShow']);
Route::get('/applicant/{id}/applications',[applicationAPIsController::class,'userApplications']);