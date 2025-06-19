<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductTypesController extends Controller
{
    public function create() {
        return view('pages.inventaris.kategori');
    }

    public function store (Request $request) {
        $request->validate([
            'name' => 'required|string',
            'brand' => 'required|string',
            'retail_price' => 'required|max:999999.99',
            'description' => 'nullable|string',
            'categories' => 'nullable|string',
            'unit_type' => 'required|in:satuan,jumlah_banyak',
        ]);

        try{
            DB::table('product_types')->insert([
                'name' => $request->name,
                'brand' => $request->brand,
                'retail_price' => $request->retail_price,
                'description' => $request->description,
                'categories' => $request->categories ? json_encode(explode(',', $request->categories)) : null,
                'unit_type' => $request->unit_type,
                'satuan' => $request->unit_type,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect()->route('inventaris.index')->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return response()->json([
                'message'=> 'Gagal Menyimpan', $e->getMessage(),
            ], 500);
        }
    }
}
