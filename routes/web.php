<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CatController as AdminCatController;
use App\Http\Controllers\Admin\ExamController as AdminExamController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SkillController as AdminSkillController;
use App\Http\Controllers\Admin\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LangController;
use App\Http\Controllers\web\CatController;
use App\Http\Controllers\web\ExamController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\SkillController;
use App\Http\Controllers\web\ContactController;
use App\Http\Controllers\web\QuestionController;
use App\Http\Controllers\web\UserController;


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

Route::get('/lang/set/{lang}', [LangController::class, 'set']);

Route::middleware('lang')->group(function () {

    Route::get('/', [HomeController::class, 'index']);
    Route::post('/load_more', [HomeController::class, 'load_more']);
    Route::get('category/{cat}', [CatController::class, 'show']);
    Route::get('skill/{skill}', [SkillController::class, 'show']);
    Route::get('contact', [ContactController::class, 'index']);
    Route::get('exam/{exam}', [ExamController::class, 'show']);



    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/profile', [UserController::class, 'index']);
        Route::post('contact/send', [ContactController::class, 'send']);

        Route::middleware("isStudent")->group(function () {
            Route::post('exam/start/{exam}', [ExamController::class, 'start'])->middleware(['canEnter']);
            Route::get('exam/questions/{exam}', [QuestionController::class, 'show']);
            Route::post('exam/send/{exam}', [QuestionController::class, 'sendExam']);
            Route::post('exam/cancel/{exam}', [QuestionController::class, 'cancelExam']);
        });
    });
});



Route::prefix('dashboard')->middleware(['auth', 'verified', 'canEnterDashboard'])->group(function () {
    Route::get('/', [AdminHomeController::class, 'index']);

    //Categories
    Route::get('/categories', [AdminCatController::class, 'index']);
    Route::post('/categories/store', [AdminCatController::class, 'store']);
    Route::post('/categories/update', [AdminCatController::class, 'update']);
    Route::get('/categories/delete/{cat}', [AdminCatController::class, 'delete']);
    Route::get('/categories/toggle/{cat}', [AdminCatController::class, 'toggle']);

    //Skills
    Route::get('/skills', [AdminSkillController::class, 'index']);
    Route::post('/skills/store', [AdminSkillController::class, 'store']);
    Route::post('/skills/update', [AdminSkillController::class, 'update']);
    Route::get('/skills/delete/{skill}', [AdminSkillController::class, 'delete']);
    Route::get('/skills/toggle/{skill}', [AdminSkillController::class, 'toggle']);

    //Exams
    Route::get('/exams', [AdminExamController::class, 'index']);
    Route::get('/exams/show/{exam}', [AdminExamController::class, 'show']);

    Route::get('/exams/create', [AdminExamController::class, 'create']);
    Route::post('/exams/store', [AdminExamController::class, 'store']);
    Route::get('/exams/edit/{exam}', [AdminExamController::class, 'edit']);
    Route::post('/exams/update/{exam}', [AdminExamController::class, 'update']);
    Route::get('/exams/delete/{exam}', [AdminExamController::class, 'delete']);
    Route::get('/exams/toggle/{exam}', [AdminExamController::class, 'toggle']);


    Route::get('/exams/show/{exam}/questions', [AdminExamController::class, 'showQuest']);

    Route::get('/exams/questions/create/{exam}', [AdminExamController::class, 'createQuest']);

    Route::post('/exams/questions/store/{exam}', [AdminExamController::class, 'storeQuest']);

    Route::get('/exams/questions/edit/{exam}/{question}', [AdminExamController::class, 'editQuest']);

    Route::post('/exams/questions/update/{exam}/{question}', [AdminExamController::class, 'updateQuest']);

    // users
    Route::get('/students', [StudentController::class, 'index']);
    Route::get('/students/show-scores/{id}', [StudentController::class, 'showScore']);
    Route::get('/students/open-exam/{userId}/{exam}', [StudentController::class, 'openExam']);
    Route::get('/students/close-exam/{userId}/{exam}', [StudentController::class, 'closeExam']);


    //Admins
    Route::middleware('isSuperAdmin')->group(function (){

        Route::get('/admins', [AdminController::class, 'index']);
        Route::get('/admins/create', [AdminController::class, 'create']);
        Route::post('/admins/store', [AdminController::class, 'store']);
        Route::get('/admins/promot/{id}', [AdminController::class, 'promot']);
        Route::get('/admins/demot/{id}', [AdminController::class, 'demot']);
    });

    Route::get('/messages', [MessageController::class, 'index']);
    Route::get('/messages/show/{message}', [MessageController::class, 'show']);
    Route::post('/messages/response/{message}', [MessageController::class, 'response']);



});


// Route::get('/test', function(){
//     Mail::to("test@test.com")->send(new ContactResponseMail("new title", "new body"));
// });
