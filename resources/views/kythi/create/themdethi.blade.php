@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down1"></div>
    {{ Form::open() }}
    <label class="lb">
      Kỳ thi > Thêm kỳ thi > <b class="head_content_color">Thêm đề thi</b> > Thêm thí sinh
    </label>
    <h1 class="text-center"><b>Danh sách Đề thi</b></h1>
    <hr>
    <table class="table table-striped text-center">
      <thead>
      <tr>
        <th class="text-center">
          <input type="checkbox" class="checkall"/>
        </th>
        <th class="text-center">ID</th>
        <th class="text-center">Tên đề thi</th>
        <th class="text-center">Môn</th>
        <th class="text-center">Phân loại</th>
        <th class="text-center">Ngày tạo</th>
      </tr>
      </thead>
      <tbody>
      @foreach($dethi as $d)
        <tr>
          <td class="w30">
            <input type="checkbox" class="chkitem" name="chkitem[]" value="{{$d->id}}"/>
          </td>
          <td>{{ $d->id }}</td>
          <td>{{ $d->name }}</td>
          <td>{{ $d->mons->name }}</td>
          <td>{{ $d->phanloais->name }}</td>
          <td>{{ $d->created_at }}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
    <div style="float: right; margin-top: -20px;">
      <ul class="pagination text-center">
        {{$dethi->links()}}
      </ul>
    </div>
    <hr>
    <div class="submit">
      <p>{{ Form::submit('Thêm đề thi') }}</p>
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