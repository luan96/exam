<?php

namespace App\Http\Controllers;

use App\Models\Admin_User;
use App\Models\Admin_Role_User;
use App\Models\Admin_Role;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
  public function index()
  {
    $user = Admin_User::paginate(10);
    $role = Admin_Role_User::all();
    $roles = Admin_Role::all();
    $listrole = [];
    foreach ($roles as $r)
    {
      $listrole[$r->id] = $r->name;
    }

    return view('users.index', compact('user', 'role', 'listrole'));
  }
  public  function post_index()
  {
    session(['search_user_id' => $_POST['id']]);
    session(['search_user_name' => $_POST['name']]);
    session(['search_user_birth' => $_POST['ngaysinh']]);
    session(['search_user_role' => $_POST['quyen']]);
    return redirect('/users/search');
  }

  public function get_search()
  {
    $search_id = session('search_user_id');
    $search_name = session('search_user_name');
    $search_birth = session('search_user_birth');
    $search_role = session('search_user_role');

    if(empty($search_id) && empty($search_name) && empty($search_birth) && empty($search_role))
    {
      session()->flash('messages', '(*Hãy nhập thông tin cần tìm !!!)');
      return redirect('/users');
    }

    $user = Admin_User::all();
      // ID
    if(!empty($search_id))
    {
      $users = Admin_User::where('id', $search_id)->paginate(10);

    }
      // NAME, BIRTHDAY, ROLE
    if(!empty($search_name) && !empty($search_birth) && !empty($search_role) && empty($search_id))
    {
      $name = Admin_User::where('username', 'like', '%' . $search_name. '%')->get();
      $user = [];
      foreach ($name as $n)
      {
        if (strtotime($n->birthday) == strtotime($search_birth))
        {
          $user[] = $n->id;
        }
      }
      $quyen = Admin_Role_User::where('role_id', $search_role)->get();
      $listuser = [];
      foreach ($quyen as $q)
      {
        $listuser[] = $q->user_id;
      }
      $arr_user = array_intersect($user, $listuser);
      $users = Admin_User::whereIn('id', $arr_user)->paginate(10);
    }
      //NAME, BIRTHDAY
    if(!empty($search_name) && !empty($search_birth) && empty($search_role) && empty($search_id))
    {
      $name = Admin_User::where('username', 'like', '%' . $search_name . '%')->get();
      $user = [];
      foreach ($name as $n)
      {
        if (strtotime($n->birthday) == strtotime($search_birth))
        {
          $user[] = $n->id;
        }
      }
      $users = Admin_User::whereIn('id', $user)->paginate(10);
    }
      // NAME, ROLE
    if(!empty($search_name) && empty($search_birth) && !empty($search_role) && empty($search_id))
    {
      $name = Admin_User::where('username', 'like', '%' . $search_name . '%')->get();
      $arr_user = [];
      foreach ($name as $n)
      {
        $arr_user[] = $n->id;
      }
      $quyen = Admin_Role_User::where('role_id', $search_role)->get();
      $listuser = [];
      foreach ($quyen as $q)
      {
        $listuser[] = $q->user_id;
      }
      $array_user = array_intersect($arr_user, $listuser);
      $users = Admin_User::whereIn('id', $array_user)->paginate(10);
    }
      // BIRTHDAY, ROLE
    if(!empty($search_birth) && !empty($search_role) && empty($search_id) && empty($search_name))
    {
      $arr_user = [];
      foreach ($user as $n)
      {
        if (strtotime($n->birthday) == strtotime($search_birth))
        {
          $arr_user[] = $n->id;
        }
      }
      $quyen = Admin_Role_User::where('role_id', $search_role)->get();
      $listuser = [];
      foreach ($quyen as $q)
      {
        $listuser[] = $q->user_id;
      }
      $array_user = array_intersect($arr_user, $listuser);
      $users = Admin_User::whereIn('id', $array_user)->paginate(10);
    }
      // NAME
    if(!empty($search_name) && empty($search_id) && empty($search_birth) && empty($search_role))
    {
      $users = Admin_User::where('username', 'like', '%' . session('search_user_name'). '%')->paginate(10);
    }
      // BIRTHDAY
    if(!empty($search_birth) && empty($search_name) && empty($search_id) && empty($search_role))
    {
      $arr_user = [];
      foreach ($user as $u)
      {
        if (strtotime($u->birthday) == strtotime($search_birth))
        {
          $arr_user[] = $u->id;
        }
      }
      $users = Admin_User::whereIn('id', $arr_user)->paginate(10);
    }
      //ROLE
    if(!empty($search_role) && empty($search_name) && empty($search_id) && empty($search_birth))
    {
      $quyen = Admin_Role_User::where('role_id', $search_role)->get();
      $listuser = [];
      foreach ($quyen as $q)
      {
        $listuser[] = $q->user_id;
      }
      $users = Admin_User::whereIn('id', $listuser)->paginate(10);
    }

    // thông báo lỗi khi $users không tồn tại
    if (count($users) == 0)
    {
      session()->flash('messages', '(*Không tồn tại user !!!)');
      return redirect('/users');
    }

    $arr_role = [];
    foreach ($users as $u)
    {
      $role = Admin_Role_User::where('user_id', $u->id)->first();
      if (isset($role))
      {
        $arr_role[$u->id] = $role->roles->name;
      }else{
        $arr_role[$u->id] = '_';
      }
    }

    $roles = Admin_Role::all();
    $listrole = [];
    foreach ($roles as $r)
    {
      $listrole[$r->id] = $r->name;
    }

    return view('users.search_user', compact('users', 'arr_role', 'listrole'));
  }
  public function post_search()
  {
    session(['search_user_id' => $_POST['id']]);
    session(['search_user_name' => $_POST['name']]);
    session(['search_user_birth' => $_POST['ngaysinh']]);
    session(['search_user_role' => $_POST['quyen']]);

    return redirect('users/search');
  }

  public function create()
  {
    $listrole = [];
    $role = Admin_Role::all();
    foreach ($role as $r)
    {
      $listrole[$r->id] = $r->name;
    }

    return view('users.create', compact('listrole'));
  }
  public function store()
  {
    $username = $_POST['username'];
    $user = Admin_User::all();
    foreach ($user as $u)
    {
      if ($username == $u->username)
      {
        return redirect('/users/create')
            ->with(['create_user' => '--*Username đã tồn tại !']);
      }
    }

    $password = $_POST['password'];
    $password_conf = $_POST['password_confirmation'];

    // if ($password != $password_conf) {
    //     return redirect('/users/create')
    //             ->with(['password_conf'=>'--*Password sai !']);
    // }
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $avatar = $_POST['avatar'];
    $role = $_POST['role'];
    // if ($username == '' || $password == '' || $name == '' || $avatar == '' || $role == '')
    // {
    //     return redirect('users/create')
    //                 ->with(['error_user'=>'*Hãy nhập đầy đủ thông tin !!!']);
    // }
    $pass = md5($password);

    Admin_User::insert([
        'username' => $username,
        'password' => $pass,
        'name' => $name,
        'birthday' => $birthday,
        'avatar' => 'images/' . $avatar,
        'created_at' => date('Y-m-d H:i:s'),
    ]);
    $user_id = DB::getPdo()->lastInsertId();
    Admin_Role_User::insert([
        'role_id' => $role,
        'user_id' => $user_id,
        'created_at' => date('Y-m-d H:i:s'),
    ]);
    return redirect('users');
  }

  public function edit($id)
  {
    $user = Admin_User::find($id);
    // $avatar = substr_replace($user->avatar,"", 0, 7);
    $role_user = Admin_Role_User::where('user_id', $id)->first();
    $listrole = [];
    $role = Admin_Role::all();
    foreach ($role as $r)
    {
      $listrole[$r->id] = $r->name;
    }

    return view('users.edit', compact('user', 'listrole', 'role_user'));
  }
  public function update($id)
  {
    $username = $_POST['username'];
    $array_user = explode(', ', $id);
    $user = Admin_User::whereNotIn('id', $array_user)->get();
    foreach ($user as $u)
    {
      if ($username == $u->username)
      {
        return redirect('/users/edit/' . $id)
            ->with(['duplicate_user' => '--*Username đã tồn tại !']);
      }
    }

    $password = $_POST['password'];
    $password_conf = $_POST['password_confirmation'];
    if ($password != $password_conf)
    {
      return redirect('/users/edit/' . $id)
          ->with(['password_conf' => '--*Password sai !']);
    }
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $avatar = $_POST['avatar'];
    $role = $_POST['role'];
    $pass = md5($password);
    Admin_User::where('id', $id)->update([
        'username' => $username,
        'password' => $pass,
        'name' => $name,
        'birthday' => $birthday,
        'avatar' => 'images/' . $avatar,
        'updated_at' => date('Y-m-d H:i:s'),
    ]);
    Admin_Role_User::where('user_id', $id)->update([
        'role_id' => $role,
        'updated_at' => date('Y-m-d H:i:s'),
    ]);

    return redirect('users');
  }

  public function destroy($id)
  {
    Admin_User::find($id)->delete();
    Admin_Role_User::Where('user_id', $id)->delete();
    return redirect('users');
  }


  public function get_sua_user($id)
  {
    $user = Admin_User::find($id);
    $role = Admin_Role_User::where('user_id', $id)->first();
    return view('sua-user.sua', compact('user', 'role'));
  }
  public function post_sua_user($id)
  {
    $password = $_POST['password'];
    $password_conf = $_POST['password_confirmation'];
//    if ($password != $password_conf) {
//      return redirect('/user-sua/' . $id)
//          ->with(['pass_conf' => '--*Password sai !']);
//    }
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $avatar = $_POST['avatar'];
    $pass = md5($password);

    Admin_User::where('id', $id)->update([
        'password' => $pass,
        'name' => $name,
        'birthday' => $birthday,
        'avatar' => 'images/' . $avatar,
        'updated_at' => date('Y-m-d H:i:s'),
    ]);

    return redirect('exam');
  }

}

?>
