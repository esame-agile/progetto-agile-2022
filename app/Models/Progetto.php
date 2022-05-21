<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Progetto extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'progetti';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'titolo',
        'descrizione',
        'scopo',
        'data_inizio',
        'data_fine',
        'responsabile_id',
    ];

    public function responsabile(){
        return $this->belongsTo(Responsabile::class, 'responsabile_id');
    }

    public function finanziatori(){
        return $this->hasMany(Finanziatore::class);
    }

    public function ricercatori(){
        return $this->belongsToMany(Ricercatore::class);
    }

    public function sotto_progetti(){
        return $this->hasMany(SottoProgetto::class);
    }
}
