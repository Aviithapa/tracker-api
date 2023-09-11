<?php

namespace App\Services\Holiday;

use App\Repositories\Holiday\HolidayRepository;

/**
 * Class HolidayCreator
 * @package App\Services\Apartment
 */
class HolidayUpdater
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

    public function update($data, $id)
    {
        $holiday =  $this->holidayRepository->findById($id);
        if ($holiday) {
            $holidayUpdate = $this->holidayRepository->update($data, $holiday->id);
            if ($holidayUpdate === false) {
                return response()->json(['error' => 'Internal Error'], 500);
            }
            return $holiday;
        }
        return response()->json(['error' => 'Not Found'], 404);
    }
}
