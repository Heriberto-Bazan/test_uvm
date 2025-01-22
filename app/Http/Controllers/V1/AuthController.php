<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use JWTAuth;
use App\Services\V1\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(AuthService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        $this->userService->authenticateData($credentials);

        return response()->json([
            'token' => JWTAuth::attempt($credentials),
            'user' => Auth::user()
        ]);
    }

    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */
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

     /**
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function check()
    {
        return response()->json(auth()->user());
    }


    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }


    /**
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allUser()
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

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $credentials = $request->only('name', 'email', 'password');

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

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUser(Request $request)
    {

        $credentials = $request->only('token');
        $this->userService->validateToken($credentials);

        $user = JWTAuth::authenticate($request->token);

        if (!$user)
            return response()->json([
                'message' => 'Invalid token / token expired',
            ], 401);

        return response()->json(['user' => $user]);
    }
}
