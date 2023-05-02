<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSettingJobColumnSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('setting', function (Blueprint $table) {
            $table->integer('sendMoney')->after('active')->default(0);
            $table->integer('sendError')->after('sendMoney')->default(0);
            $table->integer('loadBill')->after('sendError')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setting', function (Blueprint $table) {
            $table->dropColumn('sendMoney');
            $table->dropColumn('sendError');
            $table->dropColumn('loadBill');
        });
    }
}
