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
     *             @OA\Property(property="success", type="boolean", example="true")
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