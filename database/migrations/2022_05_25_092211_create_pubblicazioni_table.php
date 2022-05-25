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
        Schema::create('pubblicazioni', function (Blueprint $table) {
            $table->id();
            $table->string('doi')->unique();
            $table->string('titolo');
            $table->string('sorgente');
            $table->boolean('ufficiale')->default(false);
            $table->string('tipologia');
            $table->string('autori_esterni')->nullable();
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
        Schema::dropIfExists('pubblicazioni');
    }
};
