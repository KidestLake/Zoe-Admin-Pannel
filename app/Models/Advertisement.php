<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;
    protected $fillable=[
        'banner_image','owner_name','phone','url','start_date','end_date','is_active',
    ];
}
