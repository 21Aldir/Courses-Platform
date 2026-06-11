<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = [
        'categoria_id',
        'instructor_id',
        'titulo',
        'slug',
        'descripcion',
        'nivel',
        'duracion',
        'cupos',
        'status',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }
}
