<?php

namespace App\Models;

class RekamMedis extends BaseModel
{
    protected $table = 'rekam_medis';

    protected $fillable = [
        'pasien_id',
        'dokter_id',
        'tanggal',
        'jam',
        'keluhan',
        'diagnosa',
        'resep',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id', 'id');
    }
}
