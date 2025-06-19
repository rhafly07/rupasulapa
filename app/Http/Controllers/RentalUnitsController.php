<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RentalUnitsController extends Controller
{
    public function index($id) {
        $headers = ['Nama Unit', 'Tanggal Beli', 'Catatan', 'Status'];
        $units = DB::table('rental_units')
        ->where('product_type_id', $id)
        ->select('unit_code', 'purchase_date', 'note', 'status')
        ->get();


        return view('pages.inventaris.detail-unit', compact('headers', 'units', 'id'));
    }
   public function create($id){
        $productType = DB::table('product_types')->where('id', $id)->first();

        $jenisProduct = DB::table('product_types')
            ->select('id', 'brand', 'name')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'description' => $item->brand, // kita anggap 'brand' adalah deskripsi
                    'image' => 'https://via.placeholder.com/40', // jika tidak punya gambar, pakai default
                ];
            });

        return view('pages.inventaris.tambah', compact('jenisProduct', 'productType'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_type_id' => 'required|exists:product_types,id',
            'stock' => 'required|integer|min:1',
            'purchase_price' => 'nullable|numeric',
            'purchase_date' => 'nullable|date',
            'note' => 'nullable|string',
            'owner_id' => 'nullable|exists:customers,id',
            'revenue_share' => 'nullable|integer|min:0|max:100',
            'unit_code' => 'nullable|string'
        ]);

        $productType = DB::table('product_types')->where('id', $request->product_type_id)->first();

        DB::beginTransaction();

        try {
            if ($productType->unit_type === 'satuan') {
                for ($i = 0; $i < $request->stock; $i++) {
                    DB::table('rental_units')->insert([
                        'product_type_id' => $request->product_type_id,
                        'unit_code' => $request->unit_code ? Str::slug($request->unit_code) . '-' . Str::random(5) : null,
                        'purchase_price' => $request->purchase_price,
                        'purchase_date' => $request->purchase_date,
                        'status' => 'aktif',
                        'note' => $request->note,
                        'owner_id' => $request->owner_id,
                        'revenue_share' => $request->revenue_share,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            } else {
                DB::table('rental_units')->insert([
                    'product_type_id' => $request->product_type_id,
                    'stock' => $request->stock,
                    'purchase_price' => $request->purchase_price,
                    'purchase_date' => $request->purchase_date,
                    'status' => 'aktif',
                    'note' => $request->note,
                    'owner_id' => $request->owner_id,
                    'revenue_share' => $request->revenue_share,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            DB::commit();
            return redirect()->route('inventaris.unit.index',['id' => $request->product_type_id])->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal menyimpan unit.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
