<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_usuarios');
            $table->date('fecha');
            $table->string('nro_operacion');
            $table->decimal('monto', 8, 2);
            $table->string('estado');
            // Agregar el nuevo campo 'foto'
            $table->string('foto');
            $table->timestamps();
            $table->foreign('id_usuarios')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
};
