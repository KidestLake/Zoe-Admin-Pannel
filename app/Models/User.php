<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'last_logged_in',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function profile(){
        return $this->hasOne(Profile::class);
    }
    public function downloads(){
        return $this->hasMany(DowloadHistory::class);
    }
    public function bankAccount(){
        return $this->hasMany(BankAccount::class);
    }
    public function songs(){
        return $this->hasMany(Song::class);
    }

    public function payouts(){
        return $this->hasMany(PayoutHistory::class);
    }
    public function gifts(){
        return $this->hasMany(Gift::class);
    }
    public function internationalPayments(){
        return $this->hasMany(InternationalPayment::class);
    }
    public function localPayments(){
        return $this->hasMany(LocalPayment::class);
    }
    public function telecomPayments(){
        return $this->hasMany(TelecomPayment::class);
    }

}
