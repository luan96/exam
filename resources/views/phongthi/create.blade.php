@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down4"></div>
    {{ Form::open(['id' => 'form-create-phongthi']) }}
    <label class="lb">
      Phòng thi > <b class="head_content_color">Thêm phòng thi</b>
    </label>
    <h1><b>Thêm Phòng Thi</b></h1>
    <hr>
    <div class="well container">
      <div class="input">
        <p>
          {{ Form::label('name', 'Tên phòng thi:') }}
          {{ Form::text('name', '', ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('ip_begin', 'IP bắt đầu:') }}
          {{--{{ Form::text('ip_begin', '', ['class' => 'form-control', 'placeholder' => 'xxx.xxx.xxx.xxx']) }}--}}
          <input class="form-control" name="ip_begin" id="ip_begin" required pattern="^([0-9]{1,3}\.){3}[0-9]{1,3}$">
        </p>
        <p>
          {{ Form::label('ip_end', 'IP kết thúc:') }}
          {{--{{ Form::text('ip_end', '', ['class' => 'form-control', 'placeholder' => 'xxx.xxx.xxx.xxx']) }}--}}
          <input class="form-control" name="ip_end" id="ip_end" required pattern="^([0-9]{1,3}\.){3}[0-9]{1,3}$">
        </p>
      </div>
      <hr>
      <div class="submit">
        <p>{{ Form::submit('Thêm phòng thi') }}</p>
      </div>
    </div>
    {{ Form::close() }}
  </div>
@endsection