<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends ApiBaseController
{
    /**
     * @OA\Get(
     *    path="/home",
     *    operationId="sections",
     *    description="/home",
     *    tags={"Home"},
     *    summary="Get Home api",
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="object",
     *                  @OA\Property(property="id", type="number", example=1),
     *                  @OA\Property(property="order", type="number", example=1),
     *                  @OA\Property(property="name", type="string", example="Section name"),
     *                  @OA\Property(property="start_page", type="number|null", example=2),
     *                  @OA\Property(property="units",type="array",
     *              @OA\Items(
     *                  @OA\Property(property="id", type="number", example=1),
     *                  @OA\Property(property="order", type="number", example=2),
     *                  @OA\Property(property="name", type="string", example="Example"),
     *                  @OA\Property(property="short_name", type="string", example="Example"),
     *                  @OA\Property(property="paragraph_count", type="number|null", example=6),
     *                  @OA\Property(property="start_page", type="number|null", example=2),
     *                  )
     *              )
     *             )
     *
     *          )
     *       )
     *  )
     */
    public function index(Request $request)
    {
        try {
            $sections = Section::orderBy('order')->get();
            return $this->successResponse([
                'data' => SectionResource::collection($sections)
            ]);
        } catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
}