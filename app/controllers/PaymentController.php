<?php


/**
 * --------------------------------------------------------------------------
 * PaymentController: Handles the pricing, subscriptions and payment related sites
 * --------------------------------------------------------------------------
 */
class PaymentController extends BaseController
{
    /**
     * ================================================== *
     *                   PUBLIC SECTION                   *
     * ================================================== *
     */

   /**
     * getSubscribe
     * --------------------------------------------------
     * @return Renders the subscription page and redirects on error
     * --------------------------------------------------
     */
    public function getSubscribe() {
        /* Render the view */
        return View::make('payment.subscribe');
    }


    /**
     * postSubscribe
     * --------------------------------------------------
     * @param (integer) ($planID) The requested Plan ID
     * @return Subscribes the user to the selected plan.
     * --------------------------------------------------
     */
    public function postSubscribe() {
        /* Check for payment_method_nonce in input */
        if (!Input::has('payment_method_nonce')) {
            return Redirect::route('payment.subscribe')
                ->with('error', "Something went wrong with your request, please try again.");
        }

        /* Create new subscription plan */
        $subscription = new Subscription(array(
            'amount'                        => $_ENV['BRAINTREE_PREMIUM_PLAN_PRICE'],
            'braintree_plan_id'             => $_ENV['BRAINTREE_PREMIUM_PLAN_ID'],
            'braintree_merchant_account_id' => $_ENV['BRAINTREE_MERCHANT_ACCOUNT_ID'],
            'braintree_merchant_currency'   => $_ENV['BRAINTREE_MERCHANT_CURRENCY'],
        ));

        /* Get the extra user input from the form */
        $userInput = array(
            'email' => Input::get('email'),
        );

        /* Do Braintree subscription */
        $result = $subscription->doBraintreeSubscription(Input::get('payment_method_nonce'), $userInput);

        /* Check errors */
        if ($result['errors'] == false) {
            /* Return with success */
            return Redirect::route('payment.success')
                ->with('success', 'A fizetés sikeres volt.');
        } else {
            /* Return with errors */
            return Redirect::route('payment.subscribe')
                ->with('error', $result['messages']);
        }
    }

    /**
      * getSuccess
      * --------------------------------------------------
      * @return Renders the success page
      * --------------------------------------------------
      */
     public function getSuccess() {
         /* Render the view */
         return View::make('payment.success');
     }

} /* PaymentController */
