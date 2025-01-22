<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Services\V1\GenderService;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    protected $genderService;

    public function __construct(GenderService $genderService)
    {
        $this->genderService = $genderService;
    }

     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allGender()
    {

        try {
            $result['status'] = 200;
            $result['data'] = $this->genderService->getAll();
        } catch (Exception $e) {

            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

}
