@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    {{--<div class="arrow-down6"></div>--}}
    <div class="bailam_timkiem">
      <div class="bailam_tim">
        <table class="bailam_timkiem_table">
          <tbody>
          <div class="text-center">
            {{ Session::has('msg') ? Session::get("msg") : '' }}
          </div>
          {{ Form::open() }}
          <tr>
            <td>
              {{ Form::label('user', 'User:', ['class' => 'w13pt']) }}
              <div class="bailam_timkiem_form">
                {{ Form::select('users', $listuser, '', ['class' => 'form-control w80pt']) }}
              </div>
            </td>
            <td>
              {{ Form::label('kythi', 'Kỳ thi:', ['class' => 'w13pt']) }}
              <div class="bailam_timkiem_form">
                {{ Form::select('kythi', $listky, '', ['class' => 'form-control w80pt']) }}
              </div>
            </td>
            <td>
              {{ Form::label('mon', 'Môn:', ['class' => 'w13pt']) }}
              <div class="bailam_timkiem_form">
                {{ Form::select('mons', $listmon, '', ['class' => 'form-control w80pt']) }}
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
                  <th class="text-center">ID</th>
                  <th class="text-center">Kỳ thi</th>
                  <th class="text-center">User</th>
                  <th class="text-center">Môn</th>
                  <th class="text-center">Mã đề</th>
                  <th class="text-center">Loại câu hỏi</th>
                  <th class="text-center">Nội dung</th>
                  <!-- <th class="text-center">Đáp án</th> -->
                  <th class="text-center">Điểm</th>
                  <th class="text-center">Nội dung trả lời</th>
                  <!-- <th class="text-center">Đáp án của T.sinh</th> -->
                  <th class="text-center">Điểm của thí sinh</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bailam as $b)
                  <tr>
                    <td>{{ $b->id }}</td>
                    <td>{{ $b->kythis->name }}</td>
                    <td>{{ $b->users->name }}</td>
                    <td>{{ $b->mons->name }}</td>
                    <td>{{ $b->madethi }}</td>
                    <td>{{ $b->cauhois->loaicauhoi }}</td>
                    <td>{!! $b->noidungcauhoi !!}</td>
                  <!-- <td>{{ $b->dapancauhoi }}</td> -->
                    <td>{{ $b->diemcauhoi }}</td>
                    <td>{{ $b->noidungtraloi }}</td>
                  <!-- <td>{{ $b->dapancuathisinh }}</td> -->
                    <td>{{ $b->diemcauhoicuathisinh }}</td>
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
        {{$bailam->links()}}
      </ul>
    </div>
  </div>

@endsection
