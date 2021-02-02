<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingArtist extends Model
{
    use HasFactory;
    protected $fillable=[
        'first_name','last_name','email','phone','password','location',
        'profile_image','id_image','artist_name','bank_name','account_number'

    ];

    protected $hidden =[
        'password'
    ];
}
