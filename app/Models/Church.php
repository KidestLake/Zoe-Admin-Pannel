<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id','name','email','phone','website','is_active',
    ];
    public function manager(){
       return $this->hasOne(User::class);
    }

    public function news(){
       return $this->hasMany(News::class);
    }
    public function address(){
        return $this->hasOne(ChurchAddress::class);
    }
}
