<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'title', 'name_eng', 'description', 'tags', 'duration', 'hot', 'resolution', 'trailer', 'subtitled', 'status', 'category_id', 'country_id', 'slug', 'date_cr', 'date_up', 'year', 'image', 'ep_number', 'views'
    ];
    
    public function movie_genre(){
        return $this-> belongsToMany(Genre::class, 'movie_genre', 'movie_id', 'genre_id');
    }
    // Định nghĩa quan hệ one-to-many với Episode
    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($movie) {
            $movie->genres()->detach();
            $movie->episodes()->delete(); // Xóa các tập phim liên quan khi xóa phim
        });
    }
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movie_genre', 'movie_id', 'genre_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    // Thêm phương thức để lấy thể loại đầu tiên
    public function firstGenre() {
        return $this->belongsTo(Genre::class, 'genre_id');
    }
}
