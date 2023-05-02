<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMomosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('momos', function (Blueprint $table) {
            $table->id();
            $table->string('phone', 12)->nullable();
            $table->string('pass')->nullable();
            $table->integer('sodu')->nullable()->default(0);
            $table->integer('gd_day')->nullable()->default(0);
            $table->integer('max_day')->nullable()->default(48000000);
            $table->integer('gd_month')->nullable()->default(0);
            $table->integer('max_month')->nullable()->default(98000000);
            $table->text('RSA_PUBLIC_KEY')->nullable();
            $table->text('info')->nullable();
            $table->integer('gd')->nullable()->default(0);
            $table->string('trangthai', 10)->default("walt");
            $table->integer('try')->default(0);
            $table->integer('min')->default(10000);
            $table->integer('max')->default(1000000);
            $table->integer('timelogin')->default(0);
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
        Schema::dropIfExists('momos');
    }
}
