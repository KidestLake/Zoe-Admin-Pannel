<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id','sender_name','reciever_phone','song_id',
    ];
    public function user(){
        $this->belongsTo(User::class);
    }
}
