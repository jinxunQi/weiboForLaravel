<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * 用户控制器
 * Class UsersController
 * @package App\Http\Controllers
 */
class UsersController extends Controller
{
    public function __construct()
    {
        //中间件过滤未登录用户请求
        $this->middleware('auth', [
            'except' => ['create', 'store', 'show']
        ]);

        //只让未注册的用户访问注册页
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }


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
        Auth::login($user);//注册成功自动登录
        session()->flash('success', '注册成功，欢迎您在这里进行一段愉快的行程~');
        return redirect(route('users.show', [$user]));
    }


    /**
     * 编辑用户展示页
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }


    /**
     * 更新用户信息
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);

        $data = [];
        $data['name'] = $request->input('name');
        if ($request->input('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }
        $user->update($data);

        session()->flash('success', '个人资料更新成功！');
        return redirect()->route('users.show', $user);
    }
}
