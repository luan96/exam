{{--@extends('layouts.index')--}}
@extends('exams.exam')

@section('content')
  <div class="col-sm-10 text-left">
    {{ Form::open(['id' => 'form-sua-user']) }}
    <h1>Sửa thông tin</h1>
    <hr>
    <div class="well container">
      <div class="input">
        <p>
          {{ Form::label('Username', 'Tên đăng nhập:') }}
          <span class="btn btn-primary default sua-user">
			        		<b>{{ $user->username }}</b>
			        	</span>
        </p>
        <p>
          {{ Form::label('password', 'Mật khẩu:') }}
          {{--{{Session::get('pass')}}--}}
          <br/>
          {{ Form::password('password', ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('password_confirmation', 'Xác nhận mật khẩu:') }}
          {{--{{Session::get('pass_conf')}}--}}
          <br/>
          {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('Name', 'Tên:') }}
          <br/>
          {{ Form::text('name', $user->name, ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('birthday', 'Ngày sinh:') }}
          <br/>
          {{ Form::date('birthday', $user->birthday, ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('Role', 'Quyền:') }}
          <span class="btn btn-primary default sua-role">
            <b>{{ $role->roles->name }}</b>
          </span>
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
        <p>{{ Form::submit('Cập nhật') }}</p>
      </div>
    </div>
    {{ Form::close() }}
  </div>

@endsection