<?php

use Illuminate\Routing\Router;
/*
|-------------------------------------------------------------
| Web Routes
|-------------------------------------------------------------
*/
// Route::get('/', function () {
//   return view('welcome');
// });
// Route::get('/home', function () {
//   return view('welcome');
// });
/*---------------------------- Login/Logout ------------------*/
Route::get('/', 'LoginController@index');
Route::get('/login', 'LoginController@getlogin');
Route::post('/login', 'LoginController@postlogin');
Route::get('/logout', 'LoginController@logout');

/*---------------------------- Sign up ----------------------*/
Route::get('/dangky', 'LoginController@get_dang_ky');
Route::post('/dangky', 'LoginController@post_dang_ky');

/*--------------------- Sửa thông tin -----------------------*/
Route::get('/user-sua/{id}', 'UserController@get_sua_user');
Route::post('/user-sua/{id}', 'UserController@post_sua_user');
/*-----------------------------------------------------------*/
Route::get('/admin', 'ExamController@admin');
/*---------------------------- Users -----------------------------------------------------*/
Route::group(['prefix' => '/users'], function (Router $router)
{
  $router->get('/', 'UserController@index');
  $router->post('/', 'UserController@post_index');

  $router->get('/search', 'UserController@get_search');
  $router->post('/search', 'UserController@post_search');

  $router->get('/create', 'UserController@create');
  $router->post('/create', 'UserController@store');

  $router->get('/edit/{id}', 'UserController@edit');
  $router->post('/edit/{id}', 'UserController@update');

  $router->get('/delete/{id}', 'UserController@destroy');
});

/*---------------------------- Câu Hỏi ---------------------------------------------------*/
Route::group(['prefix' => '/cauhoi'], function (Router $router)
{
  $router->get('/', 'CauhoiController@index');
  $router->post('/', 'CauhoiController@post_index');

  $router->get('/search', 'CauhoiController@get_search');
  $router->post('/search', 'CauhoiController@post_search');

  $router->get('/create', 'CauhoiController@create');
  $router->post('/create', 'CauhoiController@store');

  $router->get('/edit/{id}', 'CauhoiController@edit');
  $router->post('/edit/{id}', 'CauhoiController@update');

  $router->get('/delete/{id}', 'CauhoiController@destroy');
});

/*---------------------------- Đề Thi ----------------------------------------------------*/
Route::group(['prefix' => '/dethi'], function (Router $router)
{
  $router->get('/', 'DethiController@index');
  $router->post('/', 'DethiController@post_index');

  $router->get('/search', 'DethiController@get_search');
  $router->post('/search', 'DethiController@post_search');

  $router->get('/create', 'DethiController@create');
  $router->post('/create', 'DethiController@store');

   $router->get('/themcauhoi/{id}', 'DethiController@get_themcauhoi');
   $router->post('/themcauhoi/{id}', 'DethiController@post_themcauhoi');

  $router->get('/edit/{id}', 'DethiController@edit');
  $router->post('/edit/{id}', 'DethiController@update');

   $router->get('/edit/cauhoi/{id}', 'DethiController@get_edit_cauhoi');
   $router->post('/edit/cauhoi/{id}', 'DethiController@post_edit_cauhoi');

  $router->get('/delete/{id}', 'DethiController@destroy');
  $router->get('/delete-cauhoi/{id_dethi}/{id_cauhoi}', 'DethiController@delete');
});

/*---------------------------- Kỳ Thi ----------------------------------------------------*/
Route::group(['prefix' => '/kythi'], function (Router $router)
{
  $router->get('/', 'KythiController@index');
  $router->post('/', 'KythiController@post_index');

  $router->get('/export/{id}', 'KythiController@export');
  $router->get('/export-user/{id}', 'KythiController@export_user');

  $router->get('/search', 'KythiController@search');
  $router->post('/search', 'KythiController@post_search');

  $router->get('/detail/{id}', 'KythiController@detail');
  $router->post('/detail/{id}', 'KythiController@post_detail');

  $router->get('/detail/search/{id}', 'KythiController@search_detail');
  $router->post('/detail/search/{id}', 'KythiController@post_search_detail');

  $router->get('/detail-user/{id}', 'KythiController@detail_user');

  $router->get('/create', 'KythiController@create');
  $router->post('/create', 'KythiController@store');

  $router->get('/themdethi/{id}', 'KythiController@get_themdethi');
  $router->post('/themdethi/{id}', 'KythiController@post_themdethi');

  $router->get('/themthisinh/{id}', 'KythiController@get_themthisinh');
  // $router->post('/themthisinh/{id}', 'KythiController@post_themthisinh');
  $router->get('/themthisinh/{maky}/{maphong}', 'KythiController@get_phong');
  $router->post('/themthisinh/{maky}/{maphong}', 'KythiController@post_phong');

  $router->get('/edit/{id}', 'KythiController@edit');
  $router->post('/edit/{id}', 'KythiController@update');

  $router->get('/edit/dethi/{id}', 'KythiController@get_edit_dethi');
  $router->post('/edit/dethi/{id}', 'KythiController@post_edit_dethi');

  $router->get('/edit/thisinh/{id}', 'KythiController@get_edit_thisinh');
  // $router->post('/edit/thisinh/{id}', 'KythiController@post_edit_thisinh');
  $router->get('edit/themthisinh/{maky}/{maphong}', 'KythiController@get_edit_phong');
  $router->post('edit/themthisinh/{maky}/{maphong}', 'KythiController@post_edit_phong');


  $router->get('/delete/{id}', 'KythiController@destroy');
  $router->get('/delete-dethi/{id}', 'KythiController@delete_dethi');
  $router->get('/delete-user/{id}', 'KythiController@delete_user');
  $router->get('/reset/{id}', 'KythiController@reset');
});

/*---------------------------- Môn ------------------------------------------------------*/
Route::group(['prefix' => '/mon'], function (Router $router)
{
  $router->get('/', 'MonController@index');
  $router->post('/', 'MonController@post_index');

  $router->get('/search', 'MonController@get_search');
  $router->post('/search', 'MonController@post_search');

  $router->get('/create', 'MonController@create');
  $router->post('/create', 'MonController@store');

  $router->get('/edit/{id}', 'MonController@edit');
  $router->post('/edit/{id}', 'MonController@update');

  $router->get('/delete/{id}', 'MonController@destroy');
});

/*-------------------------- Phòng Thi ---------------------------------------------------*/
Route::group(['prefix' => '/phongthi'], function (Router $router)
{
  $router->get('/', 'PhongthiController@index');
  $router->post('/', 'PhongthiController@post_index');

  $router->get('/search', 'PhongthiController@get_search');
  $router->post('/search', 'PhongthiController@post_search');

  $router->get('/create', 'PhongthiController@create');
  $router->post('/create', 'PhongthiController@store');

  $router->get('/edit/{id}', 'PhongthiController@edit');
  $router->post('/edit/{id}', 'PhongthiController@update');

  $router->get('/delete/{id}', 'PhongthiController@destroy');
});

/*---------------------------- Exam ------------------------------------------------------*/
Route::group(['prefix' => '/exam'], function (Router $router)
{
  $router->get('/', 'ExamController@index');
  // $router->post('/', 'ExamController@post_index');

  $router->get('/thi', 'ExamController@get_thi');
  $router->post('/thi', 'ExamController@post_thi');

  $router->get('/ketqua', 'ExamController@ketqua');

  $router->post('/luubailam', 'ExamController@luubailam');

  /*///////////////////////////////*/
  $router->get('/xemketqua', 'ExamController@get_xemketqua');
  $router->post('/xemketqua', 'ExamController@post_xemketqua');

  $router->get('/bailamthisinh', 'ExamController@get_bailam');
  $router->post('/bailamthisinh', 'ExamController@post_bailam');

});
/*----------------------------------------------------------------------------------------*/
