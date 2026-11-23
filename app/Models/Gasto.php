<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    public $fillable = ['detalle', 'valor'];

    public function scopeDetalle(Builder $query, ?string $detalle)
    {
        if ($detalle) {
            return $query->where('detalle', 'LIKE', "%$detalle%");
        }
    }

    public function scopeFecha(Builder $query, ?string $fecha)
    {
        if ($fecha) {
            return $query->where('created_at', 'LIKE', "$fecha%");
        }
    }

    public function scopeValor(Builder $query, ?float $valor)
    {
        if ($valor) {
            return $query->where('valor', '=', "$valor");
        }
    }
}
