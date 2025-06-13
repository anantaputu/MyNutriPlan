<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
            [
                'id' => 1,
                'title' => 'Madani kecekok sesuatu',
                'slug' => 'madani-kecekok-sesuatu',
                'content' => 'Kecekok Dildo lo yaaaa',
                'photo' => 'articles/hznOlIN7QsDNID6nuZeY7LCw09aqUjQXzkqdYDnr.jpg',
                'created_at' => '2025-06-11 18:44:55',
                'updated_at' => '2025-06-11 18:45:44',
            ],
            [
                'id' => 2,
                'title' => 'Manfaat Diet Mediterania untuk Kesehatan Jantung',
                'slug' => 'manfaat-diet-mediterania-untuk-kesehatan-jantung',
                'content' => 'Diet Mediterania kaya akan buah-buahan, sayuran, biji-bijian, dan lemak sehat. Studi menunjukkan pola makan ini dapat secara signifikan mengurangi risiko penyakit jantung dan stroke. Fokus utamanya adalah pada minyak zaitun, ikan, kacang-kacangan, dan mengurangi daging merah.',
                'photo' => 'articles/diet-mediterania.jpg',
                'created_at' => '2025-06-10 02:00:00',
                'updated_at' => '2025-06-10 02:00:00',
            ],
            [
                'id' => 3,
                'title' => 'Pentingnya Sarapan Sehat untuk Memulai Hari',
                'slug' => 'pentingnya-sarapan-sehat-untuk-memulai-hari',
                'content' => 'Sarapan yang seimbang memberikan energi yang dibutuhkan tubuh setelah berpuasa semalaman. Melewatkan sarapan dapat mengganggu metabolisme dan menyebabkan makan berlebihan di siang hari. Pilihlah menu yang mengandung protein, serat, dan karbohidrat kompleks.',
                'photo' => 'articles/sarapan-sehat.jpg',
                'created_at' => '2025-06-09 01:15:00',
                'updated_at' => '2025-06-09 01:15:00',
            ],
            [
                'id' => 4,
                'title' => '5 Tips Sederhana untuk Tetap Terhidrasi Sepanjang Hari',
                'slug' => '5-tips-sederhana-untuk-tetap-terhidrasi',
                'content' => 'Air adalah kunci fungsi tubuh yang optimal. Selalu bawa botol minum, konsumsi buah yang kaya air seperti semangka, dan atur pengingat untuk minum. Hindari minuman manis yang justru dapat menyebabkan dehidrasi.',
                'photo' => 'articles/hidrasi-tubuh.jpg',
                'created_at' => '2025-06-08 06:30:00',
                'updated_at' => '2025-06-08 06:30:00',
            ],
            [
                'id' => 5,
                'title' => 'Mengenal Karbohidrat Baik dan Buruk',
                'slug' => 'mengenal-karbohidrat-baik-dan-buruk',
                'content' => 'Tidak semua karbohidrat diciptakan sama. Karbohidrat kompleks seperti pada nasi merah dan ubi jalar dicerna lebih lambat dan memberikan energi stabil. Sebaliknya, karbohidrat sederhana seperti pada gula dan roti putih dapat menyebabkan lonjakan gula darah.',
                'photo' => 'articles/karbohidrat.jpg',
                'created_at' => '2025-06-07 03:00:00',
                'updated_at' => '2025-06-07 03:00:00',
            ],
            [
                'id' => 6,
                'title' => 'Peran Protein dalam Membangun dan Memperbaiki Otot',
                'slug' => 'peran-protein-dalam-membangun-otot',
                'content' => 'Protein adalah blok bangunan bagi otot Anda. Mengonsumsi cukup protein, terutama setelah berolahraga, sangat penting untuk pemulihan dan pertumbuhan otot. Sumber protein yang baik antara lain telur, dada ayam, tempe, dan ikan.',
                'photo' => 'articles/protein-otot.jpg',
                'created_at' => '2025-06-06 08:45:00',
                'updated_at' => '2025-06-06 08:45:00',
            ],
            [
                'id' => 7,
                'title' => 'Cara Membaca Label Nutrisi pada Kemasan Makanan',
                'slug' => 'cara-membaca-label-nutrisi',
                'content' => 'Memahami label nutrisi membantu Anda membuat pilihan makanan yang lebih cerdas. Perhatikan ukuran saji, jumlah kalori, kandungan gula, garam (natrium), dan lemak jenuh untuk mengontrol asupan harian Anda.',
                'photo' => 'articles/label-nutrisi.jpg',
                'created_at' => '2025-06-05 00:00:00',
                'updated_at' => '2025-06-05 00:00:00',
            ],
            [
                'id' => 8,
                'title' => 'Superfood Lokal Indonesia yang Tak Kalah Bergizi',
                'slug' => 'superfood-lokal-indonesia',
                'content' => 'Indonesia kaya akan superfood seperti kelor, tempe, dan kunyit. Kelor kaya akan vitamin dan antioksidan, tempe merupakan sumber protein nabati yang hebat, dan kunyit memiliki sifat anti-inflamasi yang kuat.',
                'photo' => 'articles/superfood-indonesia.jpg',
                'created_at' => '2025-06-04 05:20:00',
                'updated_at' => '2025-06-04 05:20:00',
            ],
            [
                'id' => 9,
                'title' => 'Bahaya Konsumsi Gula Berlebih dan Cara Menguranginya',
                'slug' => 'bahaya-konsumsi-gula-berlebih',
                'content' => 'Asupan gula yang tinggi berkaitan dengan obesitas, diabetes tipe 2, dan penyakit jantung. Mulailah mengurangi gula dengan menghindari minuman manis, membaca label, dan memilih pemanis alami dalam jumlah terbatas.',
                'photo' => 'articles/stop-gula.jpg',
                'created_at' => '2025-06-03 02:50:00',
                'updated_at' => '2025-06-03 02:50:00',
            ],
            [
                'id' => 10,
                'title' => 'Mengapa Tidur Cukup Penting untuk Diet Anda?',
                'slug' => 'mengapa-tidur-cukup-penting-untuk-diet',
                'content' => 'Kurang tidur dapat mengacaukan hormon yang mengatur rasa lapar, yaitu ghrelin dan leptin. Hal ini bisa membuat Anda lebih sering merasa lapar dan sulit mengontrol porsi makan. Usahakan tidur 7-9 jam setiap malam.',
                'photo' => 'articles/tidur-diet.jpg',
                'created_at' => '2025-06-02 13:00:00',
                'updated_at' => '2025-06-02 13:00:00',
            ],
            [
                'id' => 11,
                'title' => 'Tips Memasak Sehat untuk Menjaga Nutrisi Makanan',
                'slug' => 'tips-memasak-sehat',
                'content' => 'Metode memasak seperti mengukus, merebus, atau menumis dengan sedikit minyak lebih baik daripada menggoreng. Cara ini membantu menjaga kandungan vitamin dan mineral dalam makanan agar tidak hilang.',
                'photo' => 'articles/memasak-sehat.jpg',
                'created_at' => '2025-06-01 04:00:00',
                'updated_at' => '2025-06-01 04:00:00',
            ],
            [
                'id' => 12,
                'title' => 'Lemak Sehat: Di Mana Menemukannya dan Apa Manfaatnya?',
                'slug' => 'lemak-sehat-dan-manfaatnya',
                'content' => 'Lemak tak jenuh tunggal dan ganda, yang ditemukan dalam alpukat, kacang-kacangan, dan minyak zaitun, baik untuk kesehatan otak dan jantung. Hindari lemak trans yang ada pada makanan olahan dan gorengan.',
                'photo' => 'articles/lemak-sehat.jpg',
                'created_at' => '2025-05-31 01:00:00',
                'updated_at' => '2025-05-31 01:00:00',
            ],
            [
                'id' => 13,
                'title' => 'Mitos dan Fakta Seputar Diet Gluten-Free',
                'slug' => 'mitos-fakta-diet-gluten-free',
                'content' => 'Diet bebas gluten hanya diperlukan bagi penderita penyakit celiac atau sensitivitas gluten. Bagi kebanyakan orang, gandum utuh adalah sumber serat dan nutrisi yang baik. Jangan mengikuti tren tanpa alasan medis.',
                'photo' => 'articles/diet-gluten-free.jpg',
                'created_at' => '2025-05-30 07:10:00',
                'updated_at' => '2025-05-30 07:10:00',
            ],
            [
                'id' => 14,
                'title' => 'Pentingnya Serat untuk Kesehatan Pencernaan',
                'slug' => 'pentingnya-serat-untuk-pencernaan',
                'content' => 'Serat membantu melancarkan pencernaan, mencegah sembelit, dan menjaga kesehatan usus. Sumber serat yang baik meliputi sayuran hijau, buah-buahan, biji-bijian, dan kacang-kacangan.',
                'photo' => 'articles/serat-pencernaan.jpg',
                'created_at' => '2025-05-29 03:45:00',
                'updated_at' => '2025-05-29 03:45:00',
            ],
            [
                'id' => 15,
                'title' => 'Olahraga Ringan yang Bisa Dilakukan di Rumah',
                'slug' => 'olahraga-ringan-di-rumah',
                'content' => 'Tidak perlu ke gym untuk tetap aktif. Lakukan yoga, senam, push-up, atau squat di rumah selama 30 menit setiap hari. Konsistensi adalah kunci untuk mendapatkan manfaat kesehatan dari olahraga.',
                'photo' => 'articles/olahraga-di-rumah.jpg',
                'created_at' => '2025-05-28 09:00:00',
                'updated_at' => '2025-05-28 09:00:00',
            ],
            [
                'id' => 16,
                'title' => 'Manfaat Vitamin D dan Cara Mendapatkannya Secara Alami',
                'slug' => 'manfaat-vitamin-d',
                'content' => 'Vitamin D penting untuk kesehatan tulang dan sistem kekebalan tubuh. Sumber terbaik adalah paparan sinar matahari pagi selama 10-15 menit. Selain itu, vitamin D juga bisa didapat dari ikan berlemak dan kuning telur.',
                'photo' => 'articles/vitamin-d.jpg',
                'created_at' => '2025-05-27 00:30:00',
                'updated_at' => '2025-05-27 00:30:00',
            ],
            [
                'id' => 17,
                'title' => 'Meal Prep untuk Pemula: Hemat Waktu dan Uang',
                'slug' => 'meal-prep-untuk-pemula',
                'content' => 'Meal prep atau menyiapkan makanan untuk beberapa hari ke depan dapat membantu Anda makan lebih sehat dan teratur. Mulailah dengan merencanakan menu sederhana untuk 3 hari ke depan, lalu masak dalam porsi besar.',
                'photo' => 'articles/meal-prep.jpg',
                'created_at' => '2025-05-26 10:00:00',
                'updated_at' => '2025-05-26 10:00:00',
            ],
            [
                'id' => 18,
                'title' => 'Antioksidan: Pelindung Tubuh dari Radikal Bebas',
                'slug' => 'antioksidan-pelindung-tubuh',
                'content' => 'Antioksidan melindungi sel-sel tubuh dari kerusakan. Perbanyak konsumsi buah beri, teh hijau, dan sayuran berwarna gelap untuk mendapatkan asupan antioksidan yang cukup.',
                'photo' => 'articles/antioksidan.jpg',
                'created_at' => '2025-05-25 02:00:00',
                'updated_at' => '2025-05-25 02:00:00',
            ],
            [
                'id' => 19,
                'title' => 'Cara Mengatasi Keinginan Makan Manis (Sugar Cravings)',
                'slug' => 'mengatasi-sugar-cravings',
                'content' => 'Keinginan makan manis bisa dilawan dengan mengonsumsi buah sebagai pengganti, minum air putih, atau mengalihkan perhatian dengan berjalan-jalan sejenak. Pastikan juga asupan protein Anda cukup.',
                'photo' => 'articles/sugar-cravings.jpg',
                'created_at' => '2025-05-24 06:00:00',
                'updated_at' => '2025-05-24 06:00:00',
            ],
            [
                'id' => 20,
                'title' => 'Probiotik untuk Kesehatan Usus yang Lebih Baik',
                'slug' => 'probiotik-untuk-kesehatan-usus',
                'content' => 'Probiotik adalah bakteri baik yang mendukung keseimbangan mikroflora di usus Anda. Makanan fermentasi seperti yogurt, kimchi, dan tempe adalah sumber probiotik alami yang sangat baik.',
                'photo' => 'articles/probiotik.jpg',
                'created_at' => '2025-05-23 01:20:00',
                'updated_at' => '2025-05-23 01:20:00',
            ],
            [
                'id' => 21,
                'title' => 'Pengaruh Stres terhadap Berat Badan dan Pola Makan',
                'slug' => 'pengaruh-stres-terhadap-berat-badan',
                'content' => 'Stres kronis dapat meningkatkan hormon kortisol, yang memicu keinginan untuk makan makanan tinggi lemak dan gula. Kelola stres dengan meditasi, olahraga, atau hobi untuk menjaga pola makan tetap sehat.',
                'photo' => 'articles/stres-dan-diet.jpg',
                'created_at' => '2025-05-22 08:00:00',
                'updated_at' => '2025-05-22 08:00:00',
            ],
        ]);
        DB::statement('ALTER TABLE articles AUTO_INCREMENT = 22;');
    }
}