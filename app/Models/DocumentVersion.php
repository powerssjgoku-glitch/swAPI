<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentVersion extends Model
{
    protected $table = 'document_versions';

    protected $fillable = [
        'entregable_id',
        'version_number',
        'archivo_path',
        'cambios',
        'uploaded_by',
    ];

    public function entregable(): BelongsTo
    {
        return $this->belongsTo(Deliverable::class, 'entregable_id');
    }

    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by', 'id');
    }
}
