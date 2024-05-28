<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\ParagraphResource;
use App\Models\Paragraph;
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
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data",type="object",
     *                  @OA\Property(property="id", type="number", example=1),
     *                  @OA\Property(property="order", type="number", example=2),
     *                  @OA\Property(property="name", type="string", example="text"),
     *                  @OA\Property(property="description", type="string", example="text"),
     *                  @OA\Property(property="translation", type="string", example="text"),
     *                  @OA\Property(property="audio", type="string", example="audios\/K9fChbdiv3IaZZN.mp3"),
     *                  @OA\Property(property="on_page", type="number|null", example="3")
     *             )
     *          )
     *       )
     *  )
     */
    public function index(Request $request, $id)
    {
        if (Paragraph::where('id', $id)->exists()) {
            return $this->successResponse([
                'data' => new ParagraphResource(Paragraph::find($id)),
            ]);
        } else{
            return $this->errorResponse('Not Found');
        }
    }
}