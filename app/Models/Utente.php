<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Utente extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'utenti';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'nome',
        'cognome',
        'email',
        'password',
        'ruolo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasRuolo($ruolo): bool
    {
        return $this->ruolo == $ruolo;
    }

    /**
     * restituisce l'utente se è manager
     */
    public function scopeIsManager($query)
    {
        return $query->where('ruolo', '=', 'manager');
    }

    //https://tighten.com/blog/extending-models-in-eloquent/ -  estendere un model in eloquent
    /**
     * restituisce l'utente se è ricercatore
     */
    public function scopeIsRicercatore($query)
    {
        return $query->where('ruolo', '=', 'ricercatore');
    }

    /**
     * restituisce l'utente se è finanziatore
     */
    public function scopeIsFinanziatore($query)
    {
        return $query->where('ruolo', '=', 'finanziatore');
    }
}
