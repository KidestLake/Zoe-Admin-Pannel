<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongDetail extends Model
{
    use HasFactory;
    protected $fillable=[
        "song_id","detail_name","detail_value"
    ];
}
