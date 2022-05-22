<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ricercatore extends Utente
{
    use HasFactory;
    protected $table = 'utenti';
    public $timestamps = true;


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->mergeFillable(['data_nascita', 'universita', 'ambito_ricerca']);
    }

   public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('ruolo', 'ricercatore');
        });
    }

    public function progetti(){
        return $this->belongsToMany(Progetto::class);
    }

    public function sotto_progetto(){
        return $this->belongsToMany(SottoProgetto::class);
    }
}
