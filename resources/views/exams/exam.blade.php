<!DOCTYPE html>
<html lang="en">
<head>
  @include('partials.head')
</head>
<body>
<?php
$image = Session::get('current_user')->avatar;
$avatar = asset($image);
?>
<nav class="navbar navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">
        <b>EXAM</b>
      </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li>
          <a href="{{ asset('/exam') }}">
            <b>Exam</b>
          </a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">

        @if(Session::get('current_role')->role_id == 1)
          <li>
            <a href="./admin">Admin</a>
          </li>
        @endif

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ $avatar }}" class="img-circle" alt="Avatar" width="25" height="18">
            <span class="ml10">{{ Session::get('current_user')->username }}</span>
            <span class="caret"></span></b>
          </a>
          <ul class="dropdown-menu dropdown-menu-righ">
            <div class="arrow-up1"></div>
            <li class="user-header">
              <img src="{{ $avatar }}" class="img-circle" alt="Avatar"
                   width="90" height="80" data-toggle="tooltip"
                   data-placement="left"
                   title="{{ Session::get('current_user')->username}}">
              <p>
                {{ strtoupper(Session::get('current_user')->name) }}
                <br>
                @if(Session::get('current_role')->role_id == 1)
                  <small>( Quản trị viên )</small>
                @elseif(Session::get('current_role')->role_id == 2)
                  <small>( Thí sinh )</small>
                @endif
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="./user-sua/{{Session::get('current_user')->id}}" class="btn btn-default">Sửa thông tin</a>
              </div>
              <div class="pull-right">
                <a href="{{ asset('/logout') }}" class="btn btn-default">Logout</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="content text-center">
  <div class="row content">

    @yield('content')

    @include('partials.col-sm-2')
  </div>
</div>

@include('partials.footer')

</body>
</html>