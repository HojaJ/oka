<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
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
            'id'=>$this->id,
            'order' => $this->order,
            'start_unit' => $this->start_unit,
            'start_paragraph'=>$this->start_paragraph,
            'end_unit' => $this->end_unit,
            'end_paragraph' => $this->end_paragraph,
            'image' => $this->image_url,
        ];
    }
}
