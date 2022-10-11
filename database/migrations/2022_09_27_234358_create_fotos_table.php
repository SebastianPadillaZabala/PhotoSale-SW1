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
        Schema::create('fotos', function (Blueprint $table) {
            $table->id('id_foto');
            $table->string('path');
            $table->unsignedBigInteger('id_fotog');
            $table->unsignedBigInteger('id_even');

            $table->foreign('id_fotog')->on('fotografos')->references('id_fotografo')
            ->onDelete('cascade');
            $table->foreign('id_even')->on('eventos')->references('id_evento')
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
        Schema::dropIfExists('fotos');
    }
};
