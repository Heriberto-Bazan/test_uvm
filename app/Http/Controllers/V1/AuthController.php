<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use JWTAuth;
use App\Models\V1\User;
use App\Services\V1\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $userService;
    
    public function __construct(AuthService $userService) {
        $this->userService = $userService;
    }

    public function index()
    {
    
        try {
            $result['status'] = 200;
            $result['data'] = $this->userService->getAll();
        

        } catch (Exception $e) {

            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function register(Request $request)
    {

        $credentials = $request->only('name', 'email', 'password', 'balance');

        try {

            $result['data'] = $this->userService->savePostData($credentials);
            $result['token'] =  JWTAuth::attempt($credentials);
            $result['status'] = 200;

        } catch (Exception $e) {

            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function authenticate(Request $request)
    {
    
        $credentials = $request->only('email', 'password');
    
        $this->userService->authenticateData($credentials);
       
        return response()->json([
            'token' => JWTAuth::attempt($credentials),
            'user' => Auth::user()
        ]);
    }

    public function logout(Request $request)
    {
        $credentials = $request->only('token');
        $this->userService->validateToken($credentials);

        try {
            
            JWTAuth::invalidate($request->token);
            return response()->json([
                'success' => true,
                'message' => 'User disconnected'
            ]);
        } catch (JWTException $exception) {
        
            return response()->json([
                'success' => false,
                'message' => 'Error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getUser(Request $request)
    {
        
        $credentials = $request->only('token');
        $this->userService->validateToken($credentials);
        
        $user = JWTAuth::authenticate($request->token);
        
        if(!$user)
            return response()->json([
                'message' => 'Invalid token / token expired',
            ], 401);
       
        return response()->json(['user' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only('gain');

        $result = ['status' => 200];

        try {
            $result['data'] = $this->userService->transactionProvider($data, $id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }
    

    
}
