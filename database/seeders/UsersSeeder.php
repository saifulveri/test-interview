<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Saiful',
                'email' => 'saifulsekul@gmail.com',
                'password' => bcrypt('12345'),
                'status' => 'active',
                'position' => 'Manager',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'test',
                'email' => 'test@mail.com',
                'password' => bcrypt('12345'),
                'status' => 'inactive',
                'position' => 'Supervisor',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ]);
    }
}
