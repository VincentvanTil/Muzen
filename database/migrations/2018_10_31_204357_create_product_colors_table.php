<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_colors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('color_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('product_colors', function (Blueprint $table) {
            $table->foreign('color_id')->references('id')->on('colors')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_colors', function(Blueprint $table)
        {
            $table->dropForeign('colors_id');
            $table->dropForeign('product_id');
        });
        Schema::dropIfExists('product_colors');
    }
}
