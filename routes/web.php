<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;



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
// Route::any('/logout', function () { return redirect('/login');});
Route::any('/', function () {
    return redirect('/login');
});
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Auth::routes();
Route::group(['middleware' => 'Role'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
Route::get('/changePassword', [ForgotPasswordController::class, 'showChangePasswordGet'])->name('changePasswordGet');
Route::post('/changePassword', [ForgotPasswordController::class, 'changePasswordPost'])->name('changePasswordPost');



Route::any('/users', [App\Http\Controllers\UserController::class, 'userList'])->name('users');

Route::any('/add-user', [App\Http\Controllers\UserController::class, 'add'])->name('add-user');
Route::any('/add-user-skills', [App\Http\Controllers\UserController::class, 'addSkills'])->name('add-user-skills');
Route::any('/add-user-exprince', [App\Http\Controllers\UserController::class, 'addExprince'])->name('add-user-exprince');
Route::any('/add-user-certificate', [App\Http\Controllers\UserController::class, 'addCertificate'])->name('add-user-certificate');

Route::post('/update-user', [App\Http\Controllers\UserController::class, 'update']);
Route::any('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'view']);
Route::post('/delete_user', [App\Http\Controllers\UserController::class, 'destroy']);
Route::any('/skills-education', [App\Http\Controllers\EducationController::class, 'index'])->name('skills-education');
Route::any('/add-skills-education', [App\Http\Controllers\EducationController::class, 'create'])->name('add-skills-education');
Route::any('/add-user-project', [App\Http\Controllers\UserController::class, 'addProject'])->name('add-user-project');
Route::any('/add-user-achievement', [App\Http\Controllers\UserController::class, 'addAchievement'])->name('add-user-achievement');


Route::post('/delete_skills_education', [App\Http\Controllers\EducationController::class, 'destroy']);
Route::any('/skills-education/edit/{id}', [App\Http\Controllers\EducationController::class, 'view']);
Route::post('/update-skills-education', [App\Http\Controllers\EducationController::class, 'update']);
Route::any('/information', [App\Http\Controllers\UserController::class, 'information'])->name('information');
Route::any('/information/{id}', [App\Http\Controllers\UserController::class, 'information']);
Route::any('/skills_sorting', [App\Http\Controllers\UserController::class, 'skillsSorting']);
Route::get('/resume/{id}', [App\Http\Controllers\UserController::class, 'resume']);
Route::get('/view-resume/{id}', [App\Http\Controllers\UserController::class, 'viewResume']);
Route::any('/education_type', [App\Http\Controllers\UserController::class, 'educationType']);
Route::any('/learning_skills_sorting', [App\Http\Controllers\UserController::class, 'learningSkillsSorting']);

Route::any('/team', [App\Http\Controllers\TeamController::class, 'index'])->name('team');
Route::any('/add-team', [App\Http\Controllers\TeamController::class, 'create'])->name('add-team');
Route::any('/team/edit/{id}', [App\Http\Controllers\TeamController::class, 'view']);
Route::post('/update-team', [App\Http\Controllers\TeamController::class, 'update']);
Route::post('/delete_team', [App\Http\Controllers\TeamController::class, 'destroy']);

Route::post('/remove_skills', [App\Http\Controllers\UserController::class, 'removeSkill']);
Route::post('/remove_education', [App\Http\Controllers\UserController::class, 'removeEducation']);
Route::post('/check_present', [App\Http\Controllers\UserController::class, 'checkPresent']);
Route::post('/remove_exp', [App\Http\Controllers\UserController::class, 'removeExp']);
Route::post('/remove_certificate', [App\Http\Controllers\UserController::class, 'removeCertificate']);
Route::post('/remove_achievement', [App\Http\Controllers\UserController::class, 'removeAchievement']);
Route::post('/remove_project', [App\Http\Controllers\UserController::class, 'removeProject']);
Route::post('/remove_portfolio', [App\Http\Controllers\UserController::class, 'removePortfolio']);


Route::any('/client-status', [App\Http\Controllers\ClientStatusController::class, 'index'])->name('client-status');
Route::any('/add-client-status', [App\Http\Controllers\ClientStatusController::class, 'create'])->name('add-client-status');
Route::any('/client-status/edit/{id}', [App\Http\Controllers\ClientStatusController::class, 'view']);
Route::post('/update-client-status', [App\Http\Controllers\ClientStatusController::class, 'update']);
Route::post('/delete_client_status', [App\Http\Controllers\ClientStatusController::class, 'destroy']);


Route::any('/client-type', [App\Http\Controllers\ClientTypeController::class, 'index'])->name('client-type');
Route::any('/add-client-type', [App\Http\Controllers\ClientTypeController::class, 'create'])->name('add-client-type');
Route::any('/client-type/edit/{id}', [App\Http\Controllers\ClientTypeController::class, 'view']);
Route::post('/update-client-type', [App\Http\Controllers\ClientTypeController::class, 'update']);
Route::post('/delete_client_type', [App\Http\Controllers\ClientTypeController::class, 'destroy']);



Route::any('/work-type', [App\Http\Controllers\WorkTypeController::class, 'index'])->name('work-type');
Route::any('/add-work-type', [App\Http\Controllers\WorkTypeController::class, 'create'])->name('add-work-type');
Route::any('/work-type/edit/{id}', [App\Http\Controllers\WorkTypeController::class, 'view']);
Route::post('/update-work-type', [App\Http\Controllers\WorkTypeController::class, 'update']);
Route::post('/delete_work_type', [App\Http\Controllers\WorkTypeController::class, 'destroy']);

Route::any('/clients', [App\Http\Controllers\ClientControlle::class, 'index'])->name('clients');
Route::any('/add-client', [App\Http\Controllers\ClientControlle::class, 'create'])->name('add-client');
Route::any('/add-resource/{id}', [App\Http\Controllers\ClientControlle::class, 'createResource'])->name('add-resource');

Route::any('/client/edit/{id}', [App\Http\Controllers\ClientControlle::class, 'view']);
Route::post('/update-client', [App\Http\Controllers\ClientControlle::class, 'update']);
Route::post('/delete_client', [App\Http\Controllers\ClientControlle::class, 'destroy']);
Route::any('/csv', [App\Http\Controllers\ClientControlle::class, 'csv'])->name('csv');


Route::get('/page-not-found', function () {
    return view('welcome');
});

Route::get('/click-up-report-sync/{id}', [App\Http\Controllers\ClickUpController::class, 'clickTimeSync']);

Route::any('/click-up-team-sync/{id}', [App\Http\Controllers\ClickUpController::class, 'clickTeamSync']);
Route::any('/click-up-time-sync', [App\Http\Controllers\ClickUpController::class, 'clickTimeSync']);
Route::any('/genrate-daily-report/{id}', [App\Http\Controllers\ClickUpController::class, 'genrateReport']);

Route::any('/clickup-report/{id}', [App\Http\Controllers\ClickUpController::class, 'view']);
Route::any('/clickup-report', [App\Http\Controllers\ClickUpController::class, 'view'])->name('clickup-report');

Route::get('/get_sync_dates', [App\Http\Controllers\ClickUpController::class, 'getSyncDate']);


Route::any('/daily-performance', [App\Http\Controllers\DailyPerformanceController::class, 'index'])->name('daily-performance');
Route::any('/add-daily-performance', [App\Http\Controllers\DailyPerformanceController::class, 'create'])->name('add-daily-performance');
Route::any('/daily-performance/edit/{id}', [App\Http\Controllers\DailyPerformanceController::class, 'view']);
Route::post('/update-daily-performance', [App\Http\Controllers\DailyPerformanceController::class, 'update']);
Route::post('/delete_daily_performance', [App\Http\Controllers\DailyPerformanceController::class, 'destroy']);
Route::get('/get_daily_perfomance', [App\Http\Controllers\DailyPerformanceController::class, 'getDailyPerformance']);

Route::post('/check_daily_perfomance', [App\Http\Controllers\DailyPerformanceController::class, 'checkDailyPerformance']);
Route::any('/update-click-up-report', [App\Http\Controllers\DailyPerformanceController::class, 'updateReport'])->name('update-click-up-report');
Route::post('/show_on_front', [App\Http\Controllers\DailyPerformanceController::class, 'showOnFront']);
Route::post('/skill_show_on_front', [App\Http\Controllers\EducationController::class, 'skillShowOnFront']);

