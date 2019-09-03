<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert(
           [ 'name' => 'administrator',
           ]
        );

        DB::table('roles')->insert(
            [
                'name' => 'author',

        ]);

        DB::table('roles')->insert([
            'name' => 'subscriber',
        ]);
    }
}
