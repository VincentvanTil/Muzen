<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ordernumber', 45);
            $table->integer('address_id')->unsigned();
            $table->integer('shipping_method')->unsigned();
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('address_id')->references('id')->on('addresses')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('shipping_method')->references('id')->on('shipping_methods')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function(Blueprint $table)
        {
            $table->dropForeign('address_id');
            $table->dropForeign('shipping_method');
        });
        Schema::dropIfExists('orders');
    }
}
