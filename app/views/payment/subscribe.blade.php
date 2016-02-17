@extends('meta.base')

  @section('pageTitle')
    Fizetés
  @stop

  @section('pageStylesheet')
  @stop

  @section('pageContent')
    <div class="vertical-center">
      <div class="container">

        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div id="subscription-panel" class="panel panel-default panel-transparent">
              <div  class="panel-body text-center">
                <form id="checkout" action="{{ route('payment.subscribe') }}" method="post">
                  Number <input class="form-control" data-braintree-name="number" value="4111111111111111">
                  cvv <input class="form-control" data-braintree-name="cvv" value="100">

                  expiration date <input class="form-control" data-braintree-name="expiration_date" value="10/20">

                  cardholder name <input class="form-control" data-braintree-name="cardholder_name" value="John Smith">

                  email address <input name="email" class="form-control" value="hello@tryfruit.com">

                  <input type="submit" id="submit" value="Fizetés">
                </form>
              </div> <!-- /.panel-footer -->
              <div class="panel-footer text-center">
                We process your payment using Braintree.<br>
                You will be charged the same day every month. <br>
                You can cancel any time.
              </div> <!-- /.panel-footer -->
            </div> <!-- /.panel -->
          </div> <!-- /.col-md-6 -->
        </div> <!-- /.row -->

      </div> <!-- /.container -->
    </div> <!-- /.vertical-center -->
  @stop

  @section('pageScripts')
    <script src="https://js.braintreegateway.com/v2/braintree.js"></script>
    <script>
        // Generated client token
        var clientToken = "{{ Braintree_ClientToken::generate() }}";

        // Initialize payment form
        braintree.setup(clientToken, "custom", {id: "checkout"});
    </script>
  @stop



