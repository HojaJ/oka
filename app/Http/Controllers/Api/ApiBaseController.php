<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;


/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Oka we Owren Api Documentation",
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Api Server"
 * )
 *
 * @OA\PathItem(path="/api")
 */
class ApiBaseController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
    }
}