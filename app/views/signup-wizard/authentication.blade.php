@extends('meta.base-user-signout')

    @section('pageTitle')
        Signup | Authentication
    @stop

    @section('pageStylesheet')

    @stop

    @section('pageContent')

    <body>

    <div class="vertical-center">
        <div class="container">
            <!-- name -->
            <div class="yourname-form">
              <h1 class="text-white text-center drop-shadow">
                  Üdvözlünk a tryFruit Kóder Akadémián!
              </h1>
              <h1 class="text-white text-center drop-shadow">
                  Hogy szólíthatunk?
              </h1>

              <!-- Form -->
              {{ Form::open(array('route' => 'signup-wizard.authentication', 'id' => 'signup-form-id' )) }}
              {{ Form::text('name', Input::old('name'), array('autofocus' => true, 'autocomplete' => 'off', 'class' => 'form-control input-lg text-white drop-shadow text-center greetings-name', 'id' => 'username_id')) }}
            </div>

            <!-- email -->
            <div class="youremail-form not-visible">
              <h1 class="text-white text-center drop-shadow">
                  Szia <span class="username"></span>.
              </h1>
              <h1 class="text-white text-center drop-shadow">
                  Mi az email címed?
              </h1>

              <!-- Stop Chrome from ignoring autocomplete -->
              <input style="display:none">
              <input type="password" style="display:none">

              <div class="form-group">
                  {{ Form::text('email', Input::old('email'), array('autocomplete' => 'off', 'autocorrect' => 'off', 'class' => 'form-control input-lg text-white drop-shadow text-center greetings-name', 'id' => 'email_id')) }}
              </div>
            </div>

            <div class="form-actions hidden-form not-visible">
                {{ Form::submit('Next' , array(
                    'id' => 'id_next',
                    'class' => 'btn btn-success pull-right',
                    'onClick' => '')) }}
            </div> <!-- / .form-actions -->

            {{ Form::close() }}

        </div> <!-- /.container -->
    </div> <!-- /.vertical-center -->

    </body>

    @stop

    @section('pageScripts')
    <script type="text/javascript">
        $(document).ready(function() {

          $('#username_id').on('keydown', function (event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13' || keycode == '9'){
              event.preventDefault();
                if ($('#username_id').val()) {
                    $('.yourname-form').slideUp('fast', function (){
                      $('.youremail-form').find('span.username').html(' ' + $('#username_id').val());
                      $('.youremail-form').slideDown('fast', function() {
                        $('#email_id').focus();
                      });
                    });
                } else {
                  easyGrowl('warning', "Kérlek írd be a neved a folytatáshoz.", 5000);
                }
            }
          });

          function IsEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
          }

          $('#email_id').on('keydown', function (event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13' || keycode == '9'){
              event.preventDefault();
              if ($('#email_id').val() && IsEmail($('#email_id').val())) {

                $('#signup-form-id').submit();
              } else {
                easyGrowl('warning', "Kérlek valós email címet adj meg.", 5000);
              }

            }
          });
        });
    </script>

    @stop