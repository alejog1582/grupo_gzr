<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidosxProductosFidepuntos extends Model
{
    use HasFactory;
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'fidepuntos';
    protected $guarded = [];

    public function pedido() {
        return $this->belongsTo('App\Models\PedidosFidepuntos', 'pedido_id');
    }

    public function producto() {
        return $this->belongsTo('App\Models\ProductosFidepuntos', 'producto_id');
    }

}
