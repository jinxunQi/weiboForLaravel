<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusesController extends Controller
{

    public function __construct()
    {
        //中间件过滤
        $this->middleware('auth');
//        $this->middleware('auth', [
//            'only' => ['store', 'destroy']
//        ]);
    }

    /**
     * 保存发布博客
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:140'
        ]);

        //通过关联关系添加博客
        Auth::user()->statuses()->create([
            'content' => $request->input('content')
        ]);

        session()->flash('success', '发布成功！');
        return redirect()->back();
    }


    public function destroy(Status $status)
    {

    }
}
