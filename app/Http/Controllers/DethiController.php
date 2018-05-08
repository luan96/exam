<?php

namespace App\Http\Controllers;

use App\Models\Dethi;
use App\Models\Mon;
use App\Models\Phanloaicauhoi;
use App\Models\Cauhoi;
use App\Models\Dethi_cauhoi;
use App\Models\Kythi_de;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DethiController extends Controller
{
  public function index()
  {
    $dethi = Dethi::paginate(10);
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
    return view('dethi.index', compact('dethi', 'listmon', 'list_phanloai'));
  }
  public function post_index()
  {
    session(['search_dethi_id' => $_POST['id']]);
    session(['search_dethi_name' => $_POST['name']]);
    session(['search_dethi_mon' => $_POST['mon']]);
    session(['search_dethi_phanloai' => $_POST['phanloai']]);

    return redirect('dethi/search');
  }

  public function get_search()
  {
    $search_id = session('search_dethi_id');
    $search_name = session('search_dethi_name');
    $search_mon = session('search_dethi_mon');
    $search_phanloai = session('search_dethi_phanloai');

    if (empty($search_id) && empty($search_name) && empty($search_mon) && empty($search_phanloai))
    {
      session()->flash('messages', '(*Hãy nhập thông tin cần tìm !!!)');
      return redirect('/dethi');
    }
      // ID
    if (!empty($search_id))
    {
      $dethis = Dethi::where('id', $search_id)->paginate(10);
    }
      // NAME, MÔN, PHÂN LOẠI
    elseif (!empty($search_name) && !empty($search_mon) && !empty($search_phanloai) && empty($search_id))
    {
      $dethis = Dethi::where([
          ['name', 'like', '%' . $search_name . '%'],
          ['mon', $search_mon],
          ['phanloai', $search_phanloai]
      ])->paginate(10);
    }
      // NAME, MÔN
    elseif (!empty($search_name) && !empty($search_mon) && empty($search_phanloai) && empty($search_id))
    {
      $dethis = Dethi::where([
          ['name', 'like', '%' . $search_name . '%'],
          ['mon', $search_mon]
      ])->paginate(10);
    }
      //NAME, PHÂN LOẠI
    elseif (!empty($search_name) && empty($search_mon) && !empty($search_phanloai) && empty($search_id))
    {
      $dethis = Dethi::where([
          ['name', 'like', '%' . $search_name . '%'],
          ['phanloai', $search_phanloai]
      ])->paginate(10);
    }
      // MÔN, PHÂN LOẠI
    elseif (empty($search_name) && !empty($search_mon) && !empty($search_phanloai) && empty($search_id))
    {
      $dethis = Dethi::where([
          ['mon', $search_mon],
          ['phanloai', $search_phanloai]
      ])->paginate(10);
    }
      // NAME
    elseif (!empty($search_name) && empty($search_mon) && empty($search_phanloai) && empty($search_id))
    {
      $dethis = Dethi::where('name', 'like', '%' . $search_name . '%')->paginate(10);
    }
      // MÔN
    elseif (empty($search_name) && !empty($search_mon) && empty($search_phanloai) && empty($search_id))
    {
      $dethis = Dethi::where('mon', $search_mon)->paginate(10);
    }
      // PHÂN LOẠI
    elseif (empty($search_mon) &&  empty($search_name) && !empty($search_phanloai) &&empty($search_id))
    {
      $dethis = Dethi::where('phanloai', $search_phanloai)->paginate(10);
    }

    //thông báo lỗi khi $dethis không tồn tại
    if (count($dethis) == 0)
    {
      session()->flash('messages', '(*Đề thi không tồn tại !!!)');
      return redirect('/dethi');
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

    return view('dethi.search_dethi', compact('dethis', 'listmon', 'list_phanloai'));
  }
  public function post_search()
  {
    session(['search_dethi_id' => $_POST['id']]);
    session(['search_dethi_name' => $_POST['name']]);
    session(['search_dethi_mon' => $_POST['mon']]);
    session(['search_dethi_phanloai' => $_POST['phanloai']]);

    return redirect('dethi/search');
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
    return view('dethi.create', compact('listmon', 'listphanloai'));
  }

  public function store()
  {
    $name = $_POST['name'];
    $mon = $_POST['mon'];
    $phanloai = $_POST['phanloai'];
    if ($name == '' || $mon == '' || $phanloai == '') {
      return redirect('dethi/create')
          ->with(['error_dethi' => '*Hãy nhập đầy đủ thông tin !!!']);
    }

    Dethi::insert([
        'name' => $name,
        'mon' => $mon,
        'phanloai' => $phanloai,
        'created_at' => date('Y-m-d H:i:s'),
    ]);
    $dethi_id = DB::getPdo()->lastInsertId();


    //hàm gộp mảng
    //$merge_array = array_merge($array1, $array2);


//    $cauhois = Cauhoi::where([
//        ['mamon', $mon],
//        ['maphanloai', $phanloai]
//    ])->inRandomOrder()->take(3)->get();
//    foreach ($cauhois as $cauhoi) {
//      Dethi_cauhoi::insert([
//          'madethi' => $dethi_id,
//          'macauhoi' => $cauhoi->id,
//          'created_at' => date('Y-m-d H:i:s'),
//      ]);
//    }
     session(['current_dethi' => $dethi_id]);
     session(['current_mon' => $mon]);
    return redirect('dethi/themcauhoi/'.$dethi_id);
  }

   public function get_themcauhoi($id)
   {
       $id = session('current_dethi');
       $de = Cauhoi::where('mamon', session('current_mon'))->paginate(10);
       $m = Mon::where('id', session('current_mon'))->first();
       return view('dethi.themcauhoi', compact('de', 'm'));
   }
   public function post_themcauhoi($id)
   {
       if (isset($_POST['chkitem']))
       {
           $cauhoi = $_POST['chkitem'];
           foreach ($cauhoi as $c)
           {
               Dethi_cauhoi::insert([
                   'madethi'    => $id,
                   'macauhoi'   => $c,
                   'created_at' => date('Y-m-d H:i:s'),
               ]);
           }
       }
       return redirect('dethi');
   }

  public function edit($id)
  {
    $dethi = Dethi::find($id);
    $de_cau = Dethi_cauhoi::where('madethi', $id)->paginate(10);

     $listphanloai = [];
     $phanloai = Phanloaicauhoi::all();
     foreach ($phanloai as $p) {
         $listphanloai[$p->id] = $p->name;
     }
    return view('dethi.edit', compact('dethi', 'de_cau', 'listphanloai'));
  }

  public function update($id)
  {
    $name = $_POST['name'];
     $phanloai = $_POST['phanloai'];
    Dethi::where('id', $id)->update([
        'name' => $name,
       'phanloai'   =>$phanloai,
        'updated_at' => date('Y-m-d H:i:s'),
    ]);

     return redirect('dethi/edit/cauhoi/'.$id);
//    return redirect('dethi');
  }

   public function get_edit_cauhoi($id)
   {
       $dethi = Dethi::where('id', $id)->first();
       $dethi_cau = Dethi_cauhoi::where('madethi', $id)->get();

       $arry = [];
       foreach ($dethi_cau as $value) {
           $arry[] = $value->macauhoi;
       }
       $cauhoi = Cauhoi::where('mamon', $dethi->mon)->whereNotIn('id', $arry)->paginate(10);
       return view('dethi.edits.cauhoi', compact('dethi', 'cauhoi'));
   }
   public function post_edit_cauhoi($id)
   {
       if (isset($_POST['chkitem'])) {
           $cauhoi = $_POST['chkitem'];
           foreach ($cauhoi as $c) {
               Dethi_cauhoi::insert([
                   'madethi'    => $id,
                   'macauhoi'   => $c,
                   'created_at' => date('Y-m-d H:i:s'),
               ]);
           }
       }
       return redirect('dethi');
   }

  public function destroy($id)
  {
    Dethi::find($id)->delete();
    Dethi_cauhoi::where('madethi', $id)->delete();
    Kythi_de::where('madethi', $id)->delete();
    return redirect('dethi');
  }

  public function delete($id_dethi, $id_cauhoi)
  {
    $dethi = Dethi_cauhoi::where([
        ['madethi', $id_dethi],
        ['macauhoi', $id_cauhoi]
    ])->first();
    $dethi_id = $dethi->madethi;
    Dethi_cauhoi::where('macauhoi', $id_cauhoi)->delete();
    return redirect('dethi/edit/' . $dethi_id);
  }
}
