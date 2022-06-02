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
        Schema::create('sotto_progetti', function (Blueprint $table) {
            $table->id();
            $table->string('titolo');
            $table->string('descrizione');
            $table->date('data_rilascio');
            $table->foreignId('responsabile_id')->constrained('utenti');
            $table->foreignId('progetto_id')->constrained('progetti')->onUpdate("cascade")->onDelete("cascade");
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
        Schema::dropIfExists('sotto_progetti');
    }
};
