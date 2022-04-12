<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new User();
        $user->name = 'Adriana';
        $user->email = 'adriana@gmail.com';
        $user->password = bcrypt('password');
        $user->save();
    }
}
