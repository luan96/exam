<?php

namespace App\Http\Controllers;

use App\Models\Phongthi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhongthiController extends Controller
{
  public function index()
  {
    $phongthi = Phongthi::paginate(10);
    return view('phongthi.index', compact('phongthi'));
  }
  public function post_index()
  {
    session(['search_phongthi_id' => $_POST['id']]);
    session(['search_phongthi_name' => $_POST['name']]);
    session(['search_phongthi_ip' => $_POST['ip']]);

    return redirect('phongthi/search');
  }

  public function get_search()
  {
    $search_id = session('search_phongthi_id');
    $search_name = session('search_phongthi_name');
    $search_ip = session('search_phongthi_ip');

    if (empty($search_id) && empty($search_name) && empty($search_ip))
    {
      session()->flash('messages', '(*Hãy nhập thông tin cần tìm !!!)');
      return redirect('/phongthi');
    }
      // ID
    if (!empty($search_id))
    {
      $phongthis = Phongthi::where('id', $search_id)->paginate(10);
    }
      // NAME
    elseif (!empty($search_name) && empty($search_id)
                  && empty($search_ip))
    {
      $phongthis = Phongthi::where('name', 'like','%'. $search_name . '%')->paginate(10);
    }
      // IP
    elseif (!empty($search_ip) && empty($search_id))
    {
      $phongthi = Phongthi::all();
      $listphong = [];
      foreach ($phongthi as $p)
      {
        $current = explode('.', $search_ip);
        $begin = explode('.', $p->IP_begin);
        $end = explode('.', $p->IP_end);
        if ($current[3] >= $begin[3] && $current[3] <= $end[3])
        {
          $listphong[] = $p->id;
        }
      }
      $phongthis = Phongthi::whereIn('id', $listphong)->paginate(10);
    }

    //Thông báo khi $phongthis không tồn tại
    if (count($phongthis) == 0)
    {
      session()->flash('messages', '(*Không có phòng thi này !!!)');
      return redirect('/phongthi');
    }

    return view('phongthi.search_phongthi', compact('phongthis'));
  }
  public function post_search()
  {
    session(['search_phongthi_id' => $_POST['id']]);
    session(['search_phongthi_name' => $_POST['name']]);

    return redirect('phongthi/search');
  }

  public function create()
  {
    return view('phongthi.create');
  }
  public function store()
  {
    $name = $_POST['name'];
    $ip_begin = $_POST['ip_begin'];
    $ip_end = $_POST['ip_end'];
    Phongthi::insert([
        'name' => $name,
        'IP_begin' => $ip_begin,
        'IP_end' => $ip_end,
        'created_at' => date('Y-m-d H:i:s'),
    ]);
    return redirect('phongthi');
  }

  public function edit($id)
  {
    $phongthi = Phongthi::find($id);
    return view('phongthi.edit', compact('phongthi'));
  }
  public function update($id)
  {
    $name = $_POST['name'];
    $ip_begin = $_POST['ip_begin'];
    $ip_end = $_POST['ip_end'];
    Phongthi::where('id', $id)->update([
        'name' => $name,
        'IP_begin' => $ip_begin,
        'IP_end' => $ip_end,
        'updated_at' => date('Y-m-d H:i:s'),
    ]);
    return redirect('phongthi');
  }

  public function destroy($id)
  {
    Phongthi::find($id)->delete();
    return redirect('phongthi');
  }

}
