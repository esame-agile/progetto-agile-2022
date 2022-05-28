<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finanziatore extends Utente
{
    use HasFactory;
    protected $table = 'utenti';
    public $timestamps = true;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->mergeFillable(['nome_azienda']);
    }

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('ruolo', 'finanziatore');
        });
    }

    public function progetti(){
        return $this->belongsToMany(Progetto::class);
    }
}
