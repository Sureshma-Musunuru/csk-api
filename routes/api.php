<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/banners', [BannerController::class, "getBanners"]);
Route::post('/pages', [PageController::class, "getPages"]);
Route::post('/teams', [TeamController::class, "getTeams"]);
Route::post('/login', [AuthController::class, "login"]);
Route::post('/register', [AuthController::class, "register"]);
Route::post('/banners', [BannerController::class, "getBanners"]);
Route::post('/faqs', [FaqController::class, "getFaqs"]);
Route::post('/messages/add', [MessageController::class, "createMessage"]);

Route::post('/pagesbyslug', [PageController::class, "getPageBySlug"]);

Route::get('gotologin', [AuthController::class, "gotologin"])->name("login");

Route::group(["middleware" => ['auth:sanctum']], function () {
  
    
    Route::post('/banners/add', [BannerController::class, "createBanner"]);
    Route::post('/pages/add', [PageController::class, "createPage"]);
    Route::post('/faqs/add', [FaqController::class, "createFaq"]);
    Route::post('/teams/add', [TeamController::class, "createTeam"]);
    Route::post('/users/add', [UserController::class, "createUser"]);
    Route::post('/admins/add', [UserController::class, "createAdmin"]);


    Route::put('/banners', [BannerController::class, "updateBannerById"]);
    Route::put('/pages', [PageController::class, "updatePageById"]);
    Route::put('/faqs', [FaqController::class, "updateFaqById"]);
    Route::put('/teams', [TeamController::class, "updateTeamById"]);
    Route::put('/messages', [MessageController::class, "updateMessageById"]);
    Route::put('/users', [UserController::class, "updateUserById"]);
    Route::put('/admins', [UserController::class, "updateAdminById"]);


    Route::delete('/banners', [BannerController::class, "deleteBannerById"]);
    Route::delete('/pages', [PageController::class, "deletePageById"]);
    Route::delete('/faqs', [FaqController::class, "deleteFaqById"]);
    Route::delete('/teams', [TeamController::class, "deleteTeamById"]);
    Route::delete('/messages', [MessageController::class, "deleteMessageById"]);
    Route::delete('/users', [UserController::class, "deleteUserById"]);
    Route::delete('/admins', [UserController::class, "deleteAdminById"]);




    Route::post('/adminregister', [AuthController::class, "adminregister"]);
    Route::post('/banners/get', [BannerController::class, "getBannerById"]);
    Route::post('/pages/get', [PageController::class, "getPageById"]);
    Route::post('/faqs/get', [FaqController::class, "getFaqById"]);
    Route::post('/teams/get', [TeamController::class, "getTeamById"]);
    Route::post('/messages', [MessageController::class, "getMessages"]);
    Route::post('/messages/get', [MessageController::class, "getMessageById"]);
    Route::post('/users', [UserController::class, "getUsers"]);
    // Route::post('/teams', [TeamController::class, "getTeams"]);
    Route::post('/users/get', [UserController::class, "getUserById"]);
    Route::post('/admins', [UserController::class, "getadmins"]);
    Route::post('/admins/get', [UserController::class, "getAdminById"]);

    Route::post('/logout', [AuthController::class, "logout"]);
});