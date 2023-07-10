<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UnitResource;
use App\Models\Policy;
use App\Models\Suggest;
use App\Models\Unit;
use Notification;
use App\Models\User;
use App\Notifications\SuggestNotification;
use Illuminate\Http\Request;

class HomeController  extends ApiBaseController
{
    /**
     * @OA\Post(
     *      path="/suggest",
     *      operationId="suggest",
     *      tags={"Suggest"},
     *      summary="Suggest a thing",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"message"},
     *            @OA\Property(property="message", type="string", format="string", example="Test Suggest Title"),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *          )
     *       )
     *  )
     */
    public function store(Request $request)
    {
        try {
            $offerData = Suggest::create($request->all());
            $users = User::get();
            Notification::send($users, new SuggestNotification($offerData));

            return $this->successResponse([]);
        } catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @OA\Get(
     *    path="/policy",
     *    operationId="policy",
     *    tags={"Policy"},
     *    summary="Get policy text",
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *          )
     *       )
     *  )
     */
    public function policy()
    {
        $policy = Policy::where('id', 1)->get();
        return $this->successResponse(['policy' => $policy]);
    }

    /**
     * @OA\Get(
     *    path="/units",
     *    operationId="units",
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
    public function unit()
    {
        try {
            $units = Unit::orderBy('order')->withCount('parags')->get();
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
