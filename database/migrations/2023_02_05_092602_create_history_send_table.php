<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorySendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_send', function (Blueprint $table) {
            $table->id();
            $table->string('phone', 12);
            $table->string('trans_id', 30)->nullable();
            $table->string('id_momo', 12)->index();
            $table->integer('status')->default(1);
            $table->string('comment')->nullable();
            $table->integer('amount')->default(0);
            $table->text('info')->nullable();
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
        Schema::dropIfExists('history_send');
    }
}
