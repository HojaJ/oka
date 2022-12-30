<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paragraph extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'explanation', 'translation','audio','unit_id','page_id'];

    public function unit(){
        return $this->belongsTo(Unit::class);
    }
}
