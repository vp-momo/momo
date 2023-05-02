<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history', function (Blueprint $table) {
            $table->id();
            $table->string('phone', 15);
            $table->string('id_momo', 15)->index();
            $table->string('id_tran', 15)->index();
            $table->text('info')->nullable();
            $table->integer('status')->default(0);
            $table->string('sys_ran', 20)->nullable();
            $table->integer('cron_status')->default(0);
            $table->integer('amount');
            $table->integer('amount_paid')->default(0);
            $table->string('comment')->nullable();
            $table->string('id_game', 15);
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
        Schema::dropIfExists('history');
    }
}
