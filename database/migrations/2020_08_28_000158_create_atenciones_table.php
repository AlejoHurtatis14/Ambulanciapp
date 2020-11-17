<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtencionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atenciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('latitudInicial');
            $table->string('longitudInicial');
            $table->string('latitudFinal');
            $table->string('longitudFinal');
            $table->string('estado');//Estado de si fue cumplido o no
            $table->bigInteger('fk_enfermero')->unsigned()->nullable();
            $table->foreign('fk_enfermero')->references('id')->on('usuarios');
            $table->bigInteger('fk_usuario')->unsigned();
            $table->foreign('fk_usuario')->references('id')->on('usuarios');
            $table->bigInteger('fk_empresa')->unsigned()->nullable();
            $table->foreign('fk_empresa')->references('id')->on('empresas');
            $table->bigInteger('fk_ambulancia')->unsigned()->nullable();
            $table->foreign('fk_ambulancia')->references('id')->on('ambulancias');
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
        Schema::dropIfExists('atenciones');
    }
}
