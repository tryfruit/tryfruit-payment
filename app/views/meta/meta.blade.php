<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="chrome-webstore-item" href="https://chrome.google.com/webstore/detail/cgmdkfkbilmbclifhmfgabbkkcfjcicp">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <title>
      TryFruit Kóder Akadémia
      @if (trim($__env->yieldContent('pageTitle')))
        | @yield('pageTitle')
      @endif
    </title>

    @section('stylesheet')
      <!-- Fonts -->
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
      <!-- /Fonts -->

      <!-- General CSS -->
      {{ HTML::style('css/bootstrap.min.css' ) }}
      {{ HTML::style('css/jquery.growl.css') }}
      {{ HTML::style('css/custom.css') }}
      <!-- /General CSS -->

      <!-- Font Awesome CSS -->
      {{ HTML::style('css/font-awesome.min.css') }}
      <!-- /Font Awesome CSS -->

      <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <![endif]-->

      <!-- Page specific stylesheet -->
      @section('pageStylesheet')
      @show
      <!-- /Page specific stylesheet -->
    @show
    
    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
    n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
    document,'script','//connect.facebook.net/en_US/fbevents.js');

    fbq('init', '1589324797954727');
    fbq('track', "PageView");</script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1589324797954727&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->


  </head>


  @section('body')

  @show

  @section('scripts')
    <!-- General JS -->
    {{ HTML::script('js/jquery.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/jquery.growl.js') }}
     
    <!-- /General JS -->

    <!-- Page specific modals -->
    @section('pageModals')
    @show
    <!-- /Page specific modals -->

    <!-- Page specific scripts -->
    @section('pageScripts')
    @show
    <!-- /Page specific scripts -->

    <!-- Widget specific scripts -->
    @section('widgetScripts')
    @show
    <!-- /Widget specific scripts -->

    <!-- Page alerts -->
    @section('pageAlert')
      @include('meta.page-alerts')
    @show
    <!-- /Page alerts --> 
  @show

</html>
