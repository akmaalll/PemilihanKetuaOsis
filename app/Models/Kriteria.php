<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriterias';
    protected $fillable = ['kode', 'kriteria', 'ket', 'poin'];

    // Relasi ke NilaiKetos (satu kriteria memiliki banyak nilai)
    public function nilaiKetos()
    {
        return $this->hasMany(NilaiKetos::class, 'id_kriteria');
    }

    // Relasi ke CalonKetos melalui NilaiKetos
    public function calonKetos()
    {
        return $this->belongsToMany(Ketos::class, 'nilai_ketos', 'id_kriteria', 'id_ketos')
            ->withPivot('skor')
            ->withTimestamps();
    }
}
