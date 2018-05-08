@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down2"></div>
    {{ Form::open(['id' => 'form-create-dethi']) }}
    <label class="lb">Đề thi > <b class="head_content_color">Thêm đề thi</b> > Thêm câu hỏi</label>
    <h1><b>Thêm Đề Thi</b></h1>
    <hr>
    <div class="well container">
      <div class="input">
        {{--{{ Session::get('error_dethi') }}--}}
        <p>
          {{ Form::label('name', 'Tên đề thi:') }}
          {{ Form::text('name', '', ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('mon', 'Môn:') }}
          <br/>
          {{ Form::select('mon', $listmon, '', ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('phanloai', 'Phân loại:') }}
          <br/>
          {{ Form::select('phanloai', $listphanloai, '', ['class' => 'form-control']) }}
        </p>
      </div>
      <hr>
      <div class="submit">
        <p>{{ Form::submit('Thêm câu hỏi', ['class' => 'w13pt']) }}</p>
      </div>
    </div>
    {{ Form::close() }}
  </div>
@endsection