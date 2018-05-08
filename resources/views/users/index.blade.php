@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down"></div>

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
              <td width="190">{{ Form::label('name', 'Tên người dùng:') }}</td>
              <td width="300">
                {{ Form::text('name', '', ['class' => 'form-control']) }}
              </td>
            </tr>
            </tbody>
          </table>
          <table class="m10 text-center">
            <tbody>
            <tr>
              <td width="150">
                {{ Form::label('ngaysinh', 'Ngày sinh:') }}
              </td>
              <td width="100">
                {{ Form::date('ngaysinh', '', ['class' => 'form-control']) }}
              </td>
              <td width="150">
                {{ Form::label('quyen', 'Quyền:') }}
              </td>
              <td width="130">
                {{ Form::select('quyen', array(
                    '' => '',
                    'Role' => $listrole,
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

    <a href="./users/create" class="btn btn-info pull-left">Thêm user</a>
    <h2 class="text-center">Danh sách User</h2>
    <hr>
    <table class="table table-striped text-center">
      <thead>
      <tr>
        <th class="text-center"></th>
        <th class="text-center">ID</th>
        <th class="text-center">Tên người dùng</th>
        <th class="text-center">Tên</th>
        <th class="text-center">Ngày sinh</th>
        <th class="text-center">Quyền</th>
        <th class="text-center">Ngày tạo</th>
        <th class="text-center">Action</th>
      </tr>
      </thead>
      <tbody>
      @foreach($user as $u)
        <tr>
          <td></td>
          <td>{{ $u->id }}</td>
          <td>{{ $u->username }}</td>
          <td>{{ $u->name }}</td>
          <td>{{ $u->birthday }}</td>
          <td>
            @foreach($role as $r)
              @if($r->user_id == $u->id)
                <span class="label label-success">
				        		{{ $r->roles->name }}
				        	</span>
              @endif
            @endforeach
          </td>
          <td>{{ $u->created_at }}</td>
          <td>
            <a href="users/edit/{{ $u->id }}" data-toggle="tooltip" title="Sửa">
              <i class="fa fa-pencil-square-o" aria-hidden="true">
              </i>
            </a>
            <a href="users/delete/{{ $u->id }}" onclick="return Delete()" data-toggle="tooltip" title="Xóa">
              <i class="fa fa-trash-o" aria-hidden="true"></i>
            </a>
          <!-- <a onclick="ConfirmDelete({{ $u->id }})" data-toggle="tooltip" title="Xóa">
			        		<i class="fa fa-trash-o" aria-hidden="true"></i>
			        	</a> -->
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
        {{$user->links()}}
      </ul>
    </div>
  </div>

@endsection