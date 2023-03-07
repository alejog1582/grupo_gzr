<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosFidepuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('fidepuntos')->create('productos_fidepuntos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre_producto');
            $table->string('codigo_producto')->nullable();
            $table->string('ean')->nullable();
            $table->string('presentacion_talla_tamano')->nullable();
            $table->integer('fabricante_id')->nullable()->unsigned();
            $table->integer('marca_id')->nullable()->unsigned();
            $table->integer('categoria_id')->nullable()->unsigned();
            $table->integer('compania_id')->unsigned();
            $table->string('inventario')->nullable();
            $table->boolean('activo')->nullable();
            $table->string('tipo');
            $table->string('objetivo');
            $table->boolean('oferta')->nullable();
            $table->integer('precio_unitario')->nullable();
            $table->integer('iva')->nullable();
            $table->integer('impoconsumo')->nullable();
            $table->decimal('descuento_porcentaje',9,2)->nullable();
            $table->integer('descuento_valor')->nullable();
            $table->integer('precio')->nullable();
            $table->integer('precio_puntos')->nullable();
            $table->boolean('fidelizacion')->nullable();
            $table->integer('media_id_principal')->nullable()->unsigned();
            $table->integer('media_id_secundaria')->nullable()->unsigned();
            $table->integer('media_id_terciaria')->nullable()->unsigned();
            $table->integer('media_id_video')->nullable()->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('fidepuntos')->dropIfExists('productos_fidepuntos');
    }
}
