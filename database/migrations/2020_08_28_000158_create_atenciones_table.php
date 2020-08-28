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
            $table->string('ubicacion');
            $table->string('traslado');
            $table->string('observacion');
            $table->string('estado');//Estado de si fue cumplido o no
            $table->bigInteger('fk_empresa')->unsigned();
            $table->foreign('fk_empresa')->references('id')->on('empresas');
            $table->bigInteger('fk_ambulancia')->unsigned();
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
