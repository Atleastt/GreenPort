<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bukti extends Model
{
    protected $fillable = [
        'temuan_id',
        'pengguna_unggah_id',
        'nama_dokumen',
        'file_path',
        'status',
    ];

    public function temuan()
    {
        return $this->belongsTo(Temuan::class);
    }

    public function pengunggah()
    {
        return $this->belongsTo(User::class, 'pengguna_unggah_id');
    }
}
