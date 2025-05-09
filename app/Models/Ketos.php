<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ketos extends Model
{
    use HasFactory;

    protected $table = 'calon_ketos';
    protected $fillable = ['nama', 'kelas', 'jkl'];

    // Relasi ke NilaiKetos (satu calon memiliki banyak nilai)
    public function nilaiKetos()
    {
        return $this->hasMany(NilaiKetos::class, 'id_ketos');
    }

    // Relasi ke Kriteria melalui NilaiKetos
    public function kriterias()
    {
        return $this->belongsToMany(Kriteria::class, 'nilai_ketos', 'id_ketos', 'id_kriteria')
                    ->withPivot('skor')
                    ->withTimestamps();
    }
}
