<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //  User::factory(User::class, 1)->create();
//        User::factory()
//            ->count(2)
//            ->create();
        User::factory(2)->create();
    }
}
