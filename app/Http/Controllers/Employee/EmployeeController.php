<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiResponser;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\Employee\EmployeeResource;
use App\Http\Resources\User\UserResource;
use App\Services\Employee\EmployeeGetter;
use App\Services\User\UserCreator;
use App\Services\User\UserUpdater;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    use ApiResponser;

    private $employeeGetter;
    public function __construct(EmployeeGetter $employeeGetter)
    {
        $this->employeeGetter = $employeeGetter;
    }

    public function index(Request  $request, EmployeeGetter $employeeGetter)
    {
        return EmployeeResource::collection($employeeGetter->getPaginatedList($request));
    }

    public function show(EmployeeGetter $employeeGetter, $id)
    {
        return $employeeGetter->show($id);
    }

    public function destroy(UserUpdater $userUpdater, $id)
    {
        return $userUpdater->delete($id);
    }

    public function update(UserUpdateRequest $userUpdateRequest,  UserUpdater $userUpdater, $id)
    {
        $data = $userUpdateRequest->all();
        $data['password'] = bcrypt($data['password']);
        return $this->successResponse(
            UserResource::make($userUpdater->update($data, $id)),
            __('User updated successfully'),
            Response::HTTP_CREATED
        );
    }

    public function myDetails()
    {
        $id = Auth::user()->employee_id;
        return $this->employeeGetter->show($id);
    }
}
