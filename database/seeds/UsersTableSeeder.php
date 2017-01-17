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
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('1234'),
            'is_admin' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'test',
            'email' => 'test@test.test',
            'password' => bcrypt('1234'),
            'is_admin' => 0,
        ]);

        factory(App\User::class, 3)->create();

    }
}
