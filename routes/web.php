<?php

use App\Http\Controllers\Profile;
use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaLikeController;
use App\Http\Controllers\Admin\Dashboard as AdminDashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|

*/


// Route::get('/', function () {
//     $users = [
//             [
//                 'name' => 'Bidz',
//                 'age' => '20'
//             ],
//             [
//                 'name' => 'PH',
//                 'age' => '12'
//             ],

//             [
//                 'name' => 'Loki',
//                 'age' => '1'
//             ]
//         ];



//         return view(
//             'profile',
//             [
//                 'users_list' => $users
//             ]
//         );
// });
// Route::get('/', [Profile::class , 'profile']);



Route::get('/', [Dashboard::class, 'dashboard'])->name('dashboard');

Route::resource('ideas', IdeaController::class)->except(['index', 'create', 'show'])->middleware('auth');
Route::resource('ideas', IdeaController::class)->only(['show']);

//FOR COMMENTS ideas {idea}/comments/{comment}
//Creating Comment
Route::resource('ideas.comments', CommentController::class)->only(['store'])->middleware('auth');


//Profile
Route::resource('users', UserController::class)->only('show');
Route::resource('users', UserController::class)->only('edit', 'update')->middleware('auth');

//FOLLOW
Route::post('users/{user}/follow', [FollowerController::class, 'follow'])->middleware('auth')->name('users.follow');

//UNFOLLOW
Route::post('users/{user}/unfollow', [FollowerController::class, 'unfollow'])->middleware('auth')->name('users.unfollow');

//LIKE
Route::post('ideas/{idea}/like', [IdeaLikeController::class, 'like'])->middleware('auth')->name('ideas.like');

//UNLIKE
Route::post('ideas/{idea}/unlike', [IdeaLikeController::class, 'unlike'])->middleware('auth')->name('ideas.unlike');



//PROFILE
Route::get('profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');

//TERMS
Route::get('/terms', function () {
    return view('terms');
})->name('terms');

//FeedController
Route::get('/feed', FeedController::class)->middleware('auth')->name('feed');


//ADMIN PAGE
Route::get('/admin', [AdminDashboardController::class, 'adminDash'])->name('admin.dashboard')->middleware(['auth', 'can:admin']);





//UNGROUP ROUTE
// //Main
// Route::get('/', [Dashboard::class , 'dashboard'])->name('dashboard');
// //Creating Post/Content
// Route::post('/ideas', [IdeaController::class , 'store'])->name('store');
// //Showing / Viewing specific Record/Content
// Route::get('/ideas/{idea}', [IdeaController::class , 'show'])->name('show');
// //Delete
// Route::delete('/ideas{idea}', [IdeaController::class , 'destroy'])->name('destroy');
// //Editing
// Route::get('/ideas/{idea}/edit', [IdeaController::class , 'edit'])->name('edit');
// //Updating
// Route::put('/ideas/{idea}', [IdeaController::class , 'update'])->name('update');

// //Creating Comment
// Route::post('/ideas{idea}/comments', [CommentController::class , 'store'])->name('comments.store');


//ROUTE GROUP
//Main
//Route::get('/', [Dashboard::class , 'dashboard'])->name('dashboard');

//Route::group(['prefix' => 'ideas/', 'as' => 'ideas.'], function(){
    
    //Showing / Viewing specific Record/Content
    //Route::get('/{idea}', [IdeaController::class , 'show'])->name('show'); //->withoutMiddleware(['auth']);


    //with Middleware
    //Route::group(['middleware' => ['auth']], function(){
        //Creating Post/Content
        // Route::post('', [IdeaController::class , 'store'])->name('store');
        // //Delete
        // Route::delete('{idea}', [IdeaController::class , 'destroy'])->name('destroy');
        // //Editing
        // Route::get('/{idea}/edit', [IdeaController::class , 'edit'])->name('edit');
        // //Updating
        // Route::put('/{idea}', [IdeaController::class , 'update'])->name('update');
        // //Creating Comment
        // Route::post('{idea}/comments', [CommentController::class , 'store'])->name('comments.store');
    //});
//});