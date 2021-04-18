<?php

namespace Database\Seeders;

use App\Models\Fruit;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class FruitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fruits = collect([
            ['Alpukat', 'Manfaat Alpukat:
1. Menyehatkan jantung
2. Melindungi mata
3. Memperkuat tulang
4. Mengurangi risiko kanker
5. Membantu menurunkan berat badan
6. Nutrisi kehamilan'],
            ['Anggur', 'Manfaat Anggur:
1. Menyehatkan kulit, mata dan rambut
2. Mencegah diabetes dan kanker
3. Menjaga kesehatan jantung dan tulang
4. Meningkatkan fungsi otak
5. Membantu proses tidur
6. Menjaga berat badan'],
            ['Anggur Merah', 'Manfaat Anggur Merah:
1. Mencegah dan melawan kanker
2. Menjaga kesehatan otak dan jantung
3. Menurunkan tekanan darah tinggi
4. Membantu menurunkan berat badan
5. Menyehatkan mata dan kulit
6. Melawan penuaan dini'],
            ['Apel', 'Manfaat Apel:
1. Membangun kekebalan tubuh
2. Mencegah kerusakan sel, sembelit dan diare
3. Menurunkan kolesterol, risiko kanker, penyakit jantung, stroke dan diabetes tipe 2
4. Meningkatkan daya memori
5. Menjaga kesehatan tulang, gigi dan kulit'],
            ['Blackberry', 'Manfaat Blackberry:1. Memperkuat daya tahan tubuh
2. Menjaga kesehatan pencernaan
3. Menyembuhkan luka
4. Mencegah kanker
5. Membantu pembentukan tulang dan pertumbuhan sel
6. Melindungi mata'],
            ['Blewah', 'Manfaat Blewah:
1. Mencegah kanker dan dehidrasi
2. Meningkatkan kesehatan tulang dan ginjal
3. Meningkatkan energi
4. Menyembuhkan masalah pencernaan
5. Membantu menurunkan berat badan'],
            ['Degan', 'Manfaat Degan:1. Mengatasi masalah pencernaan
2. Menghilangkan dehidrasi
3. Menurunkan berat badan
4. Mengontrol tekanan darah
5. Melindungi dan menjaga elastisitas kulit
6. Menetralisir racun dalam tubuh
7. Mencegah penuaan diri'],
            ['Durian', 'Manfaat Durian:
1. Meredakan anemia
2. Membantu menjaga kesehatan tulang dan pencernaan
3. Membantu meringankan depresi dan meningkatkan kualitas tidur
4. Mencegah kanker dan penuaan diri
5. Meningkatkan kesuburan dan menyembuhkan PCOS'],
            ['Gramenberry', ''],
            ['Jagung', 'Manfaat Jagung:
1. Melancarkan pencernaan
2. Menyehatkan mata, kulit dan jantung
3. Kaya kalori, vitamin dan mineral
4. Mencegah anemia, diabetes dan kanker'],
            ['Jambu Merah', 'Manfaat Jambu Merah:
1. Meningkatkan imunitas tubuh
2. Menurunkan tekanan darah dan kolesterol
3. Melancarkan saluran pencernaan
4. Menyehatkan mata dan kulit
5. Mencegah demam berdarah dan diabetes'],
            ['Jeruk', 'Manfaat Jeruk:
1. Meningkatkan daya tahan tubuh
2. Mencegah kanker
3. Menjaga tekanan darah, gula darah dan kolesterol tetap normal
4. Menyehatkan mata
5. Menyembuhkan sembelit
6. Menjaga kesehatan mental'],
            ['Jeruk Nipis', 'Manfaat Jeruk Nipis:
1. Melancarkan pencernaan
2. Membantu menurunkan berat badan
3. Menjaga kadar gula darah
4. Mencegah penyakit jantung dan kanker
5. Meningkatkan sistem kekebalan tubuh
6. Mengatasi penyakit peradangan'],
            ['Kacang Hijau', 'Manfaat Kacang Hijau:
1. Mengontrol berat badan
2. Meningkatkan sistem kekebalan tubuh
3. Melancarkan pencernaan
4. Menjaga kesehatan kulit
5. Mengurangi risiko osteoporosis
6. Baik untuk penderita diabetes'],
            ['Kedondong', 'Manfaat Kedondong:
1. Meningkatkan vitalitas
2. Mencegah dehidrasi
3. Bersifat antioksidan dan meningkatkan imunitas
4. Mengobati luka
5. Menurunkan berat badan
6. Menyehatkan jantung
7. Mengendalikan kadar kolesterol
8. Meredakan batuk'],
            ['Kelengkeng', 'Manfaat Kelengkeng:
1. Menjaga kesehatan jantung dan mata
2. Mencegah penyakit batu ginjal
3. Menurunkan berat badan
4. Mengatasi diabetes
5. Menguatkan tulang'],
            ['Kesemek', 'Manfaat Kesemek:
1. Sumber antioksidan tinggi
2. Menjaga kesehatan jantung, mata dan hati
3. Membantu proses program diet
4. Mempertahkan sistem metabolisme
5. Meningkatkan sistem imun'],
            ['Kopyor', 'Manfaat Kopyor:1. Mengatasi gatal - gatal, dehidrasi dan demam berdarah
2. Meningkatkan stamina dan imunitas tubuh
3. Mencegah penuaan diri, diabetes dan batu ginjal
4. Baik untuk ibu hamil
5. Menjaga kesehatan kulit dan pencernaan'],
            ['Lemon', 'Manfaat Lemon:
1. Melancarkan pencernaan
2. Menjaga kesehatan mulut dan jantung
3. Mencegah anemia dan resiko stroke iskemik
4. Mengatasi sakit tenggorokan
5. Membersihkan darah
6. Meningkatkan sistem kekebalan tubuh'],
            ['Lychee', 'Manfaat Lychee:
1. Meningkatkan imunitas tubuh
2. Menjaga kesehatan jantung
3. Mencegah penyakit kanker
4. Mengatasi sembelit
5. Membantu menurunkan berat badan
6. Meningkatkan kepadatan tulang'],
            ['Mangga Gadung', 'Manfaat Mangga Gadung:
1. Mengurangi kadar kolesterol
2. Mencegah kanker
3. Menyehatkan kulit wajah dan mata
4. Meningkatkan kekebalan dan zat besi tubuh
5. Membakar kalori'],
            ['Melon', 'Manfaat Melon:
1. Menurunkan tekanan darah tinggi
2. Menjaga kesehatan mata dan pencernaan
3. Menyehatkan tulang
4. Mencegah penyakti jantung, kanker
5. Menurunkan berat badan'],
            ['Mulberry', 'Manfaat Mulberry:
1. Menurunkan kolesterol
2. Menjaga kesehatan mata dan kulit
3. Meningkatkan sistem imun
4. Mengontrol gula darah
5. Mencegah anemia dan risiko kanker'],
            ['Naga Merah', 'Manfaat Naga Merah:
1. Sumber antioksidan tinggi
2. Membantu proses detoksifikasi
3. Mencegah kanker dan diabetes
4. Menurunkan tekanan darah tinggi
5. Mengatasi masalah pencernaan
6. Menjaga kesehatan tulang dan peredaran darah'],
            ['Nanas', 'Manfaat Nanas:
1. Melancarkan pencernaan
2. Meningkatkan imunitas
3. Membantu menurunkan berat badan
4. Mencegah kanker
5. Meringankan radang sendi rematik'],
            ['Nangka', 'Manfaat Nangka:
1. Melancarkan pencernaan
2. Menjaga berat badan
3. Mencegah penyakit kardiovaskular
4. Memelihara kesehatan kulit
5. Mengurangi risiko kanker'],
            ['Pear', 'Manfaat Pear:
1. Menjaga sistem pencernaan
2. Mengandung antioksidan dan berbagai nutrisi
3. Mencegah diabetes
4. Memperkuat kekebalan tubuh
5. Menjaga kesehatan kulit'],
            ['Pepaya', 'Manfaat Pepaya:
1. Meningkatkan imun tubuh
2. Melindungi jantung dan mata
3. Mencegah kanker, risiko alzheimer dan peradangan
4. Membantu diet sehat
5. Melancarkan sistem pencernaan
6. Menurunkan kolesterol'],
            ['Persik', 'Manfaat Persik:
1. Menjaga kesehatan mata dan saluran cerna
2. Meningkatkan daya tahan tubuh
3. Melembabkan kulit dan menghambat penuaan diri
4. Mencegah pengeroposan tulang
5. Menghambat pertumbuhan dan penyebaran sel kanker'],
            ['Plum', 'Manfaat Plum:
1. Menurunkan berat badan
2. Meningkatkan sistem kekebalan tubuh
3. Menjaga kesehatan mata
4. Menjaga kadar gula darah
5. Mencegah sembelit dan osteoporosis'],
            ['Raspberry', 'Manfaat Raspberry:
1. Menjaga kesehatan pencernaan dan otak
2. Meredakan gejala radang sendir
3. Mencegah risiko penyakit kronis dan kanker
4. Melindungi mata
5. Melawan penuaan
6. Mengatasi diabetes'],
            ['Semangka', 'Manfaat Semangka:
1. Mengatasi asma
2. Menyuburkan kandungan
3. Mencegah dehidrasi dan risiko penyakit jantung
4. Meredakan nyeri otot
5. Melindungi kulit, rambut dan mata tetap sehat'],
            ['Sirsak', 'Manfaat Sirsak:
1. Meningkatkan daya tahan tubuh
2. Meredakan peradangan
3. Melancarkan pencernaan
4. Melawan infeksi
5. Mencegah pertumbuhan sel kanker'],
            ['Strawberry', 'Manfaat Strawberry:
1. Meningkatkan kekebalan tubuh
2. Mencegah risiko penyakit jantung, kanker dan stroke
3. Membantu meningkatkan memori
4. Mengobati diabetes
5. Melancarkan buang air besar
6. Menurunkan berat badan'],
            ['Terong Belanda', 'Manfaat Terong Belanda:
1. Mengatasi masalah pencernaan
2. Mengurangi sembelit
3. Mencegah diabetes dan darah tinggi
4. Menjaga metabolisme tubuh
5. Meningkatkan penglihatan
6. Bagus untuk menurunkan berat badan'],
            ['Timun Mas', 'Manfaat Timun Mas:
1. Sumber antioksidan
2. Membantu sistem pencernaan dan melancarkan proses detoksifikasi
3. Mencegah kanker
4. Menyehatkan mata dan ginjal
5. Mempertajam daya ingat'],
            ['Tomat', 'Manfaat Tomat:
1. Mencegah kanker
2. Mengontrol tekanan darah, diabetes dan kesehatan jantung
3. Mengatasi sembelit
4. Menjaga kesehatan mata
5. Membuat kulit lebih sehat'],
            ['Wortel', 'Manfaat Wortel:
1. Mencegah risiko kanker prostat, kanker usus besar, leukemia, diabetes dan penyakit lainnya
2. Menjaga kesehatan mata, jantung dan tekanan darah
3. Meningkatkan sistem kekebalan tubuh
4. Menurunkan kolesterol'],
            ]
        );
        $fruits->each(function ($k) {
            Fruit::create([
                'nama' => $k[0],
                'slug' => Str::slug($k[0]),
                'manfaat' => $k[1]
            ]);
        });
    }
}
