@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="arrow-down1"></div>
    @if($kythi->trangthai == Config::get('constants.status.2'))
      <p>
        <a href='javascript:goback()'>
          <i class="fa fa-angle-left"></i>
          Quay lại
        </a>
      </p>
      <div class="bailam_timkiem">
        <div class="bailam_tim">
          <table class="bailam_timkiem_table text-center">
            <tbody>
            <tr>
              <td>
                Tên thí sinh: <b>{{ $kythi->users->name }}</b>
              </td>
              <td>
                Kỳ thi: <b>{{ $kythi->kythis->name }}</b>
              </td>
              <td>
                Đề thi: <b>{{ $bai->dethis->name }}</b>
              </td>
              <td>
                Môn thi: <b>{{ $bai->mons->name }}</b>
              </td>
            </tr>
            <tr>
              <td>
                Tổng điểm câu hỏi: <b>{{$tongdiemcauhoi}} (đ).</b>
              </td>
              <td>
                Tổng điểm thí sinh: <b>{{ $tongdiem }} (đ).</b>
              </td>
              <td>
                Điểm đạt: <b>&ge; {{ $kythi->kythis->diemdat }} (%).</b>
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

      <div class="text-right student">
        <a href="{{ asset('/kythi/export-user/'.$kythi->user_id) }}" class="btn btn-primary default">export</a>
      </div>

      <div class="index_exam">
        <div>
          <table class="table_index_exam">
            <thead class="thead_index_exam">
            <tr>
              <th>
                <h4 class="text-center">
                  <b>Danh sách bài làm của thí sinh</b>
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
                    <th class="text-center"></th>
                    <th class="text-center">Loại câu hỏi</th>
                    <th class="text-center">Nội dung</th>
                    <th class="text-center">Đáp_án</th>
                    <th class="text-center">Điểm</th>
                    {{--<th class="text-center">Nội dung trả lời</th>--}}
                    <th class="text-center">Đáp án của thí_sinh</th>
                    <th class="text-center">Điểm của thí_sinh</th>
                    <th class="text-center">Ngày cập nhật</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($bailam as $key => $bl)
                    <tr>
                      <td>Câu.{{ $key+1 }}</td>
                      <td>
                        {{ $bl->cauhois->loaicauhoi }}
                      </td>
                      <td>
                        {!! $bl->noidungcauhoi !!}
                      </td>
                      <td>
                        {{ implode(', ', json_decode($bl->dapancauhoi)) }}
                      </td>
                      <td>
                        {{ $bl->diemcauhoi}}
                      </td>
                      {{--<td>{{ $bl->noidungtraloi }}</td>--}}

                      @if(json_decode($bl->dapancuathisinh) != 0)
                        <td>{{ implode(', ', json_decode($bl->dapancuathisinh)) }}</td>
                      @else
                        <td>{{ $bl->dapancuathisinh }}</td>
                      @endif

                      <td>
                        {{ $bl->diemcauhoicuathisinh }}
                      </td>
                      <td>
                        {{ date('H:i d/m/Y', strtotime($bl->updated_at)) }}
                      </td>
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
    @else
      <div class="bailam_timkiem">
        <div class="bailam_tim">
          <table class="bailam_timkiem_table text-center">
            <tbody>
            <tr>
              <td>
                <h3>
                  <b>Thí sinh chưa thi.</b>
                </h3>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    @endif
    <script>
      function goback() {
        history.back(-1)
      }
    </script>

  </div>

@endsection