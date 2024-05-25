<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\ParagraphResource;
use App\Http\Resources\SectionResource;
use App\Models\Paragraph;
use App\Models\Section;
use Illuminate\Http\Request;

class ParagraphController extends ApiBaseController
{
    /**
     * @OA\Get(
     *    path="/paragraphs/{id}",
     *    operationId="getParagraphById",
     *    description="/paragraphs/{id}",
     *    tags={"Paragraphs"},
     *    summary="Get paragraph By Id",
     *     @OA\Parameter(
     *          name="id",
     *          description="Paragraph id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true")
     *          )
     *       )
     *  )
     */
    public function index(Request $request, Paragraph $paragraph)
    {
        try {
            return $this->successResponse([
                'data' => new ParagraphResource($paragraph),
            ]);
        } catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
}