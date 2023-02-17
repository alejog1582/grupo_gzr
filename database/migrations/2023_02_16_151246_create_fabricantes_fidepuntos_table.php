<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFabricantesFidepuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('fidepuntos')->create('fabricantes_fidepuntos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre_fabricante');
            $table->integer('compania_id')->unsigned();
            $table->string('activo');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('fidepuntos')->dropIfExists('fabricantes_fidepuntos');
    }
}
