<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PageResource;
use App\Models\Page;
use App\Models\Version;
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
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data",type="array",
     *              @OA\Items(
     *                  @OA\Property(property="id", type="number", example=1),
     *                  @OA\Property(property="order", type="number", example=2),
     *                  @OA\Property(property="start_unit", type="number|null", example=5),
     *                  @OA\Property(property="start_paragraph", type="number|null", example=3),
     *                  @OA\Property(property="end_unit", type="number|null", example=4),
     *                  @OA\Property(property="end_paragraph", type="number|null", example=6),
     *                  @OA\Property(property="image", type="string|null", example="pages/8ZsZewgoBc42Zkd.JPG"),
     *                  )
     *             )
     *          )
     *      )
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
     *             @OA\Property(property="data", type="object",
     *                  @OA\Property(property="id", type="number", example=1),
     *                  @OA\Property(property="order", type="number", example=2),
     *                  @OA\Property(property="start_unit", type="number|null", example=5),
     *                  @OA\Property(property="start_paragraph", type="number|null", example=3),
     *                  @OA\Property(property="end_unit", type="number|null", example=4),
     *                  @OA\Property(property="end_paragraph", type="number|null", example=6),
     *                  @OA\Property(property="image", type="string|null", example="pages/8ZsZewgoBc42Zkd.JPG"),
     *             )
     *          )
     *       )
     *  )
     */
    public function show(Request $request, $id)
    {
        if (Page::where('id', $id)->exists()) {
            return $this->successResponse([
                'data' => new PageResource(Page::find($id))
            ]);
        } else{
            return $this->errorResponse('Not Found');
        }
    }

    /**
     * @OA\Get(
     *    path="/version",
     *    operationId="Version",
     *    description="/version",
     *    tags={"Version"},
     *    summary="Version",
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *          )
     *      )
     *  )
     */
    public function version()
    {
        try {
            $version = Version::first();

            return $this->successResponse([
                'data' => $version->data ?? [],
            ]);
        } catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
}