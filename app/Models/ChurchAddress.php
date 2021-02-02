<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChurchAddress extends Model
{
   use HasFactory;
   protected $fillable=[
       'church_id','country','city','subcity','woreda','specific_location',
   ];
   public function church(){
      return $this->belongsTo(Church::class);
   }
}
