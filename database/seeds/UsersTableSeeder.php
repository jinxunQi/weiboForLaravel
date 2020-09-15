<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //创建一个User模型工厂(在factories中定义的)
        $users = factory(User::class)->times(50)->make();

        User::insert($users->makeVisible(['password', 'remember_token'])->toArray());
        $user = User::find(1);
        $user->name = 'admin';
        $user->email = '574765035@qq.com';
        $user->is_admin = 1;
        $user->password = bcrypt('123456789');
        $user->save();
    }
}
