<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $fillable = [
        'word_indonesia',
        'word_makassar',
        'pronunciation',
        'lontara',
        'meaning',
        'word_class',
        'found'
    ];

    protected $casts = [
        'found' => 'boolean'
    ];

    public static function getCachedTranslation($word)
    {
        return self::where('word_indonesia', $word)->first();
    }

    public static function saveTranslation($word, $data)
    {
        return self::updateOrCreate(
            ['word_indonesia' => $word],
            [
                'word_makassar' => $data['makassar'] ?? null,
                'pronunciation' => $data['pronunciation'] ?? null,
                'lontara' => $data['lontara'] ?? null,
                'meaning' => $data['meaning'] ?? null,
                'word_class' => $data['word_class'] ?? null,
                'found' => $data['found'] ?? true
            ]
        );
    }
}
