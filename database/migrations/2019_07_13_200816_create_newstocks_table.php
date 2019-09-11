<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewstocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newstocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('stockid');
            $table->string('name');
            $table->string('sprice');
            $table->string('cprice');
            $table->string('quantity');
            $table->string('exp');
            $table->string('identity');
            $table->string('status')->default(0);
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
        Schema::dropIfExists('newstocks');
    }
}
