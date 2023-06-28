<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = ['name','order','min','max'];

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
}
