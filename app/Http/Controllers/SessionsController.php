<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * 用户会话控制器(登录、退出)
 * Class SessionsController
 * @package App\Http\Controllers
 */
class SessionsController extends Controller
{

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

        if (Auth::attempt($credentials)) {
            //登录成功
            session()->flash('success', '欢迎回来！');
            return redirect()->route('users.show', [Auth::user()]);
        } else {
            //登录失败
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
            return redirect()->back()->withInput();
        }
    }

    /**
     * 退出登录
     * @param Request $request
     */
    public function destroy(Request $request)
    {

    }
}
