<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToStorestocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('storestocks', function (Blueprint $table) {
            $table->integer('currently_at_hand');
            $table->enum('status', ['in_stock', 'sold_out']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('storestocks', function (Blueprint $table) {
            $table->dropColumn('currently_at_hand');
            $table->dropColumn('status');
        });
    }
}
