<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ParagraphResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'unit_index' => $this->order,
            'unit_id' => $this->unit_id,
            'name' => $this->name,
            'description' => $this->explanation,
            'translation' => $this->translation,
            'audio' => asset($this->audio)
        ];
    }
}
