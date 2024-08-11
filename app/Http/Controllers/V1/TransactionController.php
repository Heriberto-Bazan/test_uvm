<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\V1\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    /**
     * @var transactionService
     */
    protected $transactionService;


    /**
     * TransactionController Constructor
     *
     * @param TransactionService $transactionService
     *
     */
    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $result['status'] = 200;
            $result['data'] = $this->transactionService->getAll();
        } catch (Exception $e) {

            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $credentials = $request->only('code', 'customer_name', 'identification_documents_id', 'description', 'value', 'slug', 'statuses_id', 'payment_methods_id', 'status_transaction');


        try {

            $result['data'] = $this->transactionService->savePostData($credentials);
            $result['status'] = 200;
        } catch (Exception $e) {

            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Display the specified resource.
     *
     * @param  id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->transactionService->getById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

    /**
     * Display the specified resource.
     *
     * @param  code
     * @return \Illuminate\Http\Response
     */
    public function code($code)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->transactionService->getBycode($code);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

}
