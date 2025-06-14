<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'auditor_id',
        'auditee_id',
        'scheduled_start_date',
        'scheduled_end_date',
        'actual_start_date',
        'actual_end_date',
        'status',
        'completion_notes',
    ];

    /**
     * Get the auditor for the audit.
     */
    public function auditor()
    {
        return $this->belongsTo(User::class, 'auditor_id');
    }

    /**
     * Get the auditee for the audit.
     */
    public function auditee()
    {
        return $this->belongsTo(User::class, 'auditee_id');
    }

    /**
     * Get the audit criteria for the audit.
     */
    public function auditCriteria()
    {
        return $this->hasMany(AuditCriterion::class); // Assuming AuditCriterion model exists or will be created
    }
}
