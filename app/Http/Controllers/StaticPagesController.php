<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * 静态页面控制器
 * Class StaticPagesController
 * @package App\Http\Controllers
 */
class StaticPagesController extends Controller
{
    /**
     * 首页
     * @return mixed
     */
    public function home()
    {
        //博客列表
        $feed_items = [];

        if (Auth::check()) {
            //获取当前用户的博客列表
            $feed_items = Auth::user()->feed()->paginate(10);
        }

        return view('static_pages/home', ['feed_items' => $feed_items]);
    }

    /**
     * 帮助页
     * @return mixed
     */
    public function help()
    {
        return view('static_pages/help');
    }

    /**
     * 关于页
     * @return mixed
     */
    public function about()
    {
        return view('static_pages/about');
    }


}
