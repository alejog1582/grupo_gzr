<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FidelizacionClientesFidepuntos extends Model
{
    use HasFactory;
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'fidepuntos';
    protected $guarded = [];

    public function configfidelizacion() {
        return $this->belongsTo('App\Models\ConfigFidelizacionClientesFidepuntos', 'config_fidelizacion_cliente_id');
    }

    public function pedido() {
        return $this->belongsTo('App\Models\PedidosFidepuntos', 'pedido_id');
    }
}
