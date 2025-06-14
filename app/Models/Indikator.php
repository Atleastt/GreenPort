<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    use HasFactory;

    protected $fillable = [
        'subkriteria_id',
        'teks_indikator',
        'bobot_indikator',
        'poin_maks_indikator',
    ];

    public function subkriteria()
    {
        return $this->belongsTo(Subkriteria::class, 'subkriteria_id');
    }
}
