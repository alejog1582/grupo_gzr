<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanPuntosxCompaniaFidepuntos extends Model
{
    use HasFactory;
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'fidepuntos';
    protected $guarded = [];

    public function compania() {
        return $this->belongsTo('App\Models\CompaniasFidepuntos', 'compania_id');
    }

    public function planpuntos() {
        return $this->belongsTo('App\Models\PlanPuntosFidepuntos', 'plan_puntos_id');
    }
}
