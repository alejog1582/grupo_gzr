<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosFidepuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('fidepuntos')->create('pedidos_fidepuntos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('codigo_pedido')->nullable();
            $table->integer('valor_pedido');
            $table->integer('estado_pedido')->unsigned();
            $table->integer('compania_id')->unsigned();
            $table->string('identificacion_cliente');
            $table->integer('cliente_id')->unsigned();
            $table->boolean('enviado')->nullable();
            $table->date('fecha_envio')->nullable();
            $table->date('fecha_entrega')->nullable();
            $table->string('id_pedido_externo')->nullable();
            $table->string('metodo_pago')->nullable();
            $table->date('fecha_pago')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('fidepuntos')->dropIfExists('pedidos_fidepuntos');
    }
}
