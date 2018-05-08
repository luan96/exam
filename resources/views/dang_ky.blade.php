<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Đăng Ký</title>
  <link rel="icon" type="image/jpg" href="{{ asset('images/icons/favicon.ico') }}"/>
  <!-- <link rel="stylesheet" href="/animate.css"> -->
  <link rel="stylesheet" href="{{ asset('/dangky_css/style_sign_up.css') }}">
  <link rel="stylesheet" href="{{ asset('/dangky_css/dangky.css') }}">
  <script src="{{ asset('/bootstrap/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('/bootstrap/js/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('/js/validate-form.js') }}"></script>
  <script src="{{ asset('/js/logout.js') }}"></script>
</head>
<body>
<div class="container">
  <div class="login-box animated fadeInUp">
    <div class="box-header">
      <h2>Đăng ký</h2>
    </div>
    {{ Form::open(['id'=>'form-signin']) }}
    <div class="error">
    {{Session::get('create_user')}}
    {{--{{Session::get('login_faiure')}}--}}
    {{--{{Session::get('password_conf')}}--}}
    {{--{{Session::get('error_dangky')}}--}}
    </div>
    <table>
      <tbody>
      <tr>
        <td class="sign_up">
          {{ Form::label('Username', 'Tên đăng nhập:') }}
        </td>
        <td>
          {{ Form::text('username', '', ['class' => 'w100pt']) }}
        </td>
      </tr>
      <tr>
        <td class="sign_up">
          {{ Form::label('password', 'Mật khẩu:') }}
        </td>
        <td>
          {{ Form::password('password', ['class' => 'w100pt']) }}
        </td>
      </tr>
      <tr>
        <td class="sign_up">
          {{ Form::label('password_confirmation', 'Xác nhận mật khẩu:') }}
        </td>
        <td>
          {{ Form::password('password_confirmation', ['class' => 'w100pt']) }}
        </td>
      </tr>
      <tr>
        <td class="sign_up">
          {{ Form::label('name', 'Tên thí sinh:') }}
        </td>
        <td>
          {{ Form::text('name', '', ['class' => 'w100pt']) }}
        </td>
      </tr>
      <tr>
        <td class="sign_up">
          {{ Form::label('birthday', 'Ngày sinh:') }}
        </td>
        <td>
          {{ Form::date('birthday', '', ['class' => 'w100pt']) }}
        </td>
      </tr>
      {{--<tr>--}}
        {{--<td class="sign_up">--}}
          {{--{{ Form::label('email', 'Email:') }}--}}
        {{--</td>--}}
        {{--<td>--}}
          {{--{{ Form::email('email', '', ['class' => 'w100pt', 'disabled']) }}--}}
        {{--</td>--}}
      {{--</tr>--}}
      <tr>
        <td class="sign_up avatar">
          {{ Form::label('avatar', 'Hình ảnh:') }}
        </td>
        <td>
          {{ Form::file('avatar', ['class' => 'w100pt', 'onchange' => 'image.handleFiles(this.files)']) }}
          <div id="show_image"></div>
        </td>
      </tr>
      </tbody>
    </table>
    <p class="dangky">
      {{ Form::submit('Đăng ký') }}
    </p>
    {{ Form::close() }}
    <a href="{{ asset('/login') }}">Đăng_nhập</a>
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