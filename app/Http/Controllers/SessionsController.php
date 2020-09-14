<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

/**
 * 用户会话控制器(登录、退出)
 * Class SessionsController
 * @package App\Http\Controllers
 */
class SessionsController extends Controller
{
    public function __construct()
    {
        //中间件，把create登录页面暴露给访客guest
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }


    /**
     * 登陆用户展示页面
     * @return mixed
     */
    public function create()
    {
        return view('sessions.create');
    }


    /**
     * 用户登陆post请求
     * @param Request $request
     * @return mixed
     * @throws
     */
    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            //检测是否有进行邮箱验证
            if (Auth::user()->activated) {
                //登录成功
                session()->flash('success', '欢迎回来！');
                $fallback = route('users.show', [Auth::user()]);
                return redirect()->intended($fallback);
            }else{
                Auth::logout();
                session()->flash('warning', '你的账号未激活，请检查邮箱中的注册邮箱进行激活！');
                return redirect('/');
            }
        } else {
            //登录失败
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
            return redirect()->back()->withInput();
        }
    }

    /**
     * 退出登录
     * @return mixed
     */
    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect()->route('login');
    }
}
