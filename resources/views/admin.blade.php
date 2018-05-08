@extends('layouts.index')

@section('content')
  <div class="col-sm-10 text-left">
    <div class="page">
      <div class="page-title">
        <h4>
          Xin chào <b>{{ $user->name }}</b>
        </h4>
        <div class="other">
          <ul>
            <li>
              <a href="./users">Users</a>
            </li>
            <li>
              <a href="./kythi">Kỳ thi</a>
            </li>
            <li>
              <a href="./dethi">Đề thi</a>
            </li>
            <li>
              <a href="./cauhoi">Câu hỏi</a>
            </li>
            <li>
              <a href="./mon">Môn thi</a>
            </li>
            <li>
              <a href="./exam">Thi</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

@endsection