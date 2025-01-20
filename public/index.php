<?php

require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../app/helpers/Utils.php';
session_start();

$router = new Router();
Route::setRouter($router);

//Auth routes
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showSignUp']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/', [AuthController::class, 'visitor']);

if(isStudent()) {
    //Student routes
    Route::get('/student', [StudentController::class, 'index']);
    Route::get('/courses/view/{id}', [StudentController::class, 'view']);
    Route::get('/courses/{id}/enroll', [StudentController::class, 'enroll']);
    Route::get('/enrolled', [StudentController::class, 'enrolled']);
}

if(isTeacher()) {
    //Teacher routes
    Route::get('/teacher', [TeacherController::class, 'index']);
    Route::get('/courses/view/{id}', [StudentController::class, 'view']);
    
    // Course management routes - implemented from abstract CourseController
    Route::get('/teacher/courses/create', [CourseController::class, 'showCreate']);
    Route::post('/teacher/courses/create', [CourseController::class, 'create']); // Handle form submission
    Route::get('/teacher/courses/edit/{id}', [CourseController::class, 'showUpdate']); // Show edit form
    Route::post('/teacher/courses/edit/{id}', [CourseController::class, 'update']); // Handle edit submission
    Route::delete('/teacher/courses/delete/{id}', [CourseController::class, 'delete']); // Handle course deletion
    Route::get('/teacher/courses', [CourseController::class, 'index']);
    Route::get('/course/{id}/enrolled-students', [CourseController::class, 'getEnrolledStudents']); // Get enrolled students
    
    // Statistics routes
    Route::get('/teacher/statistics', [StatisticsController::class, 'index']);
}

if(isAdmin()) {
    // Admin Dashboard
    Route::get('/admin', [AdminController::class, 'dashboard']);
    Route::get('/courses/view/{id}', [StudentController::class, 'view']);
    Route::delete('/admin/courses/delete/{id}', [CourseController::class, 'delete']);
    
    Route::get('/admin/pending-teachers', [AdminController::class, 'pendingTeachers']);
    Route::post('/admin/validate-teacher', [AdminController::class, 'validateTeacher']);
    Route::post('/admin/update-teacher-status', [AdminController::class, 'updateTeacherStatus']);
   
    Route::post('/admin/update-user-status', [AdminController::class, 'updateUserStatus']);
    Route::post('/admin/delete-user', [AdminController::class, 'deleteUser']);
    
    Route::get('/admin/courses', [AdminController::class, 'courses']);
    Route::get('/admin/manage-categories', [AdminController::class, 'manageCategories']);
    
    Route::post('/admin/categories/add', [AdminController::class, 'addCategory']);
    Route::post('/admin/categories/delete/{id}', [AdminController::class, 'deleteCategory']);
    
    Route::post('/admin/tags/add', [AdminController::class, 'addTag']);
    Route::post('/admin/tags/delete/{id}', [AdminController::class, 'deleteTag']);
    
    Route::get('/admin/statistics', [AdminController::class, 'statistics']);
}

$router->run($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

?>