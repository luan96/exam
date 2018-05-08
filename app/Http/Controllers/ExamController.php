<?php

namespace App\Http\Controllers;

use App\Models\Mon;
use App\Models\Kythi;
use App\Models\Dethi;
use App\Models\Kythi_de;
use App\Models\Dethi_cauhoi;
use App\Models\Cauhoi;
use App\Models\Kythisinhvien;
use App\Models\Bailam;
use App\Models\Admin_User;


use Illuminate\Http\Request;

class ExamController extends Controller
{
  public function index()
  {
    $now = date('Y-m-d H:i:s');
    $time = strtotime($now);

    $kythis = Kythisinhvien::where('user_id', session('current_user')->id)->get();
    $ky_thi = Kythisinhvien::where('user_id', session('current_user')->id)->first();

    if ($ky_thi != null) {
      foreach ($kythis as $array_ky) {
        $ky = Kythi::where('id', $array_ky->makythi)->first();
        session(['exam_kythi' => $ky]);

        $time1 = strtotime($ky->begin);
        $time2 = strtotime($ky->end);

        if ($time >= $time1 && $time <= $time2) {
          $trangthai = Kythisinhvien::where([
              ['makythi', $array_ky->makythi],
              ['user_id', session('current_user')->id]
          ])->first();
          $mon = Kythi_de::where('makythi', $array_ky->makythi)->first();
          break;
        }
      }
    }

    return view('exams.index', compact('ky_thi', 'ky', 'time', 'time1', 'time2', 'mon', 'trangthai'));
  }

  public function get_thi(Request $request)
  {
    $ip = $request->ip();

    $ky = session('exam_kythi')->name;
    $kythi = Kythi_de::where('makythi', session('exam_kythi')->id)->get();
    $array_dethi = [];
    foreach ($kythi as $value) {
      $array_dethi[] = $value->madethi;
    }

    $trangthai = Kythisinhvien::where([
        ['user_id', session('current_user')->id],
        ['makythi', session('exam_kythi')->id]
    ])->first();

    if ($trangthai->trangthai == Config('constants.status.0')){
      $de = Dethi::whereIn('id', $array_dethi)->inRandomOrder()->first();
      session(['exam_dethi' => $de]);
    }else{
      $made = Bailam::where('makythi', session('exam_kythi')->id)->first();
      $de = Dethi::where('id', $made->madethi)->first();
    }

    //Kiểm tra xem trong đề thi đã có câu hỏi chưa ?
    $cau = Dethi_cauhoi::where('madethi', $de->id)->first();
    if ($cau = null) {
      session()->flash('message', '(*Đề thi chưa có dữ liệu. Xin vui lòng chọn lại !!!)');
      return redirect('exam');
    }

    $cauhoi = Dethi_cauhoi::where('madethi', $de->id)->get();
    $arr = [];
    foreach ($cauhoi as $cau) {
      $arr[] = $cau->macauhoi;
    }

    $hoi = Cauhoi::whereIn('id', $arr)->get();
    session(['exam_hoi' => $hoi]);


    if ($trangthai->trangthai == Config('constants.status.0')) {
      for ($i = 0; $i < count($hoi); $i++) {
        Bailam::insert([
            'user_id' => session('current_user')->id,
            'makythi' => session('exam_kythi')->id,
            'mamon' => session('exam_dethi')->mon,
            'madethi' => $de->id,
            'macauhoi' => $hoi[$i]->id,
            'diemcauhoi' => $hoi[$i]->diem,
            'noidungcauhoi' => $hoi[$i]->noidung,
            'dapancauhoi' => $hoi[$i]->dapan,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
      }
      Kythisinhvien::where([
          ['user_id', session('current_user')->id],
          ['makythi', session('exam_kythi')->id]
      ])->update([
          'thoigianlambai' => date('Y-m-d H:i:s'),
          'trangthai' => Config('constants.status.1'),
          'ip' => $ip,
          'updated_at' => date('Y-m-d H:i:s'),
      ]);
    }
    //thời gian thi
    $user = Kythisinhvien::where([
        ['user_id', session('current_user')->id],
        ['makythi', session('exam_kythi')->id],
    ])->first();

    $time = Kythi::where('id', session('exam_kythi')->id)->first();
    $thoigianthi = "+" . $time->thoigianthi . " minutes";

    $finish_time = strtotime($thoigianthi, strtotime($user->thoigianlambai));
    $remain_time = $finish_time - strtotime("now");


    return view('exams.thi', compact('de', 'ky', 'hoi', 'remain_time'));
  }
  public function post_thi()
  {
    //lấy các giá trị đáp án của các câu hỏi
    $answers = [];
    for ($i = 0; $i < count(session('exam_hoi')); $i++) {
      $cauhoi = session('exam_hoi');
      $answer = "dapan" . ($i + 1);
      //Điều kiện nếu thí sinh ko chọn đáp án của câu hỏi thì ko có điểm
      if (isset($_POST[$answer])) {
        $answers[] = $_POST[$answer];
        if (empty($answers[$i])) {
          $answers[$i] = '0';
        }
        if (is_array($answers[$i])) {
          $answers[$i] = json_encode($answers[$i]);
        }
      } else {
        $answers[] = '0';
      }
      //Điều kiện điểm của câu hỏi
      if ($answers[$i] == $cauhoi[$i]->dapan) {
        $diem = $cauhoi[$i]->diem;
      } else {
        $diem = 0;
      }
      Bailam::where([
          ['user_id', session('current_user')->id],
          ['makythi', session('exam_kythi')->id],
          ['macauhoi', $cauhoi[$i]->id],
      ])->update([
          'dapancuathisinh' => $answers[$i],
          'diemcauhoicuathisinh' => $diem,
          'trangthailambai' => Config('constants.status.4'),
          'updated_at' => date('Y-m-d H:i:s'),
      ]);
    }

    //Update thêm vào bảng kythisinhvien
    Kythisinhvien::where([
        ['user_id', session('current_user')->id],
        ['makythi', session('exam_kythi')->id]
    ])->update([
        'thoigianketthuc' => date('Y-m-d H:i:s'),
        'trangthai' => Config('constants.status.2'),
    ]);

    return redirect('exam/ketqua');
  }

  //lưu từng câu hỏi khi nhấn chuyển câu hỏi
  public function luubailam(Request $request)
  {
    $answers = $request->post('answers');
    $quesstions = $request->post('quesstions');

    if (empty($answers)) {
      $answers = '0';
    }
    if (is_array($answers)) {
      $answers = json_encode($answers);
    }

    $cauhoi = Cauhoi::where('id', $quesstions)->first();
    if ($answers == $cauhoi->dapan) {
      $diem = $cauhoi->diem;
    } else {
      $diem = 0;
    }

    Bailam::where([
        ['user_id', session('current_user')->id],
        ['makythi', session('exam_kythi')->id],
        ['macauhoi', $quesstions],
    ])->update([
        'dapancuathisinh' => $answers,
        'diemcauhoicuathisinh' => $diem,
        'trangthailambai' => Config('constants.status.4'),
        'updated_at' => date('Y-m-d H:i:s'),
    ]);
  }

  public function ketqua()
  {
    $ketqua = Bailam::where([
        'user_id' => session('current_user')->id,
        'makythi' => session('exam_kythi')->id,
    ])->paginate(10);

    $head = Bailam::where([
        'user_id' => session('current_user')->id,
        'makythi' => session('exam_kythi')->id,
    ])->first();

    $listdiemcauhoi = [];
    $listdiem = [];
    foreach ($ketqua as $k) {
      $listdiemcauhoi[] = $k->diemcauhoi;
      $listdiem[] = $k->diemcauhoicuathisinh;
    }
    $tongdiemcauhoi = 0;
    for ($i = 0; $i < count($ketqua); $i++) {
      $tongdiemcauhoi = $tongdiemcauhoi + $listdiemcauhoi[$i];
    }
    $tongdiem = 0;
    for ($i = 0; $i < count($ketqua); $i++) {
      $tongdiem = $tongdiem + $listdiem[$i];
    }
    if ($tongdiemcauhoi != 0) {
      $phantram = ($tongdiem / $tongdiemcauhoi) * 100;
    } else {
      $phantram = 0;
    }
    $diemdat = Kythi::where('id', session('exam_kythi')->id)->first();

    if ($phantram >= $diemdat->diemdat) {
      $duyet = Config('constants.approval.0');
    } else {
      $duyet = Config('constants.approval.1');
    }

    return view('exams.ketqua', compact('ketqua', 'head', 'tongdiemcauhoi', 'tongdiem', 'phantram', 'duyet'));
  }

  public function admin()
  {
    $assign['user'] = session('current_user');

    return view('admin', $assign);
    // Cach 2
    // $user = session('current_user');

    // return view('admin', compact('user'));
  }


  //Xem kết quả & bài làm (Admin)
  public function get_xemketqua()
  {
    $bailam = Bailam::paginate(10);

    $users = Admin_User::all();
    $listuser = [];
    foreach ($users as $u) {
      $listuser[$u->id] = $u->username;
    }

    $kythi = Kythi::all();
    $listky = [];
    foreach ($kythi as $k) {
      $listky[$k->id] = $k->name;
    }

    $monthi = Mon::all();
    $listmon = [];
    foreach ($monthi as $m) {
      $listmon[$m->id] = $m->name;
    }

    return view('bailam.bailam_all', compact('bailam', 'listuser', 'listky', 'listmon'));
  }
  public function post_xemketqua()
  {
    $user = $_POST['users'];
    $ky = $_POST['kythi'];
    $mon = $_POST['mons'];

    $bailam = Bailam::all();
    $allow = false;
    foreach ($bailam as $b) {
      if ($b->user_id == $user && $b->makythi == $ky && $b->mamon == $mon) {
        $allow = true;
        break;
      }
    }
    if (!$allow) {
      session()->flash('msg', '(*Thí sinh chưa thi môn này. Xin vui lòng chọn lại !!!)');
      return redirect('exam/xemketqua');
    }


    session(['ketqua_user' => $user]);
    session(['ketqua_ky' => $ky]);
    session(['ketqua_mon' => $mon]);

    return redirect('exam/bailamthisinh');
  }

  public function get_bailam()
  {
    $users = Admin_User::all();
    $listuser = [];
    foreach ($users as $u) {
      $listuser[$u->id] = $u->username;
    }

    $kythi = Kythi::all();
    $listky = [];
    foreach ($kythi as $k) {
      $listky[$k->id] = $k->name;
    }

    $monthi = Mon::all();
    $listmon = [];
    foreach ($monthi as $m) {
      $listmon[$m->id] = $m->name;
    }

    $bailamthisinh = Bailam::where([
        'user_id' => session('ketqua_user'),
        'makythi' => session('ketqua_ky'),
        'mamon' => session('ketqua_mon'),
    ])->paginate(10);
    $user = Admin_User::where('id', session('ketqua_user'))->first();
    $ky = Kythi::where('id', session('ketqua_ky'))->first();
    $mon = Mon::where('id', session('ketqua_mon'))->first();
    $de = Bailam::where([
        'user_id' => session('ketqua_user'),
        'makythi' => session('ketqua_ky'),
        'mamon' => session('ketqua_mon'),
    ])->first();


    $listdiemcauhoi = [];
    $listdiem = [];
    foreach ($bailamthisinh as $bailam) {
      $listdiemcauhoi[] = $bailam->diemcauhoi;
      $listdiem[] = $bailam->diemcauhoicuathisinh;
    }
    $tongdiemcauhoi = 0;
    for ($i = 0; $i < count($bailamthisinh); $i++) {
      $tongdiemcauhoi = $tongdiemcauhoi + $listdiemcauhoi[$i];
    }
    $tongdiem = 0;
    for ($i = 0; $i < count($bailamthisinh); $i++) {
      $tongdiem = $tongdiem + $listdiem[$i];
    }
    if ($tongdiemcauhoi != 0) {
      $phantram = ($tongdiem / $tongdiemcauhoi) * 100;
    } else {
      $phantram = 0;
    }
    $diemdat = Kythi::where('id', session('exam_kythi')->id)->first();

    if ($phantram >= $diemdat->diemdat) {
      $duyet = Config('constants.approval.0');
    } else {
      $duyet = Config('constants.approval.1');
    }


    return view('bailam.bailamthisinh', compact('bailamthisinh', 'listuser', 'listky', 'listmon',
        'user', 'ky', 'mon', 'de', 'tongdiemcauhoi', 'tongdiem', 'phantram', 'duyet'));
  }
  public function post_bailam()
  {
    $user1 = $_POST['user'];
    $ky1 = $_POST['ky'];
    $mon1 = $_POST['mon'];

    $bailam = Bailam::all();
    $allow = false;
    foreach ($bailam as $b) {
      if ($b->user_id == $user1 && $b->makythi == $ky1 && $b->mamon == $mon1) {
        $allow = true;
        break;
      }
    }
    if (!$allow) {
      session()->flash('messages', '(*Thí sinh chưa thi môn này. Xin vui lòng chọn lại !!!)');
      return redirect('exam/bailamthisinh');
    }

    session(['ketqua_user' => $user1]);
    session(['ketqua_ky' => $ky1]);
    session(['ketqua_mon' => $mon1]);

    return redirect('exam/bailamthisinh');
  }

}
