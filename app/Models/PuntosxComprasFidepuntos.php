<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuntosxComprasFidepuntos extends Model
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
}
