@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down1"></div>
    <p>
      <a href='javascript:goback()'>
        <i class="fa fa-angle-left"></i>
        Quay lại
      </a>
    </p>
    <h3 class="text-center question-hr">
      Kỳ thi:   <span class="btn btn-primary default">
                  <b>{{ $kythi->name }}</b>
                </span>
    </h3>
    <p class="text-center">
      Điểm đạt: <b>&ge; {{ $kythi->diemdat }} (%).</b>
    </p>

    <hr>

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
                {{ Form::label('trangthai', 'Trạng thái:') }}
              </td>
              <td width="130">
                {{ Form::select('trangthai', array(
                    '' => '',
                    Config::get('constants.status.0') => Config::get('constants.status.0'),
                    Config::get('constants.status.1') => Config::get('constants.status.1'),
                    Config::get('constants.status.2') => Config::get('constants.status.2'),
                    Config::get('constants.status.3') => Config::get('constants.status.3')
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

    <div class="index_exam">
      <div>
        <table class="table_index_exam">
          <thead class="thead_index_exam">
          <tr>
            <th>
              <h4 class="text-center">
                <b>Danh sách thí sinh tham gia kỳ thi</b>
              </h4>
            </th>
          </tr>
          </thead>
          <tbody>
          <tr class="bailam_hien">
            <td>
              <table class="table table-striped text-center">
                <thead>
                <tr>
                  <th class="text-center">STT</th>
                  <th class="text-center">ID</th>
                  <th class="text-center">Tên người dùng</th>
                  <th class="text-center">Tên</th>
                  <th class="text-center">Ngày sinh</th>
                  <th class="text-center">Đề thi</th>
                  <th class="text-center">Trạng thái</th>
                  <th class="text-center">Tổng điểm câu hỏi</th>
                  <th class="text-center">Điểm của thí sinh</th>
                  <th class="text-center">Duyệt</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($users as $key => $u)
                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>{{ $u->user_id }}</td>
                      <td>
                        <a href="/kythi/detail-user/{{ $u->user_id }}">{{ $u->users->username }}</a>
                      </td>
                      <td>{{ $u->users->name }}</td>
                      <td>{{ $u->users->birthday }}</td>
                      <td>{{ $arr_de[$u->user_id] }}</td>
                      <td>{{ $u->trangthai }}</td>
                      <td>{{ $arr_diemcauhoi[$u->user_id] }}</td>
                      <td>{{ $arr_diemthisinh[$u->user_id] }}</td>

                      @if($u->trangthai == Config('constants.status.2'))
                        <td>
                          <span class="label label-success">
                            {{ $arr_duyet[$u->user_id] }}
                          </span>
                        </td>
                      @else
                        <td>{{ $arr_duyet[$u->user_id] }}</td>
                      @endif
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
    <script>
      function goback() {
        history.back(-1)
      }
    </script>

  </div>

@endsection