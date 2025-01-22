<?php

namespace App\Repositories\V1;

use App\Models\V1\Gender;

/**
 * Class AuthRepository.
 */
class GenderRepository
{
    /**
     * @var gender
     */
    protected $gender;

    /**
     * AuthRepository constructor.
     *
     * @param Gender $gender
     */
    public function __construct(Gender $gender)
    {
        $this->gender = $gender;
    }

    /**
     * Get all gender.
     *
     * @return Gender $gender
     */
    public function getAll()
    {
        return $this->gender->get();
    }

}
