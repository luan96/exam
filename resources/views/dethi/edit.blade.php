@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down2"></div>
    {{ Form::open(['id' => 'form-edit-dethi']) }}
    <label class="lb">Đề thi > <b class="head_content_color">Sửa đề thi</b> > Thêm câu hỏi</label>
    <h1><b>Sửa đề thi</b></h1>
    <hr>
    <div class="well container">
      <div class="input">
        <p>
          {{ Form::label('ID', 'ID:') }}
          <span class="btn btn-primary default edit-deth">
			        		<b>{{$dethi->id}}</b>
			        	</span>
        </p>
        <p>
          {{ Form::label('name', 'Tên đề thi:') }}
          {{ Form::text('name', $dethi->name, ['class' => 'form-control']) }}
        </p>
        <p>
          {{ Form::label('mon', 'Môn:') }}
          <span class="btn btn-primary default edit-dethi">
			        		<b>{{$dethi->mons->name}}</b>
			        	</span>
        </p>
        <p>
          {{ Form::label('phanloai', 'Phân loại:') }}
          <br/>
          {{ Form::select('phanloai', $listphanloai, $dethi->phanloai, ['class' => 'form-control']) }}
        </p>
      </div>
      <hr>
      <div class="submit">
        <p>{{ Form::submit('Update') }}</p>
      </div>
      <div class="check">
        <input type="checkbox" class="checkall"/>
        <button type="button" class="btn btn-primary" disabled="disabled">
          <a href="/dethi/delete-cau-hoi/{{$dethi->id}}" style="color: white;">Delete</a>
        </button>
      </div>

      <table class="table table-striped text-center">
        <thead>
        <tr>
          <th class="text-center">

          </th>
          <th class="text-center">ID</th>
          <th class="text-center">Loại câu hỏi</th>
          <th class="text-center">Điểm</th>
          <th class="text-center">Ngày tạo</th>
          <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($de_cau as $dc)
          <tr>
            <td class="w30">
              <input type="checkbox" class="chkitem" name="chkitem[]" value="{{ $dc->cauhois->id }}"/>
            </td>
            <td>{{ $dc->cauhois->id }}</td>
            <td>{{ $dc->cauhois->loaicauhoi }}</td>
            <td>{{ $dc->cauhois->diem }}</td>
            <td>{{ $dc->cauhois->created_at }}</td>
            <td>
            <a href="{{ asset('/dethi/delete-cauhoi/'.$dc->madethi.'/'.$dc->macauhoi) }}" onclick="return Delete()" data-toggle="tooltip" title="Xóa">
					        		<i class="fa fa-trash-o" aria-hidden="true"></i>
					        	</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <div class="paginate">
        <ul class="pagination text-center">
          {{$de_cau->links()}}
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
      function Delete() {
        return confirm("Bạn có chắc muốn XÓA không ?");
      }

      $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
      });
    </script>
  </div>
@endsection