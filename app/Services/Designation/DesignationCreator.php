<?php

namespace App\Services\Designation;

use App\Repositories\Designation\DesignationRepository;

class DesignationCreator
{
    protected $designationRepository;

    public function __construct(DesignationRepository $designationRepository)
    {
        $this->designationRepository =  $designationRepository;
    }

    public function store($data)
    {
        $Designation = $this->designationRepository->create($data);
        return $Designation;
    }
}
