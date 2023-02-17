<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteFidepuntos extends Model
{
    use HasFactory;
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'fidepuntos';
    protected $guarded = [];

    public function membresia() {
        return $this->belongsTo('App\Models\MembresiasFidepuntos', 'membresia_id');
    }

    public function compania() {
        return $this->belongsTo('App\Models\CompaniasFidepuntos', 'compania_id');
    }
}
