@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down1"></div>
    <a href="./kythi/create" class="btn btn-info pull-left">Thêm kỳ thi</a>
    <h2 class="text-center">Danh sách Kỳ Thi</h2>

    {{--<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#search">Search</button>--}}
    {{--<div id="search" class="collapse">--}}
      {{--<table class="bailam_timkiem_table text-center search">--}}
        {{--<tbody>--}}
        {{--{{ Form::open() }}--}}
        {{--<tr>--}}
          {{--<td>--}}
            {{--{{ Form::label('id', 'Search ID:') }}--}}
          {{--</td>--}}
          {{--<td>--}}
            {{--{{ Form::number('id', '', ['class' => 'form-control']) }}--}}
          {{--</td>--}}
          {{--<td>--}}
            {{--{{ Form::submit('Tìm kiếm') }}--}}
          {{--</td>--}}
        {{--</tr>--}}
        {{--{{ Form::close() }}--}}
        {{--</tbody>--}}
      {{--</table>--}}
    {{--</div>--}}

    {{--<hr>--}}

    {{--<div class="bailam_timkiem">--}}
      {{--<div class="bailam_tim">--}}
        {{--<div class="text-center">--}}
          {{--{{ Session::has('messages') ? Session::get("messages") : '' }}--}}
        {{--</div>--}}
        {{--<div class="form-search">--}}
        {{--{{ Form::open() }}--}}
          {{--<table class="text-center m10">--}}
            {{--<tbody>--}}
              {{--<tr>--}}
                {{--<td width="100">{{ Form::label('name', 'Tên:') }}</td>--}}
                {{--<td width="375">--}}
                  {{--{{ Form::text('name', '', ['class' => 'form-control']) }}--}}
                {{--</td>--}}
              {{--</tr>--}}
            {{--</tbody>--}}
          {{--</table>--}}
          {{--<table class="m10 text-center">--}}
            {{--<tbody>--}}
              {{--<tr>--}}
                {{--<td width="100">--}}
                  {{--{{ Form::label('mon', 'Môn:') }}--}}
                {{--</td>--}}
                {{--<td width="100">--}}
                  {{--{{ Form::select('mon', array(--}}
                      {{--'null' => '',--}}
                      {{--'mon' => $listmon,--}}
                  {{--), 'null', ['class' => 'form-control']) }}--}}
                {{--</td>--}}
                {{--<td width="100">--}}
                  {{--{{ Form::label('ngaythi', 'Ngày thi:') }}--}}
                {{--</td>--}}
                {{--<td width="100">--}}
                  {{--{{ Form::date('ngaythi', '', ['class' => 'form-control']) }}--}}
                {{--</td>--}}
                {{--<td width="250">--}}
                  {{--{{ Form::submit('Tìm kiếm') }}--}}
                {{--</td>--}}
              {{--</tr>--}}
            {{--</tbody>--}}
          {{--</table>--}}
        {{--{{ Form::close() }}--}}
        {{--</div>--}}
      {{--</div>--}}
    {{--</div>--}}

    <hr>

    <div class="bailam_timkiem">
      <div class="bailam_tim">
        <div class="text-center">
          {{ Session::has('messages') ? Session::get("messages") : '' }}
        </div>
        <div class="form-search">
          {{ Form::open() }}
          <table class="text-center m10">
            <tbody>
            <tr>
              <td width="100">
                {{ Form::label('id', 'ID:') }}
              </td>
              <td width="113">
                {{ Form::number('id', '', ['class' => 'form-control']) }}
              </td>
              <td width="112">{{ Form::label('name', 'Tên kỳ thi:') }}</td>
              <td width="350">
                {{ Form::text('name', '', ['class' => 'form-control']) }}
              </td>
            </tr>
            </tbody>
          </table>
          <table class="m10 text-center">
            <tbody>
            <tr>
              <td width="103">
                {{ Form::label('mon', 'Môn:') }}
              </td>
              <td width="115">
                {{ Form::select('mon', array(
                    '' => '',
                    'mon' => $listmon,
                ), '', ['class' => 'form-control']) }}
              </td>
              <td width="115">
                {{ Form::label('ngaythi', 'Ngày thi:') }}
              </td>
              <td>
                {{ Form::date('ngaythi', '', ['class' => 'form-control']) }}
              </td>

              <td width="220">
                {{ Form::submit('Tìm kiếm') }}
              </td>
            </tr>
            </tbody>
          </table>
          {{ Form::close() }}
        </div>
      </div>
    </div>

    <hr>

    <table class="table table-striped text-center">
      <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Tên kỳ thi</th>
        <th class="text-center">Môn</th>
        <th class="text-center">Thời gian bắt đầu</th>
        <th class="text-center">Thời gian kêt thúc</th>
        <th class="text-center">Thời gian thi (phút)</th>
        <th class="text-center">Điểm đạt (%)</th>
        <th class="text-center">Action</th>
      </tr>
      </thead>
      <tbody>
      @foreach($kythis as $k)
        <tr>
          <td>{{ $k->id }}</td>
          <td>
            <a href="./kythi/detail/{{ $k->id }}">
              {{ $k->name }}
            </a>
          </td>
          <td>{{ $arr_mon[$k->id] }}</td>
          <td>{{ date('Y-m-d H:i', strtotime($k->begin)) }}</td>
          <td>{{ date('Y-m-d H:i', strtotime($k->end)) }}</td>
          <td>{{ $k->thoigianthi }}</td>
          <td>&ge; {{ $k->diemdat }}</td>
          <td>
            <a href="./kythi/edit/{{ $k->id }}" data-toggle="tooltip" title="Sửa">
              <i class="fa fa-pencil-square-o" aria-hidden="true">
              </i>
            </a>
            <a href="./kythi/delete/{{ $k->id }}" onclick="return Delete()" data-toggle="tooltip" title="Xóa">
              <i class="fa fa-trash-o"></i>
            </a>
            <!-- Xóa all các bài thi của kỳ thi -->
            <a href="./kythi/reset/{{ $k->id }}" onclick="return Reset()" data-toggle="tooltip" title="Reset">
              <span class="glyphicon glyphicon-repeat"></span>
            </a>
          </td>
        </tr>
      @endforeach
      <script type="text/javascript">
        function Delete() {
          return confirm("Bạn có chắc muốn XÓA không ?");
        }
        function Reset() {
          return confirm("Bạn có chắc muốn RESET không ?");
        }

        $(document).ready(function () {
          $('[data-toggle="tooltip"]').tooltip();
        });
      </script>
      </tbody>
    </table>
    <div class="paginate">
      <ul class="pagination text-center">
        {{$kythis->links()}}
      </ul>
    </div>
  </div>

@endsection