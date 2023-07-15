<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UnitResource;
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
            $units = Unit::with('image','pages','parags')->orderBy('order')->first();
            return $this->successResponse([
                'units' => UnitResource::collection($units)
            ]);
        } catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    public function show(Request $request, Unit $unit)
    {
        return $this->successResponse([
            'paragraph' => $unit->parags
        ]);
    }
}