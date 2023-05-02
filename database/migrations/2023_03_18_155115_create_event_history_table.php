<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_history', function (Blueprint $table) {
            $table->id();
            $table->string("phone", 20);
            $table->string("id_momo", 20);
            $table->date("date");
            $table->integer("position")->default(1);
            $table->integer("hook")->default(0);
            $table->integer("reward")->default(0);
            $table->string("comment");
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
        Schema::dropIfExists('event_history');
    }
}
