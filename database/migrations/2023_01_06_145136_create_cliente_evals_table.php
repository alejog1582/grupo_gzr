<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteEvalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('eval')->create('cliente_evals', function (Blueprint $table) {
            $table->id();
            $table->string('cedula')->unique();
            $table->string('primer_nombre');
            $table->string('segundo_nombre')->nullable();
            $table->string('primer_apellido');
            $table->string('segundo_apellido')->nullable();
            $table->string('celular');
            $table->string('email');
            $table->date('fecha_nacimiento')->nullable();
            $table->string('lugar_nacimiento')->nullable();
            $table->date('fecha_expedicion')->nullable();
            $table->string('url_cedula_frontal')->nullable();
            $table->string('url_cedula__anversa')->nullable();
            $table->string('genero')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('hijos')->nullable();
            $table->string('personas_dependientes')->nullable();
            $table->string('nivel_estudio')->nullable();
            $table->string('profesion')->nullable();
            $table->string('ciudad_residencia')->nullable();
            $table->string('direccion_residencia')->nullable();
            $table->string('telefono_fijo')->nullable();
            $table->string('barrio_residencia')->nullable();
            $table->string('tipo_residencia')->nullable();
            $table->string('estrato')->nullable();
            $table->string('tiempo_en_vivienda')->nullable();
            $table->string('plan_celular')->nullable();
            $table->string('vehiculo')->nullable();
            $table->string('placa_vehiculo')->nullable();
            $table->string('proveniencia_cliente')->nullable();
            $table->string('tipo_empleo')->nullable();
            $table->string('empresa')->nullable();
            $table->string('nit_empresa')->nullable();
            $table->string('cargo')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->string('tipo_contrato')->nullable();
            $table->string('salario')->nullable();
            $table->string('modalidad_pago')->nullable();
            $table->string('periodicdad_pago')->nullable();
            $table->string('direccion_empresa')->nullable();
            $table->string('telefono_empresa')->nullable();
            $table->string('banco_cuenta')->nullable();
            $table->string('tipo_cuenta')->nullable();
            $table->string('numero_cuenta')->nullable();
            $table->string('declara_renta')->nullable();
            $table->string('email_codeudor_1')->nullable();
            $table->string('codeudor_id_1')->nullable();
            $table->string('email_codeudor_2')->nullable();
            $table->string('codeudor_id_2')->nullable();
            $table->string('ano_renta')->nullable();
            $table->integer('puntaje')->nullable();
            $table->integer('numero_creditos')->nullable();
            $table->integer('cupo_credito')->nullable();
            $table->string('comportamiento')->nullable();
            $table->string('estado_cliente_id')->nullable();
            $table->boolean('ingresos_1_smlv')->nullable();
            $table->boolean('declaracion_reporte_centrales')->nullable();
            $table->string('provinencia_ingresos')->nullable();
            $table->string('declaracion_cuenta_bancaria')->nullable();
            $table->boolean('autorizacion_consulta_centrales')->nullable();
            $table->boolean('autorizacion_tratameinto_datos')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('eval')->dropIfExists('cliente_evals');
    }
}
