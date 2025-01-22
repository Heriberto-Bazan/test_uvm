<?php

namespace App\Repositories\V1;

use App\Models\V1\Status;

/**
 * Class AuthRepository.
 */
class StatusRepository
{
    /**
     * @var status
     */
    protected $status;

    /**
     * AuthRepository constructor.
     *
     * @param Status $status
     */
    public function __construct(Status $status)
    {
        $this->status = $status;
    }

    /**
     * Get all status.
     *
     * @return Status $status
     */
    public function getAll()
    {
        return $this->status->get();
    }

}
