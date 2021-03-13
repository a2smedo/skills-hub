<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CatController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\SkillController;

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

Route::get('/categories',[CatController::class, 'index']);
Route::get('/categories/show/{id}',[CatController::class, 'show']);

Route::get('/skills',[SkillController::class, 'index']);
Route::get('/skills/show/{id}',[SkillController::class, 'show']);

Route::get('/exams',[ExamController::class, 'index']);
Route::get('/exams/show/{id}',[ExamController::class, 'show']);






//token
Route::post('/register',[AuthController::class, 'register']);

Route::post('/login',[AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group( function() {

    Route::get('/logout',[AuthController::class, 'logout']);

    Route::get('/exams/show-questions/{id}',[ExamController::class, 'showQuest']);
    Route::post('/exams/start/{examId}',[ExamController::class, 'start']);
    Route::post('/exams/submit/{id}',[ExamController::class, 'submit']);
});




