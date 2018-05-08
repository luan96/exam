@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down3"></div>

    <div class="bailam_timkiem">
      <div class="bailam_tim">
        <div class="text-center">
          {{ Session::has('messages') ? Session::get("messages") : '' }}
          {{ Session::has('message') ? Session::get("message") : '' }}
        </div>
        <div class="form-search">
          {{ Form::open() }}
          <table class="text-center m10">
            <tbody>
            <tr>
              <td width="116">
                {{ Form::label('id', 'ID:') }}
              </td>
              <td width="100">
                {{ Form::number('id', '', ['class' => 'form-control']) }}
              </td>
              <td width="135">{{ Form::label('mon', 'Môn:') }}</td>
              <td width="135">
                {{ Form::select('mon', array(
                    '' => '',
                    'Môn' => $listmon
                ), '', ['class' => 'form-control']) }}
              </td>
            </tr>
            </tbody>
          </table>
          <table class="m10 text-center">
            <tbody>
            <tr>
              <td width="128">
                {{ Form::label('phanloai', 'Phân loại:') }}
              </td>
              <td width="110">
                {{ Form::select('phanloai', array(
                    '' => '',
                    'Phân loại' => $list_phanloai
                ), 0, ['class' => 'form-control']) }}
              </td>
              <td width="150">
                {{ Form::label('search_loaicauhoi', 'Loại câu hỏi:') }}
              </td>
              <td width="150">
                {{ Form::select('search_loaicauhoi', array(
                    '' => '',
                    Config::get('constants.options.1') => Config::get('constants.options.1'),
                    Config::get('constants.options.2') => Config::get('constants.options.2'),
                    Config::get('constants.options.3') => Config::get('constants.options.3')
                ), 0, ['class' => 'form-control']) }}
              </td>
              <td width="250">
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

    <button type="button" class="btn btn-info pull-left" data-toggle="modal" data-target="#myModal">Thêm Câu hỏi
    </button>
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Chọn loại câu hỏi</h4>
          </div>
          {{ Form::open() }}
          <div class="modal-body">
            {{ Form::radio('loaicauhoi', 'Chọn một đáp án', true) }}&emsp;{{ Config::get('constants.options.1') }}<br/>
            {{ Form::radio('loaicauhoi', 'Chọn nhiều đáp án') }}&emsp;{{ Config::get('constants.options.2') }}<br/>
            {{ Form::radio('loaicauhoi', 'Đúng sai') }}&emsp;{{ Config::get('constants.options.3') }}<br/>
            {{--{{ Form::radio('loaicauhoi', 'Tự luận', '',['disabled']) }}&emsp;Tự luận<br/>--}}
          </div>
          <div class="modal-footer">
            <p>{{ Form::submit('Thêm') }}</p>
          </div>
          {{ Form::close() }}
        </div>
      </div>
    </div>
    <h2 class="text-center">Danh sách Câu hỏi</h2>

    <hr>

    <table class="table table-striped text-center">
      <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Môn</th>
        <th class="text-center">Phân Loại</th>
        <th class="text-center">Loại Câu Hỏi</th>
        <th class="text-center">Nội Dung</th>
        <th class="text-center">Điểm</th>
        <th class="text-center">Action</th>
      </tr>
      </thead>
      <tbody>
      @foreach($cauhoi as $c)
        <tr>
          <td>{{ $c->id }}</td>
          <td>{{ $c->mons->name }}</td>
          <td>{{ $c->phanloais->name }}</td>
          <td>{{ $c->loaicauhoi }}
          </td>
          <td>
            {{--{!! str_limit($c->noidung, 30,'...') !!}--}}
            {!! $c->noidung !!}
          </td>
          <td>{{ $c->diem }}</td>
          <td>
            <a href="./cauhoi/edit/{{ $c->id }}" data-toggle="tooltip" title="Sửa">
              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </a>
            <a onclick="return Delete()" href="./cauhoi/delete/{{ $c->id }}" data-toggle="tooltip" title="Xóa">
              <i class="fa fa-trash-o" aria-hidden="true"></i>
            </a>
          </td>
        </tr>
      @endforeach
      <script type="text/javascript">
        function Delete() {
          return confirm("Bạn có chắc muốn XÓA không ?");
        }

        $(document).ready(function () {
          $('[data-toggle="tooltip"]').tooltip();
        });
      </script>
      </tbody>
    </table>
    <div class="paginate">
      <ul class="pagination text-center">
        {{$cauhoi->links()}}
      </ul>
    </div>
  </div>

@endsection