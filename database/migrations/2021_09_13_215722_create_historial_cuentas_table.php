<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_cuentas', function (Blueprint $table) {
            $table->id();
            $table->integer('cuentaID')->unsigned();
            $table->integer('monto');
            $table->dateTime('fecha')->nullable(); 

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
        Schema::dropIfExists('historial_cuentas');
    }
}
