<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $articles = [
            [
                'title' => 'Manfaat Konsumsi Air Putih untuk Kesehatan Tubuh',
                'content' => 'Air putih memiliki peran penting dalam menjaga keseimbangan cairan tubuh, mendukung fungsi ginjal, serta membantu pencernaan. Selain itu, minum cukup air juga dapat meningkatkan energi, menjaga kesehatan kulit, dan membantu proses detoksifikasi alami tubuh.',
                'photo' => 'air-putih.jpg',
            ],
            [
                'title' => 'Tips Memulai Pola Hidup Sehat dari Rumah',
                'content' => 'Memulai gaya hidup sehat tidak harus sulit. Anda bisa memulainya dengan rutin sarapan, mengurangi makanan olahan, tidur cukup, dan mulai berolahraga ringan setiap hari. Menjaga pola makan dan aktivitas fisik secara konsisten akan membawa dampak positif jangka panjang.',
                'photo' => 'pola-hidup-sehat.jpg',
            ],
            [
                'title' => 'Makanan yang Baik untuk Menurunkan Kolesterol',
                'content' => 'Beberapa makanan seperti alpukat, oatmeal, kacang-kacangan, dan ikan berlemak (seperti salmon dan makarel) terbukti efektif menurunkan kadar kolesterol jahat (LDL). Konsumsi serat larut juga dapat membantu mengikat kolesterol dalam saluran pencernaan.',
                'photo' => 'kolesterol.jpg',
            ],
            [
                'title' => 'Panduan Asupan Gizi Seimbang untuk Dewasa',
                'content' => 'Asupan gizi seimbang mencakup karbohidrat, protein, lemak sehat, vitamin, dan mineral dalam porsi yang sesuai. Orang dewasa disarankan mengonsumsi sayur dan buah minimal 5 porsi per hari, mengurangi konsumsi gula tambahan, serta memperhatikan kecukupan air minum.',
                'photo' => 'gizi-seimbang.jpg',
            ],
            [
                'title' => 'Cara Mengatur Waktu Makan agar Tidak Mudah Lapar',
                'content' => 'Mengatur jadwal makan secara teratur membantu menghindari rasa lapar berlebih yang memicu makan berlebihan. Idealnya, makan besar dilakukan 3 kali sehari dengan 1-2 kali snack sehat seperti buah atau yogurt di antara waktu makan.',
                'photo' => 'atur-makan.jpg',
            ],
            [
                'title' => 'Mengapa Serat Penting untuk Diet Sehat?',
                'content' => 'Serat membantu memperlambat penyerapan gula dalam darah, menjaga kenyang lebih lama, serta mendukung kesehatan usus. Sayur, buah, biji-bijian utuh, dan kacang-kacangan adalah sumber serat terbaik untuk diet sehat.',
                'photo' => 'diet-serat.jpg',
            ],
            [
                'title' => 'Manfaat Probiotik dalam Menjaga Kesehatan Pencernaan',
                'content' => 'Probiotik adalah mikroorganisme baik yang membantu menyeimbangkan flora usus, memperkuat sistem imun, dan mengurangi risiko gangguan pencernaan. Anda bisa mendapatkannya dari yogurt, kefir, kimchi, dan tempe.',
                'photo' => 'probiotik.jpg',
            ],
            [
                'title' => 'Mengenal Lemak Sehat dan Sumbernya',
                'content' => 'Tidak semua lemak itu jahat. Lemak tak jenuh tunggal dan ganda seperti omega-3 baik untuk jantung. Alpukat, kacang-kacangan, minyak zaitun, dan ikan laut dalam adalah sumber lemak sehat yang sebaiknya dikonsumsi secara teratur.',
                'photo' => 'lemak-sehat.jpg',
            ],
            [
                'title' => 'Tips Memilih Camilan Sehat untuk Anak',
                'content' => 'Camilan sehat untuk anak sebaiknya kaya nutrisi, rendah gula tambahan, dan tidak mengandung bahan pengawet berlebihan. Buah potong, biskuit gandum, telur rebus, atau puding chia bisa jadi alternatif sehat dan enak.',
                'photo' => 'camilan-anak.jpg',
            ],
            [
                'title' => 'Kebutuhan Vitamin D dan Sumber Alaminya',
                'content' => 'Vitamin D berperan penting dalam penyerapan kalsium dan menjaga kesehatan tulang. Sumber alami terbaik adalah sinar matahari pagi, ikan berlemak, hati sapi, dan kuning telur. Kekurangan vitamin D dapat menyebabkan kelemahan otot dan masalah tulang.',
                'photo' => 'vitamin-d.jpg',
            ],
            [
                'title' => 'Mengatasi Kecanduan Gula Secara Alami',
                'content' => 'Mengurangi konsumsi makanan dan minuman manis secara bertahap, memperbanyak konsumsi protein, dan menjaga pola tidur dapat membantu mengatasi kecanduan gula. Perbanyak air putih juga penting agar tubuh tidak keliru mengartikan rasa haus sebagai lapar.',
                'photo' => 'gula.jpg',
            ],
            [
                'title' => 'Fakta Tentang Diet Intermittent Fasting',
                'content' => 'Intermittent fasting adalah metode mengatur pola makan dengan jendela waktu tertentu, misalnya makan hanya dalam 8 jam dan puasa 16 jam. Diet ini dapat membantu mengontrol berat badan, menurunkan kadar insulin, dan meningkatkan metabolisme tubuh.',
                'photo' => 'if.jpg',
            ],
            [
                'title' => 'Pentingnya Sarapan untuk Anak Sekolah',
                'content' => 'Sarapan membantu anak lebih fokus dan memiliki energi untuk belajar. Menu sarapan ideal mencakup karbohidrat kompleks, protein, dan sedikit lemak sehat. Contohnya: roti gandum, telur rebus, dan susu.',
                'photo' => 'sarapan-anak.jpg',
            ],
            [
                'title' => 'Kapan Waktu Terbaik untuk Berolahraga?',
                'content' => 'Waktu terbaik olahraga tergantung preferensi dan tujuan. Pagi hari cocok untuk membakar lemak dan meningkatkan mood, sedangkan sore hari memberi performa fisik terbaik. Yang terpenting adalah konsistensi.',
                'photo' => 'olahraga.jpg',
            ],
            [
                'title' => 'Makanan yang Harus Dihindari Saat Diet',
                'content' => 'Saat menjalani diet, sebaiknya hindari makanan tinggi gula, gorengan, makanan cepat saji, serta minuman berpemanis buatan. Fokuslah pada makanan utuh dan alami seperti buah, sayur, dan protein tanpa lemak.',
                'photo' => 'hindari-diet.jpg',
            ],
            [
                'title' => 'Cara Mengelola Stress dengan Pola Makan Sehat',
                'content' => 'Stress dapat dikurangi dengan konsumsi makanan yang kaya magnesium, vitamin B, dan omega-3. Contohnya: alpukat, kacang almond, ikan, dan sayuran hijau. Hindari kafein dan gula berlebihan.',
                'photo' => 'stress.jpg',
            ],
            [
                'title' => 'Mengapa Tidur Cukup Penting untuk Imunitas',
                'content' => 'Tidur yang cukup membantu tubuh memperbaiki sel-sel yang rusak, memperkuat sistem imun, serta menjaga keseimbangan hormon. Orang dewasa disarankan tidur 7-9 jam per malam.',
                'photo' => 'tidur.jpg',
            ],
            [
                'title' => 'Cara Membaca Label Nutrisi Makanan Kemasan',
                'content' => 'Label nutrisi berisi informasi penting tentang kalori, lemak, gula, dan kandungan lain dalam makanan kemasan. Perhatikan ukuran porsi, nilai harian (%DV), dan kandungan gula tambahan.',
                'photo' => 'label-makanan.jpg',
            ],
            [
                'title' => 'Manfaat Olahraga Ringan Setiap Hari',
                'content' => 'Olahraga ringan seperti jalan kaki 30 menit per hari bisa meningkatkan kesehatan jantung, menjaga berat badan ideal, dan memperbaiki suasana hati. Konsistensi lebih penting daripada intensitas tinggi.',
                'photo' => 'olahraga-ringan.jpg',
            ],
            [
                'title' => 'Kebutuhan Zat Besi dan Cegah Anemia',
                'content' => 'Zat besi penting untuk pembentukan hemoglobin dalam darah. Sumber zat besi terbaik antara lain daging merah, bayam, dan kacang-kacangan. Anemia dapat dicegah dengan pola makan bergizi dan seimbang.',
                'photo' => 'zat-besi.jpg',
            ],
        ];

        foreach ($articles as $article) {
            DB::table('articles')->insert([
                'title' => $article['title'],
                'slug' => Str::slug($article['title']),
                'content' => '<p>' . str_replace("\n", '</p><p>', wordwrap($article['content'], 200)) . '</p>',
                'photo' => $article['photo'],
                'created_at' => Carbon::now()->subDays(rand(0, 30)),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
