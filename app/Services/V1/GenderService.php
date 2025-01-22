<?php

namespace App\Services\V1;

use App\Repositories\V1\GenderRepository;


class GenderService
{

    /**
     * @var $genderRepository
     */
    protected $genderRepository;

    public function __construct(GenderRepository $genderRepository)
    {
        $this->genderRepository = $genderRepository;
    }

    /**
     * Get all gender.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->genderRepository->getAll();
    }
}
