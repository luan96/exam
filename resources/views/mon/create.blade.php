@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down4"></div>
    {{ Form::open(['id' => 'form-create-mon']) }}
    <label class="lb">
      Môn thi > <b class="head_content_color">Thêm môn thi</b>
    </label>
    <h1><b>Thêm Môn Thi</b></h1>
    <hr>
    <div class="well container">
      <div class="input">
        <p>
          {{ Form::label('name', 'Tên môn thi:') }}
          {{ Form::text('name', '', ['class' => 'form-control']) }}
        </p>
      </div>
      <hr>
      <div class="submit">
        <p>{{ Form::submit('Thêm môn') }}</p>
      </div>
    </div>
    {{ Form::close() }}
  </div>
@endsection