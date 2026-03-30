<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EntregaEstudiante extends Model
{
    protected $table = 'entregas_estudiantes';

    protected $fillable = [
        'entregable_id',
        'user_id',
        'project_id',
        'nombre_archivo',
        'ruta_archivo',
        'fecha_entrega',
        'calificacion',
        'comentarios_docente',
    ];

    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
