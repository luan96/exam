@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    {{--<div class="arrow-down6"></div>--}}
    <div class="bailam_timkiem">
      <div class="bailam_tim">
        <table class="bailam_timkiem_table">
          <tbody>
          <div class="text-center">
            {{ Session::has('messages') ? Session::get("messages") : '' }}
          </div>
          {{ Form::open() }}
          <tr>
            <td>
              {{ Form::label('user', 'User:', ['class' => 'w13pt']) }}
              <div class="bailam_timkiem_form">
                {{ Form::select('user', $listuser, '', ['class' => 'form-control w80pt']) }}
              </div>
            </td>
            <td>
              {{ Form::label('kythi', 'Kỳ thi:', ['class' => 'w13pt']) }}
              <div class="bailam_timkiem_form">
                {{ Form::select('ky', $listky, '', ['class' => 'form-control w80pt']) }}
              </div>
            </td>
            <td>
              {{ Form::label('mon', 'Môn:', ['class' => 'w13pt']) }}
              <div class="bailam_timkiem_form">
                {{ Form::select('mon', $listmon, '', ['class' => 'form-control w80pt']) }}
              </div>
            </td>
          </tr>
          <tr>
            <td></td>
            <td class="submit text-center">
              <p>{{ Form::submit('Tìm kiếm', ['style' => 'float: none;']) }}</p>
            </td>
            <td></td>
          </tr>
          {{ Form::close() }}
          {{ Session::has('msg') ? Session::get("msg") : '' }}
          </tbody>
        </table>
      </div>
    </div>

    <hr>

    <div class="bailam_header">
      <div class="bailam_header1 text-center">
        <table class="w100pt">
          <tbody>
          <tr class="border_bottom">
            <td class="border_right">
              Tên thí sinh: <b>{{ $user->username }}</b>
            </td>
            <td class="border_right">
              Kỳ thi: <b>{{ $ky->name }}</b>
            </td>
            <td class="border_right">
              Môn: <b>{{ $mon->name }}</b>
            </td>
            <td>
              Đề thi: <b>{{ $de->dethis->name }}</b>
            </td>
          </tr>
          <tr>
            <td class="border_right">
              Tổng điểm câu hỏi: <b>{{ $tongdiemcauhoi }} (đ).</b>
            </td>
            <td class="border_right">
              Tổng điểm thí sinh: <b>{{ $tongdiem }} (đ).</b>
            </td>
            <td class="border_right">
              Điểm đạt: <b>{{ $ky->diemdat }} (%).</b>
            </td>
            <td>
              Duyệt: <b>{{ $duyet }}.</b>
            </td>
          </tr>
          </tbody>
        </table>
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
                <b>Danh sách bài làm</b>
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
                    <th class="text-center">Mã câu hỏi</th>
                    <th class="text-center">Loại câu hỏi</th>
                    <th class="text-center">Nội dung</th>
                    <!-- <th class="text-center">Đáp án</th> -->
                    <th class="text-center">Điểm</th>
                    <th class="text-center">Nội dung trả lời</th>
                    <!-- <th class="text-center">Đáp án của thí sinh</th> -->
                    <th class="text-center">Điểm của thí sinh</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($bailamthisinh as $bl)
                    <tr>
                      <td>{{ $bl->macauhoi }}</td>
                      <td>{{ $bl->cauhois->loaicauhoi }}</td>
                      <td>{!! $bl->noidungcauhoi !!}</td>
                    <!-- <td>{{ $bl->dapancauhoi }}</td> -->
                      <td>{{ $bl->diemcauhoi}}</td>
                      <td>{{ $bl->noidungtraloi }}</td>
                    <!-- <td>{{ $bl->dapancuathisinh }}</td> -->
                      <td>{{ $bl->diemcauhoicuathisinh }}</td>
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
    <div class="paginate">
      <ul class="pagination text-center">
        {{$bailamthisinh->links()}}
      </ul>
    </div>
  </div>

@endsection
