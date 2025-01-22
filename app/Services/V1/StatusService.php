<?php

namespace App\Services\V1;

use App\Repositories\V1\StatusRepository;

class StatusService
{

    /**
     * @var $statusRepository
     */
    protected $statusRepository;

    public function __construct(StatusRepository $statusRepository)
    {
        $this->statusRepository = $statusRepository;
    }

    /**
     * Get all status.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->statusRepository->getAll();
    }
}
