<?php

namespace App\Http\Controllers;

use App\Models\Admin_User;
use App\Models\Admin_Role_User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
  public function index()
  {
    return redirect('/login');
  }
  public function getlogin()
  {
    return view('login');
  }

  public function postlogin()
  {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $password = md5($password);
    $user = Admin_User::where('username', $username)->first();
    if ($user && $username == $user->username && $password == $user->password)
    {
      $role = Admin_Role_User::where('user_id', $user->id)->first();
      session(['current_user' => $user]);
      session(['current_role' => $role]);
      return redirect('./exam');
    }
    else{
      return redirect('login')
          ->with(['login_faiure' => '*Username or password không đúng !']);
    }

  }

  public function logout()
  {
    session()->flush();
    return redirect('login');
  }

  public function get_dang_ky()
  {
    return view('dang_ky');
  }

  public function post_dang_ky()
  {
    $username = $_POST['username'];
    $user = Admin_User::all();
    foreach ($user as $u) {
      if ($username == $u->username)
      {
        return redirect('dangky')
            ->with(['create_user' => '*Username đã tồn tại !']);
      }
    }
    $password = $_POST['password'];
    $password_conf = $_POST['password_confirmation'];

    if ($password != $password_conf)
    {
      return redirect('dangky')
          ->with(['password_conf' => '*Password sai !']);
    }
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $avatar = $_POST['avatar'];

    // if ($username == '' || $password == '' || $name == '' || $avatar == '')
    // {
    //     return redirect('dangky')
    //                 ->with(['error_dangky'=>'*Hãy nhập đầy đủ thông tin !!!']);
    // }
    $role = '2';
    $pass = md5($password);

    DB::table('admin_users')->insert([
        'username' => $username,
        'password' => $pass,
        'name' => $name,
        'birthday' => birthday,
        'avatar' => 'images/' . $avatar,
        'created_at' => date('Y-m-d H:i:s'),
    ]);
    $user_id = DB::getPdo()->lastInsertId();
    DB::table('admin_role_users')->insert([
        'role_id' => $role,
        'user_id' => $user_id,
        'created_at' => date('Y-m-d H:i:s'),
    ]);

    return redirect('login');
  }

}
