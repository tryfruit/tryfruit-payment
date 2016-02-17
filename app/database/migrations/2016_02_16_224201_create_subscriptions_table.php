<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('subscriptions',function($table) {
            $table->increments('id');
            $table->float('amount');
            $table->string('braintree_plan_id', 128)->nullable();
            $table->string('braintree_merchant_account_id', 128)->nullable();
            $table->string('braintree_merchant_currency', 3)->nullable();
            $table->string('braintree_customer_id', 255)->nullable();
            $table->string('braintree_payment_method_token', 255)->nullable();
            $table->string('braintree_subscription_id', 255)->nullable();
            $table->timestamps();
        });
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('subscriptions');
    }

}
