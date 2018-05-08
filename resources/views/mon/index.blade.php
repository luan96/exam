@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down4"></div>
    <div class="bailam_timkiem">
      <div class="bailam_tim">
        <div class="text-center">
          {{ Session::has('messages') ? Session::get("messages") : '' }}
          {{ Session::has('message') ? Session::get("message") : '' }}
        </div>
        <div class="form-search">
          {{ Form::open() }}
          <table class="text-center m10-auto">
            <tbody>
            <tr>
              <td width="90">
                {{ Form::label('name', 'Tên môn:') }}
              </td>
              <td width="300">
                {{ Form::text('name', '', ['class' => 'form-control']) }}
              </td>
            </tr>
            </tbody>
          </table>
          <table class="text-center m10-auto">
            <tbody>
            <tr>
              <td width="140">
                {{ Form::label('id', 'ID:') }}
              </td>
              <td width="100">
                {{ Form::number('id', '', ['class' => 'form-control']) }}
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

    <a href="{{ asset('/mon/create') }}" class="btn btn-info pull-left">Thêm môn</a>
    <h2 class="text-center">Danh sách Môn</h2>
    <hr>
    <table class="table table-striped text-center">
      <thead>
      <tr>
        <th class="text-center"></th>
        <th class="text-center">ID</th>
        <th class="text-center">Tên</th>
        <th class="text-center">Ngày tạo</th>
        <th class="text-center">Action</th>
      </tr>
      </thead>
      <tbody>
      @foreach($mon as $m)
        <tr>
          <td></td>
          <td>{{ $m->id }}</td>
          <td>{{ $m->name }}</td>
          <td>{{ $m->created_at }}</td>
          <td>
            <a href="./mon/edit/{{ $m->id }}" data-toggle="tooltip" title="Sửa">
              <i class="fa fa-pencil-square-o" aria-hidden="true">
              </i>
            </a>
            <a onclick="return Delete()" href="./mon/delete/{{ $m->id }}" data-toggle="tooltip" title="Xóa">
              <i class="fa fa-trash-o" aria-hidden="true"></i>
            </a>
          <!-- <a onclick="ConfirmDelete({{ $m->id }})">
			        		<i class="fa fa-trash-o" aria-hidden="true"></i>
			        	</a> -->
          </td>
        </tr>
      @endforeach
      <script type="text/javascript">
        function Delete(id) {
          return confirm("Bạn có chắc muốn XÓA không ?");
        }

        // function ConfirmDelete(id)
        // {
        //     if (confirm("Bạn có chắc muốn xóa không ?"))
        //         location.href='/mon/delete/'+id;
        // }
        $(document).ready(function () {
          $('[data-toggle="tooltip"]').tooltip();
        });
      </script>
      </tbody>
    </table>
    <div class="paginate">
      <ul class="pagination text-center">
        {{$mon->links()}}
      </ul>
    </div>
  </div>

@endsection