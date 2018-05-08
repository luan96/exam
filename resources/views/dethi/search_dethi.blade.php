@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down2"></div>

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
              <td width="120">
                {{ Form::label('id', 'ID:') }}
              </td>
              <td width="100">
                {{ Form::number('id', '', ['class' => 'form-control']) }}
              </td>
              <td width="140">{{ Form::label('name', 'Tên đề thi:') }}</td>
              <td width="300">
                {{ Form::text('name', '', ['class' => 'form-control']) }}
              </td>
            </tr>
            </tbody>
          </table>
          <table class="m10 text-center">
            <tbody>
            <tr>
              <td width="128">
                {{ Form::label('mon', 'Môn:') }}
              </td>
              <td width="110">
                {{ Form::select('mon', array(
                    '' => '',
                    'Môn' => $listmon
                ), '', ['class' => 'form-control']) }}
              </td>
              <td width="150">
                {{ Form::label('phanloai', 'Phân loại:') }}
              </td>
              <td width="130">
                {{ Form::select('phanloai', array(
                    '' => '',
                    'Giỏi' => 'Giỏi',
                    'Khá'  => 'Khá',
                    'Trung bình' => 'Trung bình',
                    'Dể'         => 'Dể'
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

    <h2 class="text-center">Danh sách Đề Thi</h2>
    <hr>
    <table class="table table-striped text-center">
      <thead>
      <tr>
        <th class="text-center"></th>
        <th class="text-center">ID</th>
        <th class="text-center">Tên đề thi</th>
        <th class="text-center">Môn</th>
        <th class="text-center">Phân loại</th>
        <th class="text-center">Ngày tạo</th>
        <th class="text-center">Action</th>
      </tr>
      </thead>
      <tbody>
      @foreach($dethis as $d)
        <tr>
          <td></td>
          <td>{{ $d->id }}</td>
          <td>{{ $d->name }}</td>
          <td>{{ $d->mons->name }}</td>
          <td>{{ $d->phanloais->name }}</td>
          <td>{{ $d->created_at }}</td>
          <td>
            <a href="/dethi/edit/{{ $d->id }}" data-toggle="tooltip" title="Sửa">
              <i class="fa fa-pencil-square-o" aria-hidden="true">
              </i>
            </a>
            <a href="/dethi/delete/{{ $d->id }}" onclick="return Delete()" data-toggle="tooltip" title="Xóa">
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
    @if(!is_array($dethis))
    <div class="paginate">
      <ul class="pagination text-center">
        {{$dethis->links()}}
      </ul>
    </div>
    @endif
  </div>

@endsection