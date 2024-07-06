<?php

use App\Http\Controllers\Assigned_ClassController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Users related routes
{
    Route::get('/user', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.index');
    Route::get('/user/teachers', [UserController::class, 'listTeachers'])->middleware(['auth', 'verified'])->name('admin.teacher');
    Route::get('/user/students', [UserController::class, 'listStudents'])->middleware(['auth', 'verified'])->name('admin.student');

    
    Route::get('/user/add', [UserController::class, 'userAddPage'])->middleware(['auth', 'verified'])->name('admin.userAddPage');
    Route::post('/user/added', [UserController::class, 'userAdd'])->middleware(['auth', 'verified'])->name('user.add');
    Route::get('/user/admin/{id}', [UserController::class, 'adminDetail'])->middleware(['auth', 'verified'])->name('admin.userDetails');

    Route::get('/user/{id}', [UserController::class, 'userDetail'])->middleware(['auth', 'verified'])->name('user.userDetails');

    Route::put('/user/{id}/update', [UserController::class, 'userUpdate'])->middleware(['auth', 'verified'])->name('admin.update');
    Route::delete('/user/{id}/delete', [UserController::class, 'userDelete'])->middleware(['auth', 'verified'])->name('admin.delete');
}

// Subjects related routes
{
    Route::get('/subject', [SubjectController::class, 'index'])->middleware(['auth', 'verified'])->name('subject.index');
    Route::post('/subject/add', [SubjectController::class, 'subjectAdd'])->middleware(['auth', 'verified'])->name('subject.add');
    Route::put('/subject/{id}/update', [SubjectController::class, 'subjectUpdate'])->middleware(['auth', 'verified'])->name('subject.update');
    Route::delete('/subject/{id}/delete', [SubjectController::class, 'subjectDelete'])->middleware(['auth', 'verified'])->name('subject.delete');

}

// Classsroom related routes
{
    Route::get('/classroom', [ClassroomController::class, 'index'])->middleware(['auth', 'verified'])->name('classroom.index');
    Route::post('/classroom/add', [ClassroomController::class, 'classroomAdd'])->middleware(['auth', 'verified'])->name('classroom.add');
    Route::put('/classroom/{id}/update', [ClassroomController::class, 'classroomUpdate'])->middleware(['auth', 'verified'])->name('classroom.update');
    Route::delete('/classroom/{id}/delete', [ClassroomController::class, 'classroomDelete'])->middleware(['auth', 'verified'])->name('classroom.delete');

}

// Course related routes
{
    Route::get('/course', [CourseController::class, 'index'])->middleware(['auth', 'verified'])->name('course.index');
    Route::post('/course/add', [CourseController::class, 'courseAdd'])->middleware(['auth', 'verified'])->name('course.add');
    Route::put('/course/{id}/update', [CourseController::class, 'courseUpdate'])->middleware(['auth', 'verified'])->name('course.update');
    Route::delete('/course/{id}/delete', [CourseController::class, 'courseDelete'])->middleware(['auth', 'verified'])->name('course.delete');

}

// Batch related routes
{
    Route::get('/batch', [BatchController::class, 'index'])->middleware(['auth', 'verified'])->name('batch.index');
    Route::post('/batch/add', [BatchController::class, 'batchAdd'])->middleware(['auth', 'verified'])->name('batch.add');
    Route::put('/batch/{id}/update', [BatchController::class, 'batchUpdate'])->middleware(['auth', 'verified'])->name('batch.update');
    Route::delete('/batch/{id}/delete', [BatchController::class, 'batchDelete'])->middleware(['auth', 'verified'])->name('batch.delete');

}

// Schedule related routes
{
    Route::get('/schedule/course/{c_id}', [ScheduleController::class, 'tableCourse'])->middleware(['auth', 'verified'])->name('schedule.tableCourse');
    Route::get('/schedule/teacher/{id}', [ScheduleController::class, 'tableTeacher'])->middleware(['auth', 'verified'])->name('schedule.tableTeacher');
    Route::get('/schedule/course/{c_id}/add', [ScheduleController::class, 'scheduleAddPage'])->middleware(['auth', 'verified'])->name('schedule.addPage');

    Route::post('/schedule/added', [ScheduleController::class, 'scheduleAdd'])->middleware(['auth', 'verified'])->name('schedule.add');
    Route::get('/schedule/{id}/update', [ScheduleController::class, 'scheduleUpdatePage'])->middleware(['auth', 'verified'])->name('schedule.updatePage');
    Route::put('/schedule/{id}/updated', [ScheduleController::class, 'scheduleUpdate'])->middleware(['auth', 'verified'])->name('schedule.update');

    Route::delete('/schedule/delete/{s_id}', [ScheduleController::class, 'scheduleDeletefromCourse'])->middleware(['auth', 'verified'])->name('schedule.delete');

    //Student
    Route::get('/timetable/search',  [ScheduleController::class, 'studentTable'])->middleware(['auth', 'verified'])->name('student.table');
}

// API
{
    Route::get('api/schedule/', [ScheduleController::class, 'getData'])->middleware(['auth', 'verified'])->name('schedule.data');
    Route::get('api/schedule/course/{id}', [ScheduleController::class, 'tableCourseData'])->middleware(['auth', 'verified'])->name('schedule.data');
}
require __DIR__ . '/auth.php';
