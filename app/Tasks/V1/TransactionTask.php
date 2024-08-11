<?php

namespace App\Tasks\V1;

use App\Tasks\TaskInterface;
use Closure;

class TransactionTask implements TaskInterface
{
    public function handle($request)
    {
        if ($request['payment_methods_id'] == 1) {

            $percentage = ((float)0.15 * $request['value']);
            $percentage = round($percentage, 0);
            return $request['total_percentage'] = $percentage;
        }

        if ($request['payment_methods_id'] == 2) {

            $percentage = ((float)0.2 * $request['value']);
            $percentage = round($percentage, 0);
            return $request['total_percentage'] = $percentage;
        }

        if ($request['payment_methods_id'] == 3) {

            $percentage = ((float)0.4 * $request['value']);
            $percentage = round($percentage, 0);
            return $request['total_percentage'] = $percentage;
        }
    }

    public function validate($request)
    {
        if ($request['statuses_id'] == 1) {

            $status = 'successful payment';
            return $request['status_transaction'] = $status;
        }

        if ($request['statuses_id'] == 2) {

            $status = 'pending payment';
            return $request['status_transaction'] = $status;
        }

        if ($request['statuses_id'] == 3) {

            $status = 'overdue payment';
            return $request['status_transaction'] = $status;
        }

        if ($request['statuses_id'] == 4) {

            $status = 'failed payment';
            return $request['status_transaction'] = $status;
        }
    }

}
