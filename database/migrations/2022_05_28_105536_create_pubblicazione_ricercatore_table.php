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
        Schema::create('pubblicazione_ricercatore', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('pubblicazione_id')->constrained('pubblicazioni')->onUpdate("cascade")->onDelete("cascade");
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
        Schema::dropIfExists('pubblicazione_ricercatore');
    }
};
