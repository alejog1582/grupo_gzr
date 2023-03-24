<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidosFidepuntos extends Model
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

    public function estadoPedido() {
        return $this->belongsTo('App\Models\EstadosPedidosClienteFidepuntos', 'estado_pedido');
    }

    public function cliente() {
        return $this->belongsTo('App\Models\ClienteFidepuntos', 'cliente_id');
    }
}