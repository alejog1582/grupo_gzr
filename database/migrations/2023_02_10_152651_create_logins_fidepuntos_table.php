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
        Schema::connection('mysql')->create('logins', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('identificacion');
            $table->string('password');
            $table->string('role');
            $table->string('proyecto');
            $table->date('fecha_ultimo_ingreso')->nullable();
            $table->integer('cliente_id')->nullable();
            $table->integer('user_id')->nullable()->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('logins');
    }
}
