<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;


/**
 * @OA\Info(
 *    title="World Tiles App Backend API",
 *    version="1.0.0",
 * )
 */
class ApiBaseController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
    }
}