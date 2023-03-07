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

    public function configfidelizacioncliente() {
        return $this->belongsTo('App\Models\ConfigFidelizacionClientesFidepuntos', 'config_fidelizacion_cliente_id');
    }

    public function compracliente() {
        return $this->belongsTo('App\Models\ComprasClientesFidepuntos', 'compra_cliente_id');
    }

    public function cliente() {
        return $this->belongsTo('App\Models\ClienteFidepuntos', 'cliente_id');
    }

    public function producto() {
        return $this->belongsTo('App\Models\ProductosFidepuntos', 'producto_id');
    }
}
