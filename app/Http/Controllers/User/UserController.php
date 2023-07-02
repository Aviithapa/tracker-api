<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiResponser;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Models\Role;
use App\Repositories\User\UserRepository;
use App\Services\Employee\EmployeeCreator;
use App\Services\User\UserGetter;
use App\Services\User\UserCreator;
use App\Services\User\UserUpdater;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    use ApiResponser;

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(UserGetter $userGetter)
    {
        return UserResource::collection($userGetter->getPaginatedList());
    }

    public function store(UserCreateRequest $request, UserCreator $userCreator, EmployeeCreator $employeeCreator): JsonResponse
    {
        $data = $request->all();
        dd($data);
        $existingUser = $this->userRepository->findByFirst('email', $data['email'], '=');
        if ($existingUser) {
            return response()->json(['error' => 'Duplicate Entry'], 500);
        }
        if (!isset($data['password'])) {
            $data['password'] = str_pad(rand(1, 99999999), 8, '0', STR_PAD_LEFT);
        }
        $data['password'] = bcrypt($data['password']);
        $data['remember_token'] = $data['password'];
        $data['userId'] = str_pad(rand(1, 99999999), 8, '0', STR_PAD_LEFT);

        dd($data);
        $employee = $employeeCreator->store($data);
        if ($employee === false) {
            return response()->json(['error' => 'Internal Error'], 500);
        }

        $data['employee_id'] = $employee['id'];

        return $this->successResponse(
            UserResource::make($userCreator->store($data)),
            __('User created successfully'),
            Response::HTTP_CREATED
        );
    }

    public function create(UserCreateRequest $request, UserCreator $userCreator, EmployeeCreator $employeeCreator): JsonResponse
    {
        $data = $request->all();
        $existingUser = $this->userRepository->findByFirst('email', $data['email'], '=');
        if ($existingUser) {
            return response()->json(['error' => 'Duplicate Entry'], 500);
        }
        if (!isset($data['password'])) {
            $data['password'] = str_pad(rand(1, 99999999), 8, '0', STR_PAD_LEFT);
        }
        $data['remember_token'] = $data['password'];
        $data['password'] = bcrypt($data['password']);
        $data['userId'] = generateRandomUsername(10);

        DB::beginTransaction();

        try {
            $employee = $employeeCreator->store($data);
            if ($employee === false) {
                DB::rollBack();
                return response()->json(['error' => 'Internal Error'], 500);
            }

            $data['employee_id'] = $employee->id;

            $user = $userCreator->store($data);

            DB::commit();

            return $this->successResponse(
                UserResource::make($user),
                __('User created successfully'),
                Response::HTTP_CREATED
            );
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function assignRole($role, $id)
    {
        $role = Role::where('name', $role)->first();
        $user = $this->userRepository->findById($id);
        if ($user->roles->isEmpty()) {
            // If the user has no roles, attach the desired role
            $user->roles()->attach($role);
        } else {
            // If the user already has a role, update it to the desired role
            $user->roles()->sync([$role->id]);
        }
        return $user;
    }

    public function show(UserGetter $userGetter, $id)
    {
        return $userGetter->show($id);
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



    public function UserRegistration(UserCreateRequest $request, UserCreator $userCreator): JsonResponse
    {
        $data = $request->all();
        dd($data);
        if (!isset($data['password'])) {
            $data['password'] = str_pad(rand(1, 99999999), 8, '0', STR_PAD_LEFT);
        }
        $data['password'] = bcrypt($data['password']);
        $data['remember_token'] = $data['password'];
        return $this->successResponse(
            UserResource::make($userCreator->store($data)),
            __('User created successfully'),
            Response::HTTP_CREATED
        );
    }
}
