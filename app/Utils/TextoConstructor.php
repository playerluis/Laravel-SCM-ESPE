<?php

namespace App\Utils;

class TextoConstructor
{
    static function formatText($text): string
    {
        $excludedWords = ['y', 'en', 'el', 'de'];
        $formattedText = str_replace('_', ' ', $text);
        $formattedText = ucwords($formattedText);
        foreach ($excludedWords as $word) {
            $formattedText = str_replace(ucwords($word), strtolower($word), $formattedText);
        }
        return $formattedText;
    }
}
