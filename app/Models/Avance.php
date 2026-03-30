<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avance extends Model
{
    protected $table = 'avances';

    protected $fillable = [
        'project_id',
        'note',
        'milestone_date',
    ];
}
