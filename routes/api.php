<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\VerificationController;
use App\Models\Student;
use Illuminate\Support\Facades\Artisan;

//Login
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::middleware('auth:sanctum')->group(function(){
    //Teacher
    Route::post('/teacher/add',[TeacherController::class,'add']);
    Route::patch('/teacher/edit/{id}',[TeacherController::class,'edit']);
    Route::delete('/teacher/delete/{id}',[TeacherController::class,'delete']);
    Route::get('/teacher/view',[TeacherController::class,'view']);
    //Teacher
    Route::post('/admin/add',[AdminController::class,'add']);
    Route::patch('/admin/edit/{id}',[AdminController::class,'edit']);
    Route::delete('/admin/delete/{id}',[AdminController::class,'delete']);
    Route::get('/admin/view',[AdminController::class,'view']);
    //Student
    Route::post('/student/add',[StudentController::class,'add']);
    Route::patch('/student/edit/{id}',[StudentController::class,'edit']);
    Route::delete('/student/delete/{id}',[StudentController::class,'delete']);
    Route::get('/students/view',[StudentController::class,'students']);

    //Group
    Route::post('/group/add',[GroupController::class,'add']);
    Route::patch('/group/edit/{id}',[GroupController::class,'edit']);
    Route::delete('/group/delete/{id}',[GroupController::class,'delete']);
    Route::get('/group/view',[GroupController::class,'view']);
    Route::get('/group/students/{id}',[GroupController::class,'students']);

    //Course
    Route::post('/course/add',[CourseController::class,'add']);
    Route::patch('/course/edit/{id}',[CourseController::class,'edit']);
    Route::delete('/course/delete/{id}',[CourseController::class,'delete']);
    Route::get('/course/view',[CourseController::class,'view']);
    //Schedule
    Route::get('/schedule/view',[ScheduleController::class,'view']);

    //Period
    Route::post('/period/add',[PeriodController::class,'add']);
    Route::patch('/period/edit/{id}',[PeriodController::class,'edit']);
    Route::delete('/period/delete/{id}',[PeriodController::class,'delete']);
    Route::get('/period/view',[PeriodController::class,'view']);

    //Verification
    Route::post('/verification/student',[VerificationController::class,'student']);
    Route::post('/verification/teacher',[VerificationController::class,'teacher']);
    Route::get('/verification/history/students/{id}',[VerificationController::class,'student_history']);
    Route::get('/verification/history/teachers',[VerificationController::class,'teacher_history']);

    //Subject
    Route::post('/subject/add',[SubjectController::class,'add']);
    Route::patch('/subject/edit/{id}',[SubjectController::class,'edit']);
    Route::delete('/subject/delete/{id}',[SubjectController::class,'delete']);
    Route::get('/subject/view',[SubjectController::class,'view']);
});

Route::get('/migrate/fresh', function(){
    Artisan::call('migrate:fresh');
    return "okay";
});