<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Salas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sala' , function (Blueprint $table ) {
            $table->increments('sala_id');
            $table->string('meeting_id', 60)->nullable(false);
            $table->string('meeting_name')->nullable(false);
            $table->unsignedSmallInteger('participant_count')->nullable()->default(12);
            $table->unsignedSmallInteger('listener_count')->nullable()->default(12);
            $table->unsignedSmallInteger('voice_count')->nullable()->default(12);
            $table->string('moodle_context', 50);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sala');
    }
}
