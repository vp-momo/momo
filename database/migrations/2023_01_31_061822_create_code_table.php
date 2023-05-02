<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100)->nullable();
            $table->string('momo_reward', 100)->nullable();
            $table->integer('money')->nullable();
            $table->integer('limit_import')->nullable();
            $table->integer('entered')->nullable()->default(0);
            $table->string('status')->nullable()->default("off");
            $table->string('time', 100)->nullable();
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
        Schema::dropIfExists('code');
    }
}
