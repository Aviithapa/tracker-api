<?php

namespace App\Services\Designation;

use App\Repositories\Designation\DesignationRepository;

/**
 * Class DesignationUpdater
 * @package App\Services\Apartment
 */
class DesignationUpdater
{
    /**
     * @var designationRepository
     */
    protected $designationRepository;

    /**
     * DesignationCreator constructor.
     * @param DesignationRepository $designationRepository
     */
    public function __construct(DesignationRepository $designationRepository)
    {
        $this->designationRepository = $designationRepository;
    }

    public function update($data, $id)
    {
        $designation =  $this->designationRepository->findById($id);

        if ($designation) {
            $DesignationUpdate = $this->designationRepository->update($data, $designation->id);
            if ($DesignationUpdate === false) {
                return response()->json(['error' => 'Internal Error'], 500);
            }
            return $designation;
        }
        return response()->json(['error' => 'Not Found'], 404);
    }
}
