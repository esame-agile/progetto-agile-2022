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
        Schema::create('progetti', function (Blueprint $table) {
            $table->id('id_progetto');
            $table->string('titolo');
            $table->string('descrizione');
            $table->string('scopo');
            $table->timestamp('data_inizio');
            $table->timestamp('data_fine');
            $table->foreignId('responsabile_id_utente')->constrained('utenti', 'id_utente');
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
        Schema::dropIfExists('progetti');
    }
};
