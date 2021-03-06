@extends('meta.base')

  @section('pageTitle')
    Sikeres fizetés
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
              <li class="active"><a href="#">Üdvözlünk</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </nav>

      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1>Üdv a fedélzeten!</h1>
            <div class="alert alert-success" role="alert">
              <p class="lead">
                Köszönjük, a bankkártyás fizetés sikeres volt.
              </p>              
            </div>
          </div> <!-- /.col-md-12 -->
        </div> <!-- /.row -->
        <hr />
        <div class="row">
          <div class="col-md-12">
            <img src="/img/fruit_line.png" class="img-responsive center-block"/>
          </div> <!-- /.col-md-12 -->
        </div> <!-- /.row -->
        <hr />
        <div class="row">
          <div class="col-md-8 col-md-offset-2 well text-center">
            <p class="lead">
              Amint a befizetésed megérkezik hozzánk (de legkésőbb 24 órán belül) emailben felvesszük veled a kapcsolatot.
            </p>
            <p>
              Ha addig is bármilyen észrevételed, javaslatod van, szívesen fogadjuk a <a href="mailto:hello@tryfruit.com" target="_top">hello@tryfruit.com</a> címen.
            </p>
          </div> <!-- /.col-md-8 -->
        </div> <!-- /.row -->
      </div> <!-- /.container -->

      <footer class="footer">
        <div class="container">
          <p class="text-muted">2016. tryFruit &copy; Észrevételeket, javaslatokat szívesen fogadunk a <a href="mailto:hello@tryfruit.com?Subject=Beiratkoz&#225;s" target="_top">hello@tryfruit.com</a> címen.</p>
        </div>
      </footer>
  @stop

  @section('pageScripts')
  @stop



