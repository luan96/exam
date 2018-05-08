<?php

namespace App\Http\Controllers;

use App\Models\Cauhoi;
use App\Models\Mon;
use App\Models\Phanloaicauhoi;
use App\Models\Dethi_cauhoi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Config;

class CauhoiController extends Controller
{
  public function index()
  {
    $cauhoi = Cauhoi::paginate(10);
    $mon = Mon::all();
    $listmon = [];
    foreach ($mon as $m)
    {
      $listmon[$m->id] = $m->name;
    }
    $phanloai = Phanloaicauhoi::all();
    $list_phanloai = [];
    foreach ($phanloai as $p)
    {
      $list_phanloai[$p->id] = $p->name;
    }

    return view('cauhoi.index', compact('cauhoi', 'listmon', 'list_phanloai'));
  }
  public function post_index()
  {
    if (isset($_POST['loaicauhoi']))
    {
      session(['loaicauhoi' => $_POST['loaicauhoi']]);
      return redirect('cauhoi/create');
    }
    else
    {
      session(['search_cauhoi_id' => $_POST['id']]);
      session(['search_cauhoi_mon' => $_POST['mon']]);
      session(['search_cauhoi_phanloai' => $_POST['phanloai']]);
      session(['search_cauhoi_loaicauhoi' => $_POST['search_loaicauhoi']]);

      return redirect('cauhoi/search');
    }
  }

  public function get_search()
  {
    $search_id = session('search_cauhoi_id');
    $search_mon = session('search_cauhoi_mon');
    $search_phanloai = session('search_cauhoi_phanloai');
    $search_loaicauhoi = session('search_cauhoi_loaicauhoi');

    if (empty($search_id) && empty($search_mon) && empty($search_phanloai) && empty($search_loaicauhoi))
    {
      session()->flash('messages', '(*Hãy nhập thông tin cần tìm !!!)');
      return redirect('/cauhoi');
    }
    $cauhois = array();
      // ID
    if (!empty($search_id))
    {
      $cauhois = Cauhoi::where('id', $search_id)->get();
    }
      // MÔN, PHÂN LOẠI, LOẠI CÂU HỎI
    elseif (!empty($search_mon) && !empty($search_phanloai) && !empty($search_loaicauhoi) && empty($search_id))
    {
      $cauhois = Cauhoi::where([
            ['mamon', $search_mon],
            ['maphanloai', $search_phanloai],
            ['loaicauhoi', $search_loaicauhoi]
          ])->paginate(10);
    }
      // MÔN, PHÂN LOẠI
    elseif (!empty($search_mon) && !empty($search_phanloai) && empty($search_loaicauhoi) && empty($search_id))
    {
      $cauhois = Cauhoi::where([
          ['mamon', $search_mon],
          ['maphanloai', $search_phanloai]
      ])->paginate(10);
    }
      // MÔN, LOẠI CÂU HỎI
    elseif (!empty($search_mon) && empty($search_phanloai) && !empty($search_loaicauhoi) && empty($search_id))
    {
      $cauhois = Cauhoi::where([
          ['mamon', $search_mon],
          ['loaicauhoi', $search_loaicauhoi]
      ])->paginate(10);
    }
      // PHÂN LOẠI, LOẠI CÂU HỎI
    elseif (!empty($search_phanloai) && !empty($search_loaicauhoi) && empty($search_mon) && empty($search_id))
    {
      $cauhois = Cauhoi::where([
          ['maphanloai', $search_phanloai],
          ['loaicauhoi', $search_loaicauhoi]
      ])->paginate(10);
    }
      // MÔN
    elseif (!empty($search_mon) && empty($search_phanloai) && empty($search_loaicauhoi) && empty($search_id))
    {
      $cauhois = Cauhoi::where('mamon', $search_mon)->paginate(10);
    }
      // PHÂN LOẠI
    elseif (!empty($search_phanloai) && empty($search_mon) && empty($search_loaicauhoi) && empty($search_id))
    {
      $cauhois = Cauhoi::where('maphanloai', $search_phanloai)->paginate(10);
    }
      // LOẠI CÂU HỎI
    elseif (!empty($search_loaicauhoi) && empty($search_mon) && empty($search_phanloai) && empty($search_id))
    {
      $cauhois = Cauhoi::where('loaicauhoi', $search_loaicauhoi)->paginate(10);
    }


    $mon = Mon::all();
    $listmon = [];
    foreach ($mon as $m)
    {
      $listmon[$m->id] = $m->name;
    }
    $phanloai = Phanloaicauhoi::all();
    $list_phanloai = [];
    foreach ($phanloai as $p)
    {
      $list_phanloai[$p->id] = $p->name;
    }

    if (count($cauhois) == 0)
    {
      session()->flash('message', '(*Câu hỏi không tồn tại !!!)');
      return redirect('/cauhoi');
    }

    return view('cauhoi.search_cauhoi', compact('cauhois', 'listmon', 'list_phanloai'));
  }
  public function post_search()
  {
    session(['search_cauhoi_id' => $_POST['id']]);
    session(['search_cauhoi_mon' => $_POST['mon']]);
    session(['search_cauhoi_phanloai' => $_POST['phanloai']]);
    session(['search_cauhoi_loaicauhoi' => $_POST['search_loaicauhoi']]);

    return redirect('cauhoi/search');
  }

  public function create()
  {
    $listmon = [];
    $mon = Mon::all();
    foreach ($mon as $m) {
      $listmon[$m->id] = $m->name;
    }
    $listphanloai = [];
    $phanloai = Phanloaicauhoi::all();
    foreach ($phanloai as $p) {
      $listphanloai[$p->id] = $p->name;
    }
    return view('cauhoi.create', compact('listmon', 'listphanloai'));
  }
  public function store()
  {
    $mon = $_POST['mon'];
    $phanloai = $_POST['phanloai'];
    $loai = session('loaicauhoi');
    $noidung = $_POST['noidung'];
    $diem = $_POST['diem'];
    $dapan = $_POST['dapan'];

    if ($mon == '' || $phanloai == '' || $loai == '' || $noidung == '' || $diem == '' || $dapan == '') {
      return redirect('cauhoi/create')
          ->with(['error_cauhoi' => '*Hãy nhập đầy đủ thông tin !!!']);
    }

    if ($loai != config('constants.options.3')) {
      $phuongan = $_POST['phuongan'];
      Cauhoi::insert([
          'mamon' => $mon,
          'maphanloai' => $phanloai,
          'loaicauhoi' => $loai,
          'noidung' => $noidung,
          'diem' => $diem,
          'cacphuongantraloi' => json_encode($phuongan),
          'dapan' => json_encode($dapan),
          'created_at' => date('Y-m-d H:i:s'),
      ]);
    } else {
      Cauhoi::insert([
          'mamon' => $mon,
          'maphanloai' => $phanloai,
          'loaicauhoi' => $loai,
          'noidung' => $noidung,
          'diem' => $diem,
          'cacphuongantraloi' => '["Đúng","Sai"]',
          'dapan' => json_encode($dapan),
          'created_at' => date('Y-m-d H:i:s'),
      ]);
    }
    // if ($loai != config('constants.options.3'))
    //    {
    // 	$phuongan = $_POST['phuongan'];
    // 	Cauhoi::insert([
    // 		'mamon' 	 		=> $mon,
    // 		'maphanloai' 		=> $phanloai,
    // 		'loaicauhoi' 		=> $loai,
    // 		'noidung' 	 		=> $noidung,
    // 		'diem' 		 		=> $diem,
    // 		'cacphuongantraloi' => implode(', ',$phuongan),
    // 		'dapan'				=> implode(', ', $dapan),
    // 		'created_at' 		=> date('Y-m-d H:i:s'),
    // 	]);
    // }else{
    // 	Cauhoi::insert([
    // 		'mamon' 	 		=> $mon,
    // 		'maphanloai' 		=> $phanloai,
    // 		'loaicauhoi' 		=> $loai,
    // 		'noidung' 	 		=> $noidung,
    // 		'diem' 		 		=> $diem,
    // 		'cacphuongantraloi' => 'Đúng, Sai',
    // 		'dapan'				=> $dapan,
    // 		'created_at' 		=> date('Y-m-d H:i:s'),
    // 	]);
    // }
    return redirect('cauhoi');
  }

  public function edit($id)
  {
    $listmon = [];
    $mon = Mon::all();
    foreach ($mon as $m) {
      $listmon[$m->id] = $m->name;
    }
    $listphanloai = [];
    $phanloai = Phanloaicauhoi::all();
    foreach ($phanloai as $p) {
      $listphanloai[$p->id] = $p->name;
    }
    $cauhoi = Cauhoi::find($id);
    $cau = json_decode($cauhoi->cacphuongantraloi);

    return view('cauhoi.edit', compact('cauhoi', 'cau', 'listmon', 'listphanloai'));
  }
  public function update($id)
  {
    $cauhoi = Cauhoi::find($id);
    $mon = $_POST['mon'];
    $phanloai = $_POST['phanloai'];
    $noidung = $_POST['noidung'];
    $diem = $_POST['diem'];
    $dapan = $_POST['dapan'];
    if ($cauhoi->loaicauhoi != config('constants.options.3')) {
      $phuongan = $_POST['phuongan'];
      DB::table('cauhoi')->where('id', $id)->update([
          'mamon' => $mon,
          'maphanloai' => $phanloai,
          'noidung' => $noidung,
          'diem' => $diem,
          'cacphuongantraloi' => json_encode($phuongan),
          'dapan' => json_encode($dapan),
          'updated_at' => date('Y-m-d H:i:s'),
      ]);
    } else {
      DB::table('cauhoi')->where('id', $id)->update([
          'mamon' => $mon,
          'maphanloai' => $phanloai,
          'noidung' => $noidung,
          'diem' => $diem,
          'dapan' => json_encode($dapan),
          'updated_at' => date('Y-m-d H:i:s'),
      ]);
    }
    return redirect('cauhoi');
  }

  public function destroy($id)
  {
    $cauhoi = Cauhoi::findOrFail($id);
    $cauhoi->delete();
    Dethi_cauhoi::where('macauhoi', $id)->delete();
    return redirect('cauhoi');
  }
}
