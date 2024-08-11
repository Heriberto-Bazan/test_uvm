<?php

namespace App\Services\V1;

use App\Repositories\V1\TransactionRepository;
use App\Tasks\V1\TransactionTask;
use Exception;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use Closure;

class TransactionService
{
    /**
     * @var $transactionRepository
     */
    protected $transactionRepository;

    /**
     * @var $transactiontask
     */
    protected $transactiontask;

    public function __construct(TransactionRepository $transactionRepository, TransactionTask $transactiontask)
    {
        $this->transactionRepository = $transactionRepository;
        $this->transactiontask = $transactiontask;
    }

    /**
     * Get all transaction.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->transactionRepository->getAll();
    }

     /**
     * Validate transaction data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function savePostData($data)
    {
        $validator = Validator::make($data, [
            'code' => 'required|string|unique:transactions|min:15|max:50',
            'customer_name' => 'required|string',
            'identification_documents_id' => 'required|numeric',
            'description' => 'required|string',
            'value' => 'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'payment_methods_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        $random_transaction = rand(1, 4);
        $data['statuses_id'] = $random_transaction;

        $percentage = $this->transactiontask->handle($data);
        $status_transaction = $this->transactiontask->validate($data);
        $data['total_percentage'] = $percentage;
        $data['status_transaction'] = $status_transaction;
        $result_data = $this->transactionRepository->save($data);
    
        return $result_data;
    }

    /**
     * Get post by code.
     *
     * @param $code
     * @return String
     */
    public function getBycode($code)
    {
        return $this->transactionRepository->getByCode($code);
    }

    /**
     * Get post by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->transactionRepository->getById($id);
    }

}
