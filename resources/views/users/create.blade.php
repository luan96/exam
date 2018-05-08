@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down"></div>
    {{ Form::open(['id'=>'form-create-user']) }}
    <h1>Thêm User</h1>
    <hr>
    <div class="well container">
      <div class="input">
      <!-- <p class="text-center">{{Session::get('error_user')}}</p> -->
        <p>
          {{ Form::label('Username', 'Tên đăng nhập:') }}
          {{Session::get('create_user')}}
          <br/>
          {{ Form::text('username', '', ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('password', 'Mật khẩu:') }}
          <br/>
          {{ Form::password('password', ['class' => 'form-control']) }}
        </p>
        <p>
        {{ Form::label('password_confirmation', 'Xác nhận mật khẩu:') }}
        <!-- {{Session::get('password_conf')}} -->
          <br/>
          {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('Name', 'Tên người dùng:') }}
          <br/>
          {{ Form::text('name', '', ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('birthday', 'Ngày sinh:') }}
          <br/>
          {{ Form::date('birthday', '', ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('Role', 'Quyền:') }}
          <br/>
          {{ Form::select('role', $listrole, '', ['class' => 'form-control']) }}

        </p>
      </div>
      <div class="image">
        {{ Form::label('Avatar', 'Ảnh đại diện:') }}
        <br>
        {{ Form::file('avatar', ['onchange' => 'user.handleFiles(this.files)', 'class' => 'upload-image']) }}
        <div id="show_image" class="text-center">
        </div>
      </div>
      <div class="submit">
        <p>{{ Form::submit('Thêm user') }}</p>
      </div>
    </div>
    {{ Form::close() }}
  </div>
@endsection