<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Services\V1\StatusService;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    protected $statusService;

    public function __construct(StatusService $statusService)
    {
        $this->statusService = $statusService;
    }


     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allStatus()
    {

        try {
            $result['status'] = 200;
            $result['data'] = $this->statusService->getAll();
        } catch (Exception $e) {

            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

}
