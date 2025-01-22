<?php

namespace App\Repositories\V1;

use App\Models\V1\Student;

/**
 * Class StudentRepository.
 */
class StudentRepository
{
    /**
     * @var student
     */
    protected $student;

    /**
     * StudentRepository constructor.
     *
     * @param Student $student
     */
    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    /**
     * Get all student.
     *
     * @return Student $student
     */
    public function getAll()
    {
        return $this->student->get();
    }

    /**
     * Save Student
     *
     * @param $data
     * @return Student
     */
    public function save($data)
    {
        $student = new $this->student;

        $student->names = $data['names'];
        $student->fisrt = $data['fisrt'];
        $student->second = $data['second'];
        $student->gender = $data['gender'];
        $student->age = $data['age'];
        $student->marital_status = $data['marital_status'];
        $student->academic_level = $data['academic_level'];
        $student->email = $data['email'];
        $student->password = bcrypt($data['password']);

        $student->save();
        return $student->fresh();
    }

}
