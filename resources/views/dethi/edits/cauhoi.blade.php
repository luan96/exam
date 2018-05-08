@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down2"></div>
    {{ Form::open() }}
    <label class="lb">
      Đề thi > Sửa đề thi > <b class="head_content_color">Thêm câu hỏi</b>
    </label>
    <h1 class="text-center"><b>Danh sách Câu hỏi</b></h1>
    <p class="text-center">
      <b>Môn: </b>
      <span class="label label-success">
	        		{{ $dethi->mons->name }}
	        	</span>
    </p>
    <hr>
    <table class="table table-striped text-center">
      <thead>
      <tr>
        <th class="text-center">
          <input type="checkbox" class="checkall"/>
        </th>
        <th class="text-center">ID</th>
        <th class="text-center">Loại câu hỏi</th>
        <th class="text-center">Điểm</th>
        <th class="text-center">Ngày tạo</th>
        <th class="text-center">Ngày cập nhật</th>
      </tr>
      </thead>
      <tbody>
      @foreach($cauhoi as $c)
        <tr>
          <td class="w30">
            <input type="checkbox" class="chkitem" name="chkitem[]" value="{{ $c->id }}"/>
          </td>
          <td>{{ $c->id }}</td>
          <td>{{ $c->loaicauhoi }}</td>
          <td>{{ $c->diem }}</td>
          <td>{{ $c->created_at }}</td>
          <td>{{ $c->updated_at }}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
    <div style="float: right; margin-top: -20px;">
      <ul class="pagination text-center">
        {{$cauhoi->links()}}
      </ul>
    </div>
    <hr>
    <div class="submit">
      <p>{{ Form::submit('Update') }}</p>
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