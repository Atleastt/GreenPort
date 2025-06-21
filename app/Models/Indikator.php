<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'subkriteria_id',
        'code',
        'name',
        'description',
    ];

    /**
     * Get the parent sub-criterion.
     */
    public function subkriteria()
    {
        return $this->belongsTo(Subkriteria::class);
    }

    /**
     * The audits that this indicator is part of.
     */
    public function audits()
    {
        return $this->belongsToMany(Audit::class, 'audit_criteria', 'criterion_id', 'audit_id')
                    ->using(AuditCriterion::class)
                    ->withPivot('score', 'auditor_notes', 'status')
                    ->withTimestamps();
    }

    /**
     * Get the documents for the indicator.
     */
    public function documents()
    {
        // Assuming 'audit_criterion_id' in 'documents' table links to the pivot table id.
        // This might need a more complex relationship setup depending on the final schema.
        // For now, let's assume a direct link if possible, or this can be adjusted.
        // A simpler way is to link documents directly to the indicator for a specific audit.
        // This requires a more complex model structure, so we'll represent the direct link for now.
        return $this->hasMany(IndikatorDokumen::class); // Or Bukti::class if direct link
    }
}
