<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserToOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('orders', function (Blueprint $table) {
			$table->integer('user_id')->nullable()->unsigned();
		});
		Schema::table('orders', function (Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('orders', function (Blueprint $table) {
			$table->dropForeign('user_id');
			$table->dropColumn('user_id');
		});
    }
}
