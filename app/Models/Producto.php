<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion',
        'unidad_medida_id',
        'familia_id',
        'precio',
        'stock_minimo',
        'existencia',
        'cantidad_pedida',
    ];

    public function unidadMedida()
    {
        return $this->belongsTo(UnidadMedida::class, 'unidad_medida_id');
    }
    public function familia()
    {
        return $this->belongsTo(Familia::class, 'familia_id');
    }
}
