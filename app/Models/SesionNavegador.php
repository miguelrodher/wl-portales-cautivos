<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesionNavegador extends Model
{
    use HasFactory;

    protected $table = 'sesiones_navegadores';

    protected $fillable = 
    [
        'fecha_inicio',
        'fecha_cierre',
        'ip',
        'dispositivo',
        'sistema_operativo',
        'version_sistema_operativo',
        'navegador',
        'version_navegador',
        'idioma',
        'eventos_cierres_sesiones_id',
        'usuarios_id',
        'portales_cautivos_id',
        'tipos_dispositivos_id',
    ];

    public function evento()
    {
        return $this->belongsTo(EventoCierreSesion::class, 'eventos_cierres_sesiones_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuarios_id');
    }

    public function portal()
    {
        return $this->belongsTo(PortalCautivo::class, 'portales_cautivos_id');
    }

    public function tipo_dispositivo()
    {
        return $this->belongsTo(TipoDispositivo::class, 'tipos_dispositivos_id');
    }
}
