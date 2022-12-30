<?php

namespace App\Http\Resources;

use App\Models\Page;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
{

    public function toArray($request)
    {
        $page_starts = $this->pages->min('id');
        $page =  Page::where('id', $page_starts)->first();
        return [
            'id' => $this->id,
            'order' => $this->order,
            'page_starts' => $page_starts,
            'section' => $page->section?->order,
            'name' => $this->name,
            'short_name' => $this->short_name,
            'paragraph_count' => $this->paragraph_count,
            'image_id' => (is_null($this->image_id) ? false :  $this->image->url)
        ];
    }
}
