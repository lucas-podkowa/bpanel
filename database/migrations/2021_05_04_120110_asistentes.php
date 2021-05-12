<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Asistentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistente', function (Blueprint $table ) {
            $table->increments('asistente_id');
            $table->unsignedSmallInteger('user_id')->nullable(false);
            $table->unsignedInteger('sala_id')->nullable(false);
            $table->string('full_name', 100)->nullable(false);
            $table->string('role', 10)->nullable(false);

            $table->foreign('sala_id')->references('sala_id')->on('sala')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropIfExists('asistente');
        
    }
}
