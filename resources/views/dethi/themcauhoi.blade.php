@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down2"></div>
    {{ Form::open() }}
    <label class="lb">
      Đề thi > Thêm đề thi > <b class="head_content_color">Thêm câu hỏi</b>
    </label>
    <h1 class="text-center"><b>Danh sách Câu hỏi</b></h1>
    <p class="text-center">
      <b>Môn: </b>
      <span class="label label-success">
	        		{{ $m->name }}
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
      @foreach($de as $d)
        <tr>
          <td class="w30">
            <input type="checkbox" class="chkitem" name="chkitem[]" value="{{$d->id}}"/>
          </td>
          <td>{{ $d->id }}</td>
          <td>{{ $d->loaicauhoi }}</td>
          <td>{{ $d->diem }}</td>
          <td>{{ $d->created_at }}</td>
          <td>{{ $d->updated_at }}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
    <div class="dethi-themcauhoi">
      <ul class="pagination text-center">
        {{$de->links()}}
      </ul>
    </div>
    <hr>
    <div class="submit">
      <p>{{ Form::submit('Thêm câu hỏi') }}</p>
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