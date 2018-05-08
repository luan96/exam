<?php

namespace App\Http\Controllers;

use App\Models\Cauhoi;
use App\Models\Mon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonController extends Controller
{
  public function index()
  {
    $mon = Mon::paginate(10);
    return view('mon.index', compact('mon'));
  }
  public function post_index()
  {
    session(['search_mon_id' => $_POST['id']]);
    session(['search_mon_name' => $_POST['name']]);

    return redirect('mon/search');
  }

  public function get_search()
  {
    $search_id = session('search_mon_id');
    $search_name = session('search_mon_name');

    if (empty($search_id) && empty($search_name))
    {
      session()->flash('messages', '(*Hãy nhập thông tin cần tìm !!!)');
      return redirect('/mon');
    }
    if(!empty($search_id))
    {
      $mons = Mon::where('id', $search_id)->paginate(10);
    }
    elseif (!empty($search_name) && empty($search_id))
    {
      $mons = Mon::where('name', 'like','%'. $search_name . '%')->paginate(10);
    }
    //Điều kiện thông báo khi $món không tồn tại
    if (count($mons) == 0)
    {
      session()->flash('messages', '(*Môn thi không tồn tại !!!)');
      return redirect('/mon');
    }

    return view('mon.search_mon', compact('mons'));
  }
  public function post_search()
  {
    session(['search_mon_id' => $_POST['id']]);
    session(['search_mon_name' => $_POST['name']]);

    return redirect('mon/search');
  }

  public function create()
  {

    return view('mon.create');
  }
  public function store(Request $request)
  {
    // $name = $_POST['name'];
    $name = $request->post('name');
    Mon::insert([
        'name' => $name,
        'created_at' => date('Y-m-d H:i:s'),
    ]);

    return redirect('mon');
  }

  public function edit($id)
  {
    $mon = Mon::find($id);
    return view('mon.edit', compact('mon'));
  }
  public function update($id)
  {
    $name = $_POST['name'];
    Mon::where('id', $id)->update([
        'name' => $name,
        'updated_at' => date('Y-m-d H:i:s'),
    ]);
    return redirect('mon');
  }

  public function destroy($id)
  {
    Mon::find($id)->delete();
    return redirect('mon');
  }

}
