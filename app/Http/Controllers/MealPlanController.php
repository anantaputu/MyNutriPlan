<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenAI\Laravel\Facades\OpenAI;

class MealPlanController extends Controller
{
    public function create()
    {
        return view('member.meal-form');
    }

    public function generate(Request $request)
    {
        $user = Auth::user();
        // Simpan data fisik dari form ke database
        $user->update($request->only(['height', 'weight', 'health_history']));

        $prompt = "Buatkan saya rencana menu makanan sehat untuk satu hari (sarapan, makan siang, makan malam) berdasarkan data: Tinggi {$request->height} cm, Berat {$request->weight} kg, Riwayat Kesehatan: {$request->health_history}. Sertakan estimasi nilai gizi makro (protein, karbohidrat, lemak) dan mikro (contoh: Vitamin C, Zat Besi) untuk setiap menu. Sajikan dalam format JSON dengan kunci: 'sarapan', 'makan_siang', 'makan_malam'.";

        try {
            $result = Gemini::geminiPro()->generateContent($prompt);

            $mealPlan = json_decode($result->text(), true);

            return view('member.meal-result', ['mealPlan' => $mealPlan]);

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membuat menu: ' . $e->getMessage());
        }
    }
}