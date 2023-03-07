<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigFidelizacionClientesFidepuntos extends Model
{
    use HasFactory;
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'fidepuntos';
    protected $guarded = [];

    public function planpuntosxcompania() {
        return $this->belongsTo('App\Models\PlanPuntosxCompaniaFidepuntos', 'plan_puntos_compania_id');
    }

    public function producto() {
        return $this->belongsTo('App\Models\ProductosFidepuntos', 'producto_id');
    }

    public function productocanjeable() {
        return $this->belongsTo('App\Models\ProductosFidepuntos', 'producto_canjeable_id');
    }
}
