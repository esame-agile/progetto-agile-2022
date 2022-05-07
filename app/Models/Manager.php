<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Manager extends Utente
{
    use HasFactory;
    protected $table = 'manager';
    protected $primaryKey = 'id_manager';
    public $timestamps = true;

    protected $fillable = [

    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

    }

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('ruolo', 'manager');
        });
    }
}
