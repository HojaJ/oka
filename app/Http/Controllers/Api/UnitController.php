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
     *          )
     *       )
     *  )
     */
    public function units()
    {
        try {
            $units = Unit::with('image', 'pages', 'parags')->orderBy('order')->get();

            return $this->successResponse([
                'units' => UnitResource::collection($units)
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
     *          )
     *       )
     *  )
     */
    public function show(Request $request, Unit $unit)
    {
        $unit->load('parags');
        return $this->successResponse([
            'paragraph' => new UnitShowResource($unit)
        ]);
    }
}