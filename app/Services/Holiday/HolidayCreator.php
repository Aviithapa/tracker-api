<?php

namespace App\Services\Holiday;

use App\Repositories\Holiday\HolidayRepository;

/**
 * Class HolidayCreator
 * @package App\Services\Apartment
 */
class HolidayCreator
{
    /**
     * @var HolidayRepository
     */
    protected $holidayRepository;

    /**
     * HolidayCreator constructor.
     * @param HolidayRepository $holidayRepository
     */
    public function __construct(HolidayRepository $holidayRepository)
    {
        $this->holidayRepository = $holidayRepository;
    }

    public function store($data)
    {

        $holiday = $this->holidayRepository->create($data);
        if ($holiday === false) {
            return response()->json(['error' => 'Internal Error'], 500);
        }
        return $holiday;
    }
}
