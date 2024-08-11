<?php

namespace App\Repositories\V1;

use App\Models\V1\Transaction;

/**
 * Class TransactionRepository.
 */
class TransactionRepository 
{
    /**
     * @var Transaction
     */
    protected $transaction;

    /**
     * AuthRepository constructor.
     *
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

     /**
     * Get all transactions.
     *
     * @return Transaction $transaction
     */
    public function getAll()
    {
        return $this->transaction->get();
    }

   /**
     * Save Transaction
     *
     * @param $data
     * @return Transaction
     */
    public function save($data)
    {
        
        $transaction = new $this->transaction;
        $transaction->code = $data['code'];
        $transaction->customer_name = $data['customer_name'];
        $transaction->identification_documents_id = $data['identification_documents_id'];
        $transaction->description = $data['description'];
        $transaction->value = $data['value'];
        $transaction->slug = $data['slug'];
        $transaction->statuses_id = $data['statuses_id'];
        $transaction->payment_methods_id = $data['payment_methods_id'];
        $transaction->payment_date = date("d-m-Y H:i:s");
        $transaction->status_transaction = $data['status_transaction'];
        $transaction->total_percentage = $data['total_percentage'];

        $transaction->save();
        return $transaction->fresh();
    }

    /**
     * Get post by code
     *
     * @param $code
     * @return mixed
     */
    public function getByCode($code)
    {
        return $this->transaction
            ->where('code', $code)
            ->get();
    }

    /**
     * Get post by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($code)
    {
        return $this->transaction
            ->where('id', $code)
            ->get();
    }
}
