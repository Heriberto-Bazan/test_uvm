<?php

namespace App\Repositories\V1;

use App\Models\V1\Level;

/**
 * Class LevelRepository.
 */
class LevelRepository
{
    /**
     * @var gender
     */
    protected $level;

    /**
     * AuthRepository constructor.
     *
     * @param Level $level
     */
    public function __construct(Level $level)
    {
        $this->level = $level;
    }

    /**
     * Get all level.
     *
     * @return Level $level
     */
    public function getAll()
    {
        return $this->level->get();
    }

}
