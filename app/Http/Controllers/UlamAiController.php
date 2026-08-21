<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UlamAiController extends Controller
{
    /**
     * Menampilkan halaman UI Tanya Ulam AI
     */
    public function index()
    {
        return view('tanya-ai');
    }

    /**
     * Memproses pesan dari pengguna dan mengirimkan respons dari AI
     */
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $userMessage = $request->input('message');

        // System prompt kepribadian Ulam AI
        $systemPrompt = "Anda adalah Ulam AI, asisten virtual ramah dan bersahabat dari Rumah Makan Ulam Sari Ajibarang. " .
            "Gunakan bahasa Indonesia yang sopan dan sesekali gunakan salam khas Jawa seperti 'Sugeng siang' atau 'Matur nuwun'. " .
            "Tugas Anda adalah merekomendasikan menu masakan Jawa/Nusantara (seperti Gurame Bakar Madu, Ayam Kalasan, Sayur Asem, Bebek Goreng), " .
            "membantu reservasi meja, dan memberikan informasi jam operasional (Setiap hari: 09.00 - 21.00 WIB).";

        try {
            $apiKey = env('GEMINI_API_KEY');

            // Request ke endpoint Gemini REST API
            $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $systemPrompt . "\n\nPertanyaan Pengunjung: " . $userMessage]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $aiReply = $response->json()['candidates'][0]['content']['parts'][0]['text'] 
                    ?? 'Mohon maaf, Ulam AI tidak dapat memberikan respons saat ini.';

                return response()->json([
                    'status' => 'success',
                    'reply'  => $aiReply
                ]);
            }

            return response()->json([
                'status' => 'error',
                'reply'  => 'Terjadi kesalahan pada layanan AI. Pastikan API Key di .env sudah benar.'
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'reply'  => 'Mohon maaf, terjadi kendala koneksi pada Ulam AI. Silakan coba beberapa saat lagi.'
            ], 500);
        }
    }
}