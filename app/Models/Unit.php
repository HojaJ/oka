<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = ['name','order', 'short_name','paragraph_count','image_id','section_id'];
    protected $appends = ['start_page'];

    public function image() {
        return $this->hasOne(Image::class,'id','image_id');
    }

    public function getStartPageAttribute(){
        return $this->page_start()?->id;
    }

    public function page_start()
    {
        return Page::where('start_unit', $this->id)->first();
    }

    public function parags()
    {
        return $this->hasMany(Paragraph::class)->orderBy('order');
    }

    public function pages()
    {
        return $this->belongsToMany(Page::class, 'page_unit');
    }

    public function min_id(){
        return $this->pages->min('id');
    }

    public function max_id(){
        return $this->pages->max('id');
    }
}
