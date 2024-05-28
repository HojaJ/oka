<?php

namespace App\Http\Resources;

use App\Http\Resources\Api\ParagraphResource;
use App\Models\Page;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitShowResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order' => $this->order,
            'name' => $this->name,
            'short_name' => $this->short_name,
            'paragraph_count' => $this->paragraph_count,
            'image' => (is_null($this->image_id) ? null :  $this->image->url),
            'start_page' => $this->start_page,
            'paragraphs' => ParagraphResource::collection($this->parags)
        ];
    }
}
