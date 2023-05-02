<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game', function (Blueprint $table) {
            $table->id();
            $table->string('ma_game')->nullable();
            $table->string('KQ')->default('00|01|02');
            $table->string('comment')->nullable();
            $table->string('ratio')->default('1.95');
            $table->string('h_key')->nullable();
            $table->integer('number')->default(2);
            $table->integer('type')->default(1);
            $table->string('status')->default('run');
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
        Schema::dropIfExists('game');
    }
}
