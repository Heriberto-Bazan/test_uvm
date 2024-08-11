<?php

namespace App\Services\V1;

use App\Repositories\V1\AuthRepository;
use Exception;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class AuthService
{

    /**
     * @var $userRepository
     */
    protected $userRepository;

    public function __construct(AuthRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get all post.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->userRepository->getAll();
    }

    /**
     * Validate post data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function savePostData($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'balance' => 'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'password' => 'required|string|min:6|max:50',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        DB::beginTransaction();

        try {

            $result = $this->userRepository->save($data);
            
        } catch (Exception $e) {

            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Error saving information');
        }

        DB::commit();
        return $result;
    }


    /**
     * Validate post data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function authenticateData($data)
    {

        $validator = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        try {

            if (!$token = JWTAuth::attempt($data)) {
                return response()->json([
                    'message' => 'Login failed',
                ], 401);
            }
        } catch (JWTException $e) {

            return response()->json([
                'message' => 'Error',
            ], 500);
        }
    }

    /**
     * Validate post data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function validateToken($data)
    {

        $validator = Validator::make($data, [
            'token' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }
    }

     /**
     * Get post by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->postRepository->getById($id);
    }

    /**
     * Update post data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function transactionProvider($data, $id)
    {
    
        $validator = Validator::make($data, [
            'gain' => 'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            
            $post = $this->userRepository->update($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update transaction data');
        }

        DB::commit();

        return $post;

    }
}
