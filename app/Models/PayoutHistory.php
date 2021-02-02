<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayoutHistory extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id', 'payout_date','payout_ammount','payment_type','currency',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
