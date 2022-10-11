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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id('id_evento');
            $table->string('nombre_evento');
            $table->date('fecha');
            $table->string('hora');
            $table->string('lugar');
            $table->string('tipo_evento');
            $table->unsignedBigInteger('id_org');
            $table->unsignedBigInteger('id_fotog');

            $table->foreign('id_org')->on('organizadors')->references('id_organizador')
            ->onDelete('cascade');
            $table->foreign('id_fotog')->on('fotografos')->references('id_fotografo')
            ->onDelete('cascade');
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
        Schema::dropIfExists('eventos');
    }
};
