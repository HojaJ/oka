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
     *    path="/paragraphs",
     *    operationId="paragraphs",
     *    description="/paragraphs",
     *    tags={"Paragraphs"},
     *    summary="Get paragraphs",
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
            $sections = Paragraph::paginate(20);

            return $this->successResponse([
                'data' => ParagraphResource::collection($sections),
                'pagination' => [
                    'total' => $sections->total(),
                    'count' => $sections->count(),
                    'per_page' => $sections->perPage(),
                    'current_page' => $sections->currentPage(),
                    'total_pages' => $sections->lastPage()
                ],
            ]);
        } catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
}