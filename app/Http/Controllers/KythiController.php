<?php

namespace App\Http\Controllers;

use App\Models\Kythi;
use App\Models\Kythi_de;
use App\Models\Dethi;
use App\Models\Admin_User;
use App\Models\Kythisinhvien;
use App\Models\Phongthi;
use App\Models\Bailam;
use App\Models\Mon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use League\Flysystem\Config;

class KythiController extends Controller
{
  public function index()
  {
    $kythis = Kythi::paginate(10);
    $listmon = [];
    $mons = Mon::all();
    foreach ($mons as $m) {
      $listmon[$m->id] = $m->name;
    }
    $arr_mon = [];
    foreach ($kythis as $kythi)
    {
      $dethi = Kythi_de::where('makythi', $kythi->id)->first();
      $de = Dethi::where('id', $dethi->madethi)->first();
      $arr_mon[$kythi->id] = $de->mons->name;
    }

    return view('kythi.index', compact('kythis', 'listmon', 'arr_mon'));
  }
  public function post_index()
  {
    session(['search_kythi_id' => $_POST['id']]);
    session(['search_kythi_name' => $_POST['name']]);
    session(['search_kythi_mon' => $_POST['mon']]);
    session(['search_kythi_ngaythi' => $_POST['ngaythi']]);

    return redirect('/kythi/search');
  }

  public function search()
  {
    $search_id = session('search_kythi_id');
    $search_name = session('search_kythi_name');
    $search_mon = session('search_kythi_mon');
    $search_ngaythi = session('search_kythi_ngaythi');

    if (empty($search_id) && empty($search_name) && empty($search_mon) && empty($search_ngaythi))
    {
      session()->flash('messages', '(*Hãy nhập thông tin cần tìm !!!)');
      return redirect('/kythi');
    }

    $all_ky = Kythi::all();

      // ID
    if (!empty($search_id))
    {
      $kythis = Kythi::where('id', $search_id)->paginate(10);
    }
      // NAME, NGÀY THI, MÔN
    if(!empty($search_name) && !empty($search_mon) && !empty($search_ngaythi) && empty($search_id))
    {
      $name_ky = Kythi::where('name', 'like', '%' . $search_name . '%')->get();
      $arr_mon = [];
      $list_ky = [];
      foreach ($name_ky as $k)
      {
        $ky_de = Kythi_de::where('makythi', $k->id)->first();
        $arr_mon[] = $ky_de->dethis->mon;
        if ($ky_de->dethis->mon == $search_mon)
        {
          $ngay_thi = strtotime($search_ngaythi);
          $begin = strtotime($k->begin);
          $end = strtotime($k->end);
          if ($ngay_thi >= $begin && $ngay_thi <= $end)
          {
            $list_ky[] = $k->id;
          }
        }
      }
      $kythis = Kythi::whereIn('id', $list_ky)->paginate(10);

    }
      //NAME, MÔN
    if(!empty($search_name) && !empty($search_mon) && empty($search_ngaythi) && empty($search_id))
    {
      $name_ky = Kythi::where('name', 'like', '%' . $search_name . '%')->get();
      $arr_mon = [];
      $list_ky = [];
      foreach ($name_ky as $k)
      {
        $ky_de = Kythi_de::where('makythi', $k->id)->first();
        $arr_mon[] = $ky_de->dethis->mon;
        if ($ky_de->dethis->mon == $search_mon)
        {
            $list_ky[] = $k->id;
        }
      }
      $kythis = Kythi::whereIn('id', $list_ky)->paginate(10);
    }
      // NAME, NGÀY THI
    if(!empty($search_name) && empty($search_mon) && !empty($search_ngaythi) && empty($search_id))
    {
      $name_ky = Kythi::where('name', 'like', '%' . $search_name . '%')->get();
      $arr_mon = [];
      $list_ky = [];
      foreach ($name_ky as $k)
      {
        $ky_de = Kythi_de::where('makythi', $k->id)->first();
        $arr_mon[] = $ky_de->dethis->mon;
        $ngay_thi = strtotime($search_ngaythi);
        $begin = strtotime($k->begin);
        $end = strtotime($k->end);
        if ($ngay_thi >= $begin && $ngay_thi <= $end)
        {
          $list_ky[] = $k->id;
        }
      }
      $kythis = Kythi::whereIn('id', $list_ky)->paginate(10);
    }
      // NGÀY THI, MÔN
    if(empty($search_name) && !empty($search_mon) && !empty($search_ngaythi) && empty($search_id))
    {
      $arr_mon = [];
      $list_ky = [];
      foreach ($all_ky as $k)
      {
        $ky_de = Kythi_de::where('makythi', $k->id)->first();
        $arr_mon[] = $ky_de->dethis->mon;
        if ($ky_de->dethis->mon == $search_mon)
        {
          $ngay_thi = strtotime($search_ngaythi);
          $begin = strtotime($k->begin);
          $end = strtotime($k->end);
          if ($ngay_thi >= $begin && $ngay_thi <= $end)
          {
            $list_ky[] = $k->id;
          }
        }
      }
      $kythis = Kythi::whereIn('id', $list_ky)->paginate(10);

    }
      // NAME
    if (!empty($search_name) && empty($search_mon) && empty($search_ngaythi) && empty($search_id))
    {
      $kythis = Kythi::where('name', 'like', '%' . $search_name . '%')->paginate(10);
    }
    // MÔN
    if (empty($search_name) && !empty($search_mon) && empty($search_ngaythi) && empty($search_id))
    {
      $listky = [];
      foreach ($all_ky as $kythi)
      {
        $ky_de = Kythi_de::where('makythi', $kythi->id)->first();
        if ($ky_de->dethis->mon == $search_mon)
        {
          $listky[] = $kythi->id;
        }
      }

      $kythis = Kythi::whereIn('id', $listky)->paginate(10);
    }
    // NGÀY THI
    if (empty($search_name) && empty($search_mon) && !empty($search_ngaythi) && empty($search_id))
    {
      $list_ky = [];
      foreach ($all_ky as $k)
      {
        $ngay_thi = strtotime($search_ngaythi);
        $begin = strtotime($k->begin);
        $end = strtotime($k->end);
        if ($ngay_thi >= $begin && $ngay_thi <= $end)
        {
          $list_ky[] = $k->id;
        }
      }
      $kythis = Kythi::whereIn('id', $list_ky)->paginate(10);
    }

    //Thông báo khi $kythis không tồn tại
    if (count($kythis) == 0)
    {
      session()->flash('messages', '(*Kỳ thi không tồn tại !!!)');
      return redirect('/kythi');
    }

    $subject = [];
    foreach ($all_ky as $k)
    {
      $dethi = Kythi_de::where('makythi', $k->id)->first();
      if (isset($dethi))
      {
        $subject[$k->id] = $dethi->dethis->mons->name;
      }else{
        $subject[$k->id] = '_';
      }
    }
    $mons = Mon::all();
    $listmon = [];
    foreach ($mons as $mon) {
      $listmon[$mon->id] = $mon->name;
    }

    return view('kythi.search', compact('listmon', 'kythis', 'subject'));
  }
  public function post_search()
  {
    session(['search_kythi_id' => $_POST['id']]);
    session(['search_kythi_name' => $_POST['name']]);
    session(['search_kythi_mon' => $_POST['mon']]);
    session(['search_kythi_ngaythi' => $_POST['ngaythi']]);

    return redirect('/kythi/search');
  }


  public function detail($id)
  {
    $kythi = Kythi::where('id', $id)->first();
    $kythis = Kythisinhvien::where('makythi', $id)->paginate(10);

    session(['detail_kythi' => $id]);

    $arr_diemcauhoi = [];
    $arr_diemthisinh = [];
    $arr_duyet = [];
    $arr_de = [];
    foreach ($kythis as $ky)
    {
      if ($ky->trangthai == Config('constants.status.2'))
      {
        $bai = Bailam::where([
            ['makythi', $id],
            ['user_id', $ky->user_id]
        ])->first();
        $bailam = Bailam::where([
            ['makythi', $id],
            ['user_id', $ky->user_id]
        ])->get();
        $diemcauhoi = 0;
        $diemthisinh = 0;
        foreach ($bailam as $b)
        {
          $diemcauhoi += $b->diemcauhoi;
          $diemthisinh += $b->diemcauhoicuathisinh;
        }
        $phantram = $diemthisinh*100/$diemcauhoi;
        if ($phantram >=  $ky->kythis->diemdat)
        {
          $duyet = Config('constants.approval.0');
        }else{
          $duyet = Config('constants.approval.1');
        }
        $arr_diemcauhoi[$ky->user_id] = $diemcauhoi;
        $arr_diemthisinh[$ky->user_id] = $diemthisinh;
        $arr_duyet[$ky->user_id] = $duyet;
        $arr_de[$ky->user_id] = $bai->madethi;

      }else{
        $arr_diemcauhoi[$ky->user_id] = '_';
        $arr_diemthisinh[$ky->user_id] = '_';
        $arr_duyet[$ky->user_id] = '_';
        $arr_de[$ky->user_id] = '_';
      }
    }

    return view('kythi.details.detail', compact('kythi', 'kythis', 'arr_diemcauhoi',
                      'arr_diemthisinh', 'arr_duyet', 'arr_de'));
  }
  public function post_detail($id)
  {
    session(['detail_search_id' => $_POST['id']]);
    session(['detail_search_name' => $_POST['name']]);
    session(['detail_search_ngaysinh' => $_POST['ngaysinh']]);
    session(['detail_search_trangthai' => $_POST['trangthai']]);

    return redirect('/kythi/detail/search/'.$id);
  }

  // Tìm kiếm user trong chi tiết thí sinh
  public function search_detail($id)
  {
    $search_id = session('detail_search_id');
    $search_name = session('detail_search_name');
    $search_birth = session('detail_search_ngaysinh');
    $search_trangthai = session('detail_search_trangthai');

    if (empty($search_id) && empty($search_name) && empty($search_birth) && empty($search_trangthai))
    {
      session()->flash('messages', '(*Hãy nhập thông tin cần tìm !!!)');
      return redirect('/kythi/detail/'.$id);
    }

    $kythis = Kythisinhvien::where('makythi', $id)->get();
      // ID
    if (!empty($search_id))
    {
      $users = Kythisinhvien::where([
          ['makythi', $id],
          ['user_id', $search_id]
      ])->get();
    }
      // NAME, NGÀY SINH, TRẠNG THÁI
    elseif (!empty($search_name) && !empty($search_birth) && !empty($search_trangthai) && empty($search_id))
    {
      $user_arr = [];
      foreach ($kythis as $k)
      {
        if (strtotime($k->users->birthday) == strtotime($search_birth) && $k->trangthai == $search_trangthai)
        {
          $user_arr[] = $k->user_id;
        }
      }
      $user = Admin_User::whereIn('id', $user_arr)
                                      ->where('username', 'like', '%' . $search_name . '%')->get();
      $listuser = [];
      foreach ($user as $u)
      {
        $listuser[] = $u->id;
      }
      $users = Kythisinhvien::where('makythi', $id)->whereIn('user_id', $listuser)->get();
    }
      // NAME, NGÀY SINH
    elseif (!empty($search_name) && !empty($search_birth) && empty($search_trangthai) && empty($search_id))
    {
      $user_arr = [];
      foreach ($kythis as $k)
      {
        if (strtotime($k->users->birthday) == strtotime($search_birth))
        {
          $user_arr[] = $k->user_id;
        }
      }
      $user = Admin_User::whereIn('id', $user_arr)
          ->where('username', 'like', '%' . $search_name . '%')->get();
      $listuser = [];
      foreach ($user as $u)
      {
        $listuser[] = $u->id;
      }
      $users = Kythisinhvien::where('makythi', $id)->whereIn('user_id', $listuser)->get();
    }
      // NAME, TRẠNG THÁI
    elseif (!empty($search_name) && empty($search_birth) && !empty($search_trangthai) && empty($search_id))
    {
      $user_arr = [];
      foreach ($kythis as $k)
      {
        if ($k->trangthai == $search_trangthai)
        {
          $user_arr[] = $k->user_id;
        }
      }
      $user = Admin_User::whereIn('id', $user_arr)
          ->where('username', 'like', '%' . $search_name . '%')->get();
      $listuser = [];
      foreach ($user as $u)
      {
        $listuser[] = $u->id;
      }
      $users = Kythisinhvien::where('makythi', $id)->whereIn('user_id', $listuser)->get();
    }
      //NGÀY SINH, TRẠNG THÁI
    elseif (empty($search_name) && !empty($search_birth) && !empty($search_trangthai) && empty($search_id))
    {
      $users = [];
      foreach ($kythis as $k)
      {
        if (strtotime($k->users->birthday) == strtotime($search_birth)
                    && $k->trangthai == $search_trangthai)
        {
          $users[] = $k;
        }
      }
    }
      // NAME
    elseif (!empty($search_name) && empty($search_birth) && empty($search_trangthai) && empty($search_id))
    {
      $user_arr = [];
      foreach ($kythis as $k)
      {
        $user_arr[] = $k->user_id;
      }
      $user = Admin_User::whereIn('id', $user_arr)->where('username', 'like', '%' . $search_name . '%')->get();
      $listuser = [];
      foreach ($user as $u)
      {
        $listuser[] = $u->id;
      }
      $users = Kythisinhvien::where('makythi', $id)->whereIn('user_id', $listuser)->get();
    }
      // NGÀY SINH
    elseif (empty($search_name) && !empty($search_birth) && empty($search_trangthai) && empty($search_id))
    {
      $users = [];
      foreach ($kythis as $k)
      {
        if (strtotime($k->users->birthday) == strtotime($search_birth))
        {
          $users[] = $k;
        }
      }
    }
      // TRẠNG THÁI
    elseif (empty($search_name) && empty($search_birth) && !empty($search_trangthai) && empty($search_id))
    {
      $users = [];
      foreach ($kythis as $k)
      {
        if ($k->trangthai == $search_trangthai)
        {
          $users[] = $k;
        }
      }
    }

    //Thông báo lỗi khi $users koong tồn tại
    if (count($users) == 0)
    {
      session()->flash('messages', '(*Không tồn tại thí sinh !!!)');
      return redirect('/kythi/detail/'.$id);
    }

    $kythi = Kythi::where('id', $id)->first();
    $arr_diemcauhoi = [];
    $arr_diemthisinh = [];
    $arr_duyet = [];
    $arr_de = [];
    foreach ($users as $u)
    {
      if ($u->trangthai == Config('constants.status.2'))
      {
        $bai = Bailam::where([
            ['makythi', $id],
            ['user_id', $u->user_id]
        ])->first();
        $bailam = Bailam::where([
            ['makythi', $id],
            ['user_id', $u->user_id]
        ])->get();
        $diemcauhoi = 0;
        $diemthisinh = 0;
        foreach ($bailam as $b)
        {
          $diemcauhoi += $b->diemcauhoi;
          $diemthisinh += $b->diemcauhoicuathisinh;
        }
        $phantram = $diemthisinh*100/$diemcauhoi;
        if ($phantram >=  $u->kythis->diemdat)
        {
          $duyet = Config('constants.approval.0');
        }else{
          $duyet = Config('constants.approval.1');
        }
        $arr_diemcauhoi[$u->user_id] = $diemcauhoi;
        $arr_diemthisinh[$u->user_id] = $diemthisinh;
        $arr_duyet[$u->user_id] = $duyet;
        $arr_de[$u->user_id] = $bai->madethi;

      }else{
        $arr_diemcauhoi[$u->user_id] = '_';
        $arr_diemthisinh[$u->user_id] = '_';
        $arr_duyet[$u->user_id] = '_';
        $arr_de[$u->user_id] = '_';
      }
    }

    return view('kythi.details.search_detail', compact('kythi', 'users', 'arr_diemcauhoi',
                      'arr_diemthisinh', 'arr_duyet', 'arr_de'));
  }
  public function post_search_detail($id)
  {
    session(['detail_search_id' => $_POST['id']]);
    session(['detail_search_name' => $_POST['name']]);
    session(['detail_search_ngaysinh' => $_POST['ngaysinh']]);
    session(['detail_search_trangthai' => $_POST['trangthai']]);

    return redirect('/kythi/detail/search/'.$id);
  }

  public function export($id)
  {
    $headers = [
        'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
        'Content-type'        => 'text/csv; charset=UTF-8',
        'Content-Disposition' => 'attachment; filename=exam_user.csv',
        'Content-Encoding'    => 'Unicode',
        'Pragma'              => 'public',
    ];

    $reviews = Kythisinhvien::where('makythi', $id)->get();
    $kythi = Kythi::where('id', $id)->first();
    $file = fopen('php://output', 'w');
    fputs($file, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

    $name = Config('constants.detail.1').$kythi->name;
    $dau = html_entity_decode('&ge; ');
    $diemdat  = Config('constants.detail.6').$dau.$kythi->diemdat.' (%)';

    fputcsv($file, array(''));
    fputcsv($file, array( '', $name, '', $diemdat));
    fputcsv($file, array(''));
    $columns = array('STT', 'Tên người dùng', 'Tên', 'ngày sinh', 'Đề thi', 'Trạng thái', 'Tổng điểm câu hỏi', 'Điểm của thí sinh',
                        'Duyệt');
    $callback = function() use ($reviews, $columns)
    {
      $file = fopen('php://output', 'w');
      fputs($file, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

      fputcsv($file, $columns);

      foreach($reviews as $key => $review)
      {
        if($review->trangthai == Config('constants.status.2'))
        {
          $bai = Bailam::where([
              ['makythi', $review->makythi],
              ['user_id', $review->user_id]
          ])->first();
          $bailam = Bailam::where([
            ['makythi', $review->makythi],
            ['user_id', $review->user_id]
          ])->get();
          $diemcauhoi = 0;
          $diemthisinh = 0;
          foreach ($bailam as $b)
          {
            $diemcauhoi += $b->diemcauhoi;
            $diemthisinh += $b->diemcauhoicuathisinh;
          }
          $phantram = $diemthisinh*100/$diemcauhoi;
          if ($phantram >=  $review->kythis->diemdat)
          {
            $duyet = Config('constants.approval.0');
          }else{
            $duyet = Config('constants.approval.1');
          }
          $dethi = $bai->madethi;
        }else{
          $diemcauhoi = '_';
          $diemthisinh = '_';
          $duyet = '_';
          $dethi = '_';
        }

        fputcsv($file, array($key+1, $review->users->username, $review->users->name,
            date('d/m/Y', strtotime($review->users->birthday)), $dethi, $review->trangthai,
            $diemcauhoi, $diemthisinh, $duyet));
      }
      fclose($file);
    };

    return Response::stream($callback, 200, $headers);
  }

  public function detail_user($id)
  {
    session(['ky_userID' => $id]);
    $kythi = Kythisinhvien::where([
        ['user_id', $id],
        ['makythi', session('detail_kythi')]
    ])->first();

    if ($kythi->trangthai == Config('constants.status.2'))
    {
      $bai = Bailam::where([
          ['user_id', $id],
          ['makythi', session('detail_kythi')]
      ])->first();

      $bailam = Bailam::where([
          ['user_id', $id],
          ['makythi', session('detail_kythi')]
      ])->paginate(10);

      $listdiemcauhoi = [];
      $listdiem = [];
      foreach ($bailam as $b)
      {
        $listdiemcauhoi[] = $b->diemcauhoi;
        $listdiem[] = $b->diemcauhoicuathisinh;
      }
      $tongdiemcauhoi = 0;
      for ($i = 0; $i < count($bailam); $i++)
      {
        $tongdiemcauhoi = $tongdiemcauhoi + $listdiemcauhoi[$i];
      }
      $tongdiem = 0;
      for ($i = 0; $i < count($bailam); $i++) {
        $tongdiem = $tongdiem + $listdiem[$i];
      }
      if ($tongdiemcauhoi != 0) {
        $phantram = ($tongdiem / $tongdiemcauhoi) * 100;
      } else {
        $phantram = 0;
      }
      $diemdat = Kythi::where('id', session('detail_kythi'))->first();

      if ($phantram >= $diemdat->diemdat) {
        $duyet = Config('constants.approval.0');
      } else {
        $duyet = Config('constants.approval.1');
      }

      session(['tongdiemcauhoi' => $tongdiemcauhoi]);
      session(['tongdiem' => $tongdiem]);
      session(['duyet' => $duyet]);
    }

    return view('kythi.details.detail_user', compact('kythi', 'bailam', 'tongdiemcauhoi', 'tongdiem',
                'phantram', 'duyet', 'bai'));
  }
  public function export_user($id)
  {
    $headers = [
        'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
        'Content-type'        => 'text/csv',
        'Content-Disposition' => 'attachment; filename=exam_detail.csv',
        'Expires'             => '0',
        'Pragma'              => 'public',
    ];

    $kythi = Kythisinhvien::where([
        ['user_id', $id],
        ['makythi', session('detail_kythi')]
    ])->first();
    $bai = Bailam::where([
        ['user_id', $id],
        ['makythi', session('detail_kythi')]
    ])->first();

    $bailam = Bailam::where([
        ['user_id', $id],
        ['makythi', session('detail_kythi')]
    ])->get();
    $file = fopen('php://output', 'w');
    fputs($file, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

    $name           = Config('constants.detail.0').$kythi->users->name;
    $name_ky        = Config('constants.detail.1').$kythi->kythis->name;
    $dethi          = Config('constants.detail.2').$bai->dethis->name;
    $mon            = Config('constants.detail.3').$bai->mons->name;
    $tongdiemcauhoi = Config('constants.detail.4').session('tongdiemcauhoi').'(đ)';
    $tongdiem       = Config('constants.detail.5').session('tongdiem').'(đ)';
    $dau            = html_entity_decode('&ge; ');
    $diemdat        = Config('constants.detail.6').$dau.$kythi->kythis->diemdat.'(%)';
    $duyet          = Config('constants.detail.7').session('duyet');

    fputcsv($file, array(''));
    fputcsv($file, array($name, '', $name_ky, '', $dethi, '', $mon));
    fputcsv($file, array('', $tongdiemcauhoi, '', $tongdiem, '', $diemdat, '', $duyet));
    fputcsv($file, array(''));
    $columns = array('STT', 'Loại câu hỏi', 'Đáp án', 'Điểm', 'Đáp án của thí sinh', 'Điểm của thí sinh',
        'Update_at');
    $callback = function() use ($bailam, $columns)
    {
      $file = fopen('php://output', 'w');
      fputs($file, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

      fputcsv($file, $columns);
      foreach($bailam as $key => $review)
      {
        $cau = 'câu '.($key+1);
        $dapancauhoi = implode(', ', json_decode($review->dapancauhoi));
        $dapanthisinh = implode(', ', json_decode($review->dapancuathisinh));
        if(json_decode($review->dapancuathisinh) != 0)
        {
          fputcsv($file, array($cau, $review->cauhois->loaicauhoi, $dapancauhoi, $review->diemcauhoi,
              $dapanthisinh, $review->diemcauhoicuathisinh, date('H:i d/m/Y', strtotime($review->updated_at))));
        }else{
          fputcsv($file, array($cau, $review->cauhois->loaicauhoi, $dapancauhoi, $review->diemcauhoi,
              $review->dapancuathisinh, $review->diemcauhoicuathisinh, date('H:i d/m/Y', strtotime($review->updated_at))));
        }
      }
      fclose($file);
    };

    return Response::stream($callback, 200, $headers);
  }


  public function create()
  {
    $mons = Mon::all();
    $listmon = [];
    foreach ($mons as $mon) {
      $listmon[$mon->id] = $mon->name;
    }

    return view('kythi.create', compact('listmon'));
  }

  public function store()
  {
    $name = $_POST['name'];
    $begin = $_POST['begin'];
    $end = $_POST['end'];
    $thoigianthi = $_POST['thoigianthi'];
    $diemdat = $_POST['diemdat'];
    $mon = $_POST['mon'];

    Kythi::insert([
        'name' => $name,
        'begin' => $begin,
        'end' => $end,
        'thoigianthi' => $thoigianthi,
        'diemdat' => $diemdat,
        'created_at' => date('Y-m-d H:i:s'),
    ]);
    $kythi_id = DB::getPdo()->lastInsertId();
    session(['current_kythi' => $kythi_id]);
    session(['current_kythi_mon' => $mon]);

    return redirect('/kythi/themdethi/' . $kythi_id);
  }

  public function get_themdethi($id)
  {
    $dethi = Dethi::where('mon', session('current_kythi_mon'))->paginate(10);

    return view('kythi.create.themdethi', compact('dethi'));
  }

  public function post_themdethi($id)
  {
    if (isset($_POST['chkitem'])) {
      $dethi = $_POST['chkitem'];
      foreach ($dethi as $d) {
        Kythi_de::insert([
            'makythi' => $id,
            'madethi' => $d,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
      }
    }
    return redirect('kythi/themthisinh/' . session('current_kythi'));
  }

  public function get_themthisinh($id)
  {
    $ky = $id;
    $user = Admin_User::paginate(10);
    $phongthi = Phongthi::all();

    return view('kythi.create.themthisinh', compact('user', 'phongthi', 'ky'));
  }

  public function get_phong($maky, $maphong)
  {
    $phongthi = Phongthi::where('id', $maphong)->first();

    $username = Kythisinhvien::where('makythi', $maky)->get();

    $array = [];
    foreach ($username as $value)
    {
      $array[] = $value->user_id;
    }
    $user = Admin_User::whereNotIn('id', $array)->paginate(10);

    return view('kythi.create.themthisinh_phong', compact('phongthi', 'user'));
  }
  public function post_phong($maky, $maphong)
  {
    if (isset($_POST['chkitem']))
    {
      $users = $_POST['chkitem'];
      foreach ($users as $u)
      {
        Kythisinhvien::insert([
            'user_id' => $u,
            'makythi' => $maky,
            'maphongthi' => $maphong,
            'trangthai' => Config('constants.status.0'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
      }
    }
    return redirect('/kythi/themthisinh/' . session('current_kythi'));
  }

  // public function post_themthisinh(Request $request, $id)
  // {
  //   // $ip = $request->ip();
  //   // $phongthi = Phongthi::all();
  //   // $ip1 = explode('.', $ip);
  //   // $allow_ip = false;
  //   // foreach ($phongthi as $pt)
  //   // {
  //   //   $start = explode('.', $pt->IP_begin);
  //   //   $end = explode('.', $pt->IP_end);
  //   //   if ($ip1[3] >= $start[3] && $ip1[3] <= $end[3])
  //   //   {
  //   //     $phong = $pt->id;
  //   //     $allow_ip = true;
  //   //     break;
  //   //   }
  //   // }
  //   if (isset($_POST['chkitem']))
  //   {
  //     $users = $_POST['chkitem'];
  //     foreach ($users as $u)
  //     {
  //       Kythisinhvien::insert([
  //           'user_id' => $u,
  //           'makythi' => $id,
  //           // 'maphongthi' => $phong,
  //           'trangthai' => Config('constants.status.0'),
  //           'created_at' => date('Y-m-d H:i:s'),
  //       ]);
  //     }
  //   }
  //   return redirect('kythi');
  // }

  public function edit($id)
  {
    $kythi = Kythi::find($id);
    session(['edit_kythi' => $kythi]);
    $ky_de = Kythi_de::where('makythi', $id)->paginate(10);
    $ky_user = Kythisinhvien::where('makythi', $id)->paginate(10);

    $begin = $kythi->begin;
    $be_gin = str_replace(' ', 'T', $begin);
    $end = $kythi->end;
    $end_str = str_replace(' ', 'T', $end);

    return view('kythi.edit', compact('kythi', 'ky_de', 'ky_user', 'be_gin', 'end_str'));
  }

  public function update($id)
  {
    $name = $_POST['name'];
    $begin = $_POST['begin'];
    $end = $_POST['end'];
    $thoigianthi = $_POST['thoigianthi'];
    $diemdat = $_POST['diemdat'];
    if ($name == '' || $begin == '' || $end == '' || $diemdat == '' || $thoigianthi == '')
    {
      return redirect('kythi/edit/' . $id)
          ->with(['error_kythi' => '*Hãy nhập đầy đủ thông tin !!!']);
    }
    Kythi::where('id', $id)->update([
        'name' => $name,
        'begin' => $begin,
        'end' => $end,
        'thoigianthi' => $thoigianthi,
        'diemdat' => $diemdat,
        'updated_at' => date('Y-m-d H:i:s'),
    ]);

    return redirect('kythi/edit/dethi/' . $id);
  }

  public function get_edit_dethi($id)
  {
    $kythi_de = Kythi_de::where('makythi', $id)->get();
    $kythi_de1 = Kythi_de::where('makythi', $id)->first();

    if ($kythi_de1 != '') {
      $mon = $kythi_de1->dethis->mon;

      $arry = [];
      foreach ($kythi_de as $value) {
        $arry[] = $value->madethi;
      }
      $dethi = Dethi::where('mon', $mon)->whereNotIn('id', $arry)->paginate(10);
    } else {
      $dethi = Dethi::paginate(10);
    }

    return view('kythi.edits.dethi', compact('dethi'));
  }

  public function post_edit_dethi($id)
  {
    if (isset($_POST['chkitem'])) {
      $dethi = $_POST['chkitem'];
      foreach ($dethi as $d) {
        Kythi_de::insert([
            'makythi' => $id,
            'madethi' => $d,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
      }
    }

    return redirect('kythi/edit/thisinh/' . $id);
  }

  public function get_edit_thisinh($id)
  {
    $ky = $id;
    $username = Kythisinhvien::where('makythi', $id)->get();
    $phongthi = Phongthi::all();

    $arry = [];
    foreach ($username as $value)
    {
      $arry[] = $value->user_id;
    }
    $user = Admin_User::whereNotIn('id', $arry)->paginate(10);
    $users = Admin_User::paginate(10);

    return view('kythi.edits.thisinh', compact('user', 'phongthi', 'ky', 'users'));
  }

  public function get_edit_phong($maky, $maphong)
  {
    $username = Kythisinhvien::where('makythi', $maky)->get();
    $phongthi = Phongthi::where('id', $maphong)->first();

    $arry = [];
    foreach ($username as $value)
    {
      $arry[] = $value->user_id;
    }
    $user = Admin_User::whereNotIn('id', $arry)->paginate(10);

    return view('kythi.edits.thisinh_phongthi', compact('user', 'phongthi', 'maky', 'maphong'));
  }
  public function post_edit_phong($maky, $maphong)
  {
    if (isset($_POST['chkitem'])) {
      $users = $_POST['chkitem'];
      foreach ($users as $u) {
        Kythisinhvien::insert([
            'user_id' => $u,
            'makythi' => $maky,
            'maphongthi' => $maphong,
            'trangthai' => Config('constants.status.0'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
      }
    }

    return redirect('kythi/edit/thisinh/'.$maky);
  }

  // public function post_edit_thisinh(Request $request, $id)
  // {
  //   if (isset($_POST['chkitem'])) {
  //     $users = $_POST['chkitem'];
  //     foreach ($users as $u) {
  //       Kythisinhvien::insert([
  //           'user_id' => $u,
  //           'makythi' => $id, 
  //           'trangthai' => Config('constants.status.0'),
  //           'created_at' => date('Y-m-d H:i:s'),
  //       ]);
  //     }
  //   }

  //   return redirect('kythi');
  // }


  public function destroy($id)
  {
    Kythi::find($id)->delete();
    Kythi_de::where('makythi', $id)->delete();
    Kythisinhvien::where('makythi', $id)->delete();
    return redirect('kythi');
  }

  public function delete_dethi($id)
  {
    $kythi = Kythi_de::where([
        ['makythi', session('edit_kythi')->id],
        ['madethi', $id]
    ])->first();
    $kythi_id = $kythi->makythi;

    Kythi_de::where([
        ['makythi', session('edit_kythi')->id],
        ['madethi', $id]
    ])->delete();

    $dethi = Kythi_de::where('makythi', session('edit_kythi')->id)->first();
    if ($dethi == '') {
      Kythisinhvien::where('makythi', session('edit_kythi')->id)->delete();
    }

    return redirect('kythi/edit/' . $kythi_id);
  }

  public function delete_user($id)
  {
    $kythi = Kythisinhvien::where([
        ['user_id', $id],
        ['makythi', session('edit_kythi')->id],
    ])->first();
    $kythi_id = $kythi->makythi;

    Kythisinhvien::where([
        ['user_id', $id],
        ['makythi', session('edit_kythi')->id],
    ])->delete();

    return redirect('kythi/edit/' . $kythi_id);
  }

  public function reset($id)
  {
    $kythis = Kythisinhvien::where('makythi', $id)->get();
    foreach ($kythis as $kythi) {
      Kythisinhvien::where('user_id', $kythi->user_id)->update([
          'trangthai' => Config('constants.status.0'),
      ]);
    }
    Bailam::where('makythi', $id)->delete();
    return redirect('kythi');
  }
}
