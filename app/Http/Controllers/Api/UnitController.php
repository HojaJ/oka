<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UnitResource;
use App\Http\Resources\UnitShowResource;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends ApiBaseController
{
    /**
     * @OA\Get(
     *    path="/units",
     *    operationId="units",
     *    description="/units",
     *    tags={"Units"},
     *    summary="Get units",
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *              @OA\Property(property="data",type="array",
     *              @OA\Items(
     *                  @OA\Property(property="id", type="number", example=1),
     *                  @OA\Property(property="order", type="number", example=2),
     *                  @OA\Property(property="name", type="string", example="Unit name"),
     *                  @OA\Property(property="short_name", type="string", example="Short name"),
     *                  @OA\Property(property="paragraph_count", type="number", example=10),
     *                  @OA\Property(property="start_page", type="number|null", example=2),
     *                  @OA\Property(property="image", type="string|null", example=null)
     *                  )
     *             )
     *             )
     *          )
     *       )
     *  )
     */
    public function units()
    {
        try {
            $units = Unit::with('image', 'pages', 'parags')->orderBy('order')->get();

            return $this->successResponse([
                'data' => UnitResource::collection($units)
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }


    /**
     * @OA\Get(
     *    path="/units/{id}",
     *    operationId="getUnitById",
     *    description="/units/{id}",
     *    tags={"Units"},
     *    summary="Get unit By Id",
     *    @OA\Parameter(
     *          name="id",
     *          description="Unit id",
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
     *                  @OA\Property(property="name", type="string", example="Unit name"),
     *                  @OA\Property(property="short_name", type="string", example="Short name"),
     *                  @OA\Property(property="paragraph_count", type="number", example=10),
     *                  @OA\Property(property="image", type="string|null", example=null),
     *                  @OA\Property(property="start_page", type="number|null", example=2),
     *                  @OA\Property(property="paragraphs",type="array",
             *              @OA\Items(
             *                  @OA\Property(property="id", type="number", example=1),
             *                  @OA\Property(property="order", type="number", example=2),
             *                  @OA\Property(property="name", type="string", example="Example"),
             *                  @OA\Property(property="description", type="string", example="Example"),
             *                  @OA\Property(property="translation", type="string", example="Example"),
             *                  @OA\Property(property="audio", type="number|null", example=6),
             *                  @OA\Property(property="on_page", type="number|null", example=2),
             *                  )
             *             )
     *             )
     *          )
     *       )
     *  )
     */
    public function show(Request $request, $id)
    {
        if (Unit::where('id', $id)->exists()) {
            return $this->successResponse([
                'data' => new UnitShowResource(Unit::with('parags')->find($id))
            ]);
        } else{
            return $this->errorResponse('Not Found');
        }
    }
}