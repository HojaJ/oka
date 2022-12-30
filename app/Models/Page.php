<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable  = ['order','section_id', 'image_url'];

    public function units()
    {
        return $this->belongsToMany(Unit::class, 'page_unit');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
