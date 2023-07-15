<?php

namespace App\Http\Resources;

use App\Models\Page;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'order' => $this->order,
            'start_page' => $this->min,
            'end_page' => $this->max
        ];
    }
}
