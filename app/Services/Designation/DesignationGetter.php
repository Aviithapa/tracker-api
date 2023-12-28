<?php

namespace App\Services\Designation;

use App\Repositories\Designation\DesignationRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class DesignationGetter
 * @package App\Services\Designation
 */
class DesignationGetter
{
    /**
     * @var designationRepository
     */
    protected $designationRepository;

    /**
     * DesignationGetter constructor.
     * @param DesignationRepository $designationRepository
     */
    public function __construct(DesignationRepository $designationRepository)
    {
        $this->designationRepository = $designationRepository;
    }

    /**
     * Get paginated apartment list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList($request): LengthAwarePaginator
    {
        return $this->designationRepository->getPaginatedList($request);
    }

    /**
     * Get a single apartment
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->designationRepository->findById($id);
    }
}
