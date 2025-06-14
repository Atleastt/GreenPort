<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subkriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'kriteria_id',
        'nama_subkriteria',
        'deskripsi_subkriteria',
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }

    public function indikators()
    {
        return $this->hasMany(Indikator::class, 'subkriteria_id');
    }
}
