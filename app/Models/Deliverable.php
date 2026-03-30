<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Deliverable extends Model
{
    protected $table = 'deliverables';

    protected $fillable = [
        'project_id',
        'nombre',
        'autores',
        'descripcion',
        'palabra_clave',
        'archivo_path',
        'url_descarga',
        'tipo_documento',
        'rama_asociada',
        'fecha_publicacion',
        'estado',
        'submitted_by',
        'submitted_at',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function submittedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by', 'id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            DocumentTag::class,
            'entregable_tags',
            'entregable_id',
            'tag_id'
        )->withTimestamps();
    }

    public function versions(): HasMany
    {
        return $this->hasMany(DocumentVersion::class, 'entregable_id')
            ->orderBy('version_number', 'desc');
    }

    public function currentVersion(): HasOne
    {
        return $this->hasOne(DocumentVersion::class, 'entregable_id')
            ->orderBy('version_number', 'desc')
            ->limit(1);
    }
}
