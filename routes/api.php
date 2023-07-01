<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Questions\QuestionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Roles\RoleController;
use App\Http\Controllers\Media\MediaController;
use App\Http\Controllers\Area\AreaController;
use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\StudentAttempt\StudentAttemptController;
use App\Http\Controllers\Subject\SubjectController;
use App\Http\Controllers\User\UserController;
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

Route::post('/user/create', [UserController::class, 'create'])->name('users.create');
Route::match(['post', 'get'], '/login', [AuthController::class, 'login'])->name('login');
Route::post('/user/login', [AuthController::class, 'generateToken'])->name('user.login');
Route::post('/area/import', [AreaController::class, 'importArea'])->name('area.importArea');

Route::apiResource('/employee', EmployeeController::class);


Route::middleware(['jwt.user.verify'])->group(
    function () {
        Route::post('/user/attendance', [AttendanceController::class, 'checkInCheckOut'])->name('user.attendance');
        Route::get('/user/attendance/logs', [AttendanceController::class, 'getAttendanceLog'])->name('user.attendance.logs');
    }
);

Route::middleware(['auth:api'])->group(
    function () {
        Route::apiResource('/roles', RoleController::class);
        Route::apiResource('/questions', QuestionsController::class);
        Route::post('/importStudents', [StudentController::class, 'importStudent']);
        Route::apiResource('/subject', SubjectController::class);
        Route::apiResource('/setting', SettingController::class);
        Route::post('/importSubject', [SubjectController::class, 'importSubject']);
        Route::post('/importQuestions', [QuestionsController::class, 'importQuestions']);
        Route::get('/calculateStudentMarks/{studentId}', [StudentController::class, 'calculateStudentMarks']);
        Route::get('/exportStudentsDataToExcel', [StudentController::class, 'exportStudentsToExcel']);
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::post('/auth/password-change', [AuthController::class, 'changePassword']);
    }
);
