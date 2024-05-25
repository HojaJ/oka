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
            'name' => $this->name,
            'start_page' => $this->start_unit,
            'units' => $this->units()
        ];
    }
}
