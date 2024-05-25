<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;


/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Terjime Kitap API Endpoints",
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="API Endpoints"
 * )
 *
 * @OA\PathItem(path="/api")
 *
 *
 * @OA\Tag(
 *   name="Home",
 *   description="Get sections of book"
 * ),
 *
 * @OA\Tag(
 *   name="Units",
 *   description="Get units of book"
 * ),
 *
 * @OA\Tag(
 *   name="Paragraphs",
 *   description="Get Paragraphs of book By Id"
 * ),
 *
 *  @OA\Tag(
 *   name="Pages",
 *   description="Get Page Images"
 * ),
 */
class ApiBaseController extends Controller
{
    use ApiResponse;

    public function __construct()
    {
    }
}