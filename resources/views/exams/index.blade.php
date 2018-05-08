{{--@extends('layouts.index')--}}
@extends('exams.exam')

@section('content')
  <div class="col-sm-10 text-left">
    {{--@if(Session::get('current_role')->role_id == 1)--}}
      {{--<div class="arrow-down5"></div>--}}
    {{--@else--}}
      {{--<div class="arrow-down"></div>--}}
    {{--@endif--}}
    <div class="arrow-down"></div>
    <div class="index_head_exam">
      <div class="index_head_exam_text">
        <h1>
          <img src="./images/book1.jpg" alt="Book" width="50px" data-toggle="tooltip" title="Exam">
          Exam.vn
        </h1>
        <p>
          If you fail an examination, it means you have not yet master the subject.
          With diligent study and understanding, you will succeed in passing the exams.
          Remember: "Exams test your memory, life tests your learning. Others will test your patience".
          <br/>
          DON’T STRESS. DO YOUR BEST CAN. GOOD LUCK WITH THE EXAM.
        </p>
      </div>
      <div class="text-center index_head_exam_image">
        <div>
          <img src="./images/book2.jpg" class="img-thumbnail img-circle" alt="Book" width="100px" data-toggle="tooltip"
               title="Exam">
        </div>
      </div>
    </div>

    <hr>

    @if($ky_thi != null)
      @if($time >= $time1 && $time <=$time2)
        <div class="index_exam">
          <div>
            <table class="table_index_exam">
              <thead class="thead_index_exam">
              <tr>
                <th>
                  <h3 class="text-center">
                    <b>Kỳ thi: {{ $ky->name }}</b>
                  </h3>
                </th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td class="text-center">
                  {{ Session::has('message') ? Session::get("message") : '' }}
                  {{ Session::has('mess') ? Session::get("mess") : '' }}
                </td>
              </tr>
              <tr class="tr_index_exam">
                <td>
                  <div class="row m-lr-0">
                    <div class="col-sm-12 index_exam-col12">
                      <p>
                        Môn thi: <b>{{ $mon->dethis->mons->name }}</b>
                      </p>
                      @if($trangthai->trangthai == Config::get('constants.status.2'))
                        <div class="exam_button">
                          <p>
                            <a href="./exam/ketqua">
                              <button class="btn btn-primary index_exam-btn">
                                Xem kết quả
                              </button>
                            </a>
                          </p>
                        </div>
                      @elseif($trangthai->trangthai == Config::get('constants.status.3'))
                        <div class="exam_button">
                          <p>
                            Bạn bị đình chỉ thi.
                          </p>
                        </div>
                      @else
                        <div class="exam_button">
                          <p>
                            <a href="./exam/thi">
                              <button class="btn btn-primary index_exam-btn">
                                Thi
                              </button>
                            </a>
                          </p>

                        </div>
                      @endif
                    </div>
                  </div>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      @else
        <div class="index_exam">
          <div>
            <table class="table_index_exam">
              <thead class="thead_index_exam">
              <tr>
                <th>
                  <h3 class="text-center">
                    <b>Không có kỳ thi nào trong thời gian này !!!</b>
                  </h3>
                </th>
              </tr>
              </thead>
            </table>
          </div>
        </div>
      @endif
    @else
      <div class="index_exam">
        <div>
          <table class="table_index_exam">
            <thead class="thead_index_exam">
            <tr>
              <th>
                <h3 class="text-center">
                  <b>Bạn không có tên trong các kỳ thi !!!</b>
                </h3>
              </th>
            </tr>
            </thead>
          </table>
        </div>
      </div>
    @endif
  </div>

@endsection
