<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ScheduleController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});   

// Login bolatin api
// Employer

//Teacher
Route::post('/teacher/add',[TeacherController::class,'add']);
Route::patch('/teacher/edit/{id}',[TeacherController::class,'edit']);
Route::delete('/teacher/delete/{id}',[TeacherController::class,'delete']);

//Student
Route::post('/student/add',[StudentController::class,'add']);
Route::patch('/student/edit/{id}',[StudentController::class,'edit']);
Route::delete('/student/delete/{id}',[StudentController::class,'delete']);

//Group
Route::post('/group/add',[GroupController::class,'add']);
Route::patch('/group/edit/{id}',[GroupController::class,'edit']);
Route::delete('/group/delete/{id}',[GroupController::class,'delete']);

//Course
Route::post('/course/add',[CourseController::class,'add']);
Route::patch('/course/edit/{id}',[CourseController::class,'edit']);
Route::delete('/course/delete/{id}',[CourseController::class,'delete']);

//Schedule
Route::get('/schedule/view',[ScheduleController::class,'view']);

//Period
Route::post('/period/add',[PeriodController::class,'add']);
Route::patch('/period/edit/{id}',[PeriodController::class,'edit']);
Route::delete('/period/delete/{id}',[PeriodController::class,'delete']);

//Login
Route::post('/login',[AuthController::class,'login']);