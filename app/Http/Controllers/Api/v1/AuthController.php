<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;


class AuthController extends Controller
{

    /**
     *  @OA\Post(
     *      tags={"auth"},
     *      summary="authenticate user by credentials",
     *      description="the user informs their credentials with email and password to get the access token",
     *      path="/login",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="password", type="string"),
     *          )
     *     ),
     *     @OA\Response(
     *          response="200", description="Get Token JWT"
     *     )
     * )
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }


    /**
     *  @OA\Post(
     *      tags={"auth"},
     *      summary="revoke user token",
     *      description="authenticated user request to revoke token",
     *      path="/logout",
     *      security={{"bearerAuth": {}}},
     *      @OA\Response(
     *          response="200", description="Logged out"
     *      ),
     *      @OA\Response(
     *          response="401", description="You are not authorize"
     *      )
     * )
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    private function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ]);
    }
}
