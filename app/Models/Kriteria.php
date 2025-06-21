<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_kriteria',
        'deskripsi_kriteria',
        'code',
        'name',
        'description',
        'weight',
        'creator_id',
        'created_by_user_id',
    ];

    /**
     * Get the sub-criteria for the criterion.
     */
    public function subkriterias()
    {
        return $this->hasMany(Subkriteria::class);
    }

    /**
     * Get the user that created the criterion.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }
}
