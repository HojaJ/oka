<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = ['name','order','min','max','start_unit','start_paragraph','end_unit','end_paragraph'];

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function min_id(){
        return $this->pages->min('id');
    }

    public function max_id(){
        return $this->pages->max('id');
    }

    public function startunit()
    {
        return $this->belongsTo(Unit::class,'start_unit', 'order');
    }

    public function endunit()
    {
        return $this->belongsTo(Unit::class,'end_unit', 'order');
    }

    public function units()
    {
        return Unit::select('id', 'name', 'order', 'short_name', 'paragraph_count')->whereBetween('order', [$this->start_unit,$this->end_unit ])->orderBy('order')->get();
    }
}
