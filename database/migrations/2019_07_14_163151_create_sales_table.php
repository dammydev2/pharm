<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('stockid');
            $table->string('name');
            $table->string('sprice');
            $table->string('cprice');
            $table->string('quantity');
            $table->string('identity');
            $table->string('rec');
            $table->string('return')->default(0);
            $table->timestamps();
        });
        // Insert some stuff
    DB::table('sales')->insert(
        array(
            'stockid' => '1',
            'name' => '1',
            'sprice' => '1',
            'cprice' => '1',
            'quantity' => '1',
            'identity' => '1',
            'rec' => '1',
        )
    );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
