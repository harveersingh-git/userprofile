<?php

use Illuminate\Support\Facades\Route;


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

Route::get('/', function () { return redirect('/login');});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::any('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');

Route::any('/add-user', [App\Http\Controllers\UserController::class, 'add'])->name('add-user');
Route::any('/add-user-skills', [App\Http\Controllers\UserController::class, 'addSkills'])->name('add-user-skills');
Route::any('/add-user-exprince', [App\Http\Controllers\UserController::class, 'addExprince'])->name('add-user-exprince');
Route::post('/update-user', [App\Http\Controllers\UserController::class, 'update']);
Route::any('/user/edit/{id}', [App\Http\Controllers\UserController::class,'view']);
Route::post('/delete_user', [App\Http\Controllers\UserController::class, 'destroy']);
Route::any('/skills-education', [App\Http\Controllers\EducationController::class, 'index'])->name('skills-education');
Route::any('/add-skills-education', [App\Http\Controllers\EducationController::class, 'create'])->name('add-skills-education');
Route::any('/add-user-project', [App\Http\Controllers\UserController::class, 'addProject'])->name('add-skills-education');


Route::post('/delete_skills_education', [App\Http\Controllers\EducationController::class, 'destroy']);
Route::any('/skills-education/edit/{id}', [App\Http\Controllers\EducationController::class,'view']);
Route::post('/update-skills-education', [App\Http\Controllers\EducationController::class, 'update']);
Route::any('/information', [App\Http\Controllers\UserController::class, 'information'])->name('information');
Route::any('/information/{id}', [App\Http\Controllers\UserController::class,'information']);
Route::any('/skills_sorting', [App\Http\Controllers\UserController::class, 'skillsSorting']);
Route::get('/resume/{id}', [App\Http\Controllers\UserController::class,'resume']);
Route::any('/education_type', [App\Http\Controllers\UserController::class, 'educationType']);
Route::any('/learning_skills_sorting', [App\Http\Controllers\UserController::class, 'learningSkillsSorting']);




