<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiKetos extends Model
{
     use HasFactory;

    protected $table = 'nilai_ketos';
    protected $fillable = ['id_ketos', 'id_kriteria', 'skor'];

    // Relasi ke CalonKetos
    public function calonKetos()
    {
        return $this->belongsTo(Ketos::class, 'id_ketos');
    }

    // Relasi ke Kriteria
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }
}
