<?php

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
        //
        DB::table('users')->insert([
            'name' => 'yuswanto hariadi',
            'email' => 'yuswantohariadi@gmail.com',
            'role_id' => '1',
            'is_active' => '1',
            'password' => bcrypt('test'),
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            
        ]);
        DB::table('users')->insert([
            'name' => 'binary hasbi',
            'email' => 'bnaryhasbi@email.com',
            'role_id' => '2',
            'is_active' => '1',
            'password' => bcrypt('test'),
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);
    }
}
