<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\ParagraphResource;
use App\Http\Resources\PageResource;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends ApiBaseController
{
    /**
     * @OA\Get(
     *    path="/pages",
     *    operationId="pages",
     *    description="/pages",
     *    tags={"Pages"},
     *    summary="Get pages",
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true")
     *          )
     *       )
     *  )
     */
    public function index(Request $request)
    {
        try {
            $pages = Page::orderBy('order')->get();

            return $this->successResponse([
                'data' => PageResource::collection($pages),
            ]);
        } catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
}