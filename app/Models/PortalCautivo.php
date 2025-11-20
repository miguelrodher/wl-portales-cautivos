<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortalCautivo extends Model
{
    use HasFactory;

    protected $table = 'portales_cautivos';

    protected $fillable = 
    [
        'nombre',
    ];

    public function sesiones(): HasMany
    {
        return $this->hasMany(SesionNavegador::class, 'portales_cautivos_id');
    }
}
