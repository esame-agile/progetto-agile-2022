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
        Schema::create('progetto_ricercatore', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('progetto_id')->constrained('progetti')->onUpdate("cascade")->onDelete("cascade");
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
        Schema::dropIfExists('progetto_ricercatore');
    }
};
