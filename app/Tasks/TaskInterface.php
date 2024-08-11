<?php

namespace App\Tasks;

interface TaskInterface
{
    public function handle($request);
}