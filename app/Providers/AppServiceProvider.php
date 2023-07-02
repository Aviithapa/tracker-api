<?php

namespace App\Providers;

use App\Models\Role;
use App\Repositories\Area\AreaRepository;
use App\Repositories\Area\EloquentAreaRepository;
use App\Repositories\Attendance\AttendanceRepository;
use App\Repositories\Attendance\EloquentAttendanceRepository;
use App\Repositories\AttendanceDetailData\AttendanceDetailDataRepository;
use App\Repositories\AttendanceDetailData\EloquentAttendanceDetailDataRepository;
use App\Repositories\Employee\EloquentEmployeeRepository;
use App\Repositories\Employee\EmployeeRepository;
use App\Repositories\Imei\EloquentImeiRepository;
use App\Repositories\Imei\ImeiRepository;
use App\Repositories\Media\EloquentMediaRepository;
use App\Repositories\Media\MediaRepository;
use App\Repositories\Office\EloquentOfficeRepository;
use App\Repositories\Office\OfficeRepository;
use App\Repositories\Role\EloquentRoleRepository;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Setting\EloquentSettingRepository;
use App\Repositories\Setting\SettingRepository;
use App\Repositories\User\EloquentUserRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $this->app->bind(
            UserRepository::class,
            EloquentUserRepository::class
        );

        $this->app->bind(
            RoleRepository::class,
            EloquentRoleRepository::class
        );


        $this->app->bind(
            SettingRepository::class,
            EloquentSettingRepository::class
        );

        $this->app->bind(
            MediaRepository::class,
            EloquentMediaRepository::class
        );

        $this->app->bind(
            ImeiRepository::class,
            EloquentImeiRepository::class
        );

        $this->app->bind(
            AreaRepository::class,
            EloquentAreaRepository::class
        );
        $this->app->bind(
            AttendanceRepository::class,
            EloquentAttendanceRepository::class
        );

        $this->app->bind(
            EmployeeRepository::class,
            EloquentEmployeeRepository::class
        );

        $this->app->bind(
            OfficeRepository::class,
            EloquentOfficeRepository::class
        );

        $this->app->bind(
            AttendanceDetailDataRepository::class,
            EloquentAttendanceDetailDataRepository::class
        );
    }
}
