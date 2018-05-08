@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down4"></div>

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
              <td width="120">{{ Form::label('name', 'Tên phòng thi:') }}</td>
              <td width="375">
                {{ Form::text('name', '', ['class' => 'form-control']) }}
              </td>
            </tr>
            </tbody>
          </table>
          <table class="m10 text-center">
            <tbody>
            <tr>
              <td width="120">
                {{ Form::label('id', 'ID:') }}
              </td>
              <td width="100">
                {{ Form::text('id', '', ['class' => 'form-control']) }}
              </td>
              <td width="100">
                {{ Form::label('ip', 'IP:') }}
              </td>
              <td width="150">
                <input class="form-control" name="ip" id="ip" pattern="^([0-9]{1,3}\.){3}[0-9]{1,3}$">
              </td>
              <td width="200">
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

    <h2 class="text-center">Danh sách Phòng thi</h2>
    <hr>
    <table class="table table-striped text-center">
      <thead>
      <tr>
        <th class="text-center"></th>
        <th class="text-center">ID</th>
        <th class="text-center">Tên phòng</th>
        <th class="text-center">IP bắt đầu</th>
        <th class="text-center">IP kết thúc</th>
        <th class="text-center">Ngày tạo</th>
        <th class="text-center">Action</th>
      </tr>
      </thead>
      <tbody>
      @foreach($phongthis as $p)
        <tr>
          <td></td>
          <td>{{ $p->id }}</td>
          <td>{{ $p->name }}</td>
          <td>{{ $p->IP_begin }}</td>
          <td>{{ $p->IP_end }}</td>
          <td>{{ $p->created_at }}</td>
          <td>
            <a href="/phongthi/edit/{{ $p->id }}" data-toggle="tooltip" title="Sửa">
              <i class="fa fa-pencil-square-o" aria-hidden="true">
              </i>
            </a>
            <a onclick="return Delete()" href="phongthi/delete/{{ $p->id }}" data-toggle="tooltip" title="Xóa">
              <i class="fa fa-trash-o" aria-hidden="true"></i>
            </a>
          </td>
        </tr>
      @endforeach
      <script type="text/javascript">
        function Delete() {
          return confirm("Bạn có chắc muốn Xóa không ?");
        }
        $(document).ready(function () {
          $('[data-toggle="tooltip"]').tooltip();
        });
      </script>
      </tbody>
    </table>
    <div class="paginate">
      <ul class="pagination text-center">
        {{$phongthis->links()}}
      </ul>
    </div>
  </div>

@endsection