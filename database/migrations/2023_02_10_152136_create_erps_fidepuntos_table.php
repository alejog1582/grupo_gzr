<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErpsFidepuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('fidepuntos')->create('erps_fidepuntos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('compania_id')->unsigned();
            $table->string('endpoint');
            $table->string('sistema_erp');
            $table->string('token')->nullable();
            $table->string('data_connection')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('fidepuntos')->dropIfExists('erps_fidepuntos');
    }
}
