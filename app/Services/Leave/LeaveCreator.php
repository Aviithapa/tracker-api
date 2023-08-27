<?php

namespace App\Services\Leave;

use App\Repositories\Leave\LeaveRepository;

class LeaveCreator
{
    protected $leaveRepository;

    public function __construct(LeaveRepository $userRepository)
    {
        $this->leaveRepository = $userRepository;
    }

    public function store($data)
    {

        $leave = $this->leaveRepository->create($data);
        // dd('leave');
        // Mail::to($user->email)->send(new RegistrarUser($user));
        return $leave;
    }
}
