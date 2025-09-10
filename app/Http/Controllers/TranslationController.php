<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TranslationController
{
    public function index()
    {
        return view('layouts.app');
    }

    public function translate(Request $request)
    {
        $request->validate([
            'kata' => 'required|string|max:255'
        ]);

        $kata = strtolower(trim($request->input('kata')));

        // Cek apakah kata sudah ada di database
        $existingTranslation = DB::table('makassar_translation')
            ->where('indonesia_word', $kata)
            ->first();

        if ($existingTranslation) {
            // Jika ada di database, return data dari database
            return response()->json([
                'status' => 'success',
                'source' => 'database',
                'data' => [
                    'makassar' => $existingTranslation->makassar_word,
                    'pronunciation' => $existingTranslation->pronunciation ?? '',
                    'lontara' => $existingTranslation->lontara,
                    'indonesia' => $existingTranslation->indonesia_meaning,
                    'wordClass' => $existingTranslation->word_class
                ]
            ]);
        }

        // Jika tidak ada di database, ambil dari API
        try {
            $url = 'https://belajarlontara.com/getkatadetail';
            $response = Http::timeout(10)->get($url, ['key' => $kata]);

            if (!$response->successful()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal mengambil data dari server terjemahan'
                ], 500);
            }

            $html = $response->body();
            $parsedData = $this->parseTranslationResponse($html);

            if (!$parsedData || empty($parsedData['makassar']) || empty($parsedData['indonesia'])) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Kata '{$kata}' tidak ditemukan dalam kamus"
                ], 404);
            }

            // Simpan ke database
            DB::table('makassar_translation')->insert([
                'indonesia_word' => $kata,
                'makassar_word' => $parsedData['makassar'],
                'pronunciation' => $parsedData['pronunciation'] ?? null,
                'lontara' => $parsedData['lontara'],
                'indonesia_meaning' => $parsedData['indonesia'],
                'word_class' => $parsedData['wordClass'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'status' => 'success',
                'source' => 'api',
                'data' => $parsedData
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menerjemahkan: ' . $e->getMessage()
            ], 500);
        }
    }

    private function parseTranslationResponse($html)
    {
        try {
            // Pastikan encoding UTF-8 biar lontara tidak rusak
            $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            libxml_clear_errors();

            $xpath = new \DOMXPath($dom);

            $data = [
                'makassar' => '',
                'pronunciation' => '',
                'lontara' => '',
                'indonesia' => '',
                'wordClass' => '',
                'ilustrasi' => '',
                'contoh' => ''
            ];

            $ddElements = $xpath->query('//dd');

            if ($ddElements->length >= 6) {
                // Kata Makassar
                $makassarElement = $xpath->query('.//span[contains(@class,"text-primary")]', $ddElements->item(0));
                if ($makassarElement->length > 0) {
                    $data['makassar'] = trim($makassarElement->item(0)->textContent);
                }

                // Pronunciation
                $pronunciationElement = $xpath->query('.//em', $ddElements->item(0));
                if ($pronunciationElement->length > 0) {
                    $data['pronunciation'] = trim($pronunciationElement->item(0)->textContent);
                }

                // Lontara
                $lontaraElement = $xpath->query('.//*[contains(@class,"fw-semibold")]', $ddElements->item(1));
                if ($lontaraElement->length > 0) {
                    $data['lontara'] = trim($lontaraElement->item(0)->textContent);
                }

                // Arti Indonesia
                $indonesiaElement = $xpath->query('.//*[contains(@class,"text-success")]', $ddElements->item(2));
                if ($indonesiaElement->length > 0) {
                    $data['indonesia'] = trim($indonesiaElement->item(0)->textContent);
                }

                // Word Class
                $data['wordClass'] = trim($ddElements->item(3)->textContent);

                // Ilustrasi
                $data['ilustrasi'] = trim($ddElements->item(4)->textContent);

                // Contoh kalimat
                $data['contoh'] = trim($ddElements->item(5)->textContent);
            }

            return $data;
        } catch (\Exception $e) {
            return null;
        }
    }

}
