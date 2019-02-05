<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $user = App\User::create([
            'email' => 'admin@lacascada.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);
    }
}
