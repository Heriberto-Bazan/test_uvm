<?php

namespace App\Services\V1;

use App\Repositories\V1\LevelRepository;


class LevelService
{

    /**
     * @var $levelRepository
     */
    protected $levelRepository;

    public function __construct(LevelRepository $levelRepository)
    {
        $this->levelRepository = $levelRepository;
    }

    /**
     * Get all level.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->levelRepository->getAll();
    }
}
