<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_de_gasto_id')->nullable();
            $table->date('fecha')->nullable();
            $table->decimal('importe', 8,2)->nullable();
            $table->text('descripcion')->nullable();

            $table->timestamps();

            $table->foreign('tipo_de_gasto_id')->references('id')->on('tipos_gastos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gastos');
    }
}
