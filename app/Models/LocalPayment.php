<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalPayment extends Model
{
    use HasFactory;
    protected $fillable=[
        'song_id','song_title','user_id','price','net_price','service_fee','purchased_date','is_payout',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function song(){
        return $this->belongsTo(Song::class);
    }
}
