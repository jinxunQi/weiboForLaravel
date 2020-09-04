<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

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
        return view('static_pages/home');
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
