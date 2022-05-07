<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ricercatore extends Utente
{
    use HasFactory;
    protected $table = 'ricercatori';
    protected $primaryKey = 'id_ricercatore';
    public $timestamps = true;

    protected $fillable = [
        'data_nascita',
        'universita',
        'ambito_ricerca'
    ];



    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->mergeFillable(['dataNascita', 'università', 'ambitoRicerca']);
    }

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('ruolo', 'ricercatore');
        });
    }
}
