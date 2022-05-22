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
        Schema::create('ricercatore_sotto_progetto', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('sotto_progetto_id')->constrained('sotto_progetti');
            $table->foreignId('ricercatore_id')->constrained('utenti');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ricercatore_sotto_progetto');
    }
};
