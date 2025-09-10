<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController
{
     public function index()
    {
        $query = DB::table('makassar_translation')
        ->whereNotNull('makassar_word')
        ->whereNotNull('indonesia_meaning');

    $translations = $query->orderBy('created_at', 'desc')
        ->paginate(20)
        ->through(function ($item) {
            $item->created_at_human = Carbon::parse($item->created_at)->diffForHumans();
            return $item;
        });

    return view('pages.utama.index', compact('translations'));
    }


    public function history(Request $request)
    {
        $search = $request->get('search');

        $query = DB::table('makassar_translation')
            ->whereNotNull('makassar_word')
            ->whereNotNull('indonesia_meaning');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('indonesia_word', 'ILIKE', "%{$search}%")
                ->orWhere('makassar_word', 'ILIKE', "%{$search}%")
                ->orWhere('indonesia_meaning', 'ILIKE', "%{$search}%");
            });
        }

        $translations = $query->orderBy('created_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        $translations->getCollection()->transform(function ($item) {
            $item->created_at_human = Carbon::parse($item->created_at)->diffForHumans();
            return $item;
        });

        return view('pages.translate.index', compact('translations', 'search'));
    }

}
