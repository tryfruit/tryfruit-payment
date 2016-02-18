@extends('meta.base')

  @section('pageTitle')
    Beiratkozás
  @stop

  @section('pageStylesheet')
  @stop

  @section('pageContent')

  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Navigáció</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="https://itacademy.tryfruit.com">tryFruit IT akadémia</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Beiratkozás</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>

  <div class="container">
    <div class="row">
      
      <div class="col-md-12 text-center">
        <h1>Beiratkozás után azonnal kezdheted a tanulást</h1>  
      </div> <!-- /.col-md-12 -->
      
      <div class="row">
        <div class="col-sm-12 col-md-6 col-md-offset-3">

          <div class="panel panel-success no-bottom-margin">
            
            <div class="panel-heading text-center">
              <i class="fa fa-shield"></i> Bankkártyás fizetés
            </div>

            <div class="panel-body">
          
              <form id="checkout" action="{{ route('payment.subscribe') }}" method="post">

                <div class="row">
                  <div class="col-sm-12 form-group">
                    <label for="cardNumber" class="control-label">A bankkártyád száma</label>
                    <div class="controls">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="1234123412341234" data-braintree-name="number">
                        <span class="input-group-addon"><i class="fa fa-shield"></i></span>
                      </div>
                    </div>
                  </div> <!-- /.form-group -->  
                </div> <!-- /.row -->

                <div class="row">
                  <div class="col-sm-4 form-group">
                    <label for="expirationDate" class="control-label">Lejárati dátum (HH/ÉÉ)</label>
                    <input type="text" class="form-control" placeholder="03/18" data-braintree-name="expiration_date">
                  </div>

                  <div class="col-sm-4 col-sm-offset-4 form-group">
                    <label for="cvvCode" class="control-label">CVV kód</label>
                    <input type="text" class="form-control" placeholder="123" data-braintree-name="cvv">
                  </div>
                </div> <!-- /.row -->

                <div class="row">
                  <div class="col-sm-12 col-md-12 form-group">
                    <label for="name" class="control-label">Kártyabirtokos neve</label>
                    <input type="text" class="form-control" placeholder="Vezetéknév Keresztnév" data-braintree-name="cardholder_name">
                  </div> <!-- /.col-sm-10 -->
                </div> <!-- /.row -->

                <div class="row">
                  <div class="col-sm-12 col-md-12 form-group">
                    <label for="email" class="control-label">E-mail</label>
                    <input type="text" name="email" class="form-control" placeholder="email@cimem.hu">
                  </div> <!-- /.col-sm-10 -->
                </div> <!-- /.row -->

                <div class="row">
                  <div class="col-sm-12 col-md-12 form-group">
                    <label for="full_billing_address" class="control-label">Számlázási cím</label>
                    <input type="text" name="full_billing_address" class="form-control" placeholder="1111 Budapest, Petőfi Sándor utca 12.">
                  </div> <!-- /.col-sm-10 -->
                </div> <!-- /.row -->

                <div class="row">
                  <div class="col-sm-12 form-group">
                    <label for="price" class="control-label">A havi előfizetés ára</label>
                    <div class="col-sm-12">
                      <p class="form-control-static"><strong>2500 Ft</strong> </p>
                      <p> Az előfizetés minden hónap azonos napján automatikusan megújul, az összeg havonta levonásra kerül. Az előfizetés a hónap bármely napján azonnal lemondható emailben. A 60 napos pénzvisszafizetési garancia természetesen ekkor is él.</p>
                    </div>
                  </div> <!-- /.col-sm-10 -->
                </div> <!-- /.row -->

            </div> <!-- /.panel-body -->
          </div> <!-- /.panel -->

        </div> <!-- /.col-md-6 -->
      </div> <!-- /.row -->

      <div class="row">
        <div class="col-md-12 text-center">
          <div class="arrow-down"></div>
          <button type="submit" class="btn btn-success btn-lg">Fizetek</button>
        </div> <!-- /.col-md-12 -->
      </div> <!-- /.row -->
      
    </form>

    <div class="row text-center">
      <hr />
      <div class="col-md-4">
        <p class="text-info">
          <i class="fa fa-3x fa-lock"></i>
        </p>
        <h3>Biztonság</h3>
        <p class="lead">
          A fizetés titkosított adatkapcsolaton keresztül,
          a bankod által visszakereshető módon történik.
        </p>
      </div> <!-- /.col-md-4 -->
      <div class="col-md-4">
        <p class="text-info">
          <i class="fa fa-3x fa-money"></i>
        </p>
        <h3>Garancia</h3>
        <p class="lead">
          60 napos pénzvisszafizetési garancia:
          kérdés nélkül visszaadjuk a pénzedet,
          ha nem vagy elégedett.
        </p>
      </div> <!-- /.col-md-4 -->
      <div class="col-md-4">
        <p class="text-info">
          <i class="fa fa-3x fa-graduation-cap"></i>
        </p>
        <h3>Személyes kapcsolat</h3>
        <p class="lead">
          24 órán belül személyes kapcsolat
          a tanárainkkal.
        </p>
      </div> <!-- /.col-md-4 -->
    </div> <!-- /.row -->

    <div class="row text-center">
      <div class="col-md-4">
        <p class="text-info">
          <i class="fa fa-3x fa-cc-mastercard"></i>
        </p>
        <h3>Univerzális</h3>
        <p class="lead">
          MasterCard, Visa és American Express kártyákat is elfogadunk.
        </p>
      </div> <!-- /.col-md-4 -->
      <div class="col-md-4">
        <p class="text-info">
          <i class="fa fa-3x fa-paypal"></i>
        </p>
        <h3>Megbízhatóság</h3>
        <p class="lead">
          A fizetés a Braintree segítségével történik,
          amelyet a PayPal szakemberei fejlesztettek.
        </p>
      </div> <!-- /.col-md-4 -->
      <div class="col-md-4">
        <p class="text-info">
          <i class="fa fa-3x fa-shield"></i>
        </p>
        <h3>Adatvédelem</h3>
        <p class="lead">
          A fizetési adatok nem érkeznek meg hozzánk,
          azokat egyből továbbítjuk a fizetési szolgáltatónak.
        </p>
      </div> <!-- /.col-md-4 -->
    </div> <!-- /.row -->
  </div> <!-- /.row -->

  </div> <!-- /.container -->

  <footer class="footer">
    <div class="container">
      <p class="text-muted">2016. tryFruit &copy; Észrevételeket, javaslatokat szívesen fogadunk a <a href="mailto:hello@tryfruit.com?Subject=Beiratkoz&#225;s" target="_top">hello@tryfruit.com címen.</a></p>
    </div>
  </footer>

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



