<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = collect([
            [1, 'Tray Alpukat', [1], 60000, 'Tray Alpukat isi 20pcs'],
            [1, 'Tray Anggur', [2], 54000, 'Tray Anggur isi 20pcs'],
            [1, 'Tray Anggur Merah', [3], 45000, 'Tray Anggur Merah isi 20pcs'],
            [1, 'Tray Durian', [8], 60000, 'Tray Durian isi 20pcs'],
            [1, 'Tray Blewah', [6], 45000, 'Tray Blewah isi 20pcs'],
            [1, 'Tray Gramenberry', [9], 115000, 'Tray Gramenberry isi 20pcs'],
            [1, 'Tray Jambu Merah', [11], 45000, 'Tray Jambu Merah isi 20pcs'],
            [1, 'Tray Jeruk', [12], 44000, 'Tray Jeruk isi 20pcs'],
            [1, 'Tray Jeruk Nipis', [13], 45000, 'Tray Jeruk Nipis isi 20pcs'],
            [1, 'Tray Kedondong', [15], 45000, 'Tray Kedondong isi 20pcs'],
            [1, 'Tray Kesemek', [17], 45000, 'Tray Kesemek isi 20pcs'],
            [1, 'Tray Lychee', [20], 70000, 'Tray Lychee isi 20pcs'],
            [1, 'Tray Lemon', [19], 65000, 'Tray Lemon isi 20pcs'],
            [1, 'Tray Mangga Gadung', [21], 50000, 'Tray Mangga Gadung isi 20pcs'],
            [1, 'Tray Melon', [22], 45000, 'Tray Melon isi 20pcs'],
            [1, 'Tray Naga Merah', [24], 54000, 'Tray Naga Merah isi 20pcs'],
            [1, 'Tray Nanas', [25], 50000, 'Tray Nanas isi 20pcs'],
            [1, 'Tray Nangka', [26], 55000, 'Tray Nangka isi 20pcs'],
            [1, 'Tray Pear', [27], 45000, 'Tray Pear isi 20pcs'],
            [1, 'Tray Pepaya', [28], 40000, 'Tray Pepaya isi 20pcs'],
            [1, 'Tray Persik', [29], 60000, 'Tray Persik isi 20pcs'],
            [1, 'Tray Plum', [30], 60000, 'Tray Plum isi 20pcs'],
            [1, 'Tray Raspberry', [31], 115000, 'Tray Raspberry isi 20pcs'],
            [1, 'Tray Semangka', [32], 40000, 'Tray Semangka isi 20pcs'],
            [1, 'Tray Sirsak', [33], 40000, 'Tray Sirsak isi 20pcs'],
            [1, 'Tray Strawberry', [34], 60000, 'Tray Strawberry isi 20pcs'],
            [1, 'Tray Terong Belanda', [35], 55000, 'Tray Terong Belanda isi 20pcs'],
            [1, 'Tray Tomat', [37], 40000, 'Tray Tomat isi 20pcs'],
            [1, 'Tray Wortel', [38], 40000, 'Tray Wortel isi 20pcs'],
            [2, 'Pasta Sirsak', [33], 30000, 'Pasta / Daging Sirsak berat 1 Kg'],
            [3, 'Jambu Merah Tanpa Biji', [11], 60000, 'Jambu Merah Tanpa Biji Vakum Berat 1 Kg'],
            [2, 'Pasta Jambu Merah', [11], 60000, 'Pasta / Daging Jambu Merah berat 1 Kg'],
            [3, 'Nangka Madu Vakum 500gr', [26], 45000, 'Jambu Merah Tanpa Biji Vakum Berat 1 Kg'],
            [3, 'Nangka Madu Vakum 1Kg', [26], 80000, 'Jambu Merah Tanpa Biji Vakum Berat 1 Kg'],
            [2, 'Pasta Nangka Madu', [26], 75000, 'Pasta / Daging Nangka Madu berat 1 Kg'],
            [4, 'Nangka Madu Pack', [26], 60000, 'Nangka Pack berat 600 gram'],
            [5, 'Alpukat Dadu', [1], 55000, 'Alpukat Dadu berat 500 gram'],
            [6, 'Alpukat Slice', [1], 75000, 'Alpukat Slice berat 500 gram'],
            [2, 'Pasta Alpukat', [1], 50000, 'Pasta / Daging Alpukat berat 1 Kg'],
            [6, 'Mangga Gadung Slice Besar', [21], 80000, 'Mangga Gadung Slice berat 1 Kg'],
            [2, 'Pasta Mangga Gadung', [21], 80000, 'Pasta / Daging Mangga Gadung berat 1 Kg'],
            [6, 'Melon Slice', [22], 60000, 'Melon Slice berat 1 Kg'],
            [3, 'Blewah', [6], 20000, 'Jambu Merah Tanpa Biji Vakum Berat 1 Kg'],
            [5, 'Apel Fuji Dadu 200gr', [4], 25000, 'Apel Fuji Dadu berat 200 gram'],
            [5, 'Apel Fuji Dadu 500gr', [4], 50000, 'Apel Fuji Dadu berat 500 gram'],
            [2, 'Pasta Durian Premium', [8], 90000, 'Pasta / Daging Durian Premium berat 1 Kg'],
            [4, 'Durian Kupas Premium', [8], 85000, 'Durian Kupas Premium Pack berat 900 gram'],
            [7, 'Pancake Durian Small', [8], 60000, 'Pancake Durian uk. Small isi 21pcs'],
            [7, 'Pancake Durian Medium', [8], 60000, 'Pancake Durian uk. Medium isi 15pcs'],
            [7, 'Pancake Durian Large', [8], 65000, 'Pancake Durian uk. Large isi 10pcs'],
            [7, 'Pancake Buah', [1, 21, 26, 34], 70000, 'Pancake Buah (Alpukat, Mangga Gadung, Nangka, Strawberry) isi 15pcs'],
            [3, 'Naga Merah', [24], 60000, 'Naga Merah Vakum Berat 1 Kg'],
            [6, 'Nanas Slice Bulat', [25], 55000, 'Nanas Slice Bulat berat 1 Kg'],
            [3, 'Nanas Panjang', [25], 70000, 'Nanas Panjang Vakum Berat 1 Kg'],
            [3, 'Durian Kasur Bondowoso', [8], 70000, 'Durian Kasur Bondowoso Vakum Berat 500 gram'],
            [4, 'Durian Tupai King', [8], 250000, 'Durian Tupai King Pack berat 400 gram'],
            [4, 'Durian Radja', [8], 250000, 'Durian Radja Pack berat 400 gram'],
            [3, 'Jagung Manis Pipil', [10], 25000, 'Jagung Manis Pipil Vakum Berat 1 Kg'],
            [9, 'Sari Jeruk Murni', [12], 60000, 'Sari Jeruk Murni 1 Liter'],
            [3, 'Kedondong', [15], 35000, 'Kedondong Vakum Berat 500 gram'],
            [3, 'Terong Belanda', [35], 45000, 'Terong Belanda Vakum Berat 500 gram'],
            [3, 'Strawberry Jumbo', [34], 120000, 'Strawberry uk. Jumbo Vakum Berat 1 Kg'],
            [3, 'Strawberry Biasa 1Kg', [34], 110000, 'Strawberry uk. Biasa Vakum Berat 1 Kg'],
            [3, 'Strawberry Biasa 500gr', [34], 60000, 'Strawberry uk. Biasa Vakum Berat 500 gram'],
            [9, 'Sari Jeruk Nipis Murni', [13], 30000, 'Sari Jeruk Nipis Murni 250 Ml (Standing Pouch)'],
            [9, 'Sari Lemon Murni', [19], 40000, 'Sari Lemon Murni 250 Ml (Standing Pouch)'],
            [8, 'Degan 250gr', [7], 30000, 'Standing Pouch berisi Degan seberat 250 gram'],
            [8, 'Degan 500gr', [7], 55000, 'Standing Pouch berisi Degan seberat 500 gram'],
            [8, 'Kopyor', [18], 60000, 'Standing Pouch berisi Kopyor seberat 250 gram'],
            [8, 'Raspberry', [31], 50000, 'Standing Pouch berisi Raspberry seberat 150 gram'],
            [8, 'Gramenberry', [9], 50000, 'Standing Pouch berisi Gramenberry seberat 150 gram'],
            [3, 'Blackberry', [5], 50000, 'Blackberry Vakum Berat 150 gram'],
            [3, 'Mixberry', [23, 31, 34], 65000, 'Mixberry Vakum Berat 250 gram'],
            [3, 'Black Grape', [2], 50000, 'Black Grape Vakum Berat 250 gram'],
            [3, 'Lychee', [20], 55000, 'Lychee Vakum Berat 500 gram'],
            [3, 'Plum', [30], 55000, 'Plum Vakum Berat 500 gram'],
            [3, 'Persik', [29], 50000, 'Persik Vakum Berat 500 gram'],
            [3, 'Kelengkeng', [16], 40000, 'Kelengkeng Vakum Berat 250 gram'],
            [8, 'Kacang Hijau', [14], 100000, '6 Pack Kacang Hijau Siap Masak'],
            [3, 'Anggur Merah', [3], 40000, 'Anggur Merah Vakum Berat 500 gram'],
            [3, 'Timun Mas', [36], 30000, 'Timun Mas Vakum Berat 250 gram'],
            [3, 'Biji Nangka Madu', [26], 15000, 'Biji Nangka Madu Vakum Berat 500 gram'],
            [3, 'Mulberry', [23], 50000, 'Mulberry Vakum Berat 250 gram']
        ]);

        $product->each(function ($k) {
            $slug = Str::slug($k[1]);

            Product::create([
                'category_id' => $k[0],
                'nama' => $k[1],
                'slug' => $slug,
                'foto' => $slug . '.png',
                'harga_jual' => $k[3],
                'deskripsi' => $k[4]
            ]);

            $label = collect($k[2]);
            $label->each(function ($l) {
                $last = DB::table('products')->latest('id')->first();
                DB::table('fruit_product')->insert([
                    'product_id' => $last->id,
                    'fruit_id' => $l
                ]);
            });
        });

        $change = collect([
            ['Nangka Madu Vakum 500gr', 'Nangka Madu Vakum'],
            ['Nangka Madu Vakum 1Kg', 'Nangka Madu Vakum'],
            ['Apel Fuji Dadu 200gr', 'Apel Fuji Dadu'],
            ['Apel Fuji Dadu 500gr', 'Apel Fuji Dadu'],
            ['Strawberry Biasa 1Kg', 'Strawberry Biasa'],
            ['Strawberry Biasa 500gr', 'Strawberry Biasa'],
            ['Degan 250gr', 'Degan'],
            ['Degan 500gr', 'Degan']
        ]);

        $change->each(function ($c) {
            Product::where('nama', $c[0])
                ->update(['nama' => $c[1]]);
        });
    }
}
