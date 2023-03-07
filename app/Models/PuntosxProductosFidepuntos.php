<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuntosxProductosFidepuntos extends Model
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

    public function fabricante() {
        return $this->belongsTo('App\Models\FabricantesFidepuntos', 'fabricante_id');
    }

    public function marca() {
        return $this->belongsTo('App\Models\MarcasFidepuntos', 'marca_id');
    }

    public function categoria() {
        return $this->belongsTo('App\Models\CategoriasFidepuntos', 'categoria_id');
    }

    public function producto() {
        return $this->belongsTo('App\Models\ProductosFidepuntos', 'producto_id');
    }

}
