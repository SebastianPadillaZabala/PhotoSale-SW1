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
        Schema::create('foto_pagos', function (Blueprint $table) {
            $table->id('id_foto_pago');
            $table->float('monto');
            $table->string('owner');
            $table->string('card_number');
            $table->string('expiration_month');
            $table->string('expiration_year');
            $table->string('security_code');
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
        Schema::dropIfExists('foto_pagos');
    }
};
