<?php

class PlanSeeder extends Seeder
{

    public function run()
    {
        Plan::updateOrCreate(
            ['name' => 'Premium'], 
            array(
                'name'                          => 'Premium',
                'amount'                        => $_ENV['BRAINTREE_PREMIUM_PLAN_PRICE'],
                'braintree_plan_id'             => $_ENV['BRAINTREE_PREMIUM_PLAN_ID'],
                'braintree_merchant_account_id' => $_ENV['BRAINTREE_MERCHANT_ACCOUNT_ID'],
                'braintree_merchant_currency'   => $_ENV['BRAINTREE_MERCHANT_CURRENCY'],
                'description'                   => ''
            )
        );

        /* Send message to console */
        Log::info('PlanSeeder | All Plans updated');

    }

} /* PlanSeeder */