<?php


/**
 * --------------------------------------------------------------------------
 * PaymentController: Handles the pricing, subscriptions and payment related sites
 * --------------------------------------------------------------------------
 */
class PaymentController extends BaseController
{
    private static $baseMessage = array(
        'text'       => "Payment notification",
        'username'   => "TryFruit Payment",
        'icon_emoji' => ':peach:',
    );

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
        /* Get the extra user input from the form */
        $userInput = array(
            'email' => Input::get('email'),
            'message' => '',
        );

        /* Send notification --> CLICK */
        $this->sendSlackNotification('payment-click', $userInput);

        /* Check for payment_method_nonce in input */
        if (!Input::has('payment_method_nonce')) {
            /* Send notification --> ERROR */
            $userInput['message'] = 'No payment nonce returned with the form.';
            $this->sendSlackNotification('payment-error', $userInput);
            /* Redirect to payment page */
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

        /* Do Braintree subscription */
        $result = $subscription->doBraintreeSubscription(Input::get('payment_method_nonce'), $userInput);

        /* Check errors */
        if ($result['errors'] == false) {
            /* Send notification --> SUCCESS */
            $this->sendSlackNotification('payment-success', $userInput);

            /* Return with success */
            return Redirect::route('payment.success')
                ->with('success', 'A fizetés sikeres volt.');
        } else {
            /* Send notification --> ERROR */
            $userInput['message'] = $result['messages'];
            $this->sendSlackNotification('payment-error', $userInput);

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

    /**
     * ================================================== *
     *                  PRIVATE SECTION                   *
     * ================================================== *
     */
    /**
      * sendSlackNotification
      * --------------------------------------------------
      * @param (enum) ($msgType) The message type
      * @param (array) ($userInput) The extra input from the user
      * @return Sends a slack notification about the events
      * --------------------------------------------------
      */
    private function sendSlackNotification($msgType, $userInput) {
        /* Get the base message, create the attachment and merge with default message */
        $message = array_merge(
            self::$baseMessage,
            array('attachments' => $this->getSlackAttachments($msgType, $userInput))
        );

        /* Send Slack message */
        $this->sendSlackMessage($message);
    }

    /**
      * getSlackAttachments
      * --------------------------------------------------
      * @param (enum) ($msgType) The message type
      * @return Returns the attachment for the Slack message 
      * based on the type of the message
      * --------------------------------------------------
      */
    private function getSlackAttachments($msgType, $userInput) {
        /* Return based on message type */
        switch ($msgType) {
            case 'payment-click':
                return array(
                    array(
                        'color' => 'a9c8df',
                        'title' => 'Clicked on payment button',
                        'text'  => $userInput['email'] . ' | ' . $userInput['message'],
                    ),
                );
                break;
            case 'payment-success':
                return array(
                    array(
                        'color' => 'a9dfa9',
                        'title' => 'Successful payment',
                        'text'  => $userInput['email'] . ' | ' . $userInput['message'],
                    ),
                );
                break;
            case 'payment-error':
                return array(
                    array(
                        'color' => 'dfa9ae',
                        'title' => 'Payment error',
                        'text'  => $userInput['email'] . ' | ' . $userInput['message'],
                    ),
                );
                break;
            default:
                return array(
                    array(
                        'color' => 'dfa9ae',
                        'title' => 'Error in payment Slack message (undefined message type)',
                        'text'  => $userInput['email'] . ' | ' . $userInput['message'],
                    ),
                );              
                break;
        }
    }

/**
     * sendSlackMessage
     * --------------------------------------------------
     * Sends the welcome message to the connected slack channel
     * @param {array} message | The message array
     * @return {boolean} success | The curl execution success
     * --------------------------------------------------
     */
    private function sendSlackMessage($message) {
        /* Initializing cURL */
        $ch = curl_init($_ENV['SLACK_PAYMENT_WEBHOOK_URL']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        /* Populating POST data */
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(
            $message
        ));

        /* Sending request. */
        $success = curl_exec($ch);

        /* Cleanup and return. */
        curl_close($ch);
        return $success;
    }

} /* PaymentController */
