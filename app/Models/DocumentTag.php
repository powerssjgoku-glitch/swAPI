<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DocumentTag extends Model
{
    protected $table = 'document_tags';

    protected $fillable = [
        'nombre',
        'descripcion',
        'color',
    ];

    public function entregables(): BelongsToMany
    {
        return $this->belongsToMany(
            Deliverable::class,
            'entregable_tags',
            'tag_id',
            'entregable_id'
        )->withTimestamps();
    }
}
