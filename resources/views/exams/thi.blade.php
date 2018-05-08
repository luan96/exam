{{--@extends('layouts.index')--}}
@extends('exams.exam')

@section('content')
  <div class="col-sm-10 text-left">
    @if(Session::get('current_role')->role_id == 1)
      <div class="arrow-down5"></div>
    @else
      <div class="arrow-down"></div>
    @endif
    <div class="row">
      <div class="col-sm-3">
        <h1>Exam <sub>
            <small>exam.vn</small>
          </sub></h1>
      </div>
      <div class="col-sm-9" style="">
        <table class="table_thi">
          <tbody>
          <tr>
            <td class="border_right-color">Kỳ thi: <b>{{ $ky }}</b></td>
            <td class="border_right-color">Đề thi: <b>{{ $de->name }}</b></td>
            <td class="border_right-color">Môn: <b>{{  $de->mons->name }}</b></td>
            <td>Ngày thi: <b>{{ date("d-m-Y") }}</b></td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>

    <hr class="hr">

    <div id="remain" style="display: none;">{{ $remain_time }}</div>

    @include('exams.questions.question')

    <div class="time">
      <div class="time1">
        <img src="{{ asset('/images/clock.jpg') }}" width="50px;">
        <b>
          <p id="remainTime" class="show_time"></p>
        </b>
      </div>
    </div>
    <script type="text/javascript">
      // var remain = setInterval(exam.remainTime, 5000);
      var count = setInterval(exam.countDownTime, 1000);
    </script>
  </div>
@endsection