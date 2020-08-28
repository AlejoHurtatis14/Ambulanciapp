<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbulanciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambulancias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo');
            $table->string('placa');
            $table->boolean('estado');
            $table->bigInteger('fk_empresa')->unsigned();
            $table->foreign('fk_empresa')->references('id')->on('empresas');
            $table->bigInteger('fk_conductor')->unsigned();
            $table->foreign('fk_conductor')->references('id')->on('usuarios');
            $table->bigInteger('fk_enfermero_uno')->unsigned();
            $table->foreign('fk_enfermero_uno')->references('id')->on('usuarios');
            $table->bigInteger('fk_enfermero_dos')->unsigned();
            $table->foreign('fk_enfermero_dos')->references('id')->on('usuarios');
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
        Schema::dropIfExists('ambulancias');
    }
}
