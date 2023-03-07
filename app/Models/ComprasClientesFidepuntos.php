<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComprasClientesFidepuntos extends Model
{
    use HasFactory;
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'fidepuntos';
    protected $guarded = [];

    public function cliente() {
        return $this->belongsTo('App\Models\ClienteFidepuntos', 'cliente_id');
    }

    public function compania() {
        return $this->belongsTo('App\Models\CompaniasFidepuntos', 'compania_id');
    }

    public function producto() {
        return $this->belongsTo('App\Models\ProductosFidepuntos', 'producto_id');
    }
}
