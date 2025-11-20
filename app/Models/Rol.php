<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = 
    [
        'rol',
    ];

    public function permisos(): BelongsToMany
    {
        return $this->belongsToMany
        (
            Permiso::class,
            'roles_permisos',
            'roles_id',
            'permisos_id'
        );
    }

    public function cuentas(): HasMany
    {
        return $this->hasMany(CuentaAdministrativa::class, 'roles_id');
    }
}
