<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Services\V1\LevelService;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    protected $levelService;

    public function __construct(LevelService $levelService)
    {
        $this->levelService = $levelService;
    }

     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allLevel()
    {

        try {
            $result['status'] = 200;
            $result['data'] = $this->levelService->getAll();
        } catch (Exception $e) {

            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}
