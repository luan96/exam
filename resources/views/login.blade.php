<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="icon" type="image/jpg" href="images/icons/favicon.ico"/>
  <script src="/bootstrap/js/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="{{ asset('/login_css/style_login.css') }}">
  <link rel="stylesheet" href="{{ asset('/login_css/login.css') }}">

  <script src="{{ asset('/bootstrap/js/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('/js/validate-form.js') }}"></script>
</head>

<body>
<div class="container">
  <div class="login-box animated fadeInUp">
    <div class="box-header">
      <h2>Login</h2>
    </div>
    {{ Form::open(['id' => 'form-login']) }}
    <div class="error">
      {{Session::get('login_faiure')}}
    </div>
    <p class="login-display">
      {{ Form::label('Username', 'Username:') }}
      {{ Form::text('username')}}
    </p>
    <p class="login-display">
      {{ Form::label('password', 'Password:') }}
      {{ Form::password('password') }}
    </p>
    <p class="login">
      {{ Form::submit('Login') }}
    </p>
    {{ Form::close() }}
    <a href="{{ asset('/dangky')}}">Sign_up</a>
  </div>
</div>
</body>

<script>
  $(document).ready(function () {
    $('#logo').addClass('animated fadeInDown');
    $("input:text:visible:first").focus();
  });
  $('#username').focus(function () {
    $('label[for="username"]').addClass('selected');
  });
  $('#username').blur(function () {
    $('label[for="username"]').removeClass('selected');
  });
  $('#password').focus(function () {
    $('label[for="password"]').addClass('selected');
  });
  $('#password').blur(function () {
    $('label[for="password"]').removeClass('selected');
  });
</script>

</html>