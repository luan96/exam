@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down3"></div>
    {{ Form::open(['id' => 'form-edit-cauhoi']) }}
    <label class="lb">
      Câu hỏi >
      <b class="head_content_color">Câu hỏi {{$cauhoi->loaicauhoi}}</b>
      > Sửa câu hỏi
    </label>
    <h1><b>Sửa Câu hỏi</b></h1>
    <hr>
    <div class="well container">
      <div class="input">
        <p>
          {{ Form::label('ID', 'ID:') }}
          <span class="btn btn-primary default sua-user">
			        		<b>{{$cauhoi->id}}</b>
			        	</span>
        </p>
        <p>
          {{ Form::label('mon', 'Môn:') }}
          <br/>
          {{ Form::select('mon', $listmon, $cauhoi->mamon, ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('phanloai', 'Phân loại:') }}
          <br/>
          {{ Form::select('phanloai', $listphanloai, $cauhoi->maphanloai, ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('noidung', 'Nội dung:') }}
          <br/>
          {{ Form::textarea('noidung', $cauhoi->noidung, ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('diem', 'Điểm:') }}
          {{ Form::text('diem', $cauhoi->diem, ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('dapan', 'Đáp án:') }}

          @include('cauhoi.loaicauhoi.edit_loai')
        </p>
      </div>
      <div class="submit">
        <p>{{ Form::submit('Update') }}</p>
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