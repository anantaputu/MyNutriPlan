<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Menangani pengiriman form kontak.
     */
    public function submit(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        try {
            // Mengirim email langsung ke developer
            Mail::raw(
                "Pesan Kontak Baru:\n\n" .
                "Nama: " . $validated['name'] . "\n" .
                "Email: " . $validated['email'] . "\n" .
                "Subjek: " . ($validated['subject'] ?? 'Tidak ada subjek') . "\n\n" .
                "Pesan:\n" . $validated['message'],
                function ($message) use ($validated) {
                    $message->to('developer@yourdomain.com') // GANTI DENGAN EMAIL DEVELOPER ANDA
                            ->subject('Pesan Kontak Baru dari Website: ' . ($validated['subject'] ?? 'Tanpa Subjek'))
                            ->from($validated['email'], $validated['name']); // Menggunakan email pengirim sebagai 'from'
                }
            );

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim! Kami akan menghubungi Anda segera.');

        } catch (\Exception $e) {
            // Tangani error jika pengiriman email gagal
            \Log::error('Gagal mengirim pesan kontak: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Maaf, terjadi kesalahan saat mengirim pesan Anda. Silakan coba lagi.');
        }
    }
}