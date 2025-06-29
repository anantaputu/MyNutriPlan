# MyNutriPlan

MyNutriPlan adalah aplikasi berbasis web yang dirancang untuk membantu pengguna dalam merencanakan, memantau, dan meningkatkan pola makan sehat sesuai kebutuhan nutrisi harian. Dengan fitur analisis nutrisi yang canggih dan rekomendasi menu yang dipersonalisasi, MyNutriPlan menjadi asisten digital untuk gaya hidup sehat.

## Penjelasan Singkat

Aplikasi ini memanfaatkan data nutrisi makanan dan algoritma rekomendasi untuk memberikan saran menu harian yang sesuai dengan profil pengguna, seperti usia, jenis kelamin, berat badan, tinggi badan, dan tujuan kesehatan (misal: menurunkan berat badan, menjaga berat badan, atau menambah massa otot). Pengguna dapat mencatat asupan makanan, memantau kemajuan, serta mendapatkan tips dan edukasi seputar gizi.

## Fitur Utama

- **Rekomendasi Menu Harian**  
    Menyediakan saran menu harian yang disesuaikan dengan kebutuhan kalori, makronutrien (karbohidrat, protein, lemak), dan mikronutrien (vitamin, mineral) pengguna.

- **Pencatatan Asupan Makanan**  
    Memungkinkan pengguna mencatat makanan yang dikonsumsi setiap hari, baik secara manual maupun melalui pencarian database makanan.

- **Analisis Nutrisi Otomatis**  
    Menghitung total kalori dan kandungan nutrisi dari makanan yang dicatat, serta membandingkannya dengan kebutuhan harian.

- **Saran Perbaikan Pola Makan**  
    Memberikan insight dan rekomendasi untuk memperbaiki pola makan berdasarkan data asupan harian.

- **Profil Pengguna & Tujuan Kesehatan**  
    Pengguna dapat mengatur profil dan tujuan kesehatan untuk mendapatkan rekomendasi yang lebih akurat.

- **Riwayat & Statistik**  
    Menampilkan grafik dan statistik perkembangan asupan nutrisi dan pencapaian target.

- **Edukasi Gizi**  
    Menyediakan artikel, tips, dan informasi seputar nutrisi dan pola makan sehat.

## Instalasi

Pastikan Anda telah menginstal [Node.js](https://nodejs.org/) dan [npm](https://www.npmjs.com/) di komputer Anda.

1. **Clone repositori ini:**
        ```bash
        git clone https://github.com/username/MyNutriPlan.git
        ```

2. **Masuk ke direktori proyek:**
        ```bash
        cd MyNutriPlan
        ```

3. **Instal dependensi aplikasi:**
        ```bash
        npm install
        ```

4. **Konfigurasi variabel lingkungan (opsional):**  
     Jika aplikasi membutuhkan konfigurasi khusus (misal: API key), buat file `.env` di root proyek dan tambahkan variabel yang diperlukan.

5. **Jalankan aplikasi secara lokal:**
        ```bash
        npm start
        ```
        Aplikasi akan berjalan di `http://localhost:3000` secara default.

6. **Build untuk produksi (opsional):**
        ```bash
        npm run build
        ```
        Hasil build akan tersedia di folder `build/`.

## Kontribusi

Kontribusi sangat terbuka!  
Jika Anda ingin menambahkan fitur, memperbaiki bug, atau meningkatkan dokumentasi:

1. Fork repositori ini.
2. Buat branch baru untuk perubahan Anda.
3. Lakukan perubahan dan commit.
4. Ajukan _pull request_ ke branch utama.

Silakan buat _issue_ jika menemukan bug atau memiliki saran fitur.

## Lisensi

Proyek ini dilisensikan di bawah MIT License.  
Silakan lihat file [LICENSE](./LICENSE) untuk informasi lebih lanjut.