<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = collect([
            ['Tray', 'Tray buah terdiri dari 20 pcs / blok buah yang siap langsung digunakan untuk:\n
            - Konsumsi Langsung\n
            Untuk beberapa jenis buah tray bisa langsung di makan, misal : Nanas, Semangka, Pear, Blewah, Strawberry, Durian, Mangga, Nangka, Pisang, Alpukat, Apel, Melon, danPepaya (tidak perlu dicairkan dulu, bisa langsung di makan)\n\n
            - Mix es buah\nAmbil beberapa jenis buah sesuai selera, tempatkan di mangkok, tambahkan dengan susu kental dan sirup sesuai selera.\n\n
            - Jus(untuk 1 gelas juice 14 Oz cukup menggunakan 3-4 blok ditambah gula, es dan air secukupnya lalu di blender 3 menit,  siap disajikan)\n1 Tray Buah bisa jadi 5-6 porsi Jus\nKhusus Tray Lemon dan Jeruk Nipis, cukup menggunakan 1-2 blok saja dan tambahkan gula secukupnya.\n\n
            - Smoothies\nBisa mix beberapa jenis buah, cukup 1-2 blok perjenis buah , tambahkan gula dan susu secukupnya (blend menggunakan mesin Smoothies sekitar 3 menit)\n\n
            - Minuman infus, dengan bahan dasar air/teh/susu/sodaMasukkan 3-4 blok buah ke dalam air/teh/susu/soda 330-450 ml, tambahkan gula secukupnya\n\nNb: penggunaan jumlah blok Tray Buah perlu disesuaikan dengan ukuran gelas dan harga jual, untuk keperluan usaha pengguna di sarankan menghitung dan mencoba takaran yg pas (jumlah blok buah, gula, es dan air yg diperlukan untuk rasa yg enak) disesuaikan dengan ukuran gelas dan harga jual.'],
            ['Pasta', 'Bisa digunakan untuk:\n
            - Jus / Smoothies
            Untuk uk 500gr bisa di bagi 5-7 porsi\n
            Untuk uk 1kg bisa di bagi menjadi 10-14 porsi\n
            Caranya dalam kondisi beku di potong potong, kemudian di bungkus plastik satu2 atau langsung di tempatkan di tepak plastik dan di simpan dalam frezeer\n
            Gunakan sesuai kebutuhan
            Untuk membuat 1 gelas juice uk 14 Oz\n
            Ambil 1 potong/bagian buah tambahkan air dingin 150 ml + es batu secukupnya + gula secukupnya lalu di blender selama 3 menit, juice siap di sajikan\n\n
            - Pudding\n
            Potong pasta beku sesuai kebutuhan atau jika untuk penggunaan banyak, pasta bisa dicaikan dulu baru diolah menjadi pudding\n\n
            - Konsumsi langsung\n
            Keluarkan dari freezer
            Diamkan pasta sekitar 15-25 menit\n\n
            - Gelato, es krim, dan es puter\n
            di biarkan dulu sekitar 30 menit baru di olah'],
            ['Vakum', 'Bisa digunakan untuk:\n
            - Topping\n
            Bisa langsung dipotong dalam keadaan beku, misal alpukat slice untuk masakan jepang, bisa langsung di iris dalam keadaan beku
            \n\n
            - Konsumsi langsung\n
            Di biarkan 10-15 menit baru di konsumsi\n\n

            - Jus / Smoothies\n
            Langsung di gunakan sesuai kebutuhan / dipotong dalam keadaan beku sesuai keperluan'],
            ['Pack', 'Dicairkan terlebih dahulu selama 30 menit untuk bisa dikonsumsi'],
            ['Dadu', 'Bisa digunakan untuk:\n
            - Konsumsi langsung\n
            Bisa langsung di makan dalam keadaan beku, atau di biarkan agak mencair 5-10 menit baru di konsumsi
            \n\n
            - Jus / Smoothies\n
            Langsung di gunakan dalam keadaan beku\n
            Ambil secukupnya, tambahkan air, es dan gula secukupnya, lalu di blender 3 menit, siap disajikan
            \n\n
            - Topping minuman\n
            Di gunakan dalam keadaan beku
            \n\n
            - Es buah / es campur\n
            Di gunakan dalam keadaan beku'],
            ['Slice', 'Bisa digunakan untuk:\n
            - Topping\n
            Bisa langsung dipotong dalam keadaan beku, misal alpukat slice untuk masakan jepang, bisa langsung di iris dalam keadaan beku\n\n
            - Konsumsi langsung\n
            Di biarkan 10-15 menit baru di konsumsi\n\n
            - Jus / Smoothies\n
            Langsung di gunakan sesuai kebutuhan / dipotong dalam keadaan beku sesuai keperluan'],
            ['Pancake', ''],
            ['Standing Pouch', '
            Dicairkan dulu baru di gunakan, bisa dibiarkan sekitar 30 menit akan mencair'],
            ['Sari Murni', 'Dicairkan dulu baru di gunakan, bisa dibiarkan sekitar 30 menit akan mencair']]
        );
        $category->each(function ($k) {
            Category::create([
                'nama' => $k[0],
                'slug' => Str::slug($k[0]),
                'keterangan' => $k[1]
            ]);
        });
    }
}
