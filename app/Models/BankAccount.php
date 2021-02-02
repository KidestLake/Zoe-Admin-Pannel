<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class BankAccount extends Model
{
    use Hasfactory;
   protected $fillable=[
       'user_id','artist_name','bank_name','account_number',
   ];
   public function owner(){
    return $this->belongsTo(User::class);
   }
}
