<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class authController extends Controller
{

    /**
     * @OA\Post(
     *     tags={"auth"},
     *     description="Rota para realizar o login e obter a token access",
     *     path="/auth/login",
     *     @OA\RequestBody(
     *            @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               @OA\Property(property="email",type="string"),
     *               @OA\Property(property="password",type="string"),
     *               required={"email", "password"},
     *            )
     *        )
     *      ),
     *    @OA\Response(response="200", description="sucesso, retorno do token de acesso"),
     *    @OA\Response(response="401", description="Erro ao efetuar o login"),
     * )
     */



    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @OA\Post(
     *     tags={"auth"},
     *     description="Sair do login",
     *     path="/auth/logout",
     *    security={{"bearerAuth":{}}},
     *    @OA\Response(response="200", description="Sucesso"),
     * )
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Get the token array structure.
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
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
