<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaquinariaEquipo extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion',
        'tipo_maquinaria_equipo_id',
        'modelo',
        'marca',
        'numero_serie',
        'propietario',
        'frente_trabajo_id',
        'fecha_alta',
        'tipo_combustible',
        'fecha_ultimo_servicio',
        'horometro_ultimo_servicio',
        'condicion',
        'estatus',
    ];

    public function tipo()
    {
        return $this->belongsTo(TipoMaquinariaEquipo::class, 'tipo_maquinaria_equipo_id');
    }

    public function frenteTrabajo()
    {
        return $this->belongsTo(FrenteTrabajo::class, 'frente_trabajo_id');
    }
}
