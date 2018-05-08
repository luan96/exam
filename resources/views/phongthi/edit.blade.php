@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down4"></div>
    {{ Form::open(['id' => 'form-edit-phongthi']) }}
    <label class="lb">
      Phòng thi > <b class="head_content_color">Sửa phòng thi</b>
    </label>
    <h1><b>Sửa Phòng Thi</b></h1>
    <hr>
    <div class="well container">
      <div class="input">
        <p>
          {{ Form::label('ID', 'ID:') }}
          <span class="btn btn-primary default edit-dethi">
			        		<b>{{$phongthi->id}}</b>
			        	</span>
        </p>
        <p>
          {{ Form::label('name', 'Tên phòng thi:') }}
          {{ Form::text('name', $phongthi->name, ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('ip_begin', 'IP bắt đầu:') }}
          {{ Form::text('ip_begin', $phongthi->IP_begin, ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('ip_end', 'IP kết thúc:') }}
          {{ Form::text('ip_end', $phongthi->IP_end, ['class' => 'form-control']) }}
        </p>
      </div>
      <hr>
      <div class="submit">
        <p>{{ Form::submit('Cập nhật') }}</p>
      </div>
    </div>
    {{ Form::close() }}
  </div>
@endsection