@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down1"></div>
    {{ Form::open(['id' => 'form-create-kythi']) }}
    <label class="lb">
      Kỳ thi > <b class="head_content_color">Thêm kỳ thi</b> > Thêm đề thi > Thêm thí sinh
    </label>
    <h1><b>Thêm Kỳ Thi</b></h1>
    <hr>
    <div class="well container">
      <div class="input">
        <p class="text-center">
          {{--{{ Session::get('error_kythi') }}--}}
        </p>
        <p>
          {{ Form::label('name', 'Tên kỳ thi:') }}
          {{ Form::text('name', '', ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('begin', 'Thời gian bắt đầu:') }}
          <br/>
          <input id="begin" type="datetime-local" name="begin" class="form-control">
        </p>
        <p>
          {{ Form::label('end', 'Thời gian kết thúc:') }}
          <br/>
          <input id="end" type="datetime-local" name="end" class="form-control">
        </p>
        <p class="create-kythi">
          {{ Form::label('thoigianthi', 'Thời gian thi: (minutes)') }}
          <br/>
          {{ Form::text('thoigianthi', '', ['class' => 'form-control text-center']) }}
        </p>
        <p class="create-kythi">
          {{ Form::label('diemdat', 'Điểm đạt: (%)') }}
          <br/>
          {{ Form::text('diemdat', '', ['class' => 'form-control text-center']) }}
        </p>
      </div>
      <hr>
    <!-- <div class="submit">
					<p>{{ Form::submit('Thêm đề thi') }}</p>
				</div> -->
      <div class="text-right m-r-5pt">
        <button type="button" class="btn btn-primary text-right" data-toggle="modal" data-target="#myModal">
          Thêm đề thi
        </button>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title text-center">Chọn Môn:</h4>
            </div>
            <div class="modal-body text-center">
              {{ Form::label('mon', 'Môn:') }}
              {{ Form::select('mon', $listmon, '', ['class' => 'form-control']) }}
            </div>
            <div class="modal-footer">
              {{ Form::submit('Thêm', ['class' => 'btn btn-default']) }}
            </div>
          </div>
        </div>
      </div>
    </div>
    {{ Form::close() }}
  </div>
@endsection