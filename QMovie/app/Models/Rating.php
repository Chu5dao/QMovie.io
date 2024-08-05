<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'rating';
    protected $fillable = [
        'movie_id', 'rating', 'ip_address'
    ];
    
    public function movie() {
        return $this->belongsTo(Movie::class);
    }
}
