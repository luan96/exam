@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down1"></div>

    <label class="lb">
      Kỳ thi > Sửa kỳ thi > Thêm đề thi ><b class="head_content_color">Thêm thi sinh</b>
    </label>
    <h1 class="text-center"><b>Danh sách thi sinh</b></h1>

    <div class="dropdown ">
      <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Phòng thi
      <span class="caret"></span></button>
      <ul class="dropdown-menu">
        @foreach($phongthi as $p)
        <li>
          <a href="{{ asset('/kythi/edit/themthisinh/'.$ky.'/'.$p->id) }}">{{ $p->name }}</a>
        </li>
        @endforeach
      </ul>
    </div>

    <hr>

    <table class="table table-striped text-center">
      <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Tên đăng nhập</th>
        <th class="text-center">Tên người dùng</th>
        <th class="text-center">Ngày tạo</th>
      </tr>
      </thead>
      <tbody>
      @foreach($users as $u)
        <tr>
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
        {{ $users->links() }}
      </ul>
    </div>
    <hr>
    <div class="text-right">
      <a href="{{ asset('/kythi') }}" type="button" class="btn btn-primary">Cập nhật</a>
    </div>


  <!-- Javascript code -->
    <!-- <script type="text/javascript">
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
    </script> -->
  </div>
@endsection