<?php

namespace App\Http\Controllers\Api;

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

    /**
     * @OA\Get(
     *    path="/pages/{id}",
     *    operationId="getPageById",
     *    description="/pages/{id}",
     *    tags={"Pages"},
     *    summary="Get page By Id",
     *    @OA\Parameter(
     *          name="id",
     *          description="Page id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *          )
     *       )
     *  )
     */
    public function show(Request $request, Page $page)
    {
        return $this->successResponse([
            'paragraph' => new PageResource($page)
        ]);
    }
}