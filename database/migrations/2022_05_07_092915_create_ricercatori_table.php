<?php

use Cassandra\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ricercatori', function (Blueprint $table) {
            $table->id('id_ricercatore');
            $table->string('data_nascita');
            $table->string('universita');
            $table->string('ambito_ricerca');
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
        Schema::dropIfExists('ricercatori');
    }
};
