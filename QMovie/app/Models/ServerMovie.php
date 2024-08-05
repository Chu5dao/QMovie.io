<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerMovie extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'server_movie';
    protected $fillable = ['title', 'description', 'status'];
    public function episodes()
    {
        return $this->hasMany(Episode::class, 'server');
    }
}
