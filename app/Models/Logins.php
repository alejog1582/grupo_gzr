<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Laravel\Sanctum\HasApiTokens;

class Logins extends Model
{
    use HasFactory, HasApiTokens;
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql';
    protected $guarded = [];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
