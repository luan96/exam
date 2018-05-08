<?php
$image = session('current_user')->avatar;
$avatar = asset($image);
?>
<div class="col-sm-2 sidenav text-center">
  <img src="{{ $avatar }}" class="img-thumbnail" alt="Avatar" data-toggle="tooltip" data-placement="left"
       title="{{ Session::get('current_user')->username}}">
  <div class="shadowbox">
    <div class="headbox">
      <h3 style="font-size: 1.3em;">
        <strong>{{ Session::get('current_user')->name }}</strong>
      </h3>
    </div>
    <div class="student">
      <div class="text-left">
        Name: <strong>{{ Session::get('current_user')->name }}</strong>
      </div>
      <div class="text-left">
        Username: <strong>{{ Session::get('current_user')->username }}</strong>
      </div>
      <div class="text-left">
        Ngày sinh: <strong>{{ date('d-m-Y', strtotime(Session::get('current_user')->birthday)) }}</strong>
      </div>
      <div class="text-left">
        Ngày tạo: <strong>{{ date('d/m/Y', strtotime(Session::get('current_user')->created_at)) }}</strong>
      </div>
    </div>
  </div>
</div>
