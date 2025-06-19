<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventarisController extends Controller
{
    public function index() {
        $productType = DB::table('product_types')->orderByDesc('created_at')->get();

        return view('pages.inventaris.index', compact('productType'));
    }

}
