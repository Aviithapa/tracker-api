<?php

namespace App\Services\Area;

use App\Repositories\Area\AreaRepository;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * Class AreaImports
 * @package App\Services\Apartment
 */
class AreaImport
{
    /**
     * @var AreaRepository
     */
    protected $areaRepository;

    /**
     * AreaImport constructor.
     * @param AreaRepository $areaRepository
     */
    public function __construct(AreaRepository $areaRepository)
    {
        $this->areaRepository = $areaRepository;
    }

    public function importArea($data)
    {
        // Get the file path
        $file = $data['file'];
        $officeId = $data['office_id'];
        $filePath = $file->store('temp');

        // Load the Excel file
        $spreadsheet = IOFactory::load(storage_path('app/' . $filePath));
        $worksheet = $spreadsheet->getActiveSheet();

        // Loop through the rows
        foreach ($worksheet->getRowIterator() as $row) {
            // Skip the header row
            if ($row->getRowIndex() == 1) {
                continue;
            }

            // Get the question data
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // Loop through all cells, even empty ones
            $cellValues = [];
            foreach ($cellIterator as $cell) {
                $cellValues[] = $cell->getValue();
            }
            $latitude = $cellValues[0];
            $longitude = $cellValues[1];

            $areaData['latitude'] = $latitude;
            $areaData['longitude'] = $longitude;
            $areaData['office_id'] = $officeId;
            // Create the area
            $area = $this->areaRepository->create($areaData);
        }

        // Delete the temporary file
        Storage::delete($filePath);

        // Redirect back with success message
        return $area;
    }
}
