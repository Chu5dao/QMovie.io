<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    public function movie(){
        return $this->hasMany(Movie::class)->orderBy('id', 'DESC');
    }
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_category', 'category_id', 'movie_id');
    }
}
