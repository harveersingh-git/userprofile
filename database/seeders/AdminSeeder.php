<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'last_name'=>'admin',
            'employee_id'=>'001',
            'email' => 'admin@virtualemployee.com',
            'resume_title'=>'admin',
            'mobile'=>'0101010101',
            'joining_date'=>'2021-12-20',
            'shift_start'=>'00:00',
            'shift_end'=>'00:00',
            'team'=>'0',
            'experience'=>'0',
            'added_by'=>'0',
            'about_employee'=>'admin',
            'password' => '$2y$10$1EMUdYqvfQAyFe4GOfUHr.tyS8MNjYL1rURP.cmuhWp612vII1IJu',
            'user_role' => '1'
        ]);
    }
}
