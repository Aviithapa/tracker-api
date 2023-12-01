<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Area\AreaController;
use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Holiday\HolidayController;
use App\Http\Controllers\Leave\LeaveController;
use App\Http\Controllers\Office\OfficeController;
use App\Http\Controllers\Roles\RoleController;
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

Route::get('/', function () {
    return response()->json([
        'name' => 'HrMaps',
        'version' => '1.0'
    ]);
});


Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/user/login', [AuthController::class, 'generateToken'])->name('user.login');

Route::middleware(['jwt.user.verify'])->group(
    function () {
        Route::post('/user/attendance', [AttendanceController::class, 'checkInCheckOut'])->name('user.attendance');
        Route::get('/user/attendance/logs', [AttendanceController::class, 'getAttendanceLog'])->name('user.attendance.logs');
        Route::get('/employee/leave', [LeaveController::class, 'getLeaveByEmployeeId'])->name('employee.leave.index');
        Route::get('/leave/type', [LeaveController::class, 'getLeaveType'])->name('employee.leave.type');
        Route::post('/employee/apply/leave', [LeaveController::class, 'EmployeeLeaveApply'])->name('employee.leave.apply');
        Route::get('/employee/attendance/details', [AttendanceController::class, 'OfficeList'])->name('office.attandance.list');
    }
);

Route::middleware(['auth:api'])->group(
    function () {
        Route::post('/employee/attendance', [AttendanceController::class, 'checkInCheckOut'])->name('employee.attendance');
        Route::apiResource('/employee', EmployeeController::class);
        Route::apiResource('/roles', RoleController::class);
        Route::apiResource('/users', UserController::class);
        Route::apiResource('/office', OfficeController::class);
        Route::apiResource('/leave', LeaveController::class);
        Route::apiResource('/holiday', HolidayController::class);
        Route::get('/attendance', [AttendanceController::class, 'getEmployeeAttendance'])->name('attendance');
        Route::post('/attendance/new', [AttendanceController::class, 'newAttendanceByAdmin'])->name('newAttendanceByAdmin');
        Route::patch('/attendance', [AttendanceController::class, 'deleteEmployeeAttendanceForDate'])->name('deleteEmployeeAttendanceForDate');
        Route::post('/area/import', [AreaController::class, 'importArea'])->name('area.importArea');
        Route::put('/assign/role/{role}/{user_id}', [UserController::class, 'assignRole'])->name('user.assign.role');
        Route::post('/user/create', [UserController::class, 'create'])->name('users.create');
    }
);

Route::post('/user/getAttendanceLogOfUser', [AttendanceController::class, 'getAttendanceLogOfUser'])->name('user.getAttendanceLogOfUser');
