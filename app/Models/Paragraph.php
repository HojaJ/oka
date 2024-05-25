<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paragraph extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'explanation', 'translation','audio','unit_id','page_id','order'];
    protected $appends = ['on_page'];

    public function getOnPageAttribute(){
        return $this->on_page()?->id;
    }

    public function on_page()
    {
        return Page::where('start_unit', $this->unit_id)
            ->where('start_paragraph', '<=', $this->order)
            ->where('end_paragraph', '>=', $this->order)
            ->first();
    }

    public function unit(){
        return $this->belongsTo(Unit::class);
    }
}
