<?php

namespace App\Enum;

enum TipologiaEnum:string
{
    case ARTICOLO = 'ARTICOLO';
    case RICERCA = 'RICERCA';
    case LIBRO = 'LIBRO';

    static function getTipologiaEnum()
    {
        return array(
            'ARTICOLO' => 'ARTICOLO',
            'RICERCA' => 'RICERCA',
            'LIBRO' => 'LIBRO'
        );
    }
}
