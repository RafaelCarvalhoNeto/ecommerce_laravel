<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);
        // $this->call(MessageTableSeeder::class);

        DB::table('admins')->insert([
            'nome' => 'Rafael',
            'sobrenome' => 'Carvalho',
            'cpf' => '123456789',
            'email' => 'rafaelcarvalhoneto@gmail.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
