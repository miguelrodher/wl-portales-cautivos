<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelefonoRestringido extends Model
{
    use HasFactory;

    protected $table = 'telefonos_restringidos';

    protected $fillable = 
    [
        'restriccion',
    ];
}
