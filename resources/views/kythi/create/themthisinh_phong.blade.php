@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down1"></div>
    {{ Form::open() }}
    <label class="lb">
      Kỳ thi > Thêm kỳ thi > Thêm đề thi ><b class="head_content_color">Thêm thi sinh</b>
    </label>
    <h1 class="text-center"><b>Danh sách thi sinh</b></h1>

    <div class="text-center">
      Phòng thi: <b>{{ $phongthi->name }}</b>
    </div>

    <hr>

    <table class="table table-striped text-center">
      <thead>
      <tr>
        <th class="text-center">
          <input type="checkbox" class="checkall"/>
        </th>
        <th class="text-center">ID</th>
        <th class="text-center">Tên đăng nhập</th>
        <th class="text-center">Tên người dùng</th>
        <th class="text-center">Ngày tạo</th>
      </tr>
      </thead>
      <tbody>
      @foreach($user as $u)
        <tr>
          <td class="w30">
            <input type="checkbox" class="chkitem" name="chkitem[]" value="{{ $u->id }}"/>
          </td>
          <td>{{ $u->id }}</td>
          <td>{{ $u->username }}</td>
          <td>{{ $u->name }}</td>
          <td>{{ $u->created_at }}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
    <div class="paginate">
      <ul class="pagination text-center">
        {{ $user->links() }}
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