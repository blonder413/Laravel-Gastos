<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    public $fillable = ['detalle', 'valor'];

    public function scopeDetalle($query, $detalle)
    {
        if ($detalle) {
            return $query->where('detalle', 'LIKE', "%$detalle%");
        }
    }

    public function scopeFecha($query, $fecha)
    {
        if ($fecha) {
            return $query->where('created_at', 'LIKE', "$fecha%");
        }
    }

    public function scopeValor($query, $valor)
    {
        if ($valor) {
            return $query->where('valor', '=', "$valor");
        }
    }
}
