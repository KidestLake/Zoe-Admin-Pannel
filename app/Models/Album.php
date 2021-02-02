<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'total_songs', 'cover_image', 'released_date', 'publisher', 'published_date',
    ];
    public function albumArtists()
    {
       return $this->hasMany(AlbumArtist::class);
    }
    public function songs(){
        return $this->hasMany(Song::class);
    }
}
