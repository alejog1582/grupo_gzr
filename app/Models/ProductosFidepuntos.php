<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosFidepuntos extends Model
{
    use HasFactory;
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'fidepuntos';
    protected $guarded = [];

    public function fabricante() {
        return $this->belongsTo('App\Models\FabricantesFidepuntos', 'fabricante_id');
    }

    public function marca() {
        return $this->belongsTo('App\Models\MarcasFidepuntos', 'marca_id');
    }

    public function categoria() {
        return $this->belongsTo('App\Models\CategoriasFidepuntos', 'categoria_id');
    }

    public function compania() {
        return $this->belongsTo('App\Models\CompaniasFidepuntos', 'compania_id');
    }

    public function mediaprincial() {
        return $this->belongsTo('App\Models\BibliotecaMediaFidepuntos', 'media_id_principal');
    }

    public function mediasecundaria() {
        return $this->belongsTo('App\Models\BibliotecaMediaFidepuntos', 'media_id_secundaria');
    }

    public function mediaterciaria() {
        return $this->belongsTo('App\Models\BibliotecaMediaFidepuntos', 'media_id_terciaria');
    }

    public function mediavideo() {
        return $this->belongsTo('App\Models\BibliotecaMediaFidepuntos', 'media_id_video');
    }
}
