<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Tarek',
            'last_name' => 'Monjur',
            'email' => 'tarekmonjur@gmail.com',
            'password' => 123456,
            'remember_token' => '',
            'department_id' => 1,
            'designation' => 'software engineer',
            'mobile_no' => '01832308565',
            'user_type' => 1,
            'status' => 'active',
        ]);
    }
}
