<?php

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Admin
Route::post('/add_teacher',[AdminController::class,'add']);
Route::post('/edit_teacher',[AdminController::class,'edit']);
Route::get('/delete_teacher/{id}',[AdminController::class,'delete']);

Route::post('/add_group',[AdminController::class,'add_group']);
Route::post('/add_course',[AdminController::class,'add_course']);

//Student
Route::post('/add_student',[StudentController::class,'add']);
Route::post('/edit_student',[StudentController::class,'edit']);

//Schedule
Route::get('/schedule/view',[TeacherController::class,'schedule']);