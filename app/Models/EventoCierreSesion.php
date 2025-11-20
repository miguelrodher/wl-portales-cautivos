<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventoCierreSesion extends Model
{
    use HasFactory;

    protected $table = 'eventos_cierres_sesiones';

    protected $fillable = 
    [
        'evento_cierre_sesion',
    ];

    public function sesiones(): HasMany
    {
        return $this->hasMany(SesionNavegador::class, 'eventos_cierres_sesiones_id');
    }
}
