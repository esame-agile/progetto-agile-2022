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
        Schema::create('movimenti', function (Blueprint $table) {
            $table->id();
            $table->float('importo');
            $table->string('causale');
            $table->date('data');
            $table->foreignId('progetto_id')->constrained('progetti');
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
        Schema::dropIfExists('movimenti');
    }
};
