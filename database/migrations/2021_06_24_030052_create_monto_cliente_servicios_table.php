<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMontoClienteServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monto_cliente_servicios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_servicio_id');

            $table->decimal('gasto', 8,2)->nullable();
            $table->decimal('beneficio', 8,2)->nullable();
            $table->decimal('comision', 8,2)->nullable();
            $table->date('aviso_permanencia')->nullable();

            $table->timestamps();

            $table->foreign('cliente_servicio_id')->references('id')->on('clientes_servicios')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monto_cliente_servicios');
    }
}
