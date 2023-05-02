<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->string('keywords')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_admin')->nullable();
            $table->string('comment_back_money')->nullable();
            $table->string('description')->nullable();
            $table->string('favicon')->nullable();
            $table->integer('active')->default(0);
            $table->integer('hu')->default(1);
            $table->text('note')->nullable();
            $table->text('script')->nullable();
            $table->text('ads')->nullable();
            $table->string('color')->nullable();
            $table->string('	theme')->nullable();
            $table->integer('type_check')->nullable();
            $table->text('text_run')->nullable();
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
        Schema::dropIfExists('setting');
    }
}
