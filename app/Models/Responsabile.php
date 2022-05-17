<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsabile extends Utente
{
    use HasFactory;

    protected $table = 'utenti';
    public $timestamps = true;
    protected $guarded = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->mergeFillable(['data_nascita', 'universita', 'ambito_ricerca']);
    }


    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('ruolo', 'responsabile');
        });
    }

    public function progetti(){
        return $this->hasMany(Progetto::class,'responsabile_id');
    }

    public function sotto_progetti(){
        return $this->hasMany(SottoProgetto::class,'responsabile_id');
    }
}
