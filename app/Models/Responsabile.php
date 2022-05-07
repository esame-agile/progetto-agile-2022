<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsabile extends Ricercatore
{
    use HasFactory;

    protected $table = 'responsabili';
    protected $primaryKey = 'id_responsabile';
    public $timestamps = true;

    protected $fillable = [
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->mergeFillable([]);
    }

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('ruolo', 'ricercatore');
        });
    }
}
