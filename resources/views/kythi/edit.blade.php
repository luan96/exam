@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down1"></div>
    {{ Form::open(['id' => 'form-edit-kythi'] ) }}
    <label class="lb">
      Kỳ thi > <b class="head_content_color">Sửa kỳ thi</b> > Thêm đề thi >Thêm user
    </label>
    <h1><b>Sửa kỳ thi</b></h1>
    <hr>
    <div class="well container">
      <div class="input">
        <p class="text-center">
          {{--{{ Session::get('error_kythi') }}--}}
        </p>
        <p>
          {{ Form::label('ID', 'ID:') }}
          <span class="btn btn-primary default edit-dethi">
            <b>{{$kythi->id}}</b>
          </span>
        </p>
        <p>
          {{ Form::label('name', 'Tên kỳ thi:') }}
          {{ Form::text('name', $kythi->name, ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('begin', 'Thời gian bắt đầu:') }}
          <br/>
        <!-- {{ Form::date('begin', $kythi->begin) }} -->
          <input id="begin" type="datetime-local" name="begin" class="form-control" value="{{ $be_gin }}">
        </p>
        <p>
          {{ Form::label('end', 'Thời gian kết thúc:') }}
          <br/>
        <!-- {{ Form::date('end', $kythi->end) }} -->
          <input id="end" type="datetime-local" name="end" class="form-control" value="{{ $end_str }}">
        </p>
        <p class="create-kythi">
          {{ Form::label('thoigianthi', 'Thời gian thi: (minutes)') }}
          <br/>
          {{ Form::text('thoigianthi', $kythi->thoigianthi, ['class' => 'form-control text-center']) }}
        </p>
        <p class="create-kythi">
          {{ Form::label('diemdat', 'Điểm đạt: (%)') }}
          <br/>
          {{ Form::text('diemdat', $kythi->diemdat, ['class' => 'form-control text-center']) }}
        </p>
      </div>
      <hr>
      <div class="submit">
        <p>{{ Form::submit('Thêm đề thi', ['class' => 'w13pt']) }}</p>
      </div>

      <div class="check">
        <input type="checkbox" class="checkall"/>
        <button type="button" class="btn btn-primary" disabled="disabled">
          <a href="#" style="color: white;">Delete</a>
        </button>
      </div>
      <table class="table table-striped text-center">
        <thead>
        <tr>
          <th class="text-center"></th>
          <th class="text-center">ID</th>
          <th class="text-center">Tên đề thi</th>
          <th class="text-center">Môn</th>
          <th class="text-center">Phân loại</th>
          <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ky_de as $kd)
          <tr>
            <td class="w30">
              <input type="checkbox" class="chkitem" name="chkitem[]"/>
            </td>
            <td>{{ $kd->dethis->id }}</td>
            <td>{{ $kd->dethis->name }}</td>
            <td>{{ $kd->dethis->mons->name }}</td>
            <td>{{ $kd->dethis->phanloais->name }}</td>
            <td>
              <a href="{{ asset('/kythi/delete-dethi/'.$kd->madethi) }}" onclick="return Delete()">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
        @endforeach
        <script type="text/javascript">
          function Delete() {
            return confirm("Bạn có chắc muốn xóa không ?");
          }
        </script>
        </tbody>
      </table>
      <div class="paginate">
        <ul class="pagination text-center">
          {{$ky_de->links()}}
        </ul>
      </div>

      <hr/>

      <div class="check">
        <input type="checkbox" class="checkall"/>
        <button type="button" class="btn btn-primary" disabled="disabled">
          <a href="#" style="color: white;">Distroy</a>
        </button>
      </div>
      <table class="table table-striped text-center">
        <thead>
        <tr>
          <th class="text-center"></th>
          <th class="text-center">ID</th>
          <th class="text-center">Tên đăng nhập</th>
          <th class="text-center">Tên người dùng</th>
          <th class="text-center">Phòng thi</th>
          <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ky_user as $ku)
          <tr>
            <td class="w30">
              <input type="checkbox" class="chkitem" name="chkitem[]" value="{{ $kd->id }}"/>
            </td>
            <td>{{ $ku->user_id }}</td>
            <td>{{ $ku->users->username }}</td>
            <td>{{ $ku->users->name }}</td>
            <td>{{ $ku->phongthis->name }}</td>
            <td>
              <a href="{{ asset('/kythi/delete-user/'.$ku->user_id) }}" onclick="return Delete()">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
        @endforeach
        <script type="text/javascript">
          function Delete() {
            return confirm("Bạn có chắc muốn xóa không ?");
          }
        </script>
        </tbody>
      </table>
      <div class="paginate">
        <ul class="pagination text-center">
          {{$ky_user->links()}}
        </ul>
      </div>

    </div>
  {{ Form::close() }}
  <!-- Javascript code -->
    <script type="text/javascript">
      $(function () {
        /*Check & uncheck all*/
        $(document).on('change', '.checkall,.chkitem', function () {
          var $_this = $(this);
          if ($_this.hasClass('checkall')) {
            $('.chkitem').prop('checked', $_this.prop('checked'));
          } else {
            var $_checkedall = true;
            $('.chkitem').each(function () {
              if (!$(this).is(':checked')) {
                $_checkedall = false;
              }
              $('.checkall').prop('checked', $_checkedall);
            });
          }
        });
      });
    </script>
  </div>
@endsection