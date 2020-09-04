<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * 用户控制器
 * Class UsersController
 * @package App\Http\Controllers
 */
class UsersController extends Controller
{
    /**
     * 用户注册页展示
     * @return mixed \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * 用户个人详情页展示
     * @param User $user
     * @return mixed \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
//        return view('users.show', compact('user'));
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * 保存用户注册数据
     * @param Request $request
     * @return mixed \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required|unique:users|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);
        //保存用户注册数据
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        //或使用静态方法
        /*$user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);*/

        //保存成功后的通知消息 session的flash
        session()->flash('success', '注册成功，欢迎您在这里进行一段愉快的行程~');
        return redirect(route('users.show', [$user]));
    }
}
