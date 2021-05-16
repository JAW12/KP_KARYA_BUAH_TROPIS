<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        // \App\Models\User::factory(10)->create();
        $this->call(CategoriesSeeder::class);
        $this->call(FruitsSeeder::class);
        $this->call(ProductsSeeder::class);

        User::create([
            'nama' => 'User',
            'email' => 'user@gmail.com',
            'role' => 0,
            'username' => 'user',
            'password' => '$2y$10$stJUa/UaRT6oaPly82pMSOqklUeZVtRQOR/lJK2RzAK2AePy6byx6',
            'alamat' => 'kenjeran',
            'telp' => '0812345678',
            'status' => 1
        ]);

        User::create([
            'nama' => 'Rudi Siji',
            'email' => 'adminproduksi@gmail.com',
            'role' => 1,
            'username' => 'PRD001',
            'password' => Hash::make('rudi_prd001'),
            'alamat' => 'kenjeran',
            'telp' => '0812345678',
            'status' => 1
        ]);

        User::create([
            'nama' => 'Bambang Loro',
            'email' => 'adminpembelian@gmail.com',
            'role' => 2,
            'username' => 'PMB001',
            'password' => Hash::make('bambang_pmb001'),
            'alamat' => 'kenjeran',
            'telp' => '0812345678',
            'status' => 1
        ]);

        User::create([
            'nama' => 'Tono Telu',
            'email' => 'adminpenjualan@gmail.com',
            'role' => 3,
            'username' => 'PNJ001',
            'password' => Hash::make('tono_pnj001'),
            'alamat' => 'kenjeran',
            'telp' => '0812345678',
            'status' => 1
        ]);

        User::create([
            'nama' => 'Parman Papat',
            'email' => 'owner@gmail.com',
            'role' => 4,
            'username' => 'OWN001',
            'password' => Hash::make('parman_own001'),
            'alamat' => 'kenjeran',
            'telp' => '0812345678',
            'status' => 1
        ]);
    }
}
