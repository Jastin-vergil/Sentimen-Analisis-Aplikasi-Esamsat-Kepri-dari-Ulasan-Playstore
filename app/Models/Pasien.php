<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'nama',
        'noRM',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
