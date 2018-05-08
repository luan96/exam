@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down4"></div>
    {{ Form::open(['id' => 'form-edit-mon']) }}
    <label class="lb">
      Môn thi > <b class="head_content_color">Sửa môn thi</b>
    </label>
    <h1><b>Sửa Môn Thi</b></h1>
    <hr>
    <div class="well container">
      <div class="input">
        <p>
          {{ Form::label('ID', 'ID:') }}
          <span class="btn btn-primary default edit-dethi">
			        		<b>{{$mon->id}}</b>
			        	</span>
        </p>
        <p>
          {{ Form::label('name', 'Tên môn thi:') }}
          {{ Form::text('name', $mon->name, ['class' => 'form-control']) }}
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