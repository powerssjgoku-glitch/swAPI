<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'id',
        'nombres',
        'apa',
        'ama',
        'email',
        'password',
        'curp',
        'direccion',
        'telefonos',
        'perfil_id',
        'activo',
    ];

    public function entregasCalificadas(): HasMany
    {
        return $this->hasMany(EntregaEstudiante::class, 'user_id', 'id');
    }
}
