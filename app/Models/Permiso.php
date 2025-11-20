<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    protected $table = 'permisos';

    protected $fillable = 
    [
        'permiso',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany
        (
            Role::class,
            'roles_permisos',
            'permisos_id',
            'roles_id'
        );
    }
}
