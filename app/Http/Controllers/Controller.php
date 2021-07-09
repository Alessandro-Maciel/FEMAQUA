<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/**
 * @OA\server(url="http://localhost:3000/api"),
 * @OA\Info(title="Tools API", version="0.0.1",description="A api é um simples repositório para gerenciar ferramentas"),
 * @OA\SecurityScheme(
 *  securityScheme="bearerAuth",
 *   type="http",
 *    scheme="bearer"
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
