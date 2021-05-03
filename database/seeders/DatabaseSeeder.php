<?php

namespace Database\Seeders;

use App\Models\User;
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
        // \App\Models\User::factory(10)->create();
        $this->call(CategoriesSeeder::class);
        $this->call(FruitsSeeder::class);
        $this->call(ProductsSeeder::class);

        User::create([
            'nama' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 1,
            'username' => 'admin',
            'password' => 'admin',
            'alamat' => 'kenjeran',
            'telp' => '0812345678',
            'status' => 1
        ]);
    }
}
