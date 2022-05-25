<?php

namespace App\Enum;

class TipologiaEnum
{
    const ARTICOLO = 'ARTICOLO';
    const RICERCA = 'RICERCA';
    const LIBRO = 'LIBRO';

    static function getTipologiaEnum()
    {
        return array(
            'ARTICOLO' => 'ARTICOLO',
            'RICERCA' => 'RICERCA',
            'LIBRO' => 'LIBRO'
        );
    }
}
