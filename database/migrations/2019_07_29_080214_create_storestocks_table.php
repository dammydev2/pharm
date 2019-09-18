<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStorestocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storestocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('cprice');
            $table->string('quantity');
            $table->string('exp');
            $table->string('pack');
            $table->string('autenticate');
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
        Schema::dropIfExists('storestocks');
    }
}
