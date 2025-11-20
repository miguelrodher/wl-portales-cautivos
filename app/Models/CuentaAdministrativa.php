<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CuentaAdministrativa extends Authenticatable
{
    use HasFactory;

    protected $table = 'cuentas_administrativas';

    protected $fillable = 
    [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'password',
        'email',
        'estatus',
        'roles_id',
    ];

    protected $hidden = 
    [
        'password', 'remember_token'
    ];

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'roles_id');
    }
}
