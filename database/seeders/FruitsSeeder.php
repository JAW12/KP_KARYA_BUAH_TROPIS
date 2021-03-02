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
            ['Alpukat', '
            Manfaat Alpukat:<br>
            1. Menyehatkan jantung<br>
            2. Melindungi mata<br>
            3. Memperkuat tulang<br>
            4. Mengurangi risiko kanker<br>
            5. Membantu menurunkan berat badan<br>
            6. Nutrisi kehamilan'],
            ['Anggur', '
            Manfaat Anggur:<br>
            1. Menyehatkan kulit, mata dan rambut<br>
            2. Mencegah diabetes dan kanker<br>
            3. Menjaga kesehatan jantung dan tulang<br>
            4. Meningkatkan fungsi otak<br>
            5. Membantu proses tidur<br>
            6. Menjaga berat badan'],
            ['Anggur Merah', '
            Manfaat Anggur Merah:<br>
            1. Mencegah dan melawan kanker<br>
            2. Menjaga kesehatan otak dan jantung<br>
            3. Menurunkan tekanan darah tinggi<br>
            4. Membantu menurunkan berat badan<br>
            5. Menyehatkan mata dan kulit<br>
            6. Melawan penuaan dini'],
            ['Apel', '
            Manfaat Apel:<br>
            1. Membangun kekebalan tubuh<br>
            2. Mencegah kerusakan sel, sembelit dan diare<br>
            3. Menurunkan kolesterol, risiko kanker, penyakit jantung, stroke dan diabetes tipe 2<br>
            4. Meningkatkan daya memori<br>
            5. Menjaga kesehatan tulang, gigi dan kulit'],
            ['Blackberry', '
            Manfaat Blackberry:
            1. Memperkuat daya tahan tubuh<br>
            2. Menjaga kesehatan pencernaan<br>
            3. Menyembuhkan luka<br>
            4. Mencegah kanker<br>
            5. Membantu pembentukan tulang dan pertumbuhan sel<br>
            6. Melindungi mata'],
            ['Blewah', '
            Manfaat Blewah:<br>
            1. Mencegah kanker dan dehidrasi<br>
            2. Meningkatkan kesehatan tulang dan ginjal<br>
            3. Meningkatkan energi<br>
            4. Menyembuhkan masalah pencernaan<br>
            5. Membantu menurunkan berat badan'],
            ['Degan', '
            Manfaat Degan:
            1. Mengatasi masalah pencernaan<br>
            2. Menghilangkan dehidrasi<br>
            3. Menurunkan berat badan<br>
            4. Mengontrol tekanan darah<br>
            5. Melindungi dan menjaga elastisitas kulit<br>
            6. Menetralisir racun dalam tubuh<br>
            7. Mencegah penuaan diri'],
            ['Durian', '
            Manfaat Durian:<br>
            1. Meredakan anemia<br>
            2. Membantu menjaga kesehatan tulang dan pencernaan<br>
            3. Membantu meringankan depresi dan meningkatkan kualitas tidur<br>
            4. Mencegah kanker dan penuaan diri
            <br>
            5. Meningkatkan kesuburan dan menyembuhkan PCOS'],
            ['Gramenberry', ''],
            ['Jagung', '
            Manfaat Jagung:<br>
            1. Melancarkan pencernaan<br>
            2. Menyehatkan mata, kulit dan jantung<br>
            3. Kaya kalori, vitamin dan mineral<br>
            4. Mencegah anemia, diabetes dan kanker'],
            ['Jambu Merah', '
            Manfaat Jambu Merah:<br>
            1. Meningkatkan imunitas tubuh<br>
            2. Menurunkan tekanan darah dan kolesterol<br>
            3. Melancarkan saluran pencernaan<br>
            4. Menyehatkan mata dan kulit<br>
            5. Mencegah demam berdarah dan diabetes'],
            ['Jeruk', 'Manfaat Jeruk:<br>
            1. Meningkatkan daya tahan tubuh<br>
            2. Mencegah kanker<br>
            3. Menjaga tekanan darah, gula darah dan kolesterol tetap normal<br>
            4. Menyehatkan mata<br>
            5. Menyembuhkan sembelit<br>
            6. Menjaga kesehatan mental'],
            ['Jeruk Nipis', '
            Manfaat Jeruk Nipis:<br>
            1. Melancarkan pencernaan<br>
            2. Membantu menurunkan berat badan<br>
            3. Menjaga kadar gula darah<br>
            4. Mencegah penyakit jantung dan kanker<br>
            5. Meningkatkan sistem kekebalan tubuh<br>
            6. Mengatasi penyakit peradangan'],
            ['Kacang Hijau', '
            Manfaat Kacang Hijau:<br>
            1. Mengontrol berat badan<br>
            2. Meningkatkan sistem kekebalan tubuh<br>
            3. Melancarkan pencernaan<br>
            4. Menjaga kesehatan kulit<br>
            5. Mengurangi risiko osteoporosis<br>
            6. Baik untuk penderita diabetes'],
            ['Kedondong', '
            Manfaat Kedondong:<br>
            1. Meningkatkan vitalitas<br>
            2. Mencegah dehidrasi<br>
            3. Bersifat antioksidan dan meningkatkan imunitas<br>
            4. Mengobati luka<br>
            5. Menurunkan berat badan<br>
            6. Menyehatkan jantung<br>
            7. Mengendalikan kadar kolesterol<br>
            8. Meredakan batuk'],
            ['Kelengkeng', '
            Manfaat Kelengkeng:<br>
            1. Menjaga kesehatan jantung dan mata<br>
            2. Mencegah penyakit batu ginjal<br>
            3. Menurunkan berat badan<br>
            4. Mengatasi diabetes<br>
            5. Menguatkan tulang'],
            ['Kesemek', '
            Manfaat Kesemek:<br>
            1. Sumber antioksidan tinggi<br>
            2. Menjaga kesehatan jantung, mata dan hati<br>
            3. Membantu proses program diet<br>
            4. Mempertahkan sistem metabolisme<br>
            5. Meningkatkan sistem imun'],
            ['Kopyor', '
            Manfaat Kopyor:
            1. Mengatasi gatal - gatal, dehidrasi dan demam berdarah<br>
            2. Meningkatkan stamina dan imunitas tubuh<br>
            3. Mencegah penuaan diri, diabetes dan batu ginjal<br>
            4. Baik untuk ibu hamil<br>
            5. Menjaga kesehatan kulit dan pencernaan'],
            ['Lemon', '
            Manfaat Lemon:<br>
            1. Melancarkan pencernaan<br>
            2. Menjaga kesehatan mulut dan jantung<br>
            3. Mencegah anemia dan resiko stroke iskemik<br>
            4. Mengatasi sakit tenggorokan<br>
            5. Membersihkan darah<br>
            6. Meningkatkan sistem kekebalan tubuh'],
            ['Lychee', '
            Manfaat Lychee:<br>
            1. Meningkatkan imunitas tubuh<br>
            2. Menjaga kesehatan jantung<br>
            3. Mencegah penyakit kanker<br>
            4. Mengatasi sembelit<br>
            5. Membantu menurunkan berat badan<br>
            6. Meningkatkan kepadatan tulang'],
            ['Mangga Gadung', '
            Manfaat Mangga Gadung:<br>
            1. Mengurangi kadar kolesterol<br>
            2. Mencegah kanker<br>
            3. Menyehatkan kulit wajah dan mata<br>
            4. Meningkatkan kekebalan dan zat besi tubuh<br>
            5. Membakar kalori'],
            ['Melon', '
            Manfaat Melon:<br>
            1. Menurunkan tekanan darah tinggi<br>
            2. Menjaga kesehatan mata dan pencernaan<br>
            3. Menyehatkan tulang<br>
            4. Mencegah penyakti jantung, kanker<br>
            5. Menurunkan berat badan'],
            ['Mulberry', '
            Manfaat Mulberry:<br>
            1. Menurunkan kolesterol<br>
            2. Menjaga kesehatan mata dan kulit<br>
            3. Meningkatkan sistem imun<br>
            4. Mengontrol gula darah<br>
            5. Mencegah anemia dan risiko kanker'],
            ['Naga Merah', '
            Manfaat Naga Merah:<br>
            1. Sumber antioksidan tinggi<br>
            2. Membantu proses detoksifikasi<br>
            3. Mencegah kanker dan diabetes<br>
            4. Menurunkan tekanan darah tinggi<br>
            5. Mengatasi masalah pencernaan<br>
            6. Menjaga kesehatan tulang dan peredaran darah'],
            ['Nanas', '
            Manfaat Nanas:<br>
            1. Melancarkan pencernaan<br>
            2. Meningkatkan imunitas<br>
            3. Membantu menurunkan berat badan<br>
            4. Mencegah kanker<br>
            5. Meringankan radang sendi rematik'],
            ['Nangka', '
            Manfaat Nangka:<br>
            1. Melancarkan pencernaan<br>
            2. Menjaga berat badan<br>
            3. Mencegah penyakit kardiovaskular<br>
            4. Memelihara kesehatan kulit<br>
            5. Mengurangi risiko kanker'],
            ['Pear', '
            Manfaat Pear:<br>
            1. Menjaga sistem pencernaan<br>
            2. Mengandung antioksidan dan berbagai nutrisi<br>
            3. Mencegah diabetes<br>
            4. Memperkuat kekebalan tubuh<br>
            5. Menjaga kesehatan kulit'],
            ['Pepaya', '
            Manfaat Pepaya:<br>
            1. Meningkatkan imun tubuh<br>
            2. Melindungi jantung dan mata<br>
            3. Mencegah kanker, risiko alzheimer dan peradangan<br>
            4. Membantu diet sehat<br>
            5. Melancarkan sistem pencernaan<br>
            6. Menurunkan kolesterol'],
            ['Persik', '
            Manfaat Persik:<br>
            1. Menjaga kesehatan mata dan saluran cerna<br>
            2. Meningkatkan daya tahan tubuh<br>
            3. Melembabkan kulit dan menghambat penuaan diri<br>
            4. Mencegah pengeroposan tulang<br>
            5. Menghambat pertumbuhan dan penyebaran sel kanker'],
            ['Plum', '
            Manfaat Plum:<br>
            1. Menurunkan berat badan<br>
            2. Meningkatkan sistem kekebalan tubuh<br>
            3. Menjaga kesehatan mata<br>
            4. Menjaga kadar gula darah<br>
            5. Mencegah sembelit dan osteoporosis'],
            ['Raspberry', '
            Manfaat Raspberry:<br>
            1. Menjaga kesehatan pencernaan dan otak<br>
            2. Meredakan gejala radang sendir<br>
            3. Mencegah risiko penyakit kronis dan kanker<br>
            4. Melindungi mata<br>
            5. Melawan penuaan<br>
            6. Mengatasi diabetes'],
            ['Semangka', '
            Manfaat Semangka:<br>
            1. Mengatasi asma<br>
            2. Menyuburkan kandungan<br>
            3. Mencegah dehidrasi dan risiko penyakit jantung<br>
            4. Meredakan nyeri otot<br>
            5. Melindungi kulit, rambut dan mata tetap sehat'],
            ['Sirsak', '
            Manfaat Sirsak:<br>
            1. Meningkatkan daya tahan tubuh<br>
            2. Meredakan peradangan<br>
            3. Melancarkan pencernaan<br>
            4. Melawan infeksi<br>
            5. Mencegah pertumbuhan sel kanker'],
            ['Strawberry', '
            Manfaat Strawberry:<br>
            1. Meningkatkan kekebalan tubuh<br>
            2. Mencegah risiko penyakit jantung, kanker dan stroke<br>
            3. Membantu meningkatkan memori<br>
            4. Mengobati diabetes<br>
            5. Melancarkan buang air besar<br>
            6. Menurunkan berat badan'],
            ['Terong Belanda', '
            Manfaat Terong Belanda:<br>
            1. Mengatasi masalah pencernaan<br>
            2. Mengurangi sembelit<br>
            3. Mencegah diabetes dan darah tinggi<br>
            4. Menjaga metabolisme tubuh<br>
            5. Meningkatkan penglihatan<br>
            6. Bagus untuk menurunkan berat badan'],
            ['Timun Mas', '
            Manfaat Timun Mas:<br>
            1. Sumber antioksidan<br>
            2. Membantu sistem pencernaan dan melancarkan proses detoksifikasi<br>
            3. Mencegah kanker<br>
            4. Menyehatkan mata dan ginjal<br>
            5. Mempertajam daya ingat'],
            ['Tomat', '
            Manfaat Tomat:<br>
            1. Mencegah kanker<br>
            2. Mengontrol tekanan darah, diabetes dan kesehatan jantung<br>
            3. Mengatasi sembelit<br>
            4. Menjaga kesehatan mata<br>
            5. Membuat kulit lebih sehat'],
            ['Wortel', '
            Manfaat Wortel:<br>
            1. Mencegah risiko kanker prostat, kanker usus besar, leukemia, diabetes dan penyakit lainnya<br>
            2. Menjaga kesehatan mata, jantung dan tekanan darah<br>
            3. Meningkatkan sistem kekebalan tubuh<br>
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
