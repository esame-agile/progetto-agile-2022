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
            $table->id();
            $table->string('titolo');
            $table->string('descrizione');
            $table->string('scopo');
            $table->date('data_inizio');
            $table->date('data_fine');
            $table->unsignedInteger('budget');
            $table->foreignId('responsabile_id')->constrained('utenti');
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
