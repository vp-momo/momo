<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodeHisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_his', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100)->nullable();
            $table->string('momo', 100)->nullable();
            $table->string('momo_reward', 100)->nullable();
            $table->string('day', 100)->nullable();
            $table->integer('money')->nullable();
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
        Schema::dropIfExists('code_his');
    }
}
