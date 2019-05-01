<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('product_categories', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_categories', function(Blueprint $table)
        {
            $table->dropForeign('category_id');
            $table->dropForeign('product_id');
        });
        Schema::dropIfExists('product_categories');
    }
}
