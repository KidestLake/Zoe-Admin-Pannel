<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Instrumentalist;
use App\Models\SongDetail;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'artist_id', 'artist_name', 'created_by', 'album_id', 'album_name',
        'track_number', 'language', 'released_date', 'path',
    ];
    public function internationalPayments()
    {
        return $this->hasMany(InternationalPayment::class);
    }
    public function localPayments()
    {
        return $this->hasMany(LocalPayment::class);
    }
    public function telecomPayments()
    {
        return $this->hasMany(TelecomPayment::class);
    }
    public function artist(){
        return $this->belongsTo(User::class,'foreign_key','artist_id');
    }
    public function album(){
        return $this->belongsTo(Album::class);
    }
    public function instrumentalists()
    {
        return $this->hasMany(Instrumentalist::class);
    }
    public function details()
    {
        return $this->hasMany(SongDetail::class);
    }
}
