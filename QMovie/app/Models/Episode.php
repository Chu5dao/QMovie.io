<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['movie_id', 'link', 'episode', 'server', 'date_cr', 'date_up'];
    
    public function movie() {
        return $this->belongsTo(Movie::class);
    }
    public function serverMovie()
    {
        return $this->belongsTo(ServerMovie::class, 'server');
    }
}
