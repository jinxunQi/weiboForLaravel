<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();//解除模型字段限制

        $this->call(UsersTableSeeder::class);

        Model::reguard();//重新开启模型字段限制
    }
}
