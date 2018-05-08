@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down3"></div>
    {{ Form::open(['id' => 'form-create-cauhoi']) }}
    <label class="lb">
      Câu hỏi >
      <b class="head_content_color">Câu hỏi {{Session::get('loaicauhoi')}}</b>
      > Thêm câu hỏi
    </label>
    <h1><b>Thêm Câu hỏi</b></h1>
    <hr>
    <div class="well container">
      <div class="input">
        {{--{{ Session::get('error_cauhoi') }}--}}
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
        <p>
          {{ Form::label('noidung', 'Nội dung:') }}
          <br/>
          {{ Form::textarea('noidung', '', ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('diem', 'Điểm:') }}
          {{ Form::text('diem', '', ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('cacphuongan', 'Các phương án:') }}

          @include('cauhoi.loaicauhoi.create_loai')
        </p>
      </div>
      <div class="submit">
        <p>{{ Form::submit('Thêm câu hỏi') }}</p>
      </div>
    </div>
    {{ Form::close() }}
    <script>
      $( document ).ready( function() {
        $( '#noidung' ).ckeditor();
      } );
    </script>
  </div>
@endsection