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

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->integer('plan_id')->unsigned();
            $table->foreign('plan_id')
                  ->references('id')->on('plans');

            $table->enum('status', array('active', 'ended', 'canceled'));
            
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
