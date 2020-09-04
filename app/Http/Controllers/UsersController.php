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
    public function create()
    {
        return view('users.create');
    }

    public function show(User $user)
    {
//        return view('users.show', compact('user'));
        return view('users.show', [
            'user' => $user
        ]);
    }
}
