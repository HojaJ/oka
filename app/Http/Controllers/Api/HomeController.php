<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PolicyResource;
use App\Http\Resources\SuggestResource;
use App\Models\Policy;
use App\Models\Suggest;
use Notification;
use App\Models\User;
use App\Notifications\SuggestNotification;
use Illuminate\Http\Request;

class HomeController extends ApiBaseController
{
    /**
     * @OA\Post(
     *      path="/suggest",
     *      operationId="suggest",
     *      tags={"Suggest"},
     *      description="/suggest",
     *      summary="Suggest a thing",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="message",
     *                          type="string"
     *                      ),
     *                 ),
     *                 example={
     *                     "message":"Test Suggest Title",
     *                }
     *             )
     *         )
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="object",
     *                  @OA\Property(property="id", type="number", example=1),
     *                  @OA\Property(property="text", type="string", example="Some message"),
     *             )
     *          )
     *       )
     *  )
     */
    public function store(Request $request)
    {
        try {
            $offerData = Suggest::create(['message' => $request->message]);
            $users = User::get();
            Notification::send($users, new SuggestNotification($offerData));
            return $this->successResponse([
                'data' => new SuggestResource($offerData)
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @OA\Get(
     *    path="/policy",
     *    operationId="policy",
     *     description="/policy",
     *    tags={"Policy"},
     *    summary="Get policy text",
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="object",
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="text", type="string", example="bu dine test..."),
     *             )
     *          )
     *       )
     *  )
     */
    public function policy()
    {
        $policy = Policy::first();
        return $this->successResponse([
            'data' => new PolicyResource($policy)
        ]);
    }
}
