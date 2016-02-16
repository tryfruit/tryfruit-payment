<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('plans',function($table) {
            $table->increments('id');
            $table->string('name', 127);
            $table->longtext('description')->nullable();
            $table->float('amount');
            $table->string('braintree_plan_id', 128)->nullable();
            $table->string('braintree_merchant_account_id', 128)->nullable();
            $table->string('braintree_merchant_currency', 3)->nullable();
        });
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('plans');
    }
}
