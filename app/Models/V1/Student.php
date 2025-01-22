<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'names', 'fisrt', 'second', 'gender', 'age', 'marital_status', 'academic_level', 'email', 'password'
    ];
}

