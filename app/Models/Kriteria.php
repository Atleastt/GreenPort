<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kriterias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_kriteria',
        'deskripsi_kriteria',
    ];

    /**
     * Get the sub-kriteria for the kriteria.
     */
    public function subkriterias()
    {
        return $this->hasMany(Subkriteria::class, 'kriteria_id');
    }
}
