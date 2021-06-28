<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class SpellingHelper {

    private $rudeWords;

    public function __construct()
    {
        // Здесь конечно лучше было бы сделать подгрузку слов из файла или добавить возможность экспорта набора слов
        // но это не укладывается в текущие тайминги, как еще многое, что можно сделать
        $this->rudeWords = [
            'человек-редиска', 'безмозглый', 'бестолочь'
        ];
    }

    public function filterOfRude($string)
    {
        return Str::replace($this->rudeWords, '', $string);
    }

    public function filterInvalidSymbols($string)
    {
        return htmlspecialchars($string, ENT_QUOTES);
    }
}
