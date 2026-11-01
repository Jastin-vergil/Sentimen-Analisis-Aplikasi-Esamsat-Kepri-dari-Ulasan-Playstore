<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $timestamps = false;

    protected $fillable = ['nama', 'email', 'password', 'role'];

    public function pasien()
    {
        return $this->hasOne(Pasien::class, 'user_id');
    }
}
