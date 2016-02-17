<?php

class Subscription extends Eloquent
{
    /* -- Fields -- */
    protected $guarded = array(
        'braintree_customer_id',
        'braintree_payment_method_token',
        'braintree_subscription_id'
    );

    protected $fillable = array(
        'amount',
        'braintree_plan_id',
        'braintree_merchant_account_id',
        'braintree_merchant_currency',
    );


    /**
     * ================================================== *
     *                   PUBLIC SECTION                   *
     * ================================================== *
     */

    /**
     * doBraintreeSubscription
     * --------------------------------------------------
     * @param (string)  ($paymentMethodNonce) The authorization token for the payment
     * @param (array)   ($userInput)          The extra user input
     * @return Creates a Braintree Subscription and charges the user
     * --------------------------------------------------
     */
    public function doBraintreeSubscription($paymentMethodNonce, $userInput) {
        /* Initialize variables */
        $result = ['errors' => false, 'messages' => ''];

        /* Get customer and update Braintree payment fields */
        $result = $this->getBraintreeCustomer($paymentMethodNonce, $userInput);

        /* Create new Braintree subscription and update in DB */
        if ($result['errors'] == false) {
            $result = $this->createBraintreeSubscription();
        }

        /* Return the updated result */
        return $result;
    }

    /**
     * ================================================== *
     *                   PRIVATE SECTION                  *
     * ================================================== *
     */

    /**
     * getBraintreeCustomer
     * --------------------------------------------------
     * @param (string) ($paymentMethodNonce) The authorization token for the payment
     * @param (array)  ($userInput)          The extra input for the user
     * @return Creates a Braintree Subscription, from this object.
     * --------------------------------------------------
     */
    private function getBraintreeCustomer($paymentMethodNonce, $userInput) {
        /* Initialize variables */
        $result = ['errors' => false, 'messages' => ''];

        /* Get or create the Braintree customer */
        /* Get existing customer */
        try {
            /* Customer ID is not set, proceed with create */
            if ($this->braintree_customer_id == null) {
                throw new Braintree_Exception_NotFound;
            }

            /* Get the customer */
            $customer = Braintree_Customer::find($this->braintree_customer_id);

            /* Create new paymentmethod with the current data */
            $paymentMethodResult = Braintree_PaymentMethod::create([
                'customerId' => $customer->id,
                'paymentMethodNonce' => $paymentMethodNonce,
                'options' => [
                    'verifyCard' => true
                ]
            ]);

            /* Card verification failed */
            if (!$paymentMethodResult->success) {
                $verification = $paymentMethodResult->creditCardVerification;
                $result['errors'] |= true;
                $result['messages'] .= 'Sorry, your credit card cannot be verified. ' . $verification->processorResponseText;
            } else {
                /* Update braintree customer and payment information */
                $this->braintree_customer_id = $customer->id;
                $this->braintree_payment_method_token = $paymentMethodResult->paymentMethod->token;
                $this->save();
            }

            /* Return result */
            return $result;

        /* No customer found with the ID, create a new */
        } catch (Braintree_Exception_NotFound $e) {
            /* Create new customer */
            $customerResult = Braintree_Customer::create([
                'email' => $userInput['email'],
                'paymentMethodNonce' => $paymentMethodNonce,
            ]);

            /* Success */
            if ($customerResult->success) {
                /* Store braintree customer and payment information */
                $this->braintree_customer_id = $customerResult->customer->id;
                $this->braintree_payment_method_token = $customerResult->customer->paymentMethods()[0]->token;
                $this->save();

            /* Error */
            } else {
                /* Get and store errors */
                foreach($customerResult->errors->deepAll() AS $error) {
                    $result['errors'] |= true;
                    $result['messages'] .= $error->code . ": " . $error->message . ' ';
                }
            }

            /* Return result */
            return $result;
        }
    }

    /**
     * createBraintreeSubscription
     * --------------------------------------------------
     * @return Creates a Braintree Subscription, from this object.
     * --------------------------------------------------
     */
    private function createBraintreeSubscription() {
        /* The function assumes, that everything is OK to charge the user on Braintree */

        /* Initialize variables */
        $result = ['errors' => false, 'messages' => ''];

        /* Create Braintree subscription */
        $subscriptionResult = Braintree_Subscription::create([
          'paymentMethodToken' => $this->braintree_payment_method_token,
          'merchantAccountId' => $this->braintree_merchant_account_id,
          'planId' => $this->braintree_plan_id
        ]);

        /* Success */
        if ($subscriptionResult->success) {
            /* Change the subscription plan */
            $this->braintree_subscription_id  = $subscriptionResult->subscription->id;
            /* Save object */
            $this->save();

        /* Error */
        } else {
            /* Get and store errors */
            foreach($subscriptionResult->errors->deepAll() AS $error) {
                $result['errors'] |= true;
                $result['messages'] .= $error->code . ": " . $error->message . ' ';
            }
            Log::error($subscriptionResult->transaction->status);
        }

        /* Return result */
        return $result;
    }
}
