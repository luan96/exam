@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down"></div>
    {{ Form::open(['id' => 'form-edit-user']) }}
    <h1>Sửa User</h1>
    <hr>
    <div class="well container">
      <div class="input">
        <p>
          {{ Form::label('ID', 'ID:') }}
          <span class="btn btn-primary default sua-user">
			        		<b>{{$user->id}}</b>
			        	</span>
        </p>
        <p>
          {{ Form::label('Username', 'Tên đăng nhập:') }}
          {{Session::get('duplicate_user')}}
          <br/>
          {{ Form::text('username', $user->username, ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('password', 'Mật khẩu:') }}
          {{Session::get('pass')}}
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
          {{ Form::text('name', $user->name, ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('birthday', 'Ngày sinh:') }}
          <br/>
          {{ Form::date('birthday', $user->birthday, ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('Role', 'Quyền:') }}
          <br/>
          {{ Form::select('role', $listrole, $role_user->role_id, ['class' => 'form-control']) }}
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
        <p>{{ Form::submit('Cập nhật') }}</p>
      </div>
    </div>
    {{ Form::close() }}
  </div>

@endsection