<?php

namespace App\Services\V1;

use App\Repositories\V1\StudentRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class StudentService
{

    /**
     * @var $studentRepository
     */
    protected $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * Validate post data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function saveStudent($data)
    {
        $validator = Validator::make($data, [
            'names' => 'required|string|max:60',
            'fisrt' => 'required|string|max:60',
            'second' => 'required|string|max:60',
            'gender' => 'required|numeric',
            'age' => 'required|numeric',
            'marital_status' => 'required|numeric',
            'academic_level' => 'required|numeric',
            'email' => 'required|email|unique:students',
            'password' => 'required|string|min:6|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        DB::beginTransaction();
        try {

            $result = $this->studentRepository->save($data);
            
        } catch (Exception $e) {

            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Error saving information');
        }
        DB::commit();

        return $result;
    }

}
