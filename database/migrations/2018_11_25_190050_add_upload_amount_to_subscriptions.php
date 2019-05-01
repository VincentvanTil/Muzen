<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUploadAmountToSubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscriptions', function(Blueprint $table) {
			$table->integer('amount');
			$table->dropColumn('name');
			$table->integer('user_id')->unsigned();
		});
		Schema::table('subscriptions', function (Blueprint $table) {
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
		Schema::table('subscriptions', function(Blueprint $table) {
			$table->dropColumn('amount');
			$table->string('name', 1);
		});
    }
}
