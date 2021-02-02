<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumArtist extends Model
{
    use HasFactory;
   protected $fillable=[
       'album_id','album_name','artist_id','artist_name',
   ];
   public function album(){
       return $this->belongsTo(Album::class);
   }
}
