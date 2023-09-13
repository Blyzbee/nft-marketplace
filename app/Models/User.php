<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'wallet',
        'isAdmin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function nfts()
    {
        return $this->hasMany(Nft::class, 'owner_id');
    }
}
