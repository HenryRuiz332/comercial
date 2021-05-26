<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes_servicios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment("id cliente");
            $table->unsignedBigInteger('servicio_id');
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('colaborador_id');

            $table->decimal('gasto', 8,2)->nullable();
            $table->text('nota_gasto')->nullable();
            $table->decimal('beneficio', 8,2)->nullable();
            $table->decimal('comision', 8,2)->nullable();
            $table->date('aviso_permanencia')->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();


             $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('servicio_id')->references('id')->on('servicios')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('producto_id')->references('id')->on('productos')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('colaborador_id')->references('id')->on('colaboradores')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes_servicios');
    }
}
