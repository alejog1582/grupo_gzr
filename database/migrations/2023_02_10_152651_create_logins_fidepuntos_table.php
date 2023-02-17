<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginsFidepuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('fidepuntos')->create('logins_fidepuntos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('identificacion')->unique();
            $table->string('password');
            $table->date('fecha_ultimo_ingreso');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('fidepuntos')->dropIfExists('logins_fidepuntos');
    }
}
