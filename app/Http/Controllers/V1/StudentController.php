<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Services\V1\StudentService;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $data = $request->only('names', 'fisrt', 'second', 'gender', 'age', 'marital_status', 'academic_level', 'email', 'password');
        
        try {

            $result['data'] = $this->studentService->saveStudent($data);
            $result['status'] = 200;
            
        } catch (Exception $e) {

            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }


}
