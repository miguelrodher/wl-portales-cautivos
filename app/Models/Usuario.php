<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = 
    [
        'nombre',
        'correo_electronico',
        'telefono',
        'fecha_creacion',
    ];

    public function sesiones(): HasMany
    {
        return $this->hasMany(SesionNavegador::class, 'usuarios_id');
    }
}
