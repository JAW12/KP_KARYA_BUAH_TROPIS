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
            'nama' => 'user',
            'email' => 'user@gmail.com',
            'role' => 0,
            'username' => 'user',
            'password' => '$2y$10$stJUa/UaRT6oaPly82pMSOqklUeZVtRQOR/lJK2RzAK2AePy6byx6',
            'alamat' => 'kenjeran',
            'telp' => '0812345678',
            'status' => 1
        ]);

        User::create([
            'nama' => 'adminproduksi',
            'email' => 'admin@gmail.com',
            'role' => 1,
            'username' => 'adminproduksi',
            'password' => '$2y$10$A8hsCPGs2tQAa.wSnzTSve6vpfYUo1h96URmUPEIuqzak87THGbqq',
            'alamat' => 'kenjeran',
            'telp' => '0812345678',
            'status' => 1
        ]);

        User::create([
            'nama' => 'adminpembelian',
            'email' => 'admin@gmail.com',
            'role' => 2,
            'username' => 'adminpembelian',
            'password' => '$2y$10$l4GQ0DUJyoa5mtj9FW0ulO7LWFZeoksbWK4l5YCkOlqsh6vFc.9FO',
            'alamat' => 'kenjeran',
            'telp' => '0812345678',
            'status' => 1
        ]);

        User::create([
            'nama' => 'adminpenjualan',
            'email' => 'admin@gmail.com',
            'role' => 3,
            'username' => 'adminpenjualan',
            'password' => '$2y$10$EeuAyYjz0PiS8fhwUW6XaOiNrGXuch8.qUrN3Y2JQdQQXUMy0uC02',
            'alamat' => 'kenjeran',
            'telp' => '0812345678',
            'status' => 1
        ]);

        User::create([
            'nama' => 'owner',
            'email' => 'owner@gmail.com',
            'role' => 4,
            'username' => 'owner',
            'password' => '$2y$10$.ukY6iX8MTOzyvKTCSvTA.ySoHCvyOemV.XubO7nJiXaJvTfXkBsW',
            'alamat' => 'kenjeran',
            'telp' => '0812345678',
            'status' => 1
        ]);
    }
}
