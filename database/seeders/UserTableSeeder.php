<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
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
                'first_name' => 'Ernesto',
                'last_name' => 'Flames',
                'username' => 'eflames',
                'email' => 'eflames@gmail.com',
                'age' => 34,
                'document_id' => 17855837,
                'occupation_id' => 1,
                'password' => bcrypt('123123123'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
