<?php

namespace App\Services\Imei;

use App\Repositories\Imei\ImeiRepository;

class ImeiCreator
{
    protected $imeiRepository;

    public function __construct(ImeiRepository $imeiRepository)
    {
        $this->imeiRepository = $imeiRepository;
    }

    public function store($data)
    {
        return $this->imeiRepository->create($data);
    }
}
