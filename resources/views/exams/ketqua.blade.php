{{--@extends('layouts.index')--}}
@extends('exams.exam')

@section('content')
  <div class="col-sm-10 text-left">
  <!-- @if(Session::get('current_role')->role_id == 1)
      <div class="arrow-down5"></div>
      @else
      <div class="arrow-down"></div>
      @endif -->
    <div class="bailam_timkiem">
      <div class="bailam_tim text-center">
        <table class="table_xemketqua">
          <tbody>
          <tr class="border_bottom">
            <td class="border_right w50pt">
              Tên thí sinh: <b>{{ $head->users->name }}</b>
            </td>
            <td class="w50pt">
              Kỳ thi: <b>{{ $head->kythis->name }}</b>
            </td>
          </tr>
          <tr>
            <td class="border_right w50pt">
              Môn: <b>{{ $head->mons->name }}</b>
            </td>
            <td class="w50pt">
              Đề thi: <b>{{ $head->dethis->name }}</b>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>

    <hr>

    <table class="w100pt">
      <tbody>
        <tr  class="text-center">
          <td class="border_right-color">
            Tổng điểm câu hỏi: <strong>{{ $tongdiemcauhoi }}</strong> (điểm).
          </td>
          <td class="border_right-color">
            Tổng điểm của thí sinh: <strong>{{ $tongdiem }}</strong> (điểm).
          </td>
          <td class="border_right-color">
            Phần trăm điểm: <strong>{{ round($phantram , 2) }}</strong> (%).
          </td>
          <td class="border_right-color">
            Điểm đạt: <strong>&ge; {{ $head->kythis->diemdat }}</strong> (%).
          </td>
          <td>
            Duyệt: <b class="font-size18">{{ $duyet }}.</b>
          </td>
        </tr>
      </tbody>
    </table>
    <table class="w100pt">
      <tbody>
        <tr>
          <td class="text-center">
            <h2>
              <b>Danh sách Bài làm</b>
            </h2>
          </td>
        </tr>
      </tbody>
    </table>

    <hr>

    <div class="ketqua">
      <table class="table table-striped text-center ketqua-table">
        <thead>
        <tr>
          <th class="text-center"></th>
          <th class="text-center">Loại câu hỏi</th>
          <th class="text-center">Điểm</th>
          <th class="text-center">Nội dung</th>
          <th class="text-center">Đáp án</th>
          {{--<th class="text-center">Nội dung trả lời</th>--}}
          <th class="text-center">Đáp án của thí sinh</th>
          <th class="text-center">Điểm của thí sinh</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ketqua as $key => $k)
          <tr>
            <td>Câu {{ $key+1 }}        </td>
            <td>{{ $k->cauhois->loaicauhoi }} </td>
            <td>{{ $k->diemcauhoi }}      </td>
            <td>{!! $k->noidungcauhoi !!}      </td>
            <td>{{ implode(', ', json_decode($k->dapancauhoi)) }} </td>
            {{--<td>{{ $k->noidungtraloi }}      </td>--}}

            @if(json_decode($k->dapancuathisinh) != 0)
              <td>{{ implode(', ', json_decode($k->dapancuathisinh)) }}</td>
            @else
              <td>{{ $k->dapancuathisinh }}</td>
            @endif

            <td>
              {{ $k->diemcauhoicuathisinh }}
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <div class="paginate">
      <ul class="pagination text-center">
        {{$ketqua->links()}}
      </ul>
    </div>
  </div>

@endsection