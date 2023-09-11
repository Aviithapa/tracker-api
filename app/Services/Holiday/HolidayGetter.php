<?php

namespace App\Services\Holiday;

use App\Repositories\Holiday\HolidayRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class HolidayGetter
 * @package App\Services\Holiday
 */
class HolidayGetter
{
    /**
     * @var holidayRepository
     */
    protected $holidayRepository;

    /**
     * HolidayGetter constructor.
     * @param HolidayRepository $holidayRepository
     */
    public function __construct(HolidayRepository $holidayRepository)
    {
        $this->holidayRepository = $holidayRepository;
    }

    /**
     * Get paginated apartment list
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getPaginatedList($request): LengthAwarePaginator
    {
        return $this->holidayRepository->getWithPagination($request);
    }

    /**
     * Get a single apartment
     * @param $id
     * @return Object|null
     */
    public function show($id)
    {
        return $this->holidayRepository->findById($id);
    }
}
