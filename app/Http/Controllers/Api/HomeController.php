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

    public function policy()
    {
        $policy = Policy::where('id', 1)->get();
        return $this->successResponse(['policy' => $policy]);
    }

    public function unit()
    {
        try {
            $units = Unit::orderBy('order')->get();

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
